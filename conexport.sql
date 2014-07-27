-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 25-07-2014 a las 19:01:21
-- Versión del servidor: 5.5.24-log
-- Versión de PHP: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `conexport1`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bodega`
--

CREATE TABLE IF NOT EXISTS `bodega` (
  `nro_bodega` int(11) NOT NULL,
  `descripcion` varchar(250) NOT NULL,
  PRIMARY KEY (`nro_bodega`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Objeto que contiene la informaci�n sobre la bodega, que es d';

--
-- Volcado de datos para la tabla `bodega`
--

INSERT INTO `bodega` (`nro_bodega`, `descripcion`) VALUES
(1, 'Bodega 1'),
(2, 'Bodega 2'),
(3, 'Bodega 3'),
(4, 'Bodega 4'),
(5, 'Bodega 5'),
(6, 'Bodega 6'),
(7, 'Bodega 7'),
(8, 'Bodega 8'),
(9, 'Bodega 9'),
(10, 'Bodega 10'),
(11, 'Las camelias');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE IF NOT EXISTS `cliente` (
  `id_cliente` int(11) NOT NULL AUTO_INCREMENT,
  `organizacion` varchar(50) NOT NULL,
  `razon_social` varchar(50) NOT NULL,
  `rut_cliente` varchar(15) NOT NULL,
  `direccion` varchar(50) NOT NULL,
  `fono_cliente` varchar(50) NOT NULL,
  PRIMARY KEY (`id_cliente`,`rut_cliente`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Objeto que contiene la informaci�n correspondiente al client' AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`id_cliente`, `organizacion`, `razon_social`, `rut_cliente`, `direccion`, `fono_cliente`) VALUES
(1, 'Celulosa Arauco', 'Celulosa Arauco y Constitucion S A', '93.458.000-1', 'Avenida El Golf 150 14 Piso  Las Condes Santiago', '56224617200');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contenedor`
--

