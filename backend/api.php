<?php
// backend/api.php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// Trata o preflight OPTIONS
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

// Inclui os arquivos necessários
require_once 'dbconfig.php';
require_once 'livros_dao.php';
require_once 'routes.php';

// --- CORREÇÃO AQUI ---
// Precisamos chamar a função para criar a conexão $pdo
$pdo = getDbConnection();
// ---------------------

$method = $_SERVER['REQUEST_METHOD'];
$resource = $_GET['resource'] ?? null;
$id = $_GET['id'] ?? null;

// Pega o JSON enviado no corpo da requisição
$dados = json_decode(file_get_contents("php://input"), true);
if (!is_array($dados)) $dados = [];

// Agora sim podemos passar o $pdo (que existe!) para a função
processRequest($pdo, $resource, $method, $id, $dados);
?>