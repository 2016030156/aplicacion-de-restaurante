<?php $this->load->view("global/header") ?>
<?php $this->load->view("global/navbar") ?>
<main class="content-wrapper no-aside">
	<section class="content" id="platillo">
		<?php $this->load->view("detalle_platillo/formVista") ?>
	</section>
</main>
<?php $this->load->view("global/footer") ?>
<?php $this->load->view("detalle_platillo/scriptJS") ?>