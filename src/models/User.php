<?php

namespace Models;

class User {
    private $conn;
    private $email;
    private $username;
    private $password;

    public function __construct($db) {
        $this->conn = $db->getConnection();
    }

    // Setters
    public function setEmail($email) {
        $this->email = $email;
    }

    public function setUsername($username) {
        $this->username = $username;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    // Getters
    public function getEmail() {
        return $this->email;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getPassword() {
        return $this->password;
    }

    public function register() {
        $query = "INSERT INTO user (email, username, password) VALUES (:email, :username, :password)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':username', $this->username);
        $stmt->bindParam(':password', $this->password);

        if ($stmt->execute()) {
            return true;
        } else {
            printf("Error: %s.\n", $stmt->error);
            return false;
        }
    }

    public function login($username, $password) {
        // Préparez la requête pour sélectionner l'utilisateur avec l'username fourni
        $query = "SELECT * FROM user WHERE username = :username";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $user = $stmt->fetch();
    
        // Vérifiez si un utilisateur a été trouvé avec cet username
        if ($user) {
             // Démarrer une session et stocker l'identifiant de l'utilisateur dans la session
        if ($user && $password === $user['password']) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username']; 
            header("Location:/");
            return true;
            
        } else {
            return false;
        }
        } else {
            // Aucun utilisateur trouvé avec cet username
            return false;
        }
    }

    public function logout() {
        // Démarrer la session et détruire toutes les données de session
        session_start();
        session_destroy();
        // Rediriger l'utilisateur vers une page de confirmation de déconnexion
        header("Location:/main.php");
        exit();
    }
}
?>
