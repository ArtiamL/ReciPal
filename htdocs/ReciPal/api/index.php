<?php

use controllers\SessionController;
use lib\dao\RoleDAO;
use lib\Database;
use lib\dao\UserDAO;
use lib\models\AuthModel;
use lib\Router;

spl_autoload_register(function ($class)
{
    if (file_exists(__DIR__ . "/../{$class}.php")) {
//        error_log(__DIR__ . "/../{$class}.php");
        require_once __DIR__ . "/../{$class}.php";
    }
});

session_start();

// Create router instance
$router = Router::getRouter();

$db = Database::getInstance();

try {
    $userDAO = new UserDAO($db);
    $roleDAO = new RoleDAO($db);
} catch (Exception $e) {
    error_log($e->getMessage());
}

if (isset($userDAO) && isset($roleDAO)) {
    $authModel = new AuthModel($userDAO, $roleDAO);
    $sessionController = new SessionController($authModel);

    $router->post("/login", [$sessionController, "login"]);

    $router->post("/register", [$sessionController, "register"]);

    $router->post("/logout", [$sessionController, "logout"]);

    $router->post('/checkSession', [$sessionController, "checkSession"]);
}

$router->addMiddleware('/admin', [\lib\middlewares\AuthMiddleware::class, 'handle'], ['admin']);

// Register the routes
$router->get("/", function() {
    echo "Hello, world!";
});

error_log("api/index POST: " . var_export($_POST, true));

// Dispatch the router
$router->dispatch();