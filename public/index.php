<?php

session_start();

require_once(__DIR__ . "/../src/models/Database.php");
require_once(__DIR__ . "/../src/models/UserDb.php");
require_once(__DIR__ . "/../src/models/PostDb.php");
require_once(__DIR__ . "/../src/controllers/Controller.php");
require_once(__DIR__ . "/../src/controllers/MainController.php");
require_once(__DIR__ . "/../src/controllers/RegisterController.php");
require_once(__DIR__ . "/../src/controllers/LogoutController.php");
require_once(__DIR__ . "/../core/Router.php");

use Core\Router;

spl_autoload_register(function ($class) {
    $file = __DIR__ . "/../" . str_replace("\\", "/", $class) . ".php";
    if (file_exists($file)) {
        require_once($file);
    }
});

try {    
    $app = new Router();
    $app->start();

    $uri = $_SERVER['REQUEST_URI'];

} catch (PDOException $e) {
    die($e->getMessage());
}

