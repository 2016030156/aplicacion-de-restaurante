<div class="row">
	<div class="col-xs-1">
		<a href="<?php echo base_url("index.php/usuarios/agregar/").$tipo ?>" 
		class="btn btn-success">
			Nuevo
		</a>
	</div>
</div>
<div class="clear">&nbsp;</div>
<div class="container-fluid"  style="background-color: white; padding: 1%;">
	<table id="tblUsuarios" class="table table-responsive table-bordered table-striped table-hover datatable">
		<thead>
			<th>#</th>
			<th>Nombre</th>
			<th>Apellido Paterno</th>
			<th>Apellido Materno</th>
			<th>Usuario</th>
			<th>Tipo</th>
			<th>Fecha</th>
			<th>Estado</th>
			<th>Opciones</th>
		</thead>
		<tbody id="tbody">
			<?php if (is_array($usuarios)): ?>
				<?php foreach ($usuarios as $index => $usuario): ?>
					<tr>
						<td><?php echo $index + 1 ?></td>
						<td><?php echo $usuario['nombre'] ?></td>
						<td><?php echo $usuario['paterno'] ?></td>
						<td><?php echo $usuario['materno'] ?></td>
						<td><?php echo $usuario['usuario'] ?></td>
						<td><?php echo $usuario['perfil'] ?></td>
						<td><?php 
							$fecha = new datetime($usuario['create_at']);
							echo $fecha->format("d/m/Y");
						?></td>
						<td><?php 
							if ($usuario['status'] == 0)
								echo "Inactivo";
							else
								echo "Activo";
						?></td>
						<td>
							<?php if ($usuario['status'] != 0): ?>
								<a class="btn btn-warning btn-sm"
								href="<?php echo base_url("index.php/usuarios/editar/").$tipo."/".$usuario['id'] ?>">
									Modificar
								</a>
								<button class="btn btn-danger btn-sm"
									onclick="deshabilitar(
										<?php echo $usuario['id'] ?>,
										'<?php echo $usuario['nombre'] ?>')">
									Deshabilitar
								</button>
							<?php endif; ?>
						</td>
					</tr>
				<?php endforeach; ?>
			<?php endif; ?>
		</tbody>
	</table>
</div>