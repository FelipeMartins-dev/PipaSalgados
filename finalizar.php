<?php
include 'includes/header.php'; 
require_once 'includes/db.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $usuario_id = 0; 
    
    $nome           = $conn->real_escape_string($_POST['nome']); 
    $telefone       = $conn->real_escape_string($_POST['telefone']);
    $endereco       = $conn->real_escape_string($_POST['endereco']);
    $bairro         = $conn->real_escape_string($_POST['bairro']);
    $cidade         = $conn->real_escape_string($_POST['cidade']);
    $complemento    = $conn->real_escape_string($_POST['complemento']);
    $pagamento      = $conn->real_escape_string($_POST['forma_pagamento']);
    
    $itens_carrinho_json = $_POST['itens_carrinho_json'];
    $itens_carrinho = json_decode($itens_carrinho_json, true);
    
    if (!$itens_carrinho || empty($itens_carrinho)) {
        echo "<script>alert('Erro: Carrinho vazio.'); window.location.href='carrinho.php';</script>";
        exit;
    }

    $total_pedido = 0;
    $observacoes_text = "Cliente: $nome | Telefone: $telefone | Endereço: $endereco, $bairro - $cidade ($complemento)";
    
    foreach ($itens_carrinho as $item) {
        $total_pedido += $item['preco'] * $item['quantidade'];
    }

    $status = "pendente"; 
    
    $itens_salvar = $conn->real_escape_string($itens_carrinho_json); 


    $sql_pedido = "INSERT INTO pedidos (usuario_id, itens, valor_total, endereco, pagamento, observacoes, status)
                   VALUES ($usuario_id, '$itens_salvar', $total_pedido, '$endereco', '$pagamento', '$observacoes_text', '$status')";
    
    if ($conn->query($sql_pedido) === TRUE) {
        $pedido_id = $conn->insert_id;
        
        $mensagem = "Seu pedido #$pedido_id no valor de R$" . number_format($total_pedido, 2, ',', '.') . " foi finalizado com sucesso! Em breve entraremos em contato.";

        echo "<script>
                localStorage.removeItem('carrinho');
                alert('$mensagem');
                window.location.href = 'index.php'; 
              </script>";
        exit;

    } else {
        $mensagem_erro = "Erro ao salvar o pedido. Tente novamente ou entre em contato. Erro: " . $conn->error;
        echo "<script>alert('$mensagem_erro'); window.location.href='checkout.php';</script>";
        exit;
    }
} else {
    
    header("Location: carrinho.php");
    exit;
}

include 'includes/footer.php';
?>