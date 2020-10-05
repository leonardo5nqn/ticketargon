-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-10-2020 a las 16:39:57
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
-- Estructura de tabla para la tabla `admin`
--

CREATE TABLE `admin` (
  `usuarioid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `area`
--

CREATE TABLE `area` (
  `areaid` int(11) NOT NULL,
  `descripcion` varchar(45) CHARACTER SET utf8 NOT NULL,
  `estado` tinyint(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `area`
--

INSERT INTO `area` (`areaid`, `descripcion`, `estado`) VALUES
(1, 'Sin Area', 0),
(2, 'Software', 0),
(3, 'Mantenimiento', 0),
(4, 'Atencion al cliente', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `usuarioid` int(11) NOT NULL,
  `numerotel` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado`
--

CREATE TABLE `estado` (
  `estadoid` int(8) NOT NULL,
  `descripcion` varchar(45) CHARACTER SET utf8 NOT NULL,
  `estado` tinyint(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `estado`
--

INSERT INTO `estado` (`estadoid`, `descripcion`, `estado`) VALUES
(1, 'Abierto', 0),
(2, 'En proceso', 0),
(3, 'Cerrado', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial`
--

CREATE TABLE `historial` (
  `historialid` int(11) NOT NULL,
  `ticketid` int(11) NOT NULL,
  `usuarioid` int(11) NOT NULL,
  `descripcion` varchar(60) CHARACTER SET utf8 NOT NULL,
  `estadoid` int(11) NOT NULL,
  `fechahora` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `historial`
--

INSERT INTO `historial` (`historialid`, `ticketid`, `usuarioid`, `descripcion`, `estadoid`, `fechahora`) VALUES
(2, 10, 17, 'No puedo iniciar sesión, parece que se cae la conexión', 1, '2020-10-02 00:00:00'),
(4, 12, 17, 'sss', 1, '2020-10-02 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfil`
--

CREATE TABLE `perfil` (
  `perfilid` int(11) NOT NULL,
  `descripcion` varchar(50) NOT NULL,
  `estado` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `perfil`
--

INSERT INTO `perfil` (`perfilid`, `descripcion`, `estado`) VALUES
(1, 'Administrador', 0),
(2, 'Cliente', 0),
(3, 'Tecnico', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prioridad`
--

CREATE TABLE `prioridad` (
  `prioridadid` int(8) NOT NULL,
  `descripcion` varchar(45) NOT NULL,
  `estado` tinyint(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `prioridad`
--

INSERT INTO `prioridad` (`prioridadid`, `descripcion`, `estado`) VALUES
(1, 'Baja', 0),
(2, 'Media', 0),
(3, 'Alta', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tecnico`
--

CREATE TABLE `tecnico` (
  `usuarioid` int(11) NOT NULL,
  `areaid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ticket`
--

CREATE TABLE `ticket` (
  `ticketid` int(11) NOT NULL,
  `usuarioid` int(11) NOT NULL,
  `titulo` varchar(45) NOT NULL,
  `prioridadid` int(11) NOT NULL,
  `ipservidor` varchar(45) DEFAULT NULL,
  `claveservidor` int(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ticket`
--

INSERT INTO `ticket` (`ticketid`, `usuarioid`, `titulo`, `prioridadid`, `ipservidor`, `claveservidor`) VALUES
(10, 17, 'Problemas de conexion', 3, '19216801', 14526330),
(12, 17, 'aaa', 1, '123', 333);

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
  `perfilid` int(11) NOT NULL,
  `areaid` int(11) NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`usuarioid`, `nombre`, `apellido`, `usuario`, `clave`, `correo`, `perfilid`, `areaid`, `estado`) VALUES
(1, 'Nacho', 'Godano', 'ngodano', '654321', 'ngodano@gmail.com', 1, 2, 0),
(13, 'Ulises', 'Scovenna', 'uscovenna', '827ccb0eea8a706c4c34a16891f84e7b', 'uscovenna@gmail.com', 3, 2, 0),
(17, 'Juan', 'Otero', 'jotero', '3d2172418ce305c7d16d4b05597c6a59', 'jotero@gmail.com', 1, 2, 0),
(19, 'Pedro', 'Rodriguez', 'pedror', '2be9bd7a3434f7038ca27d1918de58bd', 'prodriguez@gmail.com', 2, 1, 0),
(20, 'Luciano', 'Annecchini', 'lucianoanne', '2be9bd7a3434f7038ca27d1918de58bd', 'lucianoanne@gmail.com', 3, 3, 0),
(21, 'aa', 'sss', 'assssaa', '827ccb0eea8a706c4c34a16891f84e7b', 'asasasas', 2, 1, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`usuarioid`);

--
-- Indices de la tabla `area`
--
ALTER TABLE `area`
  ADD PRIMARY KEY (`areaid`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`usuarioid`);

--
-- Indices de la tabla `estado`
--
ALTER TABLE `estado`
  ADD PRIMARY KEY (`estadoid`);

--
-- Indices de la tabla `historial`
--
ALTER TABLE `historial`
  ADD PRIMARY KEY (`historialid`),
  ADD KEY `ticketid` (`ticketid`),
  ADD KEY `usuarioid` (`usuarioid`),
  ADD KEY `estadoid` (`estadoid`);

--
-- Indices de la tabla `perfil`
--
ALTER TABLE `perfil`
  ADD PRIMARY KEY (`perfilid`);

--
-- Indices de la tabla `prioridad`
--
ALTER TABLE `prioridad`
  ADD PRIMARY KEY (`prioridadid`);

--
-- Indices de la tabla `tecnico`
--
ALTER TABLE `tecnico`
  ADD PRIMARY KEY (`usuarioid`),
  ADD KEY `areaid` (`areaid`);

--
-- Indices de la tabla `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`ticketid`),
  ADD KEY `usuarioid` (`usuarioid`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`usuarioid`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `area`
--
ALTER TABLE `area`
  MODIFY `areaid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `estado`
--
ALTER TABLE `estado`
  MODIFY `estadoid` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `historial`
--
ALTER TABLE `historial`
  MODIFY `historialid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `perfil`
--
ALTER TABLE `perfil`
  MODIFY `perfilid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `prioridad`
--
ALTER TABLE `prioridad`
  MODIFY `prioridadid` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `ticket`
--
ALTER TABLE `ticket`
  MODIFY `ticketid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `usuarioid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `fk_adminusuario` FOREIGN KEY (`usuarioid`) REFERENCES `usuario` (`usuarioid`);

--
-- Filtros para la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `fk_clienteusuario` FOREIGN KEY (`usuarioid`) REFERENCES `usuario` (`usuarioid`);

--
-- Filtros para la tabla `historial`
--
ALTER TABLE `historial`
  ADD CONSTRAINT `fk_historialestado` FOREIGN KEY (`estadoid`) REFERENCES `estado` (`estadoid`),
  ADD CONSTRAINT `fk_historialticket` FOREIGN KEY (`ticketid`) REFERENCES `ticket` (`ticketid`),
  ADD CONSTRAINT `fk_historialuser` FOREIGN KEY (`usuarioid`) REFERENCES `usuario` (`usuarioid`);

--
-- Filtros para la tabla `tecnico`
--
ALTER TABLE `tecnico`
  ADD CONSTRAINT `fk_tecnicoarea` FOREIGN KEY (`areaid`) REFERENCES `area` (`areaid`),
  ADD CONSTRAINT `fk_tecnicousuario` FOREIGN KEY (`usuarioid`) REFERENCES `usuario` (`usuarioid`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
