<?php

namespace Models;

class Database
{
    private string $host = 'localhost';
    private string $db_name = 'ri7_socialnetwork';
    private string $db_user = 'root';
    private string $db_password = '';

    public function getConnection() {
        $connection = null;

        try {
            $connection = new \PDO("mysql:host={$this->host};dbname={$this->db_name}", $this->db_user, $this->db_password);
            $connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $exception) {
            throw new \PDOException("Connection error: " . $exception->getMessage());
        }

        return $connection;
    }

}

