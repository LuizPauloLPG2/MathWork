-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 05-Jul-2019 às 14:24
-- Versão do servidor: 10.3.16-MariaDB
-- versão do PHP: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


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

CREATE TABLE `table_carrinhopeca` (
  `id_carrinhopeca` int(11) NOT NULL,
  `id_peca` int(1) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `preco_total` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `table_comissao`
--

CREATE TABLE `table_comissao` (
  `id_comissao` int(11) NOT NULL,
  `valor` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `table_comissao`
--

INSERT INTO `table_comissao` (`id_comissao`, `valor`) VALUES
(1, '50000.00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `table_custoempresa`
--

CREATE TABLE `table_custoempresa` (
  `id_custoempresa` int(11) NOT NULL,
  `nome` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `valor` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `table_custoempresa`
--

INSERT INTO `table_custoempresa` (`id_custoempresa`, `nome`, `valor`) VALUES
(10, 'aluguel', '1000.00'),
(11, 'agua', '80.00'),
(12, 'energia', '300.00'),
(13, 'internet', '150.00'),
(14, 'telefone', '150.00'),
(15, 'custo_fixo', '400.00'),
(16, 'impostos', '1000.00'),
(17, 'transportes', '800.00'),
(18, 'funcionarios', '6000.00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `table_finalizacompra`
--

CREATE TABLE `table_finalizacompra` (
  `id_finalizacompra` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `valor_total` decimal(10,2) NOT NULL,
  `data_cadastro` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `table_finalizacompra`
--

INSERT INTO `table_finalizacompra` (`id_finalizacompra`, `id_usuario`, `valor_total`, `data_cadastro`) VALUES
(145, 1, '53040.00', '2019-06-30'),
(146, 2, '490.00', '2019-07-01');

-- --------------------------------------------------------

--
-- Estrutura da tabela `table_fornecedor`
--

CREATE TABLE `table_fornecedor` (
  `id_fornecedor` int(11) NOT NULL,
  `nome_fornecedor` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `table_fornecedor`
--

INSERT INTO `table_fornecedor` (`id_fornecedor`, `nome_fornecedor`) VALUES
(7, 'PEDRO'),
(8, 'CARLOS');

-- --------------------------------------------------------

--
-- Estrutura da tabela `table_peca`
--

CREATE TABLE `table_peca` (
  `id_peca` int(11) NOT NULL,
  `id_fornecedor` int(11) NOT NULL,
  `nome_peca` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `descricao` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `custo` decimal(10,2) NOT NULL,
  `preco` decimal(10,2) NOT NULL,
  `status` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `_codigo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `estoque` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `table_peca`
--

INSERT INTO `table_peca` (`id_peca`, `id_fornecedor`, `nome_peca`, `descricao`, `custo`, `preco`, `status`, `_codigo`, `estoque`) VALUES
(22, 7, 'Fonte atx 500w', '', '200.00', '450.00', 'A', '22.jpg', 2),
(23, 7, 'placa mãe', NULL, '300.00', '490.00', 'A', '23.jpg', 11),
(24, 8, 'processDOR CORE  I3', '', '289.00', '500.00', 'A', '24.jpg', 4),
(25, 7, 'MeMÓRIa ram', NULL, '180.00', '290.00', 'A', '25.jpg', 6),
(26, 8, 'placa de vídeo', NULL, '400.00', '850.00', 'A', '26.jpg', 1),
(27, 8, 'ssd', NULL, '80.00', '140.00', 'A', '27.jpg', 3),
(28, 7, 'gabinete gamer', NULL, '200.00', '290.00', 'A', '28.jpg', 2),
(29, 8, 'kit teclado + mouse', NULL, '80.00', '100.00', 'A', '29.jpg', 19);

-- --------------------------------------------------------

--
-- Estrutura da tabela `table_usuario`
--

CREATE TABLE `table_usuario` (
  `id_usuario` int(11) NOT NULL,
  `nome` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `senha` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tipo` char(1) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `table_usuario`
--

INSERT INTO `table_usuario` (`id_usuario`, `nome`, `email`, `senha`, `tipo`) VALUES
(1, 'luiz', 'luiz@gmail.com', '123', 'A'),
(2, 'deniz', 'deniz@gmail.com', '123', 'U');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `table_carrinhopeca`
--
ALTER TABLE `table_carrinhopeca`
  ADD PRIMARY KEY (`id_carrinhopeca`);

--
-- Índices para tabela `table_comissao`
--
ALTER TABLE `table_comissao`
  ADD PRIMARY KEY (`id_comissao`);

--
-- Índices para tabela `table_custoempresa`
--
ALTER TABLE `table_custoempresa`
  ADD PRIMARY KEY (`id_custoempresa`);

--
-- Índices para tabela `table_finalizacompra`
--
ALTER TABLE `table_finalizacompra`
  ADD PRIMARY KEY (`id_finalizacompra`);

--
-- Índices para tabela `table_fornecedor`
--
ALTER TABLE `table_fornecedor`
  ADD PRIMARY KEY (`id_fornecedor`);

--
-- Índices para tabela `table_peca`
--
ALTER TABLE `table_peca`
  ADD PRIMARY KEY (`id_peca`);

--
-- Índices para tabela `table_usuario`
--
ALTER TABLE `table_usuario`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `table_carrinhopeca`
--
ALTER TABLE `table_carrinhopeca`
  MODIFY `id_carrinhopeca` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=285;

--
-- AUTO_INCREMENT de tabela `table_comissao`
--
ALTER TABLE `table_comissao`
  MODIFY `id_comissao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `table_custoempresa`
--
ALTER TABLE `table_custoempresa`
  MODIFY `id_custoempresa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de tabela `table_finalizacompra`
--
ALTER TABLE `table_finalizacompra`
  MODIFY `id_finalizacompra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=147;

--
-- AUTO_INCREMENT de tabela `table_fornecedor`
--
ALTER TABLE `table_fornecedor`
  MODIFY `id_fornecedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `table_peca`
--
ALTER TABLE `table_peca`
  MODIFY `id_peca` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de tabela `table_usuario`
--
ALTER TABLE `table_usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
