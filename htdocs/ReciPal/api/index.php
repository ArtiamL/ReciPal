<?php


use controllers\ErrorController;
use controllers\TestController;
use lib\Router;

require_once __DIR__ . '/../lib/Router.php';
require_once __DIR__ . '/../controllers/ErrorController.php';
require_once __DIR__ . '/../controllers/TestController.php';


$router = new Router();

$test = new TestController("This should only be visible if constructor is called.");

$router->setErrorController([ErrorController::class, 'show404']);
$router->add('GET', '/test/', [$test, 'test']);

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$path = str_ireplace('/ReciPal/api/', '', $path);

$router->dispatch($path);