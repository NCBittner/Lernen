<?php

declare(strict_types=1);

namespace ncbittner\lernen\Component\User\Action;

use Odan\Session\SessionInterface;
use Odan\Session\SessionManagerInterface;

readonly class LoginAction
{
    public function __construct(
        private SessionInterface $session,
        private SessionManagerInterface $sessionManager,
    ) {}
}
