-- phpMyAdmin SQL Dump
-- version 4.2.12deb2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 27, 2015 at 11:02 AM
-- Server version: 5.5.44-0+deb8u1
-- PHP Version: 5.6.13-0+deb8u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `galenux_cienaga`
--

-- --------------------------------------------------------

--
-- Table structure for table `form_areas`
--

CREATE TABLE IF NOT EXISTS `form_areas` (
`id` int(11) NOT NULL,
  `nombre` text NOT NULL,
  `descripcion` text NOT NULL,
  `estado` int(11) NOT NULL DEFAULT '0',
  `orden` int(11) NOT NULL DEFAULT '0' COMMENT 'Orden en que se muestran las areas',
  `id_empresa` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `form_areas`
--

INSERT INTO `form_areas` (`id`, `nombre`, `descripcion`, `estado`, `orden`, `id_empresa`) VALUES
(0, '', '', 1, 1, 1),
(1, 'General', '', 1, 100, 1),
(2, 'Subjetivo', 'Campos subjetivo en el esquema SOAP (Subjetivo, Objetivo, Análisis, Plan)', 1, 2, 1),
(3, 'Objetivo', 'Campos Objetivos en el esquema SOAP (Subjetivo, Objetivo, Análisis, Plan)', 1, 3, 1),
(4, 'Análisis', 'Campos Análisis en el esquema SOAP (Subjetivo, Objetivo, Análisis, Plan)', 1, 4, 1),
(5, 'Plan', 'Campos para el Plan en el esquema SOAP (Subjetivo, Objetivo, Análisis, Plan)', 1, 5, 1),
(6, 'Parametrización', 'Formularios de parametrización', 1, 90, 1),
(8, 'Administrativo', 'Campos que tienen que ver con la gestión administrativa ', 1, 8, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `form_areas`
--
ALTER TABLE `form_areas`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `form_areas`
--
ALTER TABLE `form_areas`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
