-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 18-Jun-2019 às 23:18
-- Versão do servidor: 5.7.17
-- versão do PHP: 7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mathwork`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `table_carrinho`
--

DROP TABLE IF EXISTS `table_carrinho`;
CREATE TABLE IF NOT EXISTS `table_carrinho` (
  `id_carrinho` int(11) NOT NULL AUTO_INCREMENT,
  `id_peca` int(1) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `preco_total` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id_carrinho`)
) ENGINE=InnoDB AUTO_INCREMENT=122 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `table_carrinho`
--

INSERT INTO `table_carrinho` (`id_carrinho`, `id_peca`, `quantidade`, `preco_total`) VALUES
(120, 6, 2, '324.00'),
(121, 7, 2, '159.40');

-- --------------------------------------------------------

--
-- Estrutura da tabela `table_computador`
--

DROP TABLE IF EXISTS `table_computador`;
CREATE TABLE IF NOT EXISTS `table_computador` (
  `id_computador` int(11) NOT NULL AUTO_INCREMENT,
  `nome_computador` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `descricao` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `preco` decimal(10,2) NOT NULL,
  `status` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `_codigo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_computador`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `table_computador`
--

INSERT INTO `table_computador` (`id_computador`, `nome_computador`, `descricao`, `preco`, `status`, `_codigo`) VALUES
(1, 'Notebook Samsung', 'Notebook Samsung Dual Core 4GB 500GB Tela 15.6\" Windows 10 Essentials E20 NP350XAA-KDABR', '1495.50', 'A', '1.jpg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `table_peca`
--

DROP TABLE IF EXISTS `table_peca`;
CREATE TABLE IF NOT EXISTS `table_peca` (
  `id_peca` int(11) NOT NULL AUTO_INCREMENT,
  `nome_peca` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `descricao` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `preco` decimal(10,2) NOT NULL,
  `status` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `_codigo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_peca`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `table_peca`
--

INSERT INTO `table_peca` (`id_peca`, `nome_peca`, `descricao`, `preco`, `status`, `_codigo`) VALUES
(1, 'Fonte PC', '500 w real', '89.00', 'A', '1.jpg'),
(2, 'Placa Mãe', 'Placa mãe Asus H310M-E/Br', '389.00', 'A', '2.jpg'),
(3, 'Processador', 'i3 8ª geração', '654.00', 'A', '3.jpg'),
(4, 'Memória', 'ddr4 4 gigabytes', '148.90', 'A', '4.jpg'),
(5, 'Placa de vídeo', 'Integrado', '0.00', 'A', '5.jpg'),
(6, 'hd ssd', 'ssd 240 G', '162.00', 'A', '6.jpg'),
(7, 'gabinete', '', '79.70', 'A', '7.jpg'),
(8, 'Teclado e Mouse USB', 'Multilaser Bright Standart USB Preto', '22.90', 'A', '8.jpg');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
