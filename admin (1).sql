-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-12-2023 a las 15:38:24
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
-- Base de datos: `admin`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `info`
--

CREATE TABLE `info` (
  `id` int(11) NOT NULL,
  `nombre` text NOT NULL,
  `tipo` text NOT NULL,
  `talla` varchar(5) NOT NULL,
  `precio` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `info`
--

INSERT INTO `info` (`id`, `nombre`, `tipo`, `talla`, `precio`) VALUES
(1, 'Nike', 'remera', 'x-xl', '$15.000'),
(13, 'Adidas', 'pantalon', 'L-xxl', '$16.000'),
(14, 'Gucci', 'zapatilla', '40', '$80.000'),
(15, 'Chanel', 'remera', 'x-xxl', '$40.000'),
(16, 'Nike', 'calcetines', 's-xl', '$12.000'),
(17, 'Adidas', 'camiseta', 'xl', '$17.000'),
(19, 'Nike', 'camisa', 's-xl', '$25.000'),
(21, 'Adidas', 'campera', 'x-xl', '$35.000');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `info`
--
ALTER TABLE `info`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `info`
--
ALTER TABLE `info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
