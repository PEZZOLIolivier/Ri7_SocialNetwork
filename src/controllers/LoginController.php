<?php

namespace Controllers;

use Models\User;
use Models\Database; // Ajout du use statement pour inclure la classe User

class LoginController {
    public function index() {
        require_once(__DIR__ . '/../views/login.php');
    }

    public function loginUser() {
        // Créer une instance de Database
        $database = new Database();

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = $_REQUEST['username'] ?? '';
            $password = $_REQUEST['password'] ?? '';

            // Vérifier si tous les champs sont remplis
            if (!empty($username) && !empty($password)) {
                // Créer une instance de User
                $user = new User($database);

                // Vérifier si l'utilisateur existe dans la base de données
                if ($user->login($username, $password)) {
                    session_start();
                    $_SESSION['username'] = $username;
                    // Utilisateur authentifié, rediriger vers une page de succès ou effectuer d'autres actions
                    echo "User logged in successfully.";
                } else {
                    echo "Invalid username or password.";
                }
            } else {
                echo "Please fill in all the fields in the form.";
            }
        }
    }
}

?>
