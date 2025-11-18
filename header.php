<?php
// Caminho base do seu projeto no XAMPP
// Se o projeto está em http://localhost/proj18set/, deixe '/proj18set'
// Se está em http://localhost/, deixe como ''
define('BASE_URL', '/proj18set'); 
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Lora:ital@0;1&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    
    <!-- Link do CSS agora tem um ID para o JS poder trocá-lo -->
    <!-- Usamos o BASE_URL para o caminho funcionar de qualquer página -->
    <link id="theme-style" rel="stylesheet" href="<?= BASE_URL ?>/css/style.css">
    
    <!-- O Título será definido em cada página -->
    <title><?= $pageTitle ?? 'Bookfy' ?></title>
</head>
<body>
    <header> 
        <h1> Bookfy, sua biblioteca online mais completa.</h1>
        <!-- Botão de trocar o tema -->
        <button id="theme-toggle">Mudar Tema</button>
    </header>