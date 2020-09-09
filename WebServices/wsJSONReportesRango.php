<?php 
    include('./dbConexion.php');

    $conexion = dbConexion();
    if(isset($_GET['fechaInicio']) && isset($_GET['fechaFin'])){
        $fechaInicio = $_GET['fechaInicio'];
        $fechaFin = $_GET['fechaFin'];
        $consulta = "call reporte_rango('{$fechaInicio}','{$fechaFin}')";
        $resultado = $conexion->query($consulta);
        $json = array();
        while($fila = mysqli_fetch_assoc($resultado)){
            $json['reporte'][] = $fila;
        }
    }

    mysqli_close($conexion);
    echo json_encode($json);

?>