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
    <link href="assets/extra-libs/c3/c3.min.css" rel="stylesheet">
    <link href="assets/libs/chartist/dist/chartist.min.css" rel="stylesheet">
    <link href="assets/extra-libs/jvector/jquery-jvectormap-2.0.2.css" rel="stylesheet" />
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
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->



        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        



        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        

            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <?php
                    include('config/conexion.php');
                    if(isset($_GET['tk'])){
                        // echo "esta definido";
                        $ConsultaEncuesta = "SELECT * FROM asig_cmpenc WHERE CmpEncUrl = '".$_GET['tk']."'";
                        $NumEncuesta = mysqli_num_rows(mysqli_query($conexion,$ConsultaEncuesta));

                        if($NumEncuesta > 0){
                            $ResultadoConsultaEnc = mysqli_query($conexion,$ConsultaEncuesta);
                            while($dataEnc = mysqli_fetch_array($ResultadoConsultaEnc)){
                                $Respondido = $dataEnc['CmpEncContestado'];
                            }

                            if($Respondido == '0'){
                                ?>
                                <div class="container">
                                    <form method="post" action="sendform.php">
                                        <div class="row">
                                            <div class="col-12" style="text-align: center; margin-top: 3%;">
                                                <h2>Bienvenido a tu encuesta de satisfaccion 📝</h2>
                                                <input type="hidden" name="token" value="<?php echo $_GET['tk']; ?>">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-12" style="margin-top: 3%;">
                                                <h3>Del 1 al 10, que tanto recomendarias a LimaBikes a tus amigos o familiares?</h3>
                                                <label style="margin-left: 2%;" for="1_1">1</label>
                                                <input type="radio" value="1" name="pregunta1" id="1_1" required>

                                                <label style="margin-left: 2%;" for="1_2">2</label>
                                                <input type="radio" value="2" name="pregunta1" id="1_2" required>

                                                <label style="margin-left: 2%;" for="1_3">3</label>
                                                <input type="radio" value="3" name="pregunta1" id="1_3" required>

                                                <label style="margin-left: 2%;" for="1_4">4</label>
                                                <input type="radio" value="4" name="pregunta1" id="1_4" required>

                                                <label style="margin-left: 2%;" for="1_5">5</label>
                                                <input type="radio" value="5" name="pregunta1" id="1_5" required>

                                                <label style="margin-left: 2%;" for="1_6">6</label>
                                                <input type="radio" value="6" name="pregunta1" id="1_6" required>

                                                <label style="margin-left: 2%;" for="1_7">7</label>
                                                <input type="radio" value="7" name="pregunta1" id="1_7" required>

                                                <label style="margin-left: 2%;" for="1_8">8</label>
                                                <input type="radio" value="8" name="pregunta1" id="1_8" required>

                                                <label style="margin-left: 2%;" for="1_9">9</label>
                                                <input type="radio" value="9" name="pregunta1" id="1_9" required>

                                                <label style="margin-left: 2%;" for="1_10">10</label>
                                                <input type="radio" value="10" name="pregunta1" id="1_10" required>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-12" style="margin-top: 3%;">
                                                <h3>¿Basándose en su experiencia general de compra y entrega, ¿cuál es su grado de satisfacción?</h3>
                                                <label style="margin-left: 2%;" for="2_1">Nada Satisfecho</label>
                                                <input type="radio" value="1" name="pregunta2" id="2_1" required>

                                                <label style="margin-left: 2%;" for="2_2">Poco Satisfecho</label>
                                                <input type="radio" value="2" name="pregunta2" id="2_2" required>

                                                <label style="margin-left: 2%;" for="2_3">Indiferente</label>
                                                <input type="radio" value="3" name="pregunta2" id="2_3" required>

                                                <label style="margin-left: 2%;" for="2_4">Satisfecho</label>
                                                <input type="radio" value="4" name="pregunta2" id="2_4" required>

                                                <label style="margin-left: 2%;" for="2_5">Muy Satisfecho</label>
                                                <input type="radio" value="5" name="pregunta2" id="2_5" required>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-12" style="margin-top: 3%;">
                                                <h3>¿Cuál es su grado de satisfaccion con nuestro asesor comercial?</h3>
                                                <label style="margin-left: 2%;" for="3_1">Nada Satisfecho</label>
                                                <input type="radio" value="1" name="pregunta3" id="3_1" required>

                                                <label style="margin-left: 2%;" for="3_2">Poco Satisfecho</label>
                                                <input type="radio" value="2" name="pregunta3" id="3_2" required>

                                                <label style="margin-left: 2%;" for="3_3">Indiferente</label>
                                                <input type="radio" value="3" name="pregunta3" id="3_3" required>

                                                <label style="margin-left: 2%;" for="3_4">Satisfecho</label>
                                                <input type="radio" value="4" name="pregunta3" id="3_4" required>

                                                <label style="margin-left: 2%;" for="3_5">Muy Satisfecho</label>
                                                <input type="radio" value="5" name="pregunta3" id="3_5" required>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-12" style="margin-top: 3%;">
                                                <h3>Dejanos tus comentarios:</h3>
                                                <textarea class="form-control" name="comentarios"></textarea>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-12" style="text-align: center; margin-top: 3%;">
                                                <button type="submit" class="btn btn-primary">Enviar</button>
                                            </div>
                                        </div>
                                    </form>

                                </div>
                                <?php
                            }elseif($Respondido == '1'){
                                ?>
                                <div class="row">
                                    <div class="col-12" style="text-align: center; margin-top: 3%;">
                                        <h2>La encuesta se encuentra respondida o deshabilitada ❌🧐</h2>
                                        <img src="assets/images/encuestarespondida.png" class="img-fluid" style="width: 40%">
                                    </div>
                                </div>
                                <?php
                            }
                        }else{
                            ?>
                            <div class="row">
                                <div class="col-12" style="text-align: center; margin-top: 3%;">
                                    <h2>No tiene acceso ❌🧐</h2>
                                    <img src="assets/images/accesodenegado.png" class="img-fluid" style="margin: 3% 0 3% 0;">
                                </div>
                            </div>
                            <?php
                        }
                    }else{
                        // echo "no esta definido";
                        ?>
                        <div class="row">
                            <div class="col-12" style="text-align: center; margin-top: 3%;">
                                <h2>No tiene acceso ❌🧐</h2>
                                <img src="assets/images/accesodenegado.png" class="img-fluid" style="margin: 3% 0 3% 0;">
                            </div>
                        </div>
                        <?php
                    }
                ?>

            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <footer class="footer text-center text-muted">
                All Rights Reserved by Limabikes and Lizzo. Designed and Developed by <a
                    href="https://wrappixel.com">Limabikes IT & CO</a>.
            </footer>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
       
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
   
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- apps -->
    <!-- apps -->
    <script src="dist/js/app-style-switcher.js"></script>
    <script src="dist/js/feather.min.js"></script>
    <script src="assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
    <script src="dist/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="dist/js/custom.min.js"></script>
    <!--This page JavaScript -->
    <script src="assets/extra-libs/c3/d3.min.js"></script>
    <script src="assets/extra-libs/c3/c3.min.js"></script>
    <script src="assets/libs/chartist/dist/chartist.min.js"></script>
    <script src="assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js"></script>
    <script src="assets/extra-libs/jvector/jquery-jvectormap-2.0.2.min.js"></script>
    <script src="assets/extra-libs/jvector/jquery-jvectormap-world-mill-en.js"></script>
    <script src="dist/js/pages/dashboards/dashboard1.min.js"></script>
</body>

</html>