<?php

namespace Controllers;

use Models\UserDb;
use Models\Database; 

class LoginController {
    public function index() {
        require_once(__DIR__ . '/../views/login.php');
    }

    public function loginUser() {
        
        $database = new Database();

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = $_REQUEST['username'] ?? '';
            $password = $_REQUEST['password'] ?? '';

            if (!empty($username) && !empty($password)) {
                $user = new UserDb($database);

                if ($user->login($username, $password)) {
                    session_start();
                    $_SESSION['username'] = $username;
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
