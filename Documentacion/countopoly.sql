-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 19, 2021 at 08:42 AM
-- Server version: 5.7.32-log
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `countopoly`
--

-- --------------------------------------------------------

--
-- Table structure for table `color`
--

CREATE TABLE `color` (
  `codColor` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `rgb` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `color`
--

INSERT INTO `color` (`codColor`, `nombre`, `rgb`) VALUES
(1, 'Rojo', 'rgb(204, 0, 0)'),
(2, 'Verde', 'rgb(51, 153, 51)'),
(3, 'Amarillo', 'rgb(255, 255, 0)'),
(4, 'Naranja', 'rgb(255, 102, 0)'),
(5, 'Celeste', 'rgb(102, 204, 255)'),
(6, 'Morado', 'rgb(153, 0, 255)'),
(7, 'Fucsia', 'rgb(255, 0, 255)'),
(8, 'Turquesa', 'rgb(0, 102, 255)'),
(9, 'Trenes', 'rgb(255, 153, 255)'),
(10, 'Servicios', 'rgb(102, 153, 153)');

-- --------------------------------------------------------

--
-- Table structure for table `cuenta`
--

CREATE TABLE `cuenta` (
  `codCuenta` int(11) NOT NULL,
  `usuario` varchar(200) NOT NULL,
  `password` varchar(500) NOT NULL,
  `fechaHoraCreacion` datetime NOT NULL,
  `codTipoCuenta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cuenta`
--

INSERT INTO `cuenta` (`codCuenta`, `usuario`, `password`, `fechaHoraCreacion`, `codTipoCuenta`) VALUES
(0, 'Banco', '123', '2021-02-02 23:22:59', 1),
(1, 'vigo', '$2y$10$VJ/voMAg/ougyYqlXQ/Fae4qJLWMqoM7IsWqevt4uo.pFlE7QHZ6G', '2021-02-02 23:22:59', 1),
(2, 'eli', '$2y$10$2r2BWcjVcv1TprAt6Ym5ru1C2GKlxC1ZPiD7Swb9AAnJ6sRBnseJm', '2021-02-03 10:30:08', 1);

-- --------------------------------------------------------

--
-- Table structure for table `edicion`
--

CREATE TABLE `edicion` (
  `codEdicion` int(11) NOT NULL,
  `nombre` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `edicion`
--

INSERT INTO `edicion` (`codEdicion`, `nombre`) VALUES
(1, 'Peruana'),
(2, 'Clásica');

-- --------------------------------------------------------

--
-- Table structure for table `estado_partida`
--

CREATE TABLE `estado_partida` (
  `codEstadoPartida` int(11) NOT NULL,
  `nombre` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `estado_partida`
--

INSERT INTO `estado_partida` (`codEstadoPartida`, `nombre`) VALUES
(1, 'En espera'),
(2, 'Jugandose'),
(3, 'Finalizada'),
(4, 'Cancelada'),
(5, 'Pausada');

-- --------------------------------------------------------

--
-- Table structure for table `jugador`
--

CREATE TABLE `jugador` (
  `codJugador` int(11) NOT NULL,
  `codPartida` int(11) NOT NULL,
  `montoActual` int(11) NOT NULL,
  `codCuenta` int(11) NOT NULL,
  `esBanco` tinyint(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jugador`
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
(21, 15, 5000, 2, 0),
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
(36, 20, 5000, 0, 1),
(37, 21, 4281, 1, 0),
(38, 21, 5169, 2, 0),
(39, 21, 5550, 0, 1),
(40, 22, 5000, 1, 0),
(41, 22, 5000, 2, 0),
(42, 22, 5000, 0, 1),
(43, 23, 5000, 1, 0),
(44, 23, 5000, 2, 0),
(46, 23, 5000, 0, 1),
(47, 24, 0, 1, 0),
(50, 25, 0, 2, 0),
(52, 26, 5000, 2, 0),
(55, 26, 5000, 1, 0),
(56, 26, 5000, 0, 1),
(57, 27, 0, 1, 0),
(59, 28, 0, 1, 0),
(61, 29, 0, 1, 0),
(63, 30, 0, 1, 0),
(65, 31, 4951, 1, 0),
(66, 31, 5049, 2, 0),
(67, 31, 5000, 0, 1),
(68, 32, 0, 1, 0),
(70, 33, 4733, 1, 0),
(78, 33, 5052, 2, 0),
(79, 33, 5215, 0, 1),
(80, 34, 2945, 1, 0),
(81, 34, 5005, 2, 0),
(82, 34, 7050, 0, 1),
(83, 35, 5000, 1, 0),
(84, 35, 5000, 2, 0),
(85, 35, 5000, 0, 1),
(86, 36, 5000, 1, 0),
(87, 36, 5000, 2, 0),
(88, 36, 5000, 0, 1),
(89, 37, 5000, 1, 0),
(90, 38, 5000, 1, 0),
(91, 38, 5000, 0, 1),
(92, 37, 5000, 2, 0),
(93, 37, 5000, 0, 1),
(94, 39, 5000, 1, 0),
(95, 39, 5000, 0, 1),
(96, 40, 6206, 1, 0),
(97, 40, 3794, 0, 1),
(98, 41, 6282, 2, 0),
(99, 41, 4790, 1, 0),
(100, 41, 99998927, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `link`
--

CREATE TABLE `link` (
  `codLink` int(11) NOT NULL,
  `stringCodigoQR` varchar(500) NOT NULL,
  `fechaDesbloqueo` date NOT NULL,
  `descripcion` varchar(2000) NOT NULL,
  `nombreImagen` varchar(500) NOT NULL,
  `tamañoImagen` int(11) NOT NULL,
  `alineamiento` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `link`
--

INSERT INTO `link` (`codLink`, `stringCodigoQR`, `fechaDesbloqueo`, `descripcion`, `nombreImagen`, `tamañoImagen`, `alineamiento`) VALUES
(1, '6a37adk282jy8k8y85', '2021-09-13', 'adadas', 'aniversario.jpg', 50, 'center'),
(3, 'a6a3s5yy80ykyyamaa', '2021-09-14', 'linea 1\r\nlinea 2', 'a', 52, ''),
(4, 'asd', '2021-09-17', 'linea 1\r\n\r\nlinea 2', 'a5a', 25, '');

-- --------------------------------------------------------

--
-- Table structure for table `partida`
--

CREATE TABLE `partida` (
  `codPartida` int(11) NOT NULL,
  `fechaHoraInicio` datetime DEFAULT NULL,
  `fechaHoraFinalizacion` datetime DEFAULT NULL,
  `codCuentaHost` int(11) NOT NULL,
  `codJugadorBanco` int(11) DEFAULT NULL,
  `codJugadorBancario` int(11) DEFAULT NULL,
  `codEstadoPartida` int(11) NOT NULL,
  `codEdicion` int(11) NOT NULL,
  `tokenSincronizacion` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `partida`
--

INSERT INTO `partida` (`codPartida`, `fechaHoraInicio`, `fechaHoraFinalizacion`, `codCuentaHost`, `codJugadorBanco`, `codJugadorBancario`, `codEstadoPartida`, `codEdicion`, `tokenSincronizacion`) VALUES
(1, NULL, NULL, 1, NULL, NULL, 3, 1, ''),
(2, NULL, NULL, 1, NULL, NULL, 4, 1, ''),
(3, NULL, NULL, 1, NULL, NULL, 3, 1, ''),
(4, NULL, NULL, 1, NULL, NULL, 3, 1, ''),
(5, NULL, NULL, 1, NULL, NULL, 3, 1, ''),
(9, NULL, NULL, 1, NULL, NULL, 4, 1, ''),
(10, NULL, NULL, 1, NULL, NULL, 3, 1, ''),
(11, NULL, NULL, 1, NULL, NULL, 3, 1, ''),
(12, NULL, NULL, 1, NULL, NULL, 2, 1, ''),
(13, NULL, NULL, 1, NULL, NULL, 4, 1, ''),
(14, NULL, NULL, 1, NULL, NULL, 4, 1, ''),
(15, NULL, NULL, 1, 21, 20, 2, 1, ''),
(16, NULL, NULL, 1, 24, 23, 2, 1, ''),
(17, NULL, NULL, 2, 27, 25, 2, 1, ''),
(18, NULL, NULL, 1, 30, 28, 4, 1, ''),
(19, NULL, NULL, 1, 33, 31, 2, 1, ''),
(20, NULL, NULL, 1, 36, 35, 2, 1, '34014282'),
(21, NULL, NULL, 1, 39, 37, 2, 1, ''),
(22, NULL, NULL, 1, 42, 40, 2, 2, ''),
(23, NULL, NULL, 1, 46, 43, 2, 1, ''),
(24, NULL, NULL, 1, NULL, 47, 4, 1, ''),
(25, NULL, NULL, 2, NULL, 50, 4, 1, ''),
(26, NULL, NULL, 2, 56, 52, 2, 1, ''),
(27, NULL, NULL, 1, NULL, 57, 4, 1, ''),
(28, NULL, NULL, 1, NULL, 59, 4, 1, ''),
(29, NULL, NULL, 1, NULL, 61, 4, 1, ''),
(30, NULL, NULL, 1, NULL, 63, 4, 1, ''),
(31, NULL, NULL, 1, 67, 65, 2, 1, '59101758'),
(32, NULL, NULL, 1, NULL, 68, 3, 1, '1907787'),
(33, NULL, NULL, 1, 79, 70, 2, 1, '85309137'),
(34, NULL, NULL, 1, 82, 80, 2, 1, '19443642'),
(35, NULL, NULL, 1, 85, 84, 2, 1, '29213596'),
(36, NULL, NULL, 1, 88, 86, 2, 1, '71475408'),
(37, NULL, NULL, 1, 93, 89, 2, 1, '9611739'),
(38, NULL, NULL, 1, 91, 90, 2, 1, '15771402'),
(39, NULL, NULL, 1, 95, 94, 2, 1, '18460060'),
(40, NULL, NULL, 1, 97, 96, 2, 1, '26914273'),
(41, NULL, NULL, 2, 100, 98, 2, 1, '30898940');

-- --------------------------------------------------------

--
-- Table structure for table `propiedad`
--

CREATE TABLE `propiedad` (
  `codPropiedad` int(11) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `lado` tinyint(4) NOT NULL,
  `precioCompra` int(11) NOT NULL,
  `codEdicion` int(11) NOT NULL,
  `codColor` int(11) NOT NULL,
  `codTipoPropiedad` int(11) NOT NULL,
  `alquiler_normal` int(11) DEFAULT NULL,
  `alquiler_1casas` int(11) DEFAULT NULL,
  `alquiler_2casas` int(11) DEFAULT NULL,
  `alquiler_3casas` int(11) DEFAULT NULL,
  `alquiler_4casas` int(11) DEFAULT NULL,
  `alquiler_hotel` int(11) DEFAULT NULL,
  `valorHipotecable` int(11) DEFAULT NULL,
  `costo_casa` int(11) DEFAULT NULL,
  `costo_hotel` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `propiedad`
--

INSERT INTO `propiedad` (`codPropiedad`, `nombre`, `lado`, `precioCompra`, `codEdicion`, `codColor`, `codTipoPropiedad`, `alquiler_normal`, `alquiler_1casas`, `alquiler_2casas`, `alquiler_3casas`, `alquiler_4casas`, `alquiler_hotel`, `valorHipotecable`, `costo_casa`, `costo_hotel`) VALUES
(1, 'Avenida Manco Capac', 1, 80, 1, 6, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'Avenida Grau', 1, 60, 1, 6, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 'Avenida Bolognesi', 1, 100, 1, 5, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 'Avenida 28 de Julio', 1, 100, 1, 5, 1, 6, 30, 90, 270, 400, 550, 50, 50, 50),
(5, 'Avenida Abancay', 1, 120, 1, 5, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 'Avenida España', 2, 140, 1, 7, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(7, 'Avenida Arenales', 2, 140, 1, 7, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(8, 'Avenida Petit Thouars', 2, 160, 1, 7, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(9, 'Avenida Javier Prado', 2, 180, 1, 4, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(10, 'Avenida 2 de Mayo', 2, 180, 1, 4, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(11, 'Jirón Washington', 2, 200, 1, 4, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(12, 'Paseo de la república', 3, 220, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(13, 'Avenida Tacna', 3, 220, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(14, 'Avenida Brasil', 3, 240, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(15, 'Avenida Uruguay', 3, 260, 1, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(16, 'Avenida Arequipa', 3, 260, 1, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(17, 'Paseo Colon', 3, 280, 1, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(18, 'Avenida Alfonso Ugarte', 4, 300, 1, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(19, 'Avenida de la colmena', 4, 300, 1, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(20, 'Avenida Wilson', 4, 320, 1, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(21, 'Avenida Larco', 4, 350, 1, 8, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(22, 'Jirón de la unión', 4, 400, 1, 8, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(23, 'Ferrocarril de lima y callao', 1, 200, 1, 9, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(24, 'Ferrocarril del sur', 2, 200, 1, 9, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(25, 'Ferrocarril del centro', 3, 200, 1, 9, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(26, 'Ferrocarril del Norte', 4, 200, 1, 9, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(27, 'Compañia de Electricidad', 2, 150, 1, 10, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(28, 'Obras de agua potable', 3, 150, 1, 10, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `propiedad_partida`
--

CREATE TABLE `propiedad_partida` (
  `codPropiedadPartida` int(11) NOT NULL,
  `codJugadorDueño` int(11) NOT NULL,
  `codPropiedad` int(11) NOT NULL,
  `codPartida` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `propiedad_partida`
--

INSERT INTO `propiedad_partida` (`codPropiedadPartida`, `codJugadorDueño`, `codPropiedad`, `codPartida`) VALUES
(1, 43, 1, 23),
(2, 46, 2, 23),
(3, 46, 3, 23),
(4, 46, 4, 23),
(5, 43, 5, 23),
(6, 46, 6, 23),
(7, 46, 7, 23),
(8, 46, 8, 23),
(9, 46, 9, 23),
(10, 46, 10, 23),
(11, 46, 11, 23),
(12, 46, 12, 23),
(13, 46, 13, 23),
(14, 46, 14, 23),
(15, 43, 15, 23),
(16, 46, 16, 23),
(17, 46, 17, 23),
(18, 46, 18, 23),
(19, 46, 19, 23),
(20, 46, 20, 23),
(21, 46, 21, 23),
(22, 46, 22, 23),
(23, 46, 23, 23),
(24, 46, 24, 23),
(25, 46, 25, 23),
(26, 46, 26, 23),
(27, 46, 27, 23),
(28, 46, 28, 23),
(29, 56, 1, 26),
(30, 56, 2, 26),
(31, 56, 3, 26),
(32, 56, 4, 26),
(33, 56, 5, 26),
(34, 56, 6, 26),
(35, 56, 7, 26),
(36, 56, 8, 26),
(37, 56, 9, 26),
(38, 56, 10, 26),
(39, 56, 11, 26),
(40, 56, 12, 26),
(41, 56, 13, 26),
(42, 56, 14, 26),
(43, 56, 15, 26),
(44, 56, 16, 26),
(45, 56, 17, 26),
(46, 56, 18, 26),
(47, 56, 19, 26),
(48, 56, 20, 26),
(49, 56, 21, 26),
(50, 56, 22, 26),
(51, 56, 23, 26),
(52, 56, 24, 26),
(53, 56, 25, 26),
(54, 56, 26, 26),
(55, 56, 27, 26),
(56, 56, 28, 26),
(57, 67, 1, 31),
(58, 67, 2, 31),
(59, 67, 3, 31),
(60, 67, 4, 31),
(61, 67, 5, 31),
(62, 67, 6, 31),
(63, 67, 7, 31),
(64, 67, 8, 31),
(65, 67, 9, 31),
(66, 67, 10, 31),
(67, 67, 11, 31),
(68, 67, 12, 31),
(69, 67, 13, 31),
(70, 67, 14, 31),
(71, 67, 15, 31),
(72, 67, 16, 31),
(73, 67, 17, 31),
(74, 67, 18, 31),
(75, 67, 19, 31),
(76, 67, 20, 31),
(77, 67, 21, 31),
(78, 67, 22, 31),
(79, 67, 23, 31),
(80, 67, 24, 31),
(81, 67, 25, 31),
(82, 67, 26, 31),
(83, 65, 27, 31),
(84, 67, 28, 31),
(85, 79, 1, 33),
(86, 79, 2, 33),
(87, 79, 3, 33),
(88, 79, 4, 33),
(89, 79, 5, 33),
(90, 79, 6, 33),
(91, 79, 7, 33),
(92, 79, 8, 33),
(93, 79, 9, 33),
(94, 79, 10, 33),
(95, 79, 11, 33),
(96, 79, 12, 33),
(97, 79, 13, 33),
(98, 79, 14, 33),
(99, 79, 15, 33),
(100, 79, 16, 33),
(101, 79, 17, 33),
(102, 79, 18, 33),
(103, 79, 19, 33),
(104, 79, 20, 33),
(105, 79, 21, 33),
(106, 79, 22, 33),
(107, 79, 23, 33),
(108, 79, 24, 33),
(109, 79, 25, 33),
(110, 79, 26, 33),
(111, 79, 27, 33),
(112, 79, 28, 33),
(113, 80, 1, 34),
(114, 82, 2, 34),
(115, 80, 3, 34),
(116, 82, 4, 34),
(117, 80, 5, 34),
(118, 80, 6, 34),
(119, 81, 7, 34),
(120, 82, 8, 34),
(121, 82, 9, 34),
(122, 80, 10, 34),
(123, 82, 11, 34),
(124, 82, 12, 34),
(125, 80, 13, 34),
(126, 82, 14, 34),
(127, 82, 15, 34),
(128, 82, 16, 34),
(129, 82, 17, 34),
(130, 82, 18, 34),
(131, 80, 19, 34),
(132, 82, 20, 34),
(133, 80, 21, 34),
(134, 82, 22, 34),
(135, 82, 23, 34),
(136, 82, 24, 34),
(137, 82, 25, 34),
(138, 82, 26, 34),
(139, 82, 27, 34),
(140, 82, 28, 34),
(141, 85, 1, 35),
(142, 85, 2, 35),
(143, 85, 3, 35),
(144, 85, 4, 35),
(145, 85, 5, 35),
(146, 85, 6, 35),
(147, 85, 7, 35),
(148, 85, 8, 35),
(149, 85, 9, 35),
(150, 85, 10, 35),
(151, 85, 11, 35),
(152, 85, 12, 35),
(153, 85, 13, 35),
(154, 85, 14, 35),
(155, 85, 15, 35),
(156, 85, 16, 35),
(157, 85, 17, 35),
(158, 85, 18, 35),
(159, 85, 19, 35),
(160, 85, 20, 35),
(161, 85, 21, 35),
(162, 85, 22, 35),
(163, 85, 23, 35),
(164, 85, 24, 35),
(165, 85, 25, 35),
(166, 85, 26, 35),
(167, 85, 27, 35),
(168, 85, 28, 35),
(169, 88, 1, 36),
(170, 88, 2, 36),
(171, 88, 3, 36),
(172, 88, 4, 36),
(173, 88, 5, 36),
(174, 88, 6, 36),
(175, 88, 7, 36),
(176, 88, 8, 36),
(177, 88, 9, 36),
(178, 88, 10, 36),
(179, 88, 11, 36),
(180, 88, 12, 36),
(181, 88, 13, 36),
(182, 88, 14, 36),
(183, 88, 15, 36),
(184, 88, 16, 36),
(185, 88, 17, 36),
(186, 88, 18, 36),
(187, 88, 19, 36),
(188, 88, 20, 36),
(189, 88, 21, 36),
(190, 88, 22, 36),
(191, 88, 23, 36),
(192, 88, 24, 36),
(193, 88, 25, 36),
(194, 88, 26, 36),
(195, 88, 27, 36),
(196, 88, 28, 36),
(197, 90, 1, 38),
(198, 90, 2, 38),
(199, 91, 3, 38),
(200, 91, 4, 38),
(201, 91, 5, 38),
(202, 91, 6, 38),
(203, 91, 7, 38),
(204, 91, 8, 38),
(205, 91, 9, 38),
(206, 91, 10, 38),
(207, 91, 11, 38),
(208, 91, 12, 38),
(209, 91, 13, 38),
(210, 91, 14, 38),
(211, 91, 15, 38),
(212, 91, 16, 38),
(213, 91, 17, 38),
(214, 91, 18, 38),
(215, 91, 19, 38),
(216, 91, 20, 38),
(217, 91, 21, 38),
(218, 91, 22, 38),
(219, 91, 23, 38),
(220, 91, 24, 38),
(221, 91, 25, 38),
(222, 91, 26, 38),
(223, 91, 27, 38),
(224, 91, 28, 38),
(225, 93, 1, 37),
(226, 93, 2, 37),
(227, 93, 3, 37),
(228, 93, 4, 37),
(229, 93, 5, 37),
(230, 93, 6, 37),
(231, 93, 7, 37),
(232, 93, 8, 37),
(233, 93, 9, 37),
(234, 93, 10, 37),
(235, 93, 11, 37),
(236, 89, 12, 37),
(237, 93, 13, 37),
(238, 89, 14, 37),
(239, 93, 15, 37),
(240, 93, 16, 37),
(241, 93, 17, 37),
(242, 93, 18, 37),
(243, 93, 19, 37),
(244, 93, 20, 37),
(245, 93, 21, 37),
(246, 93, 22, 37),
(247, 93, 23, 37),
(248, 93, 24, 37),
(249, 93, 25, 37),
(250, 93, 26, 37),
(251, 93, 27, 37),
(252, 93, 28, 37),
(253, 95, 1, 39),
(254, 94, 2, 39),
(255, 94, 3, 39),
(256, 95, 4, 39),
(257, 95, 5, 39),
(258, 95, 6, 39),
(259, 95, 7, 39),
(260, 95, 8, 39),
(261, 95, 9, 39),
(262, 95, 10, 39),
(263, 95, 11, 39),
(264, 95, 12, 39),
(265, 95, 13, 39),
(266, 95, 14, 39),
(267, 95, 15, 39),
(268, 95, 16, 39),
(269, 95, 17, 39),
(270, 95, 18, 39),
(271, 95, 19, 39),
(272, 95, 20, 39),
(273, 95, 21, 39),
(274, 95, 22, 39),
(275, 95, 23, 39),
(276, 95, 24, 39),
(277, 95, 25, 39),
(278, 95, 26, 39),
(279, 95, 27, 39),
(280, 95, 28, 39),
(281, 97, 1, 40),
(282, 97, 2, 40),
(283, 97, 3, 40),
(284, 96, 4, 40),
(285, 97, 5, 40),
(286, 97, 6, 40),
(287, 97, 7, 40),
(288, 97, 8, 40),
(289, 97, 9, 40),
(290, 97, 10, 40),
(291, 97, 11, 40),
(292, 97, 12, 40),
(293, 97, 13, 40),
(294, 97, 14, 40),
(295, 97, 15, 40),
(296, 97, 16, 40),
(297, 97, 17, 40),
(298, 96, 18, 40),
(299, 97, 19, 40),
(300, 97, 20, 40),
(301, 97, 21, 40),
(302, 97, 22, 40),
(303, 97, 23, 40),
(304, 97, 24, 40),
(305, 97, 25, 40),
(306, 97, 26, 40),
(307, 97, 27, 40),
(308, 97, 28, 40),
(309, 99, 1, 41),
(310, 100, 2, 41),
(311, 98, 3, 41),
(312, 99, 4, 41),
(313, 100, 5, 41),
(314, 98, 6, 41),
(315, 99, 7, 41),
(316, 99, 8, 41),
(317, 100, 9, 41),
(318, 99, 10, 41),
(319, 100, 11, 41),
(320, 98, 12, 41),
(321, 99, 13, 41),
(322, 100, 14, 41),
(323, 100, 15, 41),
(324, 100, 16, 41),
(325, 100, 17, 41),
(326, 100, 18, 41),
(327, 100, 19, 41),
(328, 100, 20, 41),
(329, 100, 21, 41),
(330, 100, 22, 41),
(331, 100, 23, 41),
(332, 100, 24, 41),
(333, 100, 25, 41),
(334, 100, 26, 41),
(335, 100, 27, 41),
(336, 100, 28, 41);

-- --------------------------------------------------------

--
-- Table structure for table `tipo_cuenta`
--

CREATE TABLE `tipo_cuenta` (
  `codTipoCuenta` int(11) NOT NULL,
  `nombre` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tipo_cuenta`
--

INSERT INTO `tipo_cuenta` (`codTipoCuenta`, `nombre`) VALUES
(1, 'Estandar'),
(2, 'Premium'),
(3, 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `tipo_propiedad`
--

CREATE TABLE `tipo_propiedad` (
  `codTipoPropiedad` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `claseIcono` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tipo_propiedad`
--

INSERT INTO `tipo_propiedad` (`codTipoPropiedad`, `nombre`, `claseIcono`) VALUES
(1, 'Normal', 'fas fa-home'),
(2, 'Tren', 'fas fa-train'),
(3, 'Servicio', 'fas fa-wrench');

-- --------------------------------------------------------

--
-- Table structure for table `tipo_transaccion_monetaria`
--

CREATE TABLE `tipo_transaccion_monetaria` (
  `codTipoTransaccion` int(11) NOT NULL,
  `conceptoEmisor` varchar(500) NOT NULL,
  `conceptoReceptor` varchar(500) NOT NULL,
  `esDelBanco` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tipo_transaccion_monetaria`
--

INSERT INTO `tipo_transaccion_monetaria` (`codTipoTransaccion`, `conceptoEmisor`, `conceptoReceptor`, `esDelBanco`) VALUES
(1, 'Compra Propiedad', 'Venta Propiedad', 0),
(2, 'Pago Impuestos', 'Cobro Impuestos', 0),
(3, 'Pago Salida', 'Cobro Salida', 1),
(4, 'Pago Renta', 'Cobro Renta', 0),
(5, 'Pago Casualidad', 'Cobro Casualidad', 0),
(6, 'Dádiva Inicial', 'Cobro Inicial', 1);

-- --------------------------------------------------------

--
-- Table structure for table `transaccion_monetaria`
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
-- Dumping data for table `transaccion_monetaria`
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
(26, 34, 20, 35, 1, '2021-09-12 02:00:17', 5289),
(27, 39, 21, 37, 2, '2021-09-13 18:41:35', 5000),
(28, 39, 21, 38, 2, '2021-09-13 18:41:35', 5000),
(29, 39, 21, 39, 2, '2021-09-13 18:41:35', 5000),
(30, 37, 21, 39, 1, '2021-09-13 19:02:52', 550),
(31, 38, 21, 37, 4, '2021-09-13 19:07:53', 51),
(32, 37, 21, 38, 4, '2021-09-13 19:09:46', 220),
(33, 42, 22, 40, 2, '2021-09-14 02:16:36', 5000),
(34, 42, 22, 41, 2, '2021-09-14 02:16:36', 5000),
(35, 42, 22, 42, 2, '2021-09-14 02:16:36', 5000),
(39, 46, 23, 43, 2, '2021-09-14 02:18:25', 5000),
(40, 46, 23, 44, 2, '2021-09-14 02:18:25', 5000),
(41, 46, 23, 46, 2, '2021-09-14 02:18:25', 5000),
(42, 56, 26, 52, 2, '2021-09-14 04:17:00', 5000),
(43, 56, 26, 55, 2, '2021-09-14 04:17:00', 5000),
(44, 56, 26, 56, 2, '2021-09-14 04:17:00', 5000),
(45, 67, 31, 65, 2, '2021-09-15 21:47:34', 5000),
(46, 67, 31, 66, 2, '2021-09-15 21:47:34', 5000),
(47, 67, 31, 67, 2, '2021-09-15 21:47:34', 5000),
(48, 66, 31, 65, 2, '2021-09-15 22:15:32', 51),
(49, 65, 31, 66, 1, '2021-09-15 22:19:56', 52),
(50, 66, 31, 65, 4, '2021-09-15 22:20:12', 52),
(51, 65, 31, 66, 4, '2021-09-16 02:18:56', 100),
(52, 79, 33, 70, 2, '2021-09-17 20:36:12', 5000),
(53, 79, 33, 78, 2, '2021-09-17 20:36:12', 5000),
(54, 79, 33, 79, 2, '2021-09-17 20:36:12', 5000),
(55, 70, 33, 78, 1, '2021-09-17 22:23:23', 52),
(56, 70, 33, 79, 4, '2021-09-17 22:23:40', 215),
(57, 79, 33, 0, 0, '2021-09-17 22:37:56', 0),
(58, 82, 34, 80, 6, '2021-09-18 01:36:01', 5000),
(59, 82, 34, 81, 6, '2021-09-18 01:36:02', 5000),
(60, 82, 34, 82, 6, '2021-09-18 01:36:02', 5000),
(61, 80, 34, 81, 1, '2021-09-18 02:06:19', 5),
(62, 80, 34, 82, 2, '2021-09-18 02:17:53', 2550),
(63, 80, 34, 82, 1, '2021-09-18 02:19:56', 50),
(64, 82, 34, 80, 3, '2021-09-18 02:20:12', 550),
(65, 85, 35, 83, 6, '2021-09-18 14:03:18', 5000),
(66, 85, 35, 84, 6, '2021-09-18 14:03:18', 5000),
(67, 85, 35, 85, 6, '2021-09-18 14:03:18', 5000),
(68, 88, 36, 86, 6, '2021-09-18 17:57:01', 5000),
(69, 88, 36, 87, 6, '2021-09-18 17:57:01', 5000),
(70, 88, 36, 88, 6, '2021-09-18 17:57:01', 5000),
(71, 91, 38, 90, 6, '2021-09-18 19:20:50', 5000),
(72, 91, 38, 91, 6, '2021-09-18 19:20:50', 5000),
(73, 93, 37, 89, 6, '2021-09-18 20:00:29', 5000),
(74, 93, 37, 92, 6, '2021-09-18 20:00:29', 5000),
(75, 93, 37, 93, 6, '2021-09-18 20:00:29', 5000),
(76, 95, 39, 94, 6, '2021-09-18 20:28:35', 5000),
(77, 95, 39, 95, 6, '2021-09-18 20:28:35', 5000),
(78, 97, 40, 96, 6, '2021-09-19 00:10:16', 5000),
(79, 97, 40, 97, 6, '2021-09-19 00:10:16', 5000),
(80, 96, 40, 97, 2, '2021-09-19 01:10:33', 52),
(81, 96, 40, 97, 1, '2021-09-19 01:13:20', 5),
(82, 97, 40, 96, 3, '2021-09-19 01:22:16', 520),
(83, 97, 40, 96, 3, '2021-09-19 01:22:22', 520),
(84, 97, 40, 96, 3, '2021-09-19 01:27:08', 220),
(85, 96, 40, 97, 2, '2021-09-19 01:27:21', 52),
(86, 97, 40, 96, 6, '2021-09-19 01:31:03', 55),
(87, 100, 41, 98, 6, '2021-09-19 01:37:32', 5000),
(88, 100, 41, 99, 6, '2021-09-19 01:37:32', 5000),
(89, 100, 41, 98, 3, '2021-09-19 01:38:54', 550),
(90, 100, 41, 98, 6, '2021-09-19 01:39:05', 522),
(91, 99, 41, 98, 2, '2021-09-19 01:39:13', 210);

-- --------------------------------------------------------

--
-- Table structure for table `transaccion_propiedad`
--

CREATE TABLE `transaccion_propiedad` (
  `codTransaccionPropiedad` int(11) NOT NULL,
  `fechaHora` datetime NOT NULL,
  `codPropiedadPartida` int(11) NOT NULL,
  `codJugadorEmisor` int(11) NOT NULL,
  `codJugadorReceptor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `color`
--
ALTER TABLE `color`
  ADD PRIMARY KEY (`codColor`);

--
-- Indexes for table `cuenta`
--
ALTER TABLE `cuenta`
  ADD PRIMARY KEY (`codCuenta`);

--
-- Indexes for table `edicion`
--
ALTER TABLE `edicion`
  ADD PRIMARY KEY (`codEdicion`);

--
-- Indexes for table `estado_partida`
--
ALTER TABLE `estado_partida`
  ADD PRIMARY KEY (`codEstadoPartida`);

--
-- Indexes for table `jugador`
--
ALTER TABLE `jugador`
  ADD PRIMARY KEY (`codJugador`);

--
-- Indexes for table `link`
--
ALTER TABLE `link`
  ADD PRIMARY KEY (`codLink`);

--
-- Indexes for table `partida`
--
ALTER TABLE `partida`
  ADD PRIMARY KEY (`codPartida`);

--
-- Indexes for table `propiedad`
--
ALTER TABLE `propiedad`
  ADD PRIMARY KEY (`codPropiedad`);

--
-- Indexes for table `propiedad_partida`
--
ALTER TABLE `propiedad_partida`
  ADD PRIMARY KEY (`codPropiedadPartida`);

--
-- Indexes for table `tipo_cuenta`
--
ALTER TABLE `tipo_cuenta`
  ADD PRIMARY KEY (`codTipoCuenta`);

--
-- Indexes for table `tipo_propiedad`
--
ALTER TABLE `tipo_propiedad`
  ADD PRIMARY KEY (`codTipoPropiedad`);

--
-- Indexes for table `tipo_transaccion_monetaria`
--
ALTER TABLE `tipo_transaccion_monetaria`
  ADD PRIMARY KEY (`codTipoTransaccion`);

--
-- Indexes for table `transaccion_monetaria`
--
ALTER TABLE `transaccion_monetaria`
  ADD PRIMARY KEY (`codTransaccionMonetaria`);

--
-- Indexes for table `transaccion_propiedad`
--
ALTER TABLE `transaccion_propiedad`
  ADD PRIMARY KEY (`codTransaccionPropiedad`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `color`
--
ALTER TABLE `color`
  MODIFY `codColor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `cuenta`
--
ALTER TABLE `cuenta`
  MODIFY `codCuenta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `edicion`
--
ALTER TABLE `edicion`
  MODIFY `codEdicion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `estado_partida`
--
ALTER TABLE `estado_partida`
  MODIFY `codEstadoPartida` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `jugador`
--
ALTER TABLE `jugador`
  MODIFY `codJugador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `link`
--
ALTER TABLE `link`
  MODIFY `codLink` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `partida`
--
ALTER TABLE `partida`
  MODIFY `codPartida` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `propiedad`
--
ALTER TABLE `propiedad`
  MODIFY `codPropiedad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `propiedad_partida`
--
ALTER TABLE `propiedad_partida`
  MODIFY `codPropiedadPartida` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=337;

--
-- AUTO_INCREMENT for table `tipo_cuenta`
--
ALTER TABLE `tipo_cuenta`
  MODIFY `codTipoCuenta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tipo_propiedad`
--
ALTER TABLE `tipo_propiedad`
  MODIFY `codTipoPropiedad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tipo_transaccion_monetaria`
--
ALTER TABLE `tipo_transaccion_monetaria`
  MODIFY `codTipoTransaccion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `transaccion_monetaria`
--
ALTER TABLE `transaccion_monetaria`
  MODIFY `codTransaccionMonetaria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT for table `transaccion_propiedad`
--
ALTER TABLE `transaccion_propiedad`
  MODIFY `codTransaccionPropiedad` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
