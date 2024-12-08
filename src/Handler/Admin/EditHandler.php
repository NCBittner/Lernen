<?php

declare(strict_types=1);

namespace NCBittner\Lernen\Handler\Admin;

use InvalidArgumentException;
use NCBittner\Lernen\Component\Admin\Controller;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final readonly class EditHandler
{
    public function __construct(
        private Controller $controller,
    ) {}

    /**
     * @throws InvalidArgumentException
     */
    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        array $args,
    ): ResponseInterface {
        $content  = $request->getParsedBody()['content'] ?? '';
        $template = $args['template'] ?? '';

        if ($template && $content) {
            $this->controller->edit($template, $content);
        }

        return $response->withHeader('Location', '/admin/');
    }
}
