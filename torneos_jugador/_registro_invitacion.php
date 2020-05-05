<?php
    include_once "conexionPDO.php";

    session_start();
    $id = $_SESSION['id'];

    $invitacion = $_GET['id'];
    $seleccion = $_GET['s'];

    if($seleccion == 1){
        $sql = "SELECT i.id_torneo, ji.num_equipo
                FROM invitaciones i, jugadores_inscritos ji
                WHERE i.id_torneo = ji.id_torneo AND i.id_remitente = ji.id_jugador AND i.id = $invitacion";
        $query = $conn -> prepare($sql);
        $query -> execute();
        $datos = $query -> fetchAll(PDO::FETCH_OBJ);

        $t = $datos[0] -> id_torneo;
        $e = $datos[0] -> num_equipo;

        $sql2 = "UPDATE invitaciones SET id_estatus = 5 WHERE id = $invitacion";
        $query2 = $conn -> prepare($sql2);
        $query2 -> execute();

        echo "<script>window.location.href = '_registro_torneo.php?id=".$t."&e=".$e."';</script>";
    } else{
        $sql2 = "UPDATE invitaciones SET id_estatus = 6 WHERE id = $invitacion";
        $query2 = $conn -> prepare($sql2);
        $query2 -> execute();

        echo "<script>window.location.href = 'invitaciones.php';</script>";
    }
?>