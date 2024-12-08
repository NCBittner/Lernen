<?php

declare(strict_types=1);

use BlackBonjour\ServiceManager\AbstractFactory\DynamicFactory;
use BlackBonjour\ServiceManager\AbstractFactory\ReflectionFactory;
use NCBittner\Lernen\Architecture\Factory\ApplicationFactory;
use NCBittner\Lernen\Architecture\Factory\LoggerFactory;
use NCBittner\Lernen\Architecture\Factory\SessionFactory;
use NCBittner\Lernen\Architecture\Factory\SessionManagerFactory;
use Odan\Session\SessionInterface;
use Odan\Session\SessionManagerInterface;
use Psr\Log\LoggerInterface;
use Slim\App;

return [
    'abstractFactories' => [
        DynamicFactory::class,
        ReflectionFactory::class,
    ],
    'factories'         => [
        App::class                     => ApplicationFactory::class,
        LoggerInterface::class         => LoggerFactory::class,
        SessionInterface::class        => SessionFactory::class,
        SessionManagerInterface::class => SessionManagerFactory::class,
    ],
    'invokables'        => [],
    'services'          => [],
];
