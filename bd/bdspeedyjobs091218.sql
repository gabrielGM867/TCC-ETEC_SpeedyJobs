-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 10-Dez-2018 às 01:31
-- Versão do servidor: 5.7.19
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bd_speedyjobs`
--
DROP DATABASE IF EXISTS `bd_speedyjobs`;
CREATE DATABASE IF NOT EXISTS `bd_speedyjobs` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `bd_speedyjobs`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbclientes`
--

DROP TABLE IF EXISTS `tbclientes`;
CREATE TABLE IF NOT EXISTS `tbclientes` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `nomeUsuario` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `cpf` varchar(15) NOT NULL,
  `dataNascimento` date NOT NULL,
  `sexo` varchar(1) NOT NULL,
  `senha` varchar(100) NOT NULL,
  `foto` varchar(100) DEFAULT NULL,
  `fotoCapa` varchar(100) NOT NULL,
  `statusEmail` varchar(1) DEFAULT NULL,
  `codtbUsuarios` int(1) DEFAULT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tbclientes`
--

INSERT INTO `tbclientes` (`codigo`, `nome`, `nomeUsuario`, `email`, `cpf`, `dataNascimento`, `sexo`, `senha`, `foto`, `fotoCapa`, `statusEmail`, `codtbUsuarios`) VALUES
(1, 'Leonardo Nogueira', 'Leo Nogueira', 'leojw2000@hotmail.com', '48726922843', '2000-04-16', 'm', 'a503938ca7be1225b245b3db9c12ea8b', 'fotosUsuarios/user.png', 'fotosUsuarios/fotosCapa/7c69eb2722f2bd096241be8add1c92c9.jpg', '0', 1),
(2, 'Gabriel Leão', 'Gabriel 123', 'gabrielleao@hotmail.com', '49316367050', '1999-01-18', 'm', 'a503938ca7be1225b245b3db9c12ea8b', 'fotosUsuarios/user.png', '0', '0', 2),
(3, 'Gabriel Macedo', 'Gabriel 456', 'gabrielmacedo@hotmail.com', '06375390281', '1998-05-19', 'm', 'a503938ca7be1225b245b3db9c12ea8b', 'fotosUsuarios/user.png', '0', '0', 3),
(4, 'Guilherme Modesto', 'Gui Modesto', 'guilhermemodesto@hotmail.com', '44691305408', '1997-08-08', 'm', 'a503938ca7be1225b245b3db9c12ea8b', 'fotosUsuarios/user.png', '0', '0', 4),
(5, 'Kleber Machado', 'Kleber 88', 'klebermachado@hotmail.com', '45803616362', '1998-07-07', 'm', 'a503938ca7be1225b245b3db9c12ea8b', 'fotosUsuarios/user.png', '0', '0', 5);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbdetalhespedido`
--

