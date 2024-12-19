<?php
use App\Controllers\EventoController;


require_once  '../vendor/autoload.php';


header("Content-Type: application/json");

// Permite requisições de 'http://localhost:3000'
header("Access-Control-Allow-Origin: http://localhost:3000");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");


$method = $_SERVER['REQUEST_METHOD'];
$requestPath = $_SERVER['PATH_INFO'] ?? '/';


function sendResponse($data, $statusCode = 200)
    {
        http_response_code($statusCode);
        echo json_encode($data);
        exit;
    }

try {
    if (!class_exists(EventoController::class)) {
        throw new Exception("Controller não encontrado.", 500);
    }

    $controller = new EventoController();

    

    switch ($method) {
        case 'POST':
            // Captura o corpo da requisição POST
            $rawData = file_get_contents("php://input");
            // Decodifica os dados JSON para um array associativo
            $dados = json_decode($rawData, true); 
            // Verificando se os dados foram recebidos corretamente
            if ($dados && isset($dados['title'], $dados['description'], $dados['startDate'], $dados['endDate'])) {
                sendResponse($controller->criar($dados));
            } else {
                sendResponse(["message" => $dados], 400);
            }
            break;

        case 'GET':
            sendResponse($controller->listar());
            break;

        case 'PUT':
            // Captura o corpo da requisição POST
            $rawData = file_get_contents("php://input");
            // Decodifica os dados JSON para um array associativo
            $dados = json_decode($rawData, true); 
            // Verificando se os dados foram recebidos corretamente
            var_dump($dados);
            sendResponse($controller->atualizar($dados));
            break;

        case 'DELETE':
             // Captura o corpo da requisição POST
             $rawData = file_get_contents("php://input");
             // Decodifica os dados JSON para um array associativo
             $data = json_decode($rawData, true); 
             
            if (!$data) {
                throw new Exception("ID inválido ou não informado.", 400);
            }
            sendResponse($controller->excluir($data['id']));
            break;

        default:
            throw new Exception("Método não permitido.", 405);
    }
} catch (Exception $e) {
    sendResponse(["message" => $e->getMessage()], $e->getCode() ?: 500);
}
