<?PHP
include("dbConexion.php");
$dbConexion=dbConexion();

  $json=array();

  if(isset($_GET["nombre"]) && isset($_GET["apellidoPaterno"]) && isset($_GET["apellidoMaterno"]) && isset($_GET["nombreDeUsuario"]) && isset($_GET["contrasenia"])) {
  $nombre=$_GET['nombre'];
  $apellidoPaterno=$_GET['apellidoPaterno'];
  $apellidoMaterno=$_GET['apellidoMaterno'];
  $nombreDeUsuario=$_GET['nombreDeUsuario'];
  $contrasenia=$_GET['contrasenia'];

  $consulta = "call nuevo_usuario('{$nombre}','{$apellidoPaterno}','{$apellidoMaterno}','{$nombreDeUsuario}','{$contrasenia}')";

  if($dbConexion->query($consulta)===TRUE) {
	  	$resu["idUsuarios"]=1;
		$json['usuarios'][]=$resu;
	} else {
		$resu["idUsuarios"]=0;
		$json['usuarios'][]=$resu;
	}
} else {
	$resu["idUsuarios"]="null";
	$json['usuarios'][]=$resu;
}
  mysqli_close($dbConexion);
  echo json_encode($json);
?>﻿