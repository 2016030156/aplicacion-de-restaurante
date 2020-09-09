<?php $this->load->view("global/header") ?>
<?php $this->load->view("global/navbar") ?>
<main class="content-wrapper no-aside">
	<section class="content" id="tabla">
		<?php $this->load->view("reportes/platillos/tablaVista") ?>
	</section>
</main>
<?php $this->load->view("global/footer") ?>
<?php $this->load->view("reportes/platillos/scriptJS") ?>