<?php

declare(strict_types=1);

namespace NCBittner\Lernen\Handler\Admin;

use NCBittner\Lernen\Component\Admin\Controller;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use RuntimeException;

final readonly class CreateFormHandler
{
    public function __construct(
        private Controller $controller,
    ) {}

    /**
     * @throws RuntimeException
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $response->getBody()->write($this->controller->createForm());

        return $response;
    }
}
