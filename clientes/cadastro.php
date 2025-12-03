<?php
require_once "../includes/db.php";

$erro = "";
$sucesso = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $nome = trim($_POST["nome"]);
    $email = trim($_POST["email"]);
    $cpf = trim($_POST["cpf"]);
    $telefone = trim($_POST["telefone"]);
    $senha = trim($_POST["senha"]);
    $confirmar = trim($_POST["confirmar"]);

    if (!$nome || !$email || !$cpf || !$telefone || !$senha) {
        $erro = "Preencha todos os campos.";
    }
    elseif ($senha !== $confirmar) {
        $erro = "As senhas não coincidem.";
    }
    else {
        $sql = "SELECT id FROM usuarios WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $erro = "Este e-mail já está cadastrado.";
        } else {

            $hash = password_hash($senha, PASSWORD_DEFAULT);

            $sql = "INSERT INTO usuarios (nome, email, cpf, telefone, senha, tipo)
                    VALUES (?, ?, ?, ?, ?, 'cliente')";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssss", $nome, $email, $cpf, $telefone, $hash);

            if ($stmt->execute()) {
                $sucesso = "Cadastro realizado com sucesso!";
            } else {
                $erro = "Erro ao cadastrar. Tente novamente.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Conta | Pipa Salgados</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f5f6fa;
        }
        .register-card {
            max-width: 460px;
            margin: 50px auto;
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

<div class="register-card">

    <img src="../style/logo.png" class="login-logo">

    <h3 class="text-center mb-4">Criar Conta</h3>

    <?php if ($erro): ?>
        <div class="alert alert-danger"><?= $erro ?></div>
    <?php endif; ?>

    <?php if ($sucesso): ?>
        <div class="alert alert-success"><?= $sucesso ?></div>
        <div class="text-center mt-2 mb-3">
            <a href="login.php" class="btn btn-primary w-100">Ir para Login</a>
        </div>
    <?php else: ?>

    <form method="POST">

        <label>Nome completo</label>
        <input type="text" name="nome" class="form-control mb-3" required>

        <label>E-mail</label>
        <input type="email" name="email" class="form-control mb-3" required>

        <label>CPF</label>
        <input type="text" name="cpf" class="form-control mb-3" required>

        <label>Telefone</label>
        <input type="text" name="telefone" class="form-control mb-3" required>

        <label>Senha</label>
        <input type="password" name="senha" class="form-control mb-3" required>

        <label>Confirmar senha</label>
        <input type="password" name="confirmar" class="form-control mb-4" required>

        <button type="submit" class="btn btn-success w-100 py-2">
            Criar Conta
        </button>

    </form>

    <?php endif; ?>

    <div class="text-center mt-3">
        <small>
            Já tem uma conta?
            <a href="login.php">Fazer login</a>
        </small>
    </div>

</div>

</body>
</html>
