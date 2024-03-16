<?php

session_start();

// Import des contrôleurs et des modèles
require_once(__DIR__ . "/../src/models/Database.php");
require_once(__DIR__ . "/../src/models/User.php");
require_once(__DIR__ . "/../src/controllers/Controller.php");
require_once(__DIR__ . "/../src/controllers/MainController.php");
require_once(__DIR__ . "/../src/controllers/RegisterController.php");
require_once(__DIR__ . "/../src/controllers/LogoutController.php");
require_once(__DIR__ . "/../core/Router.php");

use Core\Router;

// Autoloader
spl_autoload_register(function ($class) {
    $file = __DIR__ . "/../" . str_replace("\\", "/", $class) . ".php";
    if (file_exists($file)) {
        require_once($file);
    }
});

try {
    // Création de l'objet router
    $app = new Router();
    // Appel des fonctions de gestion des routes
    $app->start();

    $uri = $_SERVER['REQUEST_URI'];

} catch (PDOException $e) {
    die($e->getMessage());
}

