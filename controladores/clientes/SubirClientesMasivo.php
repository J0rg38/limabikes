<?php
	include('../../config/conexion.php');

	$name = $_FILES["excelclientes"]["name"];
    move_uploaded_file( $_FILES["excelclientes"]["tmp_name"], "uploads/" . $_FILES['excelclientes']['name']);

    require_once '../../assets/libs/PHPExcel/Classes/PHPExcel.php';
	$archivo = "uploads/".$name;
	$inputFileType = PHPExcel_IOFactory::identify($archivo);
	$objReader = PHPExcel_IOFactory::createReader($inputFileType);
	$objPHPExcel = $objReader->load($archivo);
	$sheet = $objPHPExcel->getSheet(0); 
	$highestRow = $sheet->getHighestRow(); 
	$highestColumn = $sheet->getHighestColumn();

	$num=0;
	for ($row = 2; $row <= $highestRow; $row++){ 
		$num++;

		$CliId = $sheet->getCell("A".$row)->getValue();
		$TdoId = $sheet->getCell("B".$row)->getValue();
		$CliNumeroDocumento = $sheet->getCell("C".$row)->getValue();
		$CliPrimerNombre = $sheet->getCell("D".$row)->getValue();
		$CliSegundoNombre = $sheet->getCell("E".$row)->getValue();
		$CliApellidoPaterno = $sheet->getCell("F".$row)->getValue();
		$CliApellidoMaterno = $sheet->getCell("G".$row)->getValue();
		$CliCelular = $sheet->getCell("H".$row)->getValue();
		$CliEmail = $sheet->getCell("I".$row)->getValue();
		$CliEstado = '1';


		if($CliId == ''){
			$sql = "

			INSERT INTO clientes (
				TdoId,
				CliNumeroDocumento,
				CliPrimerNombre,
				CliSegundoNombre,
				CliApellidoPaterno,
				CliApellidoMaterno,
				CliCelular,
				CliEmail,
				CliEstado
				) VALUES (
				'".$TdoId."',
				'".$CliNumeroDocumento."',
				'".$CliPrimerNombre."',
				'".$CliSegundoNombre."',
				'".$CliApellidoPaterno."',
				'".$CliApellidoMaterno."',
				'".$CliCelular."',
				'".$CliEmail."',
				'".$CliEstado."'
				)
			";
		}else{
			$sql = "
				UPDATE clientes SET 
				TdoId = '".$TdoId."',
				CliNumeroDocumento = '".$CliNumeroDocumento."',
				CliPrimerNombre = '".$CliPrimerNombre."',
				CliSegundoNombre = '".$CliSegundoNombre."',
				CliApellidoPaterno = '".$CliApellidoPaterno."',
				CliApellidoMaterno = '".$CliApellidoMaterno."',
				CliCelular = '".$CliCelular."',
				CliEmail = '".$CliEmail."' 
				WHERE CliId = '".$CliId."'
			";
		}

		

		if(mysqli_query($conexion,$sql)){
			echo "ok";
		}else{
			echo "err";
		}
	}

?>