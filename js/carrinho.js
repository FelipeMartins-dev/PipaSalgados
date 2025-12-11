// carrinho.js - versão estável e instrumentada
console.log("carrinho.js carregado - versão estável");

// ====================================================================
// UTILITÁRIOS
// ====================================================================
function carregarCarrinho() {
    try {
        let raw = localStorage.getItem("carrinho");
        if (!raw) return [];
        let parsed = JSON.parse(raw);
        // Garantia: deve ser array
        if (!Array.isArray(parsed)) {
            console.warn("carrinho localStorage não era array — convertendo para array vazio");
            return [];
        }
        // Filtra itens inválidos
        return parsed.filter(item => item && typeof item === "object" && !isNaN(parseInt(item.id)) && !isNaN(parseInt(item.quantidade)));
    } catch (e) {
        console.error("Erro ao carregar carrinho:", e);
        return [];
    }
}

function salvarCarrinho(carrinho) {
    try {
        localStorage.setItem("carrinho", JSON.stringify(carrinho));
    } catch (e) {
        console.error("Erro ao salvar carrinho:", e);
    }
}

function updateCartBadge() {
    try {
        let carrinho = carregarCarrinho();
        const badge = document.getElementById("cart-count");
        if (!badge) return;
        let total = carrinho.reduce((soma, item) => soma + (parseInt(item.quantidade) || 0), 0);
        badge.textContent = total;
        badge.style.display = total > 0 ? "inline-block" : "none";
    } catch (e) {
        console.error("Erro updateCartBadge:", e);
    }
}

document.addEventListener("DOMContentLoaded", () => {
    updateCartBadge();
    console.log("updateCartBadge executado ao DOMContentLoaded");
});

// ====================================================================
// FUNÇÕES DE MANIPULAÇÃO DO CARRINHO (ARRAY)
// ====================================================================
function adicionarItemAoCarrinhoLS(id, nome, preco, quantidade) {
    id = Number(id);
    quantidade = parseInt(quantidade) || 1;
    preco = parseFloat(preco) || 0;

    let carrinho = carregarCarrinho();
    let itemExistente = carrinho.find(item => Number(item.id) === id);

    if (itemExistente) {
        itemExistente.quantidade = (parseInt(itemExistente.quantidade) || 0) + quantidade;
    } else {
        carrinho.push({
            id: id,
            nome: nome,
            preco: preco,
            quantidade: quantidade
        });
    }

    salvarCarrinho(carrinho);
    updateCartBadge();
    console.log(`adicionarItemAoCarrinhoLS -> id:${id} nome:${nome} qtd:${quantidade}`);
}

function removerDoCarrinho(id) {
    id = Number(id);
    let carrinho = carregarCarrinho();
    carrinho = carrinho.filter(item => Number(item.id) !== id);
    salvarCarrinho(carrinho);
    updateCartBadge();
    console.log("removerDoCarrinho -> id:", id);
}

function atualizarQuantidade(id, novaQtd) {
    id = Number(id);
    novaQtd = parseInt(novaQtd) || 0;
    let carrinho = carregarCarrinho();
    let item = carrinho.find(p => Number(p.id) === id);
    if (!item) return;
    if (novaQtd <= 0) {
        removerDoCarrinho(id);
    } else {
        item.quantidade = novaQtd;
        salvarCarrinho(carrinho);
        updateCartBadge();
    }
    console.log("atualizarQuantidade -> id:", id, "qtd:", novaQtd);
}

// ====================================================================
// FUNÇÕES LIGADAS AO HTML
// ====================================================================

// incrementa/decrementa o input de quantidade no card (não toca no storage)
function alterarQtdProduto(produtoId, valor) {
    const input = document.getElementById('qtd-' + produtoId);
    if (!input) {
        console.warn("alterarQtdProduto: input não encontrado", produtoId);
        return;
    }
    let qtdAtual = parseInt(input.value) || 1;
    qtdAtual += valor;
    if (qtdAtual < 1) qtdAtual = 1;
    input.value = qtdAtual;
    // não atualiza storage aqui — atualização no storage ocorre quando clicar "Adicionar"
}

// garante que valor do input seja mínimo 1
function atualizarQtdInput(produtoId, inputElement) {
    let qtd = parseInt(inputElement.value);
    if (isNaN(qtd) || qtd < 1) {
        inputElement.value = 1;
    }
}

// adiciona ao carrinho sem redirecionar (usado nos cards)
function adicionarAoCarrinho(produtoId) {
    const input = document.getElementById('qtd-' + produtoId);
    const quantidade = input ? parseInt(input.value) || 1 : 1;

    // pega dados do botão
    const btn = document.querySelector(`[data-produto-id="${produtoId}"]`);
    if (!btn) {
        console.error("adicionarAoCarrinho: botão não encontrado para id", produtoId);
        return;
    }
    const nome = btn.dataset.nome;
    const preco = btn.dataset.preco;

    adicionarItemAoCarrinhoLS(produtoId, nome, preco, quantidade);

    // feedback breve (substitua por toast se quiser)
   console.log(`${quantidade}x ${nome} adicionado ao carrinho.`);
}

// incrementa/decrementa dentro do carrinho (carrinho.php)
function alterarQtdCarrinho(id, delta) {
    let carrinho = carregarCarrinho();
    let item = carrinho.find(p => Number(p.id) === Number(id));
    if (!item) return;
    item.quantidade = (parseInt(item.quantidade) || 0) + delta;
    if (item.quantidade <= 0) {
        removerDoCarrinho(id);
    } else {
        salvarCarrinho(carrinho);
        updateCartBadge();
    }
    if (typeof carregarTabelaCarrinho === "function") carregarTabelaCarrinho();
}

// remove item e recarrega a tabela
function removerCarrinho(id) {
    removerDoCarrinho(id);
    if (typeof carregarTabelaCarrinho === "function") carregarTabelaCarrinho();
}
