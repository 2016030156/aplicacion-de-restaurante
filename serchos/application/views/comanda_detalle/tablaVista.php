<?php
	$idPerfil = $this->session->serchos['idPerfil'];
	$modificar = $idPerfil == getIdPerfil("Administrador") || $idPerfil == getIdPerfil("Gerente");
	$cobrar = $idPerfil == getIdPerfil("Caja") || $modificar;
	$preparar = $idPerfil == getIdPerfil("Cocina") || $modificar;
	$cancelar = $modificar;
	$cancelado = $comanda['status'] == 0;
	$pagado = $comanda['status'] == 4;
	$preparada = $comanda['status'] == 3;
?>
<div class="container-fluid">
	<a href="<?php echo base_url("index.php/comandas") ?>" class="btn btn-default"><i class="fas fa-arrow-left"></i></a>
	<div class="clear">&nbsp;</div>
	<div class="row">
		<div class="col-xs-4">
			<h3>
				Comanda: <?php echo $comanda['id'] ?>
			</h3>
		</div>
		<div class="col-xs-4">
			<h3>Total: <?php echo $comanda['total'] ?></h3>
		</div>
		<div class="col-xs-4">
			<?php
				switch ($comanda['status']) {
					case 1: $estado = "Nueva"; break;
					case 0: $estado = "Cancelada"; break;
					case 2: $estado = "Preparada"; break;
					case 4: $estado = "Pagada"; break;
				}
			?>
			<h3>Estado: <?php echo $estado ?></h3>
		</div>
	</div>
	<div class="clear">&nbsp;</div>
	<div class="row">
		<table class="table table-striped table-hover">
			<thead>
				<th>#</th>
				<th>Platillo</th>
				<th>Cantidad</th>
				<th>Precio</th>
				<th>Total</th>
				<th>Acciones</th>
			</thead>
			<tbody>
				<?php if (is_array($detalles)): ?>
					<?php foreach ($detalles as $index => $detalle): ?>
						<tr>
							<td><?php echo $index + 1 ?></td>
							<td><?php echo $detalle['platillo'] ?></td>
							<td><?php echo $detalle['cantidad'] ?></td>
							<td><?php echo $detalle['precio'] ?></td>
							<td><?php echo $detalle['cantidad'] * $detalle['precio'] ?></td>
							<td>
								<div class="row">
									<?php  if (!$cancelado && !$pagado && $preparada && $modificar): ?>
										<div class="col-xs-3">
											<form action="<?php echo base_url("index.php/comandas/platillo") ?>" method="post">
												<input type="hidden" name="idComanda" value="<?php echo $detalle['id_comanda'] ?>">
												<input type="hidden" name="idPlatillo" value="<?php echo $detalle['id_platillo'] ?>">
												<button type="submit" class="btn btn-warning">Modificar</button>
											</form>
										</div>
									<?php endif; ?>
								</div>
							</td>
						</tr>
					<?php endforeach; ?>
				<?php endif; ?>
			</tbody>
		</table>
	</div>
	<div class="clear">&nbsp;</div>
	<div class="row">
		<?php  if (!$pagado && !$cancelado && $cobrar): ?>
			<div class="col-xs-3">
				<button type="button" onclick="cobrarComanda('<?php echo $comanda['id'] ?>')" class="btn btn-success">Cobrar</button>
			</div>
		<?php endif; ?>
		<?php if (!$pagado && !$cancelado && $preparada && $preparar): ?>
			<div class="col-xs-3">
				<button type="button" onclick="prepararComanda('<?php echo $comanda['id'] ?>')" class="btn btn-primary">Preparar</button>
			</div>
		<?php endif; ?>
		<?php  if (!$pagado && !$cancelado && $cancelar): ?>
			<div class="col-xs-3">
				<button type="button" onclick="cancelarComanda('<?php echo $comanda['id'] ?>')" class="btn btn-danger">Cancelar</button>
			</div>
		<?php endif; ?>
	</div>
</div>