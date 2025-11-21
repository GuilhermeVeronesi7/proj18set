<?php
// backend/routes.php

function processRequest($pdo, $resource, $method, $id, $dados) {
    if ($resource !== 'livros') {
        http_response_code(404);
        echo json_encode(["erro" => "Recurso não encontrado."]);
        exit;
    }

    switch ($method) {
        case 'GET':
            // Chama a função de leitura
            $resultado = readLivros($pdo, $id);
            echo json_encode($resultado);
            break;

        case 'POST':
            if ($id) {
                http_response_code(405);
                echo json_encode(["erro" => "POST não aceita ID na URL."]);
            } else {
                $resultado = createLivro($pdo, $dados);
                echo json_encode($resultado);
            }
            break;

        case 'PUT':
            if (!$id) {
                http_response_code(400);
                echo json_encode(["erro" => "ID obrigatório no PUT."]);
            } else {
                $resultado = updateLivro($pdo, $id, $dados);
                echo json_encode($resultado);
            }
            break; // <--- O erro estava aqui (adicionei o ;)

        case 'DELETE':
            if (!$id) {
                http_response_code(400);
                echo json_encode(["erro" => "ID obrigatório no DELETE."]);
            } else {
                $resultado = deleteLivro($pdo, $id);
                echo json_encode($resultado);
            }
            break;

        default:
            http_response_code(405);
            echo json_encode(["erro" => "Método não permitido."]);
    }
}
?>