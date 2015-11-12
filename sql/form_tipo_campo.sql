-- phpMyAdmin SQL Dump
-- version 4.2.12deb2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 11-11-2015 a las 18:02:44
-- Versión del servidor: 5.5.44-0+deb8u1
-- Versión de PHP: 5.6.13-0+deb8u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `galenux_cienaga`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `form_tipo_campo`
--

CREATE TABLE IF NOT EXISTS `form_tipo_campo` (
`id_tipo_campo` int(11) NOT NULL,
  `tipo_campo_nombre` text NOT NULL,
  `tipo_campo_accion` text NOT NULL,
  `descripcion` text NOT NULL,
  `activo` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `form_tipo_campo`
--

INSERT INTO `form_tipo_campo` (`id_tipo_campo`, `tipo_campo_nombre`, `tipo_campo_accion`, `descripcion`, `activo`) VALUES
(1, 'Texto', 'text', '', 1),
(2, 'Nota', 'textarea', '', 1),
(3, 'Numérico', 'number', '', 1),
(4, 'URL', 'url', '', 1),
(5, 'Medio', 'media', '', 1),
(6, 'Buscador', 'buscador', '', 1),
(7, 'HTML', 'html', '', 1),
(8, 'Select', 'select', '', 1),
(9, 'Combo select', 'combo', '', 1),
(10, 'Relación', 'relacion', '', 1),
(11, 'Fecha', 'date', '', 1),
(12, 'Email', 'email', '', 1),
(13, 'Email envío', 'envio', '', 1),
(14, 'Mapa', 'mapa', '', 1),
(15, 'Imagen', 'imagen', '', 1),
(16, 'Rango', 'rango', '', 1),
(17, 'Texto limitado', 'limit', '', 1),
(18, 'Password', 'password', '', 1),
(19, 'Campo único', 'unico', '', 1),
(20, 'Campo oculto', 'oculto', '', 1),
(21, 'Base de datos', 'base', '', 1),
(22, 'Timestamp', 'timestamp', '', 1),
(23, 'Funcion', 'oculto', '', 1),
(24, 'Checkbox', 'checkbox', 'Casa,Carro,Beca:1', 1),
(25, 'Radio', 'radio', 'Acepto,No acepto,No me importa', 1),
(26, 'Formulario vinculado', 'vinculado', 'Escriba el ID del formulario que desea vincular y este aparecerá en lugar del campo.', 1),
(27, 'Radio agrupado linea', 'radio_agrupado_linea', 'Rojo,Verde,Azul', 1),
(28, 'Radio agrupado campos', 'radio_agrupado_campos', 'Escriba el listado de id_campo que va a agrupar eje. 175,180', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `form_tipo_campo`
--
ALTER TABLE `form_tipo_campo`
 ADD PRIMARY KEY (`id_tipo_campo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `form_tipo_campo`
--
ALTER TABLE `form_tipo_campo`
MODIFY `id_tipo_campo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=29;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
