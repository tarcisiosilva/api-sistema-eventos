<?php
namespace App\Controllers;

use App\Models\Evento;
use DateTime; 


class EventoController {
    private Evento $evento;

    public function __construct() {
        $this->evento = new Evento();
    }

    public function criar(array $dados): string {
        
        $startDate = new DateTime($dados['startDate']);
        $endDate = new DateTime($dados['endDate']);

        // Formata a data para o formato desejado
        $formattedstartDate = $startDate->format('Y-m-d H:i');
        $formattedendDate   = $endDate->format('Y-m-d H:i');
        
        $this->evento->titulo = $dados['title'];
        $this->evento->descricao = $dados['description'];
        $this->evento->data_inicio = $formattedstartDate;
        $this->evento->data_fim = $formattedendDate;

        return $this->evento->criar() ? json_encode(["message" => "Evento criado com sucesso!"]) : json_encode(["message" => "Falha ao criar evento."]);
    }

    public function listar(): string {
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($this->evento->listar(), JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        die();
    }

    public function atualizar(array $dados): string {
        $startDate = new DateTime($dados['startDate']);
        $endDate = new DateTime($dados['endDate']);

        // Formata a data para o formato desejado
        $formattedstartDate = $startDate->format('Y-m-d H:i');
        $formattedendDate   = $endDate->format('Y-m-d H:i');

        $this->evento->id = $dados['id'];
        $this->evento->titulo = $dados['title'];
        $this->evento->descricao = $dados['description'];
        $this->evento->data_inicio = $formattedstartDate;
        $this->evento->data_fim = $formattedendDate;

        

        return $this->evento->atualizar() ? json_encode(["message" => "Evento atualizado com sucesso!"]) : json_encode(["message" => "Falha ao atualizar evento."]);
    }

    public function excluir(int $id): string {
        $this->evento->id = $id;
        return $this->evento->excluir() ? json_encode(["message" => "Evento excluído com sucesso!"]) : json_encode(["message" => "Falha ao excluir evento."]);
    }
}
