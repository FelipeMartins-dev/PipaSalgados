<?php
session_start();
require_once "../includes/db.php";
require_once "../includes/header_admin.php";

// Impede acesso sem login
if (!isset($_SESSION["usuario_id"]) || $_SESSION["usuario_tipo"] !== "admin") {
    header("Location: ../clientes/login.php");
    exit;
}
/* === TOTAL DE PEDIDOS === */
$sqlPedidos = "SELECT COUNT(*) AS total FROM pedidos";
$totalPedidos = $conn->query($sqlPedidos)->fetch_assoc()["total"];

/* === TOTAL DE CLIENTES === */
$sqlClientes = "SELECT COUNT(*) AS total FROM usuarios WHERE tipo='cliente'";
$totalClientes = $conn->query($sqlClientes)->fetch_assoc()["total"];

/* === TOTAL DE PRODUTOS === */
$sqlProdutos = "SELECT COUNT(*) AS total FROM produtos";
$totalProdutos = $conn->query($sqlProdutos)->fetch_assoc()["total"];

// Consulta quantidade de pedidos
$sqlTotal = "SELECT COUNT(*) AS total FROM pedidos";
$resultTotal = $conn->query($sqlTotal);
$totalPedidos = $resultTotal->fetch_assoc()["total"];

// Lista últimos pedidos (exemplo)
$sqlUltimos = "
    SELECT 
        p.id,
        u.nome AS cliente,
        p.status,
        p.criado_em
    FROM pedidos p
    INNER JOIN usuarios u ON u.id = p.usuario_id
    ORDER BY p.criado_em DESC
    LIMIT 5
";
$resultUltimos = $conn->query($sqlUltimos);
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Área do Administrador | Pipa Salgados</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    

    <style>
        body {
            background: #f5f6fa;
        }
        .card-shadow {
            box-shadow: 0 4px 18px rgba(0, 0, 0, 0.12);
            border-radius: 18px;
        }
    </style>
</head>

<body>

<div class="container py-5">

    <!-- Bem-vindo -->
    <div class="mb-4 text-center">
        <h1 class="fw-bold">Bem-vindo, <?= $_SESSION["usuario_nome"] ?> 👋</h1>
    </div>

    <div class="row g-4">

        <!-- Total de Pedidos -->
        <div class="col-md-4">
            <div class="card card-shadow p-4 text-center">
                <h3 class="fw-bold">Pedidos</h3>
                <p class="display-5 fw-bold text-primary"><?= $totalPedidos ?></p>
                <p class="text-muted">Total de pedidos registrados</p>
            </div>
        </div>

        <!-- Total de Clientes -->
        <div class="col-md-4">
            <div class="card card-shadow p-4 text-center">
                <h3 class="fw-bold">Clientes</h3>
                <p class="display-5 fw-bold text-success"><?= $totalClientes ?></p>
                <p class="text-muted">Clientes cadastrados no sistema</p>
            </div>
        </div>

        <!-- Total de Produtos -->
        <div class="col-md-4">
            <div class="card card-shadow p-4 text-center">
                <h3 class="fw-bold">Produtos</h3>
                <p class="display-5 fw-bold text-warning"><?= $totalProdutos ?></p>
                <p class="text-muted">Produtos disponíveis no catálogo</p>
            </div>
        </div>
        
</div>

    <!-- Últimos pedidos -->
    <div class="mt-5">
        <h3 class="fw-bold">Últimos pedidos</h3>
        <div class="card card-shadow p-3">

            <?php if ($resultUltimos->num_rows > 0): ?>
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Cliente</th>
                            <th>Status</th>
                            <th>Data</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($pedido = $resultUltimos->fetch_assoc()): ?>
                            <tr>
                                <td><?= $pedido["id"] ?></td>
                                <td><?= $pedido["cliente"] ?></td>
                                <td><?= $pedido["status"] ?></td>
                                <td><?= date("d/m/Y H:i", strtotime($pedido["data_pedido"])) ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p class="text-muted text-center m-0">Nenhum pedido encontrado.</p>
            <?php endif; ?>

        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>