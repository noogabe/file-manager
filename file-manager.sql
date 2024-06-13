-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 28-Out-2021 às 13:32
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
-- Banco de dados: `file-manager`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `documentos`
--

CREATE TABLE `documentos` (
  `id_documento` int(11) NOT NULL,
  `nome_documento` varchar(125) DEFAULT NULL,
  `tipo_atividade` varchar(125) DEFAULT NULL,
  `qtde_horas` int(11) DEFAULT NULL,
  `status_documento` tinyint(1) NOT NULL DEFAULT 0,
  `file_nome` varchar(125) DEFAULT NULL,
  `file_type` varchar(125) DEFAULT NULL,
  `file_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `documentos`
--

INSERT INTO `documentos` (`id_documento`, `nome_documento`, `tipo_atividade`, `qtde_horas`, `status_documento`, `file_nome`, `file_type`, `file_date`) VALUES
(16, 'Criação de Websites com HTML5 e CSS3', 'Desenvolvimento Web', 6, 1, 'certificado.pdf', 'application/pdf', '2021-10-26'),
(17, 'O que são estruturas de dados e algoritmos', 'Estrutura de dados', 2, 0, 'estrutura-de-dados.pdf', 'application/pdf', '2021-10-26'),
(18, 'Lógica de programação essencial', 'Lógica de programação', 4, 0, 'logica-de-programacao-essencial.pdf', 'application/pdf', '2021-10-26');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `documentos`
--
ALTER TABLE `documentos`
  ADD PRIMARY KEY (`id_documento`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `documentos`
--
ALTER TABLE `documentos`
  MODIFY `id_documento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
