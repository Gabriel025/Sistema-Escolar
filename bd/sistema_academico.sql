-- phpMyAdmin SQL Dump
-- version 4.0.4.2
-- http://www.phpmyadmin.net
--
-- Máquina: localhost
-- Data de Criação: 23-Set-2024 às 18:13
-- Versão do servidor: 5.6.13
-- versão do PHP: 5.4.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de Dados: `sistema_academico`
--
CREATE DATABASE IF NOT EXISTS `sistema_academico` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `sistema_academico`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_aluno`
--

CREATE TABLE IF NOT EXISTS `tb_aluno` (
  `usuario` varchar(30) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `turma` char(2) NOT NULL,
  PRIMARY KEY (`usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_aluno`
--

INSERT INTO `tb_aluno` (`usuario`, `nome`, `turma`) VALUES
('alessandra_quintana313', 'Alessandra Daniela Quintana', 'd4'),
('ana_frias313', 'Ana Medina Frias', 'b2'),
('andre_astora304', 'AndrÃ© Silva de Astora', 'c3'),
('dilma_campos313', 'Dilma AragÃ£o Campos', 'c3'),
('fernanda_souza313', 'Fernanda Souza dos Santos', 'a1'),
('hilton_martin304', 'Hilton Martin de AssunÃ§Ã£o', 'a1'),
('igor_lima304', 'Igor dos Santos Lima', 'c3'),
('jorge_assuncao304', 'Jorge Ferminiano de AssunÃ§Ã£o', 'c3'),
('juliana_mendes313', 'Juliana Mendes da Cunha', 'a1'),
('junior_contarrato304', 'Junior Contarrato Almeida', 'b2'),
('luna_torres313', 'Luna Paes Torres', 'a1'),
('marcos_anjos304', 'Marcos Francisco Anjos', 'd4'),
('nilton_lovato304', 'Nilton Lovato', 'b2'),
('noeli_arlete313', 'NoelÃ­ Arlete BeltrÃ£o', 'c3'),
('pablo_havel304', 'Pablo Havel Ferreira', 'd4'),
('raquel_martines313', 'Raquel Selma Martines', 'b2'),
('ronaldo_thiago304', 'Ronaldo Thiago de Cervantes Sobrinho', 'd4'),
('suzana_castro313', 'Suzana Ferreira de Castro', 'd4'),
('tales_mendes304', 'Tales Valter de Mendes ', 'a1'),
('yoruichi_sabrina313', 'Yoruichi Sabrina Duarte', 'b2');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_professor`
--

CREATE TABLE IF NOT EXISTS `tb_professor` (
  `usuario` varchar(30) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `especializacao` varchar(20) NOT NULL,
  PRIMARY KEY (`usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_professor`
--

INSERT INTO `tb_professor` (`usuario`, `nome`, `especializacao`) VALUES
('aline_janete313', 'Aline Janete Ferreira', ''),
('altair_leal304', 'Altair de Souza Leal', ''),
('clarice_flores313', 'Clarice Espinoza Flores', ''),
('josiane_bezerra313', 'Josiane Larissa de Bezerra', ''),
('krikor_sevag304', 'Krikor Sevag Mekhtarian', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_secretaria`
--

CREATE TABLE IF NOT EXISTS `tb_secretaria` (
  `usuario` varchar(30) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `cargo` varchar(30) NOT NULL,
  PRIMARY KEY (`usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_secretaria`
--

INSERT INTO `tb_secretaria` (`usuario`, `nome`, `cargo`) VALUES
('aline_marques313', 'Aline Maria Marques', ''),
('joana_cruz313', 'Joana BÃ¡rbara Cruz de Ferminiano', ''),
('julio_correia304', 'Julio Yeda Correia', ''),
('shirley_padilha313', 'Shirley Fernandes Padilha', ''),
('viviane_marques313', 'Viviane Maria Marques', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_usuarios`
--

CREATE TABLE IF NOT EXISTS `tb_usuarios` (
  `usuario` varchar(30) NOT NULL,
  `senha` varchar(30) NOT NULL,
  `divisao` varchar(10) NOT NULL,
  PRIMARY KEY (`usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_usuarios`
--

INSERT INTO `tb_usuarios` (`usuario`, `senha`, `divisao`) VALUES
('alessandra_quintana313', 'alessandra1234', 'aluno'),
('aline_janete313', 'aline1234', 'professor'),
('aline_marques313', 'aline1234', 'secretaria'),
('altair_leal304', 'altair4321', 'professor'),
('ana_frias313', 'ana1234', 'aluno'),
('andre_astora304', 'andre4321', 'aluno'),
('clarice_flores', 'clarice1234', 'professor'),
('dilma_campos313', 'dilma1234', 'aluno'),
('fernanda_souza313', 'fernanda1234', 'aluno'),
('hilton_martin304', 'holtion_martin4321', 'aluno'),
('igor_lima304', 'igor4321', 'aluno'),
('joana_cruz313', 'joana1234', 'secretaria'),
('jorge_assuncao304', 'jorge4321', 'aluno'),
('josiane_bezerra313', 'josiane1234', 'professor'),
('juliana_mendes313', 'juliana1234', 'aluno'),
('julio_correia304', 'julio4321', 'secretaria'),
('junior_contarrato304', 'junior4321', 'aluno'),
('krikor_sevag304', 'krikor4321', 'professor'),
('luna_torres313', 'luna1234', 'aluno'),
('marcos_anjos304', 'marcos4321', 'aluno'),
('nilton_lovato304', 'niilton4321', 'aluno'),
('noeli_arlete313', 'noeli1234', 'aluno'),
('pablo_havel304', 'pablo4321', 'aluno'),
('raquel_martines313', 'raquel1234', 'aluno'),
('ronaldo_thiago304', 'ronaldo4321', 'aluno'),
('shirley_padilha313', 'shirley1234', 'secretaria'),
('suzana_castro304', 'suzana1234', 'aluno'),
('tales_mendes', 'tales4321', 'aluno'),
('viviane_marques313', 'viviane1234', 'secretaria'),
('yoruichi_sabrina313', 'yoruichi1234', 'aluno');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
