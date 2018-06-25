-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 25-06-2018 a las 03:02:31
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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipovehiculo`
--

INSERT INTO `tipovehiculo` (`idtipoVehiculo`, `nombreTipo`) VALUES
(8, 'Auto');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `nombre` varchar(40) NOT NULL,
  `apellido` varchar(40) NOT NULL,
  `password` varchar(40) NOT NULL,
  `tarjeta` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `nacionalidad` varchar(30) NOT NULL,
  `descripcion` text NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `administrador` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`nombre`, `apellido`, `password`, `tarjeta`, `email`, `nacionalidad`, `descripcion`, `fecha_nacimiento`, `id`, `administrador`) VALUES
('Pedro', 'Dal Bianco', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', '', 'dalbianco.pedro@gmail.com', 'Argentino', '', '1997-10-10', 14, 0);

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `vehiculo`
--

INSERT INTO `vehiculo` (`idvehiculo`, `marca`, `modelo`, `patente`, `cantidadAsientos`, `idtipoVehiculo`, `idusuario`) VALUES
(6, 'Audi', 'A1', 'ABC-123', 4, 8, 14);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `viaje`
--

DROP TABLE IF EXISTS `viaje`;
CREATE TABLE IF NOT EXISTS `viaje` (
  `idviaje` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `origen` varchar(40) NOT NULL,
  `destino` varchar(40) NOT NULL,
  `precio` float NOT NULL,
  `idvehiculo` int(10) UNSIGNED NOT NULL,
  `horaInicio` time NOT NULL,
  `horaFin` time NOT NULL,
  PRIMARY KEY (`idviaje`),
  UNIQUE KEY `idviaje_UNIQUE` (`idviaje`),
  KEY `idvehiculo` (`idvehiculo`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `viajeconcreto`
--

DROP TABLE IF EXISTS `viajeconcreto`;
CREATE TABLE IF NOT EXISTS `viajeconcreto` (
  `idviajeConcreto` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `fechaInicio` date NOT NULL,
  `fechaFin` date NOT NULL,
  `idviaje` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`idviajeConcreto`),
  UNIQUE KEY `idviajeConcreto_UNIQUE` (`idviajeConcreto`),
  KEY `fk_viajeConcreto_viaje1_idx` (`idviaje`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

--
-- Filtros para la tabla `viajeconcreto`
--
ALTER TABLE `viajeconcreto`
  ADD CONSTRAINT `fk_viajeConcreto_viaje1` FOREIGN KEY (`idviaje`) REFERENCES `viaje` (`idviaje`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
