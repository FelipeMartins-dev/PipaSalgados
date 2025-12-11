<?php
require_once "../includes/db.php";
require_once "../includes/header_admin.php";
session_start();

// Apenas admin pode acessar
if (!isset($_SESSION["usuario_id"]) || $_SESSION["usuario_tipo"] !== "admin") {
    header("Location: ../clientes/login.php");
    exit;
}

// Buscar todos os pedidos
$sql = "SELECT p.id, p.itens, p.valor_total, p.status, p.criado_em, u.nome AS cliente
        FROM pedidos p
        LEFT JOIN usuarios u ON p.usuario_id = u.id
        ORDER BY p.criado_em DESC";

$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Pedidos - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-4">
    <h2 class="mb-4">📦 Pedidos Realizados</h2>

    <table class="table table-striped table-hover shadow-sm">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Cliente</th>
                <th>Valor</th>
                <th>Status</th>
                <th>Data</th>
            </tr>
        </thead>
        <tbody>
        <?php while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $row["id"] ?></td>
                <td><?= $row["cliente"] ?: "Não identificado" ?></td>
                <td>R$ <?= number_format($row["valor_total"], 2, ",", ".") ?></td>
                <td><?= ucfirst($row["status"]) ?></td>
                <td><?= date("d/m/Y H:i", strtotime($row["criado_em"])) ?></td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</div>

</body>
</html>