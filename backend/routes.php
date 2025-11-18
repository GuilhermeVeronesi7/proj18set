<?php
function processRequest($pdo, $resource, $method, $id, $dados) {
if ($resource !== 'livros') {
http_response_code(404);
echo json_encode(["erro" => "Recurso não encontrado."]);
exit;
}


switch ($method) {
case 'GET':
$resultado = readLivro($pdo, $id);
echo json_encode($resultado);
break;


case 'POST':
$novo = createLivro($pdo, $dados);
echo json_encode(["id_criado" => $novo]);
break;


case 'PUT':
if (!$id) {
http_response_code(400);
echo json_encode(["erro" => "ID obrigatório no PUT."]);
exit;
}
$ok = updateLivro($pdo, $id, $dados);
echo json_encode(["atualizado" => $ok]);
break

case 'DELETE':
if (!$id) {
http_response_code(400);
echo json_encode(["erro" => "ID obrigatório no DELETE."]);
exit;
}
$ok = deleteLivro($pdo, $id);
echo json_encode(["excluido" => $ok]);
break;


default:
http_response_code(405);
echo json_encode(["erro" => "Método não permitido."]);
}
}
?>
