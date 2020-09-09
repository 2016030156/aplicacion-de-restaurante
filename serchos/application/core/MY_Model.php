<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Model extends CI_Model {

	protected $tabla;
	protected $view;

	public function __construct() {
		parent::__construct();
	}

	public function listar ($where = -1, $order = -1) {
		if (is_array($where))
			foreach ($where as $index => $value)
				$this->db->where($index, $value);
		if (is_array($order))
			foreach ($order as $index => $value)
				$this->db->order_by($index, $value);
		$res = $this->db->get($this->view);
		if ($res->num_rows() > 0)
			return $res->result_array();
		return false;
	}

	public function insertar ($data) {
		$this->db->insert($this->tabla, $data);		
		if ($this->db->affected_rows() > 0)
			return $this->db->insert_id();
		return false;
	}

	public function actualizar ($data, $where, $field = 'id') {
		if (is_array($where))
			foreach ($where as $index => $value)
				$this->db->where($index, $value);
		else
			$this->db->where($field, $where);
		$this->db->update($this->tabla, $data);
		return ($this->db->affected_rows() > 0);
	}

	public function buscar ($where) {
		$result = $this->listar($where);
		return $result[0];
	}

	public function borrar ($where = -1) {
		if (is_array($where)) {
			foreach ($where as $index => $value)
				$this->db->where($index, $value);
			$this->db->delete($this->tabla);
			return ($this->db->affected_rows() > 0);
		}
		return false;
	}

	public function trans_start () {
		$this->db->trans_begin();
	}

	public function trans_end () {
		$result = $this->db->trans_status();
		if ($result == FALSE and !$this->get_trans_error())
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();
		return $result;
	}

	public function trans_status () {
		return $this->db->trans_status();
	}

	public function trans_rollback () {
		$this->db->trans_rollback();
	}

	public function trans_commit () {
		$this->db->trans_commit();
	}
}
