-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 06-Dez-2020 às 21:32
-- Versão do servidor: 10.4.14-MariaDB
-- versão do PHP: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `test`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `administrador`
--

CREATE TABLE `administrador` (
  `id_adm` int(11) NOT NULL,
  `sessao` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `administrador`
--

INSERT INTO `administrador` (`id_adm`, `sessao`) VALUES
(1, 'Adm_Teste');

-- --------------------------------------------------------

--
-- Estrutura da tabela `diaria_prestador`
--

CREATE TABLE `diaria_prestador` (
  `id_diaria` int(11) NOT NULL,
  `descricao_diaria` varchar(400) NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `id_pessoa` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `endereco`
--

CREATE TABLE `endereco` (
  `id_endereco` int(11) NOT NULL,
  `bairro` varchar(100) NOT NULL,
  `rua` varchar(100) NOT NULL,
  `numero` int(11) NOT NULL,
  `complemento` varchar(100) DEFAULT NULL,
  `cep` varchar(10) NOT NULL,
  `id_pessoa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pessoa`
--

CREATE TABLE `pessoa` (
  `id_pessoa` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `cpf` varchar(20) NOT NULL,
  `telefone` varchar(80) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `data_nascimento` date NOT NULL,
  `comprovante` blob DEFAULT NULL,
  `tipo_pessoa` int(11) DEFAULT NULL,
  `status_cadastro` int(1) NOT NULL,
  `descricao` varchar(80) NOT NULL,
  `senha` varchar(11) NOT NULL,
  `foto` blob DEFAULT NULL,
  `sexo` int(11) DEFAULT NULL,
  `cidade` varchar(80) NOT NULL
) ;

--
-- Extraindo dados da tabela `pessoa`
--

INSERT INTO `pessoa` (`id_pessoa`, `nome`, `cpf`, `telefone`, `email`, `data_nascimento`, `comprovante`, `tipo_pessoa`, `status_cadastro`, `descricao`, `senha`, `foto`, `sexo`, `cidade`) VALUES
(10, 'aaaaaa', '111.111.111-11', '(44) 99712-6933', 'wslenderws@hotmail.com', '2222-02-22', 0x6167725f7661692e73716c, 2, 2, '', '12345678', NULL, 1, 'Maringá'),
(14, 'asdasda', '109.037.409-72', '(44) 99712-6932', 'erickfire1@hotmail.com', '2222-02-22', 0x6167725f7661692e73716c, 1, 2, '', '12345678', NULL, 1, 'Maringá'),
(15, 'Erick Wesley', '021.757.969-81', '(44) 99712-6931', 'wslenderwsreal@gmail.com', '2222-02-22', 0x6167725f7661692e73716c, 2, 2, '', '12345678', NULL, 1, 'Maringá'),
(16, '111aaaa', '111.111.111-22', '(11) 11133-3333', 'ra108344@uem.br', '3333-11-11', 0x6167725f7661692e73716c, 1, 2, '', '1234567e', NULL, 2, 'Maringá');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `administrador`
--
ALTER TABLE `administrador`
  ADD PRIMARY KEY (`id_adm`);

--
-- Índices para tabela `diaria_prestador`
--
ALTER TABLE `diaria_prestador`
  ADD PRIMARY KEY (`id_diaria`),
  ADD KEY `id_pessoa` (`id_pessoa`);

--
-- Índices para tabela `endereco`
--
ALTER TABLE `endereco`
  ADD PRIMARY KEY (`id_endereco`),
  ADD UNIQUE KEY `numero` (`numero`),
  ADD KEY `id_pessoa` (`id_pessoa`);

--
-- Índices para tabela `pessoa`
--
ALTER TABLE `pessoa`
  ADD PRIMARY KEY (`id_pessoa`),
  ADD UNIQUE KEY `cpf` (`cpf`),
  ADD UNIQUE KEY `telefone` (`telefone`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `administrador`
--
ALTER TABLE `administrador`
  MODIFY `id_adm` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `diaria_prestador`
--
ALTER TABLE `diaria_prestador`
  MODIFY `id_diaria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `endereco`
--
ALTER TABLE `endereco`
  MODIFY `id_endereco` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de tabela `pessoa`
--
ALTER TABLE `pessoa`
  MODIFY `id_pessoa` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `diaria_prestador`
--
ALTER TABLE `diaria_prestador`
  ADD CONSTRAINT `diaria_prestador_ibfk_1` FOREIGN KEY (`id_pessoa`) REFERENCES `pessoa` (`id_pessoa`);

--
-- Limitadores para a tabela `endereco`
--
ALTER TABLE `endereco`
  ADD CONSTRAINT `endereco_ibfk_1` FOREIGN KEY (`id_pessoa`) REFERENCES `pessoa` (`id_pessoa`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
