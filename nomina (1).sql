-- phpMyAdmin SQL Dump
-- version 4.5.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-01-2018 a las 21:22:03
-- Versión del servidor: 5.7.11
-- Versión de PHP: 7.0.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `nomina`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargos`
--

CREATE TABLE `cargos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(75) NOT NULL,
  `smensual` double NOT NULL,
  `squincenal` double NOT NULL,
  `tickets` double NOT NULL,
  `estado` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cargos`
--

INSERT INTO `cargos` (`id`, `nombre`, `smensual`, `squincenal`, `tickets`, `estado`) VALUES
(1, 'Administracion', 248510, 124255, 549000, 1),
(2, 'Transporte', 100000, 50000, 358000, 1),
(3, 'Seguridad', 100000, 50000, 549000, 1),
(4, 'Obrero', 2005000, 1002500, 488000, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nomina`
--

CREATE TABLE `nomina` (
  `id` int(11) NOT NULL,
  `bono` double DEFAULT NULL,
  `bono_vac` double NOT NULL,
  `inasistencia` int(11) DEFAULT NULL,
  `retroactivo` double DEFAULT NULL,
  `faov` double DEFAULT NULL,
  `retsso` double DEFAULT NULL,
  `idtrabajador` int(11) DEFAULT NULL,
  `fecha` date NOT NULL,
  `aptsso` double NOT NULL,
  `qna` double NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `nomina`
--

INSERT INTO `nomina` (`id`, `bono`, `bono_vac`, `inasistencia`, `retroactivo`, `faov`, `retsso`, `idtrabajador`, `fecha`, `aptsso`, `qna`) VALUES
(1, 0, 0, 0, 0, 1000, 4500, 1, '2018-01-31', 1, 100000),
(2, 0, 0, 0, 0, 500, 2250, 3, '2018-01-31', 1, 50000),
(3, 0, 0, 0, 0, 1242.55, 5591.475, 2, '2018-01-31', 1, 124255),
(4, 2000, 0, 2, 0, 1242.55, 5591.475, 2, '2018-01-31', 1, 109687.67),
(5, 2000, 0, 1, 0, 500, 2250, 1, '2018-01-31', 1, 48666.67),
(6, 2000, 0, 0, 0, 500, 2250, 3, '2018-01-31', 1, 52000),
(7, 100, 0, 1, 500, 500, 2250, 1, '2018-01-31', 1, 48066.67),
(8, 300, 0, 3, 700, 500, 2250, 3, '2018-01-31', 1, 41100),
(9, 200, 0, 2, 600, 1242.55, 5591.475, 2, '2018-01-31', 1, 109387.67),
(10, 1000, 0, 2, 300, 500, 2250, 1, '2018-02-15', 1, 43882.33),
(11, 0, 0, 0, 0, 1242.55, 5591.475, 2, '2018-02-15', 1, 117419.975),
(12, 0, 0, 0, 0, 500, 2250, 3, '2018-02-15', 1, 47249),
(13, 100, 0, 1, 200, 500, 2250, 1, '2018-05-31', 1, 44215.67),
(14, 0, 0, 0, 0, 500, 2250, 3, '2018-05-31', 1, 47249),
(15, 0, 0, 0, 0, 1242.55, 5591.475, 2, '2018-05-31', 1, 117419.975),
(16, 0, 0, 0, 0, 1242.55, 5591.475, 2, '2018-02-28', 1, 117419.975),
(17, 100, 0, 2, 0, 500, 2250, 3, '2018-07-31', 1, 40782.33),
(18, 1000, 1000, 10, 1000, 500, 2250, 3, '2018-04-15', 1, 16915.67);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trabajadores`
--

CREATE TABLE `trabajadores` (
  `id` int(11) NOT NULL,
  `nombre` varchar(75) NOT NULL,
  `apellido` varchar(75) NOT NULL,
  `cedula` varchar(25) NOT NULL,
  `telefono` varchar(25) NOT NULL,
  `direccion` varchar(225) NOT NULL,
  `correo` varchar(145) NOT NULL,
  `cuenta` varchar(45) NOT NULL,
  `fechaingreso` date NOT NULL,
  `idcargos` int(11) NOT NULL,
  `dependencia` varchar(85) NOT NULL,
  `estado` tinyint(1) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `trabajadores`
--

INSERT INTO `trabajadores` (`id`, `nombre`, `apellido`, `cedula`, `telefono`, `direccion`, `correo`, `cuenta`, `fechaingreso`, `idcargos`, `dependencia`, `estado`) VALUES
(1, 'Gibert', 'Carrera', '23795320', '0416844562', 'Cagua Edo Aragua', 'gibertc.m@gmail.com', '021213565656546464644', '2017-12-14', 2, 'CIENCIAS', 1),
(2, 'Adriana', 'Roa Ortega', '15468234', '04168449445', 'Cagua Edo Aragua', 'alvarado@gmail.com', '13212313213212131212', '2017-07-06', 1, 'DPTSALUDMENTAL', 1),
(3, 'Gabriel', 'Ortega', '2379519', '04168449445', 'Maracay Cagua Edo Aragua', 'Gabriel@gmail.com', '012541433221522556544', '2018-01-03', 3, 'BIBLIOTECAINFORM', 1),
(4, 'Jesus', 'Alberto', '23795318', '04164376667', 'Sengudara Aragua Cagua', 'gibertc.m@gmail.com', '01333522513362252598', '2017-12-14', 1, 'FUNDACLIU', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `passw` varchar(80) DEFAULT NULL,
  `fechac` date DEFAULT NULL,
  `entrada` date DEFAULT NULL,
  `nivel` varchar(52) NOT NULL,
  `estado` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `passw`, `fechac`, `entrada`, `nivel`, `estado`) VALUES
(1, 'Adriana', '1234567', '2018-01-12', '2018-01-28', 'Administrador', 1),
(2, 'Gibert', '7654321', '2018-01-12', '2018-01-21', 'Usuario', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cargos`
--
ALTER TABLE `cargos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `nomina`
--
ALTER TABLE `nomina`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idtrabajador` (`idtrabajador`);

--
-- Indices de la tabla `trabajadores`
--
ALTER TABLE `trabajadores`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cargos`
--
ALTER TABLE `cargos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `nomina`
--
ALTER TABLE `nomina`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT de la tabla `trabajadores`
--
ALTER TABLE `trabajadores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
