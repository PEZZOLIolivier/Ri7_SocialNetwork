<?php

namespace Controllers;

require_once(__DIR__ . "/../../src/models/PostDb.php");
require_once(__DIR__ . "/../../src/models/Database.php");
require_once(__DIR__ . "/../../src/models/UserDb.php");

use Models\Database;
use Models\PostDb;

class MainController {

    public function index() {
        $posts = $this->allPosts(); // Récupérer tous les messages
        require(__DIR__ . "/../views/main.php");
    }

    public function addPost() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $author = $_SESSION['username'] ?? '';
            $title = $_POST['title'] ?? '';
            $content = $_POST['content'] ?? '';
    
            if (!empty($author) && !empty($title) && !empty($content)) {
                $database = new Database();
                $postDb = new PostDb($database);
    
                $postDb->setAuthor($author);
                $postDb->setTitle($title);
                $postDb->setContent($content);
    
                if ($postDb->newPost()) {
                    echo "Post ajouté avec succès";
                } else {
                    echo "Echec lors de l'ajout du post";
                }
            } else {
                echo "Veuillez remplir tous les champs du formulaire.";
            }
        } 
    }
        
    public function editPost() {

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_GET['action']) && $_GET['action'] == 'editPost') {
            $postId = $_POST['id'] ?? '';
            $newTitle = $_POST['title'] ?? '';
            $newContent = $_POST['content'] ?? '';
            $author = $_SESSION['username'] ?? '';
            
            if (!empty($postId) && !empty($newTitle) && !empty($newContent)) {
                $database = new Database();
                $postDb = new PostDb($database);
                
                $post = $postDb->getPostById($postId);
                $originalAuthor = $post['author'] ?? '';
                if ($author === $originalAuthor) {
                    if ($postDb->edit($postId, $newTitle, $newContent, $author)) {
                        echo "Post modifié avec succès.";
                    } else {
                        echo "Erreur lors de l'édition du post.";
                    }
                } else {
                    echo "Vous n'êtes pas autorisé à modifier ce post.";
                }
            } else {
                echo "Veuillez remplir tous les champs du formulaire.";
            }
        } else {
            echo "Méthode de requête incorrecte.";
        }
    }
    
    public function deletePost() {
        if (isset($_GET['postId'])) {
            $postId = $_GET['postId'];
            $database = new Database();
            $postDb = new PostDb($database);
            if ($postDb->delete($postId)) {
                echo "Post supprimé avec succès.";
            } else {
                echo "Erreur lors de la suppression du post.";
            }
            header("Location: index.php");
            exit(); 
        } else {
            echo "ID du post manquant.";
        }
    }
    
    public function allPosts() {
        $database = new Database();
        $postDb = new PostDb($database);
        $posts = $postDb->getAllPosts();
    
        return $posts;
    }
}