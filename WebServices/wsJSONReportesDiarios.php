<?php 
    include('dbConexion.php');

    $conexion = dbConexion();
    $consulta = 'call reporte_diariows()';
    $resultado = $conexion->query($consulta);
    $json = array();
    while($fila = mysqli_fetch_assoc($resultado)){
        $json['historial'][] = $fila;
    }

    mysqli_close($conexion);
    echo json_encode($json);

?>