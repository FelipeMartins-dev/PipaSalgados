<?php
if (!isset($_SESSION)) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pipa - Fábrica de Pães e Salgados Congelados</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

    <link rel="stylesheet" href="/PipaSalgados/styles.css">
    <link rel="icon" type="image/png" href="/PipaSalgados/style/logo.png">
</head>

<body>

<nav class="navbar navbar-expand-lg navbar-glass border-bottom sticky-top shadow-sm">
    <div class="container-fluid">
        <a href="/PipaSalgados/index.php">
            <img class="navbar-brand" src="/PipaSalgados/style/logo.png" alt="Pipa" style="width: 110px; height: 84px;">
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
            <ul class="navbar-nav w-100 nav-fill nav-underline">

                <li class="nav-item me-3">
                    <a class="nav-link active" href="/PipaSalgados/index.php#inicio">Início</a>
                </li>

                <li class="nav-item me-3">
                    <a class="nav-link" href="/PipaSalgados/index.php#sobre">Sobre</a>
                </li>

                <li class="nav-item dropdown me-3">
                    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Produtos</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="/PipaSalgados/produtos.php?categoria=Salgados">Salgados</a></li>
                        <li><a class="dropdown-item" href="/PipaSalgados/produtos.php?categoria=Pães">Pães</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="/PipaSalgados/produtos.php">Todos os Produtos</a></li>
                    </ul>
                </li>

                <li class="nav-item me-3">
                    <a class="nav-link" href="/PipaSalgados/index.php#contato">Contato</a>
                </li>

                
               
        <li class="nav-item dropdown me-3">

            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">

                
                <img src="/PipaSalgados/style/user.png" 
                    style="width: 32px; height: 32px; border-radius: 50%;">
            </a>

            <ul class="dropdown-menu dropdown-menu-end">

                <?php if (isset($_SESSION["cliente_id"])): ?>

                    <li><a class="dropdown-item" href="/PipaSalgados/clientes/area_cliente.php">Área do Cliente</a></li>
                    <li><a class="dropdown-item" href="/PipaSalgados/carrinho.php">Carrinho</a></li>
                    <li><a class="dropdown-item" href="/PipaSalgados/clientes/meus_pedidos.php">Meus Pedidos</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item text-danger" href="/PipaSalgados/clientes/logout.php">Sair</a></li>

                <?php else: ?>

                    <li><a class="dropdown-item" href="/PipaSalgados/clientes/login.php">Entrar</a></li>
                    <li><a class="dropdown-item" href="/PipaSalgados/clientes/cadastro.php">Criar Conta</a></li>

                <?php endif; ?>

            </ul>
        </li>


            </ul>
        </div>
    </div>
</nav>
