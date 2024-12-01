<?php

declare(strict_types=1);

namespace ncbittner\lernen\Architecture\Factory;

use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;
use Psr\Log\LoggerInterface;
use Slim\App;
use Slim\Factory\AppFactory;

final class ApplicationFactory
{
    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function __invoke(ContainerInterface $container): App
    {
        AppFactory::setContainer($container);

        $app = AppFactory::create();
        $app->addErrorMiddleware(
            displayErrorDetails: false,
            logErrors          : true,
            logErrorDetails    : true,
            logger             : $container->get(LoggerInterface::class),
        );

        return $app;
    }
}
