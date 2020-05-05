<?php
  include_once "../connect_db.php";

  $plataforma = $_GET['plataforma'];
  $serial = $_GET['serial'];

  $consulta = "INSERT INTO consolas(id_plataforma, serial) 
                VALUES('$plataforma', '$serial')";

  $resultado=mysqli_query($link, $consulta);
  echo "<script>window.location.href ='visualizar.php'</script>"
?>







