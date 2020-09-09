<div class="container-fluid">
	<a href="#" class="btn btn-default" onclick="javascript:history.back()"><i class="fas fa-arrow-left"></i></a>
	<div class="clear">&nbsp;</div>
	<form action="<?php echo base_url("index.php/comandas/actualizaplatillo") ?>"
		method="post">
		<div class="row">
			<input type="hidden" name="idComanda" value="<?php echo $platillo['id_comanda'] ?>">
			<input type="hidden" name="idPlatillo" value="<?php echo $platillo['id_platillo'] ?>">
			<div class="form-group col-xs-3">
				<label for="platillo">Platillo</label>
				<select name="cmbPlatillos" id="cmbPlatillos" class="form-control">
					<option value="0" data-precio="0">Selecciona un platillo</option>
					<?php foreach ($platillos as $pla): ?>
						<?php if ($platillo['id_platillo'] == $pla['id']): ?>
							<option data-precio="<?php echo $pla['precio'] ?>" 
								value="<?php echo $pla['id'] ?>" 
								selected>
								<?php echo $pla['nombre'] ?>
							</option>
						<?php else: ?>
							<option data-precio="<?php echo $pla['precio'] ?>" 
								value="<?php echo $pla['id'] ?>">
								<?php echo $pla['nombre'] ?>
							</option>
						<?php endif; ?>
					<?php endforeach; ?>
				</select>
			</div>
			<div class="form-group col-xs-3">
				<label for="cantidad">Cantidad</label>
				<input type="text" id="cantidad" name="cantidad" class="form-control" value="<?php echo $platillo['cantidad'] ?>">
			</div>
			<div class="form-group col-xs-3">
				<label for="precio">Precio</label>
				<input type="text" id="precio" name="precio" class="form-control" value="<?php echo $platillo['precio'] ?>">
			</div>
			<div class="form-group col-xs-3">
				<label for="total">Total</label>
				<input type="text" id="total" name="total" class="form-control" disabled="true"
					value="<?php echo $platillo['precio'] * $platillo['cantidad'] ?>">
			</div>
		</div>
		<div class="row">
			<div class="col-xs-1 col-xs-offset-10">
				<button type="button" onclick="borrar()" class="btn btn-danger">Borrar</button>
			</div>
			<div class="col-xs-1">
				<button type="submit" class="btn btn-success">Guardar</button>
			</div>
		</div>
	</form>
</div>