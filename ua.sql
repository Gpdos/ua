-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-05-2024 a las 11:19:36
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
-- Base de datos: `ua`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentario`
--

CREATE TABLE `comentario` (
  `id` int(11) NOT NULL,
  `titulo` varchar(200) NOT NULL,
  `texto` varchar(200) NOT NULL,
  `autor` int(11) NOT NULL,
  `valoracion` int(11) NOT NULL,
  `publicacion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `comentario`
--

INSERT INTO `comentario` (`id`, `titulo`, `texto`, `autor`, `valoracion`, `publicacion`) VALUES
(1, '', 'no veas que difisi', 1, 0, 1),
(2, '', 'no veas que difisi', 1, 0, 1),
(3, '', 'no veas que difisi', 1, 0, 1),
(4, '', 'algo malo va a pasar', 0, 0, 1),
(5, '', 'ahora si que si', 3, 0, 1),
(6, '', 'sin identificar', 0, 1, 1),
(7, '', 'sin identificar', 0, 1, 1),
(8, '', 'Prueba usabilidad', 0, 5, 1),
(9, '', 'Prueba 2', 1, 1, 1),
(10, '', 'prueba 3', 1, 4, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estudio`
--

CREATE TABLE `estudio` (
  `idEstudio` int(11) NOT NULL,
  `Nombre` varchar(20) NOT NULL,
  `Universidad` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `estudio`
--

INSERT INTO `estudio` (`idEstudio`, `Nombre`, `Universidad`) VALUES
(1, 'Ingenieria Multimedi', 'UA'),
(2, 'Matematicas', 'UMU'),
(3, 'Derecho y RI', 'UA'),
(4, 'Arquitectura', 'UAL'),
(5, 'Gastronomia', 'UAL'),
(6, 'Diseño', 'UMU');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `foto`
--

CREATE TABLE `foto` (
  `idFoto` int(11) NOT NULL,
  `archivo` varchar(2000) NOT NULL,
  `idPubli` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `foto`
--

INSERT INTO `foto` (`idFoto`, `archivo`, `idPubli`) VALUES
(1, 'https://cdn.businessinsider.es/sites/navi.axelspringer.es/public/media/image/2019/12/2019-had-its-share-delightfully-strange-moments.jpg?tf=3840x', 1),
(2, 'https://picsum.photos/600/400?random=2', 1),
(3, 'https://cdn.pixabay.com/photo/2024/02/26/19/39/monochrome-image-8598798_640.jpg', 2),
(4, 'https://picsum.photos/600/400?random=4', 3),
(5, 'https://picsum.photos/600/400?random=5', 3),
(6, 'https://picsum.photos/600/400?random=6', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `publicacion`
--

CREATE TABLE `publicacion` (
  `idPublicacion` int(11) NOT NULL,
  `Nombre` varchar(20) NOT NULL,
  `carrera` int(11) NOT NULL,
  `tipo` int(11) NOT NULL,
  `valoracion` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `autor` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `publicacion`
--

INSERT INTO `publicacion` (`idPublicacion`, `Nombre`, `carrera`, `tipo`, `valoracion`, `fecha`, `autor`) VALUES
(1, 'Memoria Arquitectura', 3, 1, 4, '0000-00-00', 'Javier'),
(2, 'TFG Economico', 2, 1, 2, '0000-00-00', 'Francisco'),
(3, 'Samuelada', 3, 3, 3, '0000-00-00', 'Perez Galdos'),
(4, 'Samuelada', 3, 3, 3, '0000-00-00', 'Perez Galdos'),
(5, 'Prueba', 1, 1, 2, '2024-05-29', 'Javier');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipotrabajo`
--

CREATE TABLE `tipotrabajo` (
  `idTipo` int(11) NOT NULL,
  `Nombre` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipotrabajo`
--

INSERT INTO `tipotrabajo` (`idTipo`, `Nombre`) VALUES
(1, 'TFG'),
(2, 'TFM'),
(3, 'ABP'),
(4, 'Presentacion'),
(5, 'Modelado 3D'),
(6, 'Memoria');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trabajo`
--

CREATE TABLE `trabajo` (
  `id` int(11) NOT NULL,
  `idPubli` int(11) NOT NULL,
  `contenido` varchar(2000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `Id` int(11) NOT NULL,
  `Usuario` varchar(20) NOT NULL,
  `Contraseña` varchar(20) NOT NULL,
  `Correo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`Id`, `Usuario`, `Contraseña`, `Correo`) VALUES
(1, 'Javier', '1234', 'jem5@alu.ua.es'),
(2, 'Yus', '1234', 'yeji@alu.ua.es'),
(3, 'Dani', '1234', 'dfef@alu.ua.es'),
(4, 'Samuel', '1234', 'srfr@alu.ua.es'),
(5, 'Manuel', '1234', 'mala14@alu.ua.es'),
(6, 'Miguel', '1234', 'mapj@alu.ua.es');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `comentario`
--
ALTER TABLE `comentario`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `estudio`
--
ALTER TABLE `estudio`
  ADD PRIMARY KEY (`idEstudio`);

--
-- Indices de la tabla `foto`
--
ALTER TABLE `foto`
  ADD PRIMARY KEY (`idFoto`);

--
-- Indices de la tabla `publicacion`
--
ALTER TABLE `publicacion`
  ADD PRIMARY KEY (`idPublicacion`);

--
-- Indices de la tabla `tipotrabajo`
--
ALTER TABLE `tipotrabajo`
  ADD PRIMARY KEY (`idTipo`);

--
-- Indices de la tabla `trabajo`
--
ALTER TABLE `trabajo`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `comentario`
--
ALTER TABLE `comentario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `estudio`
--
ALTER TABLE `estudio`
  MODIFY `idEstudio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `foto`
--
ALTER TABLE `foto`
  MODIFY `idFoto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `publicacion`
--
ALTER TABLE `publicacion`
  MODIFY `idPublicacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `tipotrabajo`
--
ALTER TABLE `tipotrabajo`
  MODIFY `idTipo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `trabajo`
--
ALTER TABLE `trabajo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
