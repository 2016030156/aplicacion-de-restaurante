<?PHP
include("dbConexion.php");
$dbConexion=dbConexion();
$json=array();
	
if(isset($_GET["id"])&& isset($_GET["nombre"]) && isset($_GET["cantidad"]) && isset($_GET["status"])) {

	$id = $_GET["id"];
	$nombre = $_GET["nombre"];
	$precio = $_GET["cantidad"];
	$status = $_GET["status"];

	$consulta="UPDATE mesas SET nombre= ? , cantidad= ?, status=? WHERE id=?";
	
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
	mysqli_close($conexion);
	echo json_encode($json);
?>

