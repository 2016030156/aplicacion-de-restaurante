/*Para ver las comandas en cocina*/
DELIMITER $$
CREATE PROCEDURE comandas_cocina () BEGIN
	SELECT * FROM listar_comandas WHERE STATUS = 1;
END$$
DELIMITER ;

/*Para crear un detallede las comandas*/
ALTER TABLE detalle_comandas ADD STATUS INT;
UPDATE detalle_comandas SET STATUS = 3;
DROP VIEW listar_detalle_comanda;
CREATE VIEW listar_detalle_comandas AS
(
	SELECT det.*, pla.nombre AS platillo
	FROM detalle_comandas det
		JOIN platillos pla ON pla.id = det.id_platillo
);

/*Cambiar estado del platillo en la comanda (Transito, Elaboracion y Entrega)*/
DELIMITER $$
CREATE PROCEDURE cambiar_status_detalle (id_comanda INT, id_platillo INT, nuevo_status INT) BEGIN
	UPDATE detalle_comandas det SET det.status = nuevo_status WHERE det.id_comanda = id_comanda
		AND det.id_platillo = id_platillo;
END$$
DELIMITER ;
DROP PROCEDURE cambiar_status_platillo;
CALL cambiar_status_detalle (5, 1, 3);

/*Asigar y liberar mesa*/
DELIMITER $$
CREATE PROCEDURE asignar_mesa (id_mesa INT) BEGIN
	UPDATE mesas SET STATUS = 2 WHERE mesas.id = id_mesa;
END$$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE liberar_mesa (id_mesa INT) BEGIN
	UPDATE mesas SET STATUS = 1 WHERE mesas.id = id_mesa;
END$$
DELIMITER ;

/*Ver las comandas que ya tienen todos sus platillos preparados*/

SELECT com.* 
FROM comandas com 
	JOIN detalle_comandas det ON det.id_comanda = com.id;

EXPLAIN listar_usuarios;