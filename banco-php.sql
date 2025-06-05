-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3307
-- Tempo de geração: 05-Jun-2025 às 15:07
-- Versão do servidor: 10.4.21-MariaDB
-- versão do PHP: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `banco-php`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `filmes`
--

CREATE TABLE `filmes` (
  `id` int(11) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `categoria` varchar(50) NOT NULL,
  `sinopse` text NOT NULL,
  `ano` year(4) NOT NULL,
  `nota` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `filmes`
--

INSERT INTO `filmes` (`id`, `titulo`, `categoria`, `sinopse`, `ano`, `nota`) VALUES
(1, 'Senhor dos Anéis', 'Fantasia', 'O um Anel', 2001, 10);

-- --------------------------------------------------------

--
-- Estrutura da tabela `series`
--

CREATE TABLE `series` (
  `id` int(11) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `categoria` varchar(50) NOT NULL,
  `sinopse` text NOT NULL,
  `ano` year(4) NOT NULL,
  `nota` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `series`
--

INSERT INTO `series` (`id`, `titulo`, `categoria`, `sinopse`, `ano`, `nota`) VALUES
(2, 'The Walking Dead', 'Terror', 'Zumbis AAAAAAAA Morte AAAAAA', 2010, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nome_usuario` varchar(50) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `CPF` char(11) NOT NULL,
  `data_nascimento` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id`, `nome_usuario`, `senha`, `email`, `CPF`, `data_nascimento`) VALUES
(1, 'usu_01', 'senha123', 'usu01@gmail.com', '01010101010', '2001-01-01');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `filmes`
--
ALTER TABLE `filmes`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `series`
--
ALTER TABLE `series`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nome_usuario` (`nome_usuario`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `CPF` (`CPF`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `filmes`
--
ALTER TABLE `filmes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `series`
--
ALTER TABLE `series`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
