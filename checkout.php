<?php 
include 'includes/header.php'; 
?>

<main class="py-5">
    <div class="container">
        <h1 class="mb-4">Finalizar Pedido via WhatsApp</h1>

        <div id="form-finalizar-pedido"> 
            <div class="row">
                
                <div class="col-lg-7 mb-4">
                    <h2>1. Seus Dados</h2>
                    <div class="card p-4 shadow-sm">
                        
                        <div class="mb-3">
                            <label for="nome" class="form-label">Nome Completo</label>
                            <input type="text" class="form-control" id="nome" required>
                        </div>

                        <div class="mb-3">
                            <label for="telefone" class="form-label">Telefone (WhatsApp)</label>
                            <input type="tel" class="form-control" id="telefone" placeholder="(99) 99999-9999" required>
                        </div>
                        
                        <h5 class="mt-4">Endereço de Entrega</h5>
                        <div class="mb-3">
                            <label for="endereco" class="form-label">Rua e Número</label>
                            <input type="text" class="form-control" id="endereco" required>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="bairro" class="form-label">Bairro</label>
                                <input type="text" class="form-control" id="bairro" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="cidade" class="form-label">Cidade / Estado</label>
                                <input type="text" class="form-control" id="cidade" value="[Sua Cidade/UF]" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="complemento" class="form-label">Complemento (Apto, Referência)</label>
                            <input type="text" class="form-control" id="complemento">
                        </div>
                        
                    </div>
                </div>

                <div class="col-lg-5 mb-4">
                    <h2>2. Resumo e Pagamento</h2>
                    <div class="card p-4 shadow-sm " style="top: 20px;">
                        <h5 class="card-title">Itens do Carrinho</h5>
                        <ul class="list-group list-group-flush mb-3" id="resumo-carrinho-lista">
                            </ul>
                        
                        <div class="mb-4">
                            <label for="forma_pagamento" class="form-label">Forma de Pagamento</label>
                            <select class="form-select" id="forma_pagamento" required>
                                <option value="">Selecione...</option>
                                <option value="Pix">Pix</option>
                                <option value="Cartão">Cartão de Crédito/Débito</option>
                                <option value="Dinheiro">Dinheiro</option>
                            </select>
                        </div>
                        
                        <button type="button" class="btn btn-success btn-lg w-100" onclick="gerarLinkWhatsApp()">
                            Enviar Pedido via WhatsApp
                        </button>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
    const WHATSAPP_NUMBER = "5517991154913"; 

    let totalGeral = 0; 

    document.addEventListener('DOMContentLoaded', () => {
        const carrinho = carregarCarrinho(); 
        const listaResumo = document.getElementById('resumo-carrinho-lista');

        if (carrinho.length === 0) {
            alert('Seu carrinho está vazio. Redirecionando...');
            window.location.href = 'produtos.php';
            return;
        }

        listaResumo.innerHTML = '';
        totalGeral = 0; 

        carrinho.forEach(item => {
            const subtotal = item.preco * item.quantidade;
            totalGeral += subtotal;
            const subtotalFormatado = subtotal.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });

            const li = document.createElement('li');
            li.className = 'list-group-item d-flex justify-content-between';
            li.innerHTML = `
                <span class="text-muted">${item.quantidade}x ${item.nome}</span>
                <strong>${subtotalFormatado}</strong>
            `;
            listaResumo.appendChild(li);
        });

        const liTotal = document.createElement('li');
        liTotal.className = 'list-group-item d-flex justify-content-between align-items-center fw-bold';
        liTotal.innerHTML = `
            Total do Pedido:
            <span class="text-success" id="total-final">${totalGeral.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' })}</span>
        `;
        listaResumo.appendChild(liTotal);
        
        const telInput = document.getElementById('telefone');
        if (telInput) {
            telInput.addEventListener('input', (e) => {
                let value = e.target.value.replace(/\D/g, "");
                let formatted = '';
                if (value.length > 0) formatted += `(${value.substring(0, 2)}`;
                if (value.length > 2) formatted += `) ${value.substring(2, 7)}`;
                if (value.length > 7) formatted += `-${value.substring(7, 11)}`;
                e.target.value = formatted;
            });
        }
    });

    function gerarLinkWhatsApp() {
        const nome = document.getElementById('nome').value;
        const telefone = document.getElementById('telefone').value;
        const endereco = document.getElementById('endereco').value;
        const bairro = document.getElementById('bairro').value;
        const cidade = document.getElementById('cidade').value;
        const complemento = document.getElementById('complemento').value;
        const pagamento = document.getElementById('forma_pagamento').value;
        const carrinho = carregarCarrinho();
        
        if (!nome || !telefone || !endereco || !bairro || !pagamento) {
            alert('Por favor, preencha todos os campos obrigatórios (Nome, Telefone, Endereço, Bairro e Pagamento).');
            return;
        }

        let resumoItens = "";
        carrinho.forEach(item => {
            resumoItens += `* ${item.quantidade}x ${item.nome} (R$ ${item.preco.toFixed(2).replace('.', ',')})\n`;
        });
        
        const totalFormatado = totalGeral.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });

        let mensagem = `
Olá, gostaria de fazer um pedido!

*--- ITENS DO PEDIDO ---*
${resumoItens}
*TOTAL GERAL:* ${totalFormatado}

*--- DADOS DE ENTREGA ---*
*Nome:* ${nome}
*Telefone:* ${telefone}
*Endereço:* ${endereco}, ${bairro}, ${cidade}
*Complemento:* ${complemento || 'N/A'}

*--- PAGAMENTO ---*
*Forma de Pagamento:* ${pagamento}
        `;

        const mensagemCodificada = encodeURIComponent(mensagem);

        const link = `https://api.whatsapp.com/send?phone=${WHATSAPP_NUMBER}&text=${mensagemCodificada}`;
        
        localStorage.removeItem('carrinho');
        
        window.open(link, '_blank');
        
        setTimeout(() => {
             window.location.href = 'index.php';
        }, 1000); 
    }
</script>

<?php include 'includes/footer.php'; ?>
<script src="js/carrinho.js?v=<?php echo time(); ?>"></script>