<?php
	include('../../config/conexion.php');
	$CliId = $_POST['idcliente'];

	$sql = "
		DELETE FROM clientes WHERE CliId = '".$CliId."'
	";

	if(mysqli_query($conexion,$sql)){
		echo "ok";
	}else{
		echo "err";
	}

?>