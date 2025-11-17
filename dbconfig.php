<?php
$host = '127.0.0.1';
$port = '3306';
$db = 'meu_catalogo';
$user = 'root';
$pass = 'mysql123';


try {
$pdo = new PDO(
"mysql:host=$host;port=$port;dbname=$db;charset=utf8mb4",
$user,
$pass,
[
PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
]
);
} catch (Exception $e) {
http_response_code(500);
echo json_encode(["erro" => "Falha na conexão com o banco."]);
exit;
}
?>
