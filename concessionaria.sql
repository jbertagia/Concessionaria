-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 09/06/2025 às 01:18
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
-- Banco de dados: `concessionaria`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `imagens_veiculo`
--

CREATE TABLE `imagens_veiculo` (
  `id` int(11) NOT NULL,
  `veiculo_id` int(11) NOT NULL,
  `nome_arquivo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `pagamentos`
--

CREATE TABLE `pagamentos` (
  `id` int(11) NOT NULL,
  `veiculo_id` int(11) NOT NULL,
  `comprador_id` int(11) NOT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `endereco` text DEFAULT NULL,
  `cpf` varchar(11) DEFAULT NULL,
  `forma_pagamento` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `pagamentos`
--

INSERT INTO `pagamentos` (`id`, `veiculo_id`, `comprador_id`, `nome`, `endereco`, `cpf`, `forma_pagamento`) VALUES
(1, 13, 6, 'Jose Aldo', 'Rua Joaquina 456, Rio de Janeiro', '12345678900', 'Débito'),
(2, 24, 7, 'Luciano Almeida', 'Rua castro 98, Agua Verde - Curitiba/PR', '23245487601', 'Cartão de Crédito Parcelado'),
(3, 12, 7, 'João Paulo', 'R Jovino do Rosario 987', '12332212332', 'Dinheiro'),
(4, 13, 7, 'Luciano Almeida', 'Rua Artigas 999', '32112332145', 'Crédito à Vista'),
(5, 11, 7, 'teste', 'teste', '12312312322', 'Dinheiro'),
(6, 17, 7, 'Luciano Almeida', 'Rua dos Cravinhos 4356, Souza Naves', '12332112323', 'Crédito à Vista'),
(7, 29, 8, 'Jhonny Cage', 'Julliius Street 4th, Central Park', '12332112332', 'Dinheiro'),
(8, 14, 8, 'Jhonny Cage', 'Qualquer Lugar', '12312312333', 'Boleto');

-- --------------------------------------------------------

--
-- Estrutura para tabela `solicitacoes`
--

CREATE TABLE `solicitacoes` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `marca` varchar(50) NOT NULL,
  `modelo` varchar(50) NOT NULL,
  `nome_peca` varchar(100) NOT NULL,
  `tipo_peca` enum('nova','remanufaturada') NOT NULL,
  `data_solicitacao` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `solicitacoes`
--

INSERT INTO `solicitacoes` (`id`, `usuario_id`, `marca`, `modelo`, `nome_peca`, `tipo_peca`, `data_solicitacao`) VALUES
(5, 7, 'BMW', 'i40', 'Manopla de Cambio', 'remanufaturada', '2025-05-23 22:54:46'),
(11, 7, 'Toyota', 'Camry', 'embea traseiro', 'nova', '2025-05-24 01:09:21'),
(12, 7, 'BMW', 'i35', 'motor', 'nova', '2025-05-24 01:10:04'),
(13, 7, 'BYD', 'Yangwang', 'jogo de rodas', 'nova', '2025-05-26 10:04:41'),
(14, 6, 'BMW', 'i4 elétrica', 'Jogo de Rodas', 'nova', '2025-05-28 09:35:00');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(30) NOT NULL,
  `login` varchar(30) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `dtnasc` date NOT NULL,
  `bloqueado` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `login`, `senha`, `dtnasc`, `bloqueado`) VALUES
(1, 'Administrador', 'administrador', '$2y$10$qNaE9ZTp418Z5RTVV8Ytsec5lxaqMUwchZOmOO7tZ8Rs.8npXkl.2', '1500-03-31', 0),
(3, 'Carlos Silva', 'carlos', '$2y$10$S8zE9PEZ8ExGcvKnvPM1ceqPuV2rT9W8/0QolWOMz9K96DxOEXlfe', '1990-05-12', 1),
(4, 'Juliana Ramos', 'juliana', '$2y$10$KqQxYlybEbBb78ZB8c4VAu7AsUqpMvlRwU41Tk6oQXgmA3bG1qOYO', '1993-08-27', 0),
(5, 'Thiago Costa', 'thiago', '$2y$10$vdf9WU8rCs6EvR2O35727ee4hSpjwX9hjrp9z.0LA7CWY9b8wfdzm', '1995-02-19', 0),
(6, 'Jose Aldo', 'jose', '$2y$10$9LqYeZBCIL0GPR70mwQF1emuPtMSpS8cwEAdpdVXdc1q5H0Aqyb4q', '2015-05-01', 0),
(7, 'Luciano Almeida', 'lulu', '$2y$10$iMnraefz9j0GLHPoQGNvXOkvX/JQQ3EQ02ZZqXDTvt0NUbsp9pu.e', '2006-08-09', 0),
(8, 'Jhonny Cage', 'jcage', '$2y$10$1kDhg/IAkzAPaEzCmrIviOsj4SysL853yidSw2k/TrAOmQDJdzFZm', '2003-02-01', 0),
(9, 'João Paulo Bertagia', 'jbertagia', '$2y$10$MJy1pjOvoejjYqGoeXIHZOpOjZumdNpYT8GjfR2CeMWXbLfPBDyqq', '1989-03-31', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `veiculos`
--

CREATE TABLE `veiculos` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `tipo` enum('Novo','Usado') NOT NULL,
  `marca` varchar(50) NOT NULL,
  `modelo` varchar(50) NOT NULL,
  `ano` int(11) NOT NULL,
  `cor` varchar(30) NOT NULL,
  `portas` int(11) NOT NULL,
  `preco` decimal(10,2) NOT NULL,
  `cidade` varchar(50) NOT NULL,
  `imagem` varchar(255) DEFAULT NULL,
  `vendido` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `veiculos`
--

INSERT INTO `veiculos` (`id`, `usuario_id`, `tipo`, `marca`, `modelo`, `ano`, `cor`, `portas`, `preco`, `cidade`, `imagem`, `vendido`) VALUES
(1, 1, 'Novo', 'Toyota', 'Corolla', 2024, 'Preto', 4, 155000.00, 'São Paulo', 'corollaPreto.png', 0),
(2, 1, 'Novo', 'Honda', 'Civic', 2024, 'Prata', 4, 150000.00, 'Curitiba', 'civicPrata.png', 0),
(3, 1, 'Novo', 'Volkswagen', 'T-Cross', 2024, 'Branco', 4, 135000.00, 'Florianópolis', 'trossBranca.jpg', 0),
(4, 1, 'Novo', 'Chevrolet', 'Onix', 2024, 'Cinza', 4, 98000.00, 'Porto Alegre', 'onixCinza.png', 0),
(5, 1, 'Novo', 'Hyundai', 'Creta', 2024, 'Vermelho', 4, 122000.00, 'Recife', 'cretaVermelho.jpg', 0),
(6, 1, 'Novo', 'Renault', 'Duster', 2024, 'Bege', 4, 110000.00, 'Fortaleza', 'dusterBege.png', 0),
(7, 1, 'Novo', 'Jeep', 'Compass', 2024, 'Preto', 4, 175000.00, 'Belo Horizonte', 'compassPreta.jpg', 0),
(8, 1, 'Novo', 'Fiat', 'Pulse', 2024, 'Branco', 4, 105000.00, 'Rio de Janeiro', 'pulseBranco.png', 0),
(9, 1, 'Novo', 'Peugeot', '208', 2024, 'Amarelo', 4, 95000.00, 'Campinas', '208Amarelo.png', 0),
(10, 1, 'Novo', 'Nissan', 'Kicks', 2024, 'Branco', 4, 115000.00, 'Salvador', 'kicksBranco.png', 0),
(11, 1, 'Usado', 'Ford', 'Ka', 2018, 'Preto', 4, 42000.00, 'São Paulo', 'kaPreto.jpg', 1),
(12, 1, 'Usado', 'Chevrolet', 'Celta', 2013, 'Prata', 2, 27000.00, 'Joinville', 'celtaPrata.jpg', 1),
(13, 1, 'Usado', 'Volkswagen', 'Gol', 2017, 'Branco', 4, 35000.00, 'Londrina', 'golBranco.jpg', 1),
(14, 1, 'Usado', 'Fiat', 'Uno', 2015, 'Cinza', 2, 29000.00, 'Curitiba', 'unoCinza.jpg', 1),
(15, 1, 'Usado', 'Hyundai', 'HB20', 2019, 'Azul', 4, 49000.00, 'Brasília', 'hb20Azul.jpg', 0),
(16, 1, 'Usado', 'Renault', 'Sandero', 2016, 'Vermelho', 4, 36000.00, 'Porto Alegre', 'sanderoVermelho.png', 0),
(17, 1, 'Novo', 'Lamborghini', 'Huracan', 2025, 'Amarelo', 2, 1500000.00, 'Curitiba', 'huracanAmarelo.png', 1),
(25, 6, 'Usado', 'Ferraro', 'F1000', 2021, 'Prata', 2, 950000.00, 'Rio de Janeiro', 'f1000Prata.jpeg', 0),
(26, 1, 'Usado', 'Porsche', 'Panamera', 2019, 'Dourada', 4, 1055000.00, 'Matinhos', 'ppanameraDouradav2.png', 0),
(27, 1, 'Usado', 'BMW', 'i4 elétrica', 2024, 'Azul', 4, 850000.00, 'Joinville', 'bmwi4Eletrica.png', 0),
(29, 7, 'Novo', 'BYD', 'Yangwang', 2025, 'Vermelho', 2, 1234000.00, 'Shanghai', 'BYD-Yangwang-U9-18.webp', 1),
(30, 6, 'Usado', 'Nissan', 'Tiida', 2013, 'Preto', 4, 54000.00, 'Curitiba', 'tiida.jpg', 0);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `imagens_veiculo`
--
ALTER TABLE `imagens_veiculo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `veiculo_id` (`veiculo_id`);

--
-- Índices de tabela `pagamentos`
--
ALTER TABLE `pagamentos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `solicitacoes`
--
ALTER TABLE `solicitacoes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `veiculos`
--
ALTER TABLE `veiculos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `imagens_veiculo`
--
ALTER TABLE `imagens_veiculo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `pagamentos`
--
ALTER TABLE `pagamentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `solicitacoes`
--
ALTER TABLE `solicitacoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `veiculos`
--
ALTER TABLE `veiculos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `imagens_veiculo`
--
ALTER TABLE `imagens_veiculo`
  ADD CONSTRAINT `imagens_veiculo_ibfk_1` FOREIGN KEY (`veiculo_id`) REFERENCES `veiculos` (`id`);

--
-- Restrições para tabelas `solicitacoes`
--
ALTER TABLE `solicitacoes`
  ADD CONSTRAINT `solicitacoes_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `veiculos`
--
ALTER TABLE `veiculos`
  ADD CONSTRAINT `veiculos_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
