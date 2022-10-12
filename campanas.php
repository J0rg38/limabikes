<?php
    include('config/conexion.php');

    $ConsultaCampanas = "
        SELECT
        campanas.CmpId,
        campanas.CmpNombre,
        campanas.CmpFechaEnvio,
        campanas.GrpId,
        campanas.CmpEstadoEnvio,
        grupoclientes.GrpNombre,
        campanas.CmpEstado
        FROM
        campanas
        JOIN grupoclientes
        ON campanas.GrpId = grupoclientes.GrpId
        WHERE
        campanas.CmpEstado = '1'
    ";
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

    <!-- This page plugin CSS -->
    <link href="assets/extra-libs/datatables.net-bs4/css/dataTables.bootstrap4.css" rel="stylesheet">

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

    <style type="text/css">
        .mt-5-percent{
            margin-top: 5%;
        }
    </style>
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
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <button class="btn btn-success" data-toggle="modal" data-target="#AgregarClienteModal">Crear <i data-feather="plus" class="feather-icon"></i></button>
                                <button class="btn" onclick="CargarTablaCampanas();" style="background-color: #26BCC8; border-color: #26BCC8; color: #fff"><i data-feather="refresh-cw" class="feather-icon"></i></button>

                                <button class="btn" data-toggle="modal" data-target="#EnviarSMSModal" style="background-color: #000; border-color: #000; color: #fff">SMS <i data-feather="message-square" class="feather-icon"></i></button>

                                <!-- agregar cliente modal content -->
                                <div id="AgregarClienteModal" class="modal fade" tabindex="-1" role="dialog"
                                    aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myModalLabel">Crear Campana</h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-hidden="true">×</button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <label>Nombre de Campana</label>
                                                        <input type="text" name="" id="nombrecampana" class="form-control">
                                                    </div>
                                                    <div class="col-6 mt-5-percent">
                                                        <label>Grupo de Clientes</label>
                                                        <select class="form-control" name="grpid" id="grpid">
                                                            <?php 
                                                                $sql_options = "SELECT * FROM grupoclientes WHERE GrpEstado = '1'";
                                                                $resultado_sql = mysqli_query($conexion,$sql_options);
                                                                while($data_options = mysqli_fetch_array($resultado_sql)){
                                                            ?>
                                                                <option value="<?php echo $data_options['GrpId']; ?>"><?php echo $data_options['GrpNombre']; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                    <div class="col-6 mt-5-percent">
                                                        <label>Encuesta</label>
                                                        <select class="form-control" name="encid" id="encid">
                                                            <?php 
                                                                $sql_options2 = "SELECT * FROM encuestas WHERE EncEstado = '1'";
                                                                $resultado_sql2 = mysqli_query($conexion,$sql_options2);
                                                                while($data_options2 = mysqli_fetch_array($resultado_sql2)){
                                                            ?>
                                                                <option value="<?php echo $data_options2['EncId']; ?>"><?php echo $data_options2['EncNombre']; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                    <div class="col-6 mt-5-percent">
                                                        <label>Fecha y Hora de Envio</label>
                                                        <input type="datetime-local" name="" id="fechaenvio" class="form-control">
                                                    </div>
                                                    <div class="col-6 mt-5-percent">
                                                        <small>* La fecha y hora de envio estan programadas en horario local y una vez enviadas no se podra cancelar hasta su cambio de estado.</small>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light"
                                                    data-dismiss="modal">Cerrar</button>
                                                <button type="button" class="btn btn-success" data-dismiss="modal" onclick="GuardarCampana();">Guardar</button>
                                            </div>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div><!-- /.modal -->

                                <!-- enviar SMS modal content -->
                                <div id="EnviarSMSModal" class="modal fade" tabindex="-1" role="dialog"
                                    aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myModalLabel">Enviar SMS de Prueba</h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-hidden="true">×</button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <label>Numero de Celular</label>
                                                        <input type="number" class="form-control" name="" id="pruebacelular">
                                                    </div>
                                                    <div class="col-12">
                                                        <label>Texto SMS</label>
                                                        <textarea class="form-control" id="pruebatexto"></textarea>
                                                        <small>* Maximo 160 caracteres</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light"
                                                    data-dismiss="modal">Cerrar</button>
                                                <button type="button" class="btn btn-success" data-dismiss="modal" onclick="EnviarSMS();">Enviar</button>
                                            </div>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div><!-- /.modal -->

                                <script>
                                    function GuardarCampana(){
                                        var nombrecampana = $('#nombrecampana').val();
                                        var grpid = $('#grpid').val();
                                        var encid = $('#encid').val();
                                        var fechaenvio = $('#fechaenvio').val();

                                        $.ajax({
                                        url: 'controladores/campanas/AgregarCampana.php',
                                        type: 'POST',
                                        data: {
                                            "nombrecampana":nombrecampana,
                                            "grpid":grpid,
                                            "encid":encid,
                                            "fechaenvio":fechaenvio
                                        },
                                        beforeSend: function(){
                                            // $('#contenido').css("display", "none");
                                            // $('#loader').css("display", "block");
                                        }
                                        })
                                        .done(function(res){
                                            // $('#contenido').css("display", "block");
                                            // $('#contenido').html(res)
                                            // $('#loader').css("display", "none")
                                            if(res == 'ok'){
                                                CargarTablaCampanas()
                                                alerta('success','Cool!!!')
                                                document.getElementById("nombrecampana").value = "";
                                                document.getElementById("fechaenvio").value = "";
                                            }else{
                                                alerta('error','Hoo Noo!!!')
                                            }
                                        })
                                        .fail(function(){
                                        console.log("error");
                                        })
                                        .always(function(){
                                        console.log("complete");
                                        
                                        });
                                    }

                                    function EnviarSMS(){
                                        var pruebacelular = $('#pruebacelular').val();
                                        var pruebatexto = $('#pruebatexto').val();
                                        
                                        $.ajax({
                                        url: 'controladores/campanas/TestEnvioSMS.php',
                                        type: 'POST',
                                        data: {
                                            "pruebacelular":pruebacelular,
                                            "pruebatexto":pruebatexto
                                        },
                                        beforeSend: function(){
                                            // $('#contenido').css("display", "none");
                                            // $('#loader').css("display", "block");
                                        }
                                        })
                                        .done(function(res){
                                            // $('#contenido').css("display", "block");
                                            // $('#contenido').html(res)
                                            // $('#loader').css("display", "none")
                                            if(res == '0'){
                                                alerta('success','Mensaje enviado correctamente')
                                                document.getElementById("pruebacelular").value = "";
                                                document.getElementById("pruebatexto").value = "";
                                            }else{
                                                alerta('error','Algo no salio bien')
                                            }
                                        })
                                        .fail(function(){
                                        console.log("error");
                                        })
                                        .always(function(){
                                        console.log("complete");
                                        
                                        });
                                    }

                                </script>


                            </div>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                
                                <div class="table-responsive" id="contenedortabla">
                                    <table id="zero_config" class="table table-striped table-bordered no-wrap">
                                        <thead>
                                            <tr>
                                                <th>Nombre</th>
                                                <th>Grupo de Clientes</th>
                                                <th>Fecha de Envío</th>
                                                <th>Estado de Envio</th>
                                                <th>Estado de Encuestas</th>
                                                <th>Aciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $ResultadoCampanas = mysqli_query($conexion,$ConsultaCampanas);
                                                while($dataCampanas = mysqli_fetch_array($ResultadoCampanas)){
                                            ?>
                                            <tr>
                                                <td><?php echo $dataCampanas['CmpNombre']; ?></td>
                                                <td><?php echo $dataCampanas['GrpNombre']; ?></td>
                                                <td><?php echo $dataCampanas['CmpFechaEnvio']; ?></td>
                                                <td>
                                                    <?php 
                                                        if($dataCampanas['CmpEstadoEnvio']=='0'){
                                                            echo "Pendiente";
                                                        }elseif($dataCampanas['CmpEstadoEnvio']=='1'){
                                                            echo "Enviado";
                                                        }elseif($dataCampanas['CmpEstadoEnvio']=='2'){
                                                            echo "Cancelado";
                                                        }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php 
                                                        $ConsultaNumMiembros = "SELECT GrpCliId FROM asig_grpcli WHERE GrpId = '".$dataCampanas['GrpId']."'";
                                                        $NumMiembros = mysqli_num_rows(mysqli_query($conexion,$ConsultaNumMiembros));

                                                        $ConsultaNumEnviados = "SELECT CmpCliId FROM asig_cmpcli WHERE CmpId='".$dataCampanas['CmpId']."'";
                                                        $NumEnviados = mysqli_num_rows(mysqli_query($conexion,$ConsultaNumEnviados));

                                                        $ConsultaNumRespondidos = "SELECT CmpEncId FROM  asig_cmpenc WHERE CmpId='".$dataCampanas['CmpId']."' AND CmpEncContestado='1'";
                                                        $NumRespondidos = mysqli_num_rows(mysqli_query($conexion,$ConsultaNumRespondidos));
                                                    ?>
                                                    <p style="color:#0679BB; margin-bottom: 0;">Enviadas: <?php echo $NumEnviados; ?>/<?php echo $NumMiembros; ?></p>
                                                    <p style="color:#17C284; margin-bottom: 0;">Respondidas: <?php echo $NumRespondidos; ?>/<?php echo $NumMiembros; ?></p>
                                                </td>
                                                <td>
                                                    <a href="">
                                                        <i style="color: #7c8798" class="icon-eye"></i>
                                                    </a> 

                                                    <a href="">
                                                        <i style="color: #7c8798" class="icon-pencil"></i>
                                                    </a>

                                                    <a >
                                                        <i style="color: #7c8798" class="icon-reload" data-toggle="modal" data-target="#PreguntaForzarEnvio<?php echo $dataCampanas['CmpId']; ?>"></i>
                                                    </a>

                                                    <!-- enviar SMS modal content -->
                                                    <div id="PreguntaForzarEnvio<?php echo $dataCampanas['CmpId']; ?>" class="modal fade" tabindex="-1" role="dialog"
                                                        aria-labelledby="myModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title" id="myModalLabel">Forzar envio de Campana</h4>
                                                                    <button type="button" class="close" data-dismiss="modal"
                                                                        aria-hidden="true">×</button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="row">
                                                                        <div class="col-12">
                                                                            <label>Escribir la palabra "enviar" para continuar</label>
                                                                            <input type="text" name="" id="textenviar" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-light"
                                                                        data-dismiss="modal">No</button>
                                                                    <button type="button" class="btn btn-success" data-dismiss="modal" onclick="EnviarMasivoSMS('<?php echo $dataCampanas['CmpId']; ?>');">Enviar</button>
                                                                </div>
                                                            </div><!-- /.modal-content -->
                                                        </div><!-- /.modal-dialog -->
                                                    </div><!-- /.modal -->

                                                    <!--<a href="">
                                                        <i style="color: #7c8798" class="icon-trash"></i>
                                                    </a>-->
                                                </td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Nombre</th>
                                                <th>Grupo de Clientes</th>
                                                <th>Fecha de Envío</th>
                                                <th>Estado de Envio</th>
                                                <th>Estado de Encuestas</th>
                                                <th>Aciones</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <script type="text/javascript">
                    function EnviarMasivoSMS(cmpid){
                        $.ajax({
                            url: 'controladores/campanas/EnvioMasivoSMS.php',
                            type: 'POST',
                            data: {
                                "cmpid":cmpid
                            },
                            beforeSend: function(){
                                alerta('info','Se procesara la informacion, vuelve en un momento!')
                                // $('#contenido').css("display", "none");
                                // $('#loader').css("display", "block");
                            }
                            })
                            .done(function(res){
                                // $('#contenido').css("display", "block");
                                // $('#loader').css("display", "none")
                                // $('#contenedortabla').html(res)   
             
                            })
                            .fail(function(){
                                alerta('error','Hoo Noo!!!')
                            })
                            .always(function(){
                            console.log("complete");
                            
                        });
                    }

                    function CargarTablaCampanas(){
                        $.ajax({
                            url: 'controladores/campanas/TablaCampana.php',
                            type: 'POST',
                            data: {
                                
                            },
                            beforeSend: function(){
                                alerta('info','Cargando la info!!!')
                                // $('#contenido').css("display", "none");
                                // $('#loader').css("display", "block");
                            }
                            })
                            .done(function(res){
                                // $('#contenido').css("display", "block");
                                // $('#loader').css("display", "none")
                                $('#contenedortabla').html(res)   
             
                            })
                            .fail(function(){
                                alerta('error','Hoo Noo!!!')
                            })
                            .always(function(){
                            console.log("complete");
                            
                        });
                    }


                    function alerta(tipo,message){
                       const Toast = Swal.mixin({
                          toast: true,
                          position: 'top-end',
                          showConfirmButton: false,
                          timer: 3000,
                          timerProgressBar: true,
                          didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                          }
                        })

                        Toast.fire({
                          icon: tipo,
                          title: message
                        })
                    }
                </script>
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
    <!--AJAX -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
    <!--This page plugins -->
    <script src="assets/extra-libs/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="dist/js/pages/datatable/datatable-basic.init.js"></script>
</body>

</html>