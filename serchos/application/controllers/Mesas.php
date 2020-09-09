<?php
defined("BASEPATH") OR exit("No direct script access allowed");

class Mesas extends MY_Controller {

	public $modulo;

	public function __construct () {
		parent::__construct();
		$this->load->helper("global_functions_helper");
		$this->load->model("MesasModelo");
		$this->modulo = getModulo("mesas");
		$moduloPadre = getModulo("Restaurante");
        $this->session->set_tempdata("idModuloPadreActual", $moduloPadre['id'] , 60);
        $this->session->set_tempdata("idModuloActual", $this->modulo['id'] , 60);
	}

	public function index ($filtro = "todas") {
		if (!validarAcceso()) {
			redirect(base_url());
		} else {
			if ($filtro == "activas") {
				$where['status'] = 1;
			} else if ($filtro == "inactivas") {
				$where['status'] = 0;
			} else {
				$where = null;
			}
			$data = array( 
				'titulo' => "Mesas",
				'mesas' => $this->MesasModelo->listar($where),
				'filtro' => $filtro
			);
    		$this->load->view("mesas/mainVista", $data);
		}
	}

	public function agregar () {
		if (!validarAcceso()) {
			redirect(base_url());
		} else {
			$data = array(
				"titulo" => "Mesas",
				'metodo' => "insertar"
			);
			$this->load->view("mesas/formVista", $data);
		}
	}

	public function insertar () {
		if (!validarAcceso()) {
			redirect(base_url());
		} else if (!$this->validarForm()) {
			$this->session->set_flashdata("error", "Corregir los errores del formulario.");
			$this->agregar();
		} else {
			$post = $this->input->post();
			$fecha = new datetime();
			$mesa = array(
				'nombre' => $post['txtNombre'],
				'cantidad' => $post['txtCantidad']
			);
			$this->MesasModelo->trans_start();
			$idMesa = $this->MesasModelo->insertar($mesa);
			if ($idMesa === false)
				$this->MesasModelo->trans_rollback();
			if ($this->MesasModelo->trans_end()) {
				$this->session->set_flashdata("error", "Error al agregar la mesa.");
				redirect(base_url("index.php/mesas"));
			} else {
				$this->session->set_flashdata("success", "La mesa fue agregada.");
				redirect(base_url("index.php/mesas"));
			}
		}
	}

	public function editar ($idMesa = null) {
		if (!validarAcceso()) {
			redirect(base_url());
		} else if ($idMesa == null) {
			$this->session->set_flashdata("error", "La mesa ingresada no es válida.");
			redirect(base_url("index.php/mesas"));
		} else {
			$where['id'] = $idMesa;
			$data = array(
				"titulo" => "Mesas",
				'mesa' => $this->MesasModelo->buscar($where),
				'metodo' => "actualizar"
			);
			$this->load->view("mesas/formVista", $data);
		}
	}

	public function actualizar () {
		if (!validarAcceso()) {
			redirect(base_url());
		} else if (!$this->validarForm($this->input->post("idMesa"))) {
			$this->session->set_flashdata("error", "Corregir los errores del formulario.");
			$this->editar($this->input->post("idMesa"));
		} else {
			$post = $this->input->post();
			$mesa = array(
				'nombre' => $post['txtNombre'],
				'cantidad' => $post['txtCantidad']
			);
			$this->MesasModelo->trans_start();
			if (!$this->MesasModelo->actualizar($mesa, $post['idMesa'])) {
				$this->session->set_flashdata("error", "Error al actualizar la mesa <strong>".$post['idMesa']."</strong>");
				$this->MesasModelo->trans_rollback();
				redirect(base_url("index.php/mesas"));
			} else if (!$this->mesasPara4()) { //Minimo 6 mesas para 2 personas
				$this->session->set_flashdata("error", "Debe haber mínimo <strong>6 mesas </storng> para <strong>4 personas</strong>");
				$this->MesasModelo->trans_rollback();
				$this->editar($this->input->post("idMesa"));
			} else if (!$this->mesasPara2()) { //Minimo 4 para 2 personas
				$this->session->set_flashdata("error", "Debe haber mínimo <strong>4 mesas </storng> para <strong>2 personas</strong>");
				$this->MesasModelo->trans_rollback();
				$this->editar($this->input->post("idMesa"));
			} else {
				$this->session->set_flashdata("success", "Mesa actualizada.");
				$this->MesasModelo->trans_commit();
				redirect(base_url("index.php/mesas"));
			}
		}
	}

	private function validarForm () {
		$this->form_validation->set_rules("txtNombre", "Nombre del tipo de mesa", "required|trim");
		$this->form_validation->set_rules("txtCantidad", "Cantidad de mesas", "required|numeric");
		$this->form_validation->set_message("required", "Este campo es obligatario");
		$this->form_validation->set_message("numeric", "Este campo solo puede contener números.");
		return $this->form_validation->run();
	}

	private function mesasPara2 () {
		$cantidad = $this->MesasModelo->totalMesas(1);
		return $cantidad >= 4;
	}

	private function mesasPara4 () {
		$cantidad = $this->MesasModelo->totalMesas(2);
		return $cantidad >= 6;
	}

	public function cancelar ($idMesa = null) {
        if (!validarAcceso(true)) {
            redirect(base_url());
        } else if ($idMesa == null) {
            echo json_encode(array("code" => -1, "msg" => "El id ingresado no es válido."));
        } else {
        	$where['id'] = $idMesa;
        	$data['status'] = 0;
        	if ($this->MesasModelo->actualizar($data, $where)) {
            	echo json_encode(array("code" => 1, "msg" => "Mesas deshabilitadas."));
        	} else {
        		echo json_encode(array("code" => 0, 
        			"msg" => "No se pudo deshabilitar las mesas."));
        	}
        }
    }
}