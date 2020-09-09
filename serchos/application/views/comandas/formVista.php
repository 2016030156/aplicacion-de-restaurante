<form id="frm-platillo">
	<div class="row">
		<div class="form-group col-sm-4">
			<label for="txtNumero">Número</label>
			<input type="text" class="form-control" id="txtNumero" value="Auto" disabled="true">
			<small class="help-block error-box" style="display: none;"></small>
		</div>
		<div class="form-group col-sm-4">
			<label for="cmbTipoMesa">Tipo de mesa</label>
			<select name="cmbTipoMesa" id="cmbTipoMesa" class="form-control">
				<option value="0">Selecciona un tipo de mesa</option>
				<option value="1">Mesa para 2</option>
				<option value="2">Mesa para 4</option>
			</select>
			<small class="help-block error-box" style="display: none;"></small>
		</div>
		<div class="form-group col-sm-4">
			<label for="cmbStatus">Estado de la mesa</label>
			<select name="cmbStatus" id="cmbStatus" class="form-control">
				<option value="-1">Selecciona un estado inicial</option>
				<option value="0"><span class="label label-danger">Fuera de servicio</span></option>
				<option value="1">Disponible</option>
				<option value="2">Ocupado</option>
			</select>
			<small class="help-block error-box" style="display: none;"></small>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-4">
			<button type="button" class="btn btn-success" id="btn-save">Guardar</button>
			<button type="button" class="btn btn-default" id="btn-clean">Limpiar</button>
		</div>
	</div>
</form>