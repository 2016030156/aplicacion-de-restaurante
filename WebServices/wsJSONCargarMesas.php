<?PHP
$hostname_localhost ="localhost";
$database_localhost ="serchos";
$username_localhost ="root";
$password_localhost ="";

$json=array();
				
		$conexion = mysqli_connect($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);

		$consulta="select id,nombre,cantidad,status from mesas";
		$resultado=mysqli_query($conexion,$consulta);
		
		while($registro=mysqli_fetch_array($resultado)){
			$json['mesas'][]=$registro;
			//echo $registro['id'].' - '.$registro['nombre'].'<br/>';
		}
		mysqli_close($conexion);
		echo json_encode($json);
?>

