<?php
  include_once "../connect_db.php";

  $id = $_GET['id'];
  $plataforma = $_GET['plataforma'];
  $serial = $_GET['serial'];
  $costo_hora = $_GET['costo'];
  $costo_monedas = $_GET['monedas'];

  $consulta = "UPDATE consolas SET id_plataforma = '$plataforma', serial = '$serial' WHERE id = '$id'";

  $resultado=mysqli_query($link, $consulta);
  
  $consulta = "UPDATE plataformas SET costo_por_hora = '$costo_hora', costo_en_monedas = '$costo_monedas' WHERE id = '$plataforma'";

  $resultado=mysqli_query($link, $consulta);

  echo "<script>window.location.href ='visualizar.php'</script>"
?>