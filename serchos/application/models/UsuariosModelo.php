<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class UsuariosModelo extends MY_Model {

	public function __construct () {
		parent::__construct();
		$this->tabla = "usuarios";
		$this->view = "listar_usuarios";
	}

	public function meseros ($id = '') {
		$where = array("perfil" => "Mesero");
		if (!empty($id))
			$where['id'] = $id;
		return parent::listar($where);
	}

	public function clientes () {
		$where = array("perfil" => "Cliente");
		if (!empty($id))
			$where['id'] = $id;
		return parent::listar($where);
	}

	public function cajeros () {
		$where = array("perfil" => "Caja");
		if (!empty($id))
			$where['id'] = $id;
		return parent::listar($where);
	}

	public function gerentes () {
		$where = array("perfil" => "Gerente");
		if (!empty($id))
			$where['id'] = $id;
		return parent::listar($where);
	}

	public function recepcionistas () {
		$where = array("perfil" => "Recepcion");
		if (!empty($id))
			$where['id'] = $id;
		return parent::listar($where);
	}

	public function cocineros () {
		$where = array("perfil" => "Cocina");
		if (!empty($id))
			$where['id'] = $id;
		return parent::listar($where);
	}
}
