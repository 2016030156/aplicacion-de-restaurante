<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inicio extends CI_Controller {

	public $modulo;
	public $nombre = "Inicio";

	public function __construct () {
		parent::__construct();
		$this->load->helper("global_functions_helper");
		$this->load->model("InicioModelo");
		$this->load->model("UsuariosModelo");
		$this->modulo = $this->InicioModelo->buscar("modulos", $this->nombre, "nombre");
		$this->form_validation->set_error_delimiters("", "");
	}

	public function index () {
		$data = array(
			'titulo' => "Inicio",
			'actual' => $this->modulo
		);
		if (isset($this->session->serchos) and $this->session->serchos['login']) {
			switch ($this->session->serchos['perfil']) {
				case "Mesero":
				case "Cocina":
				case "Caja":
					redirect(base_url("index.php/comandas"));
					break;
				case "Administrador":
				case "Gerente":
				case "Cliente":
					$this->load->view("inicio/inicioVista", $data);
					break;
				case "Recepcion":
					redirect(base_url("index.php/reservaciones"));
					break;
			}
		}
		else {
			$serchos = array(
				'idPerfil' => 0,
				'login' => false
			);			
			$data['titulo'] = "Login";
			$this->session->set_userdata(array('serchos' => $serchos));
			$this->load->view("inicio/loginVista", $data);
		}
	}

	public function login () {
		$post = $this->input->post();
		$respuesta['code'] = 1;
		$this->form_validation->set_rules("usuario", "usuario", "required|trim");
		$this->form_validation->set_rules("contra", "contra", "required");
		$this->form_validation->set_message("required", "r-{field}");
		if ($this->form_validation->run()) {
			$usuario = $this->InicioModelo->login($post['usuario'], $post['contra']);
			if (!$usuario) {
				$respuesta['code'] = 0;
				$respuesta['msg'] = "incorrecto";
			}
			else {
				$serchos = array(
					'nombre' => $usuario["nombre"],
					'idUsuario' => $usuario["id"],
					'paterno' => $usuario['paterno'],
					'materno' => $usuario['materno'],
					'usuario' => $usuario['usuario'],
					'contra' => $usuario['contra'],
					'idPerfil' => $usuario['id_perfil'],
					'perfil' => $usuario['perfil'],
					'idModuloActual' => -1,
					'createAt' => $usuario['create_at'],
					'status' => $usuario['status'],
					'login' => true
				);
				$this->session->set_userdata(array('serchos' => $serchos));
				$respuesta['msg'] = "correcto";
			}
		}
		else {
			$respuesta['code'] = -1;
			$respuesta['msg'] = form_error('usuario')."&".form_error('contra');
		}
		echo json_encode($respuesta);
	}	

	public function logout () {
		$this->session->sess_destroy();
		header("Location: ".base_url());
	}

	public function registro () {
		if (isset($this->session->serchos['login'])) {
			$data = array(
				'titulo' => "Registro"
			);
			$this->load->view("inicio/registroVista", $data);
		}
		else
			redirect(base_url());
	}

	public function registrarse () {
		if ($this->input->is_ajax_request()) {
			$post = $this->input->post();
			$this->form_validation->set_rules("txtNombre", "Nombre(s)", "trim|required|max_length[45]");
			$this->form_validation->set_rules("txtPaterno", "Apellido Paterno", "trim|required|max_length[45]");
			$this->form_validation->set_rules("txtMaterno", "Apellido Materno", "trim|required|max_length[45]");
			$this->form_validation->set_rules("txtUsuario", "Usuario", "trim|required|is_unique[usuarios.usuario]|max_length[45]");
			$this->form_validation->set_rules("txtContra", "Contraseña", "trim|required");
			$this->form_validation->set_rules("txtConfContra", "Repetir Contraseña", "trim|required|matches[txtContra]");
			$this->form_validation->set_message("required", "El campo {field} es obligatorio");
			$this->form_validation->set_message("is_unique", "El {field} ya existe");
			$this->form_validation->set_message("matches", "Las contraseñas deben coincidir");
			$this->form_validation->set_message("max_length", "Máximo {param} caracteres");
			if ($this->form_validation->run()) {
				$fecha = DateTime::createFromFormat("d/m/Y", $post['fecha']);
				$usuario = array(
					'nombre' => $post['txtNombre'],
					'paterno' => $post['txtPaterno'],
					'materno' => $post['txtMaterno'],
					'usuario' => $post['txtUsuario'],
					'contra' => $post['txtContra'],
					'create_at' => $fecha->format("Y-m-d"),
					'id_perfil' => getIdPerfil("Cliente"),
					'status' => 1 //Status cliente activo
				);
				$idUsuario = $this->UsuariosModelo->insertar($usuario);
				if ($idUsuario)
					echo json_encode( array( 'code' => 1, 'msg' => $idUsuario ) );
				else
					echo json_encode( array( 'code' => -1, 'msg' => 'No se pudo registrar el usuario') );
			}
			else {
				echo json_encode(array('code' => 0, 
					'msg' => 
						"txtNombre=".form_error("txtNombre")."&".
						"txtUsuario=".form_error("txtUsuario")."&".
						"txtPaterno=".form_error("txtPaterno")."&".
						"txtMaterno=".form_error("txtMaterno")."&".
						"txtContra=".form_error("txtContra")."&".
						"txtConfContra=".form_error("txtConfContra")
				));
			}
		}
		else
			redirect(base_url());
	}
}