<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Reporte de platillos</title>
</head>
<body>
	<?php $total = 0; ?>
	<table id="tblPlatillos" class="table table-responsive table-bordered table-striped table-hover datatable">
		<thead>
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
						<td data-id="<?php echo $platillo['id'] ?>"><?php echo $index + 1 ?></td>
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
	<div class="col-xs-3 col-xs-offset-6">
		<h4>Total: <span id="total"><?php echo $total ?></span></h4>
	</div>
</body>
</html>