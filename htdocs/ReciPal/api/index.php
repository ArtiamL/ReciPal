<?php

use controllers\SessionController;
use lib\Database;
use lib\dao\UserDAO;
use lib\models\AuthModel;
use lib\Router;

spl_autoload_register(function ($class)
{
    if (file_exists(__DIR__ . "/../{$class}.php")) {
        error_log(__DIR__ . "/../{$class}.php");
        require_once __DIR__ . "/../{$class}.php";
    }
});

// Create router instance
$router = Router::getRouter();

$db = Database::getInstance();

try {
    $userDAO = new UserDAO($db);
} catch (Exception $e) {
    error_log($e->getMessage());
}

if (isset($userDAO)) {
    $authModel = new AuthModel($userDAO);
    $sessionController = new SessionController($authModel);

    $router->post("/login", [$sessionController, "login"]);
}




$test = new \controllers\TestController("Hi!");

$router->addMiddleware('/admin', [\lib\middlewares\AuthMiddleware::class, 'handle'], ['admin']);

// Register the routes
$router->get('/test', [$test, 'test']);

$router->get("/", function() {
    echo "Hello, world!";
});



// Dispatch the router
$router->dispatch();