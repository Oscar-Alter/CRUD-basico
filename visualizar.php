<?php  
	 include_once "../connect_db.php";
     
     $salida = "";
     $sql = "SELECT c.id, p.nombre, c.serial, p.costo_por_hora, p.costo_en_monedas
     FROM consolas c, plataformas p
     WHERE p.id = c.id_plataforma";

	if(isset($_POST['consulta'])){
        $q = $link->real_escape_string($_POST['consulta']);
        
		$sql = "SELECT c.id, p.nombre, c.serial, p.costo_por_hora, p.costo_en_monedas
        FROM consolas c, plataformas p
        WHERE p.id = c.id_plataforma AND p.nombre LIKE %" . $q . "%;";
	}

    $resultado = $link -> query($sql);
	echo (mysqli_error($link));

	if($resultado -> num_rows > 0){
		$salida.= "<table class='table table-xs mb-0'>
					 <thead>
					 	<tr>
                            <th>id</th>
                            <th>Nombre</th>
                            <th>Serial</th>
                            <th>Costo por hora</th>
                            <th>Costo en monedas</th>
                        </tr>
                    </thead>
                    <tbody>";

                    while ($ver = $resultado -> fetch_assoc()) {
                    	$salida.="<tr>
                                    <td>".$ver['id']."</td>
                                    <td>".$ver['nombre']."</td>
                                    <td>".$ver['serial']."</td>
                                    <td>".$ver['costo_por_hora']."</td>
                                    <td>".$ver['costo_en_monedas']."</td>
                                    <td>
                                        <button type='button' class='btn btn-primary'  data-toggle='modal' data-target='#modal' value='".$ver['id']."' onclick='act(".$ver['id'].");'> Actualizar
                                	</td>
                                    <td>
                                        <button type='button' value='".$ver['id']."' id='eliminar' onclick='preg(".$ver['id'].");' class='btn btn-danger'>Eliminar
                                    </td>
                                </tr>";
                    }
                    $salida.="</tbody></table>";
                    $salida.="<script>
                                function act(id){
                                    window.location.href = 'actualizar.php?consulta='+id;
                                };

                                function preg(id){
                                    alert('Esta a punto de eliminar esta consola, click en Aceptar si desea continuar');
                                    window.location.href = 'eliminar.php?consulta='+id;
                                }
                            </script>";
	} else {
		$salida.= "vacio";
	}
	
	echo $salida;
	$link -> close();
?>

