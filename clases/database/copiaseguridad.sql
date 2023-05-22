-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-05-2023 a las 16:56:31
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `encuestas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `company`
--

CREATE TABLE `company` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `refimenFiscal` varchar(255) NOT NULL,
  `domicilio` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `correo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `company`
--

INSERT INTO `company` (`id`, `nombre`, `refimenFiscal`, `domicilio`, `pass`, `correo`) VALUES
(1, 'misesa', '601', 'nose we', '$2y$10$qMc7u3CBh9VedDaVbT94YedpucDTGgU6jA5/buJF9IkYE41GmhKU2', 'misesa@gmail.com'),
(2, 'zacred', '600', 'zacatecas', '$2y$10$7vaWHEVUGqR4gaHCC267je8BhHpwAo42CL.s69QvDl7f6dn1zZM4.', 'zacred@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pregunta`
--

CREATE TABLE `pregunta` (
  `id` int(11) NOT NULL,
  `pregunta` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pregunta`
--

INSERT INTO `pregunta` (`id`, `pregunta`) VALUES
(1, 'Mi trabajo me exige hace mucho esfuerzo'),
(2, 'Me preocupa sufrir un accidente laboral'),
(3, 'Considero que las actividades que realizo son peligrosas'),
(4, 'Por la cantidad de trabajo que tengo debo quedarme tiempo adicional a mi turno'),
(5, 'Por la cantidad de trabajo que tengo debo trabajar sin parar'),
(6, 'Considero que es necesario mantener un ritmo de trabajo acelerado'),
(7, 'Mi trabajo exige que esté muy concentrado'),
(8, 'Mi trabajo requiere que memorice mucha información'),
(9, 'Mi trabajo exige que atienda varios asuntos al mismo tiempo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `respuestasuser`
--

CREATE TABLE `respuestasuser` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `pregunta_id` int(11) NOT NULL,
  `respuesta` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `respuestasuser`
--

INSERT INTO `respuestasuser` (`id`, `user_id`, `pregunta_id`, `respuesta`) VALUES
(1, 1, 1, 'Casi nunca'),
(2, 1, 2, 'Casi nunca'),
(3, 1, 3, 'Nunca'),
(4, 1, 4, 'Algunas veces'),
(5, 1, 5, 'Algunas veces'),
(6, 1, 6, 'Casi siempre'),
(7, 1, 7, 'Casi siempre'),
(8, 1, 8, 'siempre'),
(9, 1, 9, 'Algunas veces'),
(10, 2, 1, 'siempre'),
(11, 2, 2, 'siempre'),
(12, 2, 3, 'siempre'),
(13, 2, 4, 'siempre'),
(14, 2, 5, 'siempre'),
(15, 2, 6, 'siempre'),
(16, 2, 7, 'siempre'),
(17, 2, 8, 'siempre'),
(18, 2, 9, 'siempre'),
(19, 5, 1, 'siempre'),
(20, 5, 2, 'siempre'),
(21, 5, 3, 'siempre'),
(22, 5, 4, 'siempre'),
(23, 5, 5, 'siempre'),
(24, 5, 6, 'siempre'),
(25, 5, 7, 'siempre'),
(26, 5, 8, 'siempre'),
(27, 5, 9, 'siempre'),
(28, 6, 1, 'Casi siempre'),
(29, 6, 2, 'Casi siempre'),
(30, 6, 3, 'Casi siempre'),
(31, 6, 4, 'Casi siempre'),
(32, 6, 5, 'Casi siempre'),
(33, 6, 6, 'Casi siempre'),
(34, 6, 7, 'Casi siempre'),
(35, 6, 8, 'Casi siempre'),
(36, 6, 9, 'Casi siempre'),
(37, 7, 1, 'siempre'),
(38, 7, 2, 'Casi siempre'),
(39, 7, 3, 'Algunas veces'),
(40, 7, 4, ''),
(41, 7, 5, 'Casi nunca'),
(42, 7, 6, 'Casi siempre'),
(43, 7, 7, 'Casi siempre'),
(44, 7, 8, 'Casi siempre'),
(45, 8, 1, 'Nunca'),
(46, 8, 2, 'Nunca'),
(47, 8, 3, 'Nunca'),
(48, 8, 4, 'Nunca'),
(49, 8, 5, 'Nunca'),
(50, 8, 6, 'Nunca'),
(51, 8, 7, 'Nunca'),
(52, 8, 8, 'Nunca'),
(53, 8, 9, 'Nunca');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `rfc` varchar(16) NOT NULL,
  `correo` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `company_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id`, `nombre`, `rfc`, `correo`, `pass`, `company_id`) VALUES
(1, 'jared', 'sdaw', 'jaretito@gmail.com', '$2y$10$B7AF948QX.fLloW8B/HYBOgyeAwI7EIkvTqMDwXN2kHWULfBnUl0C', 1),
(2, 'prro del diablo', 'sdawsss', 'prro@gmail.com', '$2y$10$l5WwwWYtQac2BrEoe6jrPu3Kf0wpEiak3se2xBZEVtMBFBsS3XhKu', 1),
(4, 'md', 'imd', 'imad@gmail.com', '$2y$10$XBQ6vYCylO1ACVC0G9WS6uQsqAZHac50mBcecgVKYxIEN5aqDJSXi', 1),
(5, 'mixwel', 'nose', 'mix@gmail.com', '$2y$10$iwxCHxXcyWyJEIembr2yL.RKEkAJualFEOevDkhJIRsYqkkQJKCiK', 1),
(6, 'prro del diablo dos', 'dmwai', 'perrito@gmail.com', '$2y$10$Giv.9gqkcbtpqN2j.kFCo.zRNDHoIwJ.OalXhjPJdEuA3MKFk05v2', 1),
(7, 'prro del diablo tres', '486484', 'trees@gmail.com', '$2y$10$hFIRkiK9VA6osj0bMwzmqOlVri5ticvrkGhET9He.IZ1N4ceMQnFW', 1),
(8, 'valorant@gmail.com', 'dwamdwaim', 'valorant@gmail.com', '$2y$10$il7/8N/UERCr.kZLM0PycuxNurwEtb.wSg5O5FMPiSX2u1.fhRDAS', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `userroot`
--

CREATE TABLE `userroot` (
  `id` int(11) NOT NULL,
  `correo` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `userroot`
--

INSERT INTO `userroot` (`id`, `correo`, `pass`) VALUES
(1, 'root@gmail.com', '123');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `correo` (`correo`);

--
-- Indices de la tabla `pregunta`
--
ALTER TABLE `pregunta`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `respuestasuser`
--
ALTER TABLE `respuestasuser`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `pregunta_id` (`pregunta_id`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `correo` (`correo`),
  ADD KEY `company_id` (`company_id`);

--
-- Indices de la tabla `userroot`
--
ALTER TABLE `userroot`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `correo` (`correo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `company`
--
ALTER TABLE `company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `pregunta`
--
ALTER TABLE `pregunta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `respuestasuser`
--
ALTER TABLE `respuestasuser`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `userroot`
--
ALTER TABLE `userroot`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `respuestasuser`
--
ALTER TABLE `respuestasuser`
  ADD CONSTRAINT `respuestasuser_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `respuestasuser_ibfk_2` FOREIGN KEY (`pregunta_id`) REFERENCES `pregunta` (`id`);

--
-- Filtros para la tabla `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
