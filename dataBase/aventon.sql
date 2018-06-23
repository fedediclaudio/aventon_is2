-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 23-06-2018 a las 18:39:01
-- Versión del servidor: 5.7.21
-- Versión de PHP: 5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `aventon`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipovehiculo`
--

DROP TABLE IF EXISTS `tipovehiculo`;
CREATE TABLE IF NOT EXISTS `tipovehiculo` (
  `idtipoVehiculo` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombreTipo` varchar(45) NOT NULL,
  PRIMARY KEY (`idtipoVehiculo`),
  UNIQUE KEY `idtipoVehiculo_UNIQUE` (`idtipoVehiculo`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipovehiculo`
--

INSERT INTO `tipovehiculo` (`idtipoVehiculo`, `nombreTipo`) VALUES
(6, 'Auto'),
(7, 'Camioneta');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `nombre` varchar(40) NOT NULL,
  `apellido` varchar(40) NOT NULL,
  `password` varchar(40) NOT NULL,
  `descripcion` varchar(280) DEFAULT NULL,
  `tarjeta` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `nacionalidad` varchar(30) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `administrador` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`nombre`, `apellido`, `password`, `descripcion`, `tarjeta`, `email`, `nacionalidad`, `fecha_nacimiento`, `id`, `administrador`) VALUES
('Pedro', 'Dal Bianco', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'Eee', '', 'dalbianco.pedro@gmail.com', 'Argentino', '1997-10-10', 12, 0),
('Blas', 'Butera', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'Toma mate', '', 'blasbutera69@gmail.com', 'Argentino', '1996-09-12', 13, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vehiculo`
--

DROP TABLE IF EXISTS `vehiculo`;
CREATE TABLE IF NOT EXISTS `vehiculo` (
  `idvehiculo` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `marca` varchar(45) NOT NULL,
  `modelo` varchar(45) NOT NULL,
  `patente` varchar(10) DEFAULT NULL,
  `cantidadAsientos` tinyint(4) NOT NULL,
  `idtipoVehiculo` int(10) UNSIGNED NOT NULL,
  `idusuario` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`idvehiculo`),
  UNIQUE KEY `idvehiculo_UNIQUE` (`idvehiculo`),
  KEY `fk_vehiculo_tipoVehiculo1_idx` (`idtipoVehiculo`),
  KEY `fk_vehiculo_usuario1_idx` (`idusuario`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `vehiculo`
--

INSERT INTO `vehiculo` (`idvehiculo`, `marca`, `modelo`, `patente`, `cantidadAsientos`, `idtipoVehiculo`, `idusuario`) VALUES
(5, 'Audi', 'A3', 'AB1234CD', 4, 6, 12);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `viaje`
--

DROP TABLE IF EXISTS `viaje`;
CREATE TABLE IF NOT EXISTS `viaje` (
  `idviaje` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `origen` varchar(40) NOT NULL,
  `destino` varchar(40) NOT NULL,
  `fechaInicio` datetime NOT NULL,
  `fechaFin` datetime NOT NULL,
  `precio` float NOT NULL,
  `descripcion` varchar(280) DEFAULT NULL,
  `idvehiculo` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`idviaje`),
  UNIQUE KEY `idviaje_UNIQUE` (`idviaje`),
  KEY `idvehiculo` (`idvehiculo`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `viaje`
--

INSERT INTO `viaje` (`idviaje`, `origen`, `destino`, `fechaInicio`, `fechaFin`, `precio`, `descripcion`, `idvehiculo`) VALUES
(1, 'La Plata', 'Catamarca', '2018-06-24 12:02:00', '2018-06-29 12:01:00', 13, 'E', 5),
(3, 'Tolosa', 'Rusia', '2018-06-27 12:02:00', '2018-06-29 11:01:00', 12, 'Ah', 5);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `vehiculo`
--
ALTER TABLE `vehiculo`
  ADD CONSTRAINT `fk_vehiculo_tipoVehiculo1` FOREIGN KEY (`idtipoVehiculo`) REFERENCES `tipovehiculo` (`idtipoVehiculo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_vehiculo_usuario1` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `viaje`
--
ALTER TABLE `viaje`
  ADD CONSTRAINT `viaje_ibfk_1` FOREIGN KEY (`idvehiculo`) REFERENCES `vehiculo` (`idvehiculo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
