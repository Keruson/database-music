-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 21/06/2026 às 21:52
-- Versão do servidor: 8.4.7
-- Versão do PHP: 8.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `dbmusica`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbartista`
--

DROP TABLE IF EXISTS `tbartista`;
CREATE TABLE IF NOT EXISTS `tbartista` (
  `CodArt` int NOT NULL AUTO_INCREMENT,
  `Nome` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `IsDeleted` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`CodArt`)
) ENGINE=MyISAM AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `tbartista`
--

INSERT INTO `tbartista` (`CodArt`, `Nome`, `IsDeleted`) VALUES
(1, 'Metallica', 0),
(2, 'Slayer', 0),
(3, 'Megadeth', 0),
(4, 'HiperZoom Games', 1),
(5, 'Nirvana', 0),
(6, 'Pearl Jam', 0),
(7, 'Soundgarden', 0),
(8, 'Alice in Chains', 0),
(9, 'Foo Fighters', 1),
(10, 'Metallica', 0),
(11, 'Megadeth', 0),
(12, 'Slayer', 0),
(13, 'Anthrax', 0),
(14, 'Pantera', 0),
(15, 'Deftones', 0),
(16, 'The Smiths', 0),
(17, 'Fleetwood Mac', 0),
(18, 'The Rolling Stones', 0),
(19, 'Radiohead', 0),
(20, 'Muse', 0),
(21, 'Linkin Park', 0),
(22, 'Korn', 0),
(23, 'System of a Down', 0),
(24, 'Stone Temple Pilots', 0),
(25, 'Bush', 0),
(26, 'Silverchair', 0),
(27, 'Temple of the Dog', 0),
(28, 'Mad Season', 0),
(29, 'Audioslave', 0),
(30, 'Creed', 0),
(31, 'Alter Bridge', 0),
(32, 'Incubus', 0),
(33, 'Tool', 0),
(34, 'A Perfect Circle', 0),
(35, '', 0),
(36, 'fulano segundo', 0),
(37, 'fulano terceiro', 0),
(38, 'fulano quarto', 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbdisco`
--

DROP TABLE IF EXISTS `tbdisco`;
CREATE TABLE IF NOT EXISTS `tbdisco` (
  `CodDisco` int NOT NULL AUTO_INCREMENT,
  `Titulo` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Genero` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `CodArt` int NOT NULL,
  `Gravadora` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Quantidade` int DEFAULT NULL,
  `Valor` float DEFAULT NULL,
  `IsDeleted` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`CodDisco`,`CodArt`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `tbdisco`
--

INSERT INTO `tbdisco` (`CodDisco`, `Titulo`, `Genero`, `CodArt`, `Gravadora`, `Quantidade`, `Valor`, `IsDeleted`) VALUES
(1, 'Ride The Lightning', 'Heavy Metal', 1, 'Megaforce Records', 4, 90, 0),
(2, 'Rust in Peace', 'Heavy Metal', 3, 'Capitol Records', 8, 80, 0),
(3, 'Reign in Blood', 'Heavy Metal', 2, 'Def Jam Recordings', 12, 78, 0),
(4, 'Master of Puppets', 'Heavy Metal', 1, 'Megaforce Records', 8, 120, 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
