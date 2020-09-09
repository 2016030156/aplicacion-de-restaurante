<?php $this->load->view("global/header") ?>
<?php $this->load->view("global/navbar") ?>
<main class="content-wrapper no-aside">
	<section class="content" id="tabla">
		<div class="row">
			<div class="col-xs-3">
				<a href="<?php echo base_url("index.php/usuarios/index/").$tipo ?>" class="btn btn-default"><i class="fas fa-arrow-left"></i></a>
			</div>
		</div>
		<form id="frm-usuario" 
			method="post"
			action="<?php echo base_url("index.php/usuarios/").$metodo ?>">
			<input type="hidden" id="idUsuario" name="idUsuario" 
				value="<?php echo isset($usuario['id'])? $usuario['id']: '' ?>">
			<input type="hidden" name="tipo" value="<?php echo $tipo ?>">
			<input type="hidden" id="perfil" name="perfil">
			<input type="hidden" id="idPerfil" name="idPerfil" value="<?php echo $idPerfil ?>">
			<div class="row">
				<div class="form-group col-sm-4 <?php echo form_error("txtNombre")?'has-error':'' ?>">
					<label for="txtNombre">Nombre(s)</label>
					<?php 
						$nombre = isset($usuario)? $usuario['nombre']:'';
						if (set_value("txtNombre"))
							$nombre = set_value("txtNombre");
					?>
					<input type="text" 
						value="<?php echo $nombre ?>"
						class="form-control" 
						id="txtNombre" 
						name="txtNombre">
					<?php if (form_error("txtNombre")): ?>
						<small class="help-block text-danger">
							<?php echo form_error("txtNombre")  ?>
						</small>
					<?php endif; ?>
				</div>
				<div class="form-group col-sm-4 <?php echo form_error("txtPaterno")?'has-error':'' ?>">
					<label for="txtPaterno">Apellido Paterno</label>
					<?php 
						$paterno = isset($usuario)? $usuario['paterno']:'';
						if (set_value("txtPaterno"))
							$paterno = set_value("txtPaterno");
					?>
					<input type="text" 
						value="<?php echo $paterno ?>"
						class="form-control" 
						id="txtPaterno" 
						name="txtPaterno">
					<?php if (form_error("txtPaterno")): ?>
						<small class="help-block text-danger">
							<?php echo form_error("txtPaterno")  ?>
						</small>
					<?php endif; ?>
				</div>
				<div class="form-group col-sm-4 <?php echo form_error("txtMaterno")?'has-error':'' ?>">
					<label for="txtMaterno">Apellido Materno</label>
					<?php 
						$materno = isset($usuario)? $usuario['materno']:'';
						if (set_value("txtMaterno"))
							$materno = set_value("txtMaterno");
					?>
					<input type="text" 
						value="<?php echo $materno ?>"
						class="form-control" 
						id="txtMaterno" 
						name="txtMaterno">
					<?php if (form_error("txtMaterno")): ?>
						<small class="help-block text-danger">
							<?php echo form_error("txtMaterno")  ?>
						</small>
					<?php endif; ?>
				</div>
			</div>
			<div class="row">
				<div class="form-group col-sm-4 <?php echo form_error("txtUsuario")?'has-error':'' ?>">
					<label for="txtUsuario">Usuario</label>
					<?php 
						$user = isset($usuario)? $usuario['usuario']:'';
						if (set_value("txtUsuario"))
							$user = set_value("txtUsuario");
					?>
					<input type="text" 
						value="<?php echo $user ?>"
						class="form-control" 
						id="txtUsuario" 
						name="txtUsuario">
					<?php if (form_error("txtUsuario")): ?>
						<small class="help-block text-danger">
							<?php echo form_error("txtUsuario")  ?>
						</small>
					<?php endif; ?>
				</div>
				<div class="contraGroup">
					<div class="form-group col-sm-4">
						<label for="txtContra">Contraseña</label>
						<input type="password" class="form-control" id="txtContra" name="txtContra">
						<small class="help-block error-box" style="display: none;"></small>
					</div>
					<div class="form-group col-sm-4">
						<label for="txtConfContra">Repetir Contraseña</label>
						<input type="password" class="form-control" id="txtConfContra" name="txtConfContra">
						<small class="help-block error-box" style="display: none;"></small>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="form-group col-sm-4">
					<label for="txtFecha">Fecha</label>
					<?php 
						if (isset($usuario)) {
							$fecha = new datetime($usuario['create_at']);
						} else {
							$fecha = new datetime();
						}
					?>
					<input type="text" 
						value="<?php echo $fecha->format('d/m/Y') ?>"
						class="form-control" 
						id="txtFecha" 
						name="txtFecha" 
						disabled="true">
				</div>
				<div class="form-group col-sm-4">
					<label for="txtStatus">Estado</label>
					<?php 
						if (isset($usuario) && $usuario['status'] == 1)
							$estado = "Activo";
						else
							$estado = "Inactivo";
					?>
					<div class="form-control" 
						id="txtStatus" 
						disabled="true">
						<?php echo $estado ?>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-4">
					<button class="btn btn-success" type="submit">Guardar</button>
					<button type="reset" class="btn btn-default">Limpiar</button>
				</div>
			</div>
		</form>
	</section>
</main>
<?php $this->load->view("global/footer") ?>
<?php $this->load->view("usuarios/scriptJS") ?>