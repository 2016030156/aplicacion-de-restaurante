<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class InicioModelo extends MY_Model {

	public function __construct () {
		parent::__construct();
		$this->tabla = "usuarios";
		$this->view = "usuarios";
	}

	public function login ($usuario, $contra) {
		$this->db->select("usu.*, per.nombre AS perfil");
		$this->db->join("perfiles per", "per.id = usu.id_perfil");
		$this->db->where("usuario", $usuario);
		$this->db->where("contra", $contra);
		$this->db->where("usu.status", 1);
		$registro = $this->db->get("usuarios usu");
		if ($registro->num_rows() > 0)
			return $registro->row_array();
		return false;
	}
}