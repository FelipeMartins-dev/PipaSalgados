<?php
session_start();
require_once "../includes/db.php";

// Buscar produtos
$sql = "SELECT * FROM produtos ORDER BY id DESC";
$result = $conn->query($sql);
$produtos = $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
?>

<?php include "../includes/header_admin.php"; ?>
<br><br><br>
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Produtos</h2>
        <a href="produto_novo.php" class="btn btn-primary">+ Novo Produto</a>
    </div>

    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Imagem</th>
                <th>Nome</th>
                <th>Categoria</th>
                <th>Unidades</th>
                <th>Preço</th>
                <th>Estoque</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($produtos as $p): ?>
            <tr>
                <td><?= $p["id"] ?></td>
                <td><img src="../<?= $p["imagem"] ?>" width="60" class="rounded"></td>
                <td><?= $p["nome"] ?></td>
                <td><?= $p["categoria"] ?></td>
                <td><?= $p["unidades"] ?></td>
                <td>R$ <?= number_format($p["preco"], 2, ",", ".") ?></td>
                <td><?= $p["estoque"] ?></td>
                <td>
                    <a href="produto_editar.php?id=<?= $p["id"] ?>" class="btn btn-warning btn-sm">Editar</a>
                    <a href="produto_excluir.php?id=<?= $p["id"] ?>" class="btn btn-danger btn-sm"
                       onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>