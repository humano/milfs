-- phpMyAdmin SQL Dump
-- version 4.5.0.2deb2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 27, 2015 at 06:05 PM
-- Server version: 5.6.25-4
-- PHP Version: 5.6.14-1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `milfs`
--

-- --------------------------------------------------------

--
-- Table structure for table `estilos`
--

CREATE TABLE `estilos` (
  `id` int(11) NOT NULL,
  `elemento` varchar(100) DEFAULT NULL,
  `label` varchar(19) DEFAULT NULL,
  `valor` varchar(10277) DEFAULT NULL,
  `color` varchar(8) DEFAULT NULL,
  `tipo` varchar(32) NOT NULL,
  `identificador` varchar(32) NOT NULL,
  `id_empresa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `estilos`
--

INSERT INTO `estilos` (`id`, `elemento`, `label`, `valor`, `color`, `tipo`, `identificador`, `id_empresa`) VALUES
(1, '.campo_nombre', 'font-weight', 'bold', NULL, '', '', 1),
(2, '.campo_contenido', 'font-normal', 'bold', NULL, '', '', 1),
(6, '.modal-dialogx', ' width', '98% !important', NULL, '', '', 1),
(7, '.modal-content', 'height', '100%', NULL, '', '', 1),
(8, '.modal-dialog', 'padding', '0', NULL, '', '', 1),
(9, '.modal-dialog', 'height', 'auto', NULL, '', '', 1),
(10, '.panel-map', 'border-radius', '10px', NULL, '', '', 1),
(11, '.panel-map', 'width', '18%', NULL, '', '', 1),
(12, '.panel-map', 'background-color', 'white', NULL, '', '', 1),
(13, '.panel-map', 'margin-left', '80%', NULL, '', '', 1),
(14, '.panel-map', 'z-index', '10000', NULL, '', '', 1),
(15, '.panel-map', 'position', 'absolute', NULL, '', '', 1),
(16, '.panel-map', 'top', '20%', NULL, '', '', 1),
(17, '.panel-map', 'padding', '10px', NULL, '', '', 1),
(18, '.XXXleaflet-popup-content-wrapper', 'background', '#a7ffee !important', '', '', '', 1),
(19, '.XXXleaflet-popup-content-wrapper', 'color', '#333399 !important', '', '', '', 1),
(20, '.XXXleaflet-popup-content-wrapper', 'line-height', '24px !important', '', '', '', 1),
(21, '.XXXleaflet-popup-content-wrapper', 'border-style', 'dotted  !important', '', '', '', 1),
(22, '.XXXleaflet-popup-content-wrapper', 'border-radius', '10px  !important', '', '', '', 1),
(23, '.XXXleaflet-popup-content-wrapper', 'border-width', '2px  !important', '', '', '', 1),
(24, '.XXXleaflet-popup-tip', 'border-top', '15px dotted #333399 !important', '', '', '', 1),
(26, '.ficha-contenido', 'padding', '5px', NULL, '', '', 1),
(28, '.ficha-contenido', 'margin', '0px', NULL, '', '', 1),
(29, '.XXXdropdown-menu liXXX:hover .XXXsub-menu', 'visibility', 'visible', NULL, '', '', 1),
(30, '.XXXdropdown:hover .XXXdropdown-menu', 'display', 'block', NULL, '', '', 1),
(31, '.dropdown:hover .dropdown-menu', 'background', 'rgba(255,255,255,1)', NULL, '', '', 1),
(32, '.navbar-default ', 'background', 'rgba(255,255,255,1)', NULL, '', '', 1),
(33, 'nav.navbar.navbar-default.submenu', 'background', 'rgba(255,255,255,0.8)', NULL, '', '', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `estilos`
--
ALTER TABLE `estilos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `estilos`
--
ALTER TABLE `estilos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
