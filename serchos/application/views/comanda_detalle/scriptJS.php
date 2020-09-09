<script>
	var totalComanda = '<?php echo $comanda['total'] ?>';

	var cobrarComanda = function (idComanda) {
		if (isNaN(idComanda))
			throw "La id comanda no es válida.";
		BootstrapDialog.show({
			title: "Cobrar comanda",
			message: function ( dialog ) {
				form = $("<div class='form-group'></div>");
				form.append("<label for='txtCantidad'>Cantidad</label>");
				form.append("<input type='text' class='form-control' name='txtCantidad' id='txtCantidad'>");
				return form;
			},
			buttons: [
				{
					label: "Cancelar",
					action: function ( dialog ) { dialog.close(); }
				},
				{
					label: "Cobrar",
					cssClass: "btn-success",
					action: function ( dialog ) {
						let cantidad = $("#txtCantidad").val();
						if (isNaN(cantidad) || cantidad < totalComanda) {
							errorDialog("La cantidad ingresa no es válida");
						} else {
							cobrar(idComanda, cantidad)
						}
						dialog.close()
					}
				}
			]
		});
	}

	var prepararComanda = function (idComanda) {
		if (isNaN(idComanda))
			throw "La id comanda no es válida.";
		BootstrapDialog.confirm({
			title: "Preparar comanda",
			message: "¿Desea marcar comanda como preparada?",
			btnOKClass: "btn-primary",
			btnOKLabel: "Sí",
			btnCancelLabel: "No",
			callback: function (ok) {
				$.ajax({
					url: base_url + "comandas/preparar/" + idComanda,
					success: function ( answ ) {
						console.log(answ)
					}
				});
			}
		});
	}

	var cancelarComanda = function (idComanda) {
		if (isNaN(idComanda))
			throw "La id comanda no es válida.";
		BootstrapDialog.confirm({
			title: "Cancelar comanda",
			message: "¿Desea cancelar la comanda?",
			btnOKClass: "btn-danger",
			btnOKLabel: "Sí",
			btnCancelLabel: "No",
			type: BootstrapDialog.TYPE_DANGER,
			callback: function ( ok ) {
				if (ok) {
					$.ajax({
						url: base_url + "comandas/cancelar/" + idComanda,
						success: function ( answ ) {
							try {
								answ = JSON.parse(answ);
								if (answ.code == 1) {
									success(answ.msg);
								}
								else
									errorDialog(answ.msg);
							} catch ( e ) {
								errorDialog(answ.msg);
							}
						}
					});
				}
			}
		});
	}

	var cobrar = function (idComanda, cantidad) {
		msgCambio = ", su cambio es " + (cantidad - totalComanda);
		$.ajax({
			url: base_url + "comandas/cobrar/" + idComanda,
			success: function ( answ ) {
				try {
					answ = JSON.parse(answ);
					if (answ.code == 1) {
						BootstrapDialog.show({
							title: "Comanda pagada",
							message: "La comanda fue pagada" + msgCambio,
							buttons: [
								{
									label: "Aceptar",
									cssClass: "btn-primary",
									action: function ( dialog ) {
										dialog.close();
										window.location.reload();
									}
								}
							]
						});
					} else {
						errorDialog("Ocurrio un error al pagar la comanda");
					}
				} catch ( e ) {
					errorDialog("Ocurrio un error al pagar la comanda");
				}
			}
		})
	}
</script>