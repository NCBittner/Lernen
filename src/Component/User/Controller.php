<?php

declare(strict_types=1);

namespace ncbittner\lernen\Component\User;

use ncbittner\lernen\Component\User\Action\LoginFormAction;

readonly class Controller
{
    public function __construct(
        private LoginFormAction $loginFormAction,
    ) {}

    public function loginForm(): string
    {
        return $this->loginFormAction->execute();
    }
}
