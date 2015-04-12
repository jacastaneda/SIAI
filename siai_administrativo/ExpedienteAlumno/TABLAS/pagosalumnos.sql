-- phpMyAdmin SQL Dump
-- version 2.10.3
-- http://www.phpmyadmin.net
-- 
-- Servidor: localhost
-- Tiempo de generación: 10-01-2013 a las 09:41:21
-- Versión del servidor: 5.0.51
-- Versión de PHP: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- Base de datos: `siai`
-- 

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `pagosalumnos`
-- 

CREATE TABLE `pagosalumnos` (
  `cuenta` varchar(50) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `transaccion` varchar(5) NOT NULL,
  `valor` double NOT NULL,
  `nui` varchar(6) NOT NULL,
  `cod_arancel` varchar(4) NOT NULL,
  `N_cuota` int(11) NOT NULL,
  `ciclo` int(11) NOT NULL,
  `anio` int(11) NOT NULL,
  PRIMARY KEY  (`fecha`,`hora`,`transaccion`,`nui`,`cod_arancel`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 
-- Volcar la base de datos para la tabla `pagosalumnos`
-- 

INSERT INTO `pagosalumnos` VALUES ('7419700005582', '2012-12-14', '09:10:27', '018', 55, '018486', '025', 6, 1, 12);
INSERT INTO `pagosalumnos` VALUES ('7419700005582', '2012-12-14', '09:14:01', '003', 55, '019483', '025', 6, 1, 12);
INSERT INTO `pagosalumnos` VALUES ('7419700005582', '2012-12-14', '09:38:13', '057', 55, '019988', '025', 6, 1, 12);
INSERT INTO `pagosalumnos` VALUES ('7419700005582', '2012-12-14', '09:41:17', '019', 55, '020289', '025', 1, 3, 12);
INSERT INTO `pagosalumnos` VALUES ('7419700005582', '2012-12-14', '10:14:18', '032', 55, '019951', '025', 6, 1, 12);
INSERT INTO `pagosalumnos` VALUES ('7419700005582', '2012-12-14', '10:19:29', '034', 55, '019827', '025', 6, 1, 12);
INSERT INTO `pagosalumnos` VALUES ('7419700005582', '2012-12-14', '10:26:12', '001', 63, '020122', '025', 5, 1, 12);
INSERT INTO `pagosalumnos` VALUES ('7419700005582', '2012-12-14', '10:26:49', '001', 55, '020122', '025', 6, 1, 12);
INSERT INTO `pagosalumnos` VALUES ('7419700005582', '2012-12-14', '10:37:02', '024', 55, '019735', '025', 6, 1, 12);
INSERT INTO `pagosalumnos` VALUES ('7419700005582', '2012-12-14', '10:49:01', '023', 55, '019970', '025', 6, 1, 12);
INSERT INTO `pagosalumnos` VALUES ('7419700005582', '2012-12-14', '11:07:15', '015', 55, '018735', '025', 6, 1, 12);
INSERT INTO `pagosalumnos` VALUES ('7419700005582', '2012-12-14', '11:20:07', '016', 55, '019712', '025', 6, 1, 12);
INSERT INTO `pagosalumnos` VALUES ('7419700005582', '2012-12-14', '11:35:10', '073', 55, '018057', '025', 6, 1, 12);
INSERT INTO `pagosalumnos` VALUES ('7419700005582', '2012-12-14', '11:37:23', '019', 55, '019826', '025', 6, 1, 12);
INSERT INTO `pagosalumnos` VALUES ('7419700005582', '2012-12-14', '12:03:07', '034', 55, '020202', '025', 6, 1, 12);
INSERT INTO `pagosalumnos` VALUES ('7419700005582', '2012-12-14', '12:07:24', '080', 55, '020027', '025', 6, 1, 12);
INSERT INTO `pagosalumnos` VALUES ('7419700005582', '2012-12-14', '12:24:23', '019', 55, '019835', '025', 6, 3, 12);
INSERT INTO `pagosalumnos` VALUES ('7419700005582', '2012-12-14', '12:25:27', '031', 27.5, '019686', '001', 6, 1, 12);
INSERT INTO `pagosalumnos` VALUES ('7419700005582', '2012-12-14', '12:41:09', '091', 55, '019190', '025', 6, 1, 12);
INSERT INTO `pagosalumnos` VALUES ('7419700005582', '2012-12-14', '12:41:59', '091', 55, '019987', '025', 6, 1, 12);
INSERT INTO `pagosalumnos` VALUES ('7419700005582', '2012-12-14', '13:01:20', '015', 27.5, '019324', '001', 6, 1, 12);
INSERT INTO `pagosalumnos` VALUES ('7419700005582', '2012-12-14', '13:04:51', '031', 55, '020220', '025', 6, 1, 12);
INSERT INTO `pagosalumnos` VALUES ('7419700005582', '2012-12-14', '13:15:45', '005', 55, '012204', '025', 6, 1, 12);
INSERT INTO `pagosalumnos` VALUES ('7419700005582', '2012-12-14', '13:34:18', '031', 55, '019989', '025', 6, 1, 12);
INSERT INTO `pagosalumnos` VALUES ('7419700005582', '2012-12-14', '14:00:10', '044', 55, '019272', '025', 6, 1, 12);
INSERT INTO `pagosalumnos` VALUES ('7419700005582', '2012-12-14', '14:09:23', '018', 35.5, '019411', '001', 5, 1, 12);
INSERT INTO `pagosalumnos` VALUES ('7419700005582', '2012-12-14', '14:09:47', '018', 27.5, '019411', '001', 6, 1, 12);
INSERT INTO `pagosalumnos` VALUES ('7419700005582', '2012-12-14', '14:24:30', '034', 55, '019331', '025', 6, 1, 12);
INSERT INTO `pagosalumnos` VALUES ('7419700005582', '2012-12-14', '14:28:31', '019', 55, '019281', '025', 6, 1, 12);
INSERT INTO `pagosalumnos` VALUES ('7419700005582', '2012-12-14', '14:30:30', '019', 63, '014394', '025', 5, 1, 12);
INSERT INTO `pagosalumnos` VALUES ('7419700005582', '2012-12-14', '14:30:54', '019', 55, '014394', '025', 6, 1, 12);
INSERT INTO `pagosalumnos` VALUES ('7419700005582', '2012-12-14', '14:59:00', '034', 55, '020011', '025', 6, 1, 12);
INSERT INTO `pagosalumnos` VALUES ('7419700005582', '2012-12-14', '15:12:47', '016', 55, '019256', '025', 6, 1, 12);
INSERT INTO `pagosalumnos` VALUES ('7419700005582', '2012-12-14', '15:31:28', '018', 55, '019314', '025', 6, 1, 12);
INSERT INTO `pagosalumnos` VALUES ('7419700005582', '2012-12-14', '15:48:24', '113', 55, '019236', '025', 6, 1, 12);
INSERT INTO `pagosalumnos` VALUES ('7419700005582', '2012-12-14', '16:10:43', '015', 55, '020227', '025', 6, 1, 12);
INSERT INTO `pagosalumnos` VALUES ('7419700005582', '2012-12-14', '16:17:05', '095', 55, '018956', '025', 6, 1, 12);
INSERT INTO `pagosalumnos` VALUES ('7419700005582', '2012-12-14', '16:18:58', '019', 55, '020102', '025', 6, 1, 12);
INSERT INTO `pagosalumnos` VALUES ('7419700005582', '2012-12-14', '16:31:31', '019', 55, '019864', '025', 6, 1, 12);
INSERT INTO `pagosalumnos` VALUES ('7419700005582', '2012-12-14', '16:50:21', '019', 55, '020041', '025', 6, 1, 12);
INSERT INTO `pagosalumnos` VALUES ('7419700005582', '2012-12-14', '16:59:17', '005', 55, '018817', '025', 6, 1, 12);
INSERT INTO `pagosalumnos` VALUES ('7419700005582', '2012-12-14', '17:01:59', '002', 55, '020210', '025', 6, 1, 12);
