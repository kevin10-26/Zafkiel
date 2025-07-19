<?php

declare(strict_types=1);
// Display errors in development mode
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

use DI\ContainerBuilder;
use FastRoute\Dispatcher;
use FastRoute\RouteCollector;
use Sabre\HTTP\Request;
use Sabre\HTTP\Response;
use Sabre\HTTP\Sapi;
use Zafkiel\Infrastructure\Services\LoggerService;
use Zafkiel\Infrastructure\Services\AuthService;

require __DIR__ . '/../vendor/autoload.php';

// Load environment variables
/** @var \Dotenv\Dotenv $dotenv */
$dotenv = \Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

// Container configuration
$containerBuilder = new ContainerBuilder();
$containerBuilder->addDefinitions(__DIR__ . '/../src/Infrastructure/Config/dependencies.php');
$container = $containerBuilder->build();

// Get logger
$logger = $container->get(LoggerService::class);

// Get JWT session
$auth = $container->get(AuthService::class);

$token = $_SERVER['HTTP_AUTHORIZATION'] ?? null;
if (empty($token)) {
    $authResponse = json_decode($auth->generateAuthToken(1), true);
    $token = $authResponse['token'];
}

if (!empty($token)) {
    if (!$auth->verifyToken($token)->isUserValid()) {
        die;
    } else {
        setcookie('access_token', $token, [
            'expires' => time() + 3600,
            'path' => '/',
            'domain' => 'zafkiel.localhost',
            'secure' => false,
            'httponly' => true,
            'samesite' => 'Strict'
        ]);
    }
}


// Create route dispatcher
$logger->info('Creating dispatcher');
$dispatcher = \FastRoute\simpleDispatcher(function (RouteCollector $r) use ($logger) {
    $logger->info('Inside route definition function');
    $routeDefinition = require __DIR__ . '/../src/Infrastructure/Config/routes.php';
    $routeDefinition($r);
    $logger->info('Route definition executed');
});
$logger->info('Dispatcher created');

// Create request
$request = Sapi::getRequest();

// Get base path
$basePath = '/zafkiel';
$path = parse_url($request->getUrl(), PHP_URL_PATH);

// Subtract basePath from path
$relativePath = $path;
if (strpos($path, $basePath) === 0) {
    $relativePath = substr($path, strlen($basePath));
    if ($relativePath === '') {
        $relativePath = '/';
    }
}

// Request details logging
$logger->info('Request details', [
    'method' => $request->getMethod(),
    'url' => $request->getUrl(),
    'path' => $path,
    'basePath' => $basePath,
    'relativePath' => $relativePath
]);

// Request logging
$logger->info('Request started', [
    'method' => $request->getMethod(),
    'uri' => $request->getUrl(),
    'ip' => $request->getRawServerValue('REMOTE_ADDR') ?? 'unknown'
]);

# die(var_dump(getcwd()));

try {
    // Route dispatching
    $logger->info('Dispatching route');
    $route = $dispatcher->dispatch(
        $request->getMethod(),
        $relativePath
    );
    $logger->info('Route dispatched', ['route' => $route]);

    // Response creation
    $response = new Response();

    switch ($route[0]) {
        case Dispatcher::NOT_FOUND:
            $response->setStatus(404);
            $response->setBody('Not Found - Path: ' . $relativePath);
            break;

        case Dispatcher::METHOD_NOT_ALLOWED:
            $response->setStatus(405);
            $response->setBody('Method Not Allowed');
            break;

        case Dispatcher::FOUND:
            $handler = $route[1];
            $vars = $route[2];
            $logger->info('Route found', [
                'handler' => $handler,
                'vars' => $vars
            ]);

            // Appeler la méthode du contrôleur sans injecter les paramètres
            $controller = $container->get($handler[0]);
            $result = $controller->{$handler[1]}();

            if ($result instanceof Response) {
                $response = $result;
            } else {
                $response->setBody($result);
            }
            break;

        default:
            $response->setStatus(500);
            $response->setBody('Internal Server Error');
    }

    // Response logging
    $logger->info('Request completed', [
        'method' => $request->getMethod(),
        'uri' => $request->getUrl(),
        'status' => $response->getStatus()
    ]);
} catch (\Throwable $e) {
    // Error logging
    $logger->error('Request failed', [
        'method' => $request->getMethod(),
        'uri' => $request->getUrl(),
        'error' => $e->getMessage(),
        'trace' => $e->getTraceAsString()
    ]);

    // Error response creation
    $response = new Response();
    $response->setStatus(500);
    $response->setBody('Internal Server Error: ' . $e->getMessage());
}

// Send response
Sapi::sendResponse($response);
