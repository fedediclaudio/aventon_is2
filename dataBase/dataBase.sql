-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 29-05-2018 a las 18:53:22
-- Versión del servidor: 5.5.24-log
-- Versión de PHP: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `aventon`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `nombre` varchar(40) NOT NULL,
  `apellido` varchar(40) NOT NULL,
  `password` varchar(40) NOT NULL,
  `descripcion` varchar(280) DEFAULT NULL,
  `tarjeta` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `nacionalidad` varchar(30) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `administrador` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`nombre`, `apellido`, `password`, `descripcion`, `tarjeta`, `email`, `nacionalidad`, `fecha_nacimiento`, `id`, `administrador`) VALUES
('Blas', 'Butera', '85136c79cbf9fe36bb9d05d0639c70c265c18d37', 'Blasito', '123123', 'blasbutera69@gmail.com', 'Argentino', '1996-12-09', 8, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `viaje`
--

CREATE TABLE IF NOT EXISTS `viaje` (
  `idviaje` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `origen` varchar(40) NOT NULL,
  `destino` varchar(40) NOT NULL,
  `fecha` date NOT NULL,
  `horainicio` time NOT NULL,
  `horafin` time NOT NULL,
  `precio` float NOT NULL,
  `descripcion` varchar(280) DEFAULT NULL,
  `idusuario` int(10) unsigned NOT NULL,
  PRIMARY KEY (`idviaje`),
  UNIQUE KEY `idviaje_UNIQUE` (`idviaje`),
  KEY `idusuario` (`idusuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=30 ;

--
-- Volcado de datos para la tabla `viaje`
--

INSERT INTO `viaje` (`idviaje`, `origen`, `destino`, `fecha`, `horainicio`, `horafin`, `precio`, `descripcion`, `idusuario`) VALUES
(29, 'Chubut', 'Moron', '2018-05-22', '14:13:00', '14:13:00', 213, 'dsf', 8);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `viaje`
--
ALTER TABLE `viaje`
  ADD CONSTRAINT `viaje_ibfk_1` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
