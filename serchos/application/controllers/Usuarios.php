<?php
defined("BASEPATH") OR exit("No direct script access allowed");

class Usuarios extends MY_Controller {
    
    public $modulo = "Usuarios";
    private $registros;
    public $tipo;

    public function __construct () {
    	parent::__construct();
        $this->modulo = getModulo($this->modulo);
        $this->session->set_tempdata('idModuloPadreActual', $this->modulo['id'], 60);
    	$this->load->model("UsuariosModelo");
    	$this->load->model("PerfilesModelo");
        date_default_timezone_set("America/Mazatlan");
    }

    public function index ($tipoUsuario) {
    	if (validarAcceso()) {  
    		$this->registros = $this->UsuariosModelo->$tipoUsuario();
    		$data = array(
    			'titulo' => ucfirst($tipoUsuario),
                'usuarios' => $this->registros,
                'tipo' => $tipoUsuario
    		);
    		$this->load->view("usuarios/mainVista", $data);
    	}
    	else
    		redirect(base_url());
    }

    public function getPerfil ($tipo) {
        if ($tipo == "meseros")
            return "Mesero";
        else if ($tipo == "cajeros")
            return "Caja";
        else if ($tipo == "clientes")
            return "Cliente";
        else if ($tipo == "cocineros")
            return "Cocina";
        else if ($tipo == "recepcionistas")
            return "Recepcion";
        else if ($tipo == "gerentes")
            return "Gerente";
        else if ($tipo == "administradores")
            return "Administrador";
    }

    private function form_validation ($idUsuario = 0) {
    	$uUsuario = "|is_unique[usuarios.usuario]";
    	$contraRules = "";
    	$confContraRules = "";
    	if ($idUsuario != 0) {
    		$usuario = $this->UsuariosModelo->buscar(array("id" => $idUsuario));
    		if ($usuario and strcmp($this->input->post("txtUsuario"), $usuario['usuario']) == 0) {
    			$uUsuario = "";
    		}
    	}
    	$this->form_validation->set_rules("txtNombre", "Nombre(s)", "trim|required|max_length[45]");
    	$this->form_validation->set_rules("txtPaterno", "Apellido Paterno",  "trim|required|max_length[45]");
    	$this->form_validation->set_rules("txtMaterno", "Apellido Materno", "trim|required|max_length[45]");
    	$this->form_validation->set_rules("txtUsuario", "Usuario", "trim|required|max_length[45]".$uUsuario);
        if ($this->input->post("txtContra") != null) {
        	$this->form_validation->set_rules("txtContra", "Contraseña", "required");
        	$this->form_validation->set_rules("txtConfContra", "Repetir Contraseña", "required|matches[txtContra]");
        }
    	$this->form_validation->set_message("required", "El campo {field} es obligatorio");
    	$this->form_validation->set_message("is_unique", "El campo {field} ya existe");
    	$this->form_validation->set_message("matches", "El campo {field} debe coincidir con {param}");
    	$this->form_validation->set_message("max_length", "Máximo {param} caracteres");
    	return $this->form_validation->run();
    }

    public function agregar ($tipo = "clientes") {
        if (!validarAcceso()) {
            redirect(base_url());
        } else {
            $data = array(
                'titulo' => ucfirst($tipo),
                'tipo' => $tipo,
                'metodo' => "insertar",
                'idPerfil' => getIdPerfil($this->getPerfil($tipo))
            );
            $this->load->view("usuarios/formVista", $data);
        }
    }

    public function insertar () {
        if (!validarAcceso()) {
            redirect(base_url());
        } else if (!$this->form_validation()) {
            $this->session->set_flashdata("error", "Corregir errores del formulario");
            $this->agregar($this->input->post("tipo"));
        } else {
            $post = $this->input->post();
            $fecha = new datetime();
            $usuario = array(
                'nombre' => $post['txtNombre'],
                'paterno' => $post['txtPaterno'],
                'materno' => $post['txtMaterno'],
                'usuario' => $post['txtUsuario'],
                'create_at' => $fecha->format("Y-m-d"),
                'status' => 1,
                'contra' => sha1($post['txtContra']),
                'id_perfil' => $post['idPerfil']
            );
            if ($this->UsuariosModelo->insertar($usuario) !== false)
                $this->session->set_flashdata("success", "Usuario insertado.");
            else $this->session->set_flashdata("error", "No se pudo insertar usuario.");
            redirect(base_url("index.php/usuarios/index/").$this->input->post("tipo"));
        }
    }

    public function editar ($tipo = "clientes", $idUsuario = null) {
        if (!validarAcceso()) {
            redirect(base_url());
        } else if ($idUsuario == null) {
            $this->session->set_flashdata("error", "El usuario seleccionado no es válido.");
            redirect(base_url("index.php/usuarios/index/").$tipo);
        } else {
            $where = array("id" => $idUsuario);
            $usuario = $this->UsuariosModelo->buscar($where);
            $data = array(
                'titulo' => ucfirst($tipo),
                'usuario' => $usuario,
                'idPerfil' => $usuario['id_perfil'],
                'tipo' => $tipo,
                'metodo' => "actualizar"
            );
            $this->load->view("usuarios/formVista", $data);
        }
    }

    public function actualizar () {
        if (!validarAcceso()) {
            redirect(base_url());
        } else if (!$this->form_validation($this->input->post('idUsuario'))) {
            $this->session->set_flashdata("error", "Corregir errores del formulario");
            $this->editar($this->input->post("tipo"), $this->input->post("idUsuario"));
        } else {
            $post = $this->input->post();
            $usuario = array(
                'nombre' => $post['txtNombre'],
                'paterno' => $post['txtPaterno'],
                'materno' => $post['txtMaterno'],
                'usuario' => $post['txtUsuario']
            );
            if (isset($post['txtContra']) && !empty($post['txtContra']))
                $usuario['contra'] = $post['txtContra'];
            $where = array("id" => $post['idUsuario']);
            if ($this->UsuariosModelo->actualizar($usuario, $where))
                $this->session->set_flashdata("success", "Usuario actualizado.");
            redirect(base_url("index.php/usuarios/index/").$this->input->post("tipo"));
        }
    }

    public function cancelar ($idMesa = null) {
        if (!validarAcceso(true)) {
            redirect(base_url());
        } else if ($idMesa == null) {
            echo json_encode(array("code" => -1, 
                "msg" => "El id ingresado no es válido."));
        } else {
            $where['id'] = $idMesa;
            $data['status'] = 0;
            if ($this->UsuariosModelo->actualizar($data, $where)) {
                echo json_encode(array("code" => 1, 
                    "msg" => "Usuario deshabilitado."));
            } else {
                echo json_encode(array("code" => 0, 
                    "msg" => "No se pudo deshabilitar el usuario."));
            }
        }
    }
}