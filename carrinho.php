<?php 
include 'includes/header.php'; 
?>


<main class="py-5">
    <div class="container">
        <h1 class="mb-4">Seu Carrinho de Compras</h1>
        
        <div id="carrinho-vazio" class="alert alert-info text-center" style="display: none;">
            Seu carrinho está vazio. <a href="index.php">Voltar para a loja</a>.
        </div>

        <div id="carrinho-conteudo" style="display: none;">
            <div class="table-responsive mb-4">
                <table class="table table-striped table-hover align-middle">
                    <thead class="table-dark"> <tr>
                            <th scope="col">Produto</th>
                            <th scope="col" class="text-center" style="width: 150px;">Quantidade</th>
                            <th scope="col" class="text-center">Preço Unitário</th>
                            <th scope="col" class="text-center">Subtotal</th>
                            <th scope="col" class="text-center" style="width: 100px;">Ação</th>
                        </tr>
                    </thead>
                    <tbody id="tabela-carrinho-body">
                        </tbody>
                </table>
            </div>

            <div class="row justify-content-end">
                <div class="col-md-5 col-lg-4">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">Resumo do Pedido</h5>
                            <h6>Método de Recebimento: </h6>

                            <div class="recebimento-opcoes">
                                <label>
                                    <input type="radio" name="metodo_recebimento" value="retirada" required>
                                    Retirada no local
                                </label>

                                <label style="margin-left: 15px;">
                                    <input type="radio" name="metodo_recebimento" value="entrega" required>
                                    Entrega no endereço
                                </label>
                            </div>

                            <ul class="list-group list-group-flush mb-3">
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Total:
                                    <span class="fw-bold" id="carrinho-total">R$ 0,00</span>
                                </li>
                            </ul>
                            <a href="checkout.php" class="btn btn-success w-100" id="btn-checkout">
                                Finalizar Pedido
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<script>
    
    function carregarTabelaCarrinho() {
        const carrinho = carregarCarrinho(); 
        const tbody = document.getElementById('tabela-carrinho-body');
        const totalDisplay = document.getElementById('carrinho-total');
        const btnCheckout = document.getElementById('btn-checkout');
        const conteudoDiv = document.getElementById('carrinho-conteudo');
        const vazioDiv = document.getElementById('carrinho-vazio');
        let totalGeral = 0;

        
        tbody.innerHTML = '';

        if (carrinho.length === 0) {
            conteudoDiv.style.display = 'none';
            vazioDiv.style.display = 'block';
            return;
        }

       
        conteudoDiv.style.display = 'block';
        vazioDiv.style.display = 'none';
        btnCheckout.classList.remove('disabled');
        
        carrinho.forEach(item => {
           
            const subtotal = item.preco * item.quantidade;
            totalGeral += subtotal;

            
            const precoFormatado = item.preco.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
            const subtotalFormatado = subtotal.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });

            
            const row = tbody.insertRow();
            
            
            row.insertCell().innerHTML = `<strong>${item.nome}</strong>`;
           
            const cellQtd = row.insertCell();
            cellQtd.className = 'text-center'; 
            cellQtd.innerHTML = `
                <div class="input-group input-group-sm justify-content-center">
                    <button class="btn btn-outline-secondary" type="button"
                            onclick="alterarQtdCarrinho(${item.id}, -1)">
                        −
                    </button>
                    <span class="form-control text-center bg-white fw-bold" style="max-width: 60px;">
                        ${item.quantidade}
                    </span>
                    <button class="btn btn-outline-secondary" type="button"
                            onclick="alterarQtdCarrinho(${item.id}, 1)">
                        +
                    </button>
                </div>
            `;
            
            const cellPreco = row.insertCell();
            cellPreco.className = 'text-center';
            cellPreco.textContent = precoFormatado;
            
            const cellSubtotal = row.insertCell();
            cellSubtotal.className = 'text-center fw-bold';
            cellSubtotal.textContent = subtotalFormatado;
            
            const cellAcao = row.insertCell();
            cellAcao.className = 'text-center';
            cellAcao.innerHTML = `
                <button class="btn btn-outline-danger btn-sm" onclick="removerCarrinho(${item.id})">
                    Remover
                </button>
            `;
        });

        totalDisplay.textContent = totalGeral.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
    }

    document.addEventListener('DOMContentLoaded', carregarTabelaCarrinho);
</script>
<?php include 'includes/footer.php'; ?>