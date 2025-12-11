<?php
session_start();
require_once "../includes/db.php";

if (!isset($_GET["id"])) {
    header("Location: produtos.php");
    exit;
}

$id = intval($_GET["id"]);

// Remove o produto
$sql = "DELETE FROM produtos WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    header("Location: produtos.php?deletado=1");
    exit;
} else {
    echo "Erro ao excluir produto.";
}