<?php

declare(strict_types=1);

namespace NCBittner\Lernen\Handler\Blog;

use NCBittner\Lernen\Component\Blog\Controller;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final readonly class IndexHandler
{
    public function __construct(
        private Controller $controller,
    ) {}

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $response->getBody()->write($this->controller->index());

        return $response;
    }
}