DROP TABLE IF EXISTS `tbdetalhespedido`;
CREATE TABLE IF NOT EXISTS `tbdetalhespedido` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `codPedido` int(11) NOT NULL,
  `codCliente` int(11) NOT NULL,
  `codFuncionario` int(11) NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`codigo`),
  KEY `codPedido` (`codPedido`),
  KEY `codCliente` (`codCliente`),
  KEY `codFuncionario` (`codFuncionario`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbenderecocliente`
--

DROP TABLE IF EXISTS `tbenderecocliente`;
CREATE TABLE IF NOT EXISTS `tbenderecocliente` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `codCliente` int(11) NOT NULL,
  `cep` varchar(8) DEFAULT NULL,
  `rua` varchar(100) DEFAULT NULL,
  `numero` varchar(10) DEFAULT NULL,
  `bairro` varchar(100) DEFAULT NULL,
  `cidade` varchar(100) DEFAULT NULL,
  `estado` varchar(2) DEFAULT NULL,
  PRIMARY KEY (`codigo`),
  KEY `codCliente` (`codCliente`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tbenderecocliente`
--

INSERT INTO `tbenderecocliente` (`codigo`, `codCliente`, `cep`, `rua`, `numero`, `bairro`, `cidade`, `estado`) VALUES
(1, 1, '03626040', 'Rua Maria de Toledo Piza', '61', 'Vila Domitila', 'São Paulo', 'SP'),
(2, 2, '02248030', 'Rua Anajatena', '48', 'Parada Inglesa', 'São Paulo', 'SP'),
(3, 3, '29122440', 'Rua Gomes Machado', '8', 'Glória', 'Vila Velha', 'ES'),
(4, 4, '29122440', 'Rua Gomes Machado', '8', 'Glória', 'Vila Velha', 'ES'),
(5, 5, '59063040', 'Rua Pedro Velho', '99', 'Lagoa Nova', 'Natal', 'RN');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbenderecofuncionario`
--

DROP TABLE IF EXISTS `tbenderecofuncionario`;
CREATE TABLE IF NOT EXISTS `tbenderecofuncionario` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `codFunci` int(11) NOT NULL,
  `cep` varchar(8) DEFAULT NULL,
  `rua` varchar(100) DEFAULT NULL,
  `numero` varchar(10) DEFAULT NULL,
  `bairro` varchar(100) DEFAULT NULL,
  `cidade` varchar(100) DEFAULT NULL,
  `estado` varchar(2) DEFAULT NULL,
  PRIMARY KEY (`codigo`),
  KEY `codFunci` (`codFunci`)
) ENGINE=MyISAM AUTO_INCREMENT=41 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tbenderecofuncionario`
--

INSERT INTO `tbenderecofuncionario` (`codigo`, `codFunci`, `cep`, `rua`, `numero`, `bairro`, `cidade`, `estado`) VALUES
(1, 1, '59037625', 'Rua Wanderley Bulhões', '87', 'Alecrim', 'Natal', 'RN'),
(2, 2, '03626040', 'Rua Maria de Toledo Piza', '87', 'Vila Domitila', 'São Paulo', 'SP'),
(3, 3, '03626040', 'Rua Maria de Toledo Piza', '55', 'Vila Domitila', 'São Paulo', 'SP'),
(4, 4, '03626040', 'Rua Maria de Toledo Piza', '78', 'Vila Domitila', 'São Paulo', 'SP'),
(5, 5, '03626040', 'Rua Maria de Toledo Piza', '20', 'Vila Domitila', 'São Paulo', 'SP'),
(6, 6, '03626040', 'Rua Maria de Toledo Piza', '100', 'Vila Domitila', 'São Paulo', 'SP'),
(7, 7, '03626040', 'Rua Maria de Toledo Piza', '99', 'Vila Domitila', 'São Paulo', 'SP'),
(8, 8, '03626040', 'Rua Maria de Toledo Piza', '98', 'Vila Domitila', 'São Paulo', 'SP'),
(9, 9, '03626040', 'Rua Maria de Toledo Piza', '97', 'Vila Domitila', 'São Paulo', 'SP'),
(10, 10, '03626040', 'Rua Maria de Toledo Piza', '77', 'Vila Domitila', 'São Paulo', 'SP'),
(11, 11, '03626040', 'Rua Maria de Toledo Piza', '95', 'Vila Domitila', 'São Paulo', 'SP'),
(12, 12, '03626040', 'Rua Maria de Toledo Piza', '92', 'Vila Domitila', 'São Paulo', 'SP'),
(13, 13, '03626040', 'Rua Maria de Toledo Piza', '77', 'Vila Domitila', 'São Paulo', 'SP'),
(14, 14, '03626040', 'Rua Maria de Toledo Piza', '88', 'Vila Domitila', 'São Paulo', 'SP'),
(15, 15, '03626040', 'Rua Maria de Toledo Piza', '77', 'Vila Domitila', 'São Paulo', 'SP'),
(16, 16, '03626040', 'Rua Maria de Toledo Piza', '45', 'Vila Domitila', 'São Paulo', 'SP'),
(17, 17, '03626040', 'Rua Maria de Toledo Piza', '20', 'Vila Domitila', 'São Paulo', 'SP'),
(18, 18, '03626040', 'Rua Maria de Toledo Piza', '', 'Vila Domitila', 'São Paulo', 'SP'),
(19, 19, '03626040', 'Rua Maria de Toledo Piza', '142', 'Vila Domitila', 'São Paulo', 'SP'),
(20, 20, '03626040', 'Rua Maria de Toledo Piza', '54', 'Vila Domitila', 'São Paulo', 'SP'),
(21, 21, '03626040', 'Rua Maria de Toledo Piza', '49', 'Vila Domitila', 'São Paulo', 'SP'),
(22, 22, '03626040', 'Rua Maria de Toledo Piza', '55', 'Vila Domitila', 'São Paulo', 'SP'),
(23, 23, '03626040', 'Rua Maria de Toledo Piza', '555', 'Vila Domitila', 'São Paulo', 'SP'),
(24, 24, '03626040', 'Rua Maria de Toledo Piza', '12', 'Vila Domitila', 'São Paulo', 'SP'),
(25, 25, '03626040', 'Rua Maria de Toledo Piza', '222', 'Vila Domitila', 'São Paulo', 'SP'),
(26, 26, '03626040', 'Rua Maria de Toledo Piza', '586', 'Vila Domitila', 'São Paulo', 'SP'),
(27, 27, '03626040', 'Rua Maria de Toledo Piza', '9966', 'Vila Domitila', 'São Paulo', 'SP'),
(28, 28, '03626040', 'Rua Maria de Toledo Piza', '200', 'Vila Domitila', 'São Paulo', 'SP'),
(29, 29, '03626040', 'Rua Maria de Toledo Piza', '187', 'Vila Domitila', 'São Paulo', 'SP'),
(30, 30, '03626040', 'Rua Maria de Toledo Piza', '23', 'Vila Domitila', 'São Paulo', 'SP'),
(31, 31, '03626040', 'Rua Maria de Toledo Piza', '563', 'Vila Domitila', 'São Paulo', 'SP'),
(32, 32, '03626040', 'Rua Maria de Toledo Piza', '567', 'Vila Domitila', 'São Paulo', 'SP'),
(33, 33, '03626040', 'Rua Maria de Toledo Piza', '02', 'Vila Domitila', 'São Paulo', 'SP'),
(34, 34, '03626040', 'Rua Maria de Toledo Piza', '879', 'Vila Domitila', 'São Paulo', 'SP'),
(35, 35, '03626040', 'Rua Maria de Toledo Piza', '003', 'Vila Domitila', 'São Paulo', 'SP'),
(36, 36, '03626040', 'Rua Maria de Toledo Piza', '566', 'Vila Domitila', 'São Paulo', 'SP'),
(37, 37, '03626040', 'Rua Maria de Toledo Piza', '339', 'Vila Domitila', 'São Paulo', 'SP'),
(38, 38, '03626040', 'Rua Maria de Toledo Piza', '1000', 'Vila Domitila', 'São Paulo', 'SP'),
(39, 39, '03626040', 'Rua Maria de Toledo Piza', '27', 'Vila Domitila', 'São Paulo', 'SP'),
(40, 40, '03626040', 'Rua Maria de Toledo Piza', '2524', 'Vila Domitila', 'São Paulo', 'SP');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbformcliente`
--

DROP TABLE IF EXISTS `tbformcliente`;
CREATE TABLE IF NOT EXISTS `tbformcliente` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `codCliente` int(11) NOT NULL,
  `codFunci` int(11) NOT NULL,
  `codServico` int(11) NOT NULL,
  `agencia` varchar(20) DEFAULT NULL,
  `conta` varchar(20) DEFAULT NULL,
  `valor` int(20) DEFAULT NULL,
  PRIMARY KEY (`codigo`),
  KEY `codCliente` (`codCliente`),
  KEY `codFunci` (`codFunci`),
  KEY `codServico` (`codServico`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbformfunci`
--

DROP TABLE IF EXISTS `tbformfunci`;
CREATE TABLE IF NOT EXISTS `tbformfunci` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `codFunci` int(11) NOT NULL,
  `codCliente` int(11) NOT NULL,
  `codServico` int(11) NOT NULL,
  `dataInicio` date DEFAULT NULL,
  `horaInicio` time DEFAULT NULL,
  `dataFinal` date DEFAULT NULL,
  `horaFinal` time DEFAULT NULL,
  `agencia` varchar(20) DEFAULT NULL,
  `conta` varchar(20) DEFAULT NULL,
  `valor` int(20) DEFAULT NULL,
  `negocioFechado` varchar(1) DEFAULT NULL,
  PRIMARY KEY (`codigo`),
  KEY `codFunci` (`codFunci`),
  KEY `codCliente` (`codCliente`),
  KEY `codServico` (`codServico`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbfuncionarios`
--

DROP TABLE IF EXISTS `tbfuncionarios`;
CREATE TABLE IF NOT EXISTS `tbfuncionarios` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `nomeUsuario` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `profissao` varchar(50) NOT NULL,
  `cpf` varchar(15) NOT NULL,
  `dataNascimento` date NOT NULL,
  `telefone` varchar(25) NOT NULL,
  `sexo` varchar(1) NOT NULL,
  `senha` varchar(100) NOT NULL,
  `foto` varchar(100) DEFAULT NULL,
  `fotoCapa` varchar(100) NOT NULL,
  `classificacao` float DEFAULT NULL,
  `quantClass` int(100) NOT NULL,
  `statusEmail` varchar(1) DEFAULT NULL,
  `codtbUsuarios` int(1) DEFAULT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=MyISAM AUTO_INCREMENT=41 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tbfuncionarios`
--

INSERT INTO `tbfuncionarios` (`codigo`, `nome`, `nomeUsuario`, `email`, `profissao`, `cpf`, `dataNascimento`, `telefone`, `sexo`, `senha`, `foto`, `fotoCapa`, `classificacao`, `quantClass`, `statusEmail`, `codtbUsuarios`) VALUES
(1, 'Larissa Meireles', 'Larissa 123', 'larissa2000@hotmail.com', 'Jardineira', '03267056357', '2000-12-07', '5589423544', 'f', 'a503938ca7be1225b245b3db9c12ea8b', 'fotosUsuarios/user.png', '0', 0, 0, '0', 6),
(2, 'Vanessa Cristina', 'Vanessa 87', 'vanessa@hotmail.com', 'Jardineira', '61421342740', '2000-04-16', '11987456234', 'f', 'a503938ca7be1225b245b3db9c12ea8b', 'fotosUsuarios/user.png', '0', 0, 0, '0', 7),
(3, 'João Henrique', 'João 456', 'joao@hotmail.com', 'Jardineiro', '76761724627', '2000-05-19', '11897553001', 'm', 'a503938ca7be1225b245b3db9c12ea8b', 'fotosUsuarios/user.png', '0', 0, 0, '0', 8),
(4, 'Rodrigo santos', 'Rodrigo 578', 'rodrigo@hotmail.com', 'Jardineiro', '40478135750', '1995-05-08', '11984971866', 'm', 'a503938ca7be1225b245b3db9c12ea8b', 'fotosUsuarios/user.png', '0', 0, 0, '0', 9),
(5, 'Rafael Santiago', 'Rafael Santos', 'rafael@hotmail.com', 'Jardineiro', '62884232117', '2000-05-16', '11905489633', 'm', 'a503938ca7be1225b245b3db9c12ea8b', 'fotosUsuarios/user.png', '0', 0, 0, '0', 10),
(6, 'Giovanna Gomes', 'Gio 157', 'giovanna@hotmail.com', 'Carpinteira', '55123182764', '1988-02-02', '11987852000', 'f', 'a503938ca7be1225b245b3db9c12ea8b', 'fotosUsuarios/user.png', '0', 0, 0, '0', 11),
(7, 'Erik Lima', 'ErikLimeira', 'erik@hotmail.com', 'Carpinteiro', '36231427781', '2000-04-18', '11988563200', 'm', 'a503938ca7be1225b245b3db9c12ea8b', 'fotosUsuarios/user.png', '0', 0, 0, '0', 12),
(8, 'Roger Machado', 'Roger 888', 'roger@hotmail.com', 'Carpinteiro', '22225778884', '1994-01-05', '11998752410', 'm', 'a503938ca7be1225b245b3db9c12ea8b', 'fotosUsuarios/user.png', '0', 0, 0, '0', 13),
(9, 'Rayssa Caetano', 'Rayssa 100', 'rayssa@hotmail.com', 'Carpinteira', '57662050157', '1997-02-01', '11958246321', 'f', 'a503938ca7be1225b245b3db9c12ea8b', 'fotosUsuarios/user.png', '0', 0, 0, '0', 14),
(10, 'Rafaela Nunes', 'Rafaela 55', 'rafaela@hotmail.com', 'Carpinteira', '52136633970', '2000-04-16', '11326598989', 'f', 'a503938ca7be1225b245b3db9c12ea8b', 'fotosUsuarios/user.png', '0', 0, 0, '0', 15),
(11, 'Mateus SIlva', 'Mateus 157', 'mateus@hotmail.com', 'Eletricista', '29334108851', '2000-04-16', '11875246999', 'm', 'a503938ca7be1225b245b3db9c12ea8b', 'fotosUsuarios/user.png', '0', 0, 0, '0', 16),
(12, 'Marcelo Santos', 'Marcelo 879', 'marcelo@hotmail.com', 'Eletricista', '64313453393', '2000-04-16', '11915472356', 'm', 'a503938ca7be1225b245b3db9c12ea8b', 'fotosUsuarios/user.png', '0', 0, 0, '0', 17),
(13, 'Gustavo Belizário', 'Gu 577', 'gu@hotmail.com', 'Eletricista', '53346527875', '1997-08-09', '11987523999', 'm', 'a503938ca7be1225b245b3db9c12ea8b', 'fotosUsuarios/user.png', '0', 0, 0, '0', 18),
(14, 'Thomas Lana', 'Thomas 157', 'thomas@hotmail.com', 'Eletricista', '62702356427', '1997-07-08', '11983520177', 'm', 'a503938ca7be1225b245b3db9c12ea8b', 'fotosUsuarios/user.png', '0', 0, 0, '0', 19),
(15, 'Eduardo Maciel', 'Eduardo M', 'edu@hotmail.com', 'Eletricista', '87369442543', '1977-01-18', '19988850277', 'm', 'a503938ca7be1225b245b3db9c12ea8b', 'fotosUsuarios/user.png', '0', 0, 0, '0', 20),
(16, 'Cristiian Santos', 'Cris 88', 'cristian@hotmail.com', 'Marceneiro', '12472438184', '2000-04-16', '11985555332', 'm', 'a503938ca7be1225b245b3db9c12ea8b', 'fotosUsuarios/user.png', '0', 0, 0, '0', 21),
(17, 'Fernando Lopes', 'Fe 21', 'fernando@hotmail.com', 'Marceneiro', '64565544202', '2000-04-16', '11548796302', 'm', 'a503938ca7be1225b245b3db9c12ea8b', 'fotosUsuarios/user.png', '0', 0, 0, '0', 22),
(18, 'Paulo Roberto', 'Paulinho', 'paulo@hotmail.com', 'Marceneiro', '65134913986', '2000-04-16', '11235497896', 'm', 'a503938ca7be1225b245b3db9c12ea8b', 'fotosUsuarios/user.png', '0', 0, 0, '0', 23),
(19, 'Tiago Luiz', 'tiago 120', 'tiago@hotmail.com', 'Marceneiro', '26146155870', '2000-04-16', '11988725000', 'm', 'a503938ca7be1225b245b3db9c12ea8b', 'fotosUsuarios/user.png', '0', 0, 0, '0', 24),
(20, 'Luiz Henrique', 'Luiz 454', 'luiz@hotmail.com', 'Marceneiro', '35483652568', '2000-04-16', '11789999950', 'm', 'a2f8aa3bd8f9f8d71bbce388b3450d5f', 'fotosUsuarios/user.png', '0', 0, 0, '0', 25),
(21, 'Juliani Mendes', 'ju 877', 'ju@hotmail.com', 'Faxineira', '38659627008', '2000-04-16', '11998353535', 'f', 'a2f8aa3bd8f9f8d71bbce388b3450d5f', 'fotosUsuarios/user.png', '0', 0, 0, '0', 26),
(22, 'Fernanda Dias', 'Fernanda 555', 'fernanda@hotmail.com', 'Faxineira', '49487767185', '2000-04-16', '11998882220', 'f', 'a503938ca7be1225b245b3db9c12ea8b', 'fotosUsuarios/user.png', '0', 0, 0, '0', 27),
(23, 'Fabiana Rocha', 'Fabi Rocha', 'fabi@hotmail.com', 'Faxineira', '95285512468', '2000-05-05', '11956568000', 'f', 'a503938ca7be1225b245b3db9c12ea8b', 'fotosUsuarios/user.png', '0', 0, 0, '0', 28),
(24, 'Marina Silva ', 'Mari 96', 'marina@hotmail.com', 'Faxineira', '88277688903', '2000-04-16', '11975530888', 'f', 'a503938ca7be1225b245b3db9c12ea8b', 'fotosUsuarios/user.png', '0', 0, 0, '0', 29),
(25, 'Gabriela Soares', 'Gabi So', 'gabriela@hotmail.com', 'Faxineira', '72329436440', '2000-04-16', '11988882222', 'f', 'a503938ca7be1225b245b3db9c12ea8b', 'fotosUsuarios/user.png', '0', 0, 0, '0', 30),
(26, 'Matheus Lima', 'Matheus l', 'matheus@hotmail.com', 'Mecânico', '88312303103', '2000-04-16', '11895353535', 'm', 'a503938ca7be1225b245b3db9c12ea8b', 'fotosUsuarios/user.png', '0', 0, 0, '0', 31),
(27, 'José Henrique', 'José 5', 'jose@hotmail.com', 'Mecânico', '61612700640', '2000-04-16', '11982500777', 'm', 'a503938ca7be1225b245b3db9c12ea8b', 'fotosUsuarios/user.png', '0', 0, 0, '0', 32),
(28, 'Vinicius Almeida', 'Vini 88', 'vini@hotmail.com', 'Mecânico', '01715661222', '2000-04-16', '11935820000', 'm', 'a503938ca7be1225b245b3db9c12ea8b', 'fotosUsuarios/user.png', '0', 0, 0, '0', 33),
(29, 'Bruno Santos', 'Brunao 5', 'bruno@hotmail.com', 'Mecânico', '80234786728', '2000-04-16', '11505555888', 'm', 'a503938ca7be1225b245b3db9c12ea8b', 'fotosUsuarios/user.png', '0', 0, 0, '0', 34),
(30, 'Robson Leme', 'Robinho 88', 'robinho@hotmail.com', 'Mecânico', '38775854180', '2000-04-16', '11982203877', 'm', 'a503938ca7be1225b245b3db9c12ea8b', 'fotosUsuarios/user.png', '0', 0, 0, '0', 35),
(31, 'Joana Machado', 'Joana 5', 'joana@hotmail.com', 'Babá', '06039894032', '1958-04-16', '5526875986', 'f', 'a503938ca7be1225b245b3db9c12ea8b', 'fotosUsuarios/user.png', '0', 0, 0, '0', 36),
(32, 'Leticia Sousa', 'Leticia 20', 'le@hotmail.com', 'Babá', '83645210806', '1987-04-16', '11985003577', 'f', 'a503938ca7be1225b245b3db9c12ea8b', 'fotosUsuarios/user.png', '0', 0, 0, '0', 37),
(33, 'Lucia Lima', 'lucia 7', 'lucia@hotmail.com', 'Babá', '54564941836', '1973-04-16', '11935570010', 'f', 'a503938ca7be1225b245b3db9c12ea8b', 'fotosUsuarios/user.png', '0', 0, 0, '0', 38),
(34, 'Maria Luiza', 'maria 75', 'maria@hotmail.com', 'Babá', '78661976600', '1957-04-16', '11903546055', 'f', 'a503938ca7be1225b245b3db9c12ea8b', 'fotosUsuarios/user.png', '0', 0, 0, '0', 39),
(35, 'Luiza Moura', 'lu 5', 'luiza@hotmail.com', 'Babá', '28026727894', '1981-04-16', '11507798763', 'f', 'a503938ca7be1225b245b3db9c12ea8b', 'fotosUsuarios/user.png', '0', 0, 0, '0', 40),
(36, 'Joaquim Lima', 'Joaquim 123', 'joaquim@hotmail.com', 'Pedreiro', '27675869150', '1997-04-16', '11987752000', 'm', 'a503938ca7be1225b245b3db9c12ea8b', 'fotosUsuarios/user.png', '0', 0, 0, '0', 41),
(37, 'Alexander Rocha', 'Ale 555', 'ale@hotmail.com', 'Pedreiro', '08586540595', '1989-04-16', '11935358615', 'm', 'a503938ca7be1225b245b3db9c12ea8b', 'fotosUsuarios/user.png', '0', 0, 0, '0', 42),
(38, 'Francisco lins', 'Francisco 6', 'fran@hotmail.com', 'Pedreiro', '96521451227', '1987-12-05', '11989535820', 'm', 'a503938ca7be1225b245b3db9c12ea8b', 'fotosUsuarios/user.png', '0', 0, 0, '0', 43),
(39, 'Mauro Santos', 'Maurinho', 'mauro123@gmail.com', 'Pedreiro', '56265232193', '1977-01-19', '11989395265', 'm', 'a503938ca7be1225b245b3db9c12ea8b', 'fotosUsuarios/user.png', '0', 0, 0, '0', 44),
(40, 'Aguiar nunes', 'aguiar zl', 'aguiar@hotmail.com', 'Pedreiro', '67684261258', '1985-05-01', '11987683456', 'm', 'a503938ca7be1225b245b3db9c12ea8b', 'fotosUsuarios/user.png', '0', 0, 0, '0', 45);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbmensagens`
--

DROP TABLE IF EXISTS `tbmensagens`;
CREATE TABLE IF NOT EXISTS `tbmensagens` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `id_de` int(11) NOT NULL,
  `id_para` int(11) NOT NULL,
  `mensagem` varchar(255) NOT NULL,
  `time` int(11) DEFAULT NULL,
  `lido` int(11) DEFAULT NULL,
  `visNotificacao` int(1) DEFAULT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbpedidosdeservico`
--

DROP TABLE IF EXISTS `tbpedidosdeservico`;
CREATE TABLE IF NOT EXISTS `tbpedidosdeservico` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `codCliente` int(11) NOT NULL,
  `tipoServico` varchar(50) DEFAULT NULL,
  `descricaoPedido` varchar(100) DEFAULT NULL,
  `dataDoPedido` date DEFAULT NULL,
  `AceitoPedido` int(1) DEFAULT NULL,
  `statusPedido` varchar(1) DEFAULT NULL,
  `visNotificacao` int(1) DEFAULT NULL,
  PRIMARY KEY (`codigo`),
  KEY `codCliente` (`codCliente`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tbpedidosdeservico`
--

INSERT INTO `tbpedidosdeservico` (`codigo`, `codCliente`, `tipoServico`, `descricaoPedido`, `dataDoPedido`, `AceitoPedido`, `statusPedido`, `visNotificacao`) VALUES
(1, 1, 'Jardinagem', 'Queria carpinar a grama de casa!!', '2018-12-09', 0, '0', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbpostagemfotos`
--

DROP TABLE IF EXISTS `tbpostagemfotos`;
CREATE TABLE IF NOT EXISTS `tbpostagemfotos` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `codUsuario` int(11) NOT NULL,
  `foto` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`codigo`),
  KEY `codUsuario` (`codUsuario`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbsuporte`
--

DROP TABLE IF EXISTS `tbsuporte`;
CREATE TABLE IF NOT EXISTS `tbsuporte` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `codUsuario` int(11) NOT NULL,
  `nome` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `grupo` varchar(1) DEFAULT NULL,
  `assunto` varchar(2) DEFAULT NULL,
  `mensagem` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`codigo`),
  KEY `codUsuario` (`codUsuario`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbtelefonescliente`
--

DROP TABLE IF EXISTS `tbtelefonescliente`;
CREATE TABLE IF NOT EXISTS `tbtelefonescliente` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `codCliente` int(11) NOT NULL,
  `numero` varchar(14) DEFAULT NULL,
  `tipo` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`codigo`),
  KEY `codCliente` (`codCliente`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tbtelefonescliente`
--

INSERT INTO `tbtelefonescliente` (`codigo`, `codCliente`, `numero`, `tipo`) VALUES
(1, 1, '11993565226', 'Celular'),
(2, 2, '11985744260', 'Celular'),
(3, 3, '55889354620', 'Celular'),
(4, 4, '55875642280', 'Celular'),
(5, 5, '55889563201', 'Celular');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbtelefonesfuncionario`
--

DROP TABLE IF EXISTS `tbtelefonesfuncionario`;
CREATE TABLE IF NOT EXISTS `tbtelefonesfuncionario` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `codFunci` int(11) NOT NULL,
  `numero` varchar(14) DEFAULT NULL,
  `tipo` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`codigo`),
  KEY `codFunci` (`codFunci`)
) ENGINE=MyISAM AUTO_INCREMENT=41 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tbtelefonesfuncionario`
--

INSERT INTO `tbtelefonesfuncionario` (`codigo`, `codFunci`, `numero`, `tipo`) VALUES
(1, 1, '5589423544', 'Celular'),
(2, 2, '11987456234', 'Celular'),
(3, 3, '11897553001', 'Celular'),
(4, 4, '11984971866', 'Celular'),
(5, 5, '11905489633', 'Celular'),
(6, 6, '11987852000', 'Celular'),
(7, 7, '11988563200', 'Celular'),
(8, 8, '11998752410', 'Celular'),
(9, 9, '11958246321', 'Celular'),
(10, 10, '11326598989', 'Celular'),
(11, 11, '11875246999', 'Celular'),
(12, 12, '11915472356', 'Celular'),
(13, 13, '11987523999', 'Celular'),
(14, 14, '11983520177', 'Celular'),
(15, 15, '19988850277', 'Celular'),
(16, 16, '11985555332', 'Celular'),
(17, 17, '11548796302', 'Celular'),
(18, 18, '11235497896', 'Celular'),
(19, 19, '11988725000', 'Celular'),
(20, 20, '11789999950', 'Celular'),
(21, 21, '11998353535', 'Celular'),
(22, 22, '11998882220', 'Celular'),
(23, 23, '11956568000', 'Celular'),
(24, 24, '11975530888', 'Celular'),
(25, 25, '11988882222', 'Celular'),
(26, 26, '11895353535', 'Celular'),
(27, 27, '11982500777', 'Celular'),
(28, 28, '11935820000', 'Celular'),
(29, 29, '11505555888', 'Celular'),
(30, 30, '11982203877', 'Celular'),
(31, 31, '5526875986', 'Celular'),
(32, 32, '11985003577', 'Celular'),
(33, 33, '11935570010', 'Celular'),
(34, 34, '11903546055', 'Celular'),
(35, 35, '11507798763', 'Celular'),
(36, 36, '11987752000', 'Celular'),
(37, 37, '11935358615', 'Celular'),
(38, 38, '11989535820', 'Celular'),
(39, 39, '11989395265', 'Celular'),
(40, 40, '11987683456', 'Celular');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbusuarioschat`
--

DROP TABLE IF EXISTS `tbusuarioschat`;
CREATE TABLE IF NOT EXISTS `tbusuarioschat` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `codUsuario` int(11) NOT NULL,
  `grupo` varchar(1) DEFAULT NULL,
  PRIMARY KEY (`codigo`),
  KEY `codUsuario` (`codUsuario`)
) ENGINE=MyISAM AUTO_INCREMENT=46 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tbusuarioschat`
--

INSERT INTO `tbusuarioschat` (`codigo`, `codUsuario`, `grupo`) VALUES
(1, 1, 'c'),
(2, 2, 'c'),
(3, 3, 'c'),
(4, 4, 'c'),
(5, 5, 'c'),
(6, 1, 'f'),
(7, 2, 'f'),
(8, 3, 'f'),
(9, 4, 'f'),
(10, 5, 'f'),
(11, 6, 'f'),
(12, 7, 'f'),
(13, 8, 'f'),
(14, 9, 'f'),
(15, 10, 'f'),
(16, 11, 'f'),
(17, 12, 'f'),
(18, 13, 'f'),
(19, 14, 'f'),
(20, 15, 'f'),
(21, 16, 'f'),
(22, 17, 'f'),
(23, 18, 'f'),
(24, 19, 'f'),
(25, 20, 'f'),
(26, 21, 'f'),
(27, 22, 'f'),
(28, 23, 'f'),
(29, 24, 'f'),
(30, 25, 'f'),
(31, 26, 'f'),
(32, 27, 'f'),
(33, 28, 'f'),
(34, 29, 'f'),
(35, 30, 'f'),
(36, 31, 'f'),
(37, 32, 'f'),
(38, 33, 'f'),
(39, 34, 'f'),
(40, 35, 'f'),
(41, 36, 'f'),
(42, 37, 'f'),
(43, 38, 'f'),
(44, 39, 'f'),
(45, 40, 'f');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbvisupedidos`
--

DROP TABLE IF EXISTS `tbvisupedidos`;
CREATE TABLE IF NOT EXISTS `tbvisupedidos` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `codFunci` int(11) NOT NULL,
  `codPedido` int(11) NOT NULL,
  `numVisu` int(11) DEFAULT NULL,
  PRIMARY KEY (`codigo`),
  KEY `codFunci` (`codFunci`),
  KEY `codPedido` (`codPedido`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tbvisupedidos`
--

INSERT INTO `tbvisupedidos` (`codigo`, `codFunci`, `codPedido`, `numVisu`) VALUES
(1, 0, 1, 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
