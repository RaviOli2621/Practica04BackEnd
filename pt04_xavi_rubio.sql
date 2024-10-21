-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-10-2024 a las 18:24:05
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `pt04_xavi_rubio`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `articles`
--
DROP DATABASE IF EXISTS pt04_xavi_rubio; 
CREATE DATABASE pt04_xavi_rubio;

USE pt04_xavi_rubio;

CREATE TABLE `articles` (
  `ID` int(5) NOT NULL,
  `Usuari` varchar(50) NOT NULL,
  `titol` varchar(1000) NOT NULL DEFAULT 'titulo',
  `cos` varchar(10000) NOT NULL DEFAULT 'cuerpo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `articles`
--

INSERT INTO `articles` (`ID`, `Usuari`, `titol`, `cos`) VALUES
(40, 'Xavi', 'Cancelar [Cancel]', '– v. Empezar un movimiento antes de que la animación del previo haya terminado; el final del movimiento previo es “cancelado” y el siguiente inicia inmediatamente. Qué movimientos pueden ser cancelados a otros depende de cada juego, pero en muchos casos ataques débiles pueden ser cancelados a ataques normales, y muchos normales pueden ser cancelados a especiales.'),
(41, 'Xavi', 'Encadenar [Chain]', '– v. Se usa para describir la cancelación de un movimiento a otro.\n– s. El acto de “Encadenar” un movimiento con otro.'),
(42, 'Xavi', 'Daño Chip [Chip Damage]\n', '– s. Ver “Daño por Bloqueo”.\n– v. La acción de causar al oponente este tipo de daño.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuaris`
--

CREATE TABLE `usuaris` (
  `Correu` varchar(50) NOT NULL,
  `Usuari` varchar(50) NOT NULL,
  `Contrasenya` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuaris`
--

INSERT INTO `usuaris` (`Correu`, `Usuari`, `Contrasenya`) VALUES
('paco@gmail.com', 'paco', '$2y$10$ayMQJfjcXgQwEUjvl842WebYLlFNRd4kWoDFHsSzTl9V.XgPbTNf6'),
('j.rubio2@sapalomera.cat', 'Xavi', '$2y$10$nYuz39qBoIN.fYO1a7nj9.afti5gAQ8c8kJ9Q2gurD1a6oxPWfaeC'),
('xmartin@sapalomera.cat', 'XaviProfe', '$2y$10$JUTZ3Zc0jsSxtpH1UdoRDeijZAK.0SxAivYRIEUh8Onvx7AR/mHyy');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `usuaris`
--
ALTER TABLE `usuaris`
  ADD UNIQUE KEY `Usuari` (`Usuari`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `articles`
--
ALTER TABLE `articles`
  MODIFY `ID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
