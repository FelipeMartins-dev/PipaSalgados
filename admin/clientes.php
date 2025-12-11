<?php
require_once "../includes/db.php";
require_once "../includes/header_admin.php";
session_start();

if (!isset($_SESSION["usuario_id"]) || $_SESSION["usuario_tipo"] !== "admin") {
    header("Location: ../clientes/login.php");
    exit;
}

$sql = "SELECT id, nome, email FROM usuarios WHERE tipo='cliente' ORDER BY nome";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Clientes - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-4">
    <h2 class="mb-4">👥 Clientes Cadastrados</h2>

    <table class="table table-hover shadow-sm">
        <thead class="table-primary">
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
        <?php while($c = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $c["id"] ?></td>
                <td><?= $c["nome"] ?></td>
                <td><?= $c["email"] ?></td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</div>

</body>
</html>