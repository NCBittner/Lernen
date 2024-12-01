<?php

declare(strict_types=1);

namespace ncbittner\lernen\Component\User\Action;

use ncbittner\lernen\Architecture\Template\Renderer;

readonly class LoginFormAction
{
    public function __construct(
        private Renderer $renderer,
    ) {}

    public function execute(): string
    {
        return $this->renderer->render('user/login');
    }
}
