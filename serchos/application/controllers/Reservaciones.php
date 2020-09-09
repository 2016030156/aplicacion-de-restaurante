<?php
defined("BASEPATH") OR exit("No direct script access allowed");

class Reservaciones extends MY_Controller {

	public $modulo; 

	public function __construct () {
		parent::__construct();
		$this->load->helper("global_functions_helper");
		$this->load->model("ReservacionesModelo");
		$this->load->model("UsuariosModelo");
		$this->load->model("MesasModelo");
		$this->modulo = getModulo("reservaciones");
		date_default_timezone_set("America/Mazatlan");
		$this->form_validation->set_message("required", "Este campo es obligatorio");
	}

	public function index () {
		if (!validarAcceso()) {
			redirect(base_url());
		} else {
			$where['fecha'] = DaTeTime::createFromFormat("d/m/Y", $this->input->post("txtFecha"));
			if (is_bool($where['fecha']))
				$where['fecha'] = new datetime();
			if (getIdPerfil("Cliente") == $this->session->serchos['idPerfil'])
				$where['id_cliente'] = $this->session->serchos['idUsuario'];
			$dia = $where['fecha']->format("d");
			$mes = $where['fecha']->format("m");
			$año = $where['fecha']->format("Y");
			$where['fecha'] = $where['fecha']->format("Y-m-d");
			$data = array( 
				'dia' => $dia,
				'mes' => $mes,
				'año' => $año,
				'titulo' => "Reservaciones",
				'reservaciones' => $this->ReservacionesModelo->listar($where)
			);	
			$this->load->view("reservaciones/mainVista", $data);
		}
	}

	public function editar ($idReservacion = null) {
		if (!validarAcceso() || $idReservacion == null) {
			redirect(base_url());
		} else if (is_bool($reservacion = $this->esReserValida($idReservacion))) {
			$this->session->set_flashdata("error", "La reservación no es válida.");
			redirect(base_url("index.php/reservaciones"));
		} else if ($this->input->post("paso") == "2") {
			if (!$this->validarForm1()) { //si hay errores, vuelve paso 1
				$data = array(
					'titulo' => "Reservaciones",
					'reservacion' => $reservacion
				);
				if (7 != $this->session->serchos['idPerfil'])
					$data['clientes'] = $this->UsuariosModelo->clientes();
				$this->load->view("reservaciones/editarReservacion1", $data);
			} else { //entra al paso dos si el form es correcto
				$this->ReservacionesModelo->reservacionModificable($reservacion['id']);
				$cantMesasDis = $this->getMesasDisponibles();
				$data = array( 
					'titulo' => "Reservaciones",
					'data' => $this->input->post(),
					'cantMesasDis' => $cantMesasDis,
					'reservacion' => $reservacion
				);
				if (7 != $this->session->serchos['idPerfil'])
					$data['clientes'] = $this->UsuariosModelo->clientes();
				$this->load->view("reservaciones/editarReservacion2", $data);
			}
		} else {//entra al paso 1 la de forma normal
			$data = array(
				'titulo' => "Reservaciones",
				'reservacion' => $reservacion
			);
			if (7 != $this->session->serchos['idPerfil'])
				$data['clientes'] = $this->UsuariosModelo->clientes();
			$this->load->view("reservaciones/editarReservacion1", $data);
		}
	}

	public function esReserValida ($idReservacion) {
		$where['id'] = $idReservacion;
		$res = $this->ReservacionesModelo->buscar($where);
		if (is_array($res))
			return $res;
		return false;
	}

	public function insertar () {
		if (!validarAcceso()) {
			redirect(base_url());
		} else if (!$this->validarForm2()) {
			$cantMesasDis = $this->getMesasDisponibles();
			$reservar2 = array( 
				'titulo' => "Reservaciones",
				'clientes' => $this->UsuariosModelo->clientes(),
				'data' => $this->input->post(),
				'cantMesasDis' => $cantMesasDis
			);
			$this->load->view("reservaciones/reservar2", $reservar2);
		} else {
			$post = $this->input->post();
			$fecha = DateTime::createFromFormat("d/m/Y", $post['txtFecha']);
			$horaInicio = DateTime::createFromFormat("H:i", $post['txtHoraInicio']);
			$horaFin = DateTime::createFromFormat("H:i", $post['txtHoraFin']);
			if ($this->session->serchos['idPerfil'] != getIdPerfil("Cliente"))
				$idCliente = $post['cmbCliente'];
			else
				$idCliente = $this->session->serchos['idUsuario'];
			$reservacion = array(
				'fecha' => $fecha->format("Y-m-d"),
				'hora_inicio' => $horaInicio->format("H:i:s"),
				'hora_fin' => $horaFin->format("H:i:s"),
				'cant_mesa' => $post['txtCantidad'],
				'id_cliente' => $idCliente,
				'id_mesa' => $post['cmbTipoMesa']
			);
			$idReservacion = $this->ReservacionesModelo->insertar($reservacion);
			if ($idReservacion == false) {
				$this->session->set_flashdata("error", "No se pudo registrar la reservación.");
			} else {
				$this->session->set_flashdata("success", "Reservación registrada.");
			}
			redirect(base_url("index.php/reservaciones"));
		}
	}

