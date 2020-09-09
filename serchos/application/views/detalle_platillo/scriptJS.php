<script>
	var borrar = function () {
		let id = '<?php echo $platillo['id_comanda']."/".$platillo['id_platillo'] ?>'
		BootstrapDialog.confirm({
			title: "Borrar Platillo",
			message: "¿Desea borrar el platillo " + $("#cmbPlatillos option:selected").text().trim() + "?",
			btnOKClass: "btn-danger",
			btnOKLabel: "Sí",
			btnCancelLabel: "No",
			type: BootstrapDialog.TYPE_DANGER,
			callback: function ( ok ) {
				if (ok) {
					window.location.href = base_url + "comandas/borrarplatillo/" + id;
				}
			}
		});
	}
</script>