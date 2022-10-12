<?php
	
	include('../../config/conexion.php');

	$CliId = $_POST['idcliente'];
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
		UPDATE clientes 
		SET TdoId='".$TipoDoc."',
			CliNumeroDocumento='".$NumeroDoc."',
			CliPrimerNombre='".$PrimerNombre."',
			CliSegundoNombre='".$SegundoNombre."',
			CliApellidoPaterno='".$PrimerApellido."',
			CliApellidoMaterno='".$SegundoApellido."',
			CliCelular='".$Celular."',
			CliEmail='".$Email."' 
		WHERE CliId='".$CliId."'
	";

	if(mysqli_query($conexion,$sql)){
		echo "ok";
	}else{
		echo "err";
	}


?>