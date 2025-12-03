<?php include 'includes/header.php'; ?>

<section class="hero" id="inicio">
    <div class="container">
        <h1 class="display-4 fw-bold">Sua festa merece mais sabor e qualidade</h1>
        <p class="lead">Pães e salgados congelados e fritos com fabricação própria e entrega imediata</p>
    </div>
</section>

<header id="sobre" class="py-5">
    <div class="container">

        <div class="row">

            <div class="col">
                <h2>Bem-vindos à Pipa: Onde a Tradição Encontra o Sabor!</h2>
                <p>
                    Na Fábrica de Pães e Salgados Pipa, transformamos ingredientes simples
                    em momentos deliciosos. Somos mais do que uma fábrica; somos a arte de fazer
                    o pão e o salgado perfeitos, com a paixão e o cuidado que só uma empresa
                    que valoriza a tradição e a qualidade pode oferecer.
                </p>
            </div>

            <div class="col-lg-5">
                <img src="style/padaria.png" class="img-fluid rounded-5 shadow">
            </div>

            <div class="col">
                <h2>O que você procura hoje?</h2>
                <p><strong>Pães Congelados</strong> – Do Nosso Forno para o Seu...</p>
                <p><strong>Salgados Congelados</strong> – A Solução Perfeita...</p>
            </div>

        </div>
    </div>
</header>

<main class="py-5">

    <div class="container">
        <h1 class="text-center my-4" id="produtos">Nossos Produtos</h1>

        <div class="row">

            <div class="col-md-4 mb-4" id="salgados">
                <div class="card shadow-lg">
                    <img src="style/salgados.png" class="card-img-top" style="height:14rem;object-fit:cover;">
                    <div class="card-body text-center">
                        <h5 class="card-title">Salgados</h5>
                        <a href="https://wa.me/5517997743007" class="btn btn-pedido">Fazer pedido</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div id="carouselExampleFade" class="carousel slide carousel-dark">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="style/csalgados.jfif" class="d-block w-100">
                        </div>
                        <div class="carousel-item">
                            <img src="style/cpaes.jfif" class="d-block w-100">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-4" id="paes">
                <div class="card shadow-lg">
                    <img src="style/paes.jpg" class="card-img-top" style="height:14rem;object-fit:cover;">
                    <div class="card-body text-center">
                        <h5 class="card-title">Pães</h5>
                        <a href="https://wa.me/5517997743007" class="btn btn-pedido">Fazer pedido</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</main>

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
            <div class="alert alert-warning text-center shadow-sm border-warning mb-5 rounded-4 mx-auto"
                style="max-width: 700px;">
                <h4 class="mb-0 fw-bold text-dark"><i class="bi bi-megaphone-fill"></i> Salgados congelado: <span
                        class="text-danger">R$ 65,00</span> o cento</h4>
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
                                            <div><strong>Calabresa com Cheddar</strong> <small
                                                    class="text-muted d-block">25 unidades</small></div>
                                            <span class="badge bg-danger rounded-pill fs-6">R$ 14,00</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <div><strong>Presunto e Mussarela</strong> <small
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

<?php include 'includes/footer.php'; ?>
