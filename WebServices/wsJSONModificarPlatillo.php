<?PHP
include("dbConexion.php");
$dbConexion=dbConexion();
$json=array();
	
if(isset($_GET["id"])&& isset($_GET["nombre"]) && isset($_GET["precio"]) && isset($_GET["status"])) {

	$id = $_GET["id"];
	$nombre = $_GET["nombre"];
	$precio = $_GET["precio"];
	$status = $_GET["status"];

	$consulta="UPDATE platillos SET nombre= ? , precio= ?, status=? WHERE id=?";
	
	$resultado=mysqli_query($dbConexion,$consulta);

    if($registro=mysqli_fetch_array($resultado)){
      $resu["idUsuarios"]="Modificado";
      $json['usuario'][]=$registro;
    }
  }
	mysqli_close($conexion);
	echo json_encode($json);
?>

