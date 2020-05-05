<?php 
    include_once "conexionPDO.php";

    session_start();
    $usr = $_SESSION['usuario'];
    $id_g = $_SESSION['id'];

    $id = $_GET['id'];
    $modalidad = $_GET['m'];

    $max_jugadores = 0;
    $cont = 0;
    if($modalidad == 2)
        $max_jugadores = 2;
    else
        $max_jugadores = 4;

    $sql = "SELECT g.id, g.nombre 
            FROM gamers g, jugadores_inscritos ji, torneos t
            WHERE ji.id_jugador != g.id AND g.id != $id_g AND ji.id_torneo = $id";
    $query = $conn -> prepare($sql);
    $query -> execute();

    if($query -> rowCount() == 0){
        $sql = "SELECT id, nombre 
            FROM gamers
            WHERE id != $id_g";
        $query = $conn -> prepare($sql);
        $query -> execute();
        $jugadores_disponibles = $query -> fetchAll(PDO::FETCH_OBJ);
    } else{
        $jugadores_disponibles = $query -> fetchAll(PDO::FETCH_OBJ);
    }

    $sql2 = "SELECT * FROM invitaciones WHERE id_remitente = $id_g AND id_torneo = $id";
    $query2 = $conn ->prepare($sql2);
    $query2 -> execute();
    $cont = $query2 -> rowCount() + 1;
?>

<!DOCTYPE html>
<html class="h-100" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Registro</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../../../assets/images/favicon.png">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link href="../css/style.css" rel="stylesheet">
    
</head>
<body class="h-100">
    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="loader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
            </svg>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->
    <div class="login-form-bg h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100">
                <div class="col-xl-6"   >
                    <div class="form-input-content">
                        <div class="card login-form mb-0">
                            <div class="card-body pt-5">
                                
                                <a class="text-center" href="#"><h4>Registrarse</h4></a>
        
                                <form class="mt-5 mb-5">
                                    <div class='form-group row'>
                                        <label for='equipo ' class='col-sm-2 col-form-label'>No. de equipo:</label>
                                        <div class='col-sm-10'>
                                            <input class='form-control form-control-sm' id='equipo' name='equipo'>
                                        </div>
                                    </div>
                                    
                                    <table class='table table-xs mb-0'>
                                        <thead>
                                            <tr>
                                                <th>Nombre</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($jugadores_disponibles as $row){ ?>
                                                <tr>
                                                    <td><?php echo $row -> nombre ?></td>
                                                    <?php if($cont != $max_jugadores){ ?>
                                                        <td><button type="button" class="btn login-form__btn submit w-100" onclick="inv(<?php echo $id_g ?>, <?php echo $row -> id ?>, <?php echo $id ?>)">Invitar</button></td>
                                                    <?php } else { ?>
                                                        <td><label>Max. de jugadores alcanzado</label></td>
                                                    <?php } ?>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                    <form class="mt-5 mb-5" action="p">
                                    <div class='form-group row'>
                                        <td><button type="button" class="btn login-form__btn submit w-100" onclick="f(<?php echo $id ?>)">Finalizar</button></td>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--**********************************
        Scripts
    ***********************************-->
    <script src="../plugins/common/common.min.js"></script>
    <script src="../js/custom.min.js"></script>
    <script src="../js/settings.js"></script>
    <script src="../js/gleek.js"></script>
    <script src="../js/styleSwitcher.js"></script>
    <script src="../js/registro_torneo.js"></script>
</body>
</html>