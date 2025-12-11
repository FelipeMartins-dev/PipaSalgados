<?php
session_start();

if (!isset($_SESSION["usuario_id"]) || $_SESSION["usuario_tipo"] !== "cliente") {
    header("Location: login.php");
    exit;
}

$nomeCliente = $_SESSION["usuario_nome"];
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Área do Cliente - Pipa Salgados</title>
    <link rel="stylesheet" href="../styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>

<body>

<?php include "../includes/header.php"; ?>

<div class="container mt-5">

    <h2 class="text-center mb-4">
        Bem-vindo, <strong><?= $nomeCliente ?></strong> 👋
    </h2>

    <p class="text-center mb-5 text-muted">
        Escolha uma das opções abaixo para continuar.
    </p>

    <div class="row justify-content-center g-4">

        <!-- Card: Ver Produtos -->
        <div class="col-md-4">
            <div class="card shadow-lg border-0 rounded-4 h-100">
                <div class="card-body text-center d-flex flex-column p-4">
                    <h5 class="card-title mb-3">Ver Produtos</h5>
                    <p class="card-text text-muted mb-4">
                        Veja todos os salgados, pães e doces congelados.
                    </p>
                    <a href="../index.php" class="btn btn-primary rounded-pill px-4 mt-auto">Acessar</a>
                </div>
            </div>
        </div>

        <!-- Card: Meus Pedidos -->
        <div class="col-md-4">
            <div class="card shadow-lg border-0 rounded-4 h-100">
                <div class="card-body text-center d-flex flex-column p-4">
                    <h5 class="card-title mb-3">Meus Pedidos</h5>
                    <p class="card-text text-muted mb-4">
                        Consulte seus pedidos e acompanhe o status das entregas.
                    </p>
                    <a href="meus_pedidos.php" class="btn btn-warning rounded-pill px-4 mt-auto">Ver pedidos</a>
                </div>
            </div>
        </div>

        <!-- Card: Perfil -->
        <div class="col-md-4">
            <div class="card shadow-lg border-0 rounded-4 h-100">
                <div class="card-body text-center d-flex flex-column p-4">
                    <h5 class="card-title mb-3">Meu Perfil</h5>
                    <p class="card-text text-muted mb-4">
                        Atualize seus dados pessoais e informações de contato.
                    </p>
                    <a href="perfil.php" class="btn btn-success rounded-pill px-4 mt-auto">Editar perfil</a>
                </div>
            </div>
        </div>

        <!-- Card: Sair -->
        <div class="col-md-4">
            <div class="card shadow-lg border-0 rounded-4 h-100">
                <div class="card-body text-center d-flex flex-column p-4">
                    <h5 class="card-title mb-3">Sair</h5>
                    <p class="card-text text-muted mb-4">
                        Encerre sua sessão com segurança.
                    </p>
                    <a href="logout.php" class="btn btn-danger rounded-pill px-4 mt-auto">Sair da conta</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include '../includes/footer.php'; ?>

