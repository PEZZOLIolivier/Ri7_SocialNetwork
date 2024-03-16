<?php

namespace Controllers;


class MainController {
    public function index() {
        // Logique pour afficher la page principale
        require(__DIR__ . "/../views/main.php");
    }
}