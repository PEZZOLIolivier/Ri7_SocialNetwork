<?php

namespace Controllers;

class LogoutController {

    public function index() {
        require_once(__DIR__ . '/../views/logout.php');
    }
    public function logout() {
        session_start();
        session_destroy();
        header("Location:/");
        exit();
    }
}
?>
