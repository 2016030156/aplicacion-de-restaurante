<div class="row">
	<form class="inline-form" method="post" 
		action="<?php echo base_url("index.php/reportes/platillos") ?>">
		<div class="col-xs-3">
			<label for="txtFecha">Fecha</label>
			<input type="text" class="form-control" id="txtFecha" name="txtFecha">
		</div>
		<div class="col-xs-3">
			<button style="margin-top: 7.5%;" type="submit" class="btn btn-primary" id="btn-buscar" title="Buscar"><i class="fas fa-search"></i></button>
		</div>
	</form>
</div>
<div class="clear">&nbsp;</div>
<div class="container-fluid"  style="background-color: white; padding: 1%;">
	<?php $total = 0; ?>
	<table id="tblPlatillos" class="table table-responsive table-bordered table-striped table-hover datatable">
		<thead style="background-color: #00a65a; color: white;">
			<th>#</th>
			<th>Nombre</th>
			<th>Precio</th>
			<th>Cantidad</th>
			<th>Subtotal</th>
		</thead>
		<tbody>
			<?php if (is_array($platillos)): ?>
				<?php foreach ($platillos as $index => $platillo): ?>
					<tr>
						<td><?php echo $index + 1 ?></td>
						<td><?php echo $platillo['nombre'] ?></td>
						<td><?php echo $platillo['precio'] ?></td>
						<td><?php echo $platillo['cantidad'] ?></td>
						<?php $subtotal = $platillo['cantidad'] * $platillo['precio'] ?>
						<td><?php echo $subtotal ?></td>
						<?php $total += $subtotal ?>
					</tr>
				<?php endforeach; ?>
			<?php endif; ?>
		</tbody>
	</table>
</div>