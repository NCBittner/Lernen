<?php

declare(strict_types=1);

namespace ncbittner\lernen\Handler\User;

use ncbittner\lernen\Component\User\Controller;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final readonly class LoginFormHandler
{
    public function __construct(
        private Controller $controller,
    ) {}

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $response->getBody()->write($this->controller->loginForm());

        return $response;
    }
}
