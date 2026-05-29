-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 30/05/2026 às 00:39
-- Versão do servidor: 10.4.28-MariaDB
-- Versão do PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `techmetal`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `alocacoes`
--

CREATE TABLE `alocacoes` (
  `id` int(11) NOT NULL,
  `maquina` varchar(150) NOT NULL,
  `data_movimento` date NOT NULL,
  `setor_atual` varchar(50) NOT NULL,
  `setor_anterior` varchar(50) NOT NULL,
  `responsavel` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `ativos`
--

CREATE TABLE `ativos` (
  `id` int(11) NOT NULL,
  `maquina` varchar(150) NOT NULL,
  `modelo` varchar(20) NOT NULL,
  `funcionalidade` varchar(100) NOT NULL,
  `equipamentos` varchar(150) NOT NULL,
  `n_patrimonio` int(4) NOT NULL,
  `setor` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `equipamentos`
--

CREATE TABLE `equipamentos` (
  `id` int(11) NOT NULL,
  `tipo` varchar(150) NOT NULL,
  `objetivo` varchar(50) NOT NULL,
  `quantidade` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `manutencoes`
--

CREATE TABLE `manutencoes` (
  `id` int(11) NOT NULL,
  `problema` varchar(220) NOT NULL,
  `prioridade` varchar(20) NOT NULL,
  `data_inicio` date NOT NULL,
  `data_fim` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `manutencoes`
--

INSERT INTO `manutencoes` (`id`, `problema`, `prioridade`, `data_inicio`, `data_fim`) VALUES
(1, 'Vazamento de Oleo', 'ALTA', '2026-05-26', '2026-05-27'),
(2, 'Troca de correia', 'MEDIA', '2026-05-27', '2026-05-27'),
(3, 'Troca de reparos', 'BAIXA', '2026-05-25', '2026-05-27');

-- --------------------------------------------------------

--
-- Estrutura para tabela `operadores`
--

CREATE TABLE `operadores` (
  `id` int(11) NOT NULL,
  `nome` varchar(150) NOT NULL,
  `cpf` int(20) NOT NULL,
  `funcao` varchar(100) NOT NULL,
  `genero` varchar(10) NOT NULL,
  `login` varchar(100) NOT NULL,
  `senha` varchar(100) NOT NULL,
  `senha_secundaria` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `operadores`
--

INSERT INTO `operadores` (`id`, `nome`, `cpf`, `funcao`, `genero`, `login`, `senha`, `senha_secundaria`) VALUES
(1, 'Jose', 25252525, 'admin', 'masculino', 'admin', 'admin', ''),
(3, 'Dionisio cavalcante', 2147483647, 'Mecanico', 'masculino', 'mecanico', '1234', '');

-- --------------------------------------------------------

--
-- Estrutura para tabela `ordem_manutencoes`
--

CREATE TABLE `ordem_manutencoes` (
  `id` int(11) NOT NULL,
  `id_ordem` int(11) NOT NULL,
  `manutencao` int(11) NOT NULL,
  `equipamentos` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `setores`
--

CREATE TABLE `setores` (
  `id` int(11) NOT NULL,
  `setor` varchar(150) NOT NULL,
  `quant_funcionarios` int(11) NOT NULL,
  `funcao` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `alocacoes`
--
ALTER TABLE `alocacoes`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `ativos`
--
ALTER TABLE `ativos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `equipamentos`
--
ALTER TABLE `equipamentos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `manutencoes`
--
ALTER TABLE `manutencoes`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `operadores`
--
ALTER TABLE `operadores`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `setores`
--
ALTER TABLE `setores`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `alocacoes`
--
ALTER TABLE `alocacoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `ativos`
--
ALTER TABLE `ativos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `equipamentos`
--
ALTER TABLE `equipamentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `manutencoes`
--
ALTER TABLE `manutencoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `operadores`
--
ALTER TABLE `operadores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `setores`
--
ALTER TABLE `setores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
