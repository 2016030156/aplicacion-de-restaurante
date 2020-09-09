<script>
	$(document).ready( function () {
		$("#txtFecha").datepicker({
			format: "dd/mm/yyyy",
			autoclose: true,
			todayHighlight: true
		}).datepicker("setDate", new Date('<?php echo $año.",".$mes.",".$dia ?>'));
	});
</script>