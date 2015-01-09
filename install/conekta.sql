-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-11-2014 a las 07:26:56
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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_conekta`
--

CREATE TABLE IF NOT EXISTS `tbl_conekta` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `correo` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
  `id_transaccion` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
  `codigo_barras` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
  `status` int(10) NOT NULL,
  `cantidad_pago` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `fecha_operacion` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `pais` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `origen` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_numeros`
--

CREATE TABLE IF NOT EXISTS `tbl_numeros` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `numero` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `disponible` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=77 ;

--
-- Volcado de datos para la tabla `tbl_numeros`
--

INSERT INTO `tbl_numeros` (`id`, `numero`, `disponible`) VALUES
(1, '1', 0),
(2, '2', 0),
(3, '3', 0),
(4, '4', 0),
(5, '5', 0),
(6, '6', 0),
(7, '7', 0),
(8, '8', 0),
(9, '9', 0),
(10, '10', 0),
(11, '11', 0),
(12, '12', 0),
(13, '13', 0),
(14, '14', 0),
(15, '15', 0),
(16, '16', 0),
(17, '17', 0),
(18, '18', 0),
(19, '19', 0),
(20, '20', 0),
(21, '21', 0),
(22, '22', 0),
(23, '23', 0),
(24, '24', 0),
(25, '25', 0),
(26, '26', 0),
(27, '27', 0),
(28, '28', 0),
(29, '29', 0),
(30, '30', 0),
(31, '31', 0),
(32, '32', 0),
(33, '33', 0),
(34, '34', 0),
(35, '35', 0),
(36, '36', 0),
(37, '37', 0),
(38, '38', 0),
(39, '39', 0),
(40, '40', 0),
(41, '41', 0),
(42, '42', 0),
(43, '43', 0),
(44, '44', 0),
(45, '45', 0),
(46, '46', 0),
(47, '47', 0),
(48, '48', 0),
(49, '49', 0),
(50, '50', 0),
(51, '51', 0),
(52, '52', 0),
(53, '53', 0),
(54, '54', 0),
(55, '55', 0),
(56, '56', 0),
(57, '57', 0),
(58, '58', 0),
(59, '59', 0),
(60, '60', 0),
(61, '61', 0),
(62, '62', 0),
(63, '63', 0),
(64, '64', 0),
(65, '65', 0),
(66, '66', 0),
(67, '67', 0),
(68, '68', 0),
(69, '69', 0),
(70, '70', 0),
(71, '71', 0),
(72, '72', 0),
(73, '73', 0),
(74, '74', 0),
(75, '75', 0),
(76, '76', 0);

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
  `genero` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `fecha_nac` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `pais` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `fecha_registro` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `tarjeta` int(10) NOT NULL,
  `efectivo` int(10) NOT NULL,
  `numero` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `activo` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
