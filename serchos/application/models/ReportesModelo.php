<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class ReportesModelo extends MY_Model {

	public function __construct () {
		parent::__construct();
		$this->tabla = "usuarios";
		$this->view = "usuarios";
	}
	
	public function platillos ($fecha = '') {
		$this->db->select("pla.*, SUM(cantidad) AS cantidad");
		$this->db->join("detalle_comandas det", "det.id_platillo = pla.id");
		$this->db->join("comandas com", "com.id = det.id_comanda");
		$this->db->where("com.fecha = DATE('".$fecha."')");
		$this->db->group_by("pla.id");
		$platillos = $this->db->get("platillos pla");
		if ($platillos->num_rows() > 0)
			return $platillos->result_array();
		return false;
	}

	public function comandas ($inicio, $fin = null) {
		$this->db->where("fecha >= DATE('" . $inicio->format("Y-m-d") . "')");
		if ($fin != null)
			$this->db->where("fecha <= DATE('".$fin->format("Y-m-d")."')");
		$this->db
			->group_start()
				->where("com.status", 4)
				->or_where("com.status", 0)
			->group_end();
		$this->db->join("usuarios usu", "usu.id = com.id_mesero");
		$this->db->join("mesas mesa", "mesa.id = com.id_mesa");
		$this->db->select("com.*");
		$this->db->select("CONCAT(usu.nombre, ' ', usu.paterno, ' ', usu.materno) AS mesero");
		$this->db->select("mesa.nombre AS mesa");
		$this->db->select("IF(com.status = 0, 'Cancelado', 'Pagada') AS estado");
		$comandas = $this->db->get("comandas com");
		if ($comandas->num_rows() > 0)
			return $comandas->result_array();
		return false;
	}
}