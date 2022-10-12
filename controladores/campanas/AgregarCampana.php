<?php 
	include('../../config/conexion.php');
	$CmpNombre = $_POST['nombrecampana'];
	$GrpId = $_POST['grpid'];
	$EncId = $_POST['encid'];
	$CmpFechaEnvio = $_POST['fechaenvio'];

	$sql = "
		INSERT INTO campanas (CmpNombre,CmpFechaEnvio,GrpId,EncId,CmpEstadoEnvio,CmpEstado,CmpFechaCreacion) VALUES (
				'".$CmpNombre."',
				'".$CmpFechaEnvio."',
				'".$GrpId."',
				'".$EncId."',
				'0',
				'1',
				'".$FechaActual."'
			)
	";

	if(mysqli_query($conexion,$sql)){
		$ConsultaUltimaEnc = "
			SELECT
			campanas.CmpId
			FROM
			campanas
			WHERE
			campanas.CmpEstado = '1'
			ORDER BY
			campanas.CmpFechaCreacion DESC
			LIMIT 1
		";
		$ResultadoUltimaEnc = mysqli_query($conexion,$ConsultaUltimaEnc);
		while($dataUltimaEnc = mysqli_fetch_array($ResultadoUltimaEnc)){
			$CmpId = $dataUltimaEnc['CmpId'];
		}

		$ConsultaClientes = "
			SELECT
			grupoclientes.GrpId,
			asig_grpcli.CliId
			FROM
			grupoclientes
			JOIN asig_grpcli
			ON grupoclientes.GrpId = asig_grpcli.GrpId
			WHERE
			grupoclientes.GrpId = '".$GrpId."'
		";

		$ResultadoClientes = mysqli_query($conexion,$ConsultaClientes);
		while ($dataClientes = mysqli_fetch_array($ResultadoClientes)) {
			$permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';
			$url = substr(str_shuffle($permitted_chars), 0, 16);
			$sql_insertenc = "
				INSERT INTO asig_cmpenc (
						CliId,
						EncId,
						CmpId,
						CmpEncUrl,
						CmpEncContestado,
						CmpEncEstado
					) VALUES (
						'".$dataClientes['CliId']."',
						'".$EncId."',
						'".$CmpId."',
						'".$url."',
						'0',
						'1'
					)
			";
			mysqli_query($conexion,$sql_insertenc);
		}
		echo "ok";
	}else{

	}

?>