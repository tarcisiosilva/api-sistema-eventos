<?php

namespace App\Models;
use App\Config\Database;

use PDO;

class Evento {
    private PDO $conn;
    private string $table_name = "eventos";

    public ?int $id = null;
    public string $titulo;
    public string $descricao;
    public string $data_inicio;
    public string $data_fim;
    public ?string $data_criacao = null;
    public ?string $data_edicao = null;
    public bool $ativo = true;

    public function __construct() {
       $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function criar(): bool {
        $query = "INSERT INTO {$this->table_name} (titulo, descricao, data_inicio, data_fim, data_criacao, ativo) VALUES (:titulo, :descricao, :data_inicio, :data_fim, NOW(), 1)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":titulo", $this->titulo);
        $stmt->bindParam(":descricao", $this->descricao);
        $stmt->bindParam(":data_inicio", $this->data_inicio);
        $stmt->bindParam(":data_fim", $this->data_fim);

        return $stmt->execute();
    }

    public function listar(): array {
        $query = "SELECT * FROM {$this->table_name} WHERE ativo = 1 ORDER BY data_inicio ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function atualizar(): bool {
        $query = "UPDATE {$this->table_name} SET titulo = :titulo, descricao = :descricao, data_inicio = :data_inicio, data_fim = :data_fim, data_edicao = NOW() WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":id", $this->id);
        $stmt->bindParam(":titulo", $this->titulo);
        $stmt->bindParam(":descricao", $this->descricao);
        $stmt->bindParam(":data_inicio", $this->data_inicio);
        $stmt->bindParam(":data_fim", $this->data_fim);

        return $stmt->execute();
    }

    public function excluir(): bool {
        $query = "UPDATE {$this->table_name} SET ativo = 0 WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $this->id);

        return $stmt->execute();
    }
}