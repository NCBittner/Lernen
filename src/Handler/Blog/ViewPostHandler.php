<?php

declare(strict_types=1);

namespace ncbittner\lernen\Handler\Blog;

use ncbittner\lernen\Component\Blog\Controller;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final readonly class ViewPostHandler
{
    public function __construct(
        private Controller $controller,
    ) {}

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $response->getBody()->write($this->controller->viewPost($args['name'] ?? ''));

        return $response;
    }
}
