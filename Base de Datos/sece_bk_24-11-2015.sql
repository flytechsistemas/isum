-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-11-2015 a las 15:30:16
-- Versión del servidor: 5.6.17
-- Versión de PHP: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `sece`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_agrega_detalle_emergencia`(IN p_control_emergencia_id INT(11), IN p_emergencia_id INT(11) )
BEGIN
	INSERT INTO s_detalle_emergencias SELECT 
	'',
    p_control_emergencia_id,
    s_emergencia_id,
    s_accion_id,
    s_usuario_id,
    0,
    NOW()
FROM 
	s_emergencias_acciones_usuarios
WHERE
	s_emergencia_id = p_emergencia_id;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `s_acciones`
--

CREATE TABLE IF NOT EXISTS `s_acciones` (
  `s_id` int(11) NOT NULL AUTO_INCREMENT,
  `s_nombre` varchar(100) NOT NULL,
  `s_descripcion` text,
  `s_estatus` enum('Activo','Inactivo') NOT NULL,
  `s_empresa_id` int(11) NOT NULL,
  PRIMARY KEY (`s_id`),
  KEY `fk_acciones_empresa_id_idx` (`s_empresa_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `s_acciones`
--

INSERT INTO `s_acciones` (`s_id`, `s_nombre`, `s_descripcion`, `s_estatus`, `s_empresa_id`) VALUES
(1, 'Priemra Accion', NULL, 'Activo', 1),
(2, 'Segunda Accion', NULL, 'Activo', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `s_cajachica`
--

CREATE TABLE IF NOT EXISTS `s_cajachica` (
  `s_id` int(11) NOT NULL AUTO_INCREMENT,
  `s_nro_fac` int(12) DEFAULT NULL,
  `s_descripcion` text NOT NULL,
  `s_fecha_fac` date DEFAULT NULL,
  `s_emergencia_id` int(11) NOT NULL,
  `s_estatus` enum('Activa','Inactiva') NOT NULL,
  `s_empresa_id` int(11) NOT NULL,
  `s_cedula_fac` varchar(15) NOT NULL,
  `s_monto_fac` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`s_id`),
  KEY `fk_emergencia_tipoemergencia_id_idx` (`s_emergencia_id`),
  KEY `fk_emergencia_empresa_id_idx` (`s_empresa_id`),
  KEY `fk_emergencia_estatus_id_idx` (`s_estatus`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=24 ;

--
-- Volcado de datos para la tabla `s_cajachica`
--

INSERT INTO `s_cajachica` (`s_id`, `s_nro_fac`, `s_descripcion`, `s_fecha_fac`, `s_emergencia_id`, `s_estatus`, `s_empresa_id`, `s_cedula_fac`, `s_monto_fac`) VALUES
(15, 45555, 'ACCIDENTE AVION YV-1001', '2015-11-10', 2, 'Activa', 1, '0', '15000.00'),
(16, 441, 'Blablas', '2015-11-22', 2, 'Activa', 1, '0', '10.00'),
(21, 1525, 'Principal', '2015-11-23', 3, 'Activa', 1, '0', '152000.00'),
(22, 4040, 'awqwqwr123', '2015-11-24', 3, 'Activa', 1, 'V-18323961', '210000.00'),
(23, 1252, '12', '2015-11-24', 1, 'Activa', 1, 'V-18323961', '10.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `s_control_emergencias`
--

CREATE TABLE IF NOT EXISTS `s_control_emergencias` (
  `s_id` int(11) NOT NULL AUTO_INCREMENT,
  `s_tipo_emergencia_id` int(11) NOT NULL,
  `s_emergencia_id` int(11) NOT NULL,
  `s_estatus` enum('Activa','En Proceso','Completada','Inactiva') NOT NULL,
  `s_empresa_id` int(11) NOT NULL,
  `s_usuario_id` int(11) NOT NULL,
  `s_fecha_inicio` datetime NOT NULL,
  `s_fecha_fin` datetime DEFAULT NULL,
  PRIMARY KEY (`s_id`),
  KEY `fk_controlemergencia_estatus_id_idx` (`s_emergencia_id`),
  KEY `fk_controlemergencia_empresa_id_idx` (`s_empresa_id`),
  KEY `fk_controlemergencia_tipoemergencia_id_idx` (`s_tipo_emergencia_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Volcado de datos para la tabla `s_control_emergencias`
--

INSERT INTO `s_control_emergencias` (`s_id`, `s_tipo_emergencia_id`, `s_emergencia_id`, `s_estatus`, `s_empresa_id`, `s_usuario_id`, `s_fecha_inicio`, `s_fecha_fin`) VALUES
(15, 3, 4, 'Activa', 1, 1, '2015-11-24 08:56:37', NULL),
(16, 4, 5, 'Activa', 1, 1, '2015-11-24 08:58:12', NULL);

--
-- Disparadores `s_control_emergencias`
--
DROP TRIGGER IF EXISTS `t_agrega_detalle_emergencia`;
DELIMITER //
CREATE TRIGGER `t_agrega_detalle_emergencia` AFTER INSERT ON `s_control_emergencias`
 FOR EACH ROW call sp_agrega_detalle_emergencia(NEW.s_id, NEW.s_emergencia_id)
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `s_detalle_emergencias`
--

CREATE TABLE IF NOT EXISTS `s_detalle_emergencias` (
  `s_id` int(11) NOT NULL AUTO_INCREMENT,
  `s_control_emergencia_id` int(11) NOT NULL,
  `s_emergencia_id` int(11) NOT NULL,
  `s_accion_id` int(11) NOT NULL,
  `s_usuario_id` int(11) NOT NULL,
  `s_porcentaje_progreso` decimal(9,2) NOT NULL DEFAULT '0.00',
  `s_ultima_actualizacion` datetime NOT NULL,
  PRIMARY KEY (`s_id`),
  KEY `fk_detalleemergencia_accion_id_idx` (`s_accion_id`),
  KEY `fk_detalleemergencia_emergencia_id_idx` (`s_emergencia_id`),
  KEY `fk_detalleemergencia_controlemergencia_id_idx` (`s_control_emergencia_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `s_detalle_emergencias`
--

INSERT INTO `s_detalle_emergencias` (`s_id`, `s_control_emergencia_id`, `s_emergencia_id`, `s_accion_id`, `s_usuario_id`, `s_porcentaje_progreso`, `s_ultima_actualizacion`) VALUES
(1, 15, 4, 1, 1, '0.00', '0000-00-00 00:00:00'),
(2, 15, 4, 2, 2, '0.00', '0000-00-00 00:00:00'),
(3, 15, 4, 1, 2, '0.00', '0000-00-00 00:00:00'),
(4, 16, 5, 1, 2, '0.00', '0000-00-00 00:00:00'),
(5, 16, 5, 2, 1, '0.00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `s_emergencias`
--

CREATE TABLE IF NOT EXISTS `s_emergencias` (
  `s_id` int(11) NOT NULL AUTO_INCREMENT,
  `s_nombre` varchar(250) NOT NULL,
  `s_descripcion` text,
  `s_tipo_emergencia_id` int(11) NOT NULL,
  `s_estatus` enum('Activa','Inactiva') NOT NULL,
  `s_empresa_id` int(11) NOT NULL,
  PRIMARY KEY (`s_id`),
  KEY `fk_emergencia_tipoemergencia_id_idx` (`s_tipo_emergencia_id`),
  KEY `fk_emergencia_empresa_id_idx` (`s_empresa_id`),
  KEY `fk_emergencia_estatus_id_idx` (`s_estatus`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `s_emergencias`
--

INSERT INTO `s_emergencias` (`s_id`, `s_nombre`, `s_descripcion`, `s_tipo_emergencia_id`, `s_estatus`, `s_empresa_id`) VALUES
(4, 'Problema en motor', 'Problema en motor', 3, 'Activa', 1),
(5, 'Problema en el mar', 'Problema en el mar', 4, 'Activa', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `s_emergencias_acciones_usuarios`
--

CREATE TABLE IF NOT EXISTS `s_emergencias_acciones_usuarios` (
  `s_id` int(11) NOT NULL AUTO_INCREMENT,
  `s_emergencia_id` int(11) NOT NULL,
  `s_accion_id` int(11) NOT NULL,
  `s_usuario_id` int(11) NOT NULL,
  `s_empresa_id` int(11) NOT NULL,
  PRIMARY KEY (`s_id`),
  UNIQUE KEY `ui_emergencia_accion_usuario` (`s_accion_id`,`s_emergencia_id`,`s_usuario_id`,`s_empresa_id`),
  KEY `fk_accionusuario_accion_id_idx` (`s_accion_id`),
  KEY `fk_accionusuario_usuario_id_idx` (`s_usuario_id`),
  KEY `fk_emergenciaaccionusuario_empresa_id_idx` (`s_empresa_id`),
  KEY `fk_emergenciaaccionusuario_emergencia_id_idx` (`s_emergencia_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

--
-- Volcado de datos para la tabla `s_emergencias_acciones_usuarios`
--

INSERT INTO `s_emergencias_acciones_usuarios` (`s_id`, `s_emergencia_id`, `s_accion_id`, `s_usuario_id`, `s_empresa_id`) VALUES
(14, 4, 1, 1, 1),
(18, 4, 1, 2, 1),
(20, 5, 2, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `s_emergencias_progreso`
--

CREATE TABLE IF NOT EXISTS `s_emergencias_progreso` (
  `s_id` int(11) NOT NULL AUTO_INCREMENT,
  `s_emergencia_id` int(11) NOT NULL,
  `s_porcentaje_progreso` decimal(9,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`s_id`),
  KEY `fk_emergenciaprogreso_emergencia_id_idx` (`s_emergencia_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `s_empresas`
--

CREATE TABLE IF NOT EXISTS `s_empresas` (
  `s_id` int(11) NOT NULL AUTO_INCREMENT,
  `s_razon_social` varchar(250) NOT NULL,
  `s_rif` varchar(45) NOT NULL,
  `s_telefono1` varchar(11) NOT NULL,
  `s_telefono2` varchar(11) DEFAULT NULL,
  `s_email` varchar(250) NOT NULL,
  `s_estatus` tinyint(1) NOT NULL,
  PRIMARY KEY (`s_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `s_empresas`
--

INSERT INTO `s_empresas` (`s_id`, `s_razon_social`, `s_rif`, `s_telefono1`, `s_telefono2`, `s_email`, `s_estatus`) VALUES
(1, 'JPHSistemas', 'J123123123', '123123123', '123123123', 'jperaza@ximplex.com.ve', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `s_estatus`
--

CREATE TABLE IF NOT EXISTS `s_estatus` (
  `s_id` int(11) NOT NULL AUTO_INCREMENT,
  `s_nombre` varchar(100) NOT NULL,
  `s_descripcion` varchar(250) DEFAULT NULL,
  `s_tabla` varchar(100) NOT NULL,
  `s_empresa_id` int(11) NOT NULL,
  PRIMARY KEY (`s_id`),
  KEY `fk_estaus_empresa_id_idx` (`s_empresa_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `s_estatus`
--

INSERT INTO `s_estatus` (`s_id`, `s_nombre`, `s_descripcion`, `s_tabla`, `s_empresa_id`) VALUES
(1, 'Activo', 'Activo', 'emergencias', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `s_permisos`
--

CREATE TABLE IF NOT EXISTS `s_permisos` (
  `s_id` int(11) NOT NULL AUTO_INCREMENT,
  `s_nombre` varchar(200) NOT NULL,
  `s_descripcion` text,
  PRIMARY KEY (`s_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Volcado de datos para la tabla `s_permisos`
--

INSERT INTO `s_permisos` (`s_id`, `s_nombre`, `s_descripcion`) VALUES
(1, 'Ver Usuarios', 'Visualizar usuarios'),
(2, 'Crear/Editar Usuarios', 'Permite crear y editar usuarios'),
(3, 'Eliminar Usuarios', 'Eliminar Usuarios'),
(5, 'Ver Tipo de Emergencia', 'Vertipo de emergencia'),
(6, 'Crear/Editar Tipo de Emergencia', 'Crear/Editartipo de emergencia'),
(7, 'Eliminar Tipo de Emergencia', 'Eliminartipo de emergencia'),
(8, 'Ver Emergencias', 'Ver emergencias'),
(9, 'Crear/Editar Emergencias', 'Crear/Editar emergencias'),
(10, 'Eliminar Emergencias', 'Eliminar emergencias'),
(11, 'Ver Caja Chica', 'Ver caja chica'),
(12, 'Crear/Editar Caja Chica', 'Crear/Editar caja chica'),
(13, 'Eliminar Caja Chica', 'Eliminar caja chica'),
(14, 'Ver Perros', 'Ver perros'),
(15, 'Crear/Editar Perros', 'Crear/Editar perros'),
(16, 'Eliminar Perros', 'Eliminar perros');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `s_permisos_usuarios`
--

CREATE TABLE IF NOT EXISTS `s_permisos_usuarios` (
  `s_id` int(11) NOT NULL AUTO_INCREMENT,
  `s_permiso_id` int(11) NOT NULL,
  `s_usuario_id` int(11) NOT NULL,
  PRIMARY KEY (`s_id`),
  KEY `fk_permisousuario_permiso_id_idx` (`s_permiso_id`),
  KEY `fk_permisousuario_usuario_id_idx` (`s_usuario_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=63 ;

--
-- Volcado de datos para la tabla `s_permisos_usuarios`
--

INSERT INTO `s_permisos_usuarios` (`s_id`, `s_permiso_id`, `s_usuario_id`) VALUES
(51, 1, 2),
(52, 2, 2),
(53, 3, 2),
(54, 5, 2),
(55, 6, 2),
(56, 7, 2),
(57, 8, 2),
(58, 9, 2),
(59, 10, 2),
(60, 1, 1),
(61, 2, 1),
(62, 3, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `s_tipo_emergencia`
--

CREATE TABLE IF NOT EXISTS `s_tipo_emergencia` (
  `s_id` int(11) NOT NULL AUTO_INCREMENT,
  `s_nombre` varchar(250) NOT NULL,
  `s_descripcion` varchar(250) DEFAULT NULL,
  `s_estatus` enum('Activo','Inactivo') NOT NULL,
  `s_empresa_id` int(11) NOT NULL,
  PRIMARY KEY (`s_id`),
  KEY `fk_tipoemergencia_empresa_idx` (`s_empresa_id`),
  KEY `fk_tipoemergencia_estatus_id_idx` (`s_estatus`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `s_tipo_emergencia`
--

INSERT INTO `s_tipo_emergencia` (`s_id`, `s_nombre`, `s_descripcion`, `s_estatus`, `s_empresa_id`) VALUES
(2, 'Secundario', 'Secundario', 'Activo', 1),
(3, 'AEREA', 'ACCIDENTE EN EL AIRE', 'Activo', 1),
(4, 'MARITIMA', 'EN EL MAR', 'Activo', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `s_usuarios`
--

CREATE TABLE IF NOT EXISTS `s_usuarios` (
  `s_id` int(11) NOT NULL AUTO_INCREMENT,
  `s_login` varchar(100) NOT NULL,
  `s_clave` varchar(200) NOT NULL,
  `s_nombre` varchar(150) NOT NULL,
  `s_apellido` varchar(150) NOT NULL,
  `s_documento` varchar(15) NOT NULL,
  `s_email` varchar(250) NOT NULL,
  `s_telefono` varchar(11) DEFAULT NULL,
  `s_estatus` enum('Activo','Cambio de Clave','Inactivo') NOT NULL,
  `s_empresa_id` int(11) NOT NULL,
  PRIMARY KEY (`s_id`),
  KEY `fk_usuario_empresa_id_idx` (`s_empresa_id`),
  KEY `fk_usuario_estatus_id_idx` (`s_estatus`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- Volcado de datos para la tabla `s_usuarios`
--

INSERT INTO `s_usuarios` (`s_id`, `s_login`, `s_clave`, `s_nombre`, `s_apellido`, `s_documento`, `s_email`, `s_telefono`, `s_estatus`, `s_empresa_id`) VALUES
(1, 'jperaza', '18323961', 'Jorge', 'Peraza', 'V-18323961', 'jperaza@ximplex.com.ve', '9123', 'Activo', 1),
(2, 'ysosa', '123456', 'Yuri', 'Sosa', 'V-10123123', 'ysosa@flytechsistemas.com.ve', '0414-206115', 'Activo', 1);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vw_obtenerresponsables_emergencia`
--
CREATE TABLE IF NOT EXISTS `vw_obtenerresponsables_emergencia` (
`s_id` int(11)
,`emergencia` varchar(250)
,`accion` varchar(100)
,`responsable` varchar(301)
,`email` varchar(250)
);
-- --------------------------------------------------------

--
-- Estructura para la vista `vw_obtenerresponsables_emergencia`
--
DROP TABLE IF EXISTS `vw_obtenerresponsables_emergencia`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_obtenerresponsables_emergencia` AS select `a`.`s_id` AS `s_id`,`a`.`s_nombre` AS `emergencia`,`d`.`s_nombre` AS `accion`,concat(`c`.`s_nombre`,' ',`c`.`s_apellido`) AS `responsable`,`c`.`s_email` AS `email` from (((`s_emergencias` `a` join `s_detalle_emergencias` `b`) join `s_usuarios` `c`) join `s_acciones` `d`) where ((`a`.`s_id` = `b`.`s_emergencia_id`) and (`b`.`s_usuario_id` = `c`.`s_id`) and (`b`.`s_accion_id` = `d`.`s_id`));

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `s_acciones`
--
ALTER TABLE `s_acciones`
  ADD CONSTRAINT `fk_acciones_empresa_id` FOREIGN KEY (`s_empresa_id`) REFERENCES `s_empresas` (`s_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `s_control_emergencias`
--
ALTER TABLE `s_control_emergencias`
  ADD CONSTRAINT `fk_controlemergencia_emergencia_id` FOREIGN KEY (`s_emergencia_id`) REFERENCES `s_emergencias` (`s_id`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_controlemergencia_empresa_id` FOREIGN KEY (`s_empresa_id`) REFERENCES `s_empresas` (`s_id`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_controlemergencia_tipoemergencia_id` FOREIGN KEY (`s_tipo_emergencia_id`) REFERENCES `s_tipo_emergencia` (`s_id`) ON UPDATE NO ACTION;

--
-- Filtros para la tabla `s_emergencias`
--
ALTER TABLE `s_emergencias`
  ADD CONSTRAINT `fk_emergencia_tipoemergencia_id` FOREIGN KEY (`s_tipo_emergencia_id`) REFERENCES `s_tipo_emergencia` (`s_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_emergencia_empresa_id` FOREIGN KEY (`s_empresa_id`) REFERENCES `s_empresas` (`s_id`) ON UPDATE NO ACTION;

--
-- Filtros para la tabla `s_emergencias_acciones_usuarios`
--
ALTER TABLE `s_emergencias_acciones_usuarios`
  ADD CONSTRAINT `fk_emergenciaaccionusuario_accion_id` FOREIGN KEY (`s_accion_id`) REFERENCES `s_acciones` (`s_id`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_emergenciaaccionusuario_emergencia_id` FOREIGN KEY (`s_emergencia_id`) REFERENCES `s_emergencias` (`s_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_emergenciaaccionusuario_empresa_id` FOREIGN KEY (`s_empresa_id`) REFERENCES `s_empresas` (`s_id`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_emergenciaaccionusuario_usuario_id` FOREIGN KEY (`s_usuario_id`) REFERENCES `s_usuarios` (`s_id`) ON UPDATE NO ACTION;

--
-- Filtros para la tabla `s_emergencias_progreso`
--
ALTER TABLE `s_emergencias_progreso`
  ADD CONSTRAINT `fk_emergenciaprogreso_emergencia_id` FOREIGN KEY (`s_emergencia_id`) REFERENCES `s_emergencias` (`s_id`) ON UPDATE NO ACTION;

--
-- Filtros para la tabla `s_estatus`
--
ALTER TABLE `s_estatus`
  ADD CONSTRAINT `fk_estaus_empresa_id` FOREIGN KEY (`s_empresa_id`) REFERENCES `s_empresas` (`s_id`) ON UPDATE NO ACTION;

--
-- Filtros para la tabla `s_permisos_usuarios`
--
ALTER TABLE `s_permisos_usuarios`
  ADD CONSTRAINT `fk_permisousuario_permiso_id` FOREIGN KEY (`s_permiso_id`) REFERENCES `s_permisos` (`s_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_permisousuario_usuario_id` FOREIGN KEY (`s_usuario_id`) REFERENCES `s_usuarios` (`s_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Filtros para la tabla `s_tipo_emergencia`
--
ALTER TABLE `s_tipo_emergencia`
  ADD CONSTRAINT `fk_tipoemergencia_empresa_id` FOREIGN KEY (`s_empresa_id`) REFERENCES `s_empresas` (`s_id`) ON UPDATE NO ACTION;

--
-- Filtros para la tabla `s_usuarios`
--
ALTER TABLE `s_usuarios`
  ADD CONSTRAINT `fk_usuario_empresa_id` FOREIGN KEY (`s_empresa_id`) REFERENCES `s_empresas` (`s_id`) ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
