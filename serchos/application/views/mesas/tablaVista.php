<div class="row">
	<div class="col-xs-3">
		<a class="btn btn-success"
			href="<?php echo base_url("index.php/mesas/agregar") ?>">
			Nueva
		</a>
	</div>
	<div class="col-xs-3 col-xs-offset-6">
		<select class="form-control" onchange="filtrar(this)">
			<option value="todas" <?php echo $filtro == "todas" ? 'selected' : '' ?>>Todas</option>
			<option value="activas" <?php echo $filtro == "activas" ? 'selected' : '' ?>>Activas</option>
			<option value="inactivas" <?php echo $filtro == "inactivas" ? 'selected' : '' ?>>Inactivas</option>
		</select>
	</div>	
</div>
<div class="clear">&nbsp;</div>
<div class="container-fluid">
	<table id="tblMesas" class="table table-responsive table-bordered table-striped table-hover datatable">
		<thead>
			<th>#</th>
			<th>Tipo de Mesa</th>
			<th>Cantidad de Mesas</th>
			<th>Estado</th>
			<th>Opciones</th>
		</thead>
		<tbody id="tbody">
			<?php if (is_array($mesas)): ?>
				<?php foreach ($mesas as $index => $mesa): ?>
					<tr>
						<td><?php echo $index + 1 ?></td>
						<td><?php echo $mesa['nombre'] ?></td>
						<td><?php echo $mesa['cantidad'] ?></td>
						<td><?php echo $mesa['status'] == 1? "Activa":"Inactiva"?></td>
						<td>
							<?php if ($mesa['status'] == 1): ?>
								<a class="btn btn-warning btn-sm"
									href="<?php echo base_url("index.php/mesas/editar/").$mesa['id'] ?>">
									Modificar
								</a>
								<?php if ($mesa['id'] != 1 && $mesa['id'] != 2): ?>
									<button type="button" 
										class="btn btn-danger btn-sm"
										onclick="deshabilitar(<?php echo $mesa['id'] ?>, 
											'<?php echo $mesa['nombre'] ?>')">
										Deshabilitar
									</button>
								<?php endif; ?>
							<?php endif; ?>
						</td>
					</tr>
				<?php endforeach; ?>
			<?php endif; ?>
		</tbody>
	</table>
</div>