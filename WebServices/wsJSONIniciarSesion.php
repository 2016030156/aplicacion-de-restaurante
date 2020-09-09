<?php 
    include("dbConexion.php");
    $dbConexion=dbConexion();

    $json = array();

    if(isset($_GET['nombreDeUsuario']) && isset($_GET['contrasenia'])){
        $nombre = $_GET['nombreDeUsuario'];
        $contrasenia = $_GET['contrasenia'];

        $consulta = "call login_sha1('{$nombre}','{$contrasenia}')";
        $resultado = $dbConexion->query($consulta);
        if($registro = mysqli_fetch_assoc($resultado)){
           /* $json['id'][] = $registro['id'];
            $json['nombre'][] = $registro['nombre'];
            $json['paterno'][] = $registro['paterno'];
            $json['materno'][] = $registro['materno'];
            $json['status'][] = $registro['status'];
            $json['usuario'][] = $registro['usuario'];
            $json['contra'][] = $registro['contra'];
            $json['id_perfil'][] = $registro['id_perfil'];
            $json['create_at'][] = $registro['create_at'];*/
            $json['usuario'][] = $registro;
        }else{
            echo mysqli_error($dbConexion);
        }
    }
    
    mysqli_close($dbConexion);
    echo json_encode($json);
?>