-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 15-Mar-2021 às 03:27
-- Versão do servidor: 10.4.17-MariaDB
-- versão do PHP: 8.0.2

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
-- Estrutura da tabela `agenda`
--

CREATE TABLE `agenda` (
  `id` int(11) NOT NULL,
  `id_pessoa` int(11) NOT NULL,
  `dia_disponivel` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

--
-- Extraindo dados da tabela `diaria_prestador`
--

INSERT INTO `diaria_prestador` (`id_diaria`, `descricao_diaria`, `valor`, `id_pessoa`) VALUES
(3, 'dwa', '200.00', 14);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `pessoa`
--

INSERT INTO `pessoa` (`id_pessoa`, `nome`, `cpf`, `telefone`, `email`, `data_nascimento`, `comprovante`, `tipo_pessoa`, `status_cadastro`, `descricao`, `senha`, `foto`, `sexo`, `cidade`) VALUES
(10, 'aaaaaa', '111.111.111-11', '(44) 99712-6933', 'wslenderw4s@hotmail.com', '2222-02-22', 0x6167725f7661692e73716c, 2, 2, '', '12345678', NULL, 1, 'Maringá'),
(14, 'asdasda', '109.037.409-72', '(44) 99712-6932', 'erickfire31@hotmail.com', '2222-02-22', 0x6167725f7661692e73716c, 1, 2, '', '12345678', NULL, 1, 'Maringá'),
(15, 'Erick Wesley', '021.757.969-81', '(44) 99712-6931', 'wslenderwsreal@gmail.com', '2222-02-22', 0x6167725f7661692e73716c, 2, 2, '', '12345678', NULL, 1, 'Maringá'),
(16, '111aaaa', '111.111.111-22', '(11) 11133-3333', 'ra108344@uem.br', '3333-11-11', 0x6167725f7661692e73716c, 1, 2, '', '1234567e', NULL, 2, 'Maringá'),
(27, 'bruna', '333.444.444-44', '(42) 22222-2222', 'erickfire3211@hotmail.com', '2222-03-12', 0x617661746172392e706e67, 2, 2, 'bom dia', '12345678', 0x617661746172352e706e67, 2, 'Maringá'),
(28, 'erick', '212.122.222-22', '(44) 44444-4444', 'wslenderws321@hotmail.com', '1999-06-20', 0x617661746172382e706e67, 1, 2, '', '12345678', 0x617661746172382e706e67, 1, 'Maringá'),
(31, 'asadão', '222.222.112-22', '(11) 12222-6633', 'ra1083444@uem.br', '2221-02-22', 0x74657374457269636b2e73716c, 2, 2, 'ednaldo pereira', '12345678', '', 1, 'car'),
(32, 'canee', '111.111.114-42', '(22) 21332-3232', 'ra10834441@uem.br', '2221-02-22', 0x74657374457269636b2e73716c, 1, 2, 'aaaa', '12345678', '', 2, 'rrewa'),
(33, 'abelha', '123.444.411-11', '(11) 11222-2344', 'w2s@hotmail.com', '1999-12-23', 0x7461627330383132323032302e73716c, 2, 2, 'sim\r\n', '12345678', '', 1, 'maringa');

-- --------------------------------------------------------

--
-- Estrutura da tabela `servico`
--

CREATE TABLE `servico` (
  `id_servico` int(11) NOT NULL,
  `data_servico` date NOT NULL,
  `hora` time DEFAULT NULL,
  `valor` decimal(10,2) DEFAULT NULL,
  `id_endereco` int(11) NOT NULL,
  `forma_pagamento` varchar(55) NOT NULL,
  `avaliacao` int(11) DEFAULT NULL,
  `status_servico` int(11) DEFAULT 1,
  `id_prestador` int(11) NOT NULL,
  `id_contratante` int(11) NOT NULL,
  `id_diaria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `administrador`
--
ALTER TABLE `administrador`
  ADD PRIMARY KEY (`id_adm`);

--
-- Índices para tabela `agenda`
--
ALTER TABLE `agenda`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_prestador` (`id_pessoa`),
  ADD KEY `idx_dia_disponivel` (`dia_disponivel`);

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
-- Índices para tabela `servico`
--
ALTER TABLE `servico`
  ADD PRIMARY KEY (`id_servico`),
  ADD KEY `id_contratante` (`id_contratante`),
  ADD KEY `id_prestador` (`id_prestador`),
  ADD KEY `id_diaria` (`id_diaria`),
  ADD KEY `id_endereco` (`id_endereco`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `administrador`
--
ALTER TABLE `administrador`
  MODIFY `id_adm` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `agenda`
--
ALTER TABLE `agenda`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=179;

--
-- AUTO_INCREMENT de tabela `diaria_prestador`
--
ALTER TABLE `diaria_prestador`
  MODIFY `id_diaria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `endereco`
--
ALTER TABLE `endereco`
  MODIFY `id_endereco` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de tabela `pessoa`
--
ALTER TABLE `pessoa`
  MODIFY `id_pessoa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `agenda`
--
ALTER TABLE `agenda`
  ADD CONSTRAINT `fk_id_pessoa` FOREIGN KEY (`id_pessoa`) REFERENCES `pessoa` (`id_pessoa`);

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

--
-- Limitadores para a tabela `servico`
--
ALTER TABLE `servico`
  ADD CONSTRAINT `servico_ibfk_1` FOREIGN KEY (`id_contratante`) REFERENCES `pessoa` (`id_pessoa`),
  ADD CONSTRAINT `servico_ibfk_2` FOREIGN KEY (`id_prestador`) REFERENCES `pessoa` (`id_pessoa`),
  ADD CONSTRAINT `servico_ibfk_3` FOREIGN KEY (`id_diaria`) REFERENCES `diaria_prestador` (`id_diaria`),
  ADD CONSTRAINT `servico_ibfk_4` FOREIGN KEY (`id_endereco`) REFERENCES `endereco` (`id_endereco`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
