<?php  
	include_once "../connect_db.php";
	 
    $salida = "";
	 
	if(isset($_GET['consulta'])){
		$q = $link->real_escape_string($_GET['consulta']);
		$sql = "SELECT c.id, p.id AS p_id, p.nombre, c.serial, p.costo_por_hora, p.costo_en_monedas
        FROM consolas c, plataformas p
        WHERE p.id = c.id_plataforma AND c.id = " . $q . ";";

        $sql2 = "SELECT p.id, p.nombre 
        FROM plataformas p, consolas c
        WHERE p.id != c.id_plataforma AND c.id = " . $q . ";";
	}

    $resultado = $link -> query($sql);
    $resultado2 = $link -> query($sql2);
	echo (mysqli_error ($link));

	if($resultado -> num_rows > 0){
		$salida.= " <div class='modal-body' id='formularioo'> ";
                    while ($ver = $resultado -> fetch_assoc()) {
                    	$salida.=" 
                        <div class='form-group row'>
                            <label for='resultados' class='col-sm-2 col-form-label'>ID</label> 
                            <div class='col-sm-10'>
                                <label type='text' class='form-control form-control-sm'>".$ver['id']."<label><br> 
                            </div>
                        </div>
                        <div class='form-group row'>
                            <label for='resultados' class='col-sm-2 col-form-label'>Plataforma</label>
                            <div class='col-sm-10'>
                                <select class='form-control form-control-sm' id='p'>
                                <option value='".$ver['p_id']."'>".$ver['nombre']."</option>";
                                while ($ver2 = $resultado2 -> fetch_assoc()) {
                                    $salida.="
                                    <option value='".$ver2['id']."'>".$ver2['nombre']."</option>";
                                };
                            $salida.="</div>
                        </div>
                            <label for='resultados'>Numero serial</label>
                            <input type='text'class='form-control form-control-sm' id='s' value='".$ver['serial']."''><br>
                            
                        <div class='form-group row'>
                            <label for='resultados' class='col-sm-2 col-form-label'>Costo por hora</label>
                            <div class='col-sm-10'>
                                <input type='text' class='form-control form-control-sm'  id='ch' value='".$ver['costo_por_hora']."''><br>
                            </div>
                        </div>    
                        <div class='form-group row'>
                        <label for='resultados' class='col-sm-2 col-form-label'>Costo en monedas</label>
                            <div class='col-sm-10'>
                                <input type='text' class='form-control form-control-sm'  id='cm' value='".$ver['costo_en_monedas']."''><br>
                            </div>
                        </div>";
                    }
                    $salida.="
                    </div>
                    <div class='modal-footer'>
                        <button type='button' value='".$q."' onclick='guard(".$q.");' class='btn btn-primary btn-sm'>Guardar</button>
                    </div>";
                    $salida.="<script>
                                function guard(id){
                                    let p = document.getElementById('p').value
                                    let s = document.getElementById('s').value
                                    let ch = document.getElementById('ch').value
                                    let cm = document.getElementById('cm').value

                                    window.location.href = '_actualizar.php?id='+id+'&plataforma='+p+'&serial='+s+'&costo='+ch+'&monedas='+cm;
                                };
                            </script>";
	} else {
		$salida.= "vacio";
	}
	
	echo $salida;
	$link -> close();
?>

