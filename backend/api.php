<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type");


require 'dbconfig.php';
require 'livros_dao.php';
require 'routes.php';


$method = $_SERVER['REQUEST_METHOD'];
$resource = $_GET['resource'] ?? null;
$id = $_GET['id'] ?? null;


$dados = json_decode(file_get_contents("php://input"), true);
if (!is_array($dados)) $dados = [];


processRequest($pdo, $resource, $method, $id, $dados);
?>
