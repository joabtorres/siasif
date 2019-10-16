-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 30-Set-2019 às 23:58
-- Versão do servidor: 5.7.24
-- versão do PHP: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `siasif`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `defesa`
--

DROP TABLE IF EXISTS `defesa`;
CREATE TABLE IF NOT EXISTS `defesa` (
  `cod` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `servidor_cod` int(11) NOT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `data` date DEFAULT NULL,
  `anexo` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`cod`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `prorrogacao`
--

DROP TABLE IF EXISTS `prorrogacao`;
CREATE TABLE IF NOT EXISTS `prorrogacao` (
  `cod` int(11) NOT NULL AUTO_INCREMENT,
  `servidor_cod` int(11) NOT NULL,
  `inicio` date DEFAULT NULL,
  `termino` date DEFAULT NULL,
  `ato` varchar(10) DEFAULT NULL,
  `numero_ato` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`cod`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `relatorio`
--

DROP TABLE IF EXISTS `relatorio`;
CREATE TABLE IF NOT EXISTS `relatorio` (
  `cod` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `servidor_cod` int(11) NOT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `data` date DEFAULT NULL,
  `anexo` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`cod`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `servidor`
--

DROP TABLE IF EXISTS `servidor`;
CREATE TABLE IF NOT EXISTS `servidor` (
  `cod` int(11) NOT NULL AUTO_INCREMENT,
  `unidade_cod` int(10) UNSIGNED NOT NULL,
  `siape` varchar(100) DEFAULT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `cpf` varchar(20) DEFAULT NULL,
  `genero` varchar(10) DEFAULT NULL,
  `atuacao` varchar(40) NOT NULL,
  `telefone` varchar(50) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `imagem` varchar(255) DEFAULT NULL,
  `ato` varchar(20) DEFAULT NULL,
  `numero_ato` varchar(100) DEFAULT NULL,
  `afastamento` varchar(10) DEFAULT NULL,
  `categoria` varchar(10) DEFAULT NULL,
  `modalidade` varchar(30) DEFAULT NULL,
  `destino` varchar(20) DEFAULT NULL,
  `instituicao` varchar(255) DEFAULT NULL,
  `inicio` date DEFAULT NULL,
  `termino` date DEFAULT NULL,
  `cadastro` date NOT NULL,
  PRIMARY KEY (`cod`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Acionadores `servidor`
--
DROP TRIGGER IF EXISTS `tg_remove_servidor`;
DELIMITER $$
CREATE TRIGGER `tg_remove_servidor` BEFORE DELETE ON `servidor` FOR EACH ROW BEGIN
	DELETE FROM relatorio WHERE servidor_cod = OLD.cod;
	DELETE FROM defesa WHERE servidor_cod = OLD.cod;
	DELETE FROM prorrogacao WHERE servidor_cod = OLD.cod;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `unidade`
--

DROP TABLE IF EXISTS `unidade`;
CREATE TABLE IF NOT EXISTS `unidade` (
  `cod` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  PRIMARY KEY (`cod`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `unidade`
--

INSERT INTO `unidade` (`cod`, `nome`) VALUES
(1, 'IFPA - Campus Abaetetuba'),
(2, 'IFPA - Campus Altamira'),
(3, 'IFPA - Campus Ananindeua'),
(4, 'IFPA - Campus Belém'),
(5, 'IFPA - Campus Bragança'),
(6, 'IFPA - Campus Breves'),
(7, 'IFPA - Campus Cametá'),
(8, 'IFPA - Campus Castanhal'),
(9, 'IFPA - Campus Itaituba'),
(10, 'IFPA - Campus Conceição Araguaia'),
(11, 'IFPA - Campus Marabá Industrial'),
(12, 'IFPA - Campus Marabá Rural'),
(13, 'IFPA - Campus Óbidos'),
(14, 'IFPA - Campus Paragominas'),
(15, 'IFPA - Campus Parauapebas'),
(16, 'IFPA - Campus Santarém'),
(17, 'IFPA - Campus Tucuruí'),
(18, 'IFPA - Campus Vigia'),
(19, 'Reitoria');

--
-- Acionadores `unidade`
--
DROP TRIGGER IF EXISTS `tg_remove_unidade`;
DELIMITER $$
CREATE TRIGGER `tg_remove_unidade` BEFORE DELETE ON `unidade` FOR EACH ROW BEGIN
	DELETE FROM servidor WHERE unidade_cod = OLD.cod;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `cod` int(11) NOT NULL AUTO_INCREMENT,
  `unidade_cod` int(11) UNSIGNED NOT NULL,
  `nome` varchar(20) NOT NULL,
  `sobrenome` varchar(100) NOT NULL,
  `usuario` varchar(30) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(32) NOT NULL,
  `cargo` varchar(45) NOT NULL,
  `genero` varchar(10) DEFAULT NULL,
  `nivel_acesso` tinyint(1) UNSIGNED NOT NULL,
  `status` tinyint(1) UNSIGNED NOT NULL DEFAULT '1',
  `imagem` varchar(255) DEFAULT NULL,
  `data` date DEFAULT NULL,
  PRIMARY KEY (`cod`),
  UNIQUE KEY `usuario_usuario_UNIQUE` (`usuario`),
  UNIQUE KEY `email_usuario_UNIQUE` (`email`),
  KEY `fk_unidade_usuario` (`unidade_cod`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`cod`, `unidade_cod`, `nome`, `sobrenome`, `usuario`, `email`, `senha`, `cargo`, `genero`, `nivel_acesso`, `status`, `imagem`, `data`) VALUES
(1, 9, 'Joab', 'T. Alencar', 'joab.alencar', 'joabtorres1508@gmail.com', '47cafbff7d1c4463bbe7ba972a2b56e3', 'Administrador', 'M', 3, 1, 'uploads/usuarios/user_masculino.png', '2019-08-07');

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fk_unidade_usuario` FOREIGN KEY (`unidade_cod`) REFERENCES `unidade` (`cod`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
