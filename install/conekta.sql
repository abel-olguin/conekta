-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-03-2015 a las 19:06:33
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
-- Estructura de tabla para la tabla `tbl_articulos`
--

CREATE TABLE IF NOT EXISTS `tbl_articulos` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(250) NOT NULL,
  `imagen` varchar(250) NOT NULL,
  `descripcion` text,
  `precio` float NOT NULL,
  `clave` varchar(200) NOT NULL,
  `mensualidades` tinyint(1) NOT NULL DEFAULT '0',
  `cupones` tinyint(1) NOT NULL DEFAULT '0',
  `deleted` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `tbl_articulos`
--

INSERT INTO `tbl_articulos` (`id`, `nombre`, `imagen`, `descripcion`, `precio`, `clave`, `mensualidades`, `cupones`, `deleted`) VALUES
(1, 'producto prueba', 'prueba1.jpg', '', 150, 'pp12015', 1, 1, 0),
(2, 'producto prueba 2', 'prueba2.jpg', '', 100, 'pp22015', 0, 0, 0),
(3, 'producto prueba 3', 'prueba3.png', '', 250, 'pp32015', 1, 0, 0),
(4, 'producto prueba 4', 'prueba4.jpg', '', 500, 'pp42015', 0, 1, 0);

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
  `id_subscripcion` varchar(250) COLLATE utf8_spanish_ci NOT NULL DEFAULT 'NULL',
  `id_cliente` varchar(250) COLLATE utf8_spanish_ci NOT NULL DEFAULT 'NULL',
  `origen` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `created` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=30 ;

--
-- Volcado de datos para la tabla `tbl_conekta`
--

INSERT INTO `tbl_conekta` (`id`, `id_transaccion`, `id_producto`, `correo`, `barcode`, `barcode_url`, `status`, `cantidad_pago`, `reference`, `service_number`, `id_subscripcion`, `id_cliente`, `origen`, `created`) VALUES
(26, '5505c37224122906ff000121', 1, 'osmer19@hotmail.com', '', '', 0, '15000', 'Abel-Olguin-Chavez-2015-03-15-18:37:03', '', 'NULL', 'NULL', 'card', '15-03-2015 :: 18:03:06'),
(27, '5505c48124122938e30022a0', 1, 'osmer19@hotmail.com', '', '', 0, '15000', 'Abel-Olguin-Chavez-2015-03-15-18:41:33', '', 'NULL', 'NULL', 'card', '15-03-2015 :: 18:03:36'),
(28, 'NULL', 1, 'osmer19@hotmail.com', 'NULL', 'NULL', 1, '25.00 X 6', 'NULL', 'NULL', 'sub_wXnkMx1o6jC7p9Rkw', 'cus_MrRTMCcXskweUjctT', 'card', '15-03-2015 :: 18:03:12'),
(29, 'NULL', 1, 'osmer19@hotmail.com', 'NULL', 'NULL', 1, '25.00 X 6', 'NULL', 'NULL', 'sub_HyL7hDESMCatgPS2U', 'cus_7iJr3tZ47M9r7ZMrr', 'card', '15-03-2015 :: 18:03:28');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_cupones`
--

CREATE TABLE IF NOT EXISTS `tbl_cupones` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `id_producto` int(10) NOT NULL,
  `codigo` varchar(250) NOT NULL,
  `descuento` int(10) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `tbl_cupones`
--

INSERT INTO `tbl_cupones` (`id`, `id_producto`, `codigo`, `descuento`, `status`, `deleted`) VALUES
(1, 1, 'abcd', 10, 0, 0);

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

--
-- Volcado de datos para la tabla `tbl_usuarios`
--

INSERT INTO `tbl_usuarios` (`id`, `nombre`, `apellido_paterno`, `apellido_materno`, `correo`, `password`, `genero`, `fecha_nac`, `pais`, `activo`, `created`) VALUES
(2, 'Abel', 'Olguin', 'Chavez', 'osmer19@hotmail.com', 'Hola', 'hombre', '13-6-1940', 'México', 1, '14-03-2015 :: 21:03:56'),
(3, 'pedro', 'perez', 'perez', 'ejemplo@ejemplo.com', 'Hola', 'hombre', '10-10-1945', 'México', 0, '14-03-2015 :: 22:03:52');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
