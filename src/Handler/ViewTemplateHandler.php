<?php

declare(strict_types=1);

namespace ncbittner\lernen\Handler;

use ncbittner\lernen\Controller;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final readonly class ViewTemplateHandler
{
    public function __construct(
        private Controller $controller,
    ) {}

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $response->getBody()->write($this->controller->viewTemplate($args['name'] ?? ''));

        return $response;
    }
}
