<?php
include 'includes/header.php';
require_once 'includes/db.php'; 

$ids_destaque = [5, 12, 13];
$ids_list = implode(',', $ids_destaque);


$sql = "SELECT id, nome, descricao, preco, categoria, imagem, unidades 
        FROM produtos
        WHERE id IN ($ids_list)
        ORDER BY FIELD(id, $ids_list)"; 
        
$result = $conn->query($sql);
$produtos_destaque = $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
?>

<section id="hero-carousel">
    <div id="categoryCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#categoryCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#categoryCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#categoryCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner" style="max-height: 500px;">
            
            <div class="carousel-item active">
                <img src="style/coxinhac.png" class="d-block w-100" alt="Salgados Deliciosos" style="object-fit: cover; height: 500px;">
                <div class="carousel-caption d-block text-white" style="background-color: rgba(0, 0, 0, 0.4); border-radius: 5px;">
                    <h1 class="display-4 fw-bold">Nossos Salgados</h1>
                    <p class="lead">Opções congeladas e prontas para fritar. Perfeitas para sua festa!</p>
                    <a href="salgados.php" class="btn btn-warning btn-lg mt-3">Ver Salgados</a>
                </div>
            </div>

            <div class="carousel-item">
                <img src="style/paoc.png" class="d-block w-100" alt="Pães Frescos" style="object-fit: cover; height: 500px;">
                <div class="carousel-caption d-block text-white" style="background-color: rgba(0, 0, 0, 0.4); border-radius: 5px;">
                    <h1 class="display-4 fw-bold">Pães </h1>
                    <p class="lead">Pães congelados, do nosso forno para o seu.</p>
                    <a href="paes.php" class="btn btn-warning btn-lg mt-3">Ver Pães</a>
                </div>
            </div>

            <div class="carousel-item">
                <img src="style/croquetec.png" class="d-block w-100" alt="Produtos Premium" style="object-fit: cover; height: 500px;">
                <div class="carousel-caption d-block text-white" style="background-color: rgba(0, 0, 0, 0.4); border-radius: 5px;">
                    <h1 class="display-4 fw-bold">Linha Premium</h1>
                    <p class="lead">Sabores exclusivos e ingredientes selecionados.</p>
                    <a href="salgados.php#linha-premium" class="btn btn-warning btn-lg mt-3">Conheça o Premium</a>
                </div>
            </div>

        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#categoryCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#categoryCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</section>

<section id="sobre" class="py-5">
    <div class="container">
        <div class="row align-items-center gy-4">
            
            <div class="col-md-4">
                <h2>Nossa Missão: Sabor Sem Limites!</h2>
                <p>Na Pipa Salgados, transformamos a tradição familiar em delícias práticas para o seu dia a dia e seus eventos. Somos a fábrica que entende de festa: da bolinha de queijo crocante ao pão fresquinho, garantimos qualidade e paixão em cada mordida. </p>
                <p class="fw-bold">Nosso foco é dar mais sabor ao seu tempo, com a qualidade que só a fabricação própria oferece!</p>
            </div>
            
            <div class="col-md-4 text-center">
                <img src="style/padaria.png" class="img-fluid rounded-5 shadow" alt="Padaria">
            </div>
            
            <div class="col-md-4">
                <h2> O que você procura hoje?</h2>
                <p><strong>Salgados Congelados & Fritos:</strong></p>
                <p class="small text-muted">A solução perfeita! Escolha entre nossa linha de salgados fritos na hora ou as opções congeladas, prontas para ir direto para sua fritadeira ou forno.</p>
                
                <p class="mt-4"><strong>Pães Congelados:</strong></p>
                <p class="small text-muted">Aquele cheirinho de pão que acabou de sair do forno, sem complicação. Nossos pães são pré-prontos e garantem a mesa mais fresca e saborosa.</p>
            </div>
            
        </div>
    </div>
</section>

