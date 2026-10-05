<?php
require_once "config/conexao.php";

$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

if (!$id) {
    die("ID inválido.");
}

$stmt = $conn->prepare("DELETE FROM produtos WHERE id = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    header("Location: index.php?mensagem=Produto excluído com sucesso.");
    exit;
}

$stmt->close();
die("Erro ao excluir o produto.");
?>