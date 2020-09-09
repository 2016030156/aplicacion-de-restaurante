<style>
    .float-right {
        float: right !important;
    }
</style>
<header class="main-header">
    <a href="<?php echo base_url() ?>" class="logo">
        <span class="logo-lg"><b>Sercho's</b></span>
    </a>
    <nav class="navbar navbar-static-top">
        <div class="navbar-custom-menu" style="width: 100%;">
            <ul class="nav navbar-nav">
                <?php menuHorizontal(modulos()) //menuHorizontal(modulos())?>  
                <li class="dropdown float-right">
                    <a href="#" onclick="salir()">Salir</a>
                </li>
            </ul>
        </div>
    </nav>
</header>