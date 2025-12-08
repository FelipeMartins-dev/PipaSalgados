<?php
session_start();

if (!isset($_SESSION["cliente_id"])) {
    header("Location: login.php");
    exit;
}

$nomeCliente = $_SESSION["cliente_nome"];
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Área do Cliente - Pipa Salgados</title>
    <link rel="stylesheet" href="../styles.css">

    <link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

</head>
<body>

<?php include "../includes/header.php"; ?>

<div class="container mt-5">

    <h2 class="text-center mb-4">
        Bem-vindo, <strong><?= $nomeCliente ?></strong> 👋
    </h2>

    <p class="text-center mb-4">
        Aqui está sua área exclusiva. O que deseja fazer?
    </p>

    <div class="row justify-content-center g-4">

        <div class="col-md-4">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-body text-center p-4">
                    <h5 class="card-title mb-3">Ver Produtos</h5>
                    <p class="card-text text-muted">Veja todos os salgados e pães disponíveis.</p>
                    <a href="../index.php" class="btn btn-primary rounded-pill px-4">Acessar</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <di
