-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 29, 2024 at 09:50 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_sistema_academico`
--
CREATE DATABASE IF NOT EXISTS `db_sistema_academico` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `db_sistema_academico`;

-- --------------------------------------------------------

--
-- Table structure for table `tb_aluno`
--

CREATE TABLE `tb_aluno` (
  `usuario` varchar(30) NOT NULL,
  `turma` char(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tb_aluno`
--

INSERT INTO `tb_aluno` (`usuario`, `turma`) VALUES
('aang', 'A1'),
('alphonse', 'A1'),
('aluno', 'A1'),
('amanda', 'B2'),
('ana', 'B2'),
('andre', 'B2'),
('andreia', 'B2'),
('beatrice', 'A1'),
('bruna', 'B2'),
('Camila', 'B2'),
('carlos', 'B2'),
('daniel', 'B2'),
('dustin', 'A1'),
('edward', 'A1'),
('eleven', 'A1'),
('felipe', 'B2'),
('fernanda', 'C3'),
('greg', 'A1'),
('gustavo', 'C3'),
('isabela', 'C3'),
('jesse', 'A1'),
('joao', 'C3'),
('jonathan', 'A1'),
('juliana', 'C3'),
('katara', 'A1'),
('larissa', 'D4'),
('leticia', 'D4'),
('lucas', 'A1'),
('lucas1', 'D4'),
('marcela', 'D4'),
('mariana', 'D4'),
('max', 'A1'),
('mike', 'A1'),
('nancy', 'A1'),
('pedro', 'D4'),
('professor', 'C3'),
('sokka', 'A1'),
('steve', 'A1'),
('toph', 'A1'),
('will', 'A1'),
('winry', 'A1'),
('wirt', 'A1'),
('zuko', 'A1');

-- --------------------------------------------------------

--
-- Table structure for table `tb_avisos`
--

