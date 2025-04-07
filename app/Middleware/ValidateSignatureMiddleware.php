<?php
declare(strict_types=1);

namespace App\Middleware;

use App\Config;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use RuntimeException;
class ValidateSignatureMiddleware implements MiddlewareInterface
{
    public function __construct(
        protected readonly Config $config
    ) {
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $uri = $request->getUri();
        $queryParams = $request->getQueryParams();
        $originalSignature = $queryParams['signature'] ?? '';
        $expiration = (int) ($queryParams['expiration'] ?? 0);

        unset($queryParams['signature']);

        $url = $uri->withQuery(query: http_build_query($queryParams));

        $signature = hash_hmac('sha256', (string) $url, $this->config->get('app_key'));

        if ($expiration <= time() || !hash_equals($signature, $originalSignature))
            throw new RuntimeException('Failed to verify signature');

        return $handler->handle($request);
    }
}