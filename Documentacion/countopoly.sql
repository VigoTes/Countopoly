-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-09-2021 a las 08:09:31
-- Versión del servidor: 5.7.32-log
-- Versión de PHP: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `countopoly`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuenta`
--

CREATE TABLE `cuenta` (
  `codCuenta` int(11) NOT NULL,
  `usuario` varchar(200) NOT NULL,
  `password` varchar(500) NOT NULL,
  `fechaHoraCreacion` datetime NOT NULL,
  `codTipoCuenta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cuenta`
--

INSERT INTO `cuenta` (`codCuenta`, `usuario`, `password`, `fechaHoraCreacion`, `codTipoCuenta`) VALUES
(0, 'Banco', '123', '2021-02-02 23:22:59', 1),
(1, 'vigo', '$2y$10$NT382fPkmou2YFXnAfN5V.DghGqNKhA5Ai/DycFWTIQ4dJKmlbXOu', '2021-02-02 23:22:59', 1),
(2, 'eli', '$2y$10$NT382fPkmou2YFXnAfN5V.DghGqNKhA5Ai/DycFWTIQ4dJKmlbXOu', '2021-02-03 10:30:08', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_partida`
--

CREATE TABLE `estado_partida` (
  `codEstadoPartida` int(11) NOT NULL,
  `nombre` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `estado_partida`
--

INSERT INTO `estado_partida` (`codEstadoPartida`, `nombre`) VALUES
(1, 'En espera'),
(2, 'Jugandose'),
(3, 'Finalizada'),
(4, 'Cancelada'),
(5, 'Pausada');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jugador`
--

CREATE TABLE `jugador` (
  `codJugador` int(11) NOT NULL,
  `codPartida` int(11) NOT NULL,
  `montoActual` int(11) NOT NULL,
  `codCuenta` int(11) NOT NULL,
  `esBanco` tinyint(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `jugador`
--

INSERT INTO `jugador` (`codJugador`, `codPartida`, `montoActual`, `codCuenta`, `esBanco`) VALUES
(1, 9, 0, 1, 0),
(2, 10, 0, 1, 0),
(3, 11, 0, 1, 0),
(4, 11, 0, 2, 0),
(5, 11, 0, 1, 0),
(6, 11, 0, 1, 0),
(7, 11, 0, 2, 0),
(8, 11, 0, 2, 0),
(9, 2, 0, 1, 0),
(11, 12, 0, 1, 0),
(14, 13, 0, 1, 0),
(16, 14, 0, 1, 0),
(18, 15, 5000, 1, 0),
(21, 15, 5000, 20, 0),
(22, 16, 5000, 1, 0),
(24, 16, 5000, 0, 0),
(25, 17, 5000, 2, 0),
(27, 17, 5000, 0, 1),
(28, 18, 5000, 1, 0),
(30, 18, 99999999, 0, 1),
(31, 19, 649, 1, 0),
(32, 19, 5626, 2, 0),
(33, 19, 8725, 0, 1),
(34, 20, 0, 1, 0),
(35, 20, 10000, 2, 0),
(36, 20, 5000, 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `link`
--

CREATE TABLE `link` (
  `codLink` int(11) NOT NULL,
  `stringCodigoQR` varchar(500) NOT NULL,
  `fechaDesbloqueo` date NOT NULL,
  `descripcion` varchar(2000) NOT NULL,
  `rutaImagen` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `partida`
--

CREATE TABLE `partida` (
  `codPartida` int(11) NOT NULL,
  `fechaHoraInicio` datetime DEFAULT NULL,
  `fechaHoraFinalizacion` datetime DEFAULT NULL,
  `codCuentaHost` int(11) NOT NULL,
  `codJugadorBanco` int(11) DEFAULT NULL,
  `codJugadorBancario` int(11) DEFAULT NULL,
  `codEstadoPartida` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `partida`
--

INSERT INTO `partida` (`codPartida`, `fechaHoraInicio`, `fechaHoraFinalizacion`, `codCuentaHost`, `codJugadorBanco`, `codJugadorBancario`, `codEstadoPartida`) VALUES
(1, NULL, NULL, 1, NULL, NULL, 3),
(2, NULL, NULL, 1, NULL, NULL, 4),
(3, NULL, NULL, 1, NULL, NULL, 3),
(4, NULL, NULL, 1, NULL, NULL, 3),
(5, NULL, NULL, 1, NULL, NULL, 3),
(9, NULL, NULL, 1, NULL, NULL, 4),
(10, NULL, NULL, 1, NULL, NULL, 3),
(11, NULL, NULL, 1, NULL, NULL, 3),
(12, NULL, NULL, 1, NULL, NULL, 2),
(13, NULL, NULL, 1, NULL, NULL, 4),
(14, NULL, NULL, 1, NULL, NULL, 4),
(15, NULL, NULL, 1, 21, 20, 2),
(16, NULL, NULL, 1, 24, 23, 2),
(17, NULL, NULL, 2, 27, 25, 2),
(18, NULL, NULL, 1, 30, 28, 4),
(19, NULL, NULL, 1, 33, 31, 2),
(20, NULL, NULL, 1, 36, 35, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_cuenta`
--

CREATE TABLE `tipo_cuenta` (
  `codTipoCuenta` int(11) NOT NULL,
  `nombre` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_transaccion_monetaria`
--

CREATE TABLE `tipo_transaccion_monetaria` (
  `codTipoTransaccion` int(11) NOT NULL,
  `nombre` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tipo_transaccion_monetaria`
--

INSERT INTO `tipo_transaccion_monetaria` (`codTipoTransaccion`, `nombre`) VALUES
(1, 'Pago al banco'),
(2, 'Pago del banco'),
(3, 'Compra Venta'),
(4, 'Cobro impuestos'),
(5, 'Cobro salida');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `transaccion_monetaria`
--

CREATE TABLE `transaccion_monetaria` (
  `codTransaccionMonetaria` int(11) NOT NULL,
  `codJugadorSaliente` int(11) NOT NULL,
  `codPartida` int(11) NOT NULL,
  `codJugadorEntrante` int(11) NOT NULL,
  `codTipoTransaccion` int(11) NOT NULL,
  `fechaHora` datetime NOT NULL,
  `monto` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `transaccion_monetaria`
--

INSERT INTO `transaccion_monetaria` (`codTransaccionMonetaria`, `codJugadorSaliente`, `codPartida`, `codJugadorEntrante`, `codTipoTransaccion`, `fechaHora`, `monto`) VALUES
(1, 33, 19, 31, 2, '2021-09-11 17:17:40', 5000),
(2, 33, 19, 32, 2, '2021-09-11 17:17:40', 5000),
(3, 33, 19, 33, 2, '2021-09-11 17:17:40', 5000),
(4, 31, 19, 32, 1, '2021-09-11 18:14:12', 525),
(5, 31, 19, 32, 1, '2021-09-11 18:15:38', 15),
(6, 31, 19, 32, 1, '2021-09-11 18:17:35', 25),
(7, 31, 19, 32, 1, '2021-09-11 18:20:51', 1258),
(8, 31, 19, 32, 1, '2021-09-11 18:22:40', 0),
(9, 31, 19, 32, 1, '2021-09-11 19:32:21', 50),
(10, 31, 19, 32, 1, '2021-09-11 19:32:43', 2210),
(11, 31, 19, 33, 1, '2021-09-11 19:34:14', 512),
(12, 32, 19, 33, 1, '2021-09-11 19:34:33', 1140),
(13, 32, 19, 33, 1, '2021-09-11 19:34:39', 414),
(14, 32, 19, 33, 1, '2021-09-11 19:34:44', 1414),
(15, 31, 19, 33, 1, '2021-09-11 19:35:32', 120),
(16, 31, 19, 33, 1, '2021-09-11 19:35:51', 125),
(17, 31, 19, 32, 1, '2021-09-11 19:35:57', 51),
(18, 36, 20, 34, 2, '2021-09-12 01:56:46', 5000),
(19, 36, 20, 35, 2, '2021-09-12 01:56:46', 5000),
(20, 36, 20, 36, 2, '2021-09-12 01:56:46', 5000),
(21, 34, 20, 35, 1, '2021-09-12 01:58:08', 300),
(22, 35, 20, 34, 1, '2021-09-12 01:58:24', 1),
(23, 35, 20, 34, 1, '2021-09-12 01:58:38', 299),
(24, 34, 20, 35, 1, '2021-09-12 01:58:42', 511),
(25, 35, 20, 34, 1, '2021-09-12 01:59:53', 800),
(26, 34, 20, 35, 1, '2021-09-12 02:00:17', 5289);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cuenta`
--
ALTER TABLE `cuenta`
  ADD PRIMARY KEY (`codCuenta`);

--
-- Indices de la tabla `estado_partida`
--
ALTER TABLE `estado_partida`
  ADD PRIMARY KEY (`codEstadoPartida`);

--
-- Indices de la tabla `jugador`
--
ALTER TABLE `jugador`
  ADD PRIMARY KEY (`codJugador`);

--
-- Indices de la tabla `link`
--
ALTER TABLE `link`
  ADD PRIMARY KEY (`codLink`);

--
-- Indices de la tabla `partida`
--
ALTER TABLE `partida`
  ADD PRIMARY KEY (`codPartida`);

--
-- Indices de la tabla `tipo_cuenta`
--
ALTER TABLE `tipo_cuenta`
  ADD PRIMARY KEY (`codTipoCuenta`);

--
-- Indices de la tabla `tipo_transaccion_monetaria`
--
ALTER TABLE `tipo_transaccion_monetaria`
  ADD PRIMARY KEY (`codTipoTransaccion`);

--
-- Indices de la tabla `transaccion_monetaria`
--
ALTER TABLE `transaccion_monetaria`
  ADD PRIMARY KEY (`codTransaccionMonetaria`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cuenta`
--
ALTER TABLE `cuenta`
  MODIFY `codCuenta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `estado_partida`
--
ALTER TABLE `estado_partida`
  MODIFY `codEstadoPartida` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `jugador`
--
ALTER TABLE `jugador`
  MODIFY `codJugador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de la tabla `link`
--
ALTER TABLE `link`
  MODIFY `codLink` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `partida`
--
ALTER TABLE `partida`
  MODIFY `codPartida` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `tipo_cuenta`
--
ALTER TABLE `tipo_cuenta`
  MODIFY `codTipoCuenta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tipo_transaccion_monetaria`
--
ALTER TABLE `tipo_transaccion_monetaria`
  MODIFY `codTipoTransaccion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `transaccion_monetaria`
--
ALTER TABLE `transaccion_monetaria`
  MODIFY `codTransaccionMonetaria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
