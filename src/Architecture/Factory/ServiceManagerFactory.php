<?php

declare(strict_types=1);

namespace ncbittner\lernen\Architecture\Factory;

use BlackBonjour\ServiceManager\ServiceManager;

final class ServiceManagerFactory
{
    public function __invoke(): ServiceManager
    {
        $config = require ROOT_DIR . '/config/service-manager.php';

        return new ServiceManager(
            services         : $config['services'],
            factories        : $config['factories'],
            abstractFactories: $config['abstractFactories'],
            invokables       : $config['invokables'],
        );
    }
}
