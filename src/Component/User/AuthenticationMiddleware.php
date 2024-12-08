<?php

declare(strict_types=1);

namespace NCBittner\Lernen\Component\User;

use Fig\Http\Message\StatusCodeInterface;
use InvalidArgumentException;
use Odan\Session\SessionInterface;
use Odan\Session\SessionManagerInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use RuntimeException;

final readonly class AuthenticationMiddleware implements MiddlewareInterface
{
    public function __construct(
        private ResponseFactoryInterface $responseFactory,
        private SessionInterface $session,
        private SessionManagerInterface $sessionManager,
    ) {}

    /**
     * @throws InvalidArgumentException
     * @throws RuntimeException
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $path = $request->getUri()->getPath();

        if (str_starts_with($path, '/admin') && $path !== '/admin/login') {
            if ($this->sessionManager->isStarted() === false) {
                throw new RuntimeException('No session is started!');
            }

            if ($this->session->has('logged_in') === false) {
                $response = $this->responseFactory->createResponse(StatusCodeInterface::STATUS_FOUND);

                return $response->withHeader('Location', '/admin/login');
            }
        }

        return $handler->handle($request);
    }
}
