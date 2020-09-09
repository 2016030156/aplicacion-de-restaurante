<?php 
    include('dbConexion.php');

    $conexion = dbConexion();

    if(isset($_GET['fecha']) ){
        $fecha = $_GET['fecha'];

        $consulta = "call historial_caja('{$fecha}')";
        $resultado = $conexion->query($consulta);
        $json = array();
        while($fila = mysqli_fetch_assoc($resultado)){
            $json['historial'][] = $fila;
        }
    }

    mysqli_close($conexion);
    echo json_encode($json);

?>