<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class PerfilesModulosModelo extends CI_Model {

	private $union = "perfiles_modulos";	
	private $modulos = "modulos";	
	private $perfiles = "perfiles";	

	public function __construct () {
		parent::__construct();
	}

	public function modulosPerfil ($idPerfil) {
		$this->db->select("mods.*");
		$this->db->where("pm.id_perfil", $idPerfil);
		$this->db->join($this->union." pm", "pm.id_modulo = mods.id");
		$this->db->order_by("mods.indice");
		$modulos = $this->db->get($this->modulos." mods");
		if ($modulos->num_rows() > 0)
			return $modulos->result_array();
		return false;
	}

	public function modulosPadrePerfil ($idPerfil) {
		$this->db->where("id_perfil", $idPerfil);
		$result = $this->db->get("modulos_padre");
		if ($result->num_rows() > 0)
			return $result->result_array();
		return false;
	}

	public function add ($idPerfil, $idModulo) {
		$this->db->set("id_modulo", $idModulo);
		$this->db->set("id_perfil", $idPerfil);
		$this->db->insert($this->union);		
		if ($this->db->affected_rows() > 0)
			return $this->db->insert_id();
		return false;
	}

	public function del ($idPerfil) {
		$this->db->where("id_perfil", $idPerfil);
		$this->db->delete($this->union);		
		return ($this->db->affected_rows() > 0);
	}

	public function get ($idPerfil, $idModulo) {
		$this->db->where("id_perfil", $idPerfil);
		$this->db->where("id_modulo", $idModulo);
		$reg = $this->db->get($this->union);
		if ($reg->num_rows() > 0)
			return  $reg->row_array();
		return false;
	}

	public function modulosHijo ($idPadre, $idPerfil) {
		$this->db->where("id_padre", $idPadre);
		$this->db->where("id_perfil", $idPerfil);
		$this->db->join($this->union." pm", "pm.id_modulo = mods.id");
		$this->db->group_by("mods.id");
		$modulos = $this->db->get("modulos mods");
		if ($modulos->num_rows() > 0)
			return $modulos->result_array();
		return false;
	}
}