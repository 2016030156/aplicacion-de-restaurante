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
		<form method="post" id="frm-reservacion" name="frmReservacion"
			action="<?php echo base_url("index.php/reservaciones/").$metodo ?>">
			<?php 
				$idPerfil = $this->session->serchos['idPerfil'];
				$idPefil = $idPerfil == getIdPerfil("Recepcionista");
				$idPefil = $idPerfil == getIdPerfil("Administrador");
				$idPefil = $idPerfil == getIdPerfil("Gerente");
				$isCliente = $this->session->serchos['idPerfil'] != getIdPerfil("Cliente");
			?>
			<?php if ($idPerfil != false): ?>
				<div id="msg-box" class="alert alert-danger" hidden>
				</div>
				<div class="row">
					<?php if ($isCliente): ?>
						<!-- cmbCliente -->
						<div class="form-group col-xs-3 <?php echo form_error("cmbCliente")? 'has-error' : '' ?>">
							<?php 
								$cli = $reservacion != false? $reservacion['id_cliente'] : '';
								if (set_value("cmbCliente"))
									$cli = set_value("cmbCliente");
							?>
							<label for="cmbCliente">Cliente</label>
							<select type="text" name="cmbCliente" class="form-control">
								<option value="0">Selecciona un cliente</option>
								<?php if (is_array($clientes)): ?>
									<?php foreach ($clientes as $cliente): ?>
										<option <?php echo $cli == $cliente['id'] ? 'selected' : '' ?>
											value="<?php echo $cliente['id'] ?>">
											<?php 
												echo $cliente['nombre'] .
													" " . $cliente['paterno'] .
													" " . $cliente['materno'];
											?>
										</option>
									<?php endforeach; ?>
								<?php endif; ?>
							</select>
							<?php if (form_error("cmbCliente")): ?>
								<small class="help-block text-danger">
									<?php echo form_error("cmbCliente") ?>
								</small>
							<?php endif; ?>
						</div>
					<?php endif; ?>
					<!-- cmbTipoMesa -->
					<div class="form-group col-xs-3 
						<?php echo form_error("cmbTipoMesa")? 'has-error' : '' ?>">
						<?php 
							$tipo = $reservacion != false? $reservacion['tipo_mesa']: '';
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
							$fecha = $reservacion != false ? $reservacion['fecha'] : '';
							if (set_value("txtFecha"))
								$fecha = set_value("txtFecha");
							$fecha = new datetime($fecha);
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
				</div>
				<div class="row">
					<!-- txtHoraInicio -->
					<div class="form-group col-xs-2 
						<?php echo form_error("txtHoraInicio")? 'has-error' : '' ?>">
						<label for="txtHoraInicio">Hora Inicio</label>
						<?php 
							$horaInicio = $reservacion != false? $reservacion['hora_inicio'] : '08:00:00';
							if (set_value("txtHoraInicio"))
								$horaInicio = set_value("txtHoraInicio");
						?>
						<input type="text" class="form-control hora" 
							id="txtHoraInicio" name="txtHoraInicio" 
							value="<?php echo $horaInicio ?>">
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
							$horaFin = $reservacion != false? $reservacion['hora_fin'] : '09:00:00';
							if (set_value("txtHoraFin"))
								$horaFin = set_value("txtHoraFin");
						?>
						<input type="text" class="form-control hora" 
							id="txtHoraFin" name="txtHoraFin" 
							value="<?php echo $horaFin ?>">
						<?php if (form_error("txtHoraFin")): ?>
							<small class="help-block text-danger">
								<?php echo form_error("txtHoraFin") ?>
							</small>
						<?php endif; ?>
					</div>
					<!-- Cantidad Mesas -->
					<div class="form-group col-xs-5
						<?php echo form_error("txtCantidad")? 'has-error':'' ?>">
						<div class="col-xs-4">
							<label for="txtCantidad">Cantidad Mesas</label>
							<?php 
								$cantidad = $reservacion != false? $reservacion['cantidad'] : '1';
								if (set_value("txtCantidad"))
									$cantidad = set_value("txtCantidad");
							?>
							<input type="text" class="form-control"
								id="txtCantidad" name="txtCantidad"
								value="<?php echo $cantidad ?>">
						</div>
						<div class="col-xs-6">
							<h3 class="text-muted" style="margin-top:11%;"
								id="cantidad-sugerida">
								0 disponibles
							</h3>
						</div>
						<?php if (form_error("txtCantidad")): ?>
							<small class="help-block text-danger">
								<?php echo form_error("txtCantidad") ?>
							</small>
						<?php endif; ?>
					</div>
				</div>
			<?php endif; ?>
			<div class="row">
				<div class="col-xs-2">
					<button onclick="verificar()" type="button" class="btn btn-primary">
						Verificar disponibilidad
					</button>
				</div>
				<div class="col-xs-2">
					<?php 
						if ($metodo == "actualizar") {
							$class = "btn-warning";
							$text = "Modificar";
						} else {
							$class = "btn-success";
							$text = "Reservar";
						}
					?>
					<button id="btn-reservar" type="button" onclick="reservar()" class="btn <?php echo $class ?>" disabled="true">
						<?php echo $text ?>
					</button>
				</div>
			</div>
		</form>
	</section>
</main>
<?php $this->load->view("global/footer") ?>
<?php $this->load->view("reservaciones/scriptJS") ?>