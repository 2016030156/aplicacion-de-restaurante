<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class MesasModelo extends MY_Model {

	public function __construct () {
		parent::__construct();
		$this->tabla = "mesas";
		$this->view = "mesas";
	}

	public function totalMesas ($idMesa) {
		$this->db->where("id", $idMesa);
		$this->db->where("status", 1);
		$res = $this->db->get($this->view);
		if ($res->num_rows())
			return $res->row()->cantidad;
		return false;
	}
}	