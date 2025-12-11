<?php
include 'includes/header.php';
require_once 'includes/db.php'; 

$categorias_salgados = ['Congelados', 'Fritos', 'Premium']; 
$categorias_list = "'" . implode("','", $categorias_salgados) . "'";

$sql = "SELECT id, nome, descricao, preco, categoria, imagem, unidades 
        FROM produtos
        WHERE categoria IN ($categorias_list)
        ORDER BY FIELD(categoria, $categorias_list), nome ASC"; 
        
$result = $conn->query($sql);
$produtos_salgados = $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
?>

<main class="py-5">
    <div class="container">
        
        <h1 class="text-center my-4 display-4">Nosso Cardápio de Salgados</h1>
        <p class="lead text-center mb-5">Selecione seus salgados favoritos. Preparamos o melhor para sua festa ou evento.</p>
        
        <div class="row g-4 justify-content-center">
            
            <?php if (count($produtos_salgados) > 0): ?>
                <?php 
                $categoria_atual = '';
                foreach ($produtos_salgados as $p): 
                    if ($p['categoria'] !== $categoria_atual):
                        $categoria_atual = $p['categoria'];
                ?>
                    <div class="col-12 mt-5 mb-3">
                        <h2 class="border-bottom pb-2 text-primary">
                            <span id="<?= ($categoria_atual === 'Premium') ? 'linha-premium' : '' ?>">
                                <?= ($categoria_atual === 'Premium') ? 'Linha Premium' : ucwords($categoria_atual) ?>
                            </span>
                        </h2>
                    </div>
                <?php
                    endif;
                    
                    $preco_br = number_format($p['preco'], 2, ',', '.'); 
                    $preco_js = number_format($p['preco'], 2, '.', ''); 
                ?>
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                        <div class="card h-100 shadow-sm">
                            <?php
                                $img = !empty($p['imagem']) ? $p['imagem'] : 'style/placeholder.png';
                            ?>
                            <img src="<?= $img ?>" class="card-img-top" alt="<?= htmlspecialchars($p['nome']) ?>"
                                style="height: 200px; object-fit: cover;">

                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title"><?= htmlspecialchars($p['nome']) ?></h5>
                                
                                <p class="card-text mb-3 flex-grow-1"><?= htmlspecialchars($p['descricao']) ?>
                                    <strong>(20g)</strong>
                                </p>
                                
                                <p class="card-text fw-bold mb-3">R$ <span><?= $preco_br ?></span></p>

                                <div class="mt-auto">
                                    <div class="input-group mb-2">
                                        <button class="btn btn-outline-secondary btn-sm" type="button"
                                                onclick="alterarQtdProduto(<?= $p['id'] ?>, -1)">
                                            −
                                        </button>
                                        <input type="number" class="form-control form-control-sm text-center"
                                               value="1" min="1" id="qtd-<?= $p['id'] ?>"
                                               readonly 
                                               style="max-width: 60px;">
                                        <button class="btn btn-outline-secondary btn-sm" type="button"
                                                onclick="alterarQtdProduto(<?= $p['id'] ?>, 1)">
                                            +
                                        </button>
                                    </div>

                                    <button class="btn btn-pedido btn-sm w-100" 
                                            data-produto-id="<?= $p['id'] ?>" 
                                            data-nome="<?= htmlspecialchars($p['nome']) ?>"
                                            data-preco="<?= $preco_js ?>"
                                            onclick="adicionarAoCarrinho(<?= $p['id'] ?>)">
                                        Adicionar ao Carrinho
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-center">Nenhum produto cadastrado nas categorias de salgados. Verifique suas categorias: Congelados, Fritos e Premium.</p>
            <?php endif; ?>
        </div>
        
    </div>
</main>

<?php include 'includes/footer.php'; ?>
<script src="js/carrinho.js?v=<?php echo time(); ?>"></script>