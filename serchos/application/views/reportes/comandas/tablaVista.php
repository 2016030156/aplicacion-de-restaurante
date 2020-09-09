<div class="row">
	<?php $metodo = isset($rango)? "rango" : "diario" ?>
	<form class="inline-form" method="post" action="<?php echo base_url("index.php/reportes/").$metodo ?>">
		<?php if (isset($rango)): ?>
			<div class="col-xs-3">
				<label for="txtFechaInicio">Fecha Inicio</label>
				<input type="text" class="form-control" id="txtFechaInicio" name="txtFechaInicio">
			</div>
			<div class="col-xs-3">
				<label for="txtFechaFin">Fecha Fin</label>
				<input type="text" class="form-control" id="txtFechaFin" name="txtFechaFin">
			</div>
		<?php else: ?>
			<div class="col-xs-3">
				<label for="txtFechaInicio">Fecha</label>
				<input type="text" class="form-control" id="txtFechaInicio" name="txtFechaInicio">
			</div>
		<?php endif; ?>
		<div class="col-xs-3">
			<button style="margin-top:10%;" type="submit" disabled="true" class="btn btn-primary" id="btn-buscar" title="Buscar">
				<i class="fas fa-search"></i>
			</button>
		</div>
	</form>
</div>
<div class="clear">&nbsp;</div>
<div class="container-fluid"  style="padding: 1%;">
	<div class="row">
		<div class="col-xs-3 col-xs-offset-9">
			<select name="cmbComandas" id="cmbComandas" class="form-control" onchange="filtrar(this)">
				<option value="/" selected="">Todas</option>
				<option value="canceladas">Canceladas</option>
				<option value="pagadas">Pagadas</option>
			</select>
		</div>
	</div>
	<div class="clear">&nbsp;</div>
	<table id="tblComandasReporte" class="table table-responsive table-bordered table-striped table-hover datatable">
		<thead style="background-color: rgb(0, 166, 90); color: white;">
			<th>#</th>
			<th>Mesa</th>
			<th>Total</th>
			<th>Observaciones</th>
			<th>Mesero</th>
			<th>Fecha</th>
			<th>Hora</th>
			<th>Estado</th>
		</thead>
		<tbody>
			<?php if (is_array($comandas)): ?>
				<?php foreach ($comandas as $index => $comanda): ?>
					<tr>
						<td><?php echo $index + 1 ?></td>
						<td><?php echo $comanda['mesa'] ?></td>
						<td><?php echo $comanda['total'] ?></td>						
						<td><?php echo $comanda['observaciones'] ?></td>
						<td><?php echo $comanda['mesero'] ?></td>
						<td>
							<?php 
								$fecha = new datetime($comanda['fecha']);
								echo $fecha->format("d/m/Y");
							?>
						</td>
						<td><?php echo $comanda['hora'] ?></td>
						<td><?php echo $comanda['estado'] ?></td>
					</tr>
				<?php endforeach; ?>
			<?php endif; ?>
		</tbody>
	</table>
</div>