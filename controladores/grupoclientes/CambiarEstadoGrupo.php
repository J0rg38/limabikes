<?php
	
	include('../../config/conexion.php');

	$GrpId = $_POST['idgrupo'];

	$ConsultaEstado = "
		SELECT GrpEstado FROM grupoclientes WHERE GrpId = '".$GrpId."'
	";
	$ResultadoConsultaEstado = mysqli_query($conexion,$ConsultaEstado);

	while($data = mysqli_fetch_array($ResultadoConsultaEstado)){
		$estado = $data['GrpEstado'];
		if($estado == '1'){
			$estado = '2';
		}elseif($estado == '2'){
			$estado = '1';
		}
	}

	$sql = "
		UPDATE grupoclientes 
		SET GrpEstado='".$estado."'
		WHERE GrpId='".$GrpId."'
	";

	if(mysqli_query($conexion,$sql)){
		echo "ok";
	}else{
		echo "err";
	}


?>