	public function actualizar () {
		if (!validarAcceso()) {
			redirect(base_url());
		} else if (!$this->validarForm2()) {
			$where['id'] = $this->input->post("idReservacion");
			$reservacion = $this->ReservacionesModelo->buscar($where);
			$this->ReservacionesModelo->reservacionModificable($reservacion['id']);
			$cantMesasDis = $this->getMesasDisponibles();
			$data = array( 
				'titulo' => "Reservaciones",
				'clientes' => $this->UsuariosModelo->clientes(),
				'data' => $this->input->post(),
				'cantMesasDis' => $cantMesasDis,
				'reservacion' => $reservacion
			);
			$this->load->view("reservaciones/editarReservacion2", $data);
		} else {
			$post = $this->input->post();
			$fecha = DateTime::createFromFormat("d/m/Y", $post['txtFecha']);
			$horaInicio = DateTime::createFromFormat("H:i", $post['txtHoraInicio']);
			$horaFin = DateTime::createFromFormat("H:i", $post['txtHoraFin']);
			if ($this->session->serchos['idPerfil'] != getIdPerfil("Cliente"))
				$idCliente = $post['cmbCliente'];
			else
				$idCliente = $this->session->serchos['idUsuario'];
			$reservacion = array(
				'fecha' => $fecha->format("Y-m-d"),
				'hora_inicio' => $horaInicio->format("H:i:s"),
				'hora_fin' => $horaFin->format("H:i:s"),
				'cant_mesa' => $post['txtCantidad'],
				'id_cliente' => $idCliente,
				'id_mesa' => $post['cmbTipoMesa'],
				'status' => 1 //deja de ser modificable
			);
			$where['id'] = $this->input->post("idReservacion");
			$idReservacion = $this->ReservacionesModelo->actualizar($reservacion, $where);
			if ($idReservacion == false) {
				$this->session->set_flashdata("error", "No se pudo registrar la reservación.");
			} else {
				$this->session->set_flashdata("success", "Reservación actualizada.");
			}
			redirect(base_url("index.php/reservaciones"));
		}
	}

	public function nueva () {
		$fecha = new datetime();
		$reservar1 = array( 
			'titulo' => "Reservaciones",
			'dia' => $fecha->format("d"),
			'mes' => $fecha->format("m"),
			'año' => $fecha->format("Y")
		);
		if (!validarAcceso()) {
			redirect(base_url());
		} else if ($this->input->post("paso") == "2") { //selección de cliente y/o cantidad
			if (!$this->validarForm1()) {
				if (form_error("txtFecha")) {
					$fecha = DaTeTime::createFromFormat("d/m/Y", $this->input->post("txtFecha"));
					$reservar1['dia'] = $fecha->format("d");
					$reservar1['mes'] = $fecha->format("m");
					$reservar1['año'] = $fecha->format("Y");
				}
				$this->load->view("reservaciones/reservar1", $reservar1);
			} else if (($cantMesasDis = $this->getMesasDisponibles()) == 0) {
				$this->session->set_flashdata("error", "No hay mesas disponibles.<br>Seleccione otra configuración");
				$this->load->view("reservaciones/reservar1", $reservar1);
			} else {
				$reservar2 = array( 
					'titulo' => "Reservaciones",
					'clientes' => $this->UsuariosModelo->clientes(),
					'data' => $this->input->post(),
					'cantMesasDis' => $cantMesasDis
				);
				$this->load->view("reservaciones/reservar2", $reservar2);
			}
		} else {
			$this->load->view("reservaciones/reservar1", $reservar1);
		}
	}

	private function validarForm1 () {
		$this->form_validation->set_rules("cmbTipoMesa", "Tipo de mesa", "required|callback_validarMesa");
		$this->form_validation->set_rules("txtFecha", "Fecha", "required|callback_validarFecha");
		$this->form_validation->set_rules("txtHoraInicio", "Hora Inicio", "required|callback_validarHora");
		$this->form_validation->set_rules("txtHoraFin", "Hora Fin", "required|callback_validarHora");
		return $this->form_validation->run();
	}

