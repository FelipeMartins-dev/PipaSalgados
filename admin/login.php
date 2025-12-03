<?php
session_start();
require_once "../includes/db.php";
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Login - Painel Admin</title>
    <link rel="stylesheet" href="../styles.css">
</head>

<body>
    <div class="login-container">
        <h2>Painel Administrativo</h2>

        <?php
        if (isset($_GET['erro'])) {
            echo "<p style='color:red;'>Usuário ou senha incorretos.</p>";
        }
        ?>

        <form action="login.php" method="POST">
            <input type="email" name="email" placeholder="E-mail" required>
            <input type="password" name="senha" placeholder="Senha" required>
            <button type="submit" name="entrar">Entrar</button>
        </form>
    </div>
</body>
</html>
