<script>
	$(document).ready( function () {
		<?php if ($this->session->flashdata("success")): ?>
			success('<?php echo $this->session->flashdata("success") ?>');
		<?php elseif ($this->session->flashdata("error")): ?>
			errorDialog('<?php echo $this->session->flashdata("error") ?>');
		<?php endif; ?>
		
		if ($(".hora")) {
			$(".hora").timepicker({
				showMeridian: false
			})
		}

		<?php if (isset($dia) && isset($mes) && isset($año)): ?>
			$("#txtFecha").datepicker({
				format: "dd/mm/yyyy",
				autoclose: true,
				todayHighlight: true
			}).datepicker("setDate", new Date(<?php echo $año.",".($mes-1).",".$dia ?>));
		<?php endif; ?>
	});
	
	var cancelar = function (id) {
		BootstrapDialog.confirm({
			title: "Confirmar",
			message: "La reservación sera cancelada.<br>¿Desea continuar?",
			btnOKLabel: "Sí",
			btnCancelLabel: "No",
			btnOKClass: "btn-danger",
			type: BootstrapDialog.TYPE_DANGER,
			size: BootstrapDialog.SIZE_SMALL,
			callback: function ( ok ) {
				if ( ok ) {
					$.ajax({
						url: base_url + "reservaciones/cancelar/" + id,
						success: function ( answ ) {
							try {
								answ = JSON.parse(answ);
								if (answ.code != 1) {
									errorDialog(answ.msg);
								} else {
									success(answ.msg, "Cancelada", function () {
										console.log("hola")
										location.reload();
									});
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