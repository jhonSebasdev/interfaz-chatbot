-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.4.32-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win64
-- HeidiSQL Versión:             12.10.0.7000
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura de base de datos para cooperativas
CREATE DATABASE IF NOT EXISTS `cooperativas` /*!40100 DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci */;
USE `cooperativas`;

-- Volcando estructura para tabla cooperativas.coop_acreedor
CREATE TABLE IF NOT EXISTS `coop_acreedor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fideicomiso` varchar(250) DEFAULT NULL,
  `cooperativa` varchar(250) DEFAULT NULL,
  `cedula` varchar(10) DEFAULT NULL,
  `nombre` varchar(250) DEFAULT NULL,
  `tipo` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci COMMENT='datos de los acreedores ';

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla cooperativas.coop_proveedor
CREATE TABLE IF NOT EXISTS `coop_proveedor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fideicomiso` varchar(20) DEFAULT NULL,
  `cooperativa` varchar(18) DEFAULT NULL,
  `cedula` varchar(13) DEFAULT NULL,
  `nombre` varchar(37) DEFAULT NULL,
  `tipo` varchar(8) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla cooperativas.menu
CREATE TABLE IF NOT EXISTS `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `imagen` varchar(100) DEFAULT NULL,
  `texto` varchar(255) DEFAULT NULL,
  `href` varchar(100) DEFAULT NULL,
  `estado` int(11) DEFAULT 1,
  `onclick` varchar(100) DEFAULT NULL,
  `submenu` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla cooperativas.nivel2
CREATE TABLE IF NOT EXISTS `nivel2` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `submenu_padre` varchar(100) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `texto` text NOT NULL,
  `tipo` varchar(20) NOT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `href` varchar(100) DEFAULT NULL,
  `onclick` varchar(100) DEFAULT NULL,
  `submenu` varchar(100) NOT NULL,
  `estado` tinyint(1) DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla cooperativas.usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- La exportación de datos fue deseleccionada.

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;

INSERT INTO `menu` (`id`, `nombre`, `imagen`, `texto`, `href`, `estado`, `onclick`, `submenu`) VALUES
(10, 'deudor', '../images/logo.png', '¿Es DEUDOR de las cooperativas liquidadas y actualmente extintas que constituyeron fideicomiso en la CONAFIPS?', 'submt_deudor', 1, 'onclick_deudor', 'menu_deudor'),
(11, 'acreedor', '../images/logo.png', '¿Es ACREEDOR de las cooperativas liquidadas y actualmente extintas que constituyeron fideicomiso en CONAFIPS?', 'submt_acreedor', 1, 'onclick_acreedor', 'menu_acreedor');