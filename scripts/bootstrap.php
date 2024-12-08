<?php

declare(strict_types=1);

use NCBittner\Lernen\Architecture\Factory\ServiceManagerFactory;
use NCBittner\Lernen\Handler\Admin;
use NCBittner\Lernen\Handler\Blog;
use NCBittner\Lernen\Handler\User;
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
    $app->get('/', Blog\IndexHandler::class);
    $app->get('/admin/', Admin\IndexHandler::class);
    $app->get('/admin/create', Admin\CreateFormHandler::class);
    $app->post('/admin/create', Admin\CreateHandler::class);
    $app->get('/admin/delete/{template}', Admin\DeleteHandler::class);
    $app->get('/admin/edit/{template}', Admin\EditFormHandler::class);
    $app->post('/admin/edit/{template}', Admin\EditHandler::class);
    $app->get('/admin/login', User\LoginFormHandler::class);
    $app->post('/admin/login', User\LoginHandler::class);
    $app->get('/{name}', Blog\ViewPostHandler::class);

    $app->run();
})();
