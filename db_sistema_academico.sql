-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 12, 2024 at 08:54 PM
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
('alphonse_123', 'B2'),
('aluno', 'A1');

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
('alphonse_123', 'livingArmor123', 'aluno', 'Alphonse Elric'),
('aluno', '123', 'aluno', 'Aluno Poggers'),
('professor', '123', 'professor', 'Professor Poggers'),
('secretaria', '123', 'secretaria', 'Secretaria Poggers');

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
