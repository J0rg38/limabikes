<?php
	
	include('../../config/conexion.php');

	$CliId = $_POST['idcliente'];

	$ConsultaEstado = "
		SELECT CliEstado FROM clientes WHERE CliId = '".$CliId."'
	";
	$ResultadoConsultaEstado = mysqli_query($conexion,$ConsultaEstado);

	while($data = mysqli_fetch_array($ResultadoConsultaEstado)){
		$estado = $data['CliEstado'];
		if($estado == '1'){
			$estado = '2';
		}elseif($estado == '2'){
			$estado = '1';
		}
	}

	$sql = "
		UPDATE clientes 
		SET CliEstado='".$estado."'
		WHERE CliId='".$CliId."'
	";

	if(mysqli_query($conexion,$sql)){
		echo "ok";
	}else{
		echo "err";
	}


?>