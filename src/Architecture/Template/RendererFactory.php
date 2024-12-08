<?php

declare(strict_types=1);

namespace NCBittner\Lernen\Architecture\Template;

use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;
use Psr\Log\LoggerInterface;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

final class RendererFactory
{
    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function __invoke(ContainerInterface $container): Renderer
    {
        $loader      = new FilesystemLoader(TPL_DIR);
        $environment = new Environment($loader);

        return new Renderer(
            environment: $environment,
            logger     : $container->get(LoggerInterface::class),
        );
    }
}
