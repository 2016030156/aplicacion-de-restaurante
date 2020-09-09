-- MySQL dump 10.13  Distrib 8.0.20, for Win64 (x86_64)
--
-- Host: localhost    Database: serchos
-- ------------------------------------------------------
-- Server version	8.0.13

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */; 
use serchos2;
--
-- Table structure for table `comandas`
--

DROP TABLE IF EXISTS `comandas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `comandas` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador del registro',
  `id_mesero` int(11) NOT NULL COMMENT 'Id del mesero que levanto la comanda',
  `id_mesa` int(11) NOT NULL COMMENT 'Id de la mesa donde se levanto la comanda',
  `total` float DEFAULT NULL COMMENT 'Monto total de la comanda',
  `observaciones` text COMMENT 'Texto de observaciones extras de la comanda',
  `fecha` date DEFAULT NULL COMMENT 'Fecha de emisión de la comanda',
  `hora` time DEFAULT NULL COMMENT 'Hora de emisión de la comanda',
  `status` tinyint(4) DEFAULT NULL COMMENT '0 = Cancelada, 1 = Nueva, 2 = Preparada, 3 = Entregada, 4 = Pagada',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comandas`
--

LOCK TABLES `comandas` WRITE;
/*!40000 ALTER TABLE `comandas` DISABLE KEYS */;
INSERT INTO `comandas` VALUES (1,20,2,20,'Hola','2019-07-15','02:41:00',4),(2,20,1,10,'Hola 2','2019-07-15','19:11:00',0),(3,20,1,30,'Sin observaciones','2019-08-15','20:20:20',0),(4,20,1,66,'Sin observaciones','2019-08-14','20:44:09',3),(5,20,1,875,'Sin observaciones','2019-08-15','20:49:39',3),(6,20,1,481.5,'Sin observaciones','2019-08-16','20:51:53',2),(7,20,1,291,'Sin observaciones','2019-08-16','11:24:25',2),(8,20,1,90,'Sin observaciones','2019-08-16','11:37:57',2),(9,20,1,291,'Sin observaciones','2019-08-16','19:33:32',2),(10,20,1,291,'Sin observaciones','2019-08-17','11:48:05',4),(11,20,1,291,'Sin observaciones','2019-08-17','14:00:08',4),(12,20,1,291,'Sin observaciones','2019-08-17','17:29:59',0),(13,20,1,292,'Sin observaciones','2019-08-18','11:49:09',4),(14,20,1,292,'Sin observaciones','2019-08-18','12:54:35',1),(15,1,1,201,'nada','2020-05-15','00:00:00',1),(16,1,1,201,'nada','2020-05-15','00:00:00',1),(17,1,1,201,'nada','2020-05-15','00:00:00',1),(18,1,2,90,'a','2020-05-15','00:00:00',1),(19,1,2,90,'a','2020-05-15','00:00:00',1),(20,1,1,201,'nada','2020-05-15','00:00:00',1),(21,20,2,300,'nada','2020-08-11','00:00:00',1),(22,20,1,45,'nada','2020-08-11','00:00:00',1),(23,20,1,200,'nada','2020-08-11','00:00:00',1),(24,20,1,291,'nada','2020-08-11','00:00:00',1),(25,20,2,291,'nada','2020-08-11','00:00:00',1),(26,20,2,291,'nada','2020-08-11','00:00:00',1),(27,20,2,200,'nada','2020-08-11','00:00:00',1),(28,20,1,300,'nada','2020-08-11','00:00:00',1),(29,20,1,300,'nada','2020-08-11','00:00:00',1),(30,20,1,300,'nada','2020-08-11','00:00:00',1),(31,20,1,300,'nada','2020-08-11','00:00:00',1),(32,20,1,300,'nada','2020-08-11','00:00:00',1),(33,20,1,300,'nada','2020-08-11','00:00:00',1);
/*!40000 ALTER TABLE `comandas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detalle_comandas`
--

DROP TABLE IF EXISTS `detalle_comandas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `detalle_comandas` (
  `id_comanda` int(11) NOT NULL COMMENT 'Id de la comanda de este detalle',
  `id_platillo` int(11) NOT NULL COMMENT 'Id del platillo de este detalle',
  `cantidad` int(11) DEFAULT NULL COMMENT 'Cantidad de platillos que incluye en el detalle',
  `precio` float DEFAULT NULL COMMENT 'Precio del platillo al mommento de la emisión de la comanda',
  `status` int(11) DEFAULT NULL COMMENT '1 = Preparado, 0 = no preparado'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detalle_comandas`
--

LOCK TABLES `detalle_comandas` WRITE;
/*!40000 ALTER TABLE `detalle_comandas` DISABLE KEYS */;
INSERT INTO `detalle_comandas` VALUES (1,3,1,10,1),(3,2,2,15,1),(2,3,5,20,1),(6,3,2,90,NULL),(6,2,3,100.5,NULL),(7,3,1,90,0),(7,2,2,100.5,0),(8,3,1,90,1),(8,2,2,100.5,0),(9,3,1,90,0),(9,2,2,100.5,0),(10,3,1,90,3),(10,2,2,100.5,3),(11,3,1,90,3),(11,2,2,100.5,3),(12,3,1,90,1),(12,2,2,100.5,1),(13,3,1,91,1),(13,2,2,100.5,1),(14,3,1,91,1),(14,2,2,100.5,1),(5,3,1,125,NULL),(5,3,1,125,NULL),(5,3,1,125,NULL),(5,3,1,125,NULL),(5,3,1,125,NULL),(5,3,1,125,NULL),(5,3,1,125,NULL),(5,3,1,125,1),(5,3,1,125,1),(3,3,1,125,1),(33,3,3,100,1);
/*!40000 ALTER TABLE `detalle_comandas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `horarios`
--

DROP TABLE IF EXISTS `horarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `horarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_mesa` int(11) NOT NULL,
  `hora_inicio` time NOT NULL,
  `hora_fin` time NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_mesa` (`id_mesa`),
  CONSTRAINT `horarios_ibfk_1` FOREIGN KEY (`id_mesa`) REFERENCES `mesas` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;


--
-- Dumping data for table `horarios`
--

LOCK TABLES `horarios` WRITE;
/*!40000 ALTER TABLE `horarios` DISABLE KEYS */;
INSERT INTO `horarios` VALUES (1,1,'09:00:00','10:00:00'),(2,1,'10:00:00','11:00:00'),(3,2,'11:00:00','12:00:00'),(4,2,'12:00:00','13:00:00'),(5,2,'13:00:00','14:00:00'),(6,2,'14:00:00','15:00:00'),(7,2,'15:00:00','16:00:00'),(8,2,'16:00:00','17:00:00'),(9,2,'17:00:00','18:00:00'),(10,2,'18:00:00','19:00:00'),(11,1,'19:00:00','20:00:00'),(12,1,'20:00:00','21:00:00');
/*!40000 ALTER TABLE `horarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary view structure for view `listar_comandas`
--

DROP TABLE IF EXISTS `listar_comandas`;
/*!50001 DROP VIEW IF EXISTS `listar_comandas`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `listar_comandas` AS SELECT 
 1 AS `id`,
 1 AS `id_mesero`,
 1 AS `id_mesa`,
 1 AS `total`,
 1 AS `observaciones`,
 1 AS `fecha`,
 1 AS `hora`,
 1 AS `status`,
 1 AS `num_pla`,
 1 AS `mesero`,
 1 AS `mesa`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `listar_detalle_comandas`
--

DROP TABLE IF EXISTS `listar_detalle_comandas`;
/*!50001 DROP VIEW IF EXISTS `listar_detalle_comandas`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `listar_detalle_comandas` AS SELECT 
 1 AS `id_comanda`,
 1 AS `id_platillo`,
 1 AS `cantidad`,
 1 AS `precio`,
 1 AS `status`,
 1 AS `platillo`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `listar_reservaciones`
--

DROP TABLE IF EXISTS `listar_reservaciones`;
/*!50001 DROP VIEW IF EXISTS `listar_reservaciones`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `listar_reservaciones` AS SELECT 
 1 AS `id`,
 1 AS `id_cliente`,
 1 AS `id_mesa`,
 1 AS `cant_mesa`,
 1 AS `hora_inicio`,
 1 AS `hora_fin`,
 1 AS `fecha`,
 1 AS `log`,
 1 AS `status`,
 1 AS `cliente`,
 1 AS `mesa`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `listar_usuarios`
--

DROP TABLE IF EXISTS `listar_usuarios`;
/*!50001 DROP VIEW IF EXISTS `listar_usuarios`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `listar_usuarios` AS SELECT 
 1 AS `id`,
 1 AS `nombre`,
 1 AS `paterno`,
 1 AS `materno`,
 1 AS `usuario`,
 1 AS `contra`,
 1 AS `id_perfil`,
 1 AS `create_at`,
 1 AS `status`,
 1 AS `perfil`*/;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `mesas`