CREATE TABLE `tb_avisos` (
  `id_aviso` int(11) NOT NULL,
  `titulo_aviso` varchar(60) NOT NULL,
  `texto_aviso` varchar(600) DEFAULT NULL,
  `data_aviso` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tb_avisos`
--

INSERT INTO `tb_avisos` (`id_aviso`, `titulo_aviso`, `texto_aviso`, `data_aviso`) VALUES
(18, 'Teste', '\r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\r\n\r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et ', '2024-11-28');

-- --------------------------------------------------------

--
-- Table structure for table `tb_medias`
--

CREATE TABLE `tb_medias` (
  `usuario` varchar(30) NOT NULL,
  `media1` decimal(3,1) NOT NULL,
  `media2` decimal(3,1) NOT NULL,
  `media3` decimal(3,1) NOT NULL,
  `media4` decimal(3,1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_nota`
--

CREATE TABLE `tb_nota` (
  `usuario` varchar(30) NOT NULL,
  `p1` decimal(3,1) DEFAULT NULL,
  `p2` decimal(3,1) DEFAULT NULL,
  `trabalho` decimal(3,1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tb_nota`
--

INSERT INTO `tb_nota` (`usuario`, `p1`, `p2`, `trabalho`) VALUES
('alphonse', NULL, NULL, NULL),
('aluno', NULL, NULL, NULL),
('amanda', NULL, NULL, NULL),
('ana', NULL, NULL, NULL),
('andre', NULL, NULL, NULL),
('andreia', NULL, NULL, NULL),
('bruna', NULL, NULL, NULL),
('Camila', NULL, NULL, NULL),
('carlos', NULL, NULL, NULL),
('daniel', NULL, NULL, NULL),
('dustin', NULL, NULL, NULL),
('edward', NULL, NULL, NULL),
('eleven', NULL, NULL, NULL),
('felipe', NULL, NULL, NULL),
('fernanda', NULL, NULL, NULL),
('gustavo', NULL, NULL, NULL),
('isabela', NULL, NULL, NULL),
('jesse', NULL, NULL, NULL),
('joao', NULL, NULL, NULL),
('jonathan', NULL, NULL, NULL),
('juliana', NULL, NULL, NULL),
('larissa', NULL, NULL, NULL),
('leticia', NULL, NULL, NULL),
('lucas', NULL, NULL, NULL),
('lucas1', NULL, NULL, NULL),
('marcela', NULL, NULL, NULL),
('mariana', NULL, NULL, NULL),
('max', NULL, NULL, NULL),
('mike', NULL, NULL, NULL),
('nancy', NULL, NULL, NULL),
('pedro', NULL, NULL, NULL),
('professor', NULL, NULL, NULL),
('steve', NULL, NULL, NULL),
('will', NULL, NULL, NULL),
('winry', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_professor`
--

CREATE TABLE `tb_professor` (
  `usuario` varchar(30) NOT NULL,
  `especializacao` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tb_professor`
--

INSERT INTO `tb_professor` (`usuario`, `especializacao`) VALUES
('heisenberg', NULL),
('iroh', NULL),
('izumi', NULL),
('mustang', NULL),
('professor', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_rematricula`
--

CREATE TABLE `tb_rematricula` (
  `data_abertura` date DEFAULT NULL,
  `data_fechamento` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tb_rematricula`
--

INSERT INTO `tb_rematricula` (`data_abertura`, `data_fechamento`) VALUES
('2024-11-30', '2024-12-01');

-- --------------------------------------------------------

--
-- Table structure for table `tb_secretaria`
--

CREATE TABLE `tb_secretaria` (
  `usuario` varchar(30) NOT NULL,
  `cargo` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tb_secretaria`
--

INSERT INTO `tb_secretaria` (`usuario`, `cargo`) VALUES
('gus', NULL),
('secretaria', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_usuarios`
--

CREATE TABLE `tb_usuarios` (
  `usuario` varchar(30) NOT NULL,
  `senha` varchar(30) NOT NULL,
  `divisao` varchar(10) NOT NULL,
  `nome` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tb_usuarios`
--

INSERT INTO `tb_usuarios` (`usuario`, `senha`, `divisao`, `nome`) VALUES
('aang', 'theavatar', 'aluno', 'Aang'),
('alphonse', 'livingArmor123', 'aluno', 'Alphonse Elric'),
('aluno', '123', 'aluno', 'Aluno Poggers'),
('amanda', '123', 'aluno', 'Amanda Costa Santos'),
('ana', '123', 'aluno', 'Ana LuÃ­sa Silva'),
('andre', '123', 'aluno', 'AndrÃ© Luiz Ramos'),
('andreia', '123', 'aluno', 'AndrÃ©ia Santos Silva'),
('beatrice', 'realistBird', 'aluno', 'Beatrice'),
('bruna', '123', 'aluno', 'Bruna Oliveira Silva'),
('Camila', '123', 'aluno', 'Camila Rodrigues Alves'),
('carlos', '123', 'aluno', 'Carlos Eduardo Almeida'),
('daniel', '123', 'aluno', 'Daniel Silva Oliveira'),
('dustin', '123', 'aluno', 'Dustin Henderson'),
('edward', 'imTall', 'aluno', 'Edward Elric'),
('eleven', '123', 'aluno', 'Eleven'),
('felipe', '123', 'aluno', 'Felipe Martins lima'),
('fernanda', '123', 'aluno', 'Fernanda Oliveira Rocha'),
('greg', 'candyCamouflage', 'aluno', 'Greg'),
('gus', 'friedChiken', 'secretaria', 'Gustavo Fring'),
('gustavo', '123', 'aluno', 'Gustavo Santos Lima'),
('heisenberg', 'bluePowder', 'professor', 'Walter White'),
('iroh', 'goodTea', 'professor', 'Iroh'),
('isabela', '123', 'aluno', 'Isabela Nunes Cardoso'),
('izumi', 'briggsNemesis', 'professor', 'Izumi Curtis'),
('jesse', 'justVibing', 'aluno', 'Jesse Pinkman'),
('joao', '123', 'aluno', 'JoÃ£o Gabriel Mendes'),
('jonathan', '123', 'aluno', 'Jonathan Byers'),
('juliana', '123', 'aluno', 'Juliana Pereira Santos'),
('katara', 'theWaterbender', 'aluno', 'Katara'),
('larissa', '123', 'aluno', 'Larissa Carvalho Pereira'),
('leticia', '123', 'aluno', 'LetÃ­cia Silva GonÃ§alves'),
('lucas', '123', 'aluno', 'Lucas Sinclair'),
('lucas1', '123', 'aluno', 'Lucas Ferreira Costa'),
('marcela', '123', 'aluno', 'Marcela Costa Lima'),
('mariana', '123', 'aluno', 'Mariana Castro Barbosa'),
('max', '123', 'aluno', 'Max Mayfield'),
('mike', '123', 'aluno', 'Mike Wheeler'),
('mustang', 'holyFire', 'professor', 'Roy Mustang'),
('nancy', '123', 'aluno', 'Nancy Wheeler'),
('pedro', '123', 'aluno', 'Pedro Ferreiro Astora'),
('professor', '123', 'professor', 'Professor Poggers'),
('secretaria', '123', 'secretaria', 'Secretaria Poggers'),
('sokka', 'greatFood', 'aluno', 'Sokka'),
('steve', '123', 'aluno', 'Steve Harrington'),
('toph', 'iSee', 'aluno', 'Toph'),
('will', 'notTheDemogorgonAgain', 'aluno', 'Will Byers'),
('winry', 'mechanicalMastermind', 'aluno', 'Winry Rockbell'),
('wirt', 'notKitty', 'aluno', 'Wirt'),
('zuko', 'honor', 'aluno', 'Zuko');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_aluno`
--
ALTER TABLE `tb_aluno`
  ADD UNIQUE KEY `usuario` (`usuario`) USING BTREE;

--
-- Indexes for table `tb_avisos`
--
ALTER TABLE `tb_avisos`
  ADD PRIMARY KEY (`id_aviso`);

--
-- Indexes for table `tb_nota`
--
ALTER TABLE `tb_nota`
  ADD KEY `usuario` (`usuario`);

--
-- Indexes for table `tb_professor`
--
ALTER TABLE `tb_professor`
  ADD UNIQUE KEY `usuario` (`usuario`) USING BTREE;

--
-- Indexes for table `tb_secretaria`
--
ALTER TABLE `tb_secretaria`
  ADD UNIQUE KEY `usuario` (`usuario`) USING BTREE;

--
-- Indexes for table `tb_usuarios`
--
ALTER TABLE `tb_usuarios`
  ADD PRIMARY KEY (`usuario`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_avisos`
--
ALTER TABLE `tb_avisos`
  MODIFY `id_aviso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_aluno`
--
ALTER TABLE `tb_aluno`
  ADD CONSTRAINT `tb_aluno_ibfk_1` FOREIGN KEY (`usuario`) REFERENCES `tb_usuarios` (`usuario`) ON DELETE CASCADE;

--
-- Constraints for table `tb_nota`
--
ALTER TABLE `tb_nota`
  ADD CONSTRAINT `tb_nota_ibfk_1` FOREIGN KEY (`usuario`) REFERENCES `tb_aluno` (`usuario`) ON DELETE CASCADE;

--
-- Constraints for table `tb_professor`
--
ALTER TABLE `tb_professor`
  ADD CONSTRAINT `tb_professor_ibfk_1` FOREIGN KEY (`usuario`) REFERENCES `tb_usuarios` (`usuario`) ON DELETE CASCADE;

--
-- Constraints for table `tb_secretaria`
--
ALTER TABLE `tb_secretaria`
  ADD CONSTRAINT `tb_secretaria_ibfk_1` FOREIGN KEY (`usuario`) REFERENCES `tb_usuarios` (`usuario`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
