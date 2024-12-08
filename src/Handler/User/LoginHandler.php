<?php

declare(strict_types=1);

namespace NCBittner\Lernen\Handler\User;

use NCBittner\Lernen\Component\User\Controller;
use Odan\Session\SessionInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final readonly class LoginHandler
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

        $inputPassword = trim($request->getParsedBody()['password'] ?? '') ?: null;

        if ($inputPassword && $this->controller->login($inputPassword)) {
            // Successful log-in - redirect to admin index page
            return $response->withHeader('Location', '/admin/');
        }

        // Log-in failed or no password given - redirect to log-in form
        return $response->withHeader('Location', '/admin/login');
    }
}
