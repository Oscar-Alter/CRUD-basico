<?php
    include_once "conexionPDO.php";

    session_start();
    $id = $_SESSION['id'];

    $torneo = $_GET['id'];
    $equipo = $_GET['e'];

    $sql = "INSERT INTO jugadores_inscritos(id_torneo, id_jugador, num_equipo, fecha_de_registro)
            VALUES($torneo, $id, $equipo, now())";
    $query = $conn -> prepare($sql);
    $query -> execute();

    echo "<script>window.location.href='vista_torneos.php'</script>"
?>