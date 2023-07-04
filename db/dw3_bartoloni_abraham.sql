-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-06-2023 a las 21:39:57
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
-- Base de datos: `dw3_bartoloni_abraham`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrito`
--

CREATE TABLE `carrito` (
  `id_carrito` int(10) UNSIGNED NOT NULL,
  `fecha` date NOT NULL,
  `usuarios_fk` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id_categorias` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id_categorias`, `nombre`) VALUES
(1, 'fuerza'),
(2, 'nutricion'),
(3, 'resistencia'),
(4, 'yoga');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado`
--

CREATE TABLE `estado` (
  `id_estado` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido`
--

CREATE TABLE `pedido` (
  `id_pedido` int(10) UNSIGNED NOT NULL,
  `estado_fk` int(10) UNSIGNED NOT NULL,
  `usuarios_fk` int(10) UNSIGNED NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id_productos` int(10) UNSIGNED NOT NULL,
  `usuarios_fk` int(10) UNSIGNED NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `descripcion` text NOT NULL,
  `sintesis` varchar(255) DEFAULT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `precio` int(11) NOT NULL,
  `categorias_fk` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id_productos`, `usuarios_fk`, `titulo`, `descripcion`, `sintesis`, `imagen`, `precio`, `categorias_fk`) VALUES
(19, 1, 'Goliath\'s Challenge', '¿Te atreves a enfrentarte al gigante? Con esta rutina de fuerza, estarás preparado para cualquier desafío que se te presente. Combina ejercicios de levantamiento de pesas con movimientos funcionales para desarrollar fuerza, resistencia y coordinación. ¡Atrévete a enfrentar tu propia versión del gigante y conviértete en un verdadero campeón!', '¿Te atreves a enfrentarte al gigante?', '20230610020036_fuerza1.JPG', 10789, 1),
(20, 1, 'Hércules Challenge', '¿Quieres tener músculos de acero como el famoso héroe griego? Entonces esta rutina de fuerza es para ti. Con una combinación de ejercicios de levantamiento de pesas y entrenamiento de alta intensidad, te ayudará a construir músculos fuertes y definidos. ¡Prepárate para lucir como un dios griego!', '¿Quieres tener músculos de acero como el famoso héroe griego?', '20230610020119_fuerza2.JPG', 8432, 1),
(21, 1, 'Warrior Strength', 'Esta rutina de fuerza te llevará al siguiente nivel. Diseñada para aquellos que buscan desafiar sus límites, consiste en una combinación de ejercicios de levantamiento de pesas y entrenamiento de alta intensidad. Prepárate para mejorar tu fuerza, resistencia y agilidad, y conviértete en un guerrero imparable.', 'Esta rutina de fuerza te llevará al siguiente nivel.', '20230610021221_fuerza3.jpg', 9367, 1),
(22, 1, 'Endurance Warrior', 'Conviértete en un guerrero de resistencia con este entrenamiento de alta intensidad. Combina movimientos funcionales y cardiovasculares para mejorar tu resistencia y agilidad. Prepárate para sudar y superar tus límites con este desafío de resistencia.', 'Conviértete en un guerrero de resistencia con este entrenamiento de alta intensidad.', '20230611185143_resistencia1.jpg', 5543, 3),
(23, 1, 'Spartan Sprint', 'Prepárate para una carrera de obstáculos con este entrenamiento de resistencia. Combina sprints de alta intensidad con movimientos funcionales para mejorar tu velocidad, agilidad y coordinación. ¡Supera los obstáculos y conviértete en un auténtico espartano!', 'Prepárate para una carrera de obstáculos con este entrenamiento de resistencia.', '20230611185231_resistencia2.jpg', 12000, 3),
(24, 1, 'Ironman Challenge', '¿Quieres ser un verdadero Ironman? Este entrenamiento de resistencia es para ti. Combina carreras de larga distancia con movimientos funcionales para mejorar tu resistencia, fuerza y agilidad. Prepárate para enfrentar el desafío de tu vida y cruzar la línea de meta como un verdadero campeón.', '¿Quieres ser un verdadero Ironman?', '20230611185415_resistencia3.jpg', 6554, 3),
(25, 1, 'Plan de alimentación de 21 días', 'Este plan de alimentación de 21 días te ayudará a transformar tu cuerpo y mejorar tu salud. Incluye una combinación equilibrada de proteínas, carbohidratos y grasas saludables para mantenerte satisfecho y lleno de energía. ¡Empieza hoy mismo y transforma tu cuerpo en 21 días!', 'Este plan de alimentación de 21 días te ayudará a transformar tu cuerpo y mejorar tu salud.', '20230611190801_nutricion1.jpg', 9021, 2),
(26, 1, 'Plan de alimentación para deportistas', 'Este plan de alimentación está diseñado para atletas y personas activas que necesitan energía para rendir al máximo. Incluye una combinación de alimentos ricos en proteínas, carbohidratos complejos y grasas saludables para optimizar el rendimiento físico y mental. ¡Maximiza tu potencial con este plan de alimentación para deportistas!', 'Este plan de alimentación está diseñado para atletas y personas activas que necesitan energía para rendir al máximo.', '20230611191124_nutricion2.jpg', 7210, 2),
(27, 1, 'Plan de alimentación vegetariana', 'Este plan de alimentación vegetariana está diseñado para personas que prefieren una dieta basada en plantas. Incluye una combinación equilibrada de proteínas vegetales, carbohidratos complejos y grasas saludables para mantener una nutrición adecuada. ¡Empieza hoy mismo y experimenta los beneficios de una dieta vegetariana!', 'Este plan de alimentación vegetariana está diseñado para personas que prefieren una dieta basada en plantas.', '20230611191206_nutricion3.jpg', 5999, 2),
(28, 1, 'Yoga para principiantes', 'Este plan de yoga es perfecto para principiantes que quieran empezar a practicar esta disciplina milenaria. Incluye una secuencia de posturas básicas y técnicas de respiración para mejorar la flexibilidad, el equilibrio y la relajación. ¡Empieza hoy mismo y descubre los beneficios del yoga!', 'Este plan de yoga es perfecto para principiantes que quieran empezar a practicar esta disciplina milenaria.', '20230611193500_yoga1.jpg', 11345, 4),
(29, 1, 'Yoga para el estrés', 'Este plan de yoga está diseñado para aliviar el estrés y la ansiedad. Incluye una secuencia de posturas y técnicas de respiración para mejorar la relajación y la concentración. ¡Libera tu mente y tu cuerpo del estrés con este plan de yoga!', 'Este plan de yoga está diseñado para aliviar el estrés y la ansiedad.', '20230611193648_yoga2.jpg', 10678, 4),
(30, 1, 'Meditación para la paz interior', 'Este plan de meditación está diseñado para ayudarte a encontrar la paz interior y la tranquilidad en tu vida diaria. Incluye técnicas de meditación guiada y ejercicios de respiración para mejorar la concentración y la relajación. ¡Empieza hoy mismo y descubre el poder de la meditación!', 'Este plan de meditación está diseñado para ayudarte a encontrar la paz interior y la tranquilidad en tu vida diaria.', '20230611193733_yoga3.jpg', 8199, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto_en_carrito`
--

CREATE TABLE `producto_en_carrito` (
  `id_producto_en_carrito` int(10) UNSIGNED NOT NULL,
  `cantidad` int(10) UNSIGNED NOT NULL,
  `productos_fk` int(10) UNSIGNED NOT NULL,
  `carrito_fk` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto_en_pedido`
--

CREATE TABLE `producto_en_pedido` (
  `id_producto_en_pedido` int(10) UNSIGNED NOT NULL,
  `cantidad` int(10) UNSIGNED NOT NULL,
  `productos_fk` int(10) UNSIGNED NOT NULL,
  `pedido_fk` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id_roles` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id_roles`, `nombre`) VALUES
(1, 'administrador'),
(2, 'entrenador'),
(3, 'usuario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuarios` int(10) UNSIGNED NOT NULL,
  `roles_fk` int(10) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `username` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuarios`, `roles_fk`, `email`, `password`, `username`) VALUES
(1, 1, 'abraham@prueba.com', '$2y$10$WM7jhu0PD9rH/ESErV4iHuqnSl.jmDkba9cE8uBq1zy9i5ywqxPZe', 'Bartoloni Abraham');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD PRIMARY KEY (`id_carrito`),
  ADD KEY `fk_carrito_usuarios1_idx` (`usuarios_fk`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id_categorias`);

--
-- Indices de la tabla `estado`
--
ALTER TABLE `estado`
  ADD PRIMARY KEY (`id_estado`);

--
-- Indices de la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`id_pedido`),
  ADD KEY `fk_pedido_estado1_idx` (`estado_fk`),
  ADD KEY `fk_pedido_usuarios1_idx` (`usuarios_fk`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id_productos`),
  ADD KEY `fk_productos_usuarios1_idx` (`usuarios_fk`),
  ADD KEY `fk_productos_categorias1_idx` (`categorias_fk`);

--
-- Indices de la tabla `producto_en_carrito`
--
ALTER TABLE `producto_en_carrito`
  ADD PRIMARY KEY (`id_producto_en_carrito`),
  ADD KEY `fk_producto_en_carrito_productos1_idx` (`productos_fk`),
  ADD KEY `fk_producto_en_carrito_carrito1_idx` (`carrito_fk`);

--
-- Indices de la tabla `producto_en_pedido`
--
ALTER TABLE `producto_en_pedido`
  ADD PRIMARY KEY (`id_producto_en_pedido`),
  ADD KEY `fk_producto_en_pedido_productos1_idx` (`productos_fk`),
  ADD KEY `fk_producto_en_pedido_pedido1_idx` (`pedido_fk`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_roles`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuarios`),
  ADD KEY `fk_usuarios_roles_idx` (`roles_fk`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `carrito`
--
ALTER TABLE `carrito`
  MODIFY `id_carrito` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id_categorias` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `estado`
--
ALTER TABLE `estado`
  MODIFY `id_estado` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pedido`
--
ALTER TABLE `pedido`
  MODIFY `id_pedido` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id_productos` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `producto_en_carrito`
--
ALTER TABLE `producto_en_carrito`
  MODIFY `id_producto_en_carrito` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `producto_en_pedido`
--
ALTER TABLE `producto_en_pedido`
  MODIFY `id_producto_en_pedido` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id_roles` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuarios` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD CONSTRAINT `fk_carrito_usuarios1` FOREIGN KEY (`usuarios_fk`) REFERENCES `usuarios` (`id_usuarios`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `fk_pedido_estado1` FOREIGN KEY (`estado_fk`) REFERENCES `estado` (`id_estado`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_pedido_usuarios1` FOREIGN KEY (`usuarios_fk`) REFERENCES `usuarios` (`id_usuarios`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `fk_productos_categorias1` FOREIGN KEY (`categorias_fk`) REFERENCES `categorias` (`id_categorias`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_productos_usuarios1` FOREIGN KEY (`usuarios_fk`) REFERENCES `usuarios` (`id_usuarios`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `producto_en_carrito`
--
ALTER TABLE `producto_en_carrito`
  ADD CONSTRAINT `fk_producto_en_carrito_carrito1` FOREIGN KEY (`carrito_fk`) REFERENCES `carrito` (`id_carrito`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_producto_en_carrito_productos1` FOREIGN KEY (`productos_fk`) REFERENCES `productos` (`id_productos`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `producto_en_pedido`
--
ALTER TABLE `producto_en_pedido`
  ADD CONSTRAINT `fk_producto_en_pedido_pedido1` FOREIGN KEY (`pedido_fk`) REFERENCES `pedido` (`id_pedido`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_producto_en_pedido_productos1` FOREIGN KEY (`productos_fk`) REFERENCES `productos` (`id_productos`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `fk_usuarios_roles` FOREIGN KEY (`roles_fk`) REFERENCES `roles` (`id_roles`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
