<?php
// backend/routes.php

function processRequest($pdo, $resource, $method, $id, $dados) {
    // Verifica se o recurso é válido
    if ($resource !== 'livros') {
        http_response_code(404);
        echo json_encode(["erro" => "Recurso não encontrado."]);
        exit;
    }

    switch ($method) {
        case 'GET':
            // Ler Livros
            $resultado = readLivros($pdo, $id);
            echo json_encode($resultado);
            break;

        case 'POST':
            // Criar Livro
            if ($id) {
                http_response_code(405);
                echo json_encode(["erro" => "POST não aceita ID na URL."]);
            } else {
                $resultado = createLivro($pdo, $dados);
                echo json_encode($resultado);
            }
            break;

        case 'PUT':
            // Atualizar Livro
            if (!$id) {
                http_response_code(400);
                echo json_encode(["erro" => "ID obrigatório no PUT."]);
                exit;
            }
            // Chama a função de update e retorna o resultado direto
            $resultado = updateLivro($pdo, $id, $dados);
            echo json_encode($resultado);
            break; // <--- O ERRO ESTAVA AQUI (Adicionei o ;)

        case 'DELETE':
            // Deletar Livro
            if (!$id) {
                http_response_code(400);
                echo json_encode(["erro" => "ID obrigatório no DELETE."]);
                exit;
            }
            $resultado = deleteLivro($pdo, $id);
            echo json_encode($resultado);
            break;

        default:
            http_response_code(405);
            echo json_encode(["erro" => "Método não permitido."]);
    }
}
?>