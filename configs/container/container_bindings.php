<?php
declare(strict_types=1);

use App\Config;
use App\Contracts\AuthInterface;
use App\Contracts\BaseEntityManagerServiceInterface;
use App\Contracts\RequestValidatorFactoryInterface;
use App\Contracts\SessionInterface;
use App\Contracts\UserProviderServiceInterface;
use App\DTO\Money\MoneyType;
use App\DTO\SessionOptions;
use App\Enums\CookieSameSite;
use App\Enums\StorageDriver;
use App\Filters\UserFilter;
use App\RedisCache;
use App\RequestValidator\Factory\RequestValidatorFactory;
use App\Auth;
use App\RouteEntityBindingStrategy;
use App\Services\BaseEntityManagerService;
use App\Csrf;
use App\Session;
use App\Services\UserProviderService;
use Aws\S3\S3Client;
use Clockwork\Clockwork;
use Clockwork\DataSource\DoctrineDataSource;
use Clockwork\Storage\FileStorage;
use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Types\Type;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\ORMSetup;
use Lcharette\WebpackEncoreTwig\EntrypointsTwigExtension;
use Lcharette\WebpackEncoreTwig\TagRenderer;
use League\Flysystem\AwsS3V3\AwsS3V3Adapter;
use League\Flysystem\Filesystem;
use League\Flysystem\Local\LocalFilesystemAdapter;
use Predis\Client;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\SimpleCache\CacheInterface;
use Ramsey\Uuid\Doctrine\UuidBinaryType;
use Slim\App;
use Slim\Csrf\Guard;
use Slim\Factory\AppFactory;
use Slim\Interfaces\RouteParserInterface;
use Slim\Views\Twig;
use Symfony\Bridge\Twig\Extension\AssetExtension;
use Symfony\Bridge\Twig\Mime\BodyRenderer;
use Symfony\Component\Asset\Package;
use Symfony\Component\Asset\Packages;
use Symfony\Component\Asset\VersionStrategy\JsonManifestVersionStrategy;
use Symfony\Component\Cache\Adapter\RedisAdapter;
use Symfony\Component\Cache\Psr16Cache;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mailer\Transport;
use Symfony\Component\Mime\BodyRendererInterface;
use Symfony\Component\RateLimiter\RateLimiterFactory;
use Symfony\Component\RateLimiter\Storage\CacheStorage;
use Symfony\WebpackEncoreBundle\Asset\EntrypointLookup;
use Twig\Extra\Intl\IntlExtension;

use function DI\create;

