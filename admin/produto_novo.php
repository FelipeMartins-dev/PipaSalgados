<?php
session_start();
require_once "../includes/db.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $nome = $_POST["nome"];
    $descricao = $_POST["descricao"];
    $unidades = $_POST["unidades"];
    $preco = $_POST["preco"];
    $estoque = $_POST["estoque"];
    $categoria = $_POST["categoria"];

    // Upload de imagem
    $imagem = null;

    if (!empty($_FILES["imagem"]["name"])) {
        $nomeArquivo = time() . "_" . $_FILES["imagem"]["name"];
        $caminho = "../uploads/" . $nomeArquivo;
        move_uploaded_file($_FILES["imagem"]["tmp_name"], $caminho);
        $imagem = "uploads/" . $nomeArquivo;
    }

    $sql = "INSERT INTO produtos (nome, descricao, unidades, preco, imagem, estoque, categoria)
            VALUES (?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssidsis", $nome, $descricao, $unidades, $preco, $imagem, $estoque, $categoria);

    if ($stmt->execute()) {
        header("Location: produtos.php?sucesso=1");
        exit;
    }
}
?>

<?php include "../includes/header_admin.php"; ?>
<br><br><!--Mudar essa parte depois-->
<div class="container mt-4">
    <h2>Novo Produto</h2>

    <form method="post" enctype="multipart/form-data" class="mt-3">

        <div class="mb-3">
            <label class="form-label">Nome</label>
            <input type="text" name="nome" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Descrição</label>
            <textarea name="descricao" class="form-control"></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Unidades</label>
            <input type="number" name="unidades" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Preço</label>
            <input type="number" step="0.01" name="preco" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Estoque</label>
            <input type="number" name="estoque" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Categoria</label>
            <select name="categoria" class="form-select" required>
                <option value="Fritos">Fritos</option>
                <option value="Congelados">Congelados</option>
                <option value="Premium">Premium</option>
                <option value=" Pães">Pães</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Imagem</label>
            <input type="file" name="imagem" class="form-control">
        </div>

        <button class="btn btn-success">Salvar</button>
        <a href="produtos.php" class="btn btn-secondary">Voltar</a>
    </form>
</div>
</body>
</html>