<main class="py-5">
    <div class="container">

        <h2 class="text-center my-4">Destaques da Casa</h2>

        <?php if (count($produtos_destaque) > 0): ?>
            <div class="row g-4 justify-content-center">

                <?php foreach ($produtos_destaque as $p): 
                    $preco_br = number_format($p['preco'], 2, ',', '.'); 
                    $preco_js = number_format($p['preco'], 2, '.', ''); 
                ?>
                    <div class="col-12 col-sm-6 col-md-4">
                        <div class="card h-100 shadow-sm">
                            <?php
                                $img = !empty($p['imagem']) ? $p['imagem'] : 'style/placeholder.png';
                            ?>
                            <img src="<?= $img ?>" class="card-img-top" alt="<?= htmlspecialchars($p['nome']) ?>"
                                style="height: 200px; object-fit: cover;">

                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title"><?= htmlspecialchars($p['nome']) ?></h5>
                                
                                <p class="card-text mb-3 flex-grow-1"><?= htmlspecialchars($p['descricao']) ?></p>
                                
                                <p class="card-text fw-bold mb-3">R$ <span id="preco-<?= $p['id'] ?>"><?= $preco_br ?></span></p>

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
                                            onclick="adicionarEIrParaCarrinho(<?= $p['id'] ?>)">
                                        Adicionar ao carrinho
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>

            </div>
        <?php else: ?>
            <p class="text-center">Nenhum destaque encontrado. Verifique os IDs configurados.</p>
        <?php endif; ?>

        <section id="cardapio" class="py-5 bg-pattern">
        <div class="container py-lg-5">
            <div class="text-center mb-5">
                <h5 class="text-danger fw-bold text-uppercase">Nosso Cardápio</h5>
                <h2 class="fw-bold">Escolha seus Favoritos</h2>
            </div>

            <div class="alert alert-warning text-center shadow-sm border-warning mb-5 rounded-4 mx-auto"
                style="max-width: 700px;">
                <h4 class="mb-0 fw-bold text-dark"><i class="bi bi-megaphone-fill"></i> Salgados Fritos: <span
                        class="text-danger">R$ 85,00</span> o cento</h4>
                <small class="text-muted">(Exceto bolinho de bacalhau)</small>
            </div>
            

            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="accordion custom-accordion" id="menuAccordion">

                        <div class="accordion-item mb-3 shadow-sm border-0 rounded-3 overflow-hidden">
                            <h2 class="accordion-header">
                                <button class="accordion-button fw-bold bg-white text-dark" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#cat1">
                                    <span class="me-2"></span> Salgados Tradicionais (Congelados)
                                </button>
                            </h2>
                            <div id="cat1" class="accordion-collapse collapse show" data-bs-parent="#menuAccordion">
                                <div class="accordion-body bg-white">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <div><strong>Bolinha de Queijo</strong> <small class="text-muted d-block">25
                                                    unidades</small></div>
                                            <span class="badge bg-danger rounded-pill fs-6">R$ 14,00</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <div><strong>Bolinho de Milho</strong> <small class="text-muted d-block">25
                                                    unidades</small></div>
                                            <span class="badge bg-danger rounded-pill fs-6">R$ 14,00</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <div><strong>Bolinho de Palmito</strong> <small
                                                    class="text-muted d-block">25 unidades</small></div>
                                            <span class="badge bg-danger rounded-pill fs-6">R$ 14,00</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <div><strong>Coxinha de Carne</strong> <small class="text-muted d-block">25
                                                    unidades</small></div>
                                            <span class="badge bg-danger rounded-pill fs-6">R$ 14,00</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <div><strong>Coxinha de Frango</strong> <small class="text-muted d-block">25
                                                    unidades</small></div>
                                            <span class="badge bg-danger rounded-pill fs-6">R$ 14,00</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item mb-3 shadow-sm border-0 rounded-3 overflow-hidden">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed fw-bold bg-white text-dark" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#cat2">
                                    <span class="me-2"></span> Kibes e Croquetes (Congelados)
                                </button>
                            </h2>
                            <div id="cat2" class="accordion-collapse collapse" data-bs-parent="#menuAccordion">
                                <div class="accordion-body bg-white">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <div><strong>Croquete</strong> <small class="text-muted d-block">25
                                                    unidades</small></div>
                                            <span class="badge bg-danger rounded-pill fs-6">R$ 15,00</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <div><strong>Kibe Tradicional</strong> <small class="text-muted d-block">25
                                                    unidades</small></div>
                                            <span class="badge bg-danger rounded-pill fs-6">R$ 15,00</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <div><strong>Kibe com Coalhada</strong> <small class="text-muted d-block">25
                                                    unidades</small></div>
                                            <span class="badge bg-danger rounded-pill fs-6">R$ 16,00</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item mb-3 shadow-sm border-0 rounded-3 overflow-hidden">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed fw-bold bg-white text-dark" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#cat3">
                                    <span class="me-2"></span> Trouxinhas (Congelados)
                                </button>
                            </h2>
                            <div id="cat3" class="accordion-collapse collapse" data-bs-parent="#menuAccordion">
                                <div class="accordion-body bg-white">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <div><strong>Trouxinha de Carne</strong> <small
                                                    class="text-muted d-block">25 unidades</small></div>
                                            <span class="badge bg-danger rounded-pill fs-6">R$ 14,00</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <div><strong>Trouxinha de Calabresa com Cheddar</strong> <small
                                                    class="text-muted d-block">25 unidades</small></div>
                                            <span class="badge bg-danger rounded-pill fs-6">R$ 14,00</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <div><strong>Trouxinha de Presunto e Mussarela</strong> <small
                                                    class="text-muted d-block">25 unidades</small></div>
                                            <span class="badge bg-danger rounded-pill fs-6">R$ 14,00</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item mb-3 shadow-sm border-0 rounded-3 overflow-hidden">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed fw-bold bg-white text-dark" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#cat4">
                                    <span class="me-2"></span> Linha Premium
                                </button>
                            </h2>
                            <div id="cat4" class="accordion-collapse collapse" data-bs-parent="#menuAccordion">
                                <div class="accordion-body bg-white">
                                    <ul class="list-group list-group-flush">
                                        <li
                                            class="list-group-item d-flex justify-content-between align-items-center bg-warning-subtle">
                                            <div><strong>Bolinho de Bacalhau</strong> <small
                                                    class="text-dark d-block">25 unidades</small></div>
                                            <span class="badge bg-dark rounded-pill fs-6">R$ 30,00</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

    </div>
</main>

<section id="cardapio" class="py-5 bg-pattern">
    <div class="container py-lg-5">
        </div>
</section>

<?php include 'includes/footer.php'; ?>
<script src="js/carrinho.js"></script>