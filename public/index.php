<?php

/**
 * @author Erick Dyck <info@erickdyck.de>
 * @since  07.03.23
 */

declare(strict_types=1);

use ncbittner\lernen\TemplateRenderer;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Factory\AppFactory;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

(static function (): void {
    // Bootstrap
    define('ROOT_DIR', dirname(__DIR__));

    require_once ROOT_DIR . '/vendor/autoload.php';

    // Load application
    $loader      = new FilesystemLoader(ROOT_DIR . '/template');
    $environment = new Environment($loader);

    $app      = AppFactory::create();
    $renderer = new TemplateRenderer($environment);

    // Add routes
    $app->get(
        '/',
        function (
            ServerRequestInterface $request,
            ResponseInterface $response,
            array $args
        ) use ($renderer): ResponseInterface {
            $response->getBody()->write($renderer->render('index.twig'));

            return $response;
        }
    );

    $app->get(
        '/{name}',
        function (
            ServerRequestInterface $request,
            ResponseInterface $response,
            array $args
        ) use ($renderer): ResponseInterface {
            $response->getBody()->write($renderer->render($args['name'] ?? ''));

            return $response;
        }
    );

    // Run application
    $app->run();
})();
