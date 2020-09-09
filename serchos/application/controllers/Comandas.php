<?php
defined("BASEPATH") OR exit("No direct script access allowed");

class Comandas extends MY_Controller {

	public $modulo; 

	public function __construct () {
		parent::__construct();
		$this->load->helper("global_functions_helper");
		$this->load->model("ComandasModelo");
		$this->load->model("ComandasDetalleModelo");
		$this->load->model("PlatillosModelo");
		$this->modulo = getModulo("comandas");
	}

	public function index ($filtro = null) {
		if (validarAcceso()) {
			switch ($filtro) {
				case 	null:
				case 	'todas': 		$comandas = $this->ComandasModelo->listar(); 		break;
				case 	'canceladas': 	$comandas = $this->ComandasModelo->canceladas(); 	break;
				case 	'nuevas': 		$comandas = $this->ComandasModelo->nuevas(); 		break;
				case 	'preparadas': 	$comandas = $this->ComandasModelo->preparadas(); 	break;
				case 	'entregadas': 	$comandas = $this->ComandasModelo->entregadas(); 	break;
				case 	'pagadas': 		$comandas = $this->ComandasModelo->pagadas(); 		break;
				default:				$comandas = false; 									break;
			}
			$data = array( 
				'titulo' => "Comandas",
				'comandas' => $comandas,
				'filtro' => $filtro
			);
			$this->load->view("comandas/mainVista", $data);
		} else redirect(base_url());
	}

	public function data () {
		if (validarAcceso(true)) {
			$post = $this->input->post();
			echo json_encode($this->ComandasModelo->getComandas($post['fecha']));
		}
		else {
			redirect(base_url());
		}
	}

	public function funcion () {
		echo $this->ComandasModelo->funcion();
	}

	public function actualizar () {
		$puedeEditar = $this->session->serchos['perfil'] == "Gerente" || $this->session->serchos['perfil'] == "Administrador";
		if (validarAcceso(true) and $puedeEditar) {
			$post = $this->input->post();
			$res = array();
			if ($this->formValidation()) {
				$comanda = array(
					'observaciones' => $post['observaciones'],
					'total' => $post['total']
				);
				$this->ComandasModelo->trans_start();
				$this->ComandasModelo->actualizar($comanda, $post['id']);
				$this->ComandasDetalleModelo->borrarDetalles($post['id']);
				foreach ($post['detalles'] as $detalle) {
					$nuevoDetalle = array(
						'id_comanda' => $post['id'],
						'id_platillo' => $detalle['id'],
						'cantidad' => $detalle['cantidad'],
						'precio' => $detalle['precio']
					);
					$this->ComandasDetalleModelo->insertar($nuevoDetalle);
				}
				if ($this->ComandasModelo->trans_status()) {
					$res['code'] = 1;
					$res['msg'] = "Comanda actualizada";
					$this->ComandasModelo->trans_commit();
				}
				else {
					$res['code'] = -1;
					$res['msg'] = "No se pudo actualizar la comanda";
					$this->ComandasModelo->trans_rollback();
				}
			}
			else {
				$res['code'] = 0;
				$res['msg'] = $this->getFormErrors();
			}
			echo json_encode($res);
		}
		else
			redirect(base_url());
	}

	public function cancelar ($idComanda) {
		$puedeRechazar = $this->session->serchos['perfil'] == "Gerente" || $this->session->serchos['perfil'] == "Administrador";
		if (validarAcceso(true) and $puedeRechazar) {
			$answ['code'] = 0;
			$answ['msg'] = "La comanda no pudo ser cancelada.";
			if ($this->ComandasModelo->cancelar($idComanda)) {
				$answ['code'] = 1;
				$answ['msg'] = "La comanda fue cancelada.";
			}
			echo json_encode($answ);
		}
		else
			redirect(base_url());
	}

	public function preparar ($idComanda) {
		$puedeAtender = $this->session->serchos['perfil'] == "Gerente" || $this->session->serchos['perfil'] == "Administrador" || $this->session->serchos['perfil'] == "Cocina";
		if (validarAcceso(true) and $puedeAtender) {
			$data['status'] = 2;
			$answ["code"] = $this->ComandasModelo->actualizar($data, $idComanda);
			if ($answ['code']) {
				$data['status'] = 3;
				$answ['code_detalle'] = $this->ComandasDetalleModelo->actualizar($data, $idComanda, 'id_comanda');
			}
			echo json_encode($answ);
		}
		else
			redirect(base_url());
	}

	public function listo ($idComanda, $idPlatillo) {
		$puedePreparar = $this->session->serchos['idPerfil'] == getIdPerfil("Administrador") ||
			$this->session->serchos['idPerfil'] == getIdPerfil("Cocina");
		if (validarAcceso(true) and $puedePreparar) {
			$data['status'] = 3;
			$where = array("id_comanda" => $idComanda, 'id_platillo' => $idPlatillo);
			echo json_encode(array("code" => $this->ComandasDetalleModelo->actualizar($data, $where)));
		}
		else
			redirect(base_url());
	}
	
	public function entregar ($idComanda) {
		$puedeEntregar = $this->seesion->serchos['perfil'] = getIdPerfil("Gerente") || 
			$this->session->serchos['perfil'] == getIdPerfil("Administrador") ||
			$this->session->serchos['perfil'] == getIdPerfil("Mesero");
		if (validarAcceso(true) and $puedeEntregar) {
			$data['status'] = 3;
			echo json_encode(array("code" => $this->ComandasModelo->actualizar($data, $idComanda)));
		}
	}

