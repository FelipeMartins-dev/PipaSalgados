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
                    <a class="nav-link" href="/PipaSalgados/index.php#hero-carousel">Início</a>
                </li>

                <li class="nav-item me-3">
                    <a class="nav-link" href="/PipaSalgados/index.php#sobre">Sobre</a>
                </li>

                <li class="nav-item dropdown me-3">
                    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Produtos</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="/PipaSalgados/salgados.php">Salgados</a></li>
                        <li><a class="dropdown-item" href="/PipaSalgados/paes.php">Pães</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="/PipaSalgados/index.php#cardapio">Cardápio</a></li>
                    </ul>
                </li>

                <li class="nav-item me-3">
                    <a class="nav-link" href="/PipaSalgados/index.php#contato">Contato</a>
                </li>

                
        <li class="nav-item me-3">
            <a class="nav-link" href="/PipaSalgados/carrinho.php">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-cart4" viewBox="0 0 16 16">
                    <path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5M3.14 5l.5 2H5V5zM6 5v2h2V5zm3 0v2h2V5zm3 0v2h1.36l.5-2zm1.11 3H12v2h.61zM11 8H9v2h2zM8 8H6v2h2zM5 8H3.89l.5 2H5zm0 5a1 1 0 1 0 0 2 1 1 0 0 0 0-2m-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0m9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2m-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0"/>
                </svg>
            </a>
        </li>
                
        <li class="nav-item dropdown me-3">

            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">

                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                    fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                    <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                    <path fill-rule="evenodd"
                    d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1" />
                </svg>
                
                
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
                    <li><a class="dropdown-item" href="/PipaSalgados/admin/login.php">Entrar como ADM</a></li>
                    <li><a class="dropdown-item" href="/PipaSalgados/clientes/cadastro.php">Criar Conta</a></li>

                <?php endif; ?>

            </ul>
        </li>
        


            </ul>
        </div>
    </div>
</nav>
<script src="/PipaSalgados/js/carrinho.js"></script>
