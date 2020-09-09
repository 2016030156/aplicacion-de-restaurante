<?php
defined("BASEPATH") OR exit("No direct script access allowed");

class ReservacionesModelo extends MY_Model {

	public function __construct () {
		parent::__construct();
		$this->tabla = "reservaciones";
		$this->view = "listar_reservaciones";
	}

	public function isMesa ($idMesa) {
		$this->db->where("id", $idMesa);
		$horas = $this->db->get("mesas");
		return $horas->num_rows() > 0;
	}

	public function mesasDisponibles ($data) {
		$cantidad = $this->db->query("CALL mesasDisponibles(" . 
			"{$data['idMesa']}, TIME('{$data['horaInicio']}'), ". 
			"TIME('{$data['horaFin']}'), DATE('{$data['fecha']}')"
		. ")");
		$mesasDisponibles = $cantidad->result();
		mysqli_next_result( $this->db->conn_id );
		return $mesasDisponibles[0]->mesas;
	}

	public function reservacionModificable ($idReservacion) {
		$this->db->where("id", $idReservacion);
		$this->db->set("status", 2);
		$this->db->update("reservaciones");
		return $this->db->affected_rows();
	}
}