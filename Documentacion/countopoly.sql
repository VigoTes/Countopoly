-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 20, 2021 at 03:12 AM
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
  `nombre` varchar(200) NOT NULL,
  `alquiler2trenes` int(11) NOT NULL,
  `alquiler3trenes` int(11) NOT NULL,
  `alquiler4trenes` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `edicion`
--

INSERT INTO `edicion` (`codEdicion`, `nombre`, `alquiler2trenes`, `alquiler3trenes`, `alquiler4trenes`) VALUES
(1, 'Peruana', 50, 100, 200),
(2, 'Clásica', 0, 0, 0);

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
  `esBanco` tinyint(11) NOT NULL,
  `tiempoActualizacion` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jugador`
--

INSERT INTO `jugador` (`codJugador`, `codPartida`, `montoActual`, `codCuenta`, `esBanco`, `tiempoActualizacion`) VALUES
(108, 46, 4489, 1, 0, 2.26),
(109, 46, 100000510, 0, 1, 0),
(110, 47, 5410, 1, 0, 3.85),
(111, 47, 4739, 2, 0, 4.38),
(112, 47, 99999850, 0, 1, 0),
(113, 48, 5001, 1, 0, 2.16),
(114, 48, 99999998, 0, 1, 0);

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
(46, NULL, NULL, 1, 109, 108, 2, 1, '61458234'),
(47, NULL, NULL, 1, 112, 111, 2, 1, '56577338'),
(48, NULL, NULL, 1, 114, 113, 2, 1, '29816234');

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
(2, 'Avenida Grau', 1, 60, 1, 6, 1, 2, 10, 30, 90, 160, 250, 30, 50, 50),
(3, 'Avenida Bolognesi', 1, 100, 1, 5, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 'Avenida 28 de Julio', 1, 100, 1, 5, 1, 6, 30, 90, 270, 400, 550, 50, 50, 50),
(5, 'Avenida Abancay', 1, 120, 1, 5, 1, 6, 30, 90, 270, 400, 550, 6, 50, 50),
(6, 'Avenida España', 2, 140, 1, 7, 1, 10, 50, 150, 450, 625, 750, 70, 100, 100),
(7, 'Avenida Arenales', 2, 140, 1, 7, 1, 10, 50, 150, 450, 625, 750, 70, 100, 100),
(8, 'Avenida Petit Thouars', 2, 160, 1, 7, 1, 12, 60, 180, 500, 700, 900, 80, 100, 100),
(9, 'Avenida Javier Prado', 2, 180, 1, 4, 1, 14, 70, 200, 550, 750, 950, 90, 100, 100),
(10, 'Avenida 2 de Mayo', 2, 180, 1, 4, 1, 14, 70, 200, 550, 750, 950, 90, 100, 100),
(11, 'Jirón Washington', 2, 200, 1, 4, 1, 16, 80, 220, 600, 800, 1000, 100, 100, 100),
(12, 'Paseo de la república', 3, 220, 1, 1, 1, 20, 100, 300, 750, 925, 1100, 120, 150, 150),
(13, 'Avenida Tacna', 3, 220, 1, 1, 1, 18, 90, 250, 700, 875, 1050, 110, 150, 150),
(14, 'Avenida Brasil', 3, 240, 1, 1, 1, 18, 90, 250, 700, 875, 1050, 110, 150, 150),
(15, 'Avenida Uruguay', 3, 260, 1, 3, 1, 22, 110, 330, 800, 975, 1150, 130, 150, 150),
(16, 'Avenida Arequipa', 3, 260, 1, 3, 1, 22, 110, 330, 800, 975, 1150, 130, 150, 150),
(17, 'Paseo Colon', 3, 280, 1, 3, 1, 24, 120, 360, 850, 1025, 1200, 140, 150, 150),
(18, 'Avenida Alfonso Ugarte', 4, 300, 1, 2, 1, 26, 130, 390, 900, 1100, 1275, 150, 200, 200),
(19, 'Avenida de la colmena', 4, 300, 1, 2, 1, 26, 130, 390, 900, 1100, 1275, 150, 200, 200),
(20, 'Avenida Wilson', 4, 320, 1, 2, 1, 28, 150, 450, 1000, 1200, 1400, 160, 200, 200),
(21, 'Avenida Larco', 4, 350, 1, 8, 1, 50, 200, 600, 1400, 1700, 2000, 200, 200, 200),
(22, 'Jirón de la unión', 4, 400, 1, 8, 1, 35, 175, 500, 1100, 1300, 1500, 175, 200, 200),
(23, 'Ferrocarril de lima y callao', 1, 200, 1, 9, 2, 1, 1, 1, 1, 1, 1, 100, 1, 1),
(24, 'Ferrocarril del sur', 2, 200, 1, 9, 2, 1, 1, 1, 1, 1, 1, 100, 1, 1),
(25, 'Ferrocarril del centro', 3, 200, 1, 9, 2, 1, 1, 1, 1, 1, 1, 100, 1, 1),
(26, 'Ferrocarril del Norte', 4, 200, 1, 9, 2, 1, 1, 1, 1, 1, 1, 100, 1, 1),
(27, 'Compañia de Electricidad', 2, 150, 1, 10, 3, 1, 1, 1, 1, 1, 1, 75, 1, 1),
(28, 'Obras de agua potable', 3, 150, 1, 10, 3, 1, 1, 1, 1, 1, 1, 75, 1, 1);

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
(421, 109, 1, 46),
(422, 109, 2, 46),
(423, 108, 3, 46),
(424, 109, 4, 46),
(425, 109, 5, 46),
(426, 109, 6, 46),
(427, 108, 7, 46),
(428, 108, 8, 46),
(429, 109, 9, 46),
(430, 108, 10, 46),
(431, 109, 11, 46),
(432, 109, 12, 46),
(433, 109, 13, 46),
(434, 109, 14, 46),
(435, 109, 15, 46),
(436, 109, 16, 46),
(437, 109, 17, 46),
(438, 109, 18, 46),
(439, 109, 19, 46),
(440, 109, 20, 46),
(441, 109, 21, 46),
(442, 109, 22, 46),
(443, 108, 23, 46),
(444, 109, 24, 46),
(445, 109, 25, 46),
(446, 109, 26, 46),
(447, 109, 27, 46),
(448, 109, 28, 46),
(449, 110, 1, 47),
(450, 111, 2, 47),
(451, 112, 3, 47),
(452, 112, 4, 47),
(453, 112, 5, 47),
(454, 112, 6, 47),
(455, 112, 7, 47),
(456, 112, 8, 47),
(457, 112, 9, 47),
(458, 112, 10, 47),
(459, 112, 11, 47),
(460, 112, 12, 47),
(461, 112, 13, 47),
(462, 110, 14, 47),
(463, 112, 15, 47),
(464, 112, 16, 47),
(465, 112, 17, 47),
(466, 111, 18, 47),
(467, 112, 19, 47),
(468, 112, 20, 47),
(469, 112, 21, 47),
(470, 112, 22, 47),
(471, 112, 23, 47),
(472, 112, 24, 47),
(473, 112, 25, 47),
(474, 112, 26, 47),
(475, 112, 27, 47),
(476, 112, 28, 47),
(477, 114, 1, 48),
(478, 114, 2, 48),
(479, 113, 3, 48),
(480, 114, 4, 48),
(481, 114, 5, 48),
(482, 114, 6, 48),
(483, 114, 7, 48),
(484, 114, 8, 48),
(485, 114, 9, 48),
(486, 114, 10, 48),
(487, 113, 11, 48),
(488, 114, 12, 48),
(489, 114, 13, 48),
(490, 114, 14, 48),
(491, 114, 15, 48),
(492, 114, 16, 48),
(493, 114, 17, 48),
(494, 114, 18, 48),
(495, 114, 19, 48),
(496, 114, 20, 48),
(497, 114, 21, 48),
(498, 114, 22, 48),
(499, 114, 23, 48),
(500, 114, 24, 48),
(501, 114, 25, 48),
(502, 114, 26, 48),
(503, 114, 27, 48),
(504, 114, 28, 48);

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
(97, 109, 46, 108, 6, '2021-09-19 18:06:43', 5000),
(98, 108, 46, 109, 2, '2021-09-19 18:11:50', 511),
(99, 112, 47, 110, 6, '2021-09-19 18:23:15', 5000),
(100, 112, 47, 111, 6, '2021-09-19 18:23:15', 5000),
(101, 112, 47, 110, 3, '2021-09-19 18:24:10', 200),
(102, 111, 47, 110, 2, '2021-09-19 18:28:26', 210),
(103, 111, 47, 112, 5, '2021-09-19 18:28:44', 51),
(104, 114, 48, 113, 6, '2021-09-19 19:17:48', 5000),
(105, 113, 48, 114, 2, '2021-09-19 19:18:21', 50),
(106, 114, 48, 113, 3, '2021-09-19 19:18:35', 51);

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
  MODIFY `codJugador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;

--
-- AUTO_INCREMENT for table `link`
--
ALTER TABLE `link`
  MODIFY `codLink` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `partida`
--
ALTER TABLE `partida`
  MODIFY `codPartida` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `propiedad`
--
ALTER TABLE `propiedad`
  MODIFY `codPropiedad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `propiedad_partida`
--
ALTER TABLE `propiedad_partida`
  MODIFY `codPropiedadPartida` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=505;

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
  MODIFY `codTransaccionMonetaria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT for table `transaccion_propiedad`
--
ALTER TABLE `transaccion_propiedad`
  MODIFY `codTransaccionPropiedad` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
