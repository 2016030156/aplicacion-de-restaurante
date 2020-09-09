/*
SQLyog Ultimate v11.11 (64 bit)
MySQL - 5.5.5-10.1.10-MariaDB : Database - extempo
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`extempo` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `extempo`;

/*Table structure for table `comandas` */

DROP TABLE IF EXISTS `comandas`;

CREATE TABLE `comandas` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador del registro',
  `id_mesero` int(11) NOT NULL COMMENT 'Id del mesero que levanto la comanda',
  `id_mesa` int(11) NOT NULL COMMENT 'Id de la mesa donde se levanto la comanda',
  `total` float DEFAULT NULL COMMENT 'Monto total de la comanda',
  `observaciones` text COMMENT 'Texto de observaciones extras de la comanda',
  `fecha` date DEFAULT NULL COMMENT 'Fecha de emisión de la comanda',
  `hora` time DEFAULT NULL COMMENT 'Hora de emisión de la comanda',
  `status` tinyint(4) DEFAULT NULL COMMENT 'Estado la comanda (0 Rechazada, 1 Solicitada, 2 Atendida, 3 Pagada)',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `comandas` */

/*Table structure for table `detalle_comandas` */

DROP TABLE IF EXISTS `detalle_comandas`;

CREATE TABLE `detalle_comandas` (
  `id_comanda` int(11) NOT NULL COMMENT 'Id de la comanda de este detalle',
  `id_platillo` int(11) NOT NULL COMMENT 'Id del platillo de este detalle',
  `cantidad` int(11) DEFAULT NULL COMMENT 'Cantidad de platillos que incluye en el detalle',
  `precio` float DEFAULT NULL COMMENT 'Precio del platillo al mommento de la emisión de la comanda'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `detalle_comandas` */

/*Table structure for table `mesas` */

DROP TABLE IF EXISTS `mesas`;

CREATE TABLE `mesas` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador del registro',
  `tipo_mesa` tinyint(4) DEFAULT NULL COMMENT '1 mesa de 2, 2 mesa de 4',
  `status` int(11) DEFAULT NULL COMMENT 'Estado del registro (0 Fuera de servicio, 1 Disponible, 2 Ocupado)',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `mesas` */

insert  into `mesas`(`id`,`tipo_mesa`,`status`) values (1,1,1);

/*Table structure for table `modulos` */

DROP TABLE IF EXISTS `modulos`;

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
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

/*Data for the table `modulos` */

insert  into `modulos`(`id`,`nombre`,`indice`,`descripcion`,`id_padre`,`icon`,`url`,`status`) values (2,'Meseros',2,NULL,10,'fas fa-receipt','meseros',1),(3,'Gerentes',3,NULL,10,'fas fa-user-tie','gerentes',1),(4,'Cocineros',4,NULL,10,'fas fa-user-graduate','cocineros',1),(5,'Cajeros',5,NULL,10,'fa fa-cash-register','cajeros',1),(6,'Recepcionistas',6,NULL,10,'fa fa-clipboard','recepcionistas',1),(7,'Clientes',7,NULL,10,'fa fa-user','clientes',1),(8,'Platillos',8,NULL,11,'fa fa-apple','platillos',1),(9,'Mesas',9,NULL,11,'fa fa-chair','mesas',1),(10,'Usuarios',1,NULL,0,'fas fa-users',NULL,1),(11,'Restaurante',2,NULL,0,'fas fa-building',NULL,1),(12,'Reportes',3,NULL,0,'fas fa-file-alt',NULL,1),(13,'Reporte Diario',1,NULL,12,'fas fa-calendar-check','reporte-dia',1),(14,'Reporte de rango de fechas',2,NULL,12,'fas fa-calendar-week','reporte-rango',1),(15,'Historial de platillos',1,NULL,11,'fa fa-file-text','historial-platillos',1),(16,'Historial de caja',2,NULL,11,'fa fa-money','historial-caja',1),(17,'Comandas',6,NULL,11,'fas fa-comments','comandas',1);

/*Table structure for table `perfiles` */

DROP TABLE IF EXISTS `perfiles`;

CREATE TABLE `perfiles` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Idenficador del registro',
  `nombre` varchar(45) DEFAULT NULL COMMENT 'Nombre del perfil',
  `descripcion` varchar(245) DEFAULT NULL COMMENT 'Descripción del perfil',
  `status` tinyint(4) DEFAULT NULL COMMENT 'Estado del regisstro (0 Inactivo, 1 Activo',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `perfiles` */

insert  into `perfiles`(`id`,`nombre`,`descripcion`,`status`) values (1,'Administrador','',1),(2,'Gerente','',1),(3,'Caja','',1),(4,'Recepcion','',1),(5,'Cocina','',1),(6,'Mesero','',1),(7,'Cliente','',1);

/*Table structure for table `perfiles_modulos` */

DROP TABLE IF EXISTS `perfiles_modulos`;

CREATE TABLE `perfiles_modulos` (
  `id_perfil` int(11) NOT NULL COMMENT 'Id del perfil relacionado con el modulo',
  `id_modulo` int(11) NOT NULL COMMENT 'Id del modulo relacionado con el perfil'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `perfiles_modulos` */

insert  into `perfiles_modulos`(`id_perfil`,`id_modulo`) values (1,2),(1,3),(1,4),(1,5),(1,6),(1,7),(1,8),(1,9),(1,13),(1,14),(1,15),(1,16),(1,17),(1,10),(1,11),(1,12),(2,10);

/*Table structure for table `platillos` */

DROP TABLE IF EXISTS `platillos`;

CREATE TABLE `platillos` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador del registro',
  `nombre` varchar(90) DEFAULT NULL COMMENT 'Nombre del platillo',
  `precio` float DEFAULT NULL COMMENT 'Precio del platillo',
  `create_at` date DEFAULT NULL COMMENT 'Fecha de creacion del registro',
  `status` tinyint(4) DEFAULT NULL COMMENT 'Estado del platillo (0 Inactivo, 1 Activo)',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

/*Data for the table `platillos` */

insert  into `platillos`(`id`,`nombre`,`precio`,`create_at`,`status`) values (1,'platillo a',100,'2019-04-18',1),(2,'platillo b',90,'2019-04-18',1),(3,'platillo c',100.5,'2029-04-23',1),(4,'platillo d',97,'2029-04-23',1),(5,'platillo e',55.5,'2029-04-23',1),(6,'platillo f',75,'2029-04-23',1),(7,'platillo g',80,'2029-04-23',1),(8,'platillo h',60,'2019-04-23',1),(9,'platillo i',65.5,'2019-04-23',1),(10,'platillo j',30,'2019-04-23',1),(11,'platillo k',70,'2019-04-23',1),(12,'platillo l',100,'2019-04-23',1),(13,'platillo m',82,'2019-04-23',1),(14,'platillo n',12,'2019-04-23',1),(15,'platillo o',90,'2019-04-23',1);

/*Table structure for table `reservaciones` */

DROP TABLE IF EXISTS `reservaciones`;

CREATE TABLE `reservaciones` (
  `id` int(11) NOT NULL COMMENT 'Idenficadaor del registro',
  `id_mesa` int(11) NOT NULL COMMENT 'Identificador de la mesa',
  `id_cliente` int(11) NOT NULL COMMENT 'Idenficador del cliente',
  `fecha` date DEFAULT NULL COMMENT 'Fecha de la reservacion',
  `hora` time DEFAULT NULL COMMENT 'Hora de la reservacion',
  `log_date` date DEFAULT NULL COMMENT 'Fecha de registro de la reservacion',
  `log_time` time DEFAULT NULL COMMENT 'Hora de registro de la reservacion',
  `status` int(11) DEFAULT NULL COMMENT 'Estado de la reservacion (0 Solicitado, 1 Aceptado, 2 Rechazado, 3 Terminado)',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `reservaciones` */

/*Table structure for table `usuarios` */

DROP TABLE IF EXISTS `usuarios`;

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `usuarios` */

insert  into `usuarios`(`id`,`nombre`,`paterno`,`materno`,`usuario`,`contra`,`id_perfil`,`create_at`,`status`) values (1,'rosario','sanchez','gaxiola','charis','7110eda4d09e062aa5e4a390b0a572ac0d2c0220',1,'2009-12-06',1),(2,'juan pablo','sanchez','gaxiola','juanpa','7110eda4d09e062aa5e4a390b0a572ac0d2c0220',7,'2019-04-21',1),(3,'carlos','hernandez','gaxiola','carlos','175d4d507d683a39e44ef0abf4f627a1f6a1b2f1',7,'2019-04-21',1),(4,'carlos','hernandez','gaxiola','carlosgaxiola98','175d4d507d683a39e44ef0abf4f627a1f6a1b2f1',7,'2019-04-21',1);

/* Function  structure for function  `full_name` */

/*!50003 DROP FUNCTION IF EXISTS `full_name` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` FUNCTION `full_name`(id int) RETURNS text CHARSET latin1
BEGIN	
	declare completo varchar (150);
	select 
		concat(usu.nombre, " ", usu.paterno, " ", usu.materno) into completo
	from usuarios usu 
	where usu.id = id;
	return completo;
    END */$$
DELIMITER ;

/* Function  structure for function  `get_tipo_mesa` */

/*!50003 DROP FUNCTION IF EXISTS `get_tipo_mesa` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` FUNCTION `get_tipo_mesa`(id_mesa int) RETURNS text CHARSET latin1
BEGIN
	declare tipo varchar (20);
	select if(mesas.tipo_mesa = 1, "Para 2", "Para 4") into tipo from mesas where mesas.id = id_mesa;
	return tipo;
    END */$$
DELIMITER ;

/*Table structure for table `listar_comandas` */

DROP TABLE IF EXISTS `listar_comandas`;

/*!50001 DROP VIEW IF EXISTS `listar_comandas` */;
/*!50001 DROP TABLE IF EXISTS `listar_comandas` */;

/*!50001 CREATE TABLE  `listar_comandas`(
 `id` int(11) ,
 `id_mesero` int(11) ,
 `id_mesa` int(11) ,
 `total` float ,
 `observaciones` text ,
 `fecha` date ,
 `hora` time ,
 `status` tinyint(4) ,
 `mesero` text ,
 `mesa` text 
)*/;

/*Table structure for table `listar_detalle_comandas` */

DROP TABLE IF EXISTS `listar_detalle_comandas`;

/*!50001 DROP VIEW IF EXISTS `listar_detalle_comandas` */;
/*!50001 DROP TABLE IF EXISTS `listar_detalle_comandas` */;

/*!50001 CREATE TABLE  `listar_detalle_comandas`(
 `id_comanda` int(11) ,
 `id_platillo` int(11) ,
 `cantidad` int(11) ,
 `precio` float ,
 `platillo` varchar(90) 
)*/;

/*Table structure for table `listar_reservaciones` */

DROP TABLE IF EXISTS `listar_reservaciones`;

/*!50001 DROP VIEW IF EXISTS `listar_reservaciones` */;
/*!50001 DROP TABLE IF EXISTS `listar_reservaciones` */;

/*!50001 CREATE TABLE  `listar_reservaciones`(
 `id` int(11) ,
 `id_mesa` int(11) ,
 `id_cliente` int(11) ,
 `fecha` date ,
 `hora` time ,
 `log_date` date ,
 `log_time` time ,
 `status` int(11) ,
 `cliente` text ,
 `mesa` text 
)*/;

/*Table structure for table `listar_usuarios` */

DROP TABLE IF EXISTS `listar_usuarios`;

/*!50001 DROP VIEW IF EXISTS `listar_usuarios` */;
/*!50001 DROP TABLE IF EXISTS `listar_usuarios` */;

/*!50001 CREATE TABLE  `listar_usuarios`(
 `id` int(11) ,
 `nombre` varchar(45) ,
 `paterno` varchar(45) ,
 `materno` varchar(45) ,
 `usuario` varchar(45) ,
 `contra` varchar(245) ,
 `id_perfil` int(11) ,
 `create_at` date ,
 `status` int(11) ,
 `perfil` varchar(45) 
)*/;

/*Table structure for table `modulos_padre` */

DROP TABLE IF EXISTS `modulos_padre`;

/*!50001 DROP VIEW IF EXISTS `modulos_padre` */;
/*!50001 DROP TABLE IF EXISTS `modulos_padre` */;

/*!50001 CREATE TABLE  `modulos_padre`(
 `id` int(11) ,
 `nombre` varchar(45) ,
 `indice` tinyint(4) ,
 `descripcion` varchar(245) ,
 `id_padre` int(11) ,
 `icon` varchar(45) ,
 `url` varchar(45) ,
 `status` tinyint(4) ,
 `id_perfil` int(11) 
)*/;

/*View structure for view listar_comandas */

/*!50001 DROP TABLE IF EXISTS `listar_comandas` */;
/*!50001 DROP VIEW IF EXISTS `listar_comandas` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `listar_comandas` AS (select `com`.`id` AS `id`,`com`.`id_mesero` AS `id_mesero`,`com`.`id_mesa` AS `id_mesa`,`com`.`total` AS `total`,`com`.`observaciones` AS `observaciones`,`com`.`fecha` AS `fecha`,`com`.`hora` AS `hora`,`com`.`status` AS `status`,`full_name`(`usu`.`id`) AS `mesero`,`get_tipo_mesa`(`mesa`.`id`) AS `mesa` from ((`comandas` `com` join `usuarios` `usu` on((`usu`.`id` = `com`.`id_mesero`))) join `mesas` `mesa` on((`mesa`.`id` = `com`.`id_mesa`)))) */;

/*View structure for view listar_detalle_comandas */

/*!50001 DROP TABLE IF EXISTS `listar_detalle_comandas` */;
/*!50001 DROP VIEW IF EXISTS `listar_detalle_comandas` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `listar_detalle_comandas` AS (select `det`.`id_comanda` AS `id_comanda`,`det`.`id_platillo` AS `id_platillo`,`det`.`cantidad` AS `cantidad`,`det`.`precio` AS `precio`,`pla`.`nombre` AS `platillo` from (`detalle_comandas` `det` join `platillos` `pla` on((`pla`.`id` = `det`.`id_platillo`)))) */;

/*View structure for view listar_reservaciones */

/*!50001 DROP TABLE IF EXISTS `listar_reservaciones` */;
/*!50001 DROP VIEW IF EXISTS `listar_reservaciones` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `listar_reservaciones` AS (select `res`.`id` AS `id`,`res`.`id_mesa` AS `id_mesa`,`res`.`id_cliente` AS `id_cliente`,`res`.`fecha` AS `fecha`,`res`.`hora` AS `hora`,`res`.`log_date` AS `log_date`,`res`.`log_time` AS `log_time`,`res`.`status` AS `status`,`full_name`(`res`.`id_cliente`) AS `cliente`,`get_tipo_mesa`(`res`.`id_mesa`) AS `mesa` from `reservaciones` `res`) */;

/*View structure for view listar_usuarios */

/*!50001 DROP TABLE IF EXISTS `listar_usuarios` */;
/*!50001 DROP VIEW IF EXISTS `listar_usuarios` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `listar_usuarios` AS (select `usu`.`id` AS `id`,`usu`.`nombre` AS `nombre`,`usu`.`paterno` AS `paterno`,`usu`.`materno` AS `materno`,`usu`.`usuario` AS `usuario`,`usu`.`contra` AS `contra`,`usu`.`id_perfil` AS `id_perfil`,`usu`.`create_at` AS `create_at`,`usu`.`status` AS `status`,`per`.`nombre` AS `perfil` from (`usuarios` `usu` join `perfiles` `per` on((`per`.`id` = `usu`.`id_perfil`)))) */;

/*View structure for view modulos_padre */

/*!50001 DROP TABLE IF EXISTS `modulos_padre` */;
/*!50001 DROP VIEW IF EXISTS `modulos_padre` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `modulos_padre` AS (select `mods`.`id` AS `id`,`mods`.`nombre` AS `nombre`,`mods`.`indice` AS `indice`,`mods`.`descripcion` AS `descripcion`,`mods`.`id_padre` AS `id_padre`,`mods`.`icon` AS `icon`,`mods`.`url` AS `url`,`mods`.`status` AS `status`,`pm`.`id_perfil` AS `id_perfil` from (`modulos` `mods` join `perfiles_modulos` `pm` on((`pm`.`id_modulo` = `mods`.`id`))) where (`mods`.`id_padre` = 0) order by `mods`.`indice`) */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
