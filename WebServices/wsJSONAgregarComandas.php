<?php 

    include('dbConexion.php');

    $conexion = dbConexion();

    if(isset($_GET['mesero']) && isset($_GET['total'])&&isset($_GET['observaciones'])&&isset($_GET['mesa'])){
        $mesero = $_GET['mesero'];
        $total = $_GET['total'];
        $observaciones = $_GET['observaciones'];
        $mesa = $_GET['mesa'];

        $consulta = "CALL nueva_comanda('{$mesero}','{$mesa}','{$observaciones}','{$total}')";
        $resultado = $conexion->query($consulta);
        if($registro=mysqli_fetch_assoc($resultado)){
            /* echo $registro; */
            $json = [];
            $json["comandas"][] = $registro;
            echo json_encode($json);
        }else{
            echo mysqli_error($conexion);
        }
        
    }
?>