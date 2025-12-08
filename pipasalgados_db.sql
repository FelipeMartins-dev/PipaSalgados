-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 08/12/2025 às 14:52
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `pipasalgados_db`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `pedidos`
--

CREATE TABLE `pedidos` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `itens` longtext NOT NULL,
  `valor_total` decimal(10,2) NOT NULL,
  `endereco` text NOT NULL,
  `pagamento` varchar(50) NOT NULL,
  `observacoes` text DEFAULT NULL,
  `status` varchar(20) DEFAULT 'pendente',
  `criado_em` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `produtos`
--

CREATE TABLE `produtos` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `descricao` text DEFAULT NULL,
  `unidades` int(11) NOT NULL,
  `preco` decimal(10,2) NOT NULL,
  `imagem` varchar(255) DEFAULT NULL,
  `estoque` int(11) DEFAULT 0,
  `categoria` enum('Fritos','Congelados','Premium',' Pães') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `produtos`
--

INSERT INTO `produtos` (`id`, `nome`, `descricao`, `unidades`, `preco`, `imagem`, `estoque`, `categoria`) VALUES
(1, 'Bolinha de Queijo', '25 unidades', 25, 14.00, NULL, 1000, 'Congelados'),
(2, 'Bolinho de Milho', '25 unidades', 25, 14.00, NULL, 1000, 'Congelados'),
(3, 'Bolinho de Palmito', '25 unidades', 25, 14.00, NULL, 1000, 'Congelados'),
(4, 'Coxinha de Carne', '25 unidades', 25, 14.00, NULL, 1000, 'Congelados'),
(5, 'Coxinha de Frango', '25 unidades', 25, 14.00, 'style/salgados.png', 1000, 'Congelados'),
(6, 'Croquete', '25 unidades', 25, 15.00, NULL, 1000, 'Congelados'),
(7, 'Kibe Tradicional', '25 unidades', 25, 15.00, NULL, 1000, 'Congelados'),
(8, 'Kibe com Coalhada', '25 unidades', 25, 16.00, NULL, 1000, 'Congelados'),
(9, 'Trouxinha de Carne', '25 unidades', 25, 14.00, NULL, 1000, 'Congelados'),
(10, 'Trouxinha de Calabresa com Cheddar', '25 unidades', 25, 14.00, NULL, 1000, 'Congelados'),
(11, 'Trouxinha de Presunto e Mussarela', '25 unidades', 25, 14.00, NULL, 1000, 'Congelados'),
(12, 'Salgados Fritos Tradicionais', '100 unidades (cento)', 100, 85.00, NULL, 1000, 'Fritos'),
(13, 'Bolinho de Bacalhau', '25 unidades', 25, 30.00, NULL, 1000, 'Premium');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(120) NOT NULL,
  `cpf` varchar(14) NOT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `senha` varchar(255) NOT NULL,
  `tipo` enum('admin','cliente') NOT NULL DEFAULT 'cliente',
  `criado_em` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `cpf`, `telefone`, `senha`, `tipo`, `criado_em`) VALUES
(1, 'FELIPE DE OLIVEIRA MARTINS', 'felps450@gmail.com', '45264476845', '18997286000', '$2y$10$VLKVVCk3eb.UHkOGYol8sOhLsKX4N60NbuqhBLzRhi7uIgya6xKbG', 'cliente', '2025-12-04 12:32:10');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Índices de tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `cpf` (`cpf`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
