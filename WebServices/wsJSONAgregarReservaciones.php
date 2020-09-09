<?php 
    $hostname_localhost ="localhost";
    $database_localhost ="serchos";
    $username_localhost ="root";
    $password_localhost ="";
    
    $conexion = mysqli_connect($hostname_localhost,$username_localhost,$password_localhost,
    $database_localhost) or die("Error en la conexión a la base de datos".mysqli_error($conexion));
    $json = [];
    if(isset($_GET['cliente']) && isset($_GET['id_mesa']) &&
    isset($_GET['fecha']) && isset($_GET['hora_inicio']) && isset($_GET['hora_fin'])){
        $consulta = "INSERT into reservaciones (id_cliente, id_mesa, hora_inicio, hora_fin, fecha, 
        status) values ({$_GET['cliente']}, {$_GET['id_mesa']}, '{$_GET['hora_inicio']}', '{$_GET['hora_fin']}','{$_GET['fecha']}', status);";
        
        $resultado = mysqli_query($conexion, $consulta);
        if(mysqli_affected_rows($conexion)){
            $json["result"][] = "sucess";
        }else{
            $json["result"][] = "error";
        }
        mysqli_close($conexion);
        echo json_encode($json);
    }else{
        mysqli_close($conexion);
        echo json_encode($json);
    }

?>