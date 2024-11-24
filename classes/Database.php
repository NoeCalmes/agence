<?php

class Database {
    private $host = 'localhost';
    private $dbname = 'agence';
    private $username = 'root';
    private $password = '';
    private $pdo;

    public function connect() {
        if ($this->pdo == null) {
            try {
                $this->pdo = new PDO(
                    "mysql:host={$this->host};dbname={$this->dbname}",
                    $this->username,
                    $this->password
                );
                $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $this->pdo->exec("SET NAMES 'utf8'");
            } catch (PDOException $e) {
                die("Erreur de connexion : " . $e->getMessage());
            }
        }
        return $this->pdo;
    }
}