--

DROP TABLE IF EXISTS `mesas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mesas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `hora_inicio` time DEFAULT NULL,
  `hora_fin` time DEFAULT NULL,
  `log` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(11) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mesas`
--

LOCK TABLES `mesas` WRITE;
/*!40000 ALTER TABLE `mesas` DISABLE KEYS */;
INSERT INTO `mesas` VALUES (1,'Mesa para 2',7,'09:00:00','16:00:00','2019-08-19 05:51:25',1),(2,'Mesa para 4',7,'09:00:00','18:00:00','2019-08-19 05:51:29',1);
/*!40000 ALTER TABLE `mesas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `modulos`
--

DROP TABLE IF EXISTS `modulos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `modulos` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador del registro',
  `nombre` varchar(45) DEFAULT NULL COMMENT 'Nombre del modulo',
  `indice` tinyint(4) DEFAULT NULL COMMENT 'Número que establece el orden de los modulos',
  `descripcion` varchar(245) DEFAULT NULL COMMENT 'Descripción del modulo',
  `id_padre` int(11) DEFAULT '0' COMMENT 'Id del modulo padre',
  `icon` varchar(45) DEFAULT NULL COMMENT 'Clase del icono',
  `url` varchar(45) DEFAULT NULL COMMENT 'Ruta del modulo',
  `status` tinyint(4) DEFAULT NULL COMMENT 'Estado del modulo (0 Inactivo, 1 Activo)',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `modulos`
--

LOCK TABLES `modulos` WRITE;
/*!40000 ALTER TABLE `modulos` DISABLE KEYS */;
INSERT INTO `modulos` VALUES (2,'Meseros',2,NULL,10,'fas fa-receipt','index.php/usuarios/index/meseros',1),(3,'Gerentes',3,NULL,10,'fas fa-user-tie','index.php/usuarios/index/gerentes',1),(4,'Cocineros',4,NULL,10,'fas fa-user-graduate','index.php/usuarios/index/cocineros',1),(5,'Cajeros',5,NULL,10,'fa fa-cash-register','index.php/usuarios/index/cajeros',1),(6,'Recepcionistas',6,NULL,10,'fa fa-clipboard','index.php/usuarios/index/recepcionistas',1),(7,'Clientes',7,NULL,10,'fa fa-user','index.php/usuarios/index/clientes',1),(8,'Platillos',8,NULL,11,'fa fa-apple','index.php/platillos',1),(9,'Mesas',9,NULL,11,'fa fa-chair','index.php/mesas',1),(10,'Usuarios',1,NULL,0,'fas fa-users',NULL,1),(11,'Restaurante',2,NULL,0,'fas fa-building',NULL,1),(12,'Reportes',3,NULL,0,'fas fa-file-alt',NULL,1),(13,'Reporte Diario',1,NULL,12,'fas fa-calendar-check','index.php/reportes/diario',1),(14,'Reporte de rango de fechas',2,NULL,12,'fas fa-calendar-week','index.php/reportes/rango',1),(15,'Historial de platillos',1,NULL,11,'fa fa-file-text','index.php/reportes/platillos',1),(16,'Historial de caja',2,NULL,11,'fa fa-money','index.php/reportes/caja',1),(17,'Comandas',6,NULL,11,'fas fa-comments','index.php/comandas',1),(18,'Reservaciones',5,NULL,0,'fas fa-clipboard','index.php/reservaciones',1);
/*!40000 ALTER TABLE `modulos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary view structure for view `modulos_padre`
--

DROP TABLE IF EXISTS `modulos_padre`;
/*!50001 DROP VIEW IF EXISTS `modulos_padre`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `modulos_padre` AS SELECT 
 1 AS `id`,
 1 AS `nombre`,
 1 AS `indice`,
 1 AS `descripcion`,
 1 AS `id_padre`,
 1 AS `icon`,
 1 AS `url`,
 1 AS `status`,
 1 AS `id_perfil`*/;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `perfiles`
