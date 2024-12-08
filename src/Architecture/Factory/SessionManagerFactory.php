<?php

declare(strict_types=1);

namespace NCBittner\Lernen\Architecture\Factory;

use Odan\Session\SessionInterface;
use Odan\Session\SessionManagerInterface;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;

final class SessionManagerFactory
{
    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function __invoke(ContainerInterface $container): SessionManagerInterface
    {
        return $container->get(SessionInterface::class);
    }
}
