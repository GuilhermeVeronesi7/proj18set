<?php
// backend/livros_dao.php

function createLivro($pdo, $dados) {
    if (empty($dados['titulo']) || empty($dados['editora']) || empty($dados['autor'])) {
        http_response_code(400);
        return ["message" => "Dados incompletos."];
    }

    $sql = "INSERT INTO livros (titulo, genero, capa, editora, autor) VALUES (?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        $dados['titulo'],
        $dados['genero'] ?? '',
        $dados['capa'] ?? '',
        $dados['editora'],
        $dados['autor']
    ]);

    http_response_code(201);
    return ["message" => "Livro criado com sucesso.", "id" => $pdo->lastInsertId()];
}

// --- CORREÇÃO AQUI: Nome da função agora é PLURAL (readLivros) ---
function readLivros($pdo, $id = null) {
    if ($id) {
        $stmt = $pdo->prepare("SELECT * FROM livros WHERE id = ?");
        $stmt->execute([$id]);
        $livro = $stmt->fetch();
        if ($livro) return $livro;
        
        http_response_code(404);
        return ["message" => "Livro não encontrado."];
    }

    $stmt = $pdo->query("SELECT * FROM livros ORDER BY id ASC");
    return $stmt->fetchAll();
}

function updateLivro($pdo, $id, $dados) {
    if (!$id) { return ["message" => "ID faltando."]; }

    $sql = "UPDATE livros SET titulo = ?, genero = ?, capa = ?, editora = ?, autor = ? WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        $dados['titulo'],
        $dados['genero'],
        $dados['capa'],
        $dados['editora'],
        $dados['autor'],
        $id
    ]);
    
    return ["message" => "Livro atualizado."];
}

function deleteLivro($pdo, $id) {
    $stmt = $pdo->prepare("DELETE FROM livros WHERE id = ?");
    $stmt->execute([$id]);
    return ["message" => "Livro excluído."];
}
?>