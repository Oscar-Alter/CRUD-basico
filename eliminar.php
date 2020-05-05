<?php 
	 include_once "../connect_db.php";

	if(isset($_GET['consulta'])){
		$q = $link->real_escape_string($_GET['consulta']);

		$sql = "DELETE FROM consolas WHERE id = " . $q . ";";
	}

	$resultado = $link -> query($sql);
	echo (mysqli_error($link));
	echo "<script>window.location.href ='visualizar.php'</script>"
?>

