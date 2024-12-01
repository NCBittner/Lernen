<?php

declare(strict_types=1);

namespace ncbittner\lernen;

use ncbittner\lernen\Template\Renderer;

readonly class Controller
{
    public function __construct(
        private Renderer $renderer,
    ) {}

    public function index(): string
    {
        return $this->renderer->render('index');
    }

    public function viewTemplate(string $templateName): string
    {
        return $this->renderer->render($templateName);
    }
}