CREATE TABLE IF NOT EXISTS `contenedor` (
  `id_cont` int(11) NOT NULL AUTO_INCREMENT,
  `codigo_contenedor` varchar(50) NOT NULL,
  PRIMARY KEY (`id_cont`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Contiene la infromaci�n respecto a los contenedores donde se' AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `contenedor`
--

INSERT INTO `contenedor` (`id_cont`, `codigo_contenedor`) VALUES
(1, 'GLDU731848-4'),
(2, 'GLDU731848-1'),
(3, 'GLDU731848-4');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_dano`
--

CREATE TABLE IF NOT EXISTS `detalle_dano` (
  `id_detalle` int(11) NOT NULL AUTO_INCREMENT,
  `id_lote` int(11) DEFAULT NULL,
  `imp_o_zcho` int(11) NOT NULL,
  `imp_o_taco` int(11) NOT NULL,
  `imp_d_zcho` int(11) NOT NULL,
  `imp_d_taco` int(11) NOT NULL,
  `imp_piezas_o` int(11) NOT NULL,
  `imp_piezas_d` int(11) NOT NULL,
  `observaciones` varchar(250) NOT NULL,
  PRIMARY KEY (`id_detalle`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Representa al objeto dealle de lote, que muestra el detalle ' AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `detalle_dano`
--

INSERT INTO `detalle_dano` (`id_detalle`, `id_lote`, `imp_o_zcho`, `imp_o_taco`, `imp_d_zcho`, `imp_d_taco`, `imp_piezas_o`, `imp_piezas_d`, `observaciones`) VALUES
(1, 3, 23, 123123, 213213, 123312, 123213, 231312, 'Dañado por poco');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagen_contenedor`
--

CREATE TABLE IF NOT EXISTS `imagen_contenedor` (
  `id_img_c` int(11) NOT NULL AUTO_INCREMENT,
  `id_cont` int(11) NOT NULL,
  `codigo` varchar(250) NOT NULL,
  PRIMARY KEY (`id_img_c`),
  KEY `FK_CONTENEDOR_POSEE_IMAGENES` (`id_cont`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Representa las imagenes que se obtienen en la inspecci�n del' AUTO_INCREMENT=33 ;

--
-- Volcado de datos para la tabla `imagen_contenedor`
--

INSERT INTO `imagen_contenedor` (`id_img_c`, `id_cont`, `codigo`) VALUES
(1, 1, 'C:\\wamp\\www\\conexport\\data\\uploads\\consolidacion\\2014-07-25\\1\\DSCN0123.JPG'),
(2, 1, 'C:\\wamp\\www\\conexport\\data\\uploads\\consolidacion\\2014-07-25\\1\\DSCN0124.JPG'),
(3, 1, 'C:\\wamp\\www\\conexport\\data\\uploads\\consolidacion\\2014-07-25\\1\\DSCN0125.JPG'),
(4, 1, 'C:\\wamp\\www\\conexport\\data\\uploads\\consolidacion\\2014-07-25\\1\\DSCN0126.JPG'),
(5, 2, 'C:\\wamp\\www\\conexport\\data\\uploads\\consolidacion\\2014-07-25\\2\\DSCN0127.JPG'),
(6, 2, 'C:\\wamp\\www\\conexport\\data\\uploads\\consolidacion\\2014-07-25\\2\\DSCN0128.JPG'),
(7, 2, 'C:\\wamp\\www\\conexport\\data\\uploads\\consolidacion\\2014-07-25\\2\\DSCN0129.JPG'),
(8, 2, 'C:\\wamp\\www\\conexport\\data\\uploads\\consolidacion\\2014-07-25\\2\\DSCN0130.JPG'),
(9, 2, 'C:\\wamp\\www\\conexport\\data\\uploads\\consolidacion\\2014-07-25\\2\\DSCN0131.JPG'),
(10, 2, 'C:\\wamp\\www\\conexport\\data\\uploads\\consolidacion\\2014-07-25\\2\\DSCN0132.JPG'),
(11, 2, 'C:\\wamp\\www\\conexport\\data\\uploads\\consolidacion\\2014-07-25\\2\\DSCN0133.JPG'),
(12, 2, 'C:\\wamp\\www\\conexport\\data\\uploads\\consolidacion\\2014-07-25\\2\\DSCN0134.JPG'),
(13, 2, 'C:\\wamp\\www\\conexport\\data\\uploads\\consolidacion\\2014-07-25\\2\\DSCN0135.JPG'),
(14, 2, 'C:\\wamp\\www\\conexport\\data\\uploads\\consolidacion\\2014-07-25\\2\\DSCN0136.JPG'),
(15, 2, 'C:\\wamp\\www\\conexport\\data\\uploads\\consolidacion\\2014-07-25\\2\\DSCN0137.JPG'),
(16, 3, 'C:\\wamp\\www\\conexport\\data\\uploads\\desconsolidacion\\2014-07-25\\3\\DSCN0138.JPG'),
(17, 3, 'C:\\wamp\\www\\conexport\\data\\uploads\\desconsolidacion\\2014-07-25\\3\\DSCN0139.JPG'),
(18, 3, 'C:\\wamp\\www\\conexport\\data\\uploads\\desconsolidacion\\2014-07-25\\3\\DSCN0140.JPG'),
(19, 3, 'C:\\wamp\\www\\conexport\\data\\uploads\\desconsolidacion\\2014-07-25\\3\\DSCN0141.JPG'),
(20, 3, 'C:\\wamp\\www\\conexport\\data\\uploads\\desconsolidacion\\2014-07-25\\3\\DSCN0142.JPG'),
(21, 3, 'C:\\wamp\\www\\conexport\\data\\uploads\\desconsolidacion\\2014-07-25\\3\\DSCN0143.JPG'),
(22, 3, 'C:\\wamp\\www\\conexport\\data\\uploads\\desconsolidacion\\2014-07-25\\3\\DSCN0144.JPG'),
(23, 3, 'C:\\wamp\\www\\conexport\\data\\uploads\\desconsolidacion\\2014-07-25\\3\\DSCN0145.JPG'),
(24, 3, 'C:\\wamp\\www\\conexport\\data\\uploads\\desconsolidacion\\2014-07-25\\3\\DSCN0146.JPG'),
(25, 3, 'C:\\wamp\\www\\conexport\\data\\uploads\\desconsolidacion\\2014-07-25\\3\\DSCN0148.JPG'),
(26, 3, 'C:\\wamp\\www\\conexport\\data\\uploads\\desconsolidacion\\2014-07-25\\3\\DSCN0150.JPG'),
(27, 3, 'C:\\wamp\\www\\conexport\\data\\uploads\\desconsolidacion\\2014-07-25\\3\\DSCN0151.JPG'),
(28, 3, 'C:\\wamp\\www\\conexport\\data\\uploads\\desconsolidacion\\2014-07-25\\3\\DSCN0152.JPG'),
(29, 3, 'C:\\wamp\\www\\conexport\\data\\uploads\\desconsolidacion\\2014-07-25\\3\\DSCN0153.JPG'),
(30, 3, 'C:\\wamp\\www\\conexport\\data\\uploads\\desconsolidacion\\2014-07-25\\3\\DSCN0154.JPG'),
(31, 3, 'C:\\wamp\\www\\conexport\\data\\uploads\\desconsolidacion\\2014-07-25\\3\\DSCN0155.JPG'),
(32, 3, 'C:\\wamp\\www\\conexport\\data\\uploads\\desconsolidacion\\2014-07-25\\3\\DSCN0156.JPG');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagen_lote`
--

CREATE TABLE IF NOT EXISTS `imagen_lote` (
  `id_img_l` int(11) NOT NULL AUTO_INCREMENT,
  `id_lote` int(11) NOT NULL,
  `codigo` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id_img_l`),
  KEY `FK_LOTE_POSEE_IMAGEN` (`id_lote`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Representa las imagenes que se obtienen en la inspecci�n del' AUTO_INCREMENT=14 ;

--
-- Volcado de datos para la tabla `imagen_lote`
--

INSERT INTO `imagen_lote` (`id_img_l`, `id_lote`, `codigo`) VALUES
(1, 4, 'C:\\wamp\\www\\conexport\\data\\uploads\\daños\\2014-07-25\\\\DSCN0129.JPG'),
(2, 4, 'C:\\wamp\\www\\conexport\\data\\uploads\\daños\\2014-07-25\\\\DSCN0189.JPG'),
(3, 4, 'C:\\wamp\\www\\conexport\\data\\uploads\\daños\\2014-07-25\\\\DSCN0193.JPG'),
(4, 4, 'C:\\wamp\\www\\conexport\\data\\uploads\\daños\\2014-07-25\\\\DSCN0194.JPG'),
(5, 4, 'C:\\wamp\\www\\conexport\\data\\uploads\\daños\\2014-07-25\\\\DSCN0198.JPG'),
(6, 5, 'C:\\wamp\\www\\conexport\\data\\uploads\\diferencias\\2014-07-25\\\\DSCN0189.JPG'),
(7, 5, 'C:\\wamp\\www\\conexport\\data\\uploads\\diferencias\\2014-07-25\\\\DSCN0190.JPG'),
(8, 5, 'C:\\wamp\\www\\conexport\\data\\uploads\\diferencias\\2014-07-25\\\\DSCN0191.JPG'),
(9, 5, 'C:\\wamp\\www\\conexport\\data\\uploads\\diferencias\\2014-07-25\\\\DSCN0192.JPG'),
(10, 5, 'C:\\wamp\\www\\conexport\\data\\uploads\\diferencias\\2014-07-25\\\\DSCN0193.JPG'),
(11, 5, 'C:\\wamp\\www\\conexport\\data\\uploads\\diferencias\\2014-07-25\\\\DSCN0194.JPG'),
(12, 5, 'C:\\wamp\\www\\conexport\\data\\uploads\\diferencias\\2014-07-25\\\\DSCN0195.JPG'),
(13, 5, 'C:\\wamp\\www\\conexport\\data\\uploads\\diferencias\\2014-07-25\\\\DSCN0196.JPG');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inspeccion_contenedor`
--

CREATE TABLE IF NOT EXISTS `inspeccion_contenedor` (
  `id_ic` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL,
  `rut` varchar(12) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `id_cont` int(11) NOT NULL,
  `turno` int(11) NOT NULL,
  `observaciones` varchar(250) NOT NULL,
  `tipo` varchar(50) NOT NULL,
  PRIMARY KEY (`id_ic`),
  KEY `FK_INSPECCION_ES_REALIZADA_A_CONTENEDOR` (`id_cont`),
  KEY `FK_USUARIO_REALIZA_INSPECCION_CONTENEDOR` (`id_usuario`,`rut`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Representa al objeto inspeccion de contenedor, que a su vez ' AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `inspeccion_contenedor`
--

INSERT INTO `inspeccion_contenedor` (`id_ic`, `id_usuario`, `rut`, `fecha`, `hora`, `id_cont`, `turno`, `observaciones`, `tipo`) VALUES
(1, 1, '16.140.908-1', '2014-07-25', '03:03:25', 1, 2, 'Aut. en terreno por don J.C. Del Pino', 'consolidacion'),
(2, 1, '16.140.908-1', '2014-07-25', '05:26:33', 2, 1, 'Dañado', 'consolidacion'),
(3, 1, '16.140.908-1', '2014-07-25', '05:31:11', 3, 1, 'Dañado por poco', 'desconsolidacion');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inspeccion_lote`
--

CREATE TABLE IF NOT EXISTS `inspeccion_lote` (
  `id_il` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL,
  `rut` varchar(12) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `id_lote` int(11) NOT NULL,
  `turno` int(11) NOT NULL,
  `observaciones` varchar(250) NOT NULL,
  `tipo` varchar(50) NOT NULL,
  PRIMARY KEY (`id_il`),
  KEY `FK_INSPECCION_ES_APLICADA_A_LOTE` (`id_lote`),
  KEY `FK_USUARIO_REALIZA_INSPECCION_DE_LOTE` (`id_usuario`,`rut`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Representa al objeto inspecci�n de lote, que a su vez contie' AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `inspeccion_lote`
--

INSERT INTO `inspeccion_lote` (`id_il`, `id_usuario`, `rut`, `fecha`, `hora`, `id_lote`, `turno`, `observaciones`, `tipo`) VALUES
(1, 1, '16.140.908-1', '2014-07-25', '05:41:33', 4, 1, 'Dañado', 'daños'),
(2, 1, '16.140.908-1', '2014-07-25', '05:53:32', 5, 1, 'Dañado por poco', 'diferencias');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lote`
--

CREATE TABLE IF NOT EXISTS `lote` (
  `id_lote` int(11) NOT NULL AUTO_INCREMENT,
  `id_cliente` int(11) NOT NULL,
  `rut_cliente` varchar(15) NOT NULL,
  `id_material` int(11) NOT NULL,
  `id_cont` int(11) DEFAULT NULL,
  `nro_bodega` int(11) NOT NULL,
  `id_nave` int(11) NOT NULL,
  `numero_entrega` varchar(50) DEFAULT NULL,
  `destino` varchar(50) NOT NULL,
  `codigo_sap` varchar(50) DEFAULT NULL,
  `numero_lote` varchar(50) NOT NULL,
  `caracteristicas` varchar(50) NOT NULL,
  `pieza_danada` int(11) DEFAULT NULL,
  `pieza_paquete` int(11) DEFAULT NULL,
  `estado` varchar(50) NOT NULL,
  PRIMARY KEY (`id_lote`),
  KEY `FK_LOTE_CONTIENE_MATERIAL` (`id_material`),
  KEY `FK_LOTE_ES_ASIGNADO_A_CONTENEDOR` (`id_cont`),
  KEY `FK_LOTE_PERTENECE_A_CLIENTE` (`id_cliente`,`rut_cliente`),
  KEY `FK_LOTE_PERTENECE_A_BODEGA` (`nro_bodega`),
  KEY `FK_LOTE_ES_TRANSPORTADO_POR_NAVE` (`id_nave`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Objeto que contiene la informaci�n correspondiente a los lot' AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `lote`
--

INSERT INTO `lote` (`id_lote`, `id_cliente`, `rut_cliente`, `id_material`, `id_cont`, `nro_bodega`, `id_nave`, `numero_entrega`, `destino`, `codigo_sap`, `numero_lote`, `caracteristicas`, `pieza_danada`, `pieza_paquete`, `estado`) VALUES
(1, 1, '93.458.000-1', 2, 1, 1, 2, '803777946', 'Estados unidos', NULL, '7000403812', 'Aut. en terreno por don J.C. Del Pino', 2, 720, 'Dañada'),
(2, 1, '93.458.000-1', 1, 2, 1, 1, 'ASDASCH3dfsd', 'Estados unidos2', NULL, '21321312', 'Dañado', 2, 21321312, 'Dañada'),
(3, 1, '93.458.000-1', 2, 3, 1, 1, 'ASDASCH3dfsd', 'Estados unidos', NULL, 'sdfsd43', 'Dañado por poco', NULL, 21321312, 'Sin daños'),
(4, 1, '93.458.000-1', 2, NULL, 1, 1, 'ASDASCH3dfsd', 'Estados unidos', 'q2q313123', 'sdfsd43', 'Dañado', 2, 21321312, 'Esperando autorizacion'),
(5, 1, '93.458.000-1', 2, NULL, 1, 1, 'ASDASCH3dfsda', 'Estados unidos', 'q2q313123a', 'sdfsd43', 'Dañado por poco', NULL, NULL, 'Esperando autorizacion');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `material`
--

CREATE TABLE IF NOT EXISTS `material` (
  `id_material` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `codigo` varchar(50) NOT NULL,
  PRIMARY KEY (`id_material`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Objeto que contiene los diferentes acciones e informaci�n de' AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `material`
--

INSERT INTO `material` (`id_material`, `nombre`, `codigo`) VALUES
(1, 'Molduras', 'Mol'),
(2, 'Molduras MDF', 'Mol mdf');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nave`
--

CREATE TABLE IF NOT EXISTS `nave` (
  `id_nave` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(40) NOT NULL,
  `codigo` varchar(50) NOT NULL,
  PRIMARY KEY (`id_nave`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Objeto que contiene la informaci�n de las naves que realizan' AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `nave`
--

INSERT INTO `nave` (`id_nave`, `nombre`, `codigo`) VALUES
(1, 'Emma', 'EMMA'),
(2, 'Ornella', 'ORNELLA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `rut` varchar(12) NOT NULL,
  `supervisor_id` int(11) DEFAULT NULL,
  `supervisor_rut` varchar(12) DEFAULT NULL,
  `correo` varchar(50) NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `fono` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  PRIMARY KEY (`id_usuario`,`rut`),
  KEY `FK_USUARIO_SUPERVISA_A_USUARIO` (`supervisor_id`,`supervisor_rut`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Objeto que contiene los diferentes usuarios e informaci�n so' AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nombre`, `apellido`, `rut`, `supervisor_id`, `supervisor_rut`, `correo`, `tipo`, `fono`, `password`) VALUES
(1, 'Juan', 'Perez', '16.140.908-1', NULL, NULL, 'juanperez@gmail.com', 'gerente', '56957386368', '$2y$10$YWxnb3JpdG1vX2NpZnJhZ.Fa5EhB592MhM1cybwTc.TbjYKXNug2C'),
(2, 'cristian', 'nores', '163269694', NULL, NULL, 'cristian.nores@gmail.com', 'supervisor', '56957386368', '$2y$10$YWxnb3JpdG1vX2NpZnJhZ.Fa5EhB592MhM1cybwTc.TbjYKXNug2C');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `imagen_contenedor`
--
ALTER TABLE `imagen_contenedor`
  ADD CONSTRAINT `FK_CONTENEDOR_POSEE_IMAGENES` FOREIGN KEY (`id_cont`) REFERENCES `contenedor` (`id_cont`);

--
-- Filtros para la tabla `imagen_lote`
--
ALTER TABLE `imagen_lote`
  ADD CONSTRAINT `FK_LOTE_POSEE_IMAGEN` FOREIGN KEY (`id_lote`) REFERENCES `lote` (`id_lote`);

--
-- Filtros para la tabla `inspeccion_contenedor`
--
ALTER TABLE `inspeccion_contenedor`
  ADD CONSTRAINT `FK_INSPECCION_ES_REALIZADA_A_CONTENEDOR` FOREIGN KEY (`id_cont`) REFERENCES `contenedor` (`id_cont`),
  ADD CONSTRAINT `FK_USUARIO_REALIZA_INSPECCION_CONTENEDOR` FOREIGN KEY (`id_usuario`, `rut`) REFERENCES `usuario` (`id_usuario`, `rut`);

--
-- Filtros para la tabla `inspeccion_lote`
--
ALTER TABLE `inspeccion_lote`
  ADD CONSTRAINT `FK_INSPECCION_ES_APLICADA_A_LOTE` FOREIGN KEY (`id_lote`) REFERENCES `lote` (`id_lote`),
  ADD CONSTRAINT `FK_USUARIO_REALIZA_INSPECCION_DE_LOTE` FOREIGN KEY (`id_usuario`, `rut`) REFERENCES `usuario` (`id_usuario`, `rut`);

--
-- Filtros para la tabla `lote`
--
ALTER TABLE `lote`
  ADD CONSTRAINT `FK_LOTE_CONTIENE_MATERIAL` FOREIGN KEY (`id_material`) REFERENCES `material` (`id_material`),
  ADD CONSTRAINT `FK_LOTE_ES_ASIGNADO_A_CONTENEDOR` FOREIGN KEY (`id_cont`) REFERENCES `contenedor` (`id_cont`),
  ADD CONSTRAINT `FK_LOTE_ES_TRANSPORTADO_POR_NAVE` FOREIGN KEY (`id_nave`) REFERENCES `nave` (`id_nave`),
  ADD CONSTRAINT `FK_LOTE_PERTENECE_A_BODEGA` FOREIGN KEY (`nro_bodega`) REFERENCES `bodega` (`nro_bodega`),
  ADD CONSTRAINT `FK_LOTE_PERTENECE_A_CLIENTE` FOREIGN KEY (`id_cliente`, `rut_cliente`) REFERENCES `cliente` (`id_cliente`, `rut_cliente`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `FK_USUARIO_SUPERVISA_A_USUARIO` FOREIGN KEY (`supervisor_id`, `supervisor_rut`) REFERENCES `usuario` (`id_usuario`, `rut`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
