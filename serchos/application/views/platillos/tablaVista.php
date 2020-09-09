<div class="row">
	<div class="col-xs-3">
		<a class="btn btn-success" href="<?php echo base_url("index.php/platillos/agregar") ?>">Nuevo</a>
	</div>	
</div>
<div class="clear">&nbsp;</div>
<div class="container-fluid">
	<table id="tblPlatillos" class="table table-responsive table-bordered table-striped table-hover">
		<thead style="background-color: #00a65a; color: white;">
			<th>#</th>
			<th>Nombre</th>
			<th>Precio</th>
			<th>Estado</th>
			<th>Opciones</th>
		</thead>
		<tbody>
			<?php if (is_array($platillos)): ?>
				<?php foreach ($platillos as $index => $platillo): ?>
					<tr>
						<td><?php echo $index + 1 ?></td>
						<td><?php echo $platillo['nombre'] ?></td>
						<td><?php echo $platillo['precio'] ?></td>
						<td><?php
							if ($platillo['status'] == 1)
								echo "Activo";
							else
								echo "Inactivo";
						?></td>
						<td>
							<?php if ($platillo['status'] == 1): ?>
								<a class="btn btn-warning btn-sm" 
									href="<?php echo base_url("index.php/platillos/editar/").$platillo['id'] ?>">
									Modificar
								</a>
								<button type="button" class="btn btn-danger btn-sm"
									onclick="deshabilitar(
										<?php echo $platillo['id'] ?>,
										'<?php echo $platillo['nombre'] ?>')">
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