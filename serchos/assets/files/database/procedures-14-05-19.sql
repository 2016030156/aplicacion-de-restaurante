/*Ver pedidos en cocina*/
DELIMITER $$
CREATE PROCEDURE comandas_cocina () BEGIN
	SELECT com.* FROM listar_comandas com WHERE com.status = 1;
END$$
DELIMITER ;

/*Modificar tabla detalle_comandas*/
ALTER TABLE detalle_comandas ADD STATUS INT;
UPDATE detalle_comandas SET STATUS = 3;
DROP VIEW listar_detalle_comandas;
CREATE VIEW listar_detalle_comandas AS (
	SELECT det.*, pla.nombre AS platillo
	FROM detalle_comandas det
		JOIN platillos pla ON pla.id = det.id_platillo
);

/*Cambiar el estado de un platillo en un comanda especifica*/
DELIMITER $$
CREATE PROCEDURE cambiar_status_detalle (id_comanda INT, id_platillo INT, nuevo_status INT) BEGIN
	UPDATE detalle_comandas det SET det.status = nuevo_status WHERE det.id_comanda = id_comanda
		AND det.id_platillo = id_platillo;
END$$
DELIMITER ;

/*Asigar y liberar mesa*/
DELIMITER $$
CREATE PROCEDURE asigar_mesa (id_mesa INT) BEGIN
	UPDATE mesas SET mesas.status = 2 WHERE mesas.id = id_mesa;
END$$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE liberar_mesa (id_mesa INT) BEGIN
	UPDATE mesas SET mesas.status = 1 WHERE mesas.id = id_mesa;
END$$
DELIMITER ;

/*Notificar a un mesero cuando un comanda este lista*/
DELIMITER $$
CREATE PROCEDURE comandas_listas () BEGIN
	SELECT com.* 
	FROM comandas com
	WHERE com.id NOT IN (
		SELECT com.id
		FROM comandas com
			JOIN detalle_comandas det ON det.id_comanda = com.id
		WHERE det.status = 1 OR det.status = 2
	);
END$$
DELIMITER ;


/*Solicitar cuenta al mesero*/
DELIMITER $$
CREATE PROCEDURE cuenta_por_mesa (id_mesa INT) BEGIN
	SELECT com.*, det.*
	FROM listar_comandas com
		JOIN listar_detalle_comandas det ON det.id_comanda = com.id
	WHERE com.id_mesa = id_mesa;
END$$
DELIMITER ;

/*Agregar platillo a comanda (solo gerente)*/
DELIMITER $$
CREATE PROCEDURE add_platillo_detalle (id_comanda INT, id_platillo INT, cantidad INT, precio FLOAT) BEGIN
	INSERT INTO detalle_comandas (id_comanda, id_platillo, cantidad, precio)
		VALUES (id_comanda, id_platillo, cantidad, precio);
END$$
DELIMITER ;

/*Modificar platillo de comanda (solo gerente)*/
DELIMITER $$
CREATE PROCEDURE edit_platillo_comanda (id_comanda INT, id_platillo INT, cantidad INT, precio FLOAT) BEGIN
	UPDATE detalle_comandas det SET det.id_platillo = id_platillo,
		det.cantidad = cantidad, det.precio = precio
	WHERE det.id_comanda = id_comanda;
END$$
DELIMITER ;

/*Remover platillo de comanda (solo generente)*/
DELIMITER $$
CREATE PROCEDURE del_platillo_comanda (id_comanda INT, id_platillo INT) BEGIN
	DELETE FROM detalle_comandas 
	WHERE detalle_comandas.id_comanda = id_comanda 
		AND detalle_comandas.id_platillo = id_platillo;
END$$
DELIMITER ;

/*Ver historial de caja*/
DELIMITER $$
CREATE PROCEDURE historial_caja (fecha DATE) BEGIN
	SELECT com.*
	FROM listar_comandas com
	WHERE com.fecha = fecha;
END$$
DELIMITER ;

/*Agregar y eliminar meseros como gerente*/
DELIMITER $$
CREATE PROCEDURE add_empleado (nombre VARCHAR (45), paterno VARCHAR (45), materno VARCHAR (45), usuario VARCHAR (45),
	contra VARCHAR (50), id_perfil INT) BEGIN
	INSERT INTO usuarios (nombre, paterno, materno, usuarios, contra, id_perfil)
		VALUES (nombre, paterno, materno, usuario, contra, id_perfil);
	SELECT LAST_INSERT_ID() AS id;
END$$
DELIMITER ;

/*Ver reportes*/
DELIMITER $$
CREATE PROCEDURE reporte_diario () BEGIN
	SELECT com.*
	FROM listar_comandas com
	WHERE com.fecha = DATE(NOW());
END$$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE reporte_rango (inicio DATE, fin DATE) BEGIN
	SELECT com.*
	FROM listar_comandas com
	WHERE com.fecha >= DATE(inicio)
		AND com.fecha <= DATE(fin);
END$$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE historial_platillos (fecha DATE) BEGIN
	SELECT det.*
	FROM listar_detalle_comandas det
		JOIN listar_comandas com ON com.id = det.id_comanda
	WHERE com.fecha = DATE(fecha);
END$$
DELIMITER ;

SHOW PROCEDURE STATUS;

