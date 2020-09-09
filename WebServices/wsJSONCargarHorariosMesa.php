<?PHP
$hostname_localhost ="localhost";
$database_localhost ="serchos";
$username_localhost ="root";
$password_localhost ="";

$json=array();
				
if(isset($_GET['id_mesa']) || !empty($_GET['id_mesa'])){
	$conexion = mysqli_connect($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);
	$consulta="select * from horarios where id_mesa = {$_GET['id_mesa']}";
	$resultado=mysqli_query($conexion,$consulta);
	
	while($registro=mysqli_fetch_array($resultado)){
		$json['mesas'][]=$registro;
		//echo $registro['id'].' - '.$registro['nombre'].'<br/>';
	}
	
	mysqli_close($conexion);
	echo json_encode($json);
}else{
	mysqli_close($conexion);
	echo json_encode($json);
}
?>

