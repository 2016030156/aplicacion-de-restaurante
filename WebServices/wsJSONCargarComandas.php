<?PHP
$hostname_localhost ="localhost";
$database_localhost ="serchos";
$username_localhost ="root";
$password_localhost ="";

$json=array();
				
		$conexion = mysqli_connect($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);

		$consulta="select comandas.*, mesas.id AS mesa, usuarios.nombre as mesero from comandas, 
		mesas, usuarios where 
		comandas.id_mesero = usuarios.id and 
		comandas.id_mesa = mesas.id";
		$resultado=mysqli_query($conexion,$consulta);
		
		while($registro=mysqli_fetch_array($resultado)){
			$json['comandas'][]=$registro;
			//echo $registro['id'].' - '.$registro['nombre'].'<br/>';
		}
		mysqli_close($conexion);
		echo json_encode($json);
?>

