<?php

    include('dbConexion.php');
    $conexion = dbConexion();
    $json = [];
    if(isset($_GET['id'])&&isset($_GET['status'])){
        $id = $_GET['id'];
        $status = $_GET['status'];
        $consulta = "UPDATE comandas SET status = {$status} WHERE id = {$id}";
        $resultado = $conexion->query($consulta);
        if($resultado){
            $json['resultado'] = "Cambio status";
            echo json_encode($json);
        }
    }
?>