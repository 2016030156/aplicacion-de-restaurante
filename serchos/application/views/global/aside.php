<aside class="main-sidebar">    
    <section class="sidebar">
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?php echo base_url("assets/images/usuario.jpg") ?>" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p><?php echo $this->session->extempo['usuario'] ?></p>
                <a href="#"><i class="fa fa-circle text-success"></i> <?php echo $this->session->extempo['perfil'] ?></a>
            </div>
        </div>              
        <ul class="sidebar-menu tree" data-widget="tree">
            <?php menu(modulos()) ?>
            <li>
                <a href="#" class="btn-log-out">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Salir</span>
                </a>
            </li>
        </ul>
    </section>
</aside>