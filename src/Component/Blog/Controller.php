<?php

declare(strict_types=1);

namespace NCBittner\Lernen\Component\Blog;

use NCBittner\Lernen\Architecture\Template\Renderer;

readonly class Controller
{
    public function __construct(
        private Renderer $renderer,
    ) {}

    public function index(): string
    {
        return $this->renderer->render('index');
    }

    public function viewPost(string $templateName): string
    {
        return $this->renderer->render(sprintf('blog/%', $templateName));
    }
}
