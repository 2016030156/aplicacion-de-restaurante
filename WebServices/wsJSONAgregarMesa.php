<?PHP
  include("dbConexion.php");
  $dbConexion=dbConexion();
  $json=array();

  if(isset($_GET["nombre"]) && isset($_GET["precio"])) {
    $nombre=$_GET['nombre'];
    $paterno=$_GET['precio'];

    $consulta="INSERT INTO platillos VALUES(NULL,'$nombre','$precio',CURDATE(),1)";

    $resultado=mysqli_query($dbConexion,$consulta);

    if($registro=mysqli_fetch_array($resultado)){
      $resu["id"]="Agregado";
      $json['platillos'][]=$registro;
    }
  }
  mysqli_close($dbConexion);
  echo json_encode($json);
?>