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

	$GrpId = $_POST['grpid'];

	$num=0;
	for ($row = 2; $row <= $highestRow; $row++){ 
		$num++;

		$CliId = $sheet->getCell("A".$row)->getValue();

		$duplicado = "
			SELECT * FROM asig_grpcli WHERE GrpId = '".$GrpId."' AND CliId = '".$CliId."'
		";

		$numDuplicado = mysqli_num_rows(mysqli_query($conexion,$duplicado));

		if($numDuplicado > 0){

		}else{
			$sql = "
			INSERT INTO asig_grpcli (
					GrpId,
					CliId
				) VALUES (
					'".$GrpId."',
					'".$CliId."'
				)
			";
		}
		

		if(mysqli_query($conexion,$sql)){
			echo "ok";
		}else{
			echo "err";
		}
	}

?>