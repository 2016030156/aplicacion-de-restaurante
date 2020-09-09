<?php
defined("BASEPATH") OR exit("No direct script access allowed");

class Platillos extends CI_Controller {
    
    public $modulo = "Platillos";
    public $form = "platillos/formVista";
    public $tabla = "platillos/tablaVista";
    public $script = "platillos/scriptJS";

    public function __construct () {
        parent::__construct();
        $this->load->model("PlatillosModelo");
        $this->load->helper("global_functions_helper");
        $this->modulo = getModulo($this->modulo);
        $moduloPadre = getModulo("Restaurante");
        $this->session->set_tempdata("idModuloPadreActual", $moduloPadre['id'] , 60);
        $this->session->set_tempdata("idModuloActual", $this->modulo['id'] , 60);
    }

    public function index ($filtro = "todos") {
        if (!validarAcceso()) {
            redirect(base_url());
        } else {
            if ($filtro == "activos") {
                $where['status'] = 1;
            } else if ($filtro == "inactivos") {
                $where['status'] = 0;
            } else {
                $where = null;
            }
            $data = array(
                'titulo' => $this->modulo['nombre'],
                'platillos' => $this->PlatillosModelo->listar(),
                'filtro' => $filtro
            );
            $this->load->view("platillos/mainVista", $data);
        }
    }

    public function agregar () {
        if (!validarAcceso()) {
            redirect(base_ur());
        } else {
            $data = array(
                'titulo' => "Platillos",
                'metodo' => "insertar"
            );
            $this->load->view("platillos/formVista", $data);
        }
    }

    public function insertar () {
        if (!validarAcceso()) {
            redirect(base_url());
        } else if (!$this->form_validation()) { 
            $this->session->set_flashdata("error", "Corregir los errores del formulario.");
            redirect(base_url("index.php/platillos/agregar"));
        } else {
            $post = $this->input->post();
            $fecha = new datetime();
            $platillo = array(
                'nombre' => $post['txtNombre'],
                'precio' => $post['txtPrecio'],
                'status' => 1,
                'create_at' => $fecha->format("Y-m-d")
            );
            if ($this->PlatillosModelo->insertar($platillo) === false) {
                $this->session->set_flashdata("error", "No se pudo insertar el platillo.");
            } else {
                $this->session->set_flashdata("success", "El platillo fue insertado.");
            }
            redirect(base_url("index.php/platillos"));
        }
    }

    public function editar ($idPlatillo = null) {
        if (!validarAcceso()) {
            redirect(base_ur());
        } else if ($idPlatillo == null) {
            $this->session->set_flashdata("error", "El platillo ingresado no es válido.");
            redirect(base_url("index.php/platillos"));
        } else {
            $where['id'] = $idPlatillo;
            $platillo = $this->PlatillosModelo->buscar($where);
            $data = array(
                'titulo' => "Platillos",
                'metodo' => "actualizar",
                'platillo' => $platillo
            );
            $this->load->view("platillos/formVista", $data);
        }
    }

    public function actualizar () {
        if (!validarAcceso()) {
            redirect(base_url());
        } else if (!$this->form_validation($this->input->post("idPlatillo"))) {
            $this->session->set_flashdata("error", "Corregir los errores de formulario.");
            redirect(base_url("index.php/platillos/editar/").$this->input->post("idPlatillo"));
        } else {
            $post = $this->input->post();
            $platillo = array(
                'nombre' => $post['txtNombre'],
                'precio' => $post['txtPrecio']
            );
            $where["id"] = $post['idPlatillo'];
            if (!$this->PlatillosModelo->actualizar($platillo, $where)) {
                $this->session->set_flashdata("error", "No se pudo actualizar el platillo.");
            } else {
                $this->session->set_flashdata("success", "Platillo actualizado.");
            }
            redirect(base_url("index.php/platillos"));
        }
    }

    private function form_validation ($idPlatillo = 0) {
        $uNombre = "|is_unique[platillos.nombre]";
        if ($idPlatillo != 0) {
            $platillo = $this->PlatillosModelo->buscar(array("id" => $idPlatillo));
            if ($platillo) {
                $nombre = $this->input->post("txtNombre");
                if (strcmp($nombre, $platillo['nombre']) == 0)
                    $uNombre = "";
            }
        }
        $this->form_validation->set_rules("txtNombre", "Nombre", "trim|required".$uNombre);
        $this->form_validation->set_rules("txtPrecio", "Precio", "trim|required|numeric");
        $this->form_validation->set_message("required", "El campo {field} es obligatorio");
        $this->form_validation->set_message("numeric", "El campo {field} solo puede contener caracteres numericos");
        $this->form_validation->set_message("is_unique", "El {field} ingresado ya existe");
        return $this->form_validation->run();
    }
    
    private function hayMasDe ($cantidad) {
        $total = $this->PlatillosModelo->totalPlatillos();
        return $total > $cantidad;
    }

   public function cancelar ($idPlatillo = null) {
        if (!validarAcceso(true)) {
            redirect(base_url());
        } else if ($idPlatillo == null) {
            echo json_encode(array("code" => -1, "msg" => "El id ingresado no es válido."));
        } else {
            $where['id'] = $idPlatillo;
            $data['status'] = 0;
            if ($this->PlatillosModelo->actualizar($data, $where)) {
                echo json_encode(array("code" => 1, "msg" => "Platillo deshabilitado."));
            } else {
                echo json_encode(array("code" => 0, 
                    "msg" => "No se pudo deshabilitar el platillo."));
            }
        }
    }
}