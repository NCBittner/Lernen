<?php

declare(strict_types=1);

namespace NCBittner\Lernen\Architecture\Factory;

use BlackBonjour\ServiceManager\ServiceManager;
use NCBittner\Lernen\Component\User\AuthenticationMiddleware;
use Odan\Session\Middleware\SessionStartMiddleware;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Log\LoggerInterface;
use Slim\App;
use Slim\Factory\AppFactory;

final class ApplicationFactory
{
    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function __invoke(ServiceManager $container): App
    {
        $app = AppFactory::create(container: $container);
        $container->addService(ResponseFactoryInterface::class, $app->getResponseFactory());

        // Add middlewares - LIFO
        $app->addMiddleware($container->get(AuthenticationMiddleware::class));
        $app->addMiddleware($container->get(SessionStartMiddleware::class));

        // Add error middleware as last step - to be executed first!
        $app->addErrorMiddleware(
            displayErrorDetails: false,
            logErrors          : true,
            logErrorDetails    : true,
            logger             : $container->get(LoggerInterface::class),
        );

        return $app;
    }
}
