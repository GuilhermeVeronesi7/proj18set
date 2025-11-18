<?php
function createLivro($pdo, $dados) {
if (!isset($dados['titulo'], $dados['autor'], $dados['genero'])) {
return false;
}


$sql = "INSERT INTO livros (titulo, autor, genero) VALUES (:titulo, :autor, :genero)";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':titulo', $dados['titulo']);
$stmt->bindParam(':autor', $dados['autor']);
$stmt->bindParam(':genero', $dados['genero']);
$stmt->execute();


return $pdo->lastInsertId();
}


function readLivro($pdo, $id = null) {
if ($id) {
$stmt = $pdo->prepare("SELECT * FROM livros WHERE id = ?");
$stmt->execute([$id]);
return $stmt->fetch();
}


$stmt = $pdo->query("SELECT * FROM livros ORDER BY id DESC");
return $stmt->fetchAll();
}


function updateLivro($pdo, $id, $dados) {
if (!isset($dados['titulo'], $dados['autor'], $dados['genero'])) {
return false;
}

$sql = "UPDATE livros SET titulo = :titulo, autor = :autor, genero = :genero WHERE id = :id";


$stmt = $pdo->prepare($sql);
$stmt->bindParam(':titulo', $dados['titulo']);
$stmt->bindParam(':autor', $dados['autor']);
$stmt->bindParam(':genero', $dados['genero']);
$stmt->bindParam(':id', $id);
return $stmt->execute();
}


function deleteLivro($pdo, $id) {
$stmt = $pdo->prepare("DELETE FROM livros WHERE id = ?");
return $stmt->execute([$id]);
}
?>
