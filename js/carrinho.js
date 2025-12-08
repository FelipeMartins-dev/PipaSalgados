// ====================================================================
// FUNÇÕES DE MANIPULAÇÃO DO CARRINHO (LOCAL STORAGE)
// ====================================================================

// Carrega o carrinho do Local Storage
function carregarCarrinho() {
    let carrinho = localStorage.getItem("carrinho");
    return carrinho ? JSON.parse(carrinho) : [];
}

// Salva o carrinho no Local Storage
function salvarCarrinho(carrinho) {
    localStorage.setItem("carrinho", JSON.stringify(carrinho));
}

/**
 * Adiciona ou atualiza um item no carrinho (Local Storage).
 * @param {number} id - ID do produto.
 * @param {string} nome - Nome do produto.
 * @param {string} preco - Preço unitário do produto (string com ponto decimal).
 * @param {number} quantidade - Quantidade a ser adicionada.
 */
function adicionarItemAoCarrinhoLS(id, nome, preco, quantidade) {
    let carrinho = carregarCarrinho();
    // Apenas converte para float, já que o preço já vem no formato '0.00' do PHP
    let precoFloat = parseFloat(preco); 
    
    let itemExistente = carrinho.find(item => item.id === id);

    if (itemExistente) {
        itemExistente.quantidade += quantidade;
    } else {
        carrinho.push({
            id: id,
            nome: nome,
            preco: precoFloat,
            quantidade: quantidade
        });
    }

    salvarCarrinho(carrinho);
}

// Remove um item completamente do carrinho
function removerDoCarrinho(id) {
    let carrinho = carregarCarrinho();
    carrinho = carrinho.filter(item => item.id !== id);
    salvarCarrinho(carrinho);
}

// Atualiza a quantidade de um item específico no carrinho
function atualizarQuantidade(id, novaQtd) {
    let carrinho = carregarCarrinho();
    let qtdNumerica = parseInt(novaQtd);

    if (qtdNumerica <= 0) {
        removerDoCarrinho(id); // Remove se a quantidade for 0 ou menos
    } else {
        carrinho = carrinho.map(item => {
            if (item.id === id) {
                item.quantidade = qtdNumerica;
            }
            return item;
        });
        salvarCarrinho(carrinho);
    }
}

function alterarQtdProduto(produtoId, valor) {
    const inputQtd = document.getElementById('qtd-' + produtoId);
    let qtdAtual = parseInt(inputQtd.value);

    qtdAtual += valor;
    if (qtdAtual < 1) {
        qtdAtual = 1; 
    }

    inputQtd.value = qtdAtual;
}

function atualizarQtdInput(produtoId, inputElement) {
    let qtd = parseInt(inputElement.value);
    if (isNaN(qtd) || qtd < 1) {
        inputElement.value = 1;
    }
}

function adicionarEIrParaCarrinho(produtoId) {
    const inputQtd = document.getElementById('qtd-' + produtoId);
    const quantidade = parseInt(inputQtd.value);

    if (quantidade <= 0) {
        alert('Por favor, selecione uma quantidade válida para adicionar ao carrinho.');
        return;
    }
    
    const btnAdicionar = document.querySelector(`[data-produto-id="${produtoId}"]`);
    const nome = btnAdicionar.getAttribute('data-nome');
    const preco = btnAdicionar.getAttribute('data-preco'); 

    adicionarItemAoCarrinhoLS(produtoId, nome, preco, quantidade);
    
    window.location.href = 'carrinho.php';
}

function alterarQtdCarrinho(id, delta) {
    let carrinho = carregarCarrinho();
    let item = carrinho.find(p => p.id === id);

    if (!item) return;

    item.quantidade += delta;

    if (item.quantidade <= 0) {
        removerDoCarrinho(id);
    } else {
        atualizarQuantidade(id, item.quantidade);
    }
    
    carregarTabelaCarrinho(); 
}

function removerCarrinho(id) {
    removerDoCarrinho(id);
    carregarTabelaCarrinho(); 
}