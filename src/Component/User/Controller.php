<?php

declare(strict_types=1);

namespace NCBittner\Lernen\Component\User;

use NCBittner\Lernen\Component\User\Action\LoginAction;
use NCBittner\Lernen\Component\User\Action\LoginFormAction;
use SensitiveParameter;

readonly class Controller
{
    public function __construct(
        private LoginAction $loginAction,
        private LoginFormAction $loginFormAction,
    ) {}

    public function login(#[SensitiveParameter] $inputPassword): bool
    {
        return $this->loginAction->execute($inputPassword);
    }

    public function loginForm(): string
    {
        return $this->loginFormAction->execute();
    }
}
