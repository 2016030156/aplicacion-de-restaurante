<?php 

    include('dbConexion.php');
    $conexion = dbConexion();

    if(isset($_GET['comanda'])&&isset($_GET['platillo'])&&isset($_GET['cantidad'])&&isset($_GET['precio'])){
        $comanda = $_GET['comanda'];
        $platillo = $_GET['platillo'];
        $cantidad = $_GET['cantidad'];
        $precio = $_GET['precio'];

        $consulta = "INSERT INTO detalle_comandas (id_comanda,id_platillo,cantidad,precio,status) VALUES('{$comanda}','{$platillo}','{$cantidad}','{$precio}',1)";
        $resultado = $conexion->query($consulta);
         /*if($registro=mysqli_fetch_assoc($resultado)){
            echo $registro;
        }else{
            echo mysqli_error($conexion);
        } */
        
    }
?>