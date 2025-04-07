<?php
declare(strict_types=1);
use App\Enums\AppEnvironment;
use App\Enums\StorageDriver;

$appEnv = $_ENV['APP_ENV'] ?? AppEnvironment::PRODUCTION->value;
$appName = strtolower(str_replace(' ', '_', $_ENV['APP_NAME']));

return [
    'app_key' => $_ENV['APP_KEY'] ?? '',

    'app_name' => $_ENV['APP_NAME'],

    'app_version' => $_ENV['APP_VERSION'] ?? "SNAPSHOT-0.0.1",

    'app_url' => $_ENV['APP_URL'],

    'app_environment' => $appEnv,

    'display_error_details' => (bool) ($_ENV['APP_DEBUG'] ?? 0),

    'log_errors' => true,

    'log_error_details' => true,

    'doctrine' => [
        'dev_mode' => AppEnvironment::isDevelopment($appEnv),
        'cache_dir' => STORAGE_PATH . '/cache/doctrine',
        'entity_dir' => [APP_PATH . '/Entity'],
        'connection' => [
            'driver' => $_ENV['DB_DRIVER'] ?? 'pdo_mysql',
            'host' => $_ENV['DB_HOST'] ?? 'localhost',
            'port' => $_ENV['DB_PORT'] ?? 3306,
            'dbname' => $_ENV['DB_NAME'],
            'user' => $_ENV['DB_USER'],
            'password' => $_ENV['DB_PASS'],
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci'
        ]
    ],

    'twig' => [
        'cache' => STORAGE_PATH . '/cache/templates',
        'auto_reload' => $appEnv
    ],

    'session' => [
        'name' => "{$appName}_session",
        'flashkey' => "{$appName}_flash",
        'secure' => true,
        'httponly' => true,
        'samesite' => 'lax',
    ],

    'storage' => [
        'driver' => StorageDriver::LOCAL,
        's3' => [
            'key' => $_ENV['S3_KEY'],
            'secret' => $_ENV['S3_SECRET'],
            'region' => $_ENV['S3_REGION'],
            'version' => $_ENV['S3_VERSION'],
            'endpoint' => $_ENV['S3_ENDPOINT'],
            'bucket' => $_ENV['S3_BUCKET'],
        ]
    ],

    'converter' => [
        'currency' => [
            'USD' => [
                'PHP' => '57.14'
            ],
            'RUB' => [
                'PHP' => '0.66'
            ]
        ]
    ],

    'mailer' => [
        'dsn' => $_ENV['MAILER_DSN'],
        'from' => $_ENV['MAILER_FROM'],
    ],

    'redis' => [
        'host' => $_ENV['REDIS_HOST'],
        'port' => $_ENV['REDIS_PORT'],
        'password' => $_ENV['REDIS_PASSWORD'],
    ],

    'trusted_proxies' => [

    ],
];