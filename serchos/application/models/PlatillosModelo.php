<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class PlatillosModelo extends MY_Model {    

	public function __construct () {
        parent::__construct();
        $this->view = "platillos";
        $this->tabla = "platillos";
    }

    public function totalPlatillos () {
    	$this->db->select("COUNT(*) AS total");
    	$this->db->where("status", 1);
    	$res = $this->db->get("platillos")->row();
    	return $res->total;
    }

    public function like ($nombrePlatillo = '') {
        $this->db->where("status", 1);
        if (!empty($nombrePlatillo)) {
            $this->db->like("nombre", $nombrePlatillo);
        }
        $platillos = $this->db->get("platillos");
        if ($platillos->num_rows() > 0)
            return $platillos->result_array();
        return false;
    }

    public function habilitados () {
        $this->db->where("status", 1);
        $platillos = $this->db->get("platillos");
        if ($platillos->num_rows() > 0)
            return $platillos->result_array();
        return false;
    }
}