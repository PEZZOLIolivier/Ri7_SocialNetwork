<?php

namespace Controllers;

class LogoutController {

    public function index() {
        require_once(__DIR__ . '/../views/logout.php');
    }
    public function logout() {
        // Démarrer la session et détruire toutes les données de session
        session_start();
        session_destroy();
        // Rediriger l'utilisateur vers une page de confirmation de déconnexion
        header("Location:/");
        exit();
    }
}
?>
