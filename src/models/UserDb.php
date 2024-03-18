<?php

namespace Models;

class UserDb {
    private $conn;
    private $email;
    private $username;
    private $password;

    public function __construct($db) {
        $this->conn = $db->getConnection();
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

        $query = "SELECT * FROM user WHERE username = :username";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $user = $stmt->fetch();
    
        if ($user) {
            if ($user && $password === $user['password']) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username']; 
            header("Location:/");
            return true;    
        } else {
            return false;
        }
        } else {
            return false;
        }
    }

    public function logout() {
        session_start();
        session_destroy();
        header("Location:/main.php");
        exit();
    }

    // Getters & Setters
    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getUsername() {
        return $this->username;
    }

    public function setUsername($username) {
        $this->username = $username;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setPassword($password) {
        $this->password = $password;
    }
}

