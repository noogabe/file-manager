-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 25-Out-2021 às 22:52
-- Versão do servidor: 10.4.20-MariaDB
-- versão do PHP: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `mundojix`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `certificados`
--

CREATE TABLE `certificados` (
  `id_certificado` int(11) NOT NULL,
  `nome_documento` varchar(125) DEFAULT NULL,
  `tipo_atividade` varchar(125) DEFAULT NULL,
  `qtde_horas` int(11) DEFAULT NULL,
  `status_documento` tinyint(1) NOT NULL DEFAULT 0,
  `file_nome` varchar(125) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `certificados`
--

INSERT INTO `certificados` (`id_certificado`, `nome_documento`, `tipo_atividade`, `qtde_horas`, `status_documento`, `file_nome`) VALUES
(16, 'Introdução à criação de Websites com HTML5 e CSS3', 'Desenvolvimento Web', 6, 1, 'certificado.pdf'),
(17, 'Aprenda o que são estruturas de dados e algoritmos', 'Estrutura de dados', 2, 0, 'estrutura-de-dados.pdf'),
(18, 'Lógica de programação essencial', 'Lógica de programação', 4, 0, 'logica-de-programacao-essencial.pdf');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `certificados`
--
ALTER TABLE `certificados`
  ADD PRIMARY KEY (`id_certificado`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `certificados`
--
ALTER TABLE `certificados`
  MODIFY `id_certificado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
