<?php
	error_reporting(0);
	include('../../config/conexion.php');

	$GrpNombre = $_POST['nombregrupo'];

	$sql = "
		INSERT INTO grupoclientes(
				GrpNombre,
				GrpEstado
			) VALUES(
				'".$GrpNombre."',
				'1'
			)
	";

	if(mysqli_query($conexion,$sql)){
		echo "ok";
	}else{
		echo "err";
	}


?>