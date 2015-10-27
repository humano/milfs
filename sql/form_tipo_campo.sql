-- phpMyAdmin SQL Dump
-- version 4.2.12deb2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 27, 2015 at 09:07 AM
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
-- Table structure for table `form_tipo_campo`
--

CREATE TABLE IF NOT EXISTS `form_tipo_campo` (
`id_tipo_campo` int(11) NOT NULL,
  `tipo_campo_nombre` text NOT NULL,
  `tipo_campo_accion` text NOT NULL,
  `activo` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `form_tipo_campo`
--

INSERT INTO `form_tipo_campo` (`id_tipo_campo`, `tipo_campo_nombre`, `tipo_campo_accion`, `activo`) VALUES
(1, 'Texto', 'text', 1),
(2, 'Nota', 'textarea', 1),
(3, 'Numérico', 'number', 1),
(4, 'URL', 'url', 1),
(5, 'Medio', 'media', 1),
(6, 'Buscador', 'buscador', 1),
(7, 'HTML', 'html', 1),
(8, 'Select', 'select', 1),
(9, 'Combo select', 'combo', 1),
(10, 'Relación', 'relacion', 1),
(11, 'Fecha', 'date', 1),
(12, 'Email', 'email', 1),
(13, 'Email envío', 'envio', 1),
(14, 'Mapa', 'mapa', 1),
(15, 'Imagen', 'imagen', 1),
(16, 'Rango', 'rango', 1),
(17, 'Texto limitado', 'limit', 1),
(18, 'Password', 'password', 1),
(19, 'Campo único', 'unico', 1),
(20, 'Campo oculto', 'oculto', 1),
(21, 'Base de datos', 'base', 1),
(22, 'Timestamp', 'timestamp', 1),
(23, 'Funcion', 'oculto', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `form_tipo_campo`
--
ALTER TABLE `form_tipo_campo`
 ADD PRIMARY KEY (`id_tipo_campo`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `form_tipo_campo`
--
ALTER TABLE `form_tipo_campo`
MODIFY `id_tipo_campo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=24;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
