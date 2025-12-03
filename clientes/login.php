<?php
session_start();
require_once "../includes/db.php";

$erro = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $email = trim($_POST["email"]);
    $senha = trim($_POST["senha"]);

    $sql = "SELECT id, nome, senha, tipo FROM usuarios WHERE email = ? LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows === 1) {
        $user = $resultado->fetch_assoc();

        if ($user["tipo"] !== "cliente") {
            $erro = "Este login é exclusivo para clientes.";
        }
        elseif (password_verify($senha, $user["senha"])) {
            $_SESSION["cliente_id"] = $user["id"];
            $_SESSION["cliente_nome"] = $user["nome"];

            header("Location: area_cliente.php");
            exit;
        } else {
            $erro = "Senha incorreta.";
        }
    } else {
        $erro = "E-mail não encontrado.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login do Cliente | Pipa Salgados</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f5f6fa;
        }
        .login-card {
            max-width: 420px;
            margin: 70px auto;
            padding: 35px;
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.12);
        }
        .login-logo {
            display: block;
            margin: 0 auto 15px auto;
            width: 130px;
        }
    </style>
</head>

<body>

<div class="login-card">

    <img src="../style/logo.png" class="login-logo">

    <h3 class="text-center mb-4">Entrar na Conta</h3>

    <?php if ($erro) : ?>
        <div class="alert alert-danger"><?= $erro ?></div>
    <?php endif; ?>

    <form method="POST">

        <label class="mb-1">E-mail</label>
        <input type="email" name="email" class="form-control mb-3" required>

        <label class="mb-1">Senha</label>
        <input type="password" name="senha" class="form-control mb-4" required>

        <button type="submit" class="btn btn-primary w-100 py-2">
            Entrar
        </button>

    </form>

    <div class="text-center mt-3">
        <small>
            Não tem conta?
            <a href="cadastro.php">Criar conta</a>
        </small>
    </div>

</div>

</body>
</html>
