<?php
defined("BASEPATH") OR exit("No direct script access allowed");

class Reportes extends MY_Controller {

	public $modulo; 

	public function __construct () {
		parent::__construct();
		$this->load->helper("global_functions_helper");
		$this->load->model("ReportesModelo");
		$this->modulo = getModulo("Historial de platillos");
		date_default_timezone_set("America/Mazatlan");
	}

	public function platillos () {
		if (!validarAcceso()) {
			redirect(base_url());
		} else {
			$fecha = DateTime::createFromFormat("d/m/Y", $this->input->post("txtFecha"));
			if (is_bool($fecha))
				$fecha = new datetime();
			$platillos = $this->ReportesModelo->platillos($fecha->format("Y-m-d"));
			$data = array(
				'titulo' => 'Historial del platillos',
				'platillos' => $platillos,
				'dia' => $fecha->format("d"),
				'mes' => $fecha->format("m"),
				"año" => $fecha->format("Y")
			);
			$this->load->view("reportes/platillos/mainVista", $data);
		}
	}

	public function diario () {
		if (validarAcceso()) {
			date_default_timezone_set("America/Mazatlan");
			$post = $this->input->post();
			if (isset($post['txtFechaInicio']))
				$fechaInicio = DateTime::createFromFormat("d/m/Y", $post['txtFechaInicio']);
			else
				$fechaInicio = new datetime();
			if (isset($post['txtFechaFin']))
				$fechaFin = DateTime::createFromFormat("d/m/Y", $post['txtFechaFin']);
			else
				$fechaFin = null;
			$data = array(
				'titulo' => 'Reporte diario',
				'comandas' => $this->ReportesModelo->comandas($fechaInicio, $fechaFin)
			);
			$this->load->view("reportes/comandas/mainVista", $data);
		} 
		else redirect(base_url());
	}

	public function caja () {
		if (!validarAcceso()) {
			redirect(base_url());
		} else {
			$fecha = DateTime::createFromFormat("d/m/Y", $this->input->post("txtFechaInicio"));
			if (is_bool($fecha))
				$fecha = new datetime();
			$data = array(
				'titulo' => 'Historial de caja',
				'comandas' => $this->ReportesModelo->comandas($fecha)
			);
			$this->load->view("reportes/comandas/mainVista", $data);
		}
	}

	public function rango () {
		if (!validarAcceso()) {
			redirect(base_url());
		}
		else {
			$fechaInicio = DateTime::createFromFormat("d/m/Y", $this->input->post("txtFechaInicio"));
			if (is_bool($fechaInicio))
				$fechaInicio = new datetime();
			$fechaFin = DateTime::createFromFormat("d/m/Y", $this->input->post("txtFechaFin"));
			if (is_bool($fechaFin))
				$fechaFin = new datetime();
			$data = array(
				'titulo' => 'Reporte por rango',
				'comandas' => $this->ReportesModelo->comandas($fechaInicio, $fechaFin),
				'rango' => true
			);
			$this->load->view("reportes/comandas/mainVista", $data);
		}
	}
}