return [
    App::class => function (ContainerInterface $container) {
        AppFactory::setContainer($container);
        $app = AppFactory::create();

        $app->getRouteCollector()->setDefaultInvocationStrategy(
            strategy:
            new RouteEntityBindingStrategy(
                $container->get(BaseEntityManagerServiceInterface::class),
                $app->getResponseFactory()
            )
        );

        $router = require CONFIG_PATH . '/routes/web.php';
        $router($app);

        $addMiddlewares = require CONFIG_PATH . '/middleware.php';
        $addMiddlewares($app);

        return $app;
    },

    Config::class => create(Config::class)->constructor(require CONFIG_PATH . '/app.php'),

    EntityManagerInterface::class => function (Config $config): EntityManager {
        Type::addType('uuid_binary', UuidBinaryType::class);
        Type::addType('money_php', MoneyType::class);

        $ormConfig = ORMSetup::createAttributeMetadataConfiguration(
            $config->get('doctrine.entity_dir'),
            $config->get('doctrine.dev_mode'),
        );
        $ormConfig->addFilter('user', UserFilter::class);

        $entityManager = new EntityManager(
            DriverManager::getConnection($config->get('doctrine.connection')),
            $ormConfig
        );

        $entityManager->getConnection()->getDatabasePlatform()->registerDoctrineTypeMapping('uuid_binary', 'binary');
        $entityManager->getConnection()->getDatabasePlatform()->registerDoctrineTypeMapping('money_php', 'string');

        return $entityManager;
    },

    Twig::class => function (Config $config, ContainerInterface $container) {
        $twig = Twig::create(VIEW_PATH, $config->get('twig'));

        $entrypoint = new EntrypointLookup(BUILD_PATH . '/entrypoints.json');
        $tagRenderer = new TagRenderer($entrypoint);

        $twig->addExtension(new IntlExtension());
        $twig->addExtension(new EntrypointsTwigExtension($entrypoint, $tagRenderer));
        $twig->addExtension(new AssetExtension($container->get('webpack_encore.packages')));

        return $twig;
    },

    'webpack_encore.packages' => fn() => new Packages(
        new Package(new JsonManifestVersionStrategy(BUILD_PATH . '/manifest.json'))
    ),

    ResponseFactoryInterface::class => fn(App $app) => $app->getResponseFactory(),

    AuthInterface::class => fn(ContainerInterface $container) => $container->get(Auth::class),

    UserProviderServiceInterface::class => fn(ContainerInterface $container) => $container->get(UserProviderService::class),

    SessionInterface::class => fn(Config $config) => new Session(
        new SessionOptions(
            $config->get('session.name', ''),
            $config->get('session.flash_key', 'flash'),
            $config->get('session.secure', ''),
            $config->get('session.httponly', ''),
            CookieSameSite::from($config->get('session.samesite', 'lax')),
        )
    ),
    RequestValidatorFactoryInterface::class => fn(ContainerInterface $container) => $container->get(RequestValidatorFactory::class),

    'csrf' => fn(ResponseFactoryInterface $responseFactory, Csrf $csrf) =>
        new Guard(
            responseFactory: $responseFactory,
            persistentTokenMode: true,
            failureHandler: $csrf->failureHandler()
        ),

    Filesystem::class => function (Config $config) {
        $adapter = match ($config->get('storage.driver')) {
            StorageDriver::LOCAL => new LocalFilesystemAdapter(STORAGE_PATH),
            StorageDriver::REMOTE_DO => function (Config $config) {
                    $options = $config->get('storage.s3');

                    $client = new S3Client([
                    'credentials' => [
                        'key' => $options['key'],
                        'secret' => $options['secret'],
                    ],
                    'region' => $options['region'],
                    'version' => $options['version'],
                    'endpoint' => $options['endpoint'],
                    ]);

                    return new AwsS3V3Adapter($client, $options['bucket-name']);
                },
        };

        return new Filesystem($adapter);
    },

    Clockwork::class => function (EntityManagerInterface $entityManager) {
        $clockwork = new Clockwork();

        $clockwork->setStorage(new FileStorage(STORAGE_PATH . '/clockwork'));
        $clockwork->addDataSource(new DoctrineDataSource($entityManager));

        return $clockwork;
    },

    BaseEntityManagerServiceInterface::class => fn(EntityManagerInterface $entityManager) =>
        new BaseEntityManagerService($entityManager),

    MailerInterface::class => function (Config $config) {
        $transport = Transport::fromDsn($config->get('mailer.dsn'));
        return new Mailer($transport);
    },

    BodyRendererInterface::class => fn(Twig $twig) => new BodyRenderer($twig->getEnvironment()),

    RouteParserInterface::class => fn(App $app) => $app->getRouteCollector()->getRouteParser(),

    RedisAdapter::class => function (Config $config) {
        $config = $config->get('redis');

        $redis = new Client([
            'scheme' => 'tcp',
            'host' => $config['host'],
            'port' => $config['port'],
        ]);

        $redis->auth($config['password']);

        return new RedisAdapter($redis);
    },

    CacheInterface::class => fn(RedisAdapter $adapter) => new Psr16Cache($adapter),

    RateLimiterFactory::class => function (RedisAdapter $adapter) {
        $storage = new CacheStorage($adapter);

        return new RateLimiterFactory([
            'id' => 'default',
            'policy' => 'fixed_window',
            'interval' => '1 minute',
            'limit' => 3,
        ], $storage);
    },
];