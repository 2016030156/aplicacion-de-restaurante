<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo "Serchos's | ".$titulo ?></title>  
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url("assets/css/fontawesome.package.min.css") ?>">  
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url("assets/css/AdminLTE.min.css") ?>">
    <!-- AdminLTE Skins. Choose a skin from the css/skins folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?php echo base_url("assets/css/_all-skins.min.css") ?>">        
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="<?php echo base_url("assets/css/bootstrap-3.min.css") ?>">
    <style>
    	 .frm {
            width: 90% !important;
            max-width: 500px !important;
            padding: 2% !important;
            margin: auto !important;      
            background: #fff !important;
            box-shadow: 0% 0% 0.3% grey !important;
            font-family: "Roboto", Arial !important;
        }
        .gradient {
            background: rgb(66,162,39);
            background: radial-gradient(circle, rgba(66,162,39,1) 69%, rgba(3,14,1,1) 100%);
        }
    </style>
</head>
<body class="hold-transition skin-blue sidebar-collapse">
	<div style="height: 100%; width: 100%;">
	    <div style="height: 100%; width: 50%; float: left;" class="gradient">
	        <center style="margin-top: 45%;">
	            <h1 style="color: white;">Sercho's</h1>
	        </center>
	    </div>
		<div style="background-color: #ecf0f5; height: 100%; width: 50%; float: right; padding-top: 10%;">
	        <div class="login-box-body">
	            <p class="login-box-msg">Registro</p>
	            <div class="alert alert-danger" hidden>
	            	El usuario y/o contraseña son incorrectos
	            </div>
	            <form id="frm-registro" class="frm">
	                <div class="row">
			    		<div class="col-xs-6">
			    			<div class="form-group has-feedback">
				      			<label for="txtNombre">Nombre(s)</label>
				        		<input type="text" class="form-control LetrasNumeros required" id="txtNombre" name="txtNombre">
				        		<span class="help-block error-box" style="display: none;">El campo Nombre(s) es obligatorio</span>
				      		</div>
			    		</div>
			    		<div class="col-xs-6">
				      		<div class="form-group has-feedback">
				      			<label for="txtPaterno">Apellido Paterno</label>
				        		<input type="text" class="form-control LetrasNumeros required" id="txtPaterno" name="txtPaterno">
				        		<span class="help-block error-box" style="display: none;">El campo Apellido Paterno es obligatorio</span>
				      		</div>
			    		</div>
		    		</div>
		    		<div class="row">
		    			<div class="col-xs-6">
		    				<div class="form-group has-feedback">
				      			<label for="txtMaterno">Apellido Materno</label>
				        		<input type="text" class="form-control LetrasNumeros required" id="txtMaterno" name="txtMaterno">
				        		<span class="help-block error-box" style="display: none;">El campo Apellido Materno es obligatorio</span>
				      		</div>
		    			</div>
		    			<div class="col-xs-6">
		    				<div class="form-group has-feedback">
				      			<label for="txtUsuario">Usuario</label>
				        		<input type="text" class="form-control LetrasNumeros required" id="txtUsuario" name="txtUsuario">
				        		<span class="help-block error-box" style="display: none;">El campo Usuario es obligatorio</span>
				      		</div>
		    			</div>
		    		</div>
		    		<div class="row">
		    			<div class="col-xs-6">
		    				<div class="form-group has-feedback">
				      			<label for="txtContra">Contraseña</label>
				        		<input type="password" class="form-control LetrasNumeros required" id="txtContra" name="txtContra">
				        		<span class="help-block error-box" style="display: none;">El campo Contraseña es obligatorio</span>
				      		</div>	
		    			</div>
		    			<div class="col-xs-6">
		    				<div class="form-group has-feedback">
				      			<label for="txtConfContra">Confirmar Contraseña</label>
				        		<input type="password" class="form-control LetrasNumeros required" id="txtConfContra" name="txtConfContra">
				        		<span class="help-block error-box" style="display: none;">El campo Repetir Contraseña es obligatorio</span>
				      		</div>	
		    			</div>
		    		</div>
		      		<div class="row">
			        	<div class="col-xs-4">
			        		<button type="button" id="btn-registro" class="btn btn-success">Registrarse</button>
			        	</div>					        	
			        	<div class="col-xs-4 col-xs-offset-3">
			        		<a href="<?php echo base_url() ?>">
				        		<button type="button" class="btn btn-default">Iniciar Sesión</button>
			        		</a>
			        	</div>
			      	</div>
	            </form>
	        </div>
	    </div>
	</div>
</body>
<?php $this->load->view("global/footer") ?>
<!-- Inicio JS -->
<script>
	
    $("#btn-registro").click( function () {
    	let contra = $("#txtContra").val(),
    		contraSha1 = contra != ""? hex_sha1(contra): "",
    		confContra = $("#txtConfContra").val(),
    		confContraSha1 = confContra != ""? hex_sha1(confContra): "";
    	$("#txtConfContra").val(confContraSha1)
    	$("#txtContra").val(contraSha1)
    	$.ajax({
    		url: base_url + "inicio/registrarse",
    		type: "POST",
    		data: $("#frm-registro").serialize() + "&fecha=" + getDate(),
    		success: function (res) {
    			try {
    				res = JSON.parse(res)
    				if (res.code == 0) {
    					validar(res.msg)
    					$("#txtContra").val(contra)
    					$("#txtConfContra").val(confContra)
    				}
    				else if (res.code < 0)
    					errorDialog(res.msg)
    				else if (res.code > 0)
    					window.location.href = base_url
    			}
    			catch ( e ) {
    				console.error(e)
    			}
    		}
    	})
    })
</script>	
</html>
