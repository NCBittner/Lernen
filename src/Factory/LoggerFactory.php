<?php

declare(strict_types=1);

namespace ncbittner\lernen\Factory;

use BlackBonjour\ServiceManager\FactoryInterface;
use Monolog\Handler\StreamHandler;
use Monolog\Level;
use Monolog\Logger;
use Psr\Container\ContainerInterface;

final class LoggerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, string $service, ?array $options = null): Logger
    {
        $logName  = $options['name'] ?? 'application';
        $fileName = sprintf('%s/log/%s.log', ROOT_DIR, $logName);

        $logger = new Logger($logName);
        $logger->pushHandler(new StreamHandler($fileName, Level::Debug));

        return $logger;
    }
}
