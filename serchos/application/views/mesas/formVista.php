<?php $this->load->view("global/header") ?>
<?php $this->load->view("global/navbar") ?>
<main class="content-wrapper no-aside">
	<section class="content" id="tabla">
		<div class="row">
			<div class="col-xs-3">
				<a href="<?php echo base_url("index.php/mesas") ?>" class="btn btn-default"><i class="fas fa-arrow-left"></i></a>
			</div>
		</div>
		<form id="frm-mesa" method="post"
			action="<?php echo base_url("index.php/mesas/").$metodo ?>">
			<input type="hidden" id="idMesa" name="idMesa" value="<?php echo isset($mesa)? $mesa['id']: '' ?>">
			<div class="row">
				<!-- Nombre del tipo de mesa -->
				<div class="form-group col-sm-5 <?php echo form_error("txtNombre")? 'has-error' : '' ?>">
					<?php 
						$nombre = isset($mesa)? $mesa['nombre']: '';
						if (set_value("txtNombre"))
							$nombre = set_value("txtNombre");
					?>
					<label for="txtNombre">Nombre del tipo de mesa</label>
					<input value="<?php echo $nombre ?>" name="txtNombre" 
						id="txtNombre" class="form-control">
					<?php if (form_error("txtNombre")): ?>
						<small class="help-block text-danger">
							<?php echo form_error("txtNombre") ?>
						</small>
					<?php endif; ?>
				</div>
				<!-- Cantidad de mesas -->
				<div class="form-group col-xs-6
					<?php echo form_error("txtCantidad")?'has-error':'' ?>">
					<?php 
						$cantidad = isset($mesa)? $mesa['cantidad']: '';
						if (set_value("txtCantidad"))
							$cantidad = set_value("txtCantidad");
					?>
					<label for="txtCantidad">Cantidad de mesas</label>
					<input value="<?php echo $cantidad ?>" name="txtCantidad" 
						id="txtCantidad" class="form-control">
					<?php if (form_error("txtCantidad")): ?>
						<small class="help-block text-danger">
							<?php echo form_error("txtCantidad") ?>
						</small>
					<?php endif; ?>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-4">
					<button type="submit" class="btn btn-success" id="btn-save">Guardar</button>
					<button type="reset" class="btn btn-default" id="btn-clean">Limpiar</button>
				</div>
			</div>
		</form>
	</section>
</main>
<?php $this->load->view("global/footer") ?>
<?php $this->load->view("mesas/scriptJS") ?>