--

DROP TABLE IF EXISTS `perfiles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `perfiles` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Idenficador del registro',
  `nombre` varchar(45) DEFAULT NULL COMMENT 'Nombre del perfil',
  `descripcion` varchar(245) DEFAULT NULL COMMENT 'Descripción del perfil',
  `status` tinyint(4) DEFAULT NULL COMMENT 'Estado del regisstro (0 Inactivo, 1 Activo',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `perfiles`
--

LOCK TABLES `perfiles` WRITE;
/*!40000 ALTER TABLE `perfiles` DISABLE KEYS */;
INSERT INTO `perfiles` VALUES (1,'Administrador','',1),(2,'Gerente','',1),(3,'Caja','',1),(4,'Recepcion','',1),(5,'Cocina','',1),(6,'Mesero','',1),(7,'Cliente','',1);
/*!40000 ALTER TABLE `perfiles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `perfiles_modulos`
--

DROP TABLE IF EXISTS `perfiles_modulos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `perfiles_modulos` (
  `id_perfil` int(11) NOT NULL COMMENT 'Id del perfil relacionado con el modulo',
  `id_modulo` int(11) NOT NULL COMMENT 'Id del modulo relacionado con el perfil'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `perfiles_modulos`
--

LOCK TABLES `perfiles_modulos` WRITE;
/*!40000 ALTER TABLE `perfiles_modulos` DISABLE KEYS */;
INSERT INTO `perfiles_modulos` VALUES (1,2),(1,3),(1,4),(1,5),(1,6),(1,7),(1,8),(1,9),(1,13),(1,14),(1,15),(1,16),(1,17),(1,10),(1,11),(1,12),(5,11),(5,17),(3,11),(3,17),(1,18),(7,18),(4,18),(6,17),(6,11),(2,2),(2,3),(2,4),(2,5),(2,6),(2,7),(2,8),(2,9),(2,10),(2,11),(2,12),(2,13),(2,14),(2,16),(2,17),(2,18);
/*!40000 ALTER TABLE `perfiles_modulos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `platillos`
--

DROP TABLE IF EXISTS `platillos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `platillos` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador del registro',
  `nombre` varchar(90) DEFAULT NULL COMMENT 'Nombre del platillo',
  `precio` float DEFAULT NULL COMMENT 'Precio del platillo',
  `create_at` date DEFAULT NULL COMMENT 'Fecha de creacion del registro',
  `status` tinyint(4) DEFAULT NULL COMMENT 'Estado del platillo (0 Inactivo, 1 Activo)',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `platillos`
--

LOCK TABLES `platillos` WRITE;
/*!40000 ALTER TABLE `platillos` DISABLE KEYS */;
INSERT INTO `platillos` VALUES (2,'quesadillas',20,'2019-04-18',1),(3,'pollo',100,'2029-04-23',1),(4,'enchiladas',97,'2029-04-23',1),(5,'torta',45,'2019-08-18',1),(6,'pastel chocolate',100,'2020-05-15',1),(7,'pasta',15,'2020-05-15',1),(8,'atun',30,'2020-05-15',1),(9,'pastel',50,'2020-05-15',1),(10,'pan',5,'2020-05-15',1);
/*!40000 ALTER TABLE `platillos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reservaciones`
--

DROP TABLE IF EXISTS `reservaciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `reservaciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Idenficadaor del registro',
  `id_cliente` int(11) NOT NULL COMMENT 'Idenficador del cliente',
  `id_mesa` int(11) NOT NULL COMMENT 'Id de la mesa para la reservacion',
  `cant_mesa` int(11) DEFAULT '1' COMMENT 'Cantidad de mesas reservadas',
  `hora_inicio` time DEFAULT NULL COMMENT 'Hora de inicio',
  `hora_fin` time DEFAULT NULL COMMENT 'Hora de fin',
  `fecha` date DEFAULT NULL COMMENT 'Fecha de la reservacion',
  `log` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(11) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reservaciones`
--

LOCK TABLES `reservaciones` WRITE;
/*!40000 ALTER TABLE `reservaciones` DISABLE KEYS */;
INSERT INTO `reservaciones` VALUES (1,25,1,3,'14:00:00','15:00:00','2019-08-18','2019-08-19 06:10:04',0),(2,25,1,4,'15:00:00','16:00:00','2019-08-18','2019-08-19 06:19:50',1),(3,25,1,7,'15:00:00','17:00:00','2019-08-19','2019-08-19 06:11:33',1),(4,26,1,1,'12:00:00','13:00:00','2019-08-19','2019-08-20 07:00:27',1),(5,25,1,1,'09:30:00','10:00:00','2019-08-22','2019-08-22 21:43:57',1),(6,25,1,7,'18:02:00','19:02:00','2019-08-25','2019-08-26 06:05:25',0),(8,25,1,7,'19:30:00','20:00:00','2019-08-25','2019-08-26 07:01:57',1),(9,26,1,5,'16:00:00','17:30:00','2019-08-25','2019-08-26 07:27:59',0),(10,30,1,1,'10:00:00','11:00:00','2020-05-15','2020-05-15 16:30:46',1),(11,25,2,1,'15:45:00','16:45:00','2020-05-15','2020-05-16 04:19:40',0),(12,30,1,1,'19:00:00','21:00:00','2020-05-16','2020-05-16 07:23:11',1),(13,25,1,1,'10:00:00','11:00:00','2020-08-10','2020-08-09 00:05:13',1),(14,25,1,1,'10:00:00','11:00:00','2020-08-10','2020-08-09 00:13:22',1),(15,25,2,1,'12:00:00','13:00:00','2020-08-10','2020-08-09 00:16:04',1),(16,25,2,1,'12:00:00','13:00:00','2020-08-10','2020-08-09 00:28:36',1),(17,25,2,1,'12:00:00','13:00:00','2020-08-12','2020-08-09 00:53:05',1),(18,25,2,1,'12:00:00','13:00:00','2020-08-12','2020-08-09 00:53:56',1),(25,25,2,1,'12:00:00','13:00:00','2020-08-12','2020-08-09 01:03:45',1),(26,25,2,1,'13:00:00','14:00:00','2020-08-12','2020-08-09 01:04:07',1),(27,25,2,1,'15:00:00','16:00:00','2020-08-13','2020-08-09 01:06:21',1),(28,25,2,1,'12:00:00','13:00:00','2020-08-12','2020-08-09 01:07:31',1),(29,25,2,1,'15:00:00','16:00:00','2020-08-18','2020-08-09 01:08:02',1),(30,25,1,1,'19:00:00','20:00:00','2020-08-18','2020-08-09 01:09:56',1),(31,25,2,1,'15:00:00','16:00:00','2020-08-19','2020-08-09 01:11:34',1);
/*!40000 ALTER TABLE `reservaciones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Idenficador del registro',
  `nombre` varchar(45) DEFAULT NULL COMMENT 'Nombre del mesero',
  `paterno` varchar(45) DEFAULT NULL COMMENT 'Apellido paterno del mesero',
  `materno` varchar(45) DEFAULT NULL COMMENT 'Apellido materno del mesero',
  `usuario` varchar(45) NOT NULL COMMENT 'Nombre del usuario para hacer login',
  `contra` varchar(245) NOT NULL COMMENT 'Contraseña del usaurio para hacer login',
  `id_perfil` int(11) NOT NULL COMMENT 'Identificador del tipo de empleado',
  `create_at` date DEFAULT NULL COMMENT 'Fecha de creacion de registro',
  `status` int(11) DEFAULT NULL COMMENT 'Estado del registro',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'sergio','lopez','guzman','admin','d033e22ae348aeb5660fc2140aec35850c4da997',1,'2009-12-06',1),(10,'cocina editado','paterno','materno','cocina','6c6e13daadc01238382916a871c00ea767d6887b',5,'2019-04-24',1),(11,'mario','marco','valentin','caja','862448c9b226294b7de620bdca6e0879e5ab0c66',3,'2019-04-24',1),(12,'recepcion','paterno','materno','recepcion','91efd07be5f94c20b1e619dfddbc318413567492',4,'2019-04-24',1),(20,'mesero editado 3','paterno','materno','mesero','5a280e11dcd2ad934af4dcb24b2fafc527aa550a',6,'2019-05-17',1),(24,'gerente','partern','matern','gerente','e0ffb90b074691c42ebd7b3cc39771b344c0083b',2,'2019-05-18',1),(25,'cliente','paterno','materno','cliente','d94019fd760a71edf11844bb5c601a4de95aacaf',7,'2019-07-13',1),(26,'carlos100','paterno','materno','carlos100','9f6f53fceeca7fa032f65459bac1aa47a55160c2',7,'2019-08-14',1),(27,'mesero','asd','asda','mesero2','5798b441222b5cde4a42570e94e453993727474a',6,'2019-08-17',0),(28,'cocina 2','gutierrez','lourdez','cocina2','3576ba59059314513f4764533ae9cebd1ef66c5f',5,'2019-08-17',1),(29,'mesero4','lopez','guzma','mesero4','contra',6,'2020-05-14',1),(30,'sergio','lopez','guzman','cliente1','d94019fd760a71edf11844bb5c601a4de95aacaf',7,'2020-05-15',1),(31,'juaquin','gutierrez','alvarado','mesero5','contraseña',6,'2020-05-15',1),(32,'luis','lopez','Hernandez','luis','contra',6,'2020-05-15',1),(33,'mario','lopez','gumaz','luis','contra',6,'2020-05-15',1),(34,'sergio','lopez','guzman','sergio12','f72b8794d3f268f4f770e8aaa0a6e71f0ff06a56',6,'2020-05-15',1);
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'serchos'
--

--
-- Dumping routines for database 'serchos'
--
/*!50003 DROP FUNCTION IF EXISTS `full_name` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` FUNCTION `full_name`(`id` INT) RETURNS text CHARSET latin1
BEGIN	
	declare completo varchar (150);
	select 
		concat(usu.nombre, " ", usu.paterno, " ", usu.materno) into completo
	from usuarios usu 
	where usu.id = id;
	return completo;
    END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP FUNCTION IF EXISTS `get_tipo_mesa` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` FUNCTION `get_tipo_mesa`(`id_mesa` INT) RETURNS text CHARSET latin1
BEGIN
	declare tipo varchar (20);
	select if(mesas.tipo_mesa = 1, "Para 2", "Para 4") into tipo from mesas where mesas.id = id_mesa;
	return tipo;
    END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `actComanda` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `actComanda`(`idComanda` INT)
BEGIN
	UPDATE comandas com
	SET com.total = (
		SELECT SUM(det.cantidad * det.precio)
		FROM detalle_comandas det 
		WHERE det.id_comanda = com.id and det.status = 1)
	WHERE com.id = idComanda;
    END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `add_empleado` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `add_empleado`(`nombre` VARCHAR(45), `paterno` VARCHAR(45), `materno` VARCHAR(45), `usuario` VARCHAR(45), `contra` VARCHAR(50), `id_perfil` INT)
BEGIN
	INSERT INTO usuarios (nombre, paterno, materno, usuarios, contra, id_perfil)
		VALUES (nombre, paterno, materno, usuario, contra, id_perfil);
	SELECT LAST_INSERT_ID() AS id;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `add_platillo_detalle` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `add_platillo_detalle`(`id_comanda` INT, `id_platillo` INT, `cantidad` INT, `precio` FLOAT)
BEGIN
	INSERT INTO detalle_comandas (id_comanda, id_platillo, cantidad, precio)
		VALUES (id_comanda, id_platillo, cantidad, precio);
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `asigar_mesa` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `asigar_mesa`(`id_mesa` INT)
BEGIN
	UPDATE mesas SET mesas.status = 2 WHERE mesas.id = id_mesa;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `asignar_mesa` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `asignar_mesa`(`id_mesa` INT)
begin
	update mesas set status = 2 where mesas.id = id_mesa;
end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `cambiar_status_detalle` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `cambiar_status_detalle`(`id_comanda` INT, `id_platillo` INT, `nuevo_status` INT)
begin
	update detalle_comandas det set det.status = nuevo_status where det.id_comanda = id_comanda
		and det.id_platillo = id_platillo;
end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `comandas_cocina` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `comandas_cocina`()
begin
	select * from listar_comandas where status = 1;
end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `comandas_listas` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `comandas_listas`()
BEGIN
	SELECT com.* 
	FROM comandas com
	WHERE com.id NOT IN (
		SELECT com.id
		FROM comandas com
			JOIN detalle_comandas det ON det.id_comanda = com.id
		WHERE det.status = 1 OR det.status = 2
	);
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `cuenta_por_mesa` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `cuenta_por_mesa`(`id_mesa` INT)
BEGIN
	SELECT com.*, det.id_platillo, pla.nombre as platillo
	FROM comandas com
		JOIN detalle_comandas det ON det.id_comanda = com.id
		join platillos pla on pla.id = det.id_platillo
	WHERE com.id_mesa = id_mesa and (com.status = 1 or com.status = 2 or com.status = 3)
		and com.fecha = date(now());
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `del_platillo_comanda` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `del_platillo_comanda`(`id_comanda` INT, `id_platillo` INT)
BEGIN
	DELETE FROM detalle_comandas 
	WHERE detalle_comandas.id_comanda = id_comanda 
		AND detalle_comandas.id_platillo = id_platillo;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `edit_platillo_comanda` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `edit_platillo_comanda`(`id_comanda` INT, `id_platillo` INT, `cantidad` INT, `precio` FLOAT)
BEGIN
	UPDATE detalle_comandas det SET det.id_platillo = id_platillo,
		det.cantidad = cantidad, det.precio = precio
	WHERE det.id_comanda = id_comanda;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `get_mesas_disponibles` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_mesas_disponibles`(`fecha` DATE)
begin
	SELECT hora.*, mesa.tipo_mesa
	FROM horas_mesas hora
		JOIN mesas mesa ON mesa.id = hora.id_mesa
	WHERE mesa.status = 1 
		AND hora.id NOT IN (
			SELECT res.id_hora 
			FROM listar_reservaciones res
			WHERE res.fecha = DATE(fecha) AND res.status = 1
		);
end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `historial_caja` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `historial_caja`(`fecha` DATE)
begin
	select com.*, 
		concat(usu.nombre, " ", usu.paterno, " ", usu.materno) as mesero,
		if(mesa.tipo_mesa = 1, "Mesa para 2", "Mesa para 4") as mesa
	from comandas com
	where com.fecha = fecha;
end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `historial_platillos` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `historial_platillos`(`fecha` DATE)
BEGIN
	SELECT det.*
	FROM listar_detalle_comandas det
		JOIN listar_comandas com ON com.id = det.id_comanda
	WHERE com.fecha = DATE(fecha);
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `liberar_mesa` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `liberar_mesa`(`id_mesa` INT)
begin
	update mesas set status = 1 where mesas.id = id_mesa;
end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `llenar_horarios_mesa` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `llenar_horarios_mesa`(`id_mesa` INT)
BEGIN
	insert into horas_mesas (id_mesa, hora_inicio, hora_fin) values (id_mesa, time("09:00:00"), time ("11:00:00")),
		(id_mesa, TIME("11:00:00"), TIME ("13:00:00")), (id_mesa, TIME("13:00:00"), TIME ("15:00:00")),
		(id_mesa, TIME("15:00:00"), TIME ("17:00:00")), (id_mesa, TIME("17:00:00"), TIME ("19:00:00"));
    END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `login` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `login`(`usu` VARCHAR(45), `contra` VARCHAR(50))
begin
	select * from listar_usuarios lis where lis.usuario = usu and lis.contra = contra;
end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `login_sha1` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `login_sha1`(`usu` VARCHAR(45), `contra` VARCHAR(50))
begin
	SELECT * FROM listar_usuarios lis WHERE lis.usuario = usu AND lis.contra = SHA1(contra);
end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `mesasDisponibles` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `mesasDisponibles`(`idMesa` INT, `horaInicio` TIME, `horaFin` TIME, `fecha` DATE)
begin
	declare mesasTotales int;
	declare mesasReservadas int;
	declare mesas int;
	set mesasReservadas = 0;
	set mesasTotales = 0;
	set mesas = 0;
	select cantidad into mesasTotales from mesas where id = idMesa and status = 1;
	select sum(cant_mesa) into mesasReservadas
	from reservaciones res
	where res.status = 1 and id_mesa = idMesa AND res.fecha = fecha and
		(((horaInicio >= hora_inicio AND horaFin < hora_fin)
		OR (hora_inicio >=  horaInicio AND hora_fin < horaFin))
		OR 
		((horaInicio >= hora_inicio AND horaInicio < hora_fin) 
		OR (horaFin > hora_inicio AND horaFin <= hora_fin)));
	select mesasTotales - ifnull(mesasReservadas, 0) into mesas;
	if (mesas < 0) then
		set mesas = 0;
	end if;
	select mesas;
end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `nueva_comanda` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `nueva_comanda`(`id_mesero` INT, `id_mesa` INT, `observaciones` TEXT, `total` FLOAT)
begin
	insert into comandas (id_mesero, id_mesa, total, observaciones, fecha, hora, status) values 
		(id_mesero, id_mesa, total, observaciones, date(now()), date(now()), 1);
	select last_insert_id() as id;
end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `nueva_comandaws` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `nueva_comandaws`(`id_mesero` INT, `id_mesa` INT, `observaciones` TEXT)
BEGIN
	INSERT INTO comandas (id_mesero, id_mesa, observaciones, fecha, hora, STATUS) VALUES 
		(id_mesero, id_mesa, observaciones, DATE(NOW()), CURTIME(), 1);
	SELECT LAST_INSERT_ID();
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `nueva_mesa` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `nueva_mesa`(`tipo_mesa` INT)
begin
	declare id_mesa int;
	insert into mesas (tipo_mesa, status) values (tipo_mesa, 1);	
	select last_insert_id() into id_mesa;
	call llenar_horarios_mesa (id_mesa);
	select id_mesa as id;
end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `nuevo_detalle_comanda` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `nuevo_detalle_comanda`(`id_comanda` INT, `id_platillo` INT, `cantidad` INT, `precio` FLOAT)
BEGIN
	declare total int;
	INSERT INTO detalle_comandas (id_comanda, id_platillo, cantidad, precio) VALUES 
		(id_comanda, id_platillo, cantidad, precio);
	SELECT SUM(precio * cantidad) into total
	FROM comandas com
		JOIN detalle_comandas det ON det.id_comanda = com.id
	WHERE com.id = id_comanda;
	update comandas com set com.total = total where com.id = id_comanda;	
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `nuevo_platillo` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `nuevo_platillo`(`nombre` VARCHAR(45), `precio` FLOAT)
begin
	insert into platillos (nombre, precio, create_at, status) values
		(nombre, precio, date(now()), 1);
	select last_insert_id();
end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `nuevo_usuario` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `nuevo_usuario`(`nombre` VARCHAR(45), `paterno` VARCHAR(45), `materno` VARCHAR(45), `usuario` VARCHAR(45), `contra` VARCHAR(50), `id_perfil` INT)
begin
	insert into usuarios (nombre, paterno, materno, usuario, contra, id_perfil) values
		(nombre, paterno, materno, usuario, sha1(contra), id_perfil);
	select last_insert_id();
end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `puedoReservar` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `puedoReservar`(`idTipoMesa` INT, `idTipoHora` INT, `fecha` VARCHAR(10))
begin
	select res.* 
	from reservaciones res
	where fecha = date(fecha)
		and res.id_hora in (SELECT hora.id
			FROM mesas mesa 
				JOIN horas_mesas hora ON hora.id_mesa = mesa.id
			where hora.tipo = idTipoHora and mesa.tipo_mesa = idTipoMesa
			);
end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `reporte_diario` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `reporte_diario`()
BEGIN
	SELECT com.*
    FROM listar_comandas com
    WHERE com.fecha = DATE(NOW());
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `reporte_diariows` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `reporte_diariows`()
BEGIN
	SELECT comandas.*, usuarios.nombre
	FROM comandas, usuarios
	WHERE comandas.id_mesero = usuarios.id && fecha = DATE(NOW());
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `reporte_rango` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `reporte_rango`(`inicio` DATE, `fin` DATE)
BEGIN
SELECT com.*
    FROM listar_comandas com
    WHERE com.fecha >= DATE(inicio)
        AND com.fecha <= DATE(fin);
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `reporte_rangows` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `reporte_rangows`(`inicio` DATE, `fin` DATE)
BEGIN
	SELECT comandas.*, usuarios.nombre
	FROM comandas, usuarios
	WHERE  comandas.id_mesero = usuarios.id  && (fecha >= DATE(inicio)
		AND fecha <= DATE(fin));
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `reservar` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `reservar`(`id_cliente` INT, `tipo_mesa` INT, `fecha` DATE, `hora_inicio` TIME, `hora_fin` TIME)
BEGIN
	declare id_hora_libre int;
	select hora.id into id_hora_libre
	from horas_mesas hora
		join mesas mesa on mesa.id = hora.id_mesa
	where mesa.status = 1 
		and hora.hora_inicio = time(hora_inicio)
		and hora.hora_fin = time(hora_fin)
		and mesa.tipo_mesa = tipo_mesa
		and hora.id not in (
			select res.id_hora 
			from listar_reservaciones res
			where res.fecha = date(fecha) and res.status = 1
		)
	limit 1;
	insert into reservaciones (id_hora, id_cliente, fecha, log_date, log_time, status) values
		(id_hora_libre, id_cliente, fecha, date(Now()), time(now()), 1);
    END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `reservarws` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`skip-grants user`@`skip-grants host` PROCEDURE `reservarws`(`id_cliente` INT, `id_mesa` INT, `fecha` DATE, `hora_inicio` TIME, `hora_fin` TIME)
BEGIN
	declare id_hora_libre int;
	select hora.id into id_hora_libre
	from horarios hora
		join mesas mesa on mesa.id = hora.id_mesa
	where mesa.status = 1 
		and hora.hora_inicio = time(hora_inicio)
		and hora.hora_fin = time(hora_fin)
		and mesa.id = id_mesa
		and hora.id not in (
			select res.id 
			from listar_reservaciones res
			where res.fecha = date(fecha) and res.status = 1
		)
	limit 1;
	insert into reservaciones (id_hora, id_cliente, fecha, log_date, log_time, status) values
		(id_hora_libre, id_cliente, fecha, date(Now()), time(now()), 1);
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Final view structure for view `listar_comandas`
--

/*!50001 DROP VIEW IF EXISTS `listar_comandas`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `listar_comandas` AS select `com`.`id` AS `id`,`com`.`id_mesero` AS `id_mesero`,`com`.`id_mesa` AS `id_mesa`,`com`.`total` AS `total`,`com`.`observaciones` AS `observaciones`,`com`.`fecha` AS `fecha`,`com`.`hora` AS `hora`,`com`.`status` AS `status`,(select count(0) from `detalle_comandas` where (`detalle_comandas`.`id_comanda` = `com`.`id`)) AS `num_pla`,concat(`usu`.`nombre`,' ',`usu`.`paterno`,' ',`usu`.`materno`) AS `mesero`,`mesa`.`nombre` AS `mesa` from ((`comandas` `com` join `usuarios` `usu` on((`usu`.`id` = `com`.`id_mesero`))) join `mesas` `mesa` on((`mesa`.`id` = `com`.`id_mesa`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `listar_detalle_comandas`
--

/*!50001 DROP VIEW IF EXISTS `listar_detalle_comandas`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `listar_detalle_comandas` AS select `det`.`id_comanda` AS `id_comanda`,`det`.`id_platillo` AS `id_platillo`,`det`.`cantidad` AS `cantidad`,`det`.`precio` AS `precio`,`det`.`status` AS `status`,`pla`.`nombre` AS `platillo` from (`detalle_comandas` `det` join `platillos` `pla` on((`pla`.`id` = `det`.`id_platillo`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `listar_reservaciones`
--

/*!50001 DROP VIEW IF EXISTS `listar_reservaciones`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `listar_reservaciones` AS select `res`.`id` AS `id`,`res`.`id_cliente` AS `id_cliente`,`res`.`id_mesa` AS `id_mesa`,`res`.`cant_mesa` AS `cant_mesa`,`res`.`hora_inicio` AS `hora_inicio`,`res`.`hora_fin` AS `hora_fin`,`res`.`fecha` AS `fecha`,`res`.`log` AS `log`,`res`.`status` AS `status`,concat(`usu`.`nombre`,' ',`usu`.`paterno`,' ',`usu`.`materno`) AS `cliente`,`mesa`.`nombre` AS `mesa` from ((`reservaciones` `res` join `usuarios` `usu` on((`usu`.`id` = `res`.`id_cliente`))) join `mesas` `mesa` on((`mesa`.`id` = `res`.`id_mesa`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `listar_usuarios`
--

/*!50001 DROP VIEW IF EXISTS `listar_usuarios`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `listar_usuarios` AS select `usu`.`id` AS `id`,`usu`.`nombre` AS `nombre`,`usu`.`paterno` AS `paterno`,`usu`.`materno` AS `materno`,`usu`.`usuario` AS `usuario`,`usu`.`contra` AS `contra`,`usu`.`id_perfil` AS `id_perfil`,`usu`.`create_at` AS `create_at`,`usu`.`status` AS `status`,`per`.`nombre` AS `perfil` from (`usuarios` `usu` join `perfiles` `per` on((`per`.`id` = `usu`.`id_perfil`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `modulos_padre`
--

/*!50001 DROP VIEW IF EXISTS `modulos_padre`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `modulos_padre` AS select `mods`.`id` AS `id`,`mods`.`nombre` AS `nombre`,`mods`.`indice` AS `indice`,`mods`.`descripcion` AS `descripcion`,`mods`.`id_padre` AS `id_padre`,`mods`.`icon` AS `icon`,`mods`.`url` AS `url`,`mods`.`status` AS `status`,`pm`.`id_perfil` AS `id_perfil` from (`modulos` `mods` join `perfiles_modulos` `pm` on((`pm`.`id_modulo` = `mods`.`id`))) where (`mods`.`id_padre` = 0) order by `mods`.`indice` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-08-11 17:09:58
