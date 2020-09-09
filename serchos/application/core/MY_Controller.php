<?php
defined("BASEPATH") OR exit("No direct script access allowed");

class MY_Controller extends CI_Controller {

    private $vista;
    private $form;
    private $tabla;
    private $modelos;
    private $modulo;

    public function __construct () {
        parent::__construct();
        if (is_array($this->modelos))
            foreach ($this->modelos as $modelo)
                $this->load->model($modelo);
        else
            $this->load->model($this->modelos);
        $this->load->helper("global_functions_helper");
        $this->modulo = getModulo($this->modulo);
        $this->form_validation->set_error_delimiters("", "");
    }


    protected function validarAcceso () {
        return tieneAcceso($this->session->extempo['id_perfil'], $this->modulo['id']);
    }

}