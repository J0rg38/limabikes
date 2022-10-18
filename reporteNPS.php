<?php
    include('config/conexion.php');
    $MesActual = date('m');
    switch ($MesActual) {
        case "1":
            $FechaInicio = '2022-01-01';
            $FechaFin = '2022-01-31';
            break;
        case "2":
            $FechaInicio = '2022-02-01';
            $FechaFin = '2022-02-28';
            break;
        case "3":
            $FechaInicio = '2022-03-01';
            $FechaFin = '2022-03-31';
            break;
        case "4":
            $FechaInicio = '2022-04-01';
            $FechaFin = '2022-04-30';
            break;
        case "5":
            $FechaInicio = '2022-05-01';
            $FechaFin = '2022-05-31';
            break;
        case "6":
            $FechaInicio = '2022-06-01';
            $FechaFin = '2022-06-30';
            break;
        case "7":
            $FechaInicio = '2022-07-01';
            $FechaFin = '2022-07-31';
            break;
        case "8":
            $FechaInicio = '2022-08-01';
            $FechaFin = '2022-08-31';
            break;
        case "9":
            $FechaInicio = '2022-09-01';
            $FechaFin = '2022-09-30';
            break;
        case "10":
            $FechaInicio = '2022-10-01';
            $FechaFin = '2022-10-31';
            break;
        case "11":
            $FechaInicio = '2022-11-01';
            $FechaFin = '2022-11-30';
            break;
        case "12":
            $FechaInicio = '2022-12-01';
            $FechaFin = '2022-12-31';
            break;
    }

    $ConsultaNPS = "
        SELECT
        asig_cmpenc.CmpEncContestado, 
        asig_cmpenc.CmpEncUrl, 
        asig_cmpenc.CmpEncId, 
        asig_cmpenc.CliId, 
        asig_cmpenc.EncId, 
        asig_cmpenc.CmpId, 
        asig_cmpenc.CmpEncFechaContestado, 
        asig_cmpenc.CmpEncEstado, 
        asig_cmpenc.CmpPregunta1, 
        asig_cmpenc.CmpPregunta2, 
        asig_cmpenc.CmpPregunta3, 
        asig_cmpenc.CmpVerbatin, 
        clientes.CliNumeroDocumento, 
        clientes.CliPrimerNombre, 
        clientes.CliSegundoNombre, 
        clientes.CliApellidoPaterno, 
        clientes.CliApellidoMaterno, 
        clientes.CliCelular, 
        clientes.CliEmail
        FROM
            asig_cmpenc
            INNER JOIN
            clientes
            ON 
                asig_cmpenc.CliId = clientes.CliId
        WHERE
            asig_cmpenc.CmpEncFechaContestado BETWEEN '".$FechaInicio."' AND '".$FechaFin."'
    ";

    $NumEncuestas = mysqli_num_rows(mysqli_query($conexion,$ConsultaNPS));
    $ResultadoEncuestas = mysqli_query($conexion,$ConsultaNPS);
    $ResultadoEncuestas2 = mysqli_query($conexion,$ConsultaNPS);

    //p1
    $promotores = 0;
    $neutros = 0;
    $detractores = 0;

    //p2
    $P2MuySatisfecho = 0;
    $P2Satisfecho = 0;
    $P2Indiferente = 0;
    $P2Insatisfecho = 0;
    $P2NadaSatisfecho = 0;

    //p2
    $P3MuySatisfecho = 0;
    $P3Satisfecho = 0;
    $P3Indiferente = 0;
    $P3Insatisfecho = 0;
    $P3NadaSatisfecho = 0;

    while($dataEncuestas = mysqli_fetch_array($ResultadoEncuestas)){
        //p1
        $p1 = $dataEncuestas['CmpPregunta1'];
        if($p1 >= 9 && $p1 <= 10){
            $promotores++;
        }elseif($p1 >= 7 && $p1 <= 8){
            $neutros++;
        }elseif($p1 > 0 && $p1 <= 6){
            $detractores++;
        }else{

        }

        //p2
        switch ($dataEncuestas['CmpPregunta2']) {
            case "1":
                $P2NadaSatisfecho++;
                break;
            case "2":
                $P2Insatisfecho++;
                break;
            case "3":
                $P2Indiferente++;
                break;
            case "4":
                $P2Satisfecho++;
                break;
            case "5":
                $P2MuySatisfecho++;
                break;
        }

        //p3
        switch ($dataEncuestas['CmpPregunta3']) {
            case "1":
                $P3NadaSatisfecho++;
                break;
            case "2":
                $P3Insatisfecho++;
                break;
            case "3":
                $P3Indiferente++;
                break;
            case "4":
                $P3Satisfecho++;
                break;
            case "5":
                $P3MuySatisfecho++;
                break;
        }

    }

    $NumNPS = $promotores - $detractores;
    $PorcentajeNPS = ($NumNPS*100)/$NumEncuestas;

    $PorcentajePromotores = ($promotores*100)/$NumEncuestas;
    $PorcentajeDetractores = ($detractores*100)/$NumEncuestas;
    $PorcentajeNeutros = ($neutros*100)/$NumEncuestas;

    //p2

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
    <link href="assets/extra-libs/c3/c3.min.css" rel="stylesheet">
    <link href="assets/libs/chartist/dist/chartist.min.css" rel="stylesheet">
    <link href="assets/extra-libs/jvector/jquery-jvectormap-2.0.2.css" rel="stylesheet" />
    <link href="assets/libs/morris.js/morris.css" rel="stylesheet">
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
    <div id="main-wrapper" data-theme="light" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed" data-boxed-layout="full">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <?php include('navbar.php'); ?>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <?php include('sidebar.php'); ?>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->


            
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- *************************************************************** -->
                <!-- Start First Cards -->
                <!-- *************************************************************** -->
                <div class="card-group">
                    <div class="card border-right">
                        <div class="card-body">
                            <div class="d-flex d-lg-flex d-md-block align-items-center">
                                <div>
                                    <div class="d-inline-flex align-items-center">
                                        <h2 class="text-dark mb-1 font-weight-medium"><?php echo $PorcentajeNPS; ?></h2>
                                        <span
                                            class="badge bg-success font-12 text-white font-weight-medium badge-pill ml-2 d-lg-block d-md-none">bueno</span>
                                    </div>
                                    <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">%Promotores - %Detractores = NPS</h6>
                                </div>
                                <div class="ml-auto mt-md-3 mt-lg-0">
                                    <span class="opacity-7 text-muted"><i data-feather="user-plus"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card border-right">
                        <div class="card-body">
                            <div class="d-flex d-lg-flex d-md-block align-items-center">
                                <div>
                                    <div class="d-inline-flex align-items-center">
                                        <h2 class="text-dark mb-1 font-weight-medium"><?php echo $promotores; ?></h2>
                                        <span
                                            class="badge bg-success font-12 text-white font-weight-medium badge-pill ml-2 d-md-none d-lg-block"><?php echo $PorcentajePromotores; ?>%</span>
                                    </div>
                                    <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Promotores</h6>
                                </div>
                                <div class="ml-auto mt-md-3 mt-lg-0">
                                    <span class="opacity-7 text-muted"><i data-feather="dollar-sign"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card border-right">
                        <div class="card-body">
                            <div class="d-flex d-lg-flex d-md-block align-items-center">
                                <div>
                                    <div class="d-inline-flex align-items-center">
                                        <h2 class="text-dark mb-1 font-weight-medium"><?php echo $detractores; ?></h2>
                                        <span
                                            class="badge bg-danger font-12 text-white font-weight-medium badge-pill ml-2 d-md-none d-lg-block"><?php echo $PorcentajeDetractores; ?>%</span>
                                    </div>
                                    <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Detractores</h6>
                                </div>
                                <div class="ml-auto mt-md-3 mt-lg-0">
                                    <span class="opacity-7 text-muted"><i data-feather="file-plus"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex d-lg-flex d-md-block align-items-center">
                                <div>
                                    <div class="d-inline-flex align-items-center">
                                        <h2 class="text-dark mb-1 font-weight-medium"><?php echo $neutros; ?></h2>
                                        <span
                                            class="badge bg-primary font-12 text-white font-weight-medium badge-pill ml-2 d-md-none d-lg-block"><?php echo $PorcentajeNeutros; ?>%</span>
                                    </div>
                                    <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Neutros</h6>
                                </div>
                                <div class="ml-auto mt-md-3 mt-lg-0">
                                    <span class="opacity-7 text-muted"><i data-feather="globe"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- *************************************************************** -->
                <!-- End First Cards -->
                <!-- *************************************************************** -->
                <!-- *************************************************************** -->
                <!-- Start Sales Charts Section -->
                <!-- *************************************************************** -->
                <div class="row">
                    <div class="col-lg-4 col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Pregunta S1:</h4>
                                <p>
                                    ¿Basándose en su experiencia general de compra y entrega, ¿cuál es su grado de satisfacción?
                                </p>
                                <div id="campaign-v2" class="mt-2" style="height:283px; width:100%;"></div>
                                <ul class="list-style-none mb-0">
                                    <li>
                                        <i class="fas fa-circle font-10 mr-2" style="color: #16C00E"></i>
                                        <span class="text-muted">Muy Satisfecho</span>
                                        <span class="text-dark float-right font-weight-medium"><?php echo $P2MuySatisfecho; ?></span>
                                        <input type="hidden" id="p2muysatisfecho" value="<?php echo $P2MuySatisfecho; ?>">
                                    </li>
                                    <li class="mt-3">
                                        <i class="fas fa-circle font-10 mr-2" style="color: #92C00E"></i>
                                        <span class="text-muted">Satisfecho</span>
                                        <span class="text-dark float-right font-weight-medium"><?php echo $P2Satisfecho; ?></span>
                                        <input type="hidden" id="p2satisfecho" value="<?php echo $P2Satisfecho; ?>">
                                    </li>
                                    <li class="mt-3">
                                        <i class="fas fa-circle font-10 mr-2" style="color: #EDD611"></i>
                                        <span class="text-muted">Indiferente</span>
                                        <span class="text-dark float-right font-weight-medium"><?php echo $P2Indiferente; ?></span>
                                        <input type="hidden" id="p2indiferente" value="<?php echo $P2Indiferente; ?>">
                                    </li>
                                    <li class="mt-3">
                                        <i class="fas fa-circle font-10 mr-2" style="color: #D66E06"></i>
                                        <span class="text-muted">Insatisfecho</span>
                                        <span class="text-dark float-right font-weight-medium"><?php echo $P2Insatisfecho; ?></span>
                                        <input type="hidden" id="p2insatisfecho" value="<?php echo $P2Insatisfecho; ?>">
                                    </li>
                                    <li class="mt-3">
                                        <i class="fas fa-circle font-10 mr-2" style="color: #D60F06"></i>
                                        <span class="text-muted">Nada Satisfecho</span>
                                        <span class="text-dark float-right font-weight-medium"><?php echo $P2NadaSatisfecho; ?></span>
                                        <input type="hidden" id="p2nadasatisfecho" value="<?php echo $P2NadaSatisfecho; ?>">
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12">
                        <!-- <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Net Income</h4>
                                <div class="net-income mt-4 position-relative" style="height:294px;"></div>
                                <ul class="list-inline text-center mt-5 mb-2">
                                    <li class="list-inline-item text-muted font-italic">Sales for this month</li>
                                </ul>
                            </div>
                        </div> -->

                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Pregunta S2:</h4>
                                <p>
                                    ¿Cuál es su grado de satisfaccion con nuestro asesor comercial?
                                </p>
                                <div id="campaign-v3" class="mt-2" style="height:283px; width:100%;"></div>
                                <ul class="list-style-none mb-0">
                                    <li>
                                        <i class="fas fa-circle font-10 mr-2" style="color: #16C00E"></i>
                                        <span class="text-muted">Muy Satisfecho</span>
                                        <span class="text-dark float-right font-weight-medium"><?php echo $P3MuySatisfecho; ?></span>
                                        <input type="hidden" id="p3muysatisfecho" value="<?php echo $P3MuySatisfecho; ?>">
                                    </li>
                                    <li class="mt-3">
                                        <i class="fas fa-circle font-10 mr-2" style="color: #92C00E"></i>
                                        <span class="text-muted">Satisfecho</span>
                                        <span class="text-dark float-right font-weight-medium"><?php echo $P3Satisfecho; ?></span>
                                        <input type="hidden" id="p3satisfecho" value="<?php echo $P3Satisfecho; ?>">
                                    </li>
                                    <li class="mt-3">
                                        <i class="fas fa-circle font-10 mr-2" style="color: #EDD611"></i>
                                        <span class="text-muted">Indiferente</span>
                                        <span class="text-dark float-right font-weight-medium"><?php echo $P3Indiferente; ?></span>
                                        <input type="hidden" id="p3indiferente" value="<?php echo $P3Indiferente; ?>">
                                    </li>
                                    <li class="mt-3">
                                        <i class="fas fa-circle font-10 mr-2" style="color: #D66E06"></i>
                                        <span class="text-muted">Insatisfecho</span>
                                        <span class="text-dark float-right font-weight-medium"><?php echo $P3Insatisfecho; ?></span>
                                        <input type="hidden" id="p3insatisfecho" value="<?php echo $P3Insatisfecho; ?>">
                                    </li>
                                    <li class="mt-3">
                                        <i class="fas fa-circle font-10 mr-2" style="color: #D60F06"></i>
                                        <span class="text-muted">Nada Satisfecho</span>
                                        <span class="text-dark float-right font-weight-medium"><?php echo $P3NadaSatisfecho; ?></span>
                                        <input type="hidden" id="p3nadasatisfecho" value="<?php echo $P3NadaSatisfecho; ?>">
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Total Encuestas</h4>

                                <div class="d-flex d-lg-flex d-md-block align-items-center">
                                    <div>
                                        <div class="d-inline-flex align-items-center">
                                            <h2 class="text-dark mb-1 font-weight-medium"><?php echo $NumEncuestas; ?></h2>
                                            <!-- <span
                                                class="badge bg-primary font-12 text-white font-weight-medium badge-pill ml-2 d-md-none d-lg-block"><?php echo $PorcentajeNeutros; ?>%</span> -->
                                        </div>
                                        <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Encuestados</h6>
                                    </div>
                                    <div class="ml-auto mt-md-3 mt-lg-0">
                                        <span class="opacity-7 text-muted"><i data-feather="globe"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="col-lg-4 col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-4">Earning by Location</h4>
                                <div class="" style="height:180px">
                                    <div id="visitbylocate" style="height:100%"></div>
                                </div>
                                <div class="row mb-3 align-items-center mt-1 mt-5">
                                    <div class="col-4 text-right">
                                        <span class="text-muted font-14">India</span>
                                    </div>
                                    <div class="col-5">
                                        <div class="progress" style="height: 5px;">
                                            <div class="progress-bar bg-primary" role="progressbar" style="width: 100%"
                                                aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                    <div class="col-3 text-right">
                                        <span class="mb-0 font-14 text-dark font-weight-medium">28%</span>
                                    </div>
                                </div>
                                <div class="row mb-3 align-items-center">
                                    <div class="col-4 text-right">
                                        <span class="text-muted font-14">UK</span>
                                    </div>
                                    <div class="col-5">
                                        <div class="progress" style="height: 5px;">
                                            <div class="progress-bar bg-danger" role="progressbar" style="width: 74%"
                                                aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                    <div class="col-3 text-right">
                                        <span class="mb-0 font-14 text-dark font-weight-medium">21%</span>
                                    </div>
                                </div>
                                <div class="row mb-3 align-items-center">
                                    <div class="col-4 text-right">
                                        <span class="text-muted font-14">USA</span>
                                    </div>
                                    <div class="col-5">
                                        <div class="progress" style="height: 5px;">
                                            <div class="progress-bar bg-cyan" role="progressbar" style="width: 60%"
                                                aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                    <div class="col-3 text-right">
                                        <span class="mb-0 font-14 text-dark font-weight-medium">18%</span>
                                    </div>
                                </div>
                                <div class="row align-items-center">
                                    <div class="col-4 text-right">
                                        <span class="text-muted font-14">China</span>
                                    </div>
                                    <div class="col-5">
                                        <div class="progress" style="height: 5px;">
                                            <div class="progress-bar bg-success" role="progressbar" style="width: 50%"
                                                aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                    <div class="col-3 text-right">
                                        <span class="mb-0 font-14 text-dark font-weight-medium">12%</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->
                </div>
                <!-- *************************************************************** -->
                <!-- End Sales Charts Section -->
                <!-- *************************************************************** -->
                <!-- *************************************************************** -->
                <!-- Start Location and Earnings Charts Section -->
                <!-- *************************************************************** -->
                <div class="row">
                    <!-- <div class="col-md-6 col-lg-8">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-start">
                                    <h4 class="card-title mb-0">Earning Statistics</h4>
                                    <div class="ml-auto">
                                        <div class="dropdown sub-dropdown">
                                            <button class="btn btn-link text-muted dropdown-toggle" type="button"
                                                id="dd1" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                                <i data-feather="more-vertical"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dd1">
                                                <a class="dropdown-item" href="#">Insert</a>
                                                <a class="dropdown-item" href="#">Update</a>
                                                <a class="dropdown-item" href="#">Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="pl-4 mb-5">
                                    <div class="stats ct-charts position-relative" style="height: 315px;"></div>
                                </div>
                                <ul class="list-inline text-center mt-4 mb-0">
                                    <li class="list-inline-item text-muted font-italic">Earnings for this month</li>
                                </ul>
                            </div>
                        </div>
                    </div> -->
                    <!-- <div class="col-md-6 col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Recent Activity</h4>
                                <div class="mt-4 activity">
                                    <div class="d-flex align-items-start border-left-line pb-3">
                                        <div>
                                            <a href="javascript:void(0)" class="btn btn-info btn-circle mb-2 btn-item">
                                                <i data-feather="shopping-cart"></i>
                                            </a>
                                        </div>
                                        <div class="ml-3 mt-2">
                                            <h5 class="text-dark font-weight-medium mb-2">New Product Sold!</h5>
                                            <p class="font-14 mb-2 text-muted">John Musa just purchased <br> Cannon 5M
                                                Camera.
                                            </p>
                                            <span class="font-weight-light font-14 text-muted">10 Minutes Ago</span>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-start border-left-line pb-3">
                                        <div>
                                            <a href="javascript:void(0)"
                                                class="btn btn-danger btn-circle mb-2 btn-item">
                                                <i data-feather="message-square"></i>
                                            </a>
                                        </div>
                                        <div class="ml-3 mt-2">
                                            <h5 class="text-dark font-weight-medium mb-2">New Support Ticket</h5>
                                            <p class="font-14 mb-2 text-muted">Richardson just create support <br>
                                                ticket</p>
                                            <span class="font-weight-light font-14 text-muted">25 Minutes Ago</span>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-start border-left-line">
                                        <div>
                                            <a href="javascript:void(0)" class="btn btn-cyan btn-circle mb-2 btn-item">
                                                <i data-feather="bell"></i>
                                            </a>
                                        </div>
                                        <div class="ml-3 mt-2">
                                            <h5 class="text-dark font-weight-medium mb-2">Notification Pending Order!
                                            </h5>
                                            <p class="font-14 mb-2 text-muted">One Pending order from Ryne <br> Doe</p>
                                            <span class="font-weight-light font-14 mb-1 d-block text-muted">2 Hours
                                                Ago</span>
                                            <a href="javascript:void(0)" class="font-14 border-bottom pb-1 border-info">Load More</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->
                </div>
                <!-- *************************************************************** -->
                <!-- End Location and Earnings Charts Section -->
                <!-- *************************************************************** -->
                <!-- *************************************************************** -->
                <!-- Start Top Leader Table -->
                <!-- *************************************************************** -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-4">
                                    <h4 class="card-title">Detalles</h4>
                                    <div class="ml-auto">
                                        <div class="dropdown sub-dropdown">
                                            <button class="btn btn-link text-muted dropdown-toggle" type="button"
                                                id="dd1" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                                <i data-feather="more-vertical"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dd1">
                                                <a class="dropdown-item" href="#">Insert</a>
                                                <a class="dropdown-item" href="#">Update</a>
                                                <a class="dropdown-item" href="#">Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table no-wrap v-middle mb-0">
                                        <thead>
                                            <tr class="border-0">
                                                <th class="border-0 font-14 font-weight-medium text-muted">Cliente
                                                </th>
                                                <th class="border-0 font-14 font-weight-medium text-muted px-2">Project
                                                </th>
                                                <th class="border-0 font-14 font-weight-medium text-muted">Team</th>
                                                <th class="border-0 font-14 font-weight-medium text-muted text-center">
                                                    Status
                                                </th>
                                                <th class="border-0 font-14 font-weight-medium text-muted text-center">
                                                    Weeks
                                                </th>
                                                <th class="border-0 font-14 font-weight-medium text-muted">Budget</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php while($data2 = mysqli_fetch_array($ResultadoEncuestas2)){ 
                                                $p1_2 = $data2['CmpPregunta1'];
                                                if($p1_2 >= 9 && $p1_2 <= 10){
                                                    $icon = "happy.jpg";
                                                }elseif($p1_2 >= 7 && $p1_2 < 8){
                                                    $icon = "neutro.png";
                                                }elseif($p1_2 > 0 && $p1_2 <= 6){
                                                    $icon = "bad.png";
                                                }else{
                                                    $icon = "neutro.png";
                                                }
                                                ?>
                                            <tr>
                                                <td class="border-top-0 px-2 py-4">
                                                    <div class="d-flex no-block align-items-center">
                                                        <div class="mr-3"><img
                                                                src="assets/images/<?php echo $icon; ?>"
                                                                alt="user" class="rounded-circle" width="45"
                                                                height="45" /></div>
                                                        <div class="">
                                                            <h5 class="text-dark mb-0 font-16 font-weight-medium">
                                                                <?php echo $data2['CliPrimerNombre']." ".$data2['CliApellidoPaterno']; ?>
                                                            </h5>
                                                            <span class="text-muted font-14"><?php echo $data2['CliEmail']; ?></span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="border-top-0 text-muted px-2 py-4 font-14">Elite Admin</td>
                                                <td class="border-top-0 px-2 py-4">
                                                    <div class="popover-icon">
                                                        <a class="btn btn-primary rounded-circle btn-circle font-12"
                                                            href="javascript:void(0)">DS</a>
                                                        <a class="btn btn-danger rounded-circle btn-circle font-12 popover-item"
                                                            href="javascript:void(0)">SS</a>
                                                        <a class="btn btn-cyan rounded-circle btn-circle font-12 popover-item"
                                                            href="javascript:void(0)">RP</a>
                                                        <a class="btn btn-success text-white rounded-circle btn-circle font-20"
                                                            href="javascript:void(0)">+</a>
                                                    </div>
                                                </td>
                                                <td class="border-top-0 text-center px-2 py-4"><i
                                                        class="fa fa-circle text-primary font-12" data-toggle="tooltip"
                                                        data-placement="top" title="In Testing"></i></td>
                                                <td
                                                    class="border-top-0 text-center font-weight-medium text-muted px-2 py-4">
                                                    35
                                                </td>
                                                <td class="font-weight-medium text-dark border-top-0 px-2 py-4">$96K
                                                </td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- *************************************************************** -->
                <!-- End Top Leader Table -->
                <!-- *************************************************************** -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <footer class="footer text-center text-muted">
                All Rights Reserved by Adminmart. Designed and Developed by <a
                    href="https://wrappixel.com">WrapPixel</a>.
            </footer>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
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
    <script src="dist/js/pages/dashboards/dashboard1.js"></script>
    <!--Morris JavaScript -->
    <script src="assets/libs/raphael/raphael.min.js"></script>
    <script src="assets/libs/morris.js/morris.min.js"></script>
    <script src="dist/js/pages/morris/morris-data.js"></script>

</body>

</html>