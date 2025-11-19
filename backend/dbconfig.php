<?php
// backend/dbconfig.php

// Configurações
define('DB_HOST', '127.0.0.1');
define('DB_PORT', '3306');
define('DB_NAME', 'bookfy');
define('DB_USER', 'root');
define('DB_PASS', ''); // Senha vazia do XAMPP

// Função que o catalogo.php e a api.php vão chamar
function getDbConnection() {
    try {
        $dsn = "mysql:host=" . DB_HOST . ";port=" . DB_PORT . ";dbname=" . DB_NAME . ";charset=utf8mb4";
        
        $pdo = new PDO($dsn, DB_USER, DB_PASS, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]);
        
        return $pdo;

    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode(["erro" => "Falha na conexão com o banco: " . $e->getMessage()]);
        exit;
    }
}
?>