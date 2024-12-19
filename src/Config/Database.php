<?php
namespace App\Config;

use PDO;
use PDOException;

class Database {
    private string $host = "127.0.0.1";
    private string $db_name = "eventos";
    private string $username = "root";
    private string $password = "root";
    private ?PDO $conn = null;

    public function getConnection(): ?PDO {
        try {
            $this->conn = new PDO(
                "mysql:host={$this->host};dbname={$this->db_name};charset=utf8mb4",
                $this->username,
                $this->password
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Erro na conexão com o banco de dados: " . $e->getMessage());
        }

        return $this->conn;
    }
    
}
