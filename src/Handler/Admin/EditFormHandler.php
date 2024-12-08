<?php

declare(strict_types=1);

namespace NCBittner\Lernen\Handler\Admin;

use NCBittner\Lernen\Component\Admin\Controller;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use RuntimeException;

final readonly class EditFormHandler
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
        $response->getBody()->write($this->controller->editForm($args['template'] ?? ''));

        return $response;
    }
}
