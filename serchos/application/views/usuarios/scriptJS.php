<script>
	$(document).ready(function () {
		<?php if ($this->session->flashdata("success")): ?>
			success('<?php echo $this->session->flashdata("success") ?>');
		<?php elseif ($this->session->flashdata("error")): ?>
			errorDialog('<?php echo $this->session->flashdata("error") ?>');
		<?php endif; ?>
	});

	var deshabilitar = function (idMesa, nombre) {
		BootstrapDialog.confirm({
			title: "Confirmar",
			message: "El usuario <strong>" + nombre + "</strong> será deshabilitado.<br>" +
				"¿Desea continuar?",
			btnOKClass: "btn-danger",
			btnOKLabel: "Sí",
			btnCancelLabel: "No",
			type: BootstrapDialog.TYPE_DANGER,
			size: BootstrapDialog.SIZE_SMALL,
			callback: function ( ok ) {
				if ( ok ) {
					$.ajax({
						url: base_url + "usuarios/cancelar/" + idMesa,
						success: function ( answ ) {
							try {
								answ = JSON.parse(answ);
								if (answ.code != 1) {
									errorDialog(answ.msg);
								} else {
									success(answ.msg, "Deshabilitado", function () {
										location.reload();
									})
								}
							} catch ( e ) {
								console.error(e)
							}
						}
					});
				}
			}
		});
	}
</script>