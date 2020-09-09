<?php $this->load->view("global/header") ?>
<?php $this->load->view("global/navbar") ?>
<main class="content-wrapper no-aside">
	<section class="content" id="frm">
		<div class="row">
			<div class="col-xs-3">
				<!-- Form para volver al paso anterior -->
				<form method="post"
					action="<?php echo base_url("index.php/reservaciones/nueva") ?>">
					<?php foreach ($data as $name => $value): ?>
						<input type="hidden" 
							name="<?php echo $name ?>" 
							value="<?php echo $value ?>">
					<?php endforeach; ?>
					<button class="btn btn-default" type="submit">
						<i class="fas fa-arrow-left"></i>
					</button>
					<input type="hidden" name="paso" value="1">
				</form>
			</div>
		</div>
		<div class="clear">&nbsp;</div>
		<!-- Este form envia la info para ser guardada -->
		<form method="post" id="reservar2" name="reservar2"
			action="<?php echo base_url("index.php/reservaciones/insertar") ?>">
			<input type="hidden" name="cantLimit" value="<?php echo $cantMesasDis ?>">
			<input type="hidden" name="paso" value="2">
			<?php foreach ($data as $name => $value): ?>
				<input type="hidden"
					name="<?php echo $name ?>"
					value="<?php echo $value ?>">
			<?php endforeach; ?>
			<?php $idPerfil = $this->session->serchos['idPerfil'];
				$isCliente = $idPerfil != 7; 
			?>
			<div class="row">
				<?php if ($isCliente): ?>
					<!-- cmbCliente -->
					<div class="form-group col-xs-3 <?php echo form_error("cmbCliente")? 'has-error' : '' ?>">
						<?php 
							$cli = "0";
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
				<!-- Cantidad Mesas -->
				<div class="form-group col-xs-6
					<?php echo form_error("txtCantidad")? 'has-error':'' ?>">
					<div class="col-xs-4">
						<label for="txtCantidad">Cantidad Mesas</label>
						<?php 
							$cantidad = "1";
							if (set_value("txtCantidad"))
								$cantidad = set_value("txtCantidad");
						?>
						<input type="text" class="form-control"
							id="txtCantidad" name="txtCantidad"
							value="<?php echo $cantidad ?>">
						<?php if (form_error("txtCantidad")): ?>
							<small class="help-block text-danger">
								<?php echo form_error("txtCantidad") ?>
							</small>
						<?php endif; ?>
					</div>
					<div class="col-xs-6">
						<h3 class="text-muted" style="margin-top:11%;"
							id="cantidad-sugerida">
							<?php echo $cantMesasDis ?> mesas disponibles
						</h3>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-2 col-xs-offset-10">
					<button type="submit" class="btn btn-success">
						Reservar
					</button>
				</div>
			</div>
		</form>
	</section>
</main>
<?php $this->load->view("global/footer") ?>