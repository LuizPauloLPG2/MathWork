-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 27-Jun-2019 às 18:45
-- Versão do servidor: 10.3.15-MariaDB
-- versão do PHP: 7.3.6

SET SQL_MODE
= "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT
= 0;
START TRANSACTION;
SET time_zone
= "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `mathwork`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `table_carrinhopeca`
--

CREATE TABLE `table_carrinhopeca`
(
  `id_carrinhopeca` int
(11) NOT NULL,
  `id_peca` int
(1) NOT NULL,
  `quantidade` int
(11) NOT NULL,
  `preco_total` decimal
(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `table_custoempresa`
--

CREATE TABLE `table_custoempresa`
(
  `id_custoempresa` int
(11) NOT NULL,
  `nome` varchar
(255) COLLATE utf8_unicode_ci NOT NULL,
  `valor` decimal
(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `table_custoempresa`
--

-- INSERT INTO `table_custoempresa` (`
-- id_custoempresa`,
-- `nome
-- `, `valor`) VALUES
-- (1, 'aluguel', '1000.00'),
-- (2, 'agua', '80.00'),
-- (3, 'energia', '30.00'),
-- (4, 'internet', '150.00'),
-- (5, 'telefone', '150.00'),
-- (6, 'custo_fixo', '400.00'),
-- (7, 'impostos', '1000.00'),
-- (8, 'transportes', '80.00'),
-- (9, 'funcionarios', '5000.00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `table_finalizacompra`
--

CREATE TABLE `table_finalizacompra`
(
  `id_finalizacompra` int
(11) NOT NULL,
  `valor_total` decimal
(10,2) NOT NULL,
  `data_cadastro` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `table_finalizacompra`
--

-- INSERT INTO `table_finalizacompra` (`
-- id_finalizacompra`,
-- `valor_total
-- `, `data_cadastro`) VALUES
-- (113, '148.90', '2019-06-27'),
-- (114, '654.00', '2019-06-27'),
-- (115, '654.00', '2019-06-27'),
-- (116, '654.00', '2019-06-27'),
-- (117, '389.00', '2019-06-27'),
-- (118, '389.00', '2019-06-27'),
-- (119, '389.00', '2019-06-27'),
-- (120, '148.90', '2019-06-27'),
-- (121, '389.00', '2019-06-27'),
-- (122, '389.00', '2019-06-27'),
-- (123, '89.00', '2019-06-27'),
-- (124, '89.00', '2019-06-27'),
-- (125, '89.00', '2019-06-27'),
-- (126, '89.00', '2019-06-27'),
-- (127, '89.00', '2019-06-27'),
-- (128, '654.00', '2019-06-27');

-- --------------------------------------------------------

--
-- Estrutura da tabela `table_fornecedor`
--

CREATE TABLE `table_fornecedor`
(
  `id_fornecedor` int
(11) NOT NULL,
  `nome_fornecedor` varchar
(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `table_fornecedor`
--

-- INSERT INTO `table_fornecedor` (`
-- id_fornecedor`,
-- `nome_fornecedor
-- `) VALUES
-- (1, 'PEDRO '),
-- (2, 'JOÃO'),
-- (3, 'CARLOS'),
-- (4, 'JEAN'),
-- (5, 'LUCAS'),
-- (6, 'LEONARDO');

-- -- --------------------------------------------------------

--
-- Estrutura da tabela `table_peca`
--

CREATE TABLE `table_peca`
(
  `id_peca` int
(11) NOT NULL,
  `id_fornecedor` int
(11) NOT NULL,
  `nome_peca` varchar
(255) COLLATE utf8_unicode_ci NOT NULL,
  `descricao` varchar
(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `custo` decimal
(10,2) NOT NULL,
  `preco` decimal
(10,2) NOT NULL,
  `status` char
(1) COLLATE utf8_unicode_ci NOT NULL,
  `_codigo` varchar
(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `estoque` int
(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `table_peca`
--

-- INSERT INTO `table_peca` (`
-- id_peca`,
-- `id_fornecedor
-- `, `nome_peca`, `descricao`, `custo`, `preco`, `status`, `_codigo`, `estoque`) VALUES
-- (1, 3, 'Fonte PC', '500 w real', '50.00', '89.00', 'A', '1.jpg', 10),
-- (2, 1, 'Placa Mãe', 'Placa mãe Asus H310M-E/Br', '250.00', '389.00', 'A', '2.jpg', 1),
-- (3, 1, 'Processador', 'i3 8ª geração', '580.00', '654.00', 'A', '3.jpg', 1),
-- (4, 3, 'Memória', 'ddr4 4 gigabytes', '100.00', '148.90', 'A', '4.jpg', 0),
-- (5, 3, 'Placa de vídeo', 'Integrado', '200.00', '285.00', 'A', '5.jpg', 0),
-- (6, 2, 'hd ssd', 'ssd 240 G', '80.00', '162.00', 'A', '6.jpg', 0),
-- (7, 2, 'gabinete', NULL, '50.00', '79.70', 'A', '7.jpg', 0),
-- (8, 4, 'Teclado e Mouse USB', 'Multilaser Bright Standart USB Preto', '12.00', '22.90', 'A', '8.jpg', 0),
-- (21, 1, 'TESTE', NULL, '0.00', '0.00', 'A', '21.jpg', 0);

-- --
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `table_carrinhopeca`
--
ALTER TABLE `table_carrinhopeca`
ADD PRIMARY KEY
(`id_carrinhopeca`);

--
-- Índices para tabela `table_custoempresa`
--
ALTER TABLE `table_custoempresa`
ADD PRIMARY KEY
(`id_custoempresa`);

--
-- Índices para tabela `table_finalizacompra`
--
ALTER TABLE `table_finalizacompra`
ADD PRIMARY KEY
(`id_finalizacompra`);

--
-- Índices para tabela `table_fornecedor`
--
ALTER TABLE `table_fornecedor`
ADD PRIMARY KEY
(`id_fornecedor`);

--
-- Índices para tabela `table_peca`
--
ALTER TABLE `table_peca`
ADD PRIMARY KEY
(`id_peca`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `table_carrinhopeca`
--
ALTER TABLE `table_carrinhopeca`
  MODIFY `id_carrinhopeca` int
(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=226;

--
-- AUTO_INCREMENT de tabela `table_custoempresa`
--
ALTER TABLE `table_custoempresa`
  MODIFY `id_custoempresa` int
(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `table_finalizacompra`
--
ALTER TABLE `table_finalizacompra`
  MODIFY `id_finalizacompra` int
(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=129;

--
-- AUTO_INCREMENT de tabela `table_fornecedor`
--
ALTER TABLE `table_fornecedor`
  MODIFY `id_fornecedor` int
(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `table_peca`
--
ALTER TABLE `table_peca`
  MODIFY `id_peca` int
(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
