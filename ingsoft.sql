-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-06-2023 a las 07:20:59
-- Versión del servidor: 10.4.21-MariaDB
-- Versión de PHP: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `ingsoft`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alergias`
--

CREATE TABLE `alergias` (
  `idalergia` int(11) NOT NULL,
  `nombre_alergia` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `alergias`
--

INSERT INTO `alergias` (`idalergia`, `nombre_alergia`) VALUES
(1, 'Lácteos'),
(2, 'Huevo'),
(3, 'Mariscos'),
(4, 'Maní'),
(5, 'Frutos secos'),
(6, 'Trigo'),
(7, 'Gluten'),
(8, 'Chocolate'),
(9, 'Maíz'),
(10, 'Fresas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupos`
--

CREATE TABLE `grupos` (
  `idgrupo` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `descripcion` varchar(45) NOT NULL,
  `imagen_grupo` varchar(45) NOT NULL,
  `receta_preferida` int(11) DEFAULT NULL,
  `receta_mas_preparada` int(11) DEFAULT NULL,
  `receta_menos_preparada` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `grupos`
--

INSERT INTO `grupos` (`idgrupo`, `nombre`, `descripcion`, `imagen_grupo`, `receta_preferida`, `receta_mas_preparada`, `receta_menos_preparada`) VALUES
(1, 'Equipo1', 'Equipo de Ingeniería de Software', 'grupo.png', 0, 0, 0),
(2, 'Equipo2', 'Grupo del equipo 2', 'grupo.png', 0, 0, 0),
(3, 'Equipo 3', 'Equipo 3', 'multitud.png', NULL, NULL, NULL),
(4, 'Grupo 2', 'Segundo grupo creado', 'multitud.png', NULL, NULL, NULL),
(19, 'Grupo Vania', 'Grupo creado por Vania', 'grupo1.png', NULL, NULL, NULL),
(20, 'Grupo Vania', 'Grupo creado por Vania', 'grupo1.png', NULL, NULL, NULL),
(21, 'Grupo Vania y Axel', 'Grupo de Vania y Axel', 'mesa.png', NULL, NULL, NULL),
(22, 'Grupo Vania', 'Grupo creado por Vania', 'grupo1.png', NULL, NULL, NULL),
(23, 'Axel grupo', 'Grupo creado por Axel', 'grupo.png', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupos_recetas`
--

CREATE TABLE `grupos_recetas` (
  `id_grupo` int(11) NOT NULL,
  `id_recetas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ingredientes`
--

CREATE TABLE `ingredientes` (
  `idingrediente` int(11) NOT NULL,
  `nombre_ingrediente` varchar(45) DEFAULT NULL,
  `tipo_ingrediente` varchar(45) DEFAULT NULL,
  `imagen` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `ingredientes`
--

INSERT INTO `ingredientes` (`idingrediente`, `nombre_ingrediente`, `tipo_ingrediente`, `imagen`) VALUES
(1, 'Esencia de Vainilla', 'Liquido', 'esencia_vainilla.png'),
(2, 'Leche', 'Liquido', 'leche.png'),
(3, 'Leche evaporada Carnation', 'Liquido', 'leche_evaporada.png'),
(4, 'Agua', 'Liquido', 'agua.png'),
(5, 'Jugo de limon', 'Liquido', 'jugo_de_limón.png'),
(6, 'Jugo de naranja', 'Liquido', 'jugo_naranja.png'),
(7, 'Jugo de uva', 'Liquido', 'jugo_uva.png'),
(8, 'Vinagre Blanco', 'Liquido', 'vinagre_blanco.png'),
(9, 'Refresco', 'Liquido', 'refresco.png'),
(10, 'Vinagre de Manzana', 'Liquido', 'vinagre_manzana.png'),
(11, 'Aceite de oliva', 'Liquido', 'aceite_oliva.png'),
(12, 'Aceite de canola', 'Liquido', 'aceite_canola.png'),
(13, 'Aceite de coco', 'Liquido', 'aceite_coco.png'),
(14, 'Aceite de almendras', 'Liquido', 'aceite_almendra.png'),
(15, 'Aceite de aguacate', 'Liquido', 'aceite_aguacate.png'),
(16, 'Harina', 'Solido', 'harina.png'),
(17, 'Canela', 'Solido', 'canela.png'),
(18, 'Nueces', 'Solido', 'nuez.png'),
(19, 'Maizena', 'Solido', 'maizena.png'),
(20, 'Azucar', 'Solido', 'azúcar.png'),
(21, 'Harina de trigo', 'Solido', 'harina_trigo.png'),
(22, 'Mantequilla', 'Solido', 'mantequilla.png'),
(23, 'Avena', 'Solido', 'avena.png'),
(24, 'Arroz', 'Solido', 'arroz.png'),
(25, 'Lentejas', 'Solido', 'lentejas.png'),
(26, 'Pasta', 'Solido', 'pasta.png'),
(27, 'Polvo para hornear', 'Solido', 'polvo_para_hornear.png'),
(28, 'Sal', 'Solido', 'sal.png'),
(29, 'Harina de arroz', 'Solido', 'harina_arroz.png'),
(30, 'Oregano', 'Solido', 'oregano.png'),
(31, 'Tomate', 'Pieza', 'tomate.png'),
(32, 'Lechuga', 'Pieza', 'lechega.png'),
(33, 'Papa', 'Pieza', 'papa.png'),
(34, 'Pimiento', 'Pieza', 'pimiento.png'),
(35, 'Zanahoria', 'Pieza', 'zanahoria.png'),
(36, 'Limon', 'Pieza', 'limon.png'),
(37, 'Manzana', 'Pieza', 'manzana.png'),
(38, 'Platano', 'Pieza', 'platano.png'),
(39, 'Fresa', 'Pieza', 'fresa.png'),
(40, 'Naranja', 'Pieza', 'naranja.png'),
(41, 'Queso', 'Pieza', 'queso.png'),
(42, 'Huevo', 'Pieza', 'huevo.png'),
(43, 'Tortilla', 'Pieza', 'tortilla.png'),
(44, 'Pan', 'Pieza', 'pan.png'),
(45, 'Pescado', 'Pieza', 'pescado.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ingredientes_de_receta`
--

CREATE TABLE `ingredientes_de_receta` (
  `receta_idreceta` int(11) NOT NULL,
  `ingrediente` varchar(45) NOT NULL,
  `cantidad` decimal(3,2) DEFAULT NULL,
  `medidas_idmedida` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `ingredientes_de_receta`
--

INSERT INTO `ingredientes_de_receta` (`receta_idreceta`, `ingrediente`, `cantidad`, `medidas_idmedida`) VALUES
(33, '', '0.00', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ins`
--

CREATE TABLE `ins` (
  `id` int(11) NOT NULL,
  `foto` mediumblob DEFAULT NULL,
  `ingrediente` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medidas`
--

CREATE TABLE `medidas` (
  `idmedidas` int(11) NOT NULL,
  `nombre_medida` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `medidas`
--

INSERT INTO `medidas` (`idmedidas`, `nombre_medida`) VALUES
(1, 'Cucharadita'),
(2, 'Cucharada'),
(3, 'Taza'),
(4, 'Onza'),
(5, 'Libra'),
(6, 'Gramo'),
(7, 'Kilogramo'),
(8, 'Litro'),
(9, 'Mililitro'),
(10, 'Pizca'),
(11, 'Rama'),
(12, 'Diente'),
(13, 'Hoja'),
(14, 'Ramillete'),
(15, 'Filete'),
(16, 'Rodaja'),
(17, 'Lata'),
(18, 'Botella'),
(19, 'Caja'),
(20, 'Bolsa');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preferencias`
--

CREATE TABLE `preferencias` (
  `idpreferencia` int(11) NOT NULL,
  `nombre_preferencia` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `preferencias`
--

INSERT INTO `preferencias` (`idpreferencia`, `nombre_preferencia`) VALUES
(1, 'Vegetariano'),
(2, 'Vegano'),
(3, 'Keto'),
(4, 'Sin alcohol'),
(5, 'Diabetico'),
(6, 'Carnivoro'),
(7, 'Fitness');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preparaciones`
--

CREATE TABLE `preparaciones` (
  `idpreparacion` int(11) NOT NULL,
  `preparacion` varchar(100) DEFAULT NULL,
  `receta_idreceta` int(11) NOT NULL,
  `nombre_imagen` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `preparaciones`
--

INSERT INTO `preparaciones` (`idpreparacion`, `preparacion`, `receta_idreceta`, `nombre_imagen`) VALUES
(15, NULL, 29, 'lp-3.jpg'),
(16, NULL, 29, 'lp-3.jpg'),
(17, NULL, 29, 'lp-3.jpg'),
(18, NULL, 29, ''),
(19, NULL, 29, 'lp-3.jpg'),
(20, NULL, 29, 'lp-3.jpg'),
(21, NULL, 29, 'lp-3.jpg'),
(22, NULL, 29, 'lp-2.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `receta`
--

CREATE TABLE `receta` (
  `idreceta` int(11) NOT NULL,
  `nombre_receta` varchar(45) DEFAULT NULL,
  `porciones` int(11) DEFAULT NULL,
  `tiempo_preparacion` varchar(45) DEFAULT NULL,
  `tiempo_comida` varchar(45) DEFAULT NULL,
  `tipo_comida` varchar(45) DEFAULT NULL,
  `tipo_preferencia` varchar(45) DEFAULT NULL,
  `dificultad` varchar(45) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `foto_principal` varchar(45) DEFAULT NULL,
  `usuario_idusuario` int(11) NOT NULL,
  `calificacion` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `receta`
--

INSERT INTO `receta` (`idreceta`, `nombre_receta`, `porciones`, `tiempo_preparacion`, `tiempo_comida`, `tipo_comida`, `tipo_preferencia`, `dificultad`, `descripcion`, `foto_principal`, `usuario_idusuario`, `calificacion`) VALUES
(29, 'prueba26/04/23', 4, '1 min', 'Desayuno', 'Entrada', 'Mariscos', 'Alta', 'prueba a cambia', 'prueba.png', 1, NULL),
(30, 'Sandwich', 1, '5 min', 'Desayuno', 'Entrada', 'Saludables', 'Baja', 'Pan y jamon', 'sandwich.png', 1, NULL),
(31, 'Leche con chocolate', 1, '1 min', 'Desayuno', 'Bebida', 'Lacteos', 'Baja', 'Agregar chocolate a la leche', 'leche_chocolate.png', 1, NULL),
(32, 'Huevo a la mexicana', 4, '10 min', 'Desayuno', 'Plato Principal', 'Omnívoro', 'Media', 'Huevo al estilo mexicano', 'huevito_mexicana.png', 7, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idusuario` int(11) NOT NULL,
  `nombre_usuario` varchar(45) DEFAULT NULL,
  `correo_electronico` varchar(60) DEFAULT NULL,
  `contrasena` varchar(45) DEFAULT NULL,
  `imagen` varchar(50) DEFAULT NULL,
  `receta_favorita` varchar(45) DEFAULT NULL,
  `receta_mas_preparada` varchar(50) DEFAULT NULL,
  `receta_menos_preparada` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idusuario`, `nombre_usuario`, `correo_electronico`, `contrasena`, `imagen`, `receta_favorita`, `receta_mas_preparada`, `receta_menos_preparada`) VALUES
(1, 'admin', NULL, 'admin', 'perfil_grupo.png', NULL, NULL, NULL),
(7, 'vania', 'vania@correo.com', 'vania', 'foto_perfil2.png', NULL, NULL, NULL),
(8, 'nora', 'nora@gmail.com', 'nora', 'foto_perfil4.png', NULL, NULL, NULL),
(10, 'maria', 'maria@correo.com', 'maria', 'foto_perfil.png', NULL, NULL, NULL),
(11, 'axel', 'axel@correo.com', 'axel', 'foto_perfil3.png', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_alergias`
--

CREATE TABLE `usuarios_alergias` (
  `id_usuario` int(11) NOT NULL,
  `alergia` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios_alergias`
--

INSERT INTO `usuarios_alergias` (`id_usuario`, `alergia`) VALUES
(9, 'mariscos'),
(10, 'mani'),
(11, 'mariscos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_grupos`
--

CREATE TABLE `usuarios_grupos` (
  `id_usuario` int(11) NOT NULL,
  `id_grupo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios_grupos`
--

INSERT INTO `usuarios_grupos` (`id_usuario`, `id_grupo`) VALUES
(7, 1),
(8, 1),
(7, 19),
(7, 20),
(7, 21),
(7, 22),
(11, 23);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_preferencias`
--

CREATE TABLE `usuarios_preferencias` (
  `id_usuario` int(11) NOT NULL,
  `preferencia` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios_preferencias`
--

INSERT INTO `usuarios_preferencias` (`id_usuario`, `preferencia`) VALUES
(9, 'sin-alcohol'),
(9, 'carnivoro'),
(10, 'diabetico'),
(11, 'carnivoro');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_recetas_favoritas`
--

CREATE TABLE `usuarios_recetas_favoritas` (
  `id_usuario` int(11) NOT NULL,
  `id_receta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios_recetas_favoritas`
--

INSERT INTO `usuarios_recetas_favoritas` (`id_usuario`, `id_receta`) VALUES
(11, 30),
(11, 31),
(7, 31);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alergias`
--
ALTER TABLE `alergias`
  ADD PRIMARY KEY (`idalergia`);

--
-- Indices de la tabla `grupos`
--
ALTER TABLE `grupos`
  ADD PRIMARY KEY (`idgrupo`);

--
-- Indices de la tabla `grupos_recetas`
--
ALTER TABLE `grupos_recetas`
  ADD KEY `fk_gruposrecetas_grupo` (`id_grupo`),
  ADD KEY `fk_gruposrecetas_receta` (`id_recetas`);

--
-- Indices de la tabla `ingredientes`
--
ALTER TABLE `ingredientes`
  ADD PRIMARY KEY (`idingrediente`);

--
-- Indices de la tabla `ingredientes_de_receta`
--
ALTER TABLE `ingredientes_de_receta`
  ADD PRIMARY KEY (`receta_idreceta`) USING BTREE,
  ADD KEY `fk_receta_has_ingredientes_ingredientes1_idx` (`ingrediente`),
  ADD KEY `fk_receta_has_ingredientes_receta1_idx` (`receta_idreceta`),
  ADD KEY `fk_receta_has_ingredientes_medidas1_idx` (`medidas_idmedida`);

--
-- Indices de la tabla `medidas`
--
ALTER TABLE `medidas`
  ADD PRIMARY KEY (`idmedidas`);

--
-- Indices de la tabla `preferencias`
--
ALTER TABLE `preferencias`
  ADD PRIMARY KEY (`idpreferencia`);

--
-- Indices de la tabla `preparaciones`
--
ALTER TABLE `preparaciones`
  ADD PRIMARY KEY (`idpreparacion`),
  ADD KEY `fk_preparaciones_receta1_idx` (`receta_idreceta`);

--
-- Indices de la tabla `receta`
--
ALTER TABLE `receta`
  ADD PRIMARY KEY (`idreceta`),
  ADD KEY `fk_receta_usuario1` (`usuario_idusuario`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idusuario`);

--
-- Indices de la tabla `usuarios_grupos`
--
ALTER TABLE `usuarios_grupos`
  ADD KEY `fk_usuariosgrupos_grupos` (`id_grupo`),
  ADD KEY `fk_usuariosgrupos_usuarios` (`id_usuario`);

--
-- Indices de la tabla `usuarios_recetas_favoritas`
--
ALTER TABLE `usuarios_recetas_favoritas`
  ADD KEY `fk_usuarios_recetas_favoritas_usuarios` (`id_usuario`),
  ADD KEY `fk_usuarios_recetas_favoritas_recetas` (`id_receta`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `alergias`
--
ALTER TABLE `alergias`
  MODIFY `idalergia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `grupos`
--
ALTER TABLE `grupos`
  MODIFY `idgrupo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `medidas`
--
ALTER TABLE `medidas`
  MODIFY `idmedidas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `preferencias`
--
ALTER TABLE `preferencias`
  MODIFY `idpreferencia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `preparaciones`
--
ALTER TABLE `preparaciones`
  MODIFY `idpreparacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `receta`
--
ALTER TABLE `receta`
  MODIFY `idreceta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `grupos_recetas`
--
ALTER TABLE `grupos_recetas`
  ADD CONSTRAINT `fk_gruposrecetas_grupo` FOREIGN KEY (`id_grupo`) REFERENCES `grupos` (`idgrupo`),
  ADD CONSTRAINT `fk_gruposrecetas_receta` FOREIGN KEY (`id_recetas`) REFERENCES `receta` (`idreceta`);

--
-- Filtros para la tabla `preparaciones`
--
ALTER TABLE `preparaciones`
  ADD CONSTRAINT `fk_preparaciones_receta1_idx` FOREIGN KEY (`receta_idreceta`) REFERENCES `receta` (`idreceta`);

--
-- Filtros para la tabla `receta`
--
ALTER TABLE `receta`
  ADD CONSTRAINT `fk_receta_usuario1` FOREIGN KEY (`usuario_idusuario`) REFERENCES `usuario` (`idusuario`);

--
-- Filtros para la tabla `usuarios_grupos`
--
ALTER TABLE `usuarios_grupos`
  ADD CONSTRAINT `fk_usuariosgrupos_grupos` FOREIGN KEY (`id_grupo`) REFERENCES `grupos` (`idgrupo`),
  ADD CONSTRAINT `fk_usuariosgrupos_usuarios` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`idusuario`);

--
-- Filtros para la tabla `usuarios_recetas_favoritas`
--
ALTER TABLE `usuarios_recetas_favoritas`
  ADD CONSTRAINT `fk_usuarios_recetas_favoritas_recetas` FOREIGN KEY (`id_receta`) REFERENCES `receta` (`idreceta`),
  ADD CONSTRAINT `fk_usuarios_recetas_favoritas_usuarios` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`idusuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
