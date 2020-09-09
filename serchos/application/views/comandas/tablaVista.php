<style>
	.nav-tabs-custom>.nav-tabs>li.active {
		border-top-color: black;
	}
	.nav-tabs-custom .nav>li>a>sup {
	    position: absolute;
	    top: 2px;
	    right: 5px;
	    text-align: center;
	    font-size: 15px;
	    padding: 2px 2px;
	    line-height: .9;
	}
	.comanda {
		box-shadow: 3px 3px 6px 1px rgba(0,0,0,0.75);
	}
	.comanda:hover {
		cursor: pointer;
	}
	th {
		border-left: 1px solid black !important;
	}
	.platillo-nombre-input {
		border: none !important;
	    width: 90% !important;
	    background-color: transparent;
	    box-shadow: none;
	}
</style>
<div class="clear">&nbsp;</div>
<div class="container-fluid">
	<div class="row">
		<div class="col-xs-6">
			<h1>Comandas</h1>
		</div>
		<div class="col-xs-6">
			&nbsp;
			<select name="cmbComandas" id="cmbComandas" class="form-control" onchange="filtrar(this)">
				<option value="/" <?php echo $filtro==''?'selected':'' ?>>Todas</option>
				<option value="canceladas" <?php echo $filtro=='canceladas'?'selected':'' ?>>Canceladas</option>
				<option value="nuevas" <?php echo $filtro=='nuevas'?'selected':'' ?>>Nuevas</option>
				<option value="preparadas" <?php echo $filtro=='preparadas'?'selected':'' ?>>Preparadas</option>
				<option value="entregadas" <?php echo $filtro==''?'entregadas':'' ?>>Entregadas</option>
				<option value="pagadas" <?php echo $filtro=='pagadas'?'selected':'' ?>>Pagadas</option>
			</select>
		</div>
	</div>
	<div class="row">
		<table class="table table-striped table-hover" id="tbl-comandas">
			<thead style="background-color: rgb(0, 166, 90); color: white;">
				<th>#</th><th>Mesa</th><th>Número Platillos</th><th>Estado</th>
				<th>Total</th><th>Observaciones</th><th>Detalles</th></thead>
			<tbody>
				<?php if (is_array($comandas)): ?>
					<?php foreach ($comandas as $comanda): ?>
						<?php
							$estado = "";
							switch ($comanda['status']) {
								case 0: $estado = "Cancelada"; 	break;
								case 1: $estado = "Nuevo"; 		break;
								case 4: $estado = "Pagada"; 	break;
								case 2: $estado = "Preparada"; 	break;
							}
						?>
						<tr>
							<td><?php echo $comanda['id'] ?></td>
							<td><?php echo $comanda['id_mesa'] ?></td>
							<td><?php echo $comanda['num_pla'] ?></td>
							<td><?php echo $estado ?></td>
							<td><?php echo $comanda['total'] ?></td>
							<td><?php echo $comanda['observaciones'] ?></td>
							<td>
								<form action="<?php echo base_url("index.php/comandas/detalle") ?>" 
									method="post">
									<input type="hidden" name="idComanda" 
										value="<?php echo $comanda['id'] ?>">
									<button type="submit"
										class="btn btn-sm btn-primary">
										<i class="fas fa-eye"></i>
									</button>
								</form>
							</td>
						</tr>
					<?php endforeach; ?>
				<?php endif; ?>
			</tbody>
		</table>
	</div>
</div>
<datalist id='platillos'>
</datalist>