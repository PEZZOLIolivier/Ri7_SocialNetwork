<?php

namespace Core;

use Controllers\MainController;
use Controllers\RegisterController;
use Controllers\LoginController;
use Controllers\LogoutController;

require_once __DIR__ . '/../src/controllers/LoginController.php';

class Router {

    public function start()
    {
        $route = isset($_SERVER['PATH_INFO']) ? trim($_SERVER['PATH_INFO'], '/') : '';

        $controller = null;

        switch ($route) {
            case '':
                $controller = new MainController();
                if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == 'addPost') {
                    $controller->addPost();
                    // echo $controller;
                } elseif ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['action']) && $_GET['action'] == 'deletePost') {
                    $controller->deletePost();
                } elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_GET['action']) && $_GET['action'] == 'editPost') {
                    $controller->editPost();
                }
                break;
            case 'register':
                $controller = new RegisterController();
                $controller->registerUser(); // Appeler la méthode registerUser directement pour traiter le formulaire
                break;
            case 'login':
                $controller = new LoginController();
                $controller->loginUser();
                break;
            case 'logout':
                $controller = new LogoutController();
                $controller->logout();
                break; 
        }

        
        if ($controller !== null) {
            $controller->index();
        } else {
            echo "404 Not Found";
        }
    }
}
?>
