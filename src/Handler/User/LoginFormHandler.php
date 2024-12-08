<?php

declare(strict_types=1);

namespace NCBittner\Lernen\Handler\User;

use NCBittner\Lernen\Component\User\Controller;
use Odan\Session\SessionInterface;
use Odan\Session\SessionManagerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final readonly class LoginFormHandler
{
    public function __construct(
        private Controller $controller,
        private SessionInterface $session,
    ) {}

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        if ($this->session->has('logged_in')) {
            // User is already logged in
            return $response->withHeader('Location', '/admin/');
        }

        // Render login form
        $response->getBody()->write($this->controller->loginForm());

        return $response;
    }
}
