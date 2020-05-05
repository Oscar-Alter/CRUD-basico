<?php 
    include_once "conexionPDO.php";

    session_start();
    $id = $_SESSION['id'];

    $rem = $_GET['r'];
    $dest = $_GET['d'];
    $torneo = $_GET['t'];
    $m = $_GET['m'];

    $sql = "INSERT INTO invitaciones(id_remitente, id_destinatario, id_torneo)
            VALUES($rem, $dest, $torneo)";
    $query = $conn -> prepare($sql);
    $query -> execute();

    echo "<script>window.location.href='seleccion_jugadores.php?id=".$torneo."&m=".$m."'</script>";
?>