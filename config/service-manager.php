<?php

declare(strict_types=1);

use BlackBonjour\ServiceManager\AbstractFactory\DynamicFactory;
use BlackBonjour\ServiceManager\AbstractFactory\ReflectionFactory;
use ncbittner\lernen\Factory\ApplicationFactory;
use ncbittner\lernen\Factory\LoggerFactory;
use Psr\Log\LoggerInterface;
use Slim\App;

return [
    'abstractFactories' => [
        DynamicFactory::class,
        ReflectionFactory::class,
    ],
    'factories'         => [
        App::class             => ApplicationFactory::class,
        LoggerInterface::class => LoggerFactory::class,
    ],
    'invokables'        => [],
    'services'          => [],
];
