-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 04-Maio-2023 às 14:06
-- Versão do servidor: 10.4.24-MariaDB
-- versão do PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `sistemat`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `arquivos`
--

CREATE TABLE `arquivos` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `arquivo` varchar(255) NOT NULL,
  `data` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(10) UNSIGNED NOT NULL,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `admin` tinyint(4) NOT NULL DEFAULT 0,
  `ativo` tinyint(4) NOT NULL DEFAULT 0,
  `recuperar_token` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `username`, `senha`, `admin`, `ativo`, `recuperar_token`) VALUES
(4, 'Jordan Orlando Poletto', 'jordanopoletto@gmai.com', 'Jordano', '$2y$10$BvMMAwjmHphwv0xNzLdfAOfvrvsBKsUt5ey5ZWsPYLoI6rdMuo6WS', 0, 1, NULL),
(5, '20comer', '20comer@gmail.com', '20comer', '$2y$10$NgxAIJWhNJQWM4wjz3g0/.YE2ruIcz6SO6VOEUgWdy1lcz6PinyAO', 0, 1, NULL),
(6, 'jorjão alcides menezes', 'jj@gmail.com', 'jorjao', '$2y$10$uRi3m8OUh5aK/qGbAKlSHO57IWxgh5QzXsrWc146/Ap9z.c5r8x6m', 0, 1, NULL),
(7, 'jorjão alcides menezes', 'jj@gmail.com', 'jorjao', '$2y$10$2Z4yOKoSjlTPYKDFL0mZkeTsPKCikg.8lgeyDVRZYxsdoa31Uc2Sa', 0, 1, NULL),
(8, 'Marcelo celse amadeu', 'reidelas@gmail.com', 'marceloreidelas', '$2y$10$fESzxJlB75U7XRWmNl54WuOXXKezswnfbgvY.44kLXzUU4D64m32S', 0, 1, NULL),
(12, 'jose alves', 'jj@gmail.com', 'zezinho', '$2y$10$3HPGAGrNrOcVEq8ZouRO2uQBds1zFtsB6hKOa/BkAmj52xKD/e6Tq', 0, 1, NULL),
(13, 'jordanodelas', 'reidelas@gmail.com', 'Jordanodelas', '$2y$10$Vy6.TfrZ9Hmyw2vMyX6cWutOBEYiqCKmgU1YwpJNPRiM6ko0dgqN.', 0, 1, NULL),
(14, 'roberto', 'volcirpoletto93155@gmail.com', 'berto', '$2y$10$dvAHiq/LvwMJjU3p3PEGNu64UqG8n8kYWQR3WGUSPCsfWqL6bm3xi', 0, 1, NULL);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `arquivos`
--
ALTER TABLE `arquivos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `arquivos`
--
ALTER TABLE `arquivos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
