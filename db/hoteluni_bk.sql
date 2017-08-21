-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 28-07-2017 a las 13:00:48
-- Versión del servidor: 5.6.35-log
-- Versión de PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `hoteluni_bk`
--
CREATE DATABASE IF NOT EXISTS `hoteluni_bk` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `hoteluni_bk`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `caja`
--

CREATE TABLE `caja` (
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `catalogo`
--

CREATE TABLE `catalogo` (
  `id_catalogo` int(11) NOT NULL,
  `codigo` varchar(100) NOT NULL,
  `valor1` varchar(100) NOT NULL,
  `valor2` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

CREATE TABLE `clientes` (
  `id_clientes` int(11) NOT NULL,
  `rsocial` varchar(100) NOT NULL,
  `nit_cliente` varchar(50) NOT NULL,
  `empresa` varchar(150) NOT NULL,
  `ecivil` varchar(100) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `ciudad` varchar(100) NOT NULL,
  `pais` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_caja`
--

CREATE TABLE `estado_caja` (
  `id_estado_caja` int(11) NOT NULL,
  `estado` varchar(50) NOT NULL,
  `fecha` datetime NOT NULL,
  `obs` varchar(105) NOT NULL,
  `monto` decimal(10,2) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `vigente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `estado_caja`
--

INSERT INTO `estado_caja` (`id_estado_caja`, `estado`, `fecha`, `obs`, `monto`, `usuario`, `vigente`) VALUES
(1, 'cerrado', '2017-07-20 00:00:00', '', '0.00', 'admin', 1),
(2, 'cerrado', '2017-07-20 00:00:00', '', '0.00', 'admin', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `habitaciones`
--

CREATE TABLE `habitaciones` (
  `id_habitacion` int(11) NOT NULL,
  `codigo` varchar(50) NOT NULL,
  `piso_hab` int(11) NOT NULL,
  `estado` varchar(50) NOT NULL,
  `id_tipo_hab` int(11) NOT NULL,
  `fch_reserva` date NOT NULL,
  `hr_reserva` time NOT NULL,
  `obs` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `habitaciones`
--

INSERT INTO `habitaciones` (`id_habitacion`, `codigo`, `piso_hab`, `estado`, `id_tipo_hab`, `fch_reserva`, `hr_reserva`, `obs`) VALUES
(1, '201', 2, 'libre', 1, '0000-00-00', '00:00:00', ''),
(2, '202', 2, 'libre', 2, '0000-00-00', '00:00:00', ''),
(3, '203', 2, 'libre', 1, '0000-00-00', '00:00:00', ''),
(4, '204', 2, 'libre', 1, '0000-00-00', '00:00:00', ''),
(5, '205', 2, 'libre', 5, '0000-00-00', '00:00:00', ''),
(6, '206', 2, 'libre', 4, '0000-00-00', '00:00:00', ''),
(7, '207', 2, 'libre', 4, '0000-00-00', '00:00:00', ''),
(8, '208', 2, 'libre', 4, '0000-00-00', '00:00:00', ''),
(9, '209', 2, 'libre', 5, '0000-00-00', '00:00:00', ''),
(10, '211', 2, 'libre', 1, '0000-00-00', '00:00:00', ''),
(11, '212', 2, 'libre', 2, '0000-00-00', '00:00:00', ''),
(12, '301', 3, 'libre', 1, '0000-00-00', '00:00:00', ''),
(13, '302', 3, 'libre', 4, '0000-00-00', '00:00:00', ''),
(14, '303', 3, 'libre', 1, '0000-00-00', '00:00:00', ''),
(15, '304', 3, 'libre', 1, '0000-00-00', '00:00:00', ''),
(16, '305', 3, 'libre', 5, '0000-00-00', '00:00:00', ''),
(17, '306', 3, 'libre', 4, '0000-00-00', '00:00:00', ''),
(18, '307', 3, 'libre', 4, '0000-00-00', '00:00:00', ''),
(19, '308', 3, 'libre', 4, '0000-00-00', '00:00:00', ''),
(20, '311', 3, 'libre', 3, '0000-00-00', '00:00:00', ''),
(21, '312', 3, 'libre', 1, '0000-00-00', '00:00:00', ''),
(22, '401', 4, 'libre', 2, '0000-00-00', '00:00:00', ''),
(23, '402', 4, 'libre', 3, '0000-00-00', '00:00:00', ''),
(24, '403', 4, 'libre', 3, '0000-00-00', '00:00:00', ''),
(25, '404', 4, 'libre', 3, '0000-00-00', '00:00:00', ''),
(26, '405', 4, 'libre', 6, '0000-00-00', '00:00:00', ''),
(27, '406', 4, 'alquilado', 4, '0000-00-00', '00:00:00', ''),
(28, '407', 4, 'libre', 4, '0000-00-00', '00:00:00', ''),
(29, '408', 4, 'libre', 4, '0000-00-00', '00:00:00', ''),
(30, '409', 4, 'libre', 5, '0000-00-00', '00:00:00', ''),
(31, '410', 4, 'libre', 1, '0000-00-00', '00:00:00', ''),
(32, '411', 4, 'libre', 3, '0000-00-00', '00:00:00', ''),
(33, '412', 4, 'libre', 3, '0000-00-00', '00:00:00', ''),
(34, '501', 5, 'libre', 8, '0000-00-00', '00:00:00', ''),
(35, '502', 5, 'libre', 9, '0000-00-00', '00:00:00', ''),
(36, '503', 5, 'libre', 9, '0000-00-00', '00:00:00', ''),
(37, '310', 3, 'libre', 3, '0000-00-00', '00:00:00', ''),
(38, '504', 5, 'libre', 9, '0000-00-00', '00:00:00', ''),
(39, '505', 5, 'libre', 10, '0000-00-00', '00:00:00', ''),
(40, '506', 5, 'libre', 1, '0000-00-00', '00:00:00', ''),
(41, '309', 3, 'alquilado', 1, '0000-00-00', '00:00:00', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `kardex_hab`
--

CREATE TABLE `kardex_hab` (
  `id_kardex_hab` int(11) NOT NULL,
  `cod_hab` varchar(11) NOT NULL,
  `num_personas` int(11) NOT NULL,
  `fecha_chk_in` date NOT NULL,
  `hora_chk_in` time NOT NULL,
  `fecha_chk_out` date NOT NULL,
  `hora_chk_out` time NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_clientes_registrados` varchar(100) NOT NULL,
  `desayuno` varchar(5) NOT NULL,
  `adelanto` double NOT NULL,
  `total_cobrado` decimal(10,0) NOT NULL,
  `obs` text NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `vigente` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

CREATE TABLE `permisos` (
  `id_permisos` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `permiso` varchar(50) NOT NULL,
  `fecha` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `permisos`
--

INSERT INTO `permisos` (`id_permisos`, `id_usuario`, `permiso`, `fecha`) VALUES
(594, 1, 'chk_password', '2017-07-20 11:46:47'),
(595, 1, 'chk_adm_hab', '2017-07-20 11:46:47'),
(596, 1, 'chk_gestion_usrs', '2017-07-20 11:46:47'),
(597, 1, 'chk_adm_clientes', '2017-07-20 11:46:47'),
(598, 1, 'chk_asigna_hab', '2017-07-20 11:46:47'),
(599, 1, 'chk_rep_caja', '2017-07-20 11:46:47'),
(600, 2, 'chk_adm_hab', '2017-07-28 09:37:17'),
(601, 2, 'chk_gestion_usrs', '2017-07-28 09:37:17'),
(602, 2, 'chk_adm_clientes', '2017-07-28 09:37:17'),
(603, 2, 'chk_asigna_hab', '2017-07-28 09:37:17'),
(604, 2, 'chk_rep_caja', '2017-07-28 09:37:17'),
(605, 3, 'chk_adm_clientes', '2017-07-28 09:42:57'),
(606, 3, 'chk_asigna_hab', '2017-07-28 09:42:57'),
(607, 3, 'chk_rep_caja', '2017-07-28 09:42:57'),
(608, 4, 'chk_adm_clientes', '2017-07-28 09:45:28'),
(609, 4, 'chk_asigna_hab', '2017-07-28 09:45:28'),
(610, 4, 'chk_rep_caja', '2017-07-28 09:45:28'),
(611, 5, 'chk_adm_clientes', '2017-07-28 09:47:11'),
(612, 5, 'chk_asigna_hab', '2017-07-28 09:47:11'),
(613, 5, 'chk_rep_caja', '2017-07-28 09:47:11'),
(614, 6, 'chk_adm_clientes', '2017-07-28 09:50:31'),
(615, 6, 'chk_asigna_hab', '2017-07-28 09:50:31'),
(616, 6, 'chk_rep_caja', '2017-07-28 09:50:31');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rep_camarera`
--

CREATE TABLE `rep_camarera` (
  `id_repcamarera` int(11) NOT NULL,
  `cod_hab` varchar(20) NOT NULL,
  `fch_reporte` datetime NOT NULL,
  `reporte` varchar(200) NOT NULL,
  `usuario` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservas`
--

CREATE TABLE `reservas` (
  `id_reserva` int(11) NOT NULL,
  `id_habitacion` int(11) NOT NULL,
  `cliente` varchar(100) NOT NULL,
  `fch_reserva` date NOT NULL,
  `hr_reserva` time NOT NULL,
  `fch_registro` datetime NOT NULL,
  `usuario` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `resgistro`
--

CREATE TABLE `resgistro` (
  `id_registro` int(11) NOT NULL,
  `fecha_ingreso` date NOT NULL,
  `fecha_salida` date NOT NULL,
  `hora_ingreso` time NOT NULL,
  `hora_salida` time NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `cod_habitacion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_habitacion`
--

CREATE TABLE `tipo_habitacion` (
  `id_tipo_hab` int(11) NOT NULL,
  `descripcion` varchar(50) NOT NULL,
  `personas` int(11) NOT NULL,
  `costo` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tipo_habitacion`
--

INSERT INTO `tipo_habitacion` (`id_tipo_hab`, `descripcion`, `personas`, `costo`) VALUES
(1, 'Matrimonial', 2, 250),
(2, 'Doble', 2, 280),
(3, 'Simple', 1, 170),
(4, 'Triple', 3, 330),
(5, 'Cuadruple', 4, 440),
(6, 'Familiar', 5, 500),
(7, 'Deposito', 0, 0),
(8, 'Familar sin TV', 5, 400),
(9, 'Triple sin TV', 3, 300),
(10, 'Cuadruple sin TV', 4, 320),
(11, 'Matrimonial sin TV', 2, 250);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `uname` varchar(20) NOT NULL,
  `password` varchar(200) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apaterno` varchar(50) NOT NULL,
  `amaterno` varchar(50) NOT NULL,
  `ci` int(11) NOT NULL,
  `estado` int(11) NOT NULL,
  `rol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `uname`, `password`, `nombre`, `apaterno`, `amaterno`, `ci`, `estado`, `rol`) VALUES
(1, 'admin', '1a89ad6578c83ef3e77ca2fe47c0da0d', 'admininistrador', '', '', 0, 1, 0),
(2, 'gimaisa', '092e95fd8937916a5512fd37a5fbf48a', 'Gilka', 'Cabrera', 'Michel', 3481418, 1, 0),
(3, 'abustamante', '769cc80420cfd66d2d0b8d8316d23457', 'Arminda', 'Bustamante', 'Araoz', 8696120, 1, 0),
(4, 'mteran', 'ca88bf54f8435d098da233453f728445', 'Mirian', 'teran', 'Ignacio', 6474392, 1, 0),
(5, 'wquiroz', '1277b4e03873d34105b1a3cb9f2aa88b', 'Wilder', 'Quiroz', '', 8014587, 1, 0),
(6, 'jvidal', 'b1612eacce699e7aaae984f92a819745', 'Jimmy', 'Vidal', 'Sarmiento', 4534216, 1, 0);

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
  ADD PRIMARY KEY (`id_clientes`),
  ADD UNIQUE KEY `idx_clientes` (`nit_cliente`);

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
-- Indices de la tabla `rep_camarera`
--
ALTER TABLE `rep_camarera`
  ADD PRIMARY KEY (`id_repcamarera`);

--
-- Indices de la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD PRIMARY KEY (`id_reserva`);

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
  MODIFY `id_catalogo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id_clientes` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `estado_caja`
--
ALTER TABLE `estado_caja`
  MODIFY `id_estado_caja` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `habitaciones`
--
ALTER TABLE `habitaciones`
  MODIFY `id_habitacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
--
-- AUTO_INCREMENT de la tabla `kardex_hab`
--
ALTER TABLE `kardex_hab`
  MODIFY `id_kardex_hab` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `permisos`
--
ALTER TABLE `permisos`
  MODIFY `id_permisos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=617;
--
-- AUTO_INCREMENT de la tabla `rep_camarera`
--
ALTER TABLE `rep_camarera`
  MODIFY `id_repcamarera` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `reservas`
--
ALTER TABLE `reservas`
  MODIFY `id_reserva` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `resgistro`
--
ALTER TABLE `resgistro`
  MODIFY `id_registro` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tipo_habitacion`
--
ALTER TABLE `tipo_habitacion`
  MODIFY `id_tipo_hab` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
