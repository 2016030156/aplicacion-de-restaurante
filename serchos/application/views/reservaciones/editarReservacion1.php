<?php $this->load->view("global/header") ?>
<?php $this->load->view("global/navbar") ?>
<main class="content-wrapper no-aside">
	<section class="content" id="frm">
		<div class="row">
			<div class="col-xs-3">
				<a class="btn btn-default" href="<?php echo base_url("index.php/reservaciones/") ?>">
					<i class="fas fa-arrow-left"></i>
				</a>
			</div>
		</div>
		<div class="clear">&nbsp;</div>
		<form method="post" id="reservar1" name="reservar1"
			action="<?php echo base_url("index.php/reservaciones/editar/").$reservacion['id'] ?>">
			<input type="hidden" name="paso" value="2">
			<input type="hidden" name="idResrevacion" value="<?php echo $reservacion['id'] ?>">
			<div class="row">
				<!-- cmbTipoMesa -->
				<div class="form-group col-xs-3 
					<?php echo form_error("cmbTipoMesa")? 'has-error' : '' ?>">
					<?php 
						$tipo = $reservacion['id_mesa'];
						if (set_value("cmbTipoMesa"))
							$tipo = set_value("cmbTipoMesa");
					?>
					<label for="cmbTipoMesa">Tipo de mesa</label>
					<select name="cmbTipoMesa" id="cmbTipoMesa" class="form-control">
						<option value="0"
							<?php echo $tipo == 0 ? 'selected' : '' ?>>
							Selecciona un tipo de mesa
						</option>
						<option value="1"
							<?php echo $tipo == 1 ? 'selected' : '' ?>>
							Mesa para 2
						</option>
						<option value="2"
							<?php echo $tipo == 2 ? 'selecteed' : '' ?>>
							Mesa para 4
						</option>
					</select>
					<?php if (form_error("cmbTipoMesa")): ?>
						<small class="help-block text-danger">
							<?php echo form_error("cmbTipoMesa") ?>
						</small>
					<?php endif; ?>
				</div>
				<!-- txtFecha -->
				<div class="form-group col-xs-2
					<?php echo form_error("txtFecha")? 'has-error' : '' ?>">
					<?php
						$fecha = new datetime($reservacion['fecha']);
						if (set_value("txtFecha"))
							$fecha = DateTime::createFromFormat("d/m/Y", set_value("txtFecha"));
					?>
					<label for="txtFecha">Fecha</label>
					<input type="text" class="fecha form-control" 
						name="txtFecha" id="txtFecha"
						value="<?php echo $fecha->format('d/m/Y') ?>">
					<?php if (form_error("txtFecha")): ?>
						<small class="help-block text-danger">
							<?php echo form_error("txtFecha") ?>
						</small>
					<?php endif; ?>
				</div>
				<!-- txtHoraInicio -->
				<div class="form-group col-xs-2 
					<?php echo form_error("txtHoraInicio")? 'has-error' : '' ?>">
					<label for="txtHoraInicio">Hora Inicio</label>
					<?php 
						$horaInicio = new datetime($reservacion['hora_inicio']);
						if (set_value("txtHoraInicio"))
							$horaInicio = new datetime(set_value("txtHoraInicio"));
					?>
					<input type="text" class="form-control hora" 
						id="txtHoraInicio" name="txtHoraInicio" 
						value="<?php echo $horaInicio->format("H:i") ?>">
					<?php if (form_error("txtHoraInicio")): ?>
						<small class="help-block text-danger">
							<?php echo form_error("txtHoraInicio") ?>
						</small>
					<?php endif; ?>
				</div>
				<!-- txtHoraFin -->
				<div class="form-group col-xs-2 
					<?php echo form_error("txtHoraFin")? 'has-error' : '' ?>">
					<label for="txtHoraFin">Hora Fin</label>
					<?php 
						$horaFin = new datetime($reservacion['hora_fin']);
						if (set_value("txtHoraFin"))
							$horaFin = new datetime(set_value("txtHoraFin"));
					?>
					<input type="text" class="form-control hora" 
						id="txtHoraFin" name="txtHoraFin" 
						value="<?php echo $horaFin->format("H:i") ?>">
					<?php if (form_error("txtHoraFin")): ?>
						<small class="help-block text-danger">
							<?php echo form_error("txtHoraFin") ?>
						</small>
					<?php endif; ?>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-2 col-xs-offset-10">
					<button type="submit" class="btn btn-primary">
						Verificar disponibilidad
					</button>
				</div>
			</div>
		</form>
	</section>
</main>
<?php $this->load->view("global/footer") ?>
<?php $this->load->view("reservaciones/scriptJS") ?>