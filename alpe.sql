-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 14-Maio-2018 às 06:11
-- Versão do servidor: 10.1.29-MariaDB
-- PHP Version: 7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `alpe`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `locais`
--

CREATE TABLE `locais` (
  `id_local` int(11) NOT NULL,
  `nome` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `endereco` varchar(150) NOT NULL,
  `telefone` int(15) NOT NULL,
  `descricao` varchar(300) NOT NULL,
  `categoria` varchar(150) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `locais`
--

INSERT INTO `locais` (`id_local`, `nome`, `email`, `endereco`, `telefone`, `descricao`, `categoria`, `id_usuario`) VALUES
(9, 'Fonte nova', 'teste@mail.com', 'Ladeira da Fonte das Pedras ', 2147483647, 'Pelo menos tem que ser uma descricao mais longa, ja que o bryan caga com o front end e eu tenho que improvisar', 'Futebol', 24),
(10, 'teste2', 'teste@mail.com', 'algum endereco', 2147483647, 'bhla2', 'Basquete', 24),
(13, 'Vila Belmiro', 'luan.alflen4@gmail.com', 'Rua Princesa Isabel', 2147483647, 'Agora quem da bola Ã© o santos, o santos Ã© o novo campeÃ£o...', 'Futebol', 15),
(18, 'Allianz Parque', 'kBryan.matheus@gmail.com', ' Av. Francisco Matarazzo, 1705', 2147483647, 'Bando de pau no cu', 'Futebol', 16);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `login` varchar(150) NOT NULL,
  `senha` varchar(50) NOT NULL,
  `endereco` varchar(100) NOT NULL,
  `telefone` int(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `cpf` int(14) NOT NULL,
  `tipuser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nome`, `login`, `senha`, `endereco`, `telefone`, `email`, `cpf`, `tipuser`) VALUES
(15, 'Luan', 'LuanAlflen', 'IFCARAQUARI2017', 'Adolfo da Veiga 2611', 2147483647, 'luan.alflen4@gmail.com', 2147483647, 1),
(16, 'Bryan', 'BryanKruger', '321', 'Perto do Condor 2071', 2147483647, 'kBryan.matheus@gmail.com', 2147483647, 1),
(24, 'teste', 'login', '12', 'bla', 31256415, 'teste@mail.com', 1561515, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `locais`
--
ALTER TABLE `locais`
  ADD PRIMARY KEY (`id_local`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `locais`
--
ALTER TABLE `locais`
  MODIFY `id_local` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `locais`
--
ALTER TABLE `locais`
  ADD CONSTRAINT `locais_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
