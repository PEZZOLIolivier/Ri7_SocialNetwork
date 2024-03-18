<?php

namespace Models;

require_once 'Database.php';

use PDO;
use PDOException;

class PostDb {
    private $conn;

    private $author;
    private $title;
    private $content;

    public function __construct($db) {
    $this->conn = $db->getConnection();
}

    public function newPost() {

        $database = new Database();
        $postDb = new PostDb($database);
        try {
            $query = "INSERT INTO post (author, title, content) VALUES (:author, :title, :content)";
            $stmt = $this->conn->prepare($query);
    
            $stmt->bindParam(':author', $this->author);
            $stmt->bindParam(':title', $this->title);
            $stmt->bindParam(':content', $this->content);
            $stmt->execute();
    
            return true;
            
        } catch (\PDOException $e) {
            echo "Error adding post: " . $e->getMessage();
            return false;
        }
    }

    public function edit($postId, $newTitle, $newContent, $author) {
        try {
            $query_check = "SELECT * FROM post WHERE id = :postId";
            $stmt_check = $this->conn->prepare($query_check);
            $stmt_check->bindParam(':postId', $postId);
            $stmt_check->execute();
            $post = $stmt_check->fetch(PDO::FETCH_ASSOC);
    
            if (!$post) {
                throw new \PDOException("Le post avec l'ID $postId n'existe pas.");
            }
    
            if ($author !== $post['author']) {
                throw new \PDOException("Vous n'êtes pas autorisé à modifier ce post.");
            }
    
            $query = "UPDATE post SET title = :newTitle, content = :newContent WHERE id = :postId AND author = :author";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':newTitle', $newTitle);
            $stmt->bindParam(':newContent', $newContent);
            $stmt->bindParam(':postId', $postId);
            $stmt->bindParam(':author', $author);
    
            if ($stmt->execute()) {
                return true; 
            } else {
                throw new \PDOException("Erreur lors de la modification du post.");
            }
        } catch (\PDOException $e) {
            echo "Erreur PDO lors de la modification du post: " . $e->getMessage();
            return false;
        }
    }
    

    public function delete($postId) {
        try {
            $query_check = "SELECT * FROM post WHERE id = :postId";
            $stmt_check = $this->conn->prepare($query_check);
            $stmt_check->bindParam(':postId', $postId);
            $stmt_check->execute();
            $post = $stmt_check->fetch(PDO::FETCH_ASSOC);
    
            if (!$post) {
                throw new \PDOException("Le post avec l'ID $postId n'existe pas.");
            }
    
            $query = "DELETE FROM post WHERE id = :postId";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':postId', $postId);
            if ($stmt->execute()) {
                return true;
            } else {
                throw new \PDOException("Erreur lors de la suppression du post.");
            }
        } catch (\PDOException $e) {
            echo "Erreur PDO lors de la suppression du post: " . $e->getMessage();
            return false;
        }
    }
    

    public function getAllPosts() {
        try {
            $query = "SELECT * FROM post ORDER BY id DESC";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $posts;
        } catch (PDOException $e) {
            echo "Erreur lors de la récupération des messages: " . $e->getMessage();
            return false;
        }
    }

    public function getPostById($postId) {
        try {
            $query = "SELECT * FROM post WHERE id = :postId";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':postId', $postId);
            $stmt->execute();
            $post = $stmt->fetch(PDO::FETCH_ASSOC);
            return $post;
        } catch (PDOException $e) {
            echo "Erreur lors de la récupération du post: " . $e->getMessage();
            return false;
        }
    }
    
     public function getAuthor() {
        return $this->author;
    }

    public function setAuthor($author) {
        $this->author = $author;
    }

    public function getTitle() {
        return $this->title;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function getContent() {
        return $this->content;
    }

    public function setContent($content) {
        $this->content = $content;
    }

}