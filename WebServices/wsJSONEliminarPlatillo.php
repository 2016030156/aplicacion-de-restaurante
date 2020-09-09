<?PHP
include("../dbConexion.php");
$dbConexion=dbConexion();

  $json=array();

  if(isset($_GET["id"])) {
  $id=$_GET['id'];

  $consulta = "update platillos set status=0 where id={$id}";

  if($dbConexion->query($consulta)===TRUE) {
	  	$resu["idUsuarios"]=1;
		$json['usuario'][]=$resu;
	} else {
		$resu["idUsuarios"]=0;
		$json['usuario'][]=$resu;
	}
} else {
	$resu["idUsuarios"]="null";
	$json['usuario'][]=$resu;
}
  mysqli_close($dbConexion);
  echo json_encode($json);
?>