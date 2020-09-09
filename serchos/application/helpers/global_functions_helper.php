<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists("modulos")) {
	function modulos () {
		$that =& get_instance();
        $that->load->model("PerfilesModulosModelo");        
        $idPerfil = $that->session->serchos['idPerfil'];
		$modulos = $that->PerfilesModulosModelo->modulosPadrePerfil($idPerfil);        
        foreach ($modulos as &$modulo)
            $modulo['hijos'] = $that->PerfilesModulosModelo->modulosHijo($modulo['id'], $idPerfil);
		return $modulos;
	}	
}

if (!function_exists("getModulo")) {
    function getModulo ($nombreModulo) {
        $that =& get_instance();
        $that->load->model("ModulosModelo");
        $modulo = $that->ModulosModelo->buscar(array("nombre" => $nombreModulo));
        return $modulo;
    }
}
if (!function_exists("menuHorizontal")) {
    function menuHorizontal ($modulos) {
        if (is_array($modulos)) {
            foreach ($modulos as $modulo):
                if (isset($modulo['hijos']) and $modulo['hijos'] != false): ?>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <?php echo $modulo['nombre'] ?>
                        </a>
                        <ul class="dropdown-menu">
                            <?php foreach ($modulo['hijos'] as $hijo): ?>
                                <li><a href="<?php echo base_url($hijo['url']) ?>"><?php echo $hijo['nombre'] ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </li>
                <?php else: ?>
                    <li <?php echo esModuloActual($modulo['id'])? 'class="active"': '' ?>>
                        <a href="<?php echo base_url($modulo['url']) ?>" class="link">
                            <i class="<?php echo $modulo['icon'] ?>"></i>
                            <span><?php echo $modulo['nombre'] ?></span>
                        </a>
                    </li>
                <?php endif;
            endforeach;
        }
    }
}

if (!function_exists("menu")) {
	function menu ($modulos) {
		if (is_array($modulos)) {            
		    foreach ($modulos as $modulo): ?> 
                <?php if (isset($modulo['hijos']) and $modulo['hijos'] != false): ?>
                    <li class="treeview <?php echo esPadreActual($modulo['id'])? 'active': '' ?>">
                        <a href="#">
                            <i class="<?php echo $modulo['icon'] ?>"></i>
                            <span><?php echo $modulo['nombre'] ?></span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <?php menu($modulo['hijos']) ?>
                        </ul>
                    </li>
                <?php else: ?>
                    <li <?php echo esModuloActual($modulo['id'])? 'class="active"': '' ?>>
                        <a href="<?php echo base_url($modulo['url']) ?>" class="link">
                            <i class="<?php echo $modulo['icon'] ?>"></i>
                            <span><?php echo $modulo['nombre'] ?></span>
                        </a>
                    </li>
                <?php endif; ?>
            <?php endforeach;
        }
	}
}

if (!function_exists("validarAcceso"))  {
    function validarAcceso ($ajaxOnly = false) {
        $that =& get_instance();
        $that->load->model("PerfilesModulosModelo");
        $idPerfil = $that->session->serchos['idPerfil'];
        $idModulo = $that->modulo['id'];
        $hasAccess = $that->PerfilesModulosModelo->get($idPerfil, $idModulo) != false;
        if ($ajaxOnly)
            $hasAccess &= $that->input->is_ajax_request();
        return $hasAccess;
    }
}

if (!function_exists("getIdPerfil")) {
    function getIdPerfil ($perfil) {
        $that =& get_instance();
        $that->load->model("PerfilesModelo");
        $perfil = $that->PerfilesModelo->buscar(array("nombre" => $perfil));
        if ($perfil)
            return $perfil['id'];
        return false;
    }
}

if (!function_exists("getNombreCompleto")) {
    function getNombreCompleto () {
        $that =& get_instance();
        $fullName = $that->session->serchos['nombre']." ". 
            $that->session->serchos['paterno']." ".
            $that->session->serchos['materno'];
        return $fullName;
    }
}

if (!function_exists("esPadreActual")) {
    function esPadreActual ($idModuloPadre) { 
        $that =& get_instance();
        $idModuloActual = $that->session->tempdata('idModuloPadreActual');
        return ($idModuloPadre == $idModuloActual);
    }
}

if (!function_exists("esModuloActual")) {
    function esModuloActual ($idModulo) {
        $that =& get_instance();
        $idModuloActual = $that->session->tempdata('idModuloActual');
        return ($idModulo == $idModuloActual);
    }
}

if (!function_exists("encriptar_AES")) {
    function encriptar_AES($string, $key) {
        $td = mcrypt_module_open(MCRYPT_RIJNDAEL_128, '', MCRYPT_MODE_CBC, '');
        $iv = mcrypt_create_iv(mcrypt_enc_get_iv_size($td), MCRYPT_DEV_URANDOM );
        mcrypt_generic_init($td, $key, $iv);
        $encrypted_data_bin = mcrypt_generic($td, $string);
        mcrypt_generic_deinit($td);
        mcrypt_module_close($td);
        $encrypted_data_hex = bin2hex($iv).bin2hex($encrypted_data_bin);
        return $encrypted_data_hex;
    }
}

if (!function_exists("desencriptar_AES")) {
    function desencriptar_AES($encrypted_data_hex, $key) {
        $td = mcrypt_module_open(MCRYPT_RIJNDAEL_128, '', MCRYPT_MODE_CBC, '');
        $iv_size_hex = mcrypt_enc_get_iv_size($td)*2;
        $iv = pack("H*", substr($encrypted_data_hex, 0, $iv_size_hex));
        $encrypted_data_bin = pack("H*", substr($encrypted_data_hex, $iv_size_hex));
        mcrypt_generic_init($td, $key, $iv);
        $decrypted = mdecrypt_generic($td, $encrypted_data_bin);
        mcrypt_generic_deinit($td);
        mcrypt_module_close($td);
        return $decrypted;
    }
}