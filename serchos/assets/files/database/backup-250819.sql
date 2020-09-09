/*
SQLyog Ultimate v11.11 (64 bit)
MySQL - 5.5.5-10.1.10-MariaDB : Database - serchos
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`serchos` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `serchos`;

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
  `status` tinyint(4) DEFAULT NULL COMMENT '0 = Cancelada, 1 = Nueva, 2 = Preparada, 3 = Entregada, 4 = Pagada',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

/*Data for the table `comandas` */

insert  into `comandas`(`id`,`id_mesero`,`id_mesa`,`total`,`observaciones`,`fecha`,`hora`,`status`) values (1,20,2,20,'Hola','2019-07-15','02:41:00',4),(2,20,1,10,'Hola 2','2019-07-15','19:11:00',0),(3,20,1,30,'Sin observaciones','2019-08-15','20:20:20',1),(4,20,1,NULL,'Sin observaciones','2019-08-14','20:44:09',0),(5,20,1,NULL,'Sin observaciones','2019-08-15','20:49:39',0),(6,20,1,481.5,'Sin observaciones','2019-08-16','20:51:53',4),(7,20,1,291,'Sin observaciones','2019-08-16','11:24:25',0),(8,20,1,90,'Sin observaciones','2019-08-16','11:37:57',1),(9,20,1,291,'Sin observaciones','2019-08-16','19:33:32',1),(10,20,1,291,'Sin observaciones','2019-08-17','11:48:05',4),(11,20,1,291,'Sin observaciones','2019-08-17','14:00:08',4),(12,20,1,291,'Sin observaciones','2019-08-17','17:29:59',0),(13,20,1,292,'Sin observaciones','2019-08-18','11:49:09',4),(14,20,1,292,'Sin observaciones','2019-08-18','12:54:35',1);

/*Table structure for table `detalle_comandas` */

DROP TABLE IF EXISTS `detalle_comandas`;

CREATE TABLE `detalle_comandas` (
  `id_comanda` int(11) NOT NULL COMMENT 'Id de la comanda de este detalle',
  `id_platillo` int(11) NOT NULL COMMENT 'Id del platillo de este detalle',
  `cantidad` int(11) DEFAULT NULL COMMENT 'Cantidad de platillos que incluye en el detalle',
  `precio` float DEFAULT NULL COMMENT 'Precio del platillo al mommento de la emisión de la comanda',
  `status` int(11) DEFAULT NULL COMMENT '1 = Preparado, 0 = no preparado'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `detalle_comandas` */

insert  into `detalle_comandas`(`id_comanda`,`id_platillo`,`cantidad`,`precio`,`status`) values (1,3,1,10,1),(3,2,2,15,1),(2,3,5,20,1),(6,3,2,90,NULL),(6,2,3,100.5,NULL),(7,3,1,90,0),(7,2,2,100.5,0),(8,3,1,90,1),(8,2,2,100.5,0),(9,3,1,90,0),(9,2,2,100.5,0),(10,3,1,90,3),(10,2,2,100.5,3),(11,3,1,90,3),(11,2,2,100.5,3),(12,3,1,90,1),(12,2,2,100.5,1),(13,3,1,91,1),(13,2,2,100.5,1),(14,3,1,91,1),(14,2,2,100.5,1);

/*Table structure for table `mesas` */

DROP TABLE IF EXISTS `mesas`;

CREATE TABLE `mesas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `log` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(11) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `mesas` */

insert  into `mesas`(`id`,`nombre`,`cantidad`,`log`,`status`) values (1,'Mesa para 2',7,'2019-08-18 17:51:25',1),(2,'Mesa para 4',7,'2019-08-18 17:51:29',1);

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
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

/*Data for the table `modulos` */

insert  into `modulos`(`id`,`nombre`,`indice`,`descripcion`,`id_padre`,`icon`,`url`,`status`) values (2,'Meseros',2,NULL,10,'fas fa-receipt','index.php/usuarios/index/meseros',1),(3,'Gerentes',3,NULL,10,'fas fa-user-tie','index.php/usuarios/index/gerentes',1),(4,'Cocineros',4,NULL,10,'fas fa-user-graduate','index.php/usuarios/index/cocineros',1),(5,'Cajeros',5,NULL,10,'fa fa-cash-register','index.php/usuarios/index/cajeros',1),(6,'Recepcionistas',6,NULL,10,'fa fa-clipboard','index.php/usuarios/index/recepcionistas',1),(7,'Clientes',7,NULL,10,'fa fa-user','index.php/usuarios/index/clientes',1),(8,'Platillos',8,NULL,11,'fa fa-apple','index.php/platillos',1),(9,'Mesas',9,NULL,11,'fa fa-chair','index.php/mesas',1),(10,'Usuarios',1,NULL,0,'fas fa-users',NULL,1),(11,'Restaurante',2,NULL,0,'fas fa-building',NULL,1),(12,'Reportes',3,NULL,0,'fas fa-file-alt',NULL,1),(13,'Reporte Diario',1,NULL,12,'fas fa-calendar-check','index.php/reportes/diario',1),(14,'Reporte de rango de fechas',2,NULL,12,'fas fa-calendar-week','index.php/reportes/rango',1),(15,'Historial de platillos',1,NULL,11,'fa fa-file-text','index.php/reportes/platillos',1),(16,'Historial de caja',2,NULL,11,'fa fa-money','index.php/reportes/caja',1),(17,'Comandas',6,NULL,11,'fas fa-comments','index.php/comandas',1),(18,'Reservaciones',5,NULL,0,'fas fa-clipboard','index.php/reservaciones',1);

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

insert  into `perfiles_modulos`(`id_perfil`,`id_modulo`) values (1,2),(1,3),(1,4),(1,5),(1,6),(1,7),(1,8),(1,9),(1,13),(1,14),(1,15),(1,16),(1,17),(1,10),(1,11),(1,12),(5,11),(5,17),(3,11),(3,17),(1,18),(7,18),(4,18),(6,17),(6,11),(2,2),(2,3),(2,4),(2,5),(2,6),(2,7),(2,8),(2,9),(2,10),(2,11),(2,12),(2,13),(2,14),(2,16),(2,17),(2,18);

/*Table structure for table `platillos` */

DROP TABLE IF EXISTS `platillos`;

CREATE TABLE `platillos` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador del registro',
  `nombre` varchar(90) DEFAULT NULL COMMENT 'Nombre del platillo',
  `precio` float DEFAULT NULL COMMENT 'Precio del platillo',
  `create_at` date DEFAULT NULL COMMENT 'Fecha de creacion del registro',
  `status` tinyint(4) DEFAULT NULL COMMENT 'Estado del platillo (0 Inactivo, 1 Activo)',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `platillos` */

insert  into `platillos`(`id`,`nombre`,`precio`,`create_at`,`status`) values (2,'qusadillas',91,'2019-04-18',1),(3,'pollo',100.5,'2029-04-23',1),(4,'enchiladas',97,'2029-04-23',1),(5,'torta',45,'2019-08-18',1);

/*Table structure for table `reservaciones` */

DROP TABLE IF EXISTS `reservaciones`;

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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

/*Data for the table `reservaciones` */

insert  into `reservaciones`(`id`,`id_cliente`,`id_mesa`,`cant_mesa`,`hora_inicio`,`hora_fin`,`fecha`,`log`,`status`) values (1,25,1,3,'14:00:00','15:00:00','2019-08-18','2019-08-18 18:10:04',0),(2,25,1,4,'15:00:00','16:00:00','2019-08-18','2019-08-18 18:19:50',1),(3,25,1,7,'15:00:00','17:00:00','2019-08-19','2019-08-18 18:11:33',1),(4,26,1,1,'12:00:00','13:00:00','2019-08-19','2019-08-19 19:00:27',1),(5,25,1,1,'09:30:00','10:00:00','2019-08-22','2019-08-22 09:43:57',1),(6,25,1,7,'18:02:00','19:02:00','2019-08-25','2019-08-25 18:05:25',0),(8,25,1,7,'19:30:00','20:00:00','2019-08-25','2019-08-25 19:01:57',1),(9,26,1,5,'16:00:00','17:30:00','2019-08-25','2019-08-25 19:27:59',0);

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
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

/*Data for the table `usuarios` */

insert  into `usuarios`(`id`,`nombre`,`paterno`,`materno`,`usuario`,`contra`,`id_perfil`,`create_at`,`status`) values (1,'sergio','lopez','guzman','admin','d033e22ae348aeb5660fc2140aec35850c4da997',1,'2009-12-06',1),(10,'cocina editado','paterno','materno','cocina','6c6e13daadc01238382916a871c00ea767d6887b',5,'2019-04-24',1),(11,'caja','paterno','materno','caja','862448c9b226294b7de620bdca6e0879e5ab0c66',3,'2019-04-24',1),(12,'recepcion','paterno','materno','recepcion','91efd07be5f94c20b1e619dfddbc318413567492',4,'2019-04-24',1),(20,'mesero editado 3','paterno','materno','mesero','5a280e11dcd2ad934af4dcb24b2fafc527aa550a',6,'2019-05-17',1),(24,'gerente','parterno','materno','gerente','e0ffb90b074691c42ebd7b3cc39771b344c0083b',2,'2019-05-18',1),(25,'cliente','paterno','materno','cliente','d94019fd760a71edf11844bb5c601a4de95aacaf',7,'2019-07-13',1),(26,'carlos100','paterno','materno','carlos100','9f6f53fceeca7fa032f65459bac1aa47a55160c2',7,'2019-08-14',1),(27,'mesero','asd','asda','mesero2','5798b441222b5cde4a42570e94e453993727474a',6,'2019-08-17',1),(28,'cocina 2','asdasdasd','asdasdasd','cocina2','3576ba59059314513f4764533ae9cebd1ef66c5f',5,'2019-08-17',1);

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

/* Procedure structure for procedure `actComanda` */

/*!50003 DROP PROCEDURE IF EXISTS  `actComanda` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `actComanda`(idComanda int)
BEGIN
	UPDATE comandas com
	SET com.total = (
		SELECT SUM(det.cantidad * det.precio)
		FROM detalle_comandas det 
		WHERE det.id_comanda = com.id and det.status = 1)
	WHERE com.id = idComanda;
    END */$$
DELIMITER ;

/* Procedure structure for procedure `add_empleado` */

/*!50003 DROP PROCEDURE IF EXISTS  `add_empleado` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `add_empleado`(nombre VARCHAR (45), paterno VARCHAR (45), materno VARCHAR (45), usuario VARCHAR (45),
	contra VARCHAR (50), id_perfil INT)
BEGIN
	INSERT INTO usuarios (nombre, paterno, materno, usuarios, contra, id_perfil)
		VALUES (nombre, paterno, materno, usuario, contra, id_perfil);
	SELECT LAST_INSERT_ID() AS id;
END */$$
DELIMITER ;

/* Procedure structure for procedure `add_platillo_detalle` */

/*!50003 DROP PROCEDURE IF EXISTS  `add_platillo_detalle` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `add_platillo_detalle`(id_comanda INT, id_platillo INT, cantidad INT, precio FLOAT)
BEGIN
	INSERT INTO detalle_comandas (id_comanda, id_platillo, cantidad, precio)
		VALUES (id_comanda, id_platillo, cantidad, precio);
END */$$
DELIMITER ;

/* Procedure structure for procedure `asigar_mesa` */

/*!50003 DROP PROCEDURE IF EXISTS  `asigar_mesa` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `asigar_mesa`(id_mesa INT)
BEGIN
	UPDATE mesas SET mesas.status = 2 WHERE mesas.id = id_mesa;
END */$$
DELIMITER ;

/* Procedure structure for procedure `asignar_mesa` */

/*!50003 DROP PROCEDURE IF EXISTS  `asignar_mesa` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `asignar_mesa`(id_mesa int)
begin
	update mesas set status = 2 where mesas.id = id_mesa;
end */$$
DELIMITER ;

/* Procedure structure for procedure `cambiar_status_detalle` */

/*!50003 DROP PROCEDURE IF EXISTS  `cambiar_status_detalle` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `cambiar_status_detalle`(id_comanda int, id_platillo int, nuevo_status int)
begin
	update detalle_comandas det set det.status = nuevo_status where det.id_comanda = id_comanda
		and det.id_platillo = id_platillo;
end */$$
DELIMITER ;

/* Procedure structure for procedure `comandas_cocina` */

/*!50003 DROP PROCEDURE IF EXISTS  `comandas_cocina` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `comandas_cocina`()
begin
	select * from listar_comandas where status = 1;
end */$$
DELIMITER ;

/* Procedure structure for procedure `comandas_listas` */

/*!50003 DROP PROCEDURE IF EXISTS  `comandas_listas` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `comandas_listas`()
BEGIN
	SELECT com.* 
	FROM comandas com
	WHERE com.id NOT IN (
		SELECT com.id
		FROM comandas com
			JOIN detalle_comandas det ON det.id_comanda = com.id
		WHERE det.status = 1 OR det.status = 2
	);
END */$$
DELIMITER ;

/* Procedure structure for procedure `cuenta_por_mesa` */

/*!50003 DROP PROCEDURE IF EXISTS  `cuenta_por_mesa` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `cuenta_por_mesa`(id_mesa INT)
BEGIN
	SELECT com.*, det.id_platillo, pla.nombre as platillo
	FROM comandas com
		JOIN detalle_comandas det ON det.id_comanda = com.id
		join platillos pla on pla.id = det.id_platillo
	WHERE com.id_mesa = id_mesa and (com.status = 1 or com.status = 2 or com.status = 3)
		and com.fecha = date(now());
END */$$
DELIMITER ;

/* Procedure structure for procedure `del_platillo_comanda` */

/*!50003 DROP PROCEDURE IF EXISTS  `del_platillo_comanda` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `del_platillo_comanda`(id_comanda INT, id_platillo INT)
BEGIN
	DELETE FROM detalle_comandas 
	WHERE detalle_comandas.id_comanda = id_comanda 
		AND detalle_comandas.id_platillo = id_platillo;
END */$$
DELIMITER ;

/* Procedure structure for procedure `edit_platillo_comanda` */

/*!50003 DROP PROCEDURE IF EXISTS  `edit_platillo_comanda` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `edit_platillo_comanda`(id_comanda INT, id_platillo INT, cantidad INT, precio FLOAT)
BEGIN
	UPDATE detalle_comandas det SET det.id_platillo = id_platillo,
		det.cantidad = cantidad, det.precio = precio
	WHERE det.id_comanda = id_comanda;
END */$$
DELIMITER ;

/* Procedure structure for procedure `get_mesas_disponibles` */

/*!50003 DROP PROCEDURE IF EXISTS  `get_mesas_disponibles` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `get_mesas_disponibles`(fecha date)
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
end */$$
DELIMITER ;

/* Procedure structure for procedure `historial_caja` */

/*!50003 DROP PROCEDURE IF EXISTS  `historial_caja` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `historial_caja`(fecha date)
begin
	select com.*, 
		concat(usu.nombre, " ", usu.paterno, " ", usu.materno) as mesero,
		if(mesa.tipo_mesa = 1, "Mesa para 2", "Mesa para 4") as mesa
	from comandas com
	where com.fecha = fecha;
end */$$
DELIMITER ;

/* Procedure structure for procedure `historial_platillos` */

/*!50003 DROP PROCEDURE IF EXISTS  `historial_platillos` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `historial_platillos`(fecha DATE)
BEGIN
	SELECT det.*
	FROM listar_detalle_comandas det
		JOIN listar_comandas com ON com.id = det.id_comanda
	WHERE com.fecha = DATE(fecha);
END */$$
DELIMITER ;

/* Procedure structure for procedure `liberar_mesa` */

/*!50003 DROP PROCEDURE IF EXISTS  `liberar_mesa` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `liberar_mesa`(id_mesa int)
begin
	update mesas set status = 1 where mesas.id = id_mesa;
end */$$
DELIMITER ;

/* Procedure structure for procedure `llenar_horarios_mesa` */

/*!50003 DROP PROCEDURE IF EXISTS  `llenar_horarios_mesa` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `llenar_horarios_mesa`(id_mesa int)
BEGIN
	insert into horas_mesas (id_mesa, hora_inicio, hora_fin) values (id_mesa, time("09:00:00"), time ("11:00:00")),
		(id_mesa, TIME("11:00:00"), TIME ("13:00:00")), (id_mesa, TIME("13:00:00"), TIME ("15:00:00")),
		(id_mesa, TIME("15:00:00"), TIME ("17:00:00")), (id_mesa, TIME("17:00:00"), TIME ("19:00:00"));
    END */$$
DELIMITER ;

/* Procedure structure for procedure `login` */

/*!50003 DROP PROCEDURE IF EXISTS  `login` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `login`(usu varchar (45), contra varchar (50))
begin
	select * from listar_usuarios lis where lis.usuario = usu and lis.contra = contra;
end */$$
DELIMITER ;

/* Procedure structure for procedure `login_sha1` */

/*!50003 DROP PROCEDURE IF EXISTS  `login_sha1` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `login_sha1`(usu varchar (45), contra varchar (50))
begin
	SELECT * FROM listar_usuarios lis WHERE lis.usuario = usu AND lis.contra = SHA1(contra);
end */$$
DELIMITER ;

/* Procedure structure for procedure `mesasDisponibles` */

/*!50003 DROP PROCEDURE IF EXISTS  `mesasDisponibles` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `mesasDisponibles`(idMesa int, horaInicio time, horaFin time, fecha date)
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
end */$$
DELIMITER ;

/* Procedure structure for procedure `nueva_comanda` */

/*!50003 DROP PROCEDURE IF EXISTS  `nueva_comanda` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `nueva_comanda`(id_mesero int, id_mesa int, observaciones text)
begin
	insert into comandas (id_mesero, id_mesa, observaciones, fecha, hora, status) values 
		(id_mesero, id_mesa, observaciones, date(now()), date(now()), 1);
	select last_insert_id();
end */$$
DELIMITER ;

/* Procedure structure for procedure `nueva_mesa` */

/*!50003 DROP PROCEDURE IF EXISTS  `nueva_mesa` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `nueva_mesa`(tipo_mesa int)
begin
	declare id_mesa int;
	insert into mesas (tipo_mesa, status) values (tipo_mesa, 1);	
	select last_insert_id() into id_mesa;
	call llenar_horarios_mesa (id_mesa);
	select id_mesa as id;
end */$$
DELIMITER ;

/* Procedure structure for procedure `nuevo_detalle_comanda` */

/*!50003 DROP PROCEDURE IF EXISTS  `nuevo_detalle_comanda` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `nuevo_detalle_comanda`(id_comanda INT, id_platillo INT, cantidad int, precio float)
BEGIN
	declare total int;
	INSERT INTO detalle_comandas (id_comanda, id_platillo, cantidad, precio) VALUES 
		(id_comanda, id_platillo, cantidad, precio);
	SELECT SUM(precio * cantidad) into total
	FROM comandas com
		JOIN detalle_comandas det ON det.id_comanda = com.id
	WHERE com.id = id_comanda;
	update comandas com set com.total = total where com.id = id_comanda;	
END */$$
DELIMITER ;

/* Procedure structure for procedure `nuevo_platillo` */

/*!50003 DROP PROCEDURE IF EXISTS  `nuevo_platillo` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `nuevo_platillo`(nombre varchar (45), precio float)
begin
	insert into platillos (nombre, precio, create_at, status) values
		(nombre, precio, date(now()), 1);
	select last_insert_id();
end */$$
DELIMITER ;

/* Procedure structure for procedure `nuevo_usuario` */

/*!50003 DROP PROCEDURE IF EXISTS  `nuevo_usuario` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `nuevo_usuario`(nombre varchar (45), paterno varchar (45), materno varchar (45), usuario varchar (45), contra varchar (50), id_perfil int)
begin
	insert into usuarios (nombre, paterno, materno, usuario, contra, id_perfil) values
		(nombre, paterno, materno, usuario, sha1(contra), id_perfil);
	select last_insert_id();
end */$$
DELIMITER ;

/* Procedure structure for procedure `puedoReservar` */

/*!50003 DROP PROCEDURE IF EXISTS  `puedoReservar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `puedoReservar`(idTipoMesa int, idTipoHora int, fecha varchar (10))
begin
	select res.* 
	from reservaciones res
	where fecha = date(fecha)
		and res.id_hora in (SELECT hora.id
			FROM mesas mesa 
				JOIN horas_mesas hora ON hora.id_mesa = mesa.id
			where hora.tipo = idTipoHora and mesa.tipo_mesa = idTipoMesa
			);
end */$$
DELIMITER ;

/* Procedure structure for procedure `reporte_diario` */

/*!50003 DROP PROCEDURE IF EXISTS  `reporte_diario` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `reporte_diario`()
BEGIN
	SELECT com.*
	FROM listar_comandas com
	WHERE com.fecha = DATE(NOW());
END */$$
DELIMITER ;

/* Procedure structure for procedure `reporte_rango` */

/*!50003 DROP PROCEDURE IF EXISTS  `reporte_rango` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `reporte_rango`(inicio DATE, fin DATE)
BEGIN
	SELECT com.*
	FROM listar_comandas com
	WHERE com.fecha >= DATE(inicio)
		AND com.fecha <= DATE(fin);
END */$$
DELIMITER ;

/* Procedure structure for procedure `reservar` */

/*!50003 DROP PROCEDURE IF EXISTS  `reservar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `reservar`(id_cliente int, tipo_mesa int, fecha date, hora_inicio time, hora_fin time)
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
 `num_pla` bigint(21) ,
 `mesero` varchar(137) ,
 `mesa` varchar(45) 
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
 `status` int(11) ,
 `platillo` varchar(90) 
)*/;

/*Table structure for table `listar_reservaciones` */

DROP TABLE IF EXISTS `listar_reservaciones`;

/*!50001 DROP VIEW IF EXISTS `listar_reservaciones` */;
/*!50001 DROP TABLE IF EXISTS `listar_reservaciones` */;

/*!50001 CREATE TABLE  `listar_reservaciones`(
 `id` int(11) ,
 `id_cliente` int(11) ,
 `id_mesa` int(11) ,
 `cant_mesa` int(11) ,
 `hora_inicio` time ,
 `hora_fin` time ,
 `fecha` date ,
 `log` timestamp ,
 `status` int(11) ,
 `cliente` varchar(137) ,
 `mesa` varchar(45) 
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

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `listar_comandas` AS (select `com`.`id` AS `id`,`com`.`id_mesero` AS `id_mesero`,`com`.`id_mesa` AS `id_mesa`,`com`.`total` AS `total`,`com`.`observaciones` AS `observaciones`,`com`.`fecha` AS `fecha`,`com`.`hora` AS `hora`,`com`.`status` AS `status`,(select count(0) from `detalle_comandas` where (`detalle_comandas`.`id_comanda` = `com`.`id`)) AS `num_pla`,concat(`usu`.`nombre`,' ',`usu`.`paterno`,' ',`usu`.`materno`) AS `mesero`,`mesa`.`nombre` AS `mesa` from ((`comandas` `com` join `usuarios` `usu` on((`usu`.`id` = `com`.`id_mesero`))) join `mesas` `mesa` on((`mesa`.`id` = `com`.`id_mesa`)))) */;

/*View structure for view listar_detalle_comandas */

/*!50001 DROP TABLE IF EXISTS `listar_detalle_comandas` */;
/*!50001 DROP VIEW IF EXISTS `listar_detalle_comandas` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `listar_detalle_comandas` AS (select `det`.`id_comanda` AS `id_comanda`,`det`.`id_platillo` AS `id_platillo`,`det`.`cantidad` AS `cantidad`,`det`.`precio` AS `precio`,`det`.`status` AS `status`,`pla`.`nombre` AS `platillo` from (`detalle_comandas` `det` join `platillos` `pla` on((`pla`.`id` = `det`.`id_platillo`)))) */;

/*View structure for view listar_reservaciones */

/*!50001 DROP TABLE IF EXISTS `listar_reservaciones` */;
/*!50001 DROP VIEW IF EXISTS `listar_reservaciones` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `listar_reservaciones` AS (select `res`.`id` AS `id`,`res`.`id_cliente` AS `id_cliente`,`res`.`id_mesa` AS `id_mesa`,`res`.`cant_mesa` AS `cant_mesa`,`res`.`hora_inicio` AS `hora_inicio`,`res`.`hora_fin` AS `hora_fin`,`res`.`fecha` AS `fecha`,`res`.`log` AS `log`,`res`.`status` AS `status`,concat(`usu`.`nombre`,' ',`usu`.`paterno`,' ',`usu`.`materno`) AS `cliente`,`mesa`.`nombre` AS `mesa` from ((`reservaciones` `res` join `usuarios` `usu` on((`usu`.`id` = `res`.`id_cliente`))) join `mesas` `mesa` on((`mesa`.`id` = `res`.`id_mesa`)))) */;

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
