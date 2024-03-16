<?php

namespace Core;

use Controllers\MainController;
use Controllers\RegisterController;
use Controllers\LoginController;
use Controllers\LogoutController;

require_once __DIR__ . '/../src/controllers/LoginController.php';
require_once __DIR__ . '/../src/controllers/LogoutController.php';

class Router {

    public function start()
    {
        // Capturer l'URI après "/index.php"
        $route = isset($_SERVER['PATH_INFO']) ? trim($_SERVER['PATH_INFO'], '/') : '';

        // Debugging : Afficher la valeur de $route
        // echo $route;

        $controller = null; // Initialisation à null par défaut
        switch ($route) {
            case '':
                $controller = new MainController();
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

        // Vérification si le contrôleur a été initialisé
        if ($controller !== null) {
            // Appeler la méthode index du contrôleur
            $controller->index();
        } else {
            // Gérer le cas où aucune route correspondante n'est trouvée
            echo "404 Not Found";
        }
    }
}
?>
