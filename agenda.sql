-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 13-Jul-2019 às 10:58
-- Versão do servidor: 10.1.40-MariaDB
-- versão do PHP: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `agenda`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `compromissos`
--

CREATE TABLE `compromissos` (
  `id_compromisso` bigint(20) UNSIGNED NOT NULL,
  `id_usuario` bigint(20) NOT NULL,
  `data` date NOT NULL,
  `hora` time NOT NULL,
  `status` varchar(30) COLLATE utf8_bin NOT NULL,
  `descricao` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `compromissos`
--

INSERT INTO `compromissos` (`id_compromisso`, `id_usuario`, `data`, `hora`, `status`, `descricao`) VALUES
(3, 15, '2019-07-13', '06:35:00', 'Ativo', 'Entregar sistema do Guilherme funcionando com PhP e Mysql'),
(4, 15, '2019-07-13', '18:30:00', 'Ativo', 'Pegar platina no lolzinho'),
(5, 15, '2019-07-13', '22:30:00', 'Ativo', 'Assistir segunda temporada de Dark'),
(6, 15, '2019-07-14', '14:00:00', 'Ativo', 'Pesquisar peÃ§as e organizar projeto do Fliperama'),
(7, 15, '2019-07-14', '22:00:00', 'Ativo', 'Terminar de assistir a segunda temporada de Dark'),
(8, 15, '2019-07-15', '11:00:00', 'Ativo', 'Ir nas lojas comprar peÃ§as para o Fliperama'),
(9, 15, '2019-07-15', '17:00:00', 'Ativo', 'Viagem para GuaÃ­ra'),
(10, 15, '2019-07-16', '20:00:00', 'Ativo', 'Sair com a crush'),
(11, 15, '2019-07-22', '16:00:00', 'Ativo', 'Viagem de volta pra Franca');

-- --------------------------------------------------------

--
-- Estrutura da tabela `contatos`
--

CREATE TABLE `contatos` (
  `id_contato` bigint(20) UNSIGNED NOT NULL,
  `id_usuario` bigint(20) NOT NULL,
  `nome` varchar(100) COLLATE utf8_bin NOT NULL,
  `email` varchar(100) COLLATE utf8_bin NOT NULL,
  `telefone` varchar(50) COLLATE utf8_bin NOT NULL,
  `celular` varchar(50) COLLATE utf8_bin NOT NULL,
  `endereco` varchar(50) COLLATE utf8_bin NOT NULL,
  `bairro` varchar(50) COLLATE utf8_bin NOT NULL,
  `cep` varchar(10) COLLATE utf8_bin NOT NULL,
  `cidade` varchar(30) COLLATE utf8_bin NOT NULL,
  `uf` varchar(10) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `contatos`
--

INSERT INTO `contatos` (`id_contato`, `id_usuario`, `nome`, `email`, `telefone`, `celular`, `endereco`, `bairro`, `cep`, `cidade`, `uf`) VALUES
(6, 15, 'Gabriel Gomes Ducati', 'gabriel.ducati@hotmail.com', '(31) 4884-8410', '(31) 96785-2987', 'Rua AnfibÃ³lios, 666', 'Bonfim', '31210-440', 'Belo Horizonte', 'MG'),
(7, 15, 'Davi Gomes Amaral', 'davi.amaral@uol.com.br', '', '(19) 98688-8364', 'Travessa Ã‚ngelo Valler, 947', 'Vila Rezende', '13405-247', 'Piracicaba', 'SP'),
(8, 15, 'Laura Teixeira Gomes', 'laura.gomes@uol.com.br', '(19) 3320-4215', '', 'PraÃ§a Anita Garibaldi, 950', 'Centro', '13015-180', 'Campinas', 'SP'),
(9, 15, 'Matheus Amaral Ducati', 'matheus.ducati@globo.com', '(19) 7898-8841', '(19) 97830-8823', 'Travessa Ã‚ngelo Valler, 546', 'Vila Rezende', '13405-247', 'Piracicaba', 'SP'),
(10, 15, 'Maria Ducati Teixeira', 'maria.teixeira@gmail.com', '', '(71) 91195-9484', 'Rua Anita Cajado, 252', 'Praia Grande', '40725-074', 'Salvador', 'BA'),
(11, 15, 'Giovana Machado Amaral', 'giovana.amaral@gmail.com', '', '', 'Rua Anita Cajado, 402', 'Praia Grande', '40725-074', 'Salvador', 'BA'),
(12, 15, 'JoÃ£o Teixeira Machado', 'joao.machado@icloud.com', '(51) 2329-1365', '', 'Rua Condado, 867', 'Cavalhada', '91751-110', 'Porto Alegre', 'RS'),
(13, 15, 'Rafaela Gomes Teixeira', 'rafaela.teixeira@uol.com.br', '(92) 4389-4142', '(92) 96794-9441', 'Rua Anita Garibald, 307', 'Santo AntÃ´nio', '69029-285', 'Manaus', 'AM');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nome` varchar(100) COLLATE utf8_bin NOT NULL,
  `email` varchar(100) COLLATE utf8_bin NOT NULL,
  `username` varchar(30) COLLATE utf8_bin NOT NULL,
  `senha` varchar(30) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `username`, `senha`) VALUES
(15, 'Conrado dos Santos A. Saud', 'conradosaud@gmail.com', 'conrado', '123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `compromissos`
--
ALTER TABLE `compromissos`
  ADD PRIMARY KEY (`id_compromisso`),
  ADD UNIQUE KEY `id_compromisso` (`id_compromisso`);

--
-- Indexes for table `contatos`
--
ALTER TABLE `contatos`
  ADD PRIMARY KEY (`id_contato`),
  ADD UNIQUE KEY `id_contato` (`id_contato`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `compromissos`
--
ALTER TABLE `compromissos`
  MODIFY `id_compromisso` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `contatos`
--
ALTER TABLE `contatos`
  MODIFY `id_contato` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
