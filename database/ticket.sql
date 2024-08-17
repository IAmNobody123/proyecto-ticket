-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-08-2024 a las 23:09:30
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `ticket`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_CANTIDADTIPOPROBLEMA` ()   SELECT tp.nombreProblema, count(*) as cantidad FROM problema p inner join tipoproblema tp 
on p.idTipoProblema =tp.idTipoProblema
GROUP by tp.idTipoProblema$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `oficina`
--

CREATE TABLE `oficina` (
  `idOficina` int(11) NOT NULL,
  `nombreOficina` varchar(100) DEFAULT NULL,
  `idSede` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `oficina`
--

INSERT INTO `oficina` (`idOficina`, `nombreOficina`, `idSede`) VALUES
(1, 'OTI', 1),
(2, 'RRHH', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `problema`
--

CREATE TABLE `problema` (
  `idProblema` int(11) NOT NULL,
  `descripcionProblema` varchar(100) DEFAULT NULL,
  `estadoProblema` varchar(11) NOT NULL DEFAULT 'entregado',
  `fechaProblema` datetime NOT NULL DEFAULT current_timestamp(),
  `fechaProblemaAceptado` datetime NOT NULL DEFAULT current_timestamp(),
  `fechaProblemaAtendido` datetime NOT NULL DEFAULT current_timestamp(),
  `idTipoProblema` int(11) DEFAULT NULL,
  `idUsuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `idRol` int(11) NOT NULL,
  `nombreRol` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`idRol`, `nombreRol`) VALUES
(1, 'Administrador'),
(2, 'Practicante'),
(3, 'usuario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sede`
--

CREATE TABLE `sede` (
  `idSede` int(11) NOT NULL,
  `nombreSede` varchar(50) DEFAULT NULL,
  `lugarReferencia` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `sede`
--

INSERT INTO `sede` (`idSede`, `nombreSede`, `lugarReferencia`) VALUES
(1, 'central', 'Plaza regocijo'),
(2, 'Qoricancha', 'en av. sol');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ticket`
--

CREATE TABLE `ticket` (
  `idTicket` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `estadoTicket` varchar(10) DEFAULT 'aceptado',
  `fechaAtencion` date NOT NULL DEFAULT current_timestamp(),
  `horaAtencion` time NOT NULL DEFAULT current_timestamp(),
  `requerimiento` varchar(255) NOT NULL,
  `descripcion_solucion` text DEFAULT NULL,
  `idUsuario` int(11) DEFAULT NULL,
  `idProblema` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipoproblema`
--

CREATE TABLE `tipoproblema` (
  `idTipoProblema` int(11) NOT NULL,
  `nombreProblema` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipoproblema`
--

INSERT INTO `tipoproblema` (`idTipoProblema`, `nombreProblema`) VALUES
(1, 'problema con la impresora'),
(2, 'problema con la computadora'),
(3, 'problema de internet'),
(4, 'problema de algún programa'),
(5, 'ayuda tecnica para reunion'),
(6, 'otro');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idUsuario` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `idLogin` varchar(15) DEFAULT NULL,
  `password` varchar(10) DEFAULT NULL,
  `tareaAsignada` enum('ocupado','libre') NOT NULL DEFAULT 'libre',
  `estado` enum('activo','inactivo') NOT NULL DEFAULT 'activo',
  `direccionImagen` varchar(50) DEFAULT NULL,
  `idOficina` int(11) DEFAULT NULL,
  `idRol` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idUsuario`, `nombre`, `idLogin`, `password`, `tareaAsignada`, `estado`, `direccionImagen`, `idOficina`, `idRol`) VALUES
(1, '', 'admin', 'admin', 'libre', 'activo', NULL, 1, 1);
--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `oficina`
--
ALTER TABLE `oficina`
  ADD PRIMARY KEY (`idOficina`),
  ADD KEY `idSede` (`idSede`);

--
-- Indices de la tabla `problema`
--
ALTER TABLE `problema`
  ADD PRIMARY KEY (`idProblema`),
  ADD KEY `idTipoProblema` (`idTipoProblema`),
  ADD KEY `idUsuario` (`idUsuario`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`idRol`);

--
-- Indices de la tabla `sede`
--
ALTER TABLE `sede`
  ADD PRIMARY KEY (`idSede`);

--
-- Indices de la tabla `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`idTicket`),
  ADD KEY `idUsuario` (`idUsuario`),
  ADD KEY `idProblema` (`idProblema`);

--
-- Indices de la tabla `tipoproblema`
--
ALTER TABLE `tipoproblema`
  ADD PRIMARY KEY (`idTipoProblema`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idUsuario`),
  ADD KEY `idRol` (`idRol`),
  ADD KEY `idOficina` (`idOficina`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `oficina`
--
ALTER TABLE `oficina`
  MODIFY `idOficina` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `problema`
--
ALTER TABLE `problema`
  MODIFY `idProblema` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `idRol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `sede`
--
ALTER TABLE `sede`
  MODIFY `idSede` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `ticket`
--
ALTER TABLE `ticket`
  MODIFY `idTicket` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT de la tabla `tipoproblema`
--
ALTER TABLE `tipoproblema`
  MODIFY `idTipoProblema` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `oficina`
--
ALTER TABLE `oficina`
  ADD CONSTRAINT `oficina_ibfk_1` FOREIGN KEY (`idSede`) REFERENCES `sede` (`idSede`);

--
-- Filtros para la tabla `problema`
--
ALTER TABLE `problema`
  ADD CONSTRAINT `problema_ibfk_1` FOREIGN KEY (`idTipoProblema`) REFERENCES `tipoproblema` (`idTipoProblema`),
  ADD CONSTRAINT `problema_ibfk_2` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`);

--
-- Filtros para la tabla `ticket`
--
ALTER TABLE `ticket`
  ADD CONSTRAINT `ticket_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`),
  ADD CONSTRAINT `ticket_ibfk_2` FOREIGN KEY (`idProblema`) REFERENCES `problema` (`idProblema`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`idRol`) REFERENCES `rol` (`idRol`),
  ADD CONSTRAINT `usuario_ibfk_2` FOREIGN KEY (`idOficina`) REFERENCES `oficina` (`idOficina`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
