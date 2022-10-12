<?php
	include('../../config/conexion.php');
	$GrpId = $_POST['idgrupo'];

	$sql = "
		DELETE FROM grupoclientes WHERE GrpId = '".$GrpId."'
	";

	$sql2 = "
		DELETE FROM asig_grpcli WHERE GrpId = '".$GrpId."'
	";

	if(mysqli_query($conexion,$sql)){
		if(mysqli_query($conexion,$sql2)){
			echo 'ok';
		}else{
			echo 'err';
		}
	}else{
		echo "err";
	}

?>