<?php
	date_default_timezone_set('America/Lima');
	$FechaActual = date('Y-m-d H:i:s');

	$servidor="localhost";
	$user="root";
	$password = "";
	$database = "limabikes";

	$conexion = mysqli_connect($servidor,$user,$password,$database);
?>