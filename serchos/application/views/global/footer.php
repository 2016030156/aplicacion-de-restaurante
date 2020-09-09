<script src="<?php echo base_url("assets/js/jquery-3.min.js") ?>"></script>
<script src="<?php echo base_url("assets/js/bootstrap-3.min.js") ?>"></script>
<script src="<?php echo base_url("assets/js/adminlte.min.js") ?>"></script>
<script src="<?php echo base_url("assets/js/bootstrap-dialog.min.js") ?>"></script>
<script src="<?php echo base_url("assets/js/jquery.dataTables.min.js") ?>"></script>
<script src="<?php echo base_url("assets/js/dataTables.bootstrap.min.js") ?>"></script>
<script src="<?php echo base_url("assets/js/bootstrap-datepicker.min.js") ?>"></script>
<script src="<?php echo base_url("assets/js/validaciones.js") ?>"></script>
<script src="<?php echo base_url("assets/js/sha1-jshash.js") ?>"></script>
<script src="<?php echo base_url("assets/js/moment.js") ?>"></script>
<script src="<?php echo base_url("assets/js/jquery.tmpl.min.js") ?>"></script>
<script src="<?php echo base_url("assets/js/bootstrap-timepicker.min.js") ?>"></script>
<script src="<?php echo base_url("assets/js/notifit.min.js") ?>"></script>
<script>
	var base_url = '<?php echo base_url("index.php/") ?>'

	var getDate = function () {
		let fecha = new Date()				
		dia = fecha.getDate()
		mes = fecha.getMonth() + 1
		año = fecha.getFullYear()
		dia = dia < 10? "0" + dia: dia
		mes = mes < 10? "0" + mes: mes				
		return dia + "/" + mes + "/" + año				
	}

	var getFila = function (filas, id) {
		for (let fila of filas.toArray())
			if ($(fila).data("id") == id)
				return fila
	}

	var validar = function (errorMessage) {
		errors = errorMessage.split("&")
		for (let error of errors) {
			error = error.split("=")
			if (error[1] == "")
				$("#" + error[0])
					.parent()
					.removeClass("has-error")
					.children(".error-box")
						.text("")
						.hide()
			else
				$("#" + error[0])
					.parent()
					.addClass("has-error")
					.children(".error-box")
						.text(error[1])
						.show()
		}
	}		

	var errorDialog = function (msg = "Ocurrio un error desconocido", title = "Error") {
		BootstrapDialog.alert({
			title: "Error",
			message: msg,
			type: BootstrapDialog.TYPE_DANGER,
			size: BootstrapDialog.SIZE_SMALL
		})
	}

	var salir = function () {
		BootstrapDialog.show({
			title: "Salir",
			message: "¿Confirmar cerrar sesión?",
			type: BootstrapDialog.TYPE_SUCCESS,
			size: BootstrapDialog.SIZE_SMALL,
			buttons: [
				{
					label: "Sí",
					cssClass: "btn-success",
					action: function (dialog) {
						window.location.href = base_url + "inicio/logout";
					}
				},
				{
					label: "No"
				}
			]
		})
	}

	var success = function (msg = "La operación fue exitosa.", title = "Éxito", callback = undefined) {
		BootstrapDialog.show({
			title: title,
			message: msg,
			type: BootstrapDialog.TYPE_SUCCESS,
			size: BootstrapDialog.SIZE_SMALL,
			buttons: [{ label: "OK", action: function ( dialog ) { dialog.close(); }}],
			onhide: function (dialog) {
				if (callback)
					callback()
			}
		});
	}
</script>
<?php if (isset($scripts)): ?>
	<?php if (is_array($scripts)): ?>
		<?php foreach ($scripts as $script): ?>
			<script src="<?php echo base_url($script) ?>"></script>
		<?php endforeach; ?>
	<?php else: ?>
		<script src="<?php echo base_url($scripts) ?>"></script>
	<?php endif; ?>
<?php endif; ?>
</body>
</html>