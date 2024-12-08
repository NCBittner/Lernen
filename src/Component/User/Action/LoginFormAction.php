<?php

declare(strict_types=1);

namespace NCBittner\Lernen\Component\User\Action;

use NCBittner\Lernen\Architecture\Template\Renderer;

readonly class LoginFormAction
{
    public function __construct(
        private Renderer $renderer,
    ) {}

    public function execute(): string
    {
        return $this->renderer->render('system/login');
    }
}