	public function cobrar ($idComanda) {
		$puedePagar = $this->session->serchos['idPerfil'] == getIdPerfil("Gerente") ||
			$this->session->serchos['idPerfil'] == getIdPerfil("Administrador") ||
			$this->session->serchos['idPerfil'] == getIdPerfil("Caja");
		if (validarAcceso(true) and $puedePagar) {
			$data['status'] = 4; //Status comanda pagada
			$answ['code'] = $this->ComandasModelo->actualizar($data, $idComanda);
			echo json_encode($answ);
		}
		else
			redirect(base_url());
	}

	private function formValidation ($esPlatillo = false) {
		if ($esPlatillo) {
			$this->form_validation->set_rules("platillo", "Platillo", "required");
			$this->form_validation->set_rules("cantidad", "Cantidad", "required|numeric");
			$this->form_validation->set_rules("precio", "Precio", "required|numeric");
			$this->form_validation->set_message("numeric", "El campo {field} debe ser solo números");
		}
		else {
			$this->form_validation->set_rules("observaciones", "Observaciones", "required|max_length[255]");
			$this->form_validation->set_message("max_length", "El campo {field} debe tener un máximo de {param} caracteres");
		}
		$this->form_validation->set_message("required", "El campo {field} es obligatorio");
		return $this->form_validation->run();
	}

	private function getFormErrors ($esPlatillo = false) {
		if ($esPlatillo) {
			return "txtPlatillo=".form_error("platillo")."&".
				"txtCantidad=".form_error("cantidad")."&".
				"txtPrecio=".form_error("precio");
		}
		else
			return "observaciones=".form_error("observaciones");
	}

	public function platillos () {
        if (validarAcceso(true)) {
        	$where = array("status" => 1);
            echo json_encode($this->PlatillosModelo->listar($where));
        }
        else
            redirect(base_url());
    }

    public function buscar ($nombrePlatillo = '') {
        if (validarAcceso(true)) {
        	$nombrePlatillo = implode(" ", explode("%20", $nombrePlatillo));
            echo json_encode($this->PlatillosModelo->like($nombrePlatillo));
        }
        else
            redirect(base_url());
    }

    public function addDetalle () {
    	if (validarAcceso(true)) {
    		$post = $this->input->post();
    		$res = array();
    		if ($this->formValidation(true)) {
    			$platillo = $this->PlatillosModelo->buscar(array("nombre" => $post['platillo']));
    			if (!$platillo) {
    				$res['code'] = 0;
    				$res['msg'] = "txtPlatillo=El platillo ingresado no existe&txtCantidad=&txtPrecio=";
    			}
    			else {
    				$detalle = array(
    					'id_comanda' => $post['idComanda'],
    					'id_platillo' => $platillo['id'],
    					'cantidad' => $post['cantidad'],
    					'precio' => $post['precio']
    				);
    				$this->ComandasDetalleModelo->trans_start();
    				$this->ComandasDetalleModelo->insertar($detalle);
    				if ($this->ComandasDetalleModelo->trans_end()) {
    					$res['code'] = 1;
    					$res['msg'] = $this->ComandasModelo->getTotal($post['idComanda']);
    				}
    				else {
    					$res['code'] = -1;
    					$res['msg'] = "No se pudo agregar el platillo";
    				}
    			}
    		}
    		else {
    			$res['code'] = 0;
    			$res['msg'] = $this->getFormErrors(true);
    		}
    		echo json_encode($res);
    	}
    	else
    		redirect(base_url());
    }

    public function detalle ($idComanda = null) {
    	if (validarAcceso()) {
    		if ($idComanda == null)
    			$idComanda = $this->input->post("idComanda");
    		$data = array( 
				'titulo' => "Detalle Comanda ".$idComanda,
				'detalles' => $this->ComandasModelo->getDetalles($idComanda),
				'comanda' => $this->ComandasModelo->getComanda($idComanda)
			);
			$this->load->view("comanda_detalle/mainVista", $data);
    	} else redirect(base_url());
    }

    public function platillo () {
    	if (validarAcceso()) {
    		$post = $this->input->post();
    		$platillo = $this->ComandasModelo->getDetalle($post['idComanda'], $post['idPlatillo']);
    		$data = array(
    			'subtitulo' => "Platillo ".$platillo['platillo']." comanda ".$post['idComanda'],
				'titulo' => "Comanda ".$post['idComanda'],
				'platillo' => $platillo,
				'platillos' => $this->PlatillosModelo->habilitados()
			);
			$this->load->view("detalle_platillo/mainVista", $data);
    	} else redirect(base_url());
    }

    public function actualizaplatillo () {
    	if (validarAcceso()) {
    		$post = $this->input->post();
    		$detalle = array(
    			'id_comanda' => $post['idComanda'],
    			'id_platillo' => $post['idPlatillo'],
    			'cantidad' => $post['cantidad'],
    			'precio' => $post['precio'],
    			'idNuevoPlatillo' => $post['cmbPlatillos']
    		);
    		$this->ComandasModelo->trans_start();
    		$this->ComandasModelo->actDetalle($detalle);
    		$this->ComandasModelo->actComanda($post['idComanda']);
    		if (!$this->ComandasModelo->trans_end())
    			$this->session->set_flashdata("error", "Error al modificar platillo");
    		redirect("comandas/detalle/".$post['idComanda']);
    	} else redirect(base_url());
    }

    public function borrarplatillo ($idComanda, $idPlatillo) {
    	if (validarAcceso()) {
    		$this->ComandasDetalleModelo->delDetalle($idComanda, $idPlatillo);
    		redirect(base_url("index.php/comandas/detalle/").$idComanda);
    	} else {
    		redirect(base_url());
    	}
    }
}