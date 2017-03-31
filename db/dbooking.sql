-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 31-03-2017 a las 23:14:48
-- Versión del servidor: 5.6.20
-- Versión de PHP: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `dbooking`
--
CREATE DATABASE IF NOT EXISTS `dbooking` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `dbooking`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `caja`
--

CREATE TABLE IF NOT EXISTS `caja` (
`id_caja` int(11) NOT NULL,
  `tipo_mov` varchar(20) NOT NULL,
  `tipo_pago` varchar(5) NOT NULL,
  `tipo_doc` varchar(50) NOT NULL,
  `num_doc` varchar(50) NOT NULL,
  `monto` decimal(10,2) NOT NULL,
  `concepto` varchar(200) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `id_estado_caja` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `catalogo`
--

CREATE TABLE IF NOT EXISTS `catalogo` (
`id_catalogo` int(11) NOT NULL,
  `codigo` varchar(100) NOT NULL,
  `valor1` varchar(100) NOT NULL,
  `valor2` varchar(100) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `catalogo`
--

INSERT INTO `catalogo` (`id_catalogo`, `codigo`, `valor1`, `valor2`) VALUES
(1, 'tipo_documento', 'Recibo', ''),
(2, 'tipo_documento', 'Factura', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE IF NOT EXISTS `clientes` (
`id_clientes` int(11) NOT NULL,
  `rsocial` varchar(100) NOT NULL,
  `nit_cliente` varchar(50) NOT NULL,
  `direccion` varchar(150) NOT NULL,
  `ecivil` varchar(100) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `ciudad` varchar(100) NOT NULL,
  `pais` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id_clientes`, `rsocial`, `nit_cliente`, `direccion`, `ecivil`, `telefono`, `ciudad`, `pais`, `email`) VALUES
(1, 'Jorge Anibal Zapata Agreda', '33212', 'Ladisla Cabrera E721', 'Soltero', '4225621', 'Cochabamba', 'Bolivia', 'chaskynet@yahoo.com'),
(2, 'Camila Zapata Carpio', '65456abc', 'En algun lugar de la mancha', 'Soltera', '7968768', 'Tokyo', 'Japonesa', 'ccamilazapata@yahoo.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_caja`
--

CREATE TABLE IF NOT EXISTS `estado_caja` (
`id_estado_caja` int(11) NOT NULL,
  `estado` varchar(50) NOT NULL,
  `fecha` datetime NOT NULL,
  `obs` varchar(105) NOT NULL,
  `monto` decimal(10,2) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `vigente` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Volcado de datos para la tabla `estado_caja`
--

INSERT INTO `estado_caja` (`id_estado_caja`, `estado`, `fecha`, `obs`, `monto`, `usuario`, `vigente`) VALUES
(1, 'cerrado', '2017-01-31 00:00:00', '', '0.00', '1', 0),
(7, 'abierto', '2017-03-28 15:08:33', '    			  ', '0.00', 'admin', 0),
(8, 'cerrado', '2017-03-28 15:09:25', '    			  ', '300.00', 'admin', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `habitaciones`
--

CREATE TABLE IF NOT EXISTS `habitaciones` (
`id_habitacion` int(11) NOT NULL,
  `codigo` varchar(50) NOT NULL,
  `piso_hab` int(11) NOT NULL,
  `estado` varchar(50) NOT NULL,
  `id_tipo_hab` int(11) NOT NULL,
  `obs` varchar(200) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `habitaciones`
--

INSERT INTO `habitaciones` (`id_habitacion`, `codigo`, `piso_hab`, `estado`, `id_tipo_hab`, `obs`) VALUES
(1, '201', 2, 'ocupado', 1, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `kardex_hab`
--

CREATE TABLE IF NOT EXISTS `kardex_hab` (
`id_kardex_hab` int(11) NOT NULL,
  `cod_hab` varchar(11) NOT NULL,
  `num_personas` int(11) NOT NULL,
  `fecha_chk_in` date NOT NULL,
  `hora_chk_in` time NOT NULL,
  `fecha_chk_out` date NOT NULL,
  `hora_chk_out` time NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_clientes_registrados` varchar(100) NOT NULL,
  `desayuno` tinyint(1) NOT NULL,
  `adelanto` double NOT NULL,
  `total_cobrado` decimal(10,0) NOT NULL,
  `obs` text NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `vigente` tinyint(1) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `kardex_hab`
--

INSERT INTO `kardex_hab` (`id_kardex_hab`, `cod_hab`, `num_personas`, `fecha_chk_in`, `hora_chk_in`, `fecha_chk_out`, `hora_chk_out`, `id_cliente`, `id_clientes_registrados`, `desayuno`, `adelanto`, `total_cobrado`, `obs`, `fecha_registro`, `usuario`, `vigente`) VALUES
(1, '201', 1, '2017-03-15', '11:24:31', '0000-00-00', '00:00:00', 0, '1,2', 0, 10, '0', 'no quiere lo molesten', '2017-03-15 11:27:59', 'admin', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

CREATE TABLE IF NOT EXISTS `permisos` (
`id_permisos` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `permiso` varchar(50) NOT NULL,
  `fecha` datetime NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=594 ;

--
-- Volcado de datos para la tabla `permisos`
--

INSERT INTO `permisos` (`id_permisos`, `id_usuario`, `permiso`, `fecha`) VALUES
(589, 1, 'chk_adm_hab', '2016-11-24 07:05:45'),
(590, 1, 'chk_gestion_usrs', '2016-11-24 07:05:45'),
(591, 1, 'chk_adm_clientes', '2016-11-24 07:05:45'),
(592, 1, 'chk_asigna_hab', '2016-11-24 07:05:45'),
(593, 1, 'chk_rep_caja', '2016-11-24 07:05:45');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `resgistro`
--

CREATE TABLE IF NOT EXISTS `resgistro` (
`id_registro` int(11) NOT NULL,
  `fecha_ingreso` date NOT NULL,
  `fecha_salida` date NOT NULL,
  `hora_ingreso` time NOT NULL,
  `hora_salida` time NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `cod_habitacion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_habitacion`
--

CREATE TABLE IF NOT EXISTS `tipo_habitacion` (
`id_tipo_hab` int(11) NOT NULL,
  `descripcion` varchar(50) NOT NULL,
  `personas` int(11) NOT NULL,
  `costo` float NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `tipo_habitacion`
--

INSERT INTO `tipo_habitacion` (`id_tipo_hab`, `descripcion`, `personas`, `costo`) VALUES
(1, 'Matrimonial', 2, 230);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
`id_usuario` int(11) NOT NULL,
  `uname` varchar(20) NOT NULL,
  `password` varchar(200) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apaterno` varchar(50) NOT NULL,
  `amaterno` varchar(50) NOT NULL,
  `ci` int(11) NOT NULL,
  `estado` int(11) NOT NULL,
  `rol` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `uname`, `password`, `nombre`, `apaterno`, `amaterno`, `ci`, `estado`, `rol`) VALUES
(1, 'admin', '202cb962ac59075b964b07152d234b70', 'admininistrador', '', '', 0, 1, 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `caja`
--
ALTER TABLE `caja`
 ADD PRIMARY KEY (`id_caja`);

--
-- Indices de la tabla `catalogo`
--
ALTER TABLE `catalogo`
 ADD PRIMARY KEY (`id_catalogo`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
 ADD PRIMARY KEY (`id_clientes`), ADD UNIQUE KEY `idx_clientes` (`nit_cliente`);

--
-- Indices de la tabla `estado_caja`
--
ALTER TABLE `estado_caja`
 ADD PRIMARY KEY (`id_estado_caja`);

--
-- Indices de la tabla `habitaciones`
--
ALTER TABLE `habitaciones`
 ADD PRIMARY KEY (`id_habitacion`);

--
-- Indices de la tabla `kardex_hab`
--
ALTER TABLE `kardex_hab`
 ADD PRIMARY KEY (`id_kardex_hab`);

--
-- Indices de la tabla `permisos`
--
ALTER TABLE `permisos`
 ADD PRIMARY KEY (`id_permisos`);

--
-- Indices de la tabla `resgistro`
--
ALTER TABLE `resgistro`
 ADD PRIMARY KEY (`id_registro`);

--
-- Indices de la tabla `tipo_habitacion`
--
ALTER TABLE `tipo_habitacion`
 ADD PRIMARY KEY (`id_tipo_hab`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
 ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `caja`
--
ALTER TABLE `caja`
MODIFY `id_caja` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `catalogo`
--
ALTER TABLE `catalogo`
MODIFY `id_catalogo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
MODIFY `id_clientes` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `estado_caja`
--
ALTER TABLE `estado_caja`
MODIFY `id_estado_caja` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `habitaciones`
--
ALTER TABLE `habitaciones`
MODIFY `id_habitacion` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `kardex_hab`
--
ALTER TABLE `kardex_hab`
MODIFY `id_kardex_hab` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `permisos`
--
ALTER TABLE `permisos`
MODIFY `id_permisos` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=594;
--
-- AUTO_INCREMENT de la tabla `resgistro`
--
ALTER TABLE `resgistro`
MODIFY `id_registro` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tipo_habitacion`
--
ALTER TABLE `tipo_habitacion`
MODIFY `id_tipo_hab` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
