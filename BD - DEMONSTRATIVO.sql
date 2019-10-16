-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: 04-Ago-2019 às 13:42
-- Versão do servidor: 5.6.39-83.1
-- versão do PHP: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `joabtorr_siasif`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `defesa`
--

CREATE TABLE `defesa` (
  `cod` int(10) UNSIGNED NOT NULL,
  `servidor_cod` int(11) NOT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `data` date DEFAULT NULL,
  `anexo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `defesa`
--

INSERT INTO `defesa` (`cod`, `servidor_cod`, `status`, `data`, `anexo`) VALUES
(1, 1, 1, '2019-08-02', 'uploads/media/22d3423c6a18bc1cb679154939feeef4.pdf');

-- --------------------------------------------------------

--
-- Estrutura da tabela `prorrogacao`
--

CREATE TABLE `prorrogacao` (
  `cod` int(11) NOT NULL,
  `servidor_cod` int(11) NOT NULL,
  `inicio` date DEFAULT NULL,
  `termino` date DEFAULT NULL,
  `ato` varchar(10) DEFAULT NULL,
  `numero_ato` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `prorrogacao`
--

INSERT INTO `prorrogacao` (`cod`, `servidor_cod`, `inicio`, `termino`, `ato`, `numero_ato`) VALUES
(1, 1, '2019-10-20', '2020-10-10', 'Portaria', '254545');

-- --------------------------------------------------------

--
-- Estrutura da tabela `relatorio`
--

CREATE TABLE `relatorio` (
  `cod` int(10) UNSIGNED NOT NULL,
  `servidor_cod` int(11) NOT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `data` date DEFAULT NULL,
  `anexo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `relatorio`
--

INSERT INTO `relatorio` (`cod`, `servidor_cod`, `status`, `data`, `anexo`) VALUES
(1, 1, 1, '2019-08-01', 'uploads/media/2e1d13068999055fab59fb8399878515.pdf'),
(2, 1, 1, '2019-08-02', 'uploads/media/803c4c1c0b0efa159049e735ef79648f.pdf');

-- --------------------------------------------------------

--
-- Estrutura da tabela `servidor`
--

CREATE TABLE `servidor` (
  `cod` int(11) NOT NULL,
  `unidade_cod` int(10) UNSIGNED NOT NULL,
  `siape` varchar(100) DEFAULT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `cpf` varchar(20) DEFAULT NULL,
  `genero` varchar(10) DEFAULT NULL,
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
  `cadastro` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `servidor`
--

INSERT INTO `servidor` (`cod`, `unidade_cod`, `siape`, `nome`, `status`, `cpf`, `genero`, `telefone`, `email`, `imagem`, `ato`, `numero_ato`, `afastamento`, `categoria`, `modalidade`, `destino`, `instituicao`, `inicio`, `termino`, `cadastro`) VALUES
(1, 9, '458048343', 'Natália Luiza Cláudia Lima', 0, '062.031.491-52', 'Feminino', '62988395141', 'natalialuiza_@lordello.com.br', 'uploads/servidores/2896945e7d5e3cc6078b62ef7c3bc7ec.jpg', 'Portaria', '74730515', 'Total', 'Docente', 'Mestrado', 'Nacional', 'IFPA - Campus Castanhal', '2019-01-01', '2020-12-31', '2019-08-02'),
(2, 1, '396248913', 'Esther Pietra Fabiana Silva', 0, '114.179.574-41', 'Feminino', '91988174398', 'estherpietrafabianasilva@marcofaria.com', '', 'Portaria', '12345678', 'Total', 'Docente', 'Doutorado', 'Nacional', 'Universidade Federal do Pará', '2019-06-30', '2022-01-30', '2019-08-02'),
(3, 1, '359182537', 'Sebastião Breno Gabriel Ribeiro', 0, '738.646.084-81', 'Masculino', '91995713031', 'sebastiaobrenogabrielribeiro@munhozengenharia.com.br', '', 'Portaria', '98765432', 'Parcial', 'Docente', 'Mestrado', 'Nacional', 'Universidade Federal de Campina Grande', '2018-12-01', '2020-06-01', '2019-08-02'),
(4, 1, '156339298', 'Carolina Ana Betina Assis', 0, '665.137.434-60', 'Feminino', '91991129805', 'ccarolinaanabetinaassis@santander.com.br', '', 'Portaria', '87654321', 'Total', 'Docente', 'MINTER/Estágio', 'Nacional', 'Universidade de São Carlos', '2019-06-01', '2020-06-01', '2019-08-02'),
(5, 1, '219647185', 'Maria Allana Ramos', 0, '047.267.064-62', 'Feminino', '91989888331', 'mariaallanaramos-92@rotauniformes.com.br', '', 'Portaria', '68440970', 'Total', 'TAE', 'Mestrado', 'Nacional', 'IFPA - Campus Belém', '2019-06-25', '2020-12-25', '2019-08-02'),
(6, 1, '504223598', 'Cecília Jennifer Almada', 0, '397.376.214-76', 'Feminino', '91994347349', 'ceciliajenniferalmada@outlook.com', '', 'Portaria', '68440970', 'Total', 'TAE', 'Mestrado', 'Nacional', 'IFPA Campus Castanhal', '2019-01-01', '2020-12-31', '2019-08-02'),
(7, 2, '501802629', 'Marina Esther Luana Barros', 0, '835.002.254-03', 'Feminino', '93987371216', 'marinaestherluanabarros-83@gmail.com', '', 'Portaria', '68375100', 'Total', 'TAE', 'Doutorado', 'Nacional', 'Universidade Federal de São Paulo', '2019-01-01', '2023-01-01', '2019-08-02'),
(8, 2, '122050861', 'Anderson Thomas Murilo Barros', 0, '351.099.114-10', 'Masculino', '93993183535', 'andersonthomasbarros_@nipbr.com.br', '', 'Portaria', '68376755', 'Parcial', 'TAE', 'Mestrado', 'Nacional', 'IFPA - Campus Belém', '2019-01-15', '2020-12-15', '2019-08-03'),
(9, 3, '236127561', 'Thomas Kaique Leandro da Costa', 0, '314.934.894-37', 'Masculino', '91991525298', 'leandrodacosta-83@maccropropaganda.com.br', '', 'Resolução', '66080160', 'Total', 'Docente', 'Doutorado', 'Internacional', 'Universidad de Alicante', '2018-01-15', '2021-12-15', '2019-08-03'),
(10, 3, '384842707', 'Ryan Felipe Caio da Rosa', 1, '543.078.264-50', 'Masculino', '91999953340', 'ryanfelipe_@willianfernandes.com.br', '', 'Portaria', '66615070', 'Total', 'TAE', 'MINTER/Estágio', 'Nacional', 'Instituto Federal do Ceará', '2018-01-18', '2018-06-18', '2019-08-03'),
(11, 18, '475958962', 'Raimundo Ruan Lorenzo Bernardes', 1, '765.629.074-54', 'Masculino', '91991589985', 'raimundoruan_s@amplisat.com.br', '', 'Portaria', '66811320', 'Total', 'Docente', 'DINTER/Estágio', 'Nacional', 'Universidade Federal do Rio Grande do Norte', '2018-03-17', '2019-03-17', '2019-08-03'),
(12, 4, '319821511', 'Márcia Eliane Antonella Lopes', 1, '050.540.524-53', 'Feminino', '91983463422', 'marciaeliane_@bessa.net.br', '', 'Portaria', '67033630', 'Total', 'TAE', 'DINTER/Estágio', 'Nacional', 'Universidade Federal de Minas Gerais', '2018-04-19', '2019-04-19', '2019-08-03'),
(13, 6, '260604008', 'Henry Geraldo Severino Nogueira', 0, '837.291.624-11', 'Masculino', '91986483740', 'henrygeraldoseverino_@bol.com.br', '', 'Portaria', '67113800', 'Parcial', 'TAE', 'Mestrado', 'Nacional', 'IFPA - Campus Castanhal', '2019-08-03', '2021-02-03', '2019-08-03'),
(14, 7, '383338591', 'Caroline Camila Almada', 0, '113.876.144-36', 'Feminino', '94988736349', 'carolalmada@octagonbrasil.com.br', '', 'Portaria', '68509490', 'Parcial', 'Docente', 'Mestrado', 'Nacional', 'Instituto Federal do Piauí', '2019-06-15', '2020-12-15', '2019-08-03'),
(15, 8, '360415313', 'Bruno Tomás Iago Aparício', 1, '954.228.724-01', 'Masculino', '94989291380', 'brunotomasiago-91@oerlikon.com', '', 'Portaria', '68512510', 'Total', 'Docente', 'DINTER/Estágio', 'Nacional', 'Universidade Federal do Rio de Janeiro', '2017-03-28', '2018-03-28', '2019-08-03'),
(16, 5, '213959252', 'Vicente Martin de Paula', 0, '364.378.284-55', 'Masculino', '94983474848', 'vicentemartindepaula-76@bitco.com', '', 'Resolução', '68550806', 'Total', 'Docente', 'Doutorado', 'Internacional', 'Universidade de Le Mans', '2018-06-25', '2022-01-25', '2019-08-03'),
(17, 10, '439669042', 'Camila Elaine Emanuelly Aparício', 0, '454.939.774-86', 'Feminino', '93996112070', 'camilaelaineemanuellyaparicio@oerlikon.com', '', 'Portaria', '68375415', 'Total', 'Docente', 'DINTER/Estágio', 'Nacional', 'Instituto Federal de Goiás', '2019-08-05', '2020-08-05', '2019-08-03'),
(18, 11, '450680198', 'Rosa Isabelle Melo', 0, '896.918.084-20', 'Feminino', '91993497119', 'rosaisabellemelo_@reginfo.com.br', '', 'Portaria', '66113075', 'Parcial', 'TAE', 'Mestrado', 'Nacional', 'IFPA - Campus Belém', '2019-01-01', '2020-12-31', '2019-08-03'),
(19, 12, '365478404', 'Mariana Maitê Carolina Araújo', 1, '445.605.395-02', 'Feminino', '75991443311', 'mmarianamaite@zuinzuin.com.br', '', 'Portaria', '44086530', 'Total', 'Docente', 'MINTER/Estágio', 'Nacional', 'Instituto Federal do Amazonas', '2018-02-13', '2019-02-13', '2019-08-03'),
(20, 13, '281035908', 'Luana Carolina Joana Cardoso', 0, '119.563.975-90', 'Feminino', '77989478153', 'luanacarolina@operaconstrutora.com.br', '', 'Portaria', '45000825', 'Total', 'Docente', 'Doutorado', 'Nacional', 'Universidade Estadual do Rio de Janeiro', '2017-09-12', '2021-03-12', '2019-08-03'),
(21, 14, '300541909', 'Miguel Mário Augusto Rezende', 0, '560.242.885-22', 'Masculino', '71992363665', 'miguelmario-89@andrepires.com.br', '', 'Resolução', '40240235', 'Total', 'Docente', 'Doutorado', 'Internacional', 'Universidade do Porto', '2015-12-13', '2019-12-13', '2019-08-03'),
(22, 15, '238881301', 'Gabrielly Valentina Silva', 1, '862.235.895-06', 'Feminino', '71982192072', 'gabriellyvalentina_@academiahct.com.br', '', 'Portaria', '41345140', 'Total', 'TAE', 'Doutorado', 'Nacional', 'Universidade Federal do Pará', '2016-02-19', '2020-02-19', '2019-08-03'),
(23, 16, '477755355', 'Mário Lucca Tomás da Mota', 0, '544.746.815-92', 'Masculino', '71995585004', 'marioluccatomasdamota__@iclud.com', '', 'Portaria', '40275590', 'Total', 'Docente', 'Mestrado', 'Nacional', 'IFPA - Campus Belém', '2019-03-11', '2020-09-11', '2019-08-03'),
(24, 17, '453439317', 'Analu Rosa Jéssica Almeida', 0, '612.068.361-56', 'Feminino', '62985820529', 'aalmeida@sectron.com.br', '', 'Resolução', '75113170', 'Total', 'Docente', 'Pós-Doutorado', 'Internacional', 'Universidade de Lisboa', '2019-06-30', '2019-12-30', '2019-08-03'),
(25, 19, '321888091', 'Manuela Emily Mirella Martins', 0, '707.538.161-05', 'Feminino', '61996083612', 'manuelaemilymirellamartins@bol.com', '', 'Portaria', '72801013', 'Total', 'TAE', 'DINTER/Estágio', 'Nacional', 'Universidade Federal de Santa Maria', '2019-01-20', '2020-01-20', '2019-08-03'),
(26, 8, '283493707', 'Beatriz Bianca Mirella Barbosa', 1, '858.932.551-27', 'Feminino', '62996798607', 'beatrizbianca@land.com.br', '', 'Portaria', '75132125', 'Parcial', 'Docente', 'Mestrado', 'Nacional', 'IFPA - Campus Castanhal', '2017-01-21', '2018-06-21', '2019-08-03'),
(27, 8, '258796224', 'Paulo Felipe da Mota', 0, '368.056.661-12', 'Masculino', '62994287328', 'paulofelipedamota@saa.com.br', '', 'Portaria', '74491030', 'Total', 'Docente', 'Doutorado', 'Nacional', 'Universidade Federal da Paraíba', '2016-01-23', '2020-01-23', '2019-08-03'),
(28, 8, '324920179', 'Sebastiana Eduarda Freitas', 0, '569.746.161-55', 'Feminino', '62985657508', 'freitas@madhause.com.br', '', 'Portaria', '74740545', 'Parcial', 'TAE', 'Mestrado', 'Nacional', 'IFPA - Campus Belém', '2019-05-14', '2020-05-14', '2019-08-03'),
(29, 19, '372448227', 'Thomas Ricardo Porto', 1, '348.734.881-09', 'Masculino', '62999118401', 'thomasricardoporto_@brunofaria.com', '', 'Portaria', '74937560', 'Parcial', 'Docente', 'Mestrado', 'Nacional', 'IFPA - Campus Belém', '2017-02-23', '2019-02-23', '2019-08-03'),
(30, 6, '129463723', 'Marcela Manuela Isadora da Cunha', 0, '460.579.081-04', 'Feminino', '62983060690', 'marcelamanu_@triunfante.com.br', '', 'Portaria', '74484360', 'Parcial', 'TAE', 'Mestrado', 'Nacional', 'IFPA - Campus Castanhal', '2019-01-04', '2020-12-04', '2019-08-03'),
(31, 5, '413778782', 'Antonio Bryan Dias', 0, '915.076.671-67', 'Masculino', '62995234325', 'antoniobryandias@statusseguros.com.br', '', 'Portaria', '74594157', 'Parcial', 'Docente', 'DINTER/Estágio', 'Nacional', 'Universidade Federal do Triângulo Mineiro', '2019-03-28', '2020-03-28', '2019-08-03'),
(32, 12, '459325048', 'Renata Lorena Eloá Dias', 0, '368.192.004-47', 'Feminino', '83999777663', 'renatalorenaeloadias@unimedara.com.br', '', 'Portaria', '58800510', 'Total', 'Docente', 'Mestrado', 'Nacional', 'Instituto Federal de Santa Catarina', '2018-05-28', '2020-11-28', '2019-08-03'),
(33, 19, '400933755', 'Maitê Marli da Costa', 0, '665.343.014-66', 'Feminino', '83985798622', 'maitemarlidacosta@agltda.com.br', '', 'Portaria', '58078160', 'Total', 'Docente', 'Doutorado', 'Nacional', 'Universidade Federal da Bahia', '2019-01-05', '2022-06-05', '2019-08-03'),
(34, 16, '372296877', 'Alice Mariah Aurora Vieira', 0, '406.294.824-97', 'Feminino', '83988457052', 'alicemariah_@hotmail.com', '', 'Portaria', '58300420', 'Parcial', 'TAE', 'DINTER/Estágio', 'Nacional', 'Universidade Federal do Amazonas', '2019-05-01', '2019-11-01', '2019-08-03'),
(35, 17, '456108348', 'Juan Fernando Davi Assunção', 0, '666.219.374-74', 'Masculino', '83986817303', 'juanfernando-84@alphagraphics.com.br', '', 'Portaria', '58306190', 'Parcial', 'TAE', 'MINTER/Estágio', 'Nacional', 'Universidade Estadual do Pará', '2019-06-29', '2019-12-29', '2019-08-03'),
(36, 15, '142389377', 'Luna Isabelly Costa', 1, '025.983.313-46', 'Feminino', '85997450949', 'luna@jmmarcenaria.com.br', '', 'Portaria', '60191670', 'Parcial', 'TAE', 'DINTER/Estágio', 'Nacional', 'Instituto Federal de São Paulo', '2017-12-17', '2018-12-17', '2019-08-03'),
(37, 7, '356874631', 'Theo Filipe Calebe Aparício', 0, '365.726.773-54', 'Masculino', '88985430776', 'ttheofilipecalebe@cbb.com.br', '', 'Portaria', '63020390', 'Total', 'TAE', 'Doutorado', 'Nacional', 'Universidade Federal do Pará', '2017-09-23', '2021-09-23', '2019-08-03'),
(38, 13, '287891598', 'César Lucca Nelson da Mata', 1, '007.448.123-13', 'Masculino', '85982459506', 'damata@helponline-sti.com', '', 'Portaria', '60526480', 'Total', 'TAE', 'Mestrado', 'Nacional', 'Universidade Federal do Amazonas', '2019-03-08', '2021-03-08', '2019-08-03'),
(39, 18, '404831011', 'Rodrigo Nicolas Souza', 0, '464.824.423-07', 'Masculino', '85986678142', 'rodrigonicolas@gmail.com.br', '', 'Resolução', '60181200', 'Total', 'Docente', 'Doutorado', 'Internacional', 'Universidade de Coimbra', '2018-01-23', '2022-01-23', '2019-08-03'),
(40, 4, '284302284', 'Lucas Julio Anthony da Rocha', 0, '145.824.963-85', 'Masculino', '88994500130', 'lucasjulio@knowconsulting.com.br', '', 'Portaria', '63018270', 'Total', 'Docente', 'MINTER/Estágio', 'Nacional', 'Universidade Federal do Pará', '2019-11-30', '2020-11-30', '2019-08-03');

--
-- Acionadores `servidor`
--
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

CREATE TABLE `unidade` (
  `cod` int(10) UNSIGNED NOT NULL,
  `nome` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
-- Indexes for dumped tables
--

--
-- Indexes for table `defesa`
--
ALTER TABLE `defesa`
  ADD PRIMARY KEY (`cod`);

--
-- Indexes for table `prorrogacao`
--
ALTER TABLE `prorrogacao`
  ADD PRIMARY KEY (`cod`);

--
-- Indexes for table `relatorio`
--
ALTER TABLE `relatorio`
  ADD PRIMARY KEY (`cod`);

--
-- Indexes for table `servidor`
--
ALTER TABLE `servidor`
  ADD PRIMARY KEY (`cod`);

--
-- Indexes for table `unidade`
--
ALTER TABLE `unidade`
  ADD PRIMARY KEY (`cod`);


--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `defesa`
--
ALTER TABLE `defesa`
  MODIFY `cod` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `prorrogacao`
--
ALTER TABLE `prorrogacao`
  MODIFY `cod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `relatorio`
--
ALTER TABLE `relatorio`
  MODIFY `cod` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `servidor`
--
ALTER TABLE `servidor`
  MODIFY `cod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `unidade`
--
ALTER TABLE `unidade`
  MODIFY `cod` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
  
--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fk_unidade_usuario` FOREIGN KEY (`unidade_cod`) REFERENCES `unidade` (`cod`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
