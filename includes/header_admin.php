<?php
if (!isset($_SESSION)) {
    session_start();
}
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

<link rel="stylesheet" href="/PipaSalgados/styles.css">
<link rel="icon" type="image/png" href="/PipaSalgados/style/logo.png">

<nav class="navbar bg-body-tertiary fixed-top">
  <div class="container-fluid">
    <img class="navbar-brand" src="/PipaSalgados/style/logo.png" alt="Pipa" style="width: 110px; height: 84px;">
    <a class="navbar-brand fw-bold text-warning" href="#">Pipa Admin</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
      aria-controls="offcanvasNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar"
      aria-labelledby="offcanvasNavbarLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Menu Administrativo</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
      </div>

      <div class="offcanvas-body">

        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">

          <li class="nav-item">
            <a class="nav-link" href="/PipaSalgados/admin/area_admin.php">🏠 Dashboard</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="../admin/pedidos.php">📦 Pedidos</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="../admin/clientes.php">👥 Clientes</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="../admin/produtos.php">📁 Produtos</a>
          </li>

          <li class="nav-item">
            <a class="nav-link text-danger fw-bold" href="/PipaSalgados/admin/logout.php">Sair</a>
          </li>

        </ul>

      </div>
    </div>
  </div>
</nav>

<div class="mt-5"></div> 