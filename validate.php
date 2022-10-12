<?php

    include('config/conexion.php');

    $email = $_POST['email'];
    $passwd = $_POST['passwd'];

    $sql = "
        SELECT UsuEstado 
        FROM usuarios WHERE 
        UsuCorreo = '".$email."' AND 
        UsuPass = '".$passwd."'
    ";

    $resultado = mysqli_query($conexion, $sql);
    $num = mysqli_num_rows($resultado);

    if($num > 0){
        echo "Login Exitoso";
    }else{
        echo "Login Fallido";
    }

?>