<?php
// Permitir acesso de localhost:3000
header("Access-Control-Allow-Origin: http://localhost:3000");

// Permitir métodos GET, POST, PUT, DELETE e OPTIONS
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");

// Permitir cabeçalhos específicos como Content-Type e Authorization
header("Access-Control-Allow-Headers: Content-Type, Authorization");

// Se for uma requisição OPTIONS (preflight), envia uma resposta 200 OK e encerra a execução
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(200);
    exit;
}


require_once "../vendor/autoload.php";
require_once '../src/Router/api.php';
