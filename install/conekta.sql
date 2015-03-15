-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-03-2015 a las 02:52:31
-- Versión del servidor: 5.6.17
-- Versión de PHP: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `conekta`
--
CREATE DATABASE IF NOT EXISTS `conekta` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `conekta`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_articulos`
--

CREATE TABLE IF NOT EXISTS `tbl_articulos` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(250) NOT NULL,
  `imagen` varchar(250) NOT NULL,
  `precio` float NOT NULL,
  `clave` varchar(200) NOT NULL,
  `deleted` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_conekta`
--

CREATE TABLE IF NOT EXISTS `tbl_conekta` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `id_transaccion` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
  `id_producto` int(10) NOT NULL,
  `correo` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
  `barcode` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
  `barcode_url` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
  `status` int(10) NOT NULL,
  `cantidad_pago` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `reference` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `service_number` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `pais` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `origen` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `created` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=11 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_usuarios`
--

CREATE TABLE IF NOT EXISTS `tbl_usuarios` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
  `apellido_paterno` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
  `apellido_materno` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
  `correo` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
  `password` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
  `genero` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `fecha_nac` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `pais` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `activo` int(11) NOT NULL,
  `created` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=4 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
