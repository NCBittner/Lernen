<?php

declare(strict_types=1);

use ncbittner\lernen\Architecture\Factory\ServiceManagerFactory;
use ncbittner\lernen\Component\User\Action\LoginFormAction;
use ncbittner\lernen\Handler\Blog\IndexHandler;
use ncbittner\lernen\Handler\Blog\ViewPostHandler;
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
    $app->get('/admin/sign-in', LoginFormAction::class);
    $app->get('/{name}', ViewPostHandler::class);

    $app->run();
})();
