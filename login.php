<?php

    include('config/conexion.php');
    $textmessage = "Ingresa tus credenciales para acceder al admin panel.";
    $colormessage = "";

    if(isset($_POST['email'])){
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
            while($data = mysqli_fetch_array($resultado)){
                $estado = $data['UsuEstado'];
            }
            if($estado == '0'){
                $textmessage = "Usuario dehabilitado, por favor contacta a soporte si algo esta mal.";
                $colormessage = "#C16B7C";
            }elseif($estado == '1'){
                header('Location: index.php');
                die();
            }
        }else{
            $textmessage = "Login fallido, revise sus credenciales o contacte con soporte.";
            $colormessage = "#C16B7C";
        }
    }else{

    }
    

?>

<!DOCTYPE html>
<html dir="ltr" lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon.ico">
    <title>Admin LimaBikes</title>
    <!-- Custom CSS -->
    <link href="dist/css/style.min.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>
    <div class="main-wrapper">
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <div class="preloader">
            <div class="lds-ripple">
                <div class="lds-pos"></div>
                <div class="lds-pos"></div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Login box.scss -->
        <!-- ============================================================== -->
        <div class="auth-wrapper d-flex no-block justify-content-center align-items-center position-relative"
            style="background:url(assets/images/big/auth-bg.jpg) no-repeat center center;">
            <div class="auth-box row">
                <div class="col-lg-7 col-md-5 modal-bg-img" style="background-image: url(assets/images/big/login.jpeg);">
                </div>
                <div class="col-lg-5 col-md-7 bg-white">
                    <div class="p-3">
                        <div class="text-center">
                            <img src="assets/images/logo2.png" alt="wrapkit" class="img-fluid">
                        </div>
                        <h2 class="mt-3 text-center">Login</h2>
                        <p class="text-center" style="color: <?php echo $colormessage; ?>"><?php echo $textmessage; ?></p>
                        <form class="mt-4" action="login.php" method="post">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="text-dark" for="uname">Correo</label>
                                        <input class="form-control" id="uname" type="text" name="email"
                                            placeholder="ingresa tu correo">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="text-dark" for="pwd">Contraseña</label>
                                        <input class="form-control" id="pwd" type="password" name="passwd"
                                            placeholder="Ingresa tu contraseña">
                                    </div>
                                </div>
                                <div class="col-lg-12 text-center">
                                    <button type="submit" class="btn btn-block btn-dark">Ingresar</button>
                                </div>
                                <!-- <div class="col-lg-12 text-center mt-5">
                                    Don't have an account? <a href="#" class="text-danger">Sig</a>
                                </div> -->
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- Login box.scss -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- All Required js -->
    <!-- ============================================================== -->
    <script src="assets/libs/jquery/dist/jquery.min.js "></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="assets/libs/popper.js/dist/umd/popper.min.js "></script>
    <script src="assets/libs/bootstrap/dist/js/bootstrap.min.js "></script>
    <!-- ============================================================== -->
    <!-- This page plugin js -->
    <!-- ============================================================== -->
    <script>
        $(".preloader ").fadeOut();
    </script>
</body>

</html>