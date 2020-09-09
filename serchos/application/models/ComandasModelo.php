<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class ComandasModelo extends MY_Model {

	public function __construct () {
		parent::__construct();
		$this->tabla = "comandas";
		$this->view = "listar_comandas";
	}

	public function getComandas ($fecha) {
		$this->db->join("detalle_comandas det", "det.id_comanda = com.id", "left");
		$this->db->where("fecha", $fecha);
		$this->db->where("det.id_comanda IS NOT NULL");
		$this->db->order_by("hora");
		$comandas = $this->db->get("comandas com");
		if ($comandas->num_rows() > 0)  {
			$comandas = $comandas->result_array();
			foreach ($comandas as &$comanda) {
				$comanda['detalles'] = $this->getDetallesComanda($comanda['id']);
			}
			return $comandas;
		}
		return false;
	}

	public function listar ($where = -1, $order = -1) {
		date_default_timezone_set("America/Mazatlan");
		$timestamp = new datetime();
		$this->db->select("com.*");
		$this->db->select("(SELECT COUNT(*) FROM detalle_comandas det WHERE det.id_comanda = com.id) AS num_pla");
		$this->db->where("fecha", $timestamp->format("Y-m-d"));
		if (is_array($where))
			$this->db->where($where);
		$this->db->join("detalle_comandas det", "det.id_comanda = com.id", "left");
		$this->db->where("det.id_comanda IS NOT NULL");
		$this->db->group_by("com.id");
		$this->db->order_by("com.hora");
		$comandas = $this->db->get("comandas com");
		if ($comandas->num_rows() > 0)
			return $comandas->result_array();
		return false;
	}

	public function canceladas 	() { return $this->listar(array("com.status" => 0)); }
	public function nuevas		() { return $this->listar(array("com.status" => 1)); }
	public function entregadas 	() { return $this->listar(array("com.status" => 2)); }
	public function preparadas 	() { return $this->listar(array("com.status" => 3)); }
	public function pagadas 	() { return $this->listar(array("com.status" => 4)); }

	public function getDetallesComanda ($idComanda) {
		$this->db->select("det.*, pla.nombre AS platillo");
		$this->db->join("platillos pla", "pla.id = det.id_platillo");
		$this->db->where("id_comanda", $idComanda);
		$detalles = $this->db->get("detalle_comandas det");
		if ($detalles->num_rows() > 0)
			return $detalles->result_array();
		return false;
	}
 
	public function funcion () {
		$this->db->query("BEGIN");
		$this->db->query("INSERT INTO comandas SET id_mesero = 20, id_mesa = 1, fecha = NOW(), hora = NOW(), STATUS = 1, observaciones = 'Sin observaciones'");
		$idComanda = $this->db->insert_id();
		$precio1 = $this->db->query("SELECT precio FROM platillos WHERE id = 2")->row()->precio;
		$precio2 = $this->db->query("SELECT precio FROM platillos WHERE id = 3")->row()->precio;
		$this->db->query("INSERT INTO detalle_comandas SET id_comanda = $idComanda, id_platillo = 3, precio = $precio1, cantidad = 1, status = 1");
		$this->db->query("INSERT INTO detalle_comandas SET id_comanda = $idComanda, id_platillo = 2, precio = $precio2, cantidad = 2, status = 1");
		$total = $this->getTotal($idComanda);
		$this->db->query("UPDATE comandas SET total = $total WHERE id = $idComanda");
		$this->db->query("COMMIT");
		echo "finado";
	}

	public function getTotal ($idComanda) {
		$this->db->where("id_comanda", $idComanda);
		$detalles = $this->db->get("detalle_comandas");
		if ($detalles->num_rows() > 0) {
			$total = 0.0;
			foreach ($detalles->result_array() as $detalle) {
				$total += $detalle['precio'] * $detalle['cantidad'];
			}
			return $total;
		}
		return false;
	}

	public function cancelar ($idComanda) {
		if (!empty($idComanda)) {
			$this->db->where("id", $idComanda);
			$this->db->set("status", 0); //Status comanda rechazada
			$this->db->update($this->tabla);
			return "1";
		}
		return "0";
	}

	public function getDetalles ($idComanda) {
		$this->db->where("id_comanda", $idComanda);
		$this->db->group_start()
					->where("status", 1)
					->or_where("status", 3)
				->group_end();
		$detalles = $this->db->get("listar_detalle_comandas");
		if ($detalles->num_rows() > 0)
			return $detalles->result_array();
		return false;
	}

	public function getDetalle ($idComanda, $idPlatillo) {
		$this->db->where("id_comanda", $idComanda);
		$this->db->where("id_platillo", $idPlatillo);
		$this->db->where("status", 1);
		$detalle = $this->db->get("listar_detalle_comandas");
		if ($detalle->num_rows() > 0)
			return $detalle->row_array();
		return false;
	}

	public function actDetalle ($detalle) {
		$this->db->where("id_platillo", $detalle['id_platillo']);
		$this->db->where("id_comanda", $detalle['id_comanda']);
		$this->db->set("cantidad", $detalle['cantidad']);
		$this->db->set("precio", $detalle['precio']);
		$this->db->set("id_platillo", $detalle['idNuevoPlatillo']);
		$this->db->update("detalle_comandas");
		return ($this->db->affected_rows() > 0);
	}

	public function actComanda ($idComanda) {
		$this->db->query("CALL actComanda($idComanda)");
		return ($this->db->affected_rows() > 0);
	}

	public function getComanda ($idComanda) {
		$this->db->where("id", $idComanda);
		$comanda = $this->db->get("comandas");
		if ($comanda->num_rows() > 0)
			return $comanda->row_array();
		return false;
	}
}