<?php $this->load->view("global/header") ?>
<?php $this->load->view("global/navbar") ?>
<main class="content-wrapper no-aside">
	<section class="content" id="tabla">
		<div class="row">
			<div class="col-xs-3">
				<a href="<?php echo base_url("index.php/platillos") ?>" class="btn btn-default"><i class="fas fa-arrow-left"></i></a>
			</div>
		</div>
		<form id="frm-platillo" method="post"
			action="<?php echo base_url("index.php/platillos/").$metodo ?>">
			<input type="hidden" id="idPlatillo" name="idPlatillo" 
				value="<?php echo isset($platillo)? $platillo['id'] : '' ?>">
			<div class="row">
				<div class="form-group col-sm-4 
					<?php echo form_error("txtNombre")?'has-error':''?>">
					<?php 
						$nombre = isset($platillo) ? $platillo['nombre'] : '';
						if (set_value("txtNombre"))
							$nombre = set_value("txtNombre");
					?>
					<label for="txtNombre">Nombre</label>
					<input type="text" class="form-control" 
						id="txtNombre" name="txtNombre"
						value="<?php echo $nombre ?>">
					<?php if (form_error("txtNombre")): ?>
						<small class="help-block text-danger">
							<?php echo form_errro("txtNombre") ?>
						</small>
					<?php endif; ?>
				</div>
				<div class="form-group col-sm-4 
					<?php echo form_error("txtPrecio")?'has-error':''?>">
					<?php 
						$precio = isset($platillo) ? $platillo['precio'] : '';
						if (set_value("txtPrecio"))
							$precio = set_value("txtPrecio");
					?>
					<label for="txtPrecio">Precio</label>
					<input type="text" class="form-control" 
						id="txtPrecio" name="txtPrecio"
						value="<?php echo $precio ?>">
					<?php if (form_error("txtPrecio")): ?>
						<small class="help-block text-danger">
							<?php echo form_error("txtPrecio") ?>
						</small>
					<?php endif; ?>
				</div>
				<div class="form-group col-sm-4">
					<label for="txtStatus">Estado</label>
					<div class="form-control" id="txtStatus" disabled="true">
						<?php echo isset($platillo)? $platillo['status'] == 1? 'Activo' : 'Inactivo' : '' ?>
					</div>
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
<?php $this->load->view("platillos/scriptJS") ?>