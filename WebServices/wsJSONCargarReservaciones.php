<?PHP
$hostname_localhost ="localhost";
$database_localhost ="serchos";
$username_localhost ="root";
$password_localhost ="";
$json=array();
				
		$conexion = mysqli_connect($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);

		$consulta="select * from reservaciones where fecha='{$_GET['fecha']}'";
		$resultado=mysqli_query($conexion,$consulta);
		
		while($registro=mysqli_fetch_assoc($resultado)){
			$json['reservaciones'][]=$registro;
		}
		//var_dump($registro);
		if($registro === null && count($json) == 0 ){
			unset($json);
			$json = [];
			$json['reservaciones'][] = array("status" => "No hay reservaciones");
		} 
		mysqli_close($conexion);
		echo json_encode($json);
?>

