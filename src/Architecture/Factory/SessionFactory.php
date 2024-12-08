<?php

declare(strict_types=1);

namespace NCBittner\Lernen\Architecture\Factory;

use Odan\Session\PhpSession;
use Odan\Session\SessionInterface;

final class SessionFactory
{
    public function __invoke(): SessionInterface
    {
        return new PhpSession(
            [
                'lifetime' => 3_600,
                'name'     => 'ncbittner/lernen',
            ],
        );
    }
}
