<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class ModulosModelo extends MY_Model {	

	public function __construct () {
		parent::__construct();
		$this->tabla = "modulos";
		$this->view = "modulos";
	}
}