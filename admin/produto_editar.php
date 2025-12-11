<?php
session_start();
require_once "../includes/db.php";

if (!isset($_GET["id"])) {
    header("Location: produtos.php");
    exit;
}

$id = intval($_GET["id"]);

// Buscar o produto
$sql = "SELECT * FROM produtos WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$produto = $stmt->get_result()->fetch_assoc();

if (!$produto) {
    die("Produto não encontrado!");
}

// Atualizar produto
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = $_POST["nome"];
    $descricao = $_POST["descricao"];
    $unidades = $_POST["unidades"];
    $preco = $_POST["preco"];
    $estoque = $_POST["estoque"];
    $categoria = $_POST["categoria"];

    $imagem = $produto["imagem"];

    // Se nova imagem enviada
    if (!empty($_FILES["imagem"]["name"])) {
        $nomeArquivo = time() . "_" . $_FILES["imagem"]["name"];
        $caminho = "../uploads/" . $nomeArquivo;

        if (move_uploaded_file($_FILES["imagem"]["tmp_name"], $caminho)) {
            $imagem = "uploads/" . $nomeArquivo;
        }
    }

    $sql = "UPDATE produtos SET nome=?, descricao=?, unidades=?, preco=?, imagem=?, estoque=?, categoria=? 
            WHERE id=?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssidsisi", $nome, $descricao, $unidades, $preco, $imagem, $estoque, $categoria, $id);

    if ($stmt->execute()) {
        header("Location: produtos.php?atualizado=1");
        exit;
    }
}

include "../includes/header_admin.php";
?>
<br><br><!--Mudar essa parte depois-->
<div class="container mt-4">
    <h2>Editar Produto</h2>

    <form method="post" enctype="multipart/form-data" class="mt-3">

        <div class="mb-3">
            <label class="form-label">Nome</label>
            <input type="text" name="nome" value="<?= $produto['nome'] ?>" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Descrição</label>
            <textarea name="descricao" class="form-control"><?= $produto['descricao'] ?></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Unidades</label>
            <input type="number" name="unidades" value="<?= $produto['unidades'] ?>" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Preço</label>
            <input type="number" step="0.01" name="preco" value="<?= $produto['preco'] ?>" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Estoque</label>
            <input type="number" name="estoque" value="<?= $produto['estoque'] ?>" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Categoria</label>
            <select name="categoria" class="form-select" required>
                <option value="Fritos" <?= $produto['categoria'] == "Fritos" ? "selected" : "" ?>>Fritos</option>
                <option value="Congelados" <?= $produto['categoria'] == "Congelados" ? "selected" : "" ?>>Congelados</option>
                <option value="Premium" <?= $produto['categoria'] == "Premium" ? "selected" : "" ?>>Premium</option>
                <option value=" Pães" <?= $produto['categoria'] == " Pães" ? "selected" : "" ?>>Pães</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Imagem Atual</label><br>
            <img src="../<?= $produto['imagem'] ?>" width="120" class="rounded border mb-2">
        </div>

        <div class="mb-3">
            <label class="form-label">Nova Imagem (opcional)</label>
            <input type="file" name="imagem" class="form-control">
        </div>

        <button class="btn btn-success">Salvar Alterações</button>
        <a href="produtos.php" class="btn btn-secondary">Voltar</a>
    </form>
</div>

</body>
</html>