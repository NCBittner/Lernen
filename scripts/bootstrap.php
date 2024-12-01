<?php

declare(strict_types=1);

use ncbittner\lernen\Factory\ServiceManagerFactory;
use ncbittner\lernen\Handler\IndexHandler;
use ncbittner\lernen\Handler\ViewTemplateHandler;
use Slim\App;

(static function (): void {
    // PHP settings and changing working directory to base path
    require __DIR__ . '/define.php';
    chdir(ROOT_DIR);

    // Autoloader, service manager and application itself
    require ROOT_DIR . '/vendor/autoload.php';

    $serviceManager = (new ServiceManagerFactory())();

    /** @var App $app */
    $app = $serviceManager->get(App::class);

    // Load routes and start application
    $app->get('/', IndexHandler::class);
    $app->get('/{name}', ViewTemplateHandler::class);

    $app->run();
})();
