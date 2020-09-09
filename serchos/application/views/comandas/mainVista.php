<?php $this->load->view("global/header") ?>
<?php $this->load->view("global/navbar") ?>
<main class="content-wrapper no-aside">
	<section class="content" id="comandas">
		<?php $this->load->view("comandas/tablaVista") ?>
	</section>	
</main>
<?php $this->load->view("global/footer") ?>
<?php $this->load->view("comandas/scriptJS") ?>