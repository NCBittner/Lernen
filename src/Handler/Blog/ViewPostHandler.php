<?php

declare(strict_types=1);

namespace NCBittner\Lernen\Handler\Blog;

use NCBittner\Lernen\Component\Blog\Controller;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use RuntimeException;

final readonly class ViewPostHandler
{
    public function __construct(
        private Controller $controller,
    ) {}

    /**
     * @throws RuntimeException
     */
    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        array $args,
    ): ResponseInterface {
        $response->getBody()->write($this->controller->viewPost($args['name'] ?? ''));

        return $response;
    }
}
