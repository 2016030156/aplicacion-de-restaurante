<?php $this->load->view("global/header") ?>
<?php $this->load->view("global/navbar") ?>
<main class="content-wrapper no-aside">
	<section class="content" id="detalle">
		<?php $this->load->view("comanda_detalle/tablaVista") ?>
	</section>
</main>
<?php $this->load->view("global/footer") ?>
<?php $this->load->view("comanda_detalle/scriptJS") ?>