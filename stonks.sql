-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-12-2022 a las 07:28:58
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `stonks`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `biblioteca`
--

CREATE TABLE `biblioteca` (
  `id` smallint(4) NOT NULL,
  `idJuego` smallint(4) NOT NULL,
  `idUsuario` smallint(4) NOT NULL,
  `horasJuego` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `biblioteca`
--

INSERT INTO `biblioteca` (`id`, `idJuego`, `idUsuario`, `horasJuego`) VALUES
(1, 7, 4, NULL),
(2, 6, 4, NULL),
(3, 5, 4, NULL),
(4, 5, 8, NULL),
(5, 8, 8, NULL),
(6, 8, 8, NULL),
(7, 7, 5, NULL),
(8, 5, 5, NULL),
(9, 7, 11, NULL),
(10, 11, 11, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `genero`
--

CREATE TABLE `genero` (
  `id` smallint(4) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `descripcion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `genero`
--

INSERT INTO `genero` (`id`, `nombre`, `descripcion`) VALUES
(1, 'FPS', 'El término fps o first-person shooter significa disparos en primera persona y se considera un género dentro de los videojuegos. A su vez también es una especie de subgénero dentro de los juegos dedicados a los disparos.'),
(2, 'hack & slash', 'El término hack & slash se traduciría por \"cortar y rajar\" siendo la base principal en la que se configura el género. Es decir, en este tipo de videojuegos vamos a tener combates cuerpo a cuerpo, generalmente en 3D, con armas de filo acabando con todos los enemigos que se crucen con nosotros.'),
(3, 'Aventura', 'se caracteriza por la exploración, la investigación, la resolución de puzzles, la interacción con personajes y el avance manera lineal, centrado en la trama del juego.'),
(4, 'RPG', 'se caracteriza por el desarrollo estadístico de las habilidades y características de un personaje a través de la experiencia que obtenemos completando las misiones propuestas a través del juego.'),
(5, 'rogue like', 'Roguelike quiere decir, literalmente, \"que se parece a Rogue\". Rogue es un juego de 1980 (aunque curiosa y técnicamente no fue el primer roguelike) creado por Michael Toy, Glenn Wichman y Ken Arnold, en la que tu personaje es un aventurero típico de juego de rol, situado en el nivel superior de una gran mazmorra que se extiende hacia abajo, llena de enemigos y tesoros. El objetivo del mismo es llegar hasta el final, recuperando el Amuleto de Yendor, y de nuevo volver a salir al exterior rehaciendo todo el camino.'),
(6, 'mundo abierto', 'Un videojuego de mundo abierto es aquel que ofrece al jugador la posibilidad de moverse libremente por un mundo virtual y alterar cualquier elemento a su voluntad.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `juegos`
--

CREATE TABLE `juegos` (
  `id` smallint(4) NOT NULL,
  `nombre` text NOT NULL,
  `idGenero` smallint(4) NOT NULL,
  `idDesarrolador` smallint(4) NOT NULL,
  `descripcion` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `juegos`
--

INSERT INTO `juegos` (`id`, `nombre`, `idGenero`, `idDesarrolador`, `descripcion`) VALUES
(5, 'ninja gaiden', 2, 5, 'jueguito donde un ninja SUPREMO masacra todo '),
(6, 'hades', 5, 5, 'ES un juegazo ni se imaginan, juéguenlo ya!'),
(7, 'warframe', 4, 5, 'por favor sáquenme de este juego'),
(8, 'Call of Duty', 1, 6, 'Call of Duty es una serie de videojuegos de d'),
(9, 'si', 6, 6, 'el juego'),
(10, 'ninja gaiden 2', 2, 10, 'El ninja la secuela'),
(11, 'Ninja gaiden 3', 2, 11, 'El retorno del ninja');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` smallint(4) NOT NULL,
  `userName` varchar(16) NOT NULL,
  `nombre` varchar(40) NOT NULL,
  `apellidos` varchar(40) NOT NULL,
  `correo` varchar(40) NOT NULL,
  `contrasena` varchar(16) NOT NULL,
  `rol` enum('admin','desarollador','agente') NOT NULL DEFAULT 'agente',
  `cartera` double NOT NULL DEFAULT 0,
  `fechaCreacion` datetime NOT NULL DEFAULT current_timestamp(),
  `fechaActualizacion` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `userName`, `nombre`, `apellidos`, `correo`, `contrasena`, `rol`, `cartera`, `fechaCreacion`, `fechaActualizacion`) VALUES
(3, 'elAgente', 'ignacio', 'ruiz', 'omar.ignacio.uri@isw.edu', '1423', 'agente', 0, '2022-12-05 12:13:18', '2022-12-05 12:14:38'),
(4, 'capo', 'pablo', 'escobar', 'omar.ignacio.uri@gmail.com', '1423', 'admin', 0, '2022-12-06 20:28:33', '2022-12-08 21:58:27'),
(5, 'xXpussyDestroyer', 'pepe', 'juan', 'pepehuan@gmail.com', '1234', 'desarollador', 0, '2022-12-06 22:05:48', '2022-12-08 21:56:12'),
(6, 'Sijajajsxd', 'Jesus', 'Cañedo', 'JesusCanedo@gmail.com', '1234', 'admin', 0, '2022-12-08 16:50:55', '2022-12-08 16:51:16'),
(7, 'LaCucha', 'roberta', 'roberto', 'robertoa@gmail.com', '1234', 'agente', 0, '2022-12-08 18:54:56', '2022-12-08 18:54:56'),
(8, 'paquita', 'Omar Ignacio', 'roberta', 'robertao@gmail.com', '1423', 'agente', 0, '2022-12-08 18:56:33', '2022-12-08 19:34:06'),
(9, '', '', 'dobabes', 'kr@gmail.com', 'asdfg', 'agente', 0, '2022-12-08 19:15:28', '2022-12-08 19:18:20'),
(10, 'paquita la dle b', 'juan', 'juan', 'juan@juan', 'juan', 'desarollador', 0, '2022-12-08 22:03:48', '2022-12-08 22:03:48'),
(11, 'bigotitos', 'alfonzo', 'no', 'email@gmail.com', '1234', 'desarollador', 0, '2022-12-08 22:27:47', '2022-12-08 22:42:08');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta`
--

CREATE TABLE `venta` (
  `id` smallint(4) NOT NULL,
  `idJuego` smallint(4) NOT NULL,
  `idUsuario` smallint(4) NOT NULL,
  `precio` double DEFAULT 100,
  `fechaCompra` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `venta`
--

INSERT INTO `venta` (`id`, `idJuego`, `idUsuario`, `precio`, `fechaCompra`) VALUES
(1, 6, 5, 100, '2022-12-07 23:37:42'),
(2, 7, 4, 100, '2022-12-08 15:48:24'),
(3, 7, 4, 100, '2022-12-08 15:50:55'),
(4, 6, 4, 100, '2022-12-08 15:51:31'),
(5, 5, 4, 100, '2022-12-08 15:51:35'),
(6, 5, 8, 100, '2022-12-08 21:33:55'),
(7, 8, 8, 100, '2022-12-08 21:43:35'),
(8, 8, 8, 100, '2022-12-08 21:44:33'),
(9, 7, 5, 100, '2022-12-08 21:53:02'),
(10, 5, 5, 100, '2022-12-08 21:55:24'),
(11, 7, 11, 100, '2022-12-08 23:08:34'),
(12, 11, 11, 100, '2022-12-08 23:21:58');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `biblioteca`
--
ALTER TABLE `biblioteca`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idJuego` (`idJuego`),
  ADD KEY `idUsuario` (`idUsuario`);

--
-- Indices de la tabla `genero`
--
ALTER TABLE `genero`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `juegos`
--
ALTER TABLE `juegos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idGenero` (`idGenero`),
  ADD KEY `idDesarrolador` (`idDesarrolador`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `venta`
--
ALTER TABLE `venta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idJuego` (`idJuego`,`idUsuario`),
  ADD KEY `fk_venta_usuarios` (`idUsuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `biblioteca`
--
ALTER TABLE `biblioteca`
  MODIFY `id` smallint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `genero`
--
ALTER TABLE `genero`
  MODIFY `id` smallint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `juegos`
--
ALTER TABLE `juegos`
  MODIFY `id` smallint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` smallint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `venta`
--
ALTER TABLE `venta`
  MODIFY `id` smallint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `biblioteca`
--
ALTER TABLE `biblioteca`
  ADD CONSTRAINT `fk_biblioteca_juegos` FOREIGN KEY (`idJuego`) REFERENCES `juegos` (`id`),
  ADD CONSTRAINT `fk_biblioteca_usuario` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `juegos`
--
ALTER TABLE `juegos`
  ADD CONSTRAINT `fk_juegos_genero` FOREIGN KEY (`idGenero`) REFERENCES `genero` (`id`),
  ADD CONSTRAINT `fk_juegos_usuarios` FOREIGN KEY (`idDesarrolador`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `venta`
--
ALTER TABLE `venta`
  ADD CONSTRAINT `fk_venta_juegos` FOREIGN KEY (`idJuego`) REFERENCES `juegos` (`id`),
  ADD CONSTRAINT `fk_venta_usuarios` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
