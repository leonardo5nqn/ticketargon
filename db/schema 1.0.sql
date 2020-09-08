-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-08-2020 a las 20:36:37
-- Versión del servidor: 5.7.14
-- Versión de PHP: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `ticket`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfil`
--

CREATE TABLE `perfil` (
  `perfilid` int(11) NOT NULL,
  `descripcion` varchar(50) NOT NULL,
  `estado` tinyint(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `perfil`
--

INSERT INTO `perfil` (`perfilid`, `descripcion`, `estado`) VALUES
(2, 'Cliente', 0),
(1, 'Administrador', 0),
(3, 'Usuario', 0),
(29, 'WEFR', 0),
(28, 'WEFR', 0),
(27, 'WEFR', 0),
(26, 'WEFR', 0),
(25, 'WEFR', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ticket`
--

CREATE TABLE `ticket` (
  `ticketid` int(11) NOT NULL,
  `usuarioid` int(11) NOT NULL,
  `titulo` varchar(45) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `prioridad` int(11) NOT NULL,
  `fechainicio` date NOT NULL,
  `fechafin` date NOT NULL,
  `ipservidor` varchar(45) NOT NULL,
  `claveservidor` int(45) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ticket`
--

INSERT INTO `ticket` (`ticketid`, `usuarioid`, `titulo`, `descripcion`, `prioridad`, `fechainicio`, `fechafin`, `ipservidor`, `claveservidor`) VALUES
(6, 13, 'Internet', 'Se cae la conexion', 2, '2020-06-11', '2020-06-11', '', 0),
(2, 17, 'Lentitud', 'El servidor se encuentra demasiado lento.', 2, '2019-12-18', '2019-12-19', '195.176.188.23', 654984);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `usuarioid` int(11) NOT NULL,
  `nombre` varchar(25) NOT NULL,
  `apellido` varchar(25) NOT NULL,
  `usuario` varchar(25) NOT NULL,
  `clave` char(50) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `fecnac` date NOT NULL,
  `perfilid` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`usuarioid`, `nombre`, `apellido`, `usuario`, `clave`, `correo`, `fecnac`, `perfilid`) VALUES
(45, 'Nacho', 'Godano', 'ngodano', '654321', 'ngodano@gmail.com', '2019-12-14', 16),
(17, 'Juan', 'Otero', 'jotero', 'b0baee9d279d34fa1dfd71aadb908c3f', 'jotero@gmail.com', '1994-06-23', 15),
(13, 'Ulises', 'Scovenna', 'uscovenna', '827ccb0eea8a706c4c34a16891f84e7b', 'uscovenna@gmail.com', '2018-11-15', 16);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `perfil`
--
ALTER TABLE `perfil`
  ADD PRIMARY KEY (`perfilid`);

--
-- Indices de la tabla `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`ticketid`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`usuarioid`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `perfil`
--
ALTER TABLE `perfil`
  MODIFY `perfilid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT de la tabla `ticket`
--
ALTER TABLE `ticket`
  MODIFY `ticketid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `usuarioid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
