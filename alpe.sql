-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 09-Jul-2018 às 16:51
-- Versão do servidor: 5.7.21-0ubuntu0.16.04.1
-- PHP Version: 7.0.22-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
-- Estrutura da tabela `categoria`
--

CREATE TABLE `categoria` (
  `id_categoria` int(11) NOT NULL,
  `nome` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `categoria`
--

INSERT INTO `categoria` (`id_categoria`, `nome`) VALUES
(1, 'Futebol'),
(2, 'Basquete'),
(3, 'Volei'),
(4, 'Tenis');

-- --------------------------------------------------------

--
-- Estrutura da tabela `comentarios`
--

CREATE TABLE `comentarios` (
  `id_comentario` int(11) NOT NULL,
  `data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `texto` varchar(1000) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_local` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `comentarios`
--

INSERT INTO `comentarios` (`id_comentario`, `data`, `texto`, `id_usuario`, `id_local`) VALUES
(1, '2018-06-26 12:18:44', 'teste', 24, 27),
(2, '2018-06-26 12:23:46', 'outro teste', 24, 27),
(3, '2018-06-26 12:24:04', 'outro teste', 24, 27),
(4, '2018-07-09 18:45:18', 'teste', 24, 23),
(5, '2018-07-09 18:45:23', 'ola', 24, 23),
(6, '2018-07-09 18:53:20', 'gostei', 24, 22);

-- --------------------------------------------------------

--
-- Estrutura da tabela `locais`
--

CREATE TABLE `locais` (
  `id_local` int(11) NOT NULL,
  `foto` varchar(300) DEFAULT NULL,
  `nome` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `endereco` varchar(150) NOT NULL,
  `numero` int(11) DEFAULT NULL,
  `telefone` int(15) NOT NULL,
  `descricao` varchar(300) NOT NULL,
  `id_estado` int(11) NOT NULL,
  `id_municipio` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `locais`
--

INSERT INTO `locais` (`id_local`, `foto`, `nome`, `email`, `endereco`, `numero`, `telefone`, `descricao`, `id_estado`, `id_municipio`, `id_categoria`, `id_usuario`) VALUES
(22, '1606201801490812kWin.jpg', 'Quadra de volei', 'teste@mail.com', 'Adolfo da Veiga', 2611, 898989989, 'bem-vindo a essa quadra maravilhosa que vai ser cadastrada', 42, 4209102, 3, 24),
(23, '15062018072901PrimeiraWinFPP.jpg', 'Vila Belmiro', 'luan.alflen4@gmail.com', 'Rua Princesa Isabel', 501, 9899595, 'Agora quem da bola Ã© o santos', 35, 3548500, 1, 15),
(24, '1606201805051920180516183741_1.jpg', 'casa do hugo', 'a@a', 'Zozimo de oliveira', 117, 98959, 'bla', 42, 4209102, 4, 24),
(27, '25062018040630robo.png', 'Quadra IFC', 'ifc@ifc.edu.br', 'Rodovia BR 280, km 27 - CÃ¢mpus Araquari, Araquari - SC, 89245-000', 27, 87864684, 'bla bland kdjndk ', 42, 4201307, 4, 24);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `login` varchar(150) NOT NULL,
  `senha` varchar(50) NOT NULL,
  `telefone` varchar(200) NOT NULL,
  `email` varchar(50) NOT NULL,
  `cpf` varchar(200) NOT NULL,
  `tipuser` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nome`, `login`, `senha`, `telefone`, `email`, `cpf`, `tipuser`) VALUES
(15, 'Luan', 'LuanAlflen', '123', '2147483647', 'luan.alflen4@gmail.com', '2147483647', 'comum'),
(16, 'Bryan', 'BryanKruger', '321', '2147483647', 'kBryan.matheus@gmail.com', '2147483647', 'comum'),
(24, 'teste', 'login', '12', '31256415', 'teste@mail.com', '1561515', 'comum'),
(34, 'Administrador', 'Adm', '7967017457', '047 996000900', 'luan.alflen4@gmail.com', '09118737919', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indexes for table `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`id_comentario`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_local` (`id_local`);

--
-- Indexes for table `locais`
--
ALTER TABLE `locais`
  ADD PRIMARY KEY (`id_local`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_categoria` (`id_categoria`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `id_comentario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `locais`
--
ALTER TABLE `locais`
  MODIFY `id_local` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `comentarios`
--
ALTER TABLE `comentarios`
  ADD CONSTRAINT `comentarios_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`),
  ADD CONSTRAINT `comentarios_ibfk_2` FOREIGN KEY (`id_local`) REFERENCES `locais` (`id_local`);

--
-- Limitadores para a tabela `locais`
--
ALTER TABLE `locais`
  ADD CONSTRAINT `locais_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`),
  ADD CONSTRAINT `locais_ibfk_2` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id_categoria`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