	private function validarForm2 () {
		$idPerfil = $this->session->serchos['idPerfil'];
		if ($idPerfil != getIdPerfil("Cliente"))
			$this->form_validation->set_rules("cmbCliente", "Cliente", "required|callback_validarCliente");
		$this->form_validation->set_rules("txtCantidad", "Cantidad", 
			"required|numeric|less_than_equal_to[{$this->input->post('cantLimit')}]");
		$this->form_validation->set_message("less_than_equal_to", 
			"El campo {field} debe ser menor o igual a {param}");
		return $this->form_validation->run();
	}

	public function validarFecha ($fecha) {
		$fecha = DateTime::createFromFormat("d/m/Y", $fecha);
		$valores = explode('/', $fecha->format("d/m/Y"));
		if(count($valores) == 3 && checkdate($valores[1], $valores[0], $valores[2])){
			$fechaActual = new datetime();
			$fechaActual = strtotime($fechaActual->format("Y-m-d"));
			$fecha = strtotime($fecha->format("Y-m-d"));
			if ($fecha < $fechaActual) {
				$this->form_validation->set_message("validarFecha", "La fecha no puede ser menor a la actual");
				return false;
			}
			return true;
	    }
	    $this->form_validation->set_message("validarFecha", "La fecha no es válida");
		return false;
	}

	public function validarCliente ($idCliente) {
		$where['id'] = $idCliente;
		$where['id_perfil'] = getIdPerfil("Cliente");
		$valid = is_array($this->UsuariosModelo->buscar($where));
		if (!$valid)
			$this->form_validation->set_message("validarCliente", "El cliente ingresado no es válido.");
		return $valid;
	}

	public function validarHora ($hora) {
		$hora = DateTime::createFromFormat("H:i", $hora);
		$inicio = new datetime("08:00:00");
		$valid = $hora >= $inicio;
		if (!$valid) {
			$this->form_validation->set_message("validarHora", "La hora inicial debe ser mayor a 08:00:00");
			return false;
		}
		$fin = new datetime("21:00:00");
		$valid = $hora <= $fin;
		if (!$valid) {
			$this->form_validation->set_message("validarHora", "La hora final debe ser menor a 21:00:00.");
			return false;
		}
		return true;
	}

	public function validarMesa ($idMesa) {
		$valid = $this->ReservacionesModelo->isMesa($idMesa);
		if (!$valid)
			$this->form_validation->set_message("validarMesa", "La hora seleccionada no es válida.");
		return $valid;
	}

	public function isValidReser () {
		$idTipoHora = $this->input->post("idTipoHora");
		$idTipoMesa = $this->input->post("idTipoMesa");
		$fecha = DaTeTime::createFromFormat("d/m/Y", $this->input->post("txtFecha"));
		if (is_bool($fecha))
			$fecha = new datetime();
		$fecha = $fecha->format("Y-m-d");
		return $this->ReservacionesModelo->puedoReservar($idTipoMesa, $idTipoHora, $fecha);
	}

	public function cancelar ($idReservacion = null) {
		if (!validarAcceso(true))  {
			redirect(base_url());
		} else if ($idReservacion == null) {
			$res['code'] = -1;
			$res['msg'] = "La reservación no es válida.";
		} else {
			$where['id'] = $idReservacion;
			$data['status'] = 0;
			if ($this->ReservacionesModelo->actualizar($data, $where)) {
				$res['code'] = 1;
				$res['msg'] = "Reservación cancelada";
			}
			else {
				$res['code'] = 0;
				$res['msg'] = "No se pudo cancelar la reservación";
			}
			echo json_encode($res);
		}
	}

	public function getMesasDisponibles () {
		$horaInicio = DateTime::createFromFormat("H:i", $this->input->post("txtHoraInicio"));
		$horaFin = DateTime::createFromFormat("H:i", $this->input->post("txtHoraFin"));
		$fecha = DaTeTime::createFromFormat("d/m/Y", $this->input->post("txtFecha"));
		$data = array(
			'idMesa' => $this->input->post("cmbTipoMesa"),
			'horaInicio' => $horaInicio->format("H:i:s"),
			'horaFin' => $horaFin->format("H:i:s"),
			'fecha' => $fecha->format("Y-m-d")
		);
		return $this->ReservacionesModelo->mesasDisponibles($data);
	}
}