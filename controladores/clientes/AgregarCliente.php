<?php
	error_reporting(0);
	include('../../config/conexion.php');

	$TipoDoc = $_POST['tipodoc'];
	$NumeroDoc = $_POST['numerodoc'];
	$Nombres = $_POST['nombres'];
	$Apellidos = $_POST['apellidos'];
	$Celular = $_POST['celular'];
	$Email = $_POST['email'];

	$SegundoApellido = "";
	$SegundoNombre = "";

	$NombreArray = explode(" ", $Nombres);
	$PrimerNombre = $NombreArray[0];
	$SegundoNombre = $NombreArray[1];

	$ApellidoArray = explode(" ", $Apellidos);
	$PrimerApellido = $ApellidoArray[0];
	$SegundoApellido = $ApellidoArray[1];

	$sql = "
		INSERT INTO clientes(
				TdoId,
				CliNumeroDocumento,
				CliPrimerNombre,
				CliSegundoNombre,
				CliApellidoPaterno,
				CliApellidoMaterno,
				CliCelular,
				CliEmail,
				CliEstado
			) VALUES(
				'".$TipoDoc."',
				'".$NumeroDoc."',
				'".$PrimerNombre."',
				'".$SegundoNombre."',
				'".$PrimerApellido."',
				'".$SegundoApellido."',
				'".$Celular."',
				'".$Email."',
				'1'
			)
	";

	if(mysqli_query($conexion,$sql)){
		echo "ok";
	}else{
		echo "err";
	}


?>