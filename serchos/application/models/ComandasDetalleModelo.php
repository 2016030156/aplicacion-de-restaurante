<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class ComandasDetalleModelo extends MY_Model {

	public function __construct () {
		parent::__construct();
		$this->tabla = "detalle_comandas";
		$this->view = "listar_detalles_comandas";
	}

	public function borrarDetalles ($idComanda) {
		$this->db->where("id_comanda", $idComanda);
		$this->db->delete($this->tabla);
	}

	public function delDetalle ($idComanda, $idPlatillo) {
		$this->trans_start();
		$this->db->where("id_comanda", $idComanda);
		$this->db->where("id_platillo", $idPlatillo);
		$this->db->set("status", 0);
		$this->db->update("detalle_comandas");
		if ($this->trans_status()) {
			$this->db->query("CALL actComanda({$idComanda})");
			return $this->trans_end();
		}
		$this->trans_rollback();
		return false;
	}
}