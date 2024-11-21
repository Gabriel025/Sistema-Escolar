-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 21, 2024 at 02:57 AM
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
('aang', 'theAvatar', 'aluno', 'Aang Airs'),
('alphonse', 'livingArmor123', 'aluno', 'Alphonse Elric'),
('aluno', '123', 'aluno', 'Aluno Poggers'),
('amanda', '123', 'aluno', 'Amanda Costa Santos'),
('ana', '123', 'aluno', 'Ana LuÃ­sa Silva'),
('andre', '123', 'aluno', 'AndrÃ© Luiz Ramos'),
('andreia', '123', 'aluno', 'AndrÃ©ia Santos Silva'),
('beatrice', 'realistBird', 'aluno', 'Beatrice Unknown'),
('bruna', '123', 'aluno', 'Bruna Oliveira Silva'),
('Camila', '123', 'aluno', 'Camila Rodrigues Alves'),
('carlos', '123', 'aluno', 'Carlos Eduardo Almeida'),
('daniel', '123', 'aluno', 'Daniel Silva Oliveira'),
('dustin', '123', 'aluno', 'Dustin Henderson'),
('edward', 'imTall', 'aluno', 'Edward Elric'),
('eleven', '123', 'aluno', 'Eleven'),
('felipe', '123', 'aluno', 'Felipe Martins lima'),
('fernanda', '123', 'aluno', 'Fernanda Oliveira Rocha'),
('greg', 'candyCamouflage', 'aluno', 'Greg Unknown'),
('gus', 'friedChiken', 'secretaria', 'Gustavo Fring'),
('gustavo', '123', 'aluno', 'Gustavo Santos Lima'),
('heisenberg', 'bluePowder', 'professor', 'Walter White'),
('iroh', 'goodTea', 'professor', 'Iroh Firemark'),
('isabela', '123', 'aluno', 'Isabela Nunes Cardoso'),
('izumi', 'briggsNemesis', 'professor', 'Izumi Curtis'),
('jesse', 'justVibing', 'aluno', 'Jesse Pinkman'),
('joao', '123', 'aluno', 'JoÃ£o Gabriel Mendes'),
('jonathan', '123', 'aluno', 'Jonathan Byers'),
('juliana', '123', 'aluno', 'Juliana Pereira Santos'),
('katara', 'theWaterbender', 'aluno', 'Katara Waters'),
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
('sokka', 'greatFood', 'aluno', 'Sokka Waters'),
('steve', '123', 'aluno', 'Steve Harrington'),
('toph', 'iSee', 'aluno', 'Toph Rocksteady'),
('will', 'notTheDemogorgonAgain', 'aluno', 'Will Byers'),
('winry', 'mechanicalMastermind', 'aluno', 'Winry Rockbell'),
('wirt', 'notKitty', 'aluno', 'Wirt Unknown'),
('zuko', 'honor', 'aluno', 'Zuko Firemark');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_aluno`
--
ALTER TABLE `tb_aluno`
  ADD UNIQUE KEY `usuario` (`usuario`) USING BTREE;

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
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_aluno`
--
ALTER TABLE `tb_aluno`
  ADD CONSTRAINT `tb_aluno_ibfk_1` FOREIGN KEY (`usuario`) REFERENCES `tb_usuarios` (`usuario`);

--
-- Constraints for table `tb_professor`
--
ALTER TABLE `tb_professor`
  ADD CONSTRAINT `tb_professor_ibfk_1` FOREIGN KEY (`usuario`) REFERENCES `tb_usuarios` (`usuario`);

--
-- Constraints for table `tb_secretaria`
--
ALTER TABLE `tb_secretaria`
  ADD CONSTRAINT `tb_secretaria_ibfk_1` FOREIGN KEY (`usuario`) REFERENCES `tb_usuarios` (`usuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
