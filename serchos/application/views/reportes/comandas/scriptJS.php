<script>
	<?php 
		date_default_timezone_set("America/Mazatlan");
		$fecha = new datetime();
		if (isset($_POST['txtFechaInicio']))
			$fechaInicio = explode("/", $_POST['txtFechaInicio']);
		else
			$fechaInicio = explode("/", $fecha->format("d/m/Y"));
		$fechaInicio = $fechaInicio['2'].",".$fechaInicio['1'].",".$fechaInicio['0'];
		if (isset($_POST['txtFechaFin']))
			$fechaFin = explode("/", $_POST['txtFechaFin']);
		else
			$fechaFin = explode("/", $fecha->format("d/m/Y"));
		$fechaFin = $fechaFin['2'].",".$fechaFin['1'].",".$fechaFin['0'];
	?>
	
	$(document).ready( function () {
		$("#btn-buscar").prop("disabled", false);

		<?php if (isset($rango)): ?>
			$("#txtFechaInicio").datepicker({
				format: "dd/mm/yyyy",
				autoclose: true,
				todayHighlight: true
			}).datepicker("setDate", new Date('<?php echo $fechaInicio ?>'));

			$("#txtFechaFin").datepicker({
				format: "dd/mm/yyyy",
				autoclose: true,
				todayHighlight: true
			}).datepicker("setDate", new Date('<?php echo $fechaFin ?>'));

			<?php $metodo = "rango" ?>
		<?php else:  ?>
			$("#txtFechaInicio").datepicker({
				format: "dd/mm/yyyy",
				autoclose: true,
				todayHighlight: true
			}).datepicker("setDate", new Date('<?php echo $fechaInicio ?>'));
			
			<?php $metodo = "diario" ?>
		<?php endif; ?>


		var filtrar = function (btn) { window.location.href = base_url + "reportes/<?php echo $metodo ?>/" + btn.value }
	})
</script>