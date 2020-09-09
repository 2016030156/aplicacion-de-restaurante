<?php
  function dbConexion(){
    $username="root";
    $password="";
    $database="serchos2";
    $hostname="localhost";

    //$username="root";
    //$password="12345";
    //$database="serchos2";
    //$port="3307";
    //$hostname="172.0.0.2";

    $conexion = new mysqli($hostname,$username,$password,$database/*,$port*/) or die("Error en la conexión a la base de datos".mysqli_error($conexion));
    mysqli_set_charset($conexion, 'utf8');

    if(mysqli_connect_errno()){
      echo "Error de conexión a la base de datos: ".mysqli_connect_error();
      exit();
    }
    return $conexion;
  }
?>
