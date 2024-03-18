<?php

namespace Controllers;

use Models\Database;
use Models\UserDb;

class RegisterController {
    public function index() {
        require_once(__DIR__ . '/../views/register.php');
    }

    public function registerUser() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email = $_POST['email'] ?? '';
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';

            if (!empty($email) && !empty($username) && !empty($password)) {
                $database = new Database();
                $user = new UserDb($database);

                $user->setEmail($email);
                $user->setUsername($username);
                $user->setPassword($password);

                if ($user->register()) {
                    echo "User registered successfully.";
                } else {
                    echo "User registration failed.";
                }
            } else {
                echo "Veuillez remplir tous les champs du formulaire.";
            }
        }
    }
}

?>
