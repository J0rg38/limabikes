<?php
    include('config/conexion.php');

    $ConsultaGrupoClientes = "
        SELECT * FROM grupoclientes
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
        :root {
          --body: #fafafa;
          --text-default: #1d1d1f;
          --text-secondary: #86868b;
        }
        @media (prefers-color-scheme: light) {
          :root {
            --body: #fafafa;
            --text-default: #1d1d1f;
          }
        }
        @media (prefers-color-scheme: dark) {
          :root {
            --body: #161616;
            --text-default: #f5f5f7;
          }
        }
        /* Checkbox Styles */
        input[type="checkbox"] {
          -webkit-appearance: none;
          outline: none;
          position: absolute;
          height: 1.5rem;
          width: 3.5rem;
          border: 2px solid var(--secondary);
          border-radius: 2.5rem;
          cursor: pointer;
          background: #AB1730;
          /*box-shadow: 9px 9px 16px rgba(189, 189, 189, 0.6), -9px -9px 16px rgba(255, 255, 255, 0), inset 10px 10px 15px -10px #AB1730, inset -10px -10px 15px -10px #AB1730;*/
          /* Toggle Indicator */
          /* Label */
          /* Checked Styles */
        }
        /*@media (prefers-color-scheme: light) {
          input[type="checkbox"] {
            box-shadow: 9px 9px 16px rgba(189, 189, 189, 0.6), -9px -9px 16px rgba(255, 255, 255, 0), inset 10px 10px 15px -10px #AB1730, inset -10px -10px 15px -10px #AB1730;
          }
        }
        @media (prefers-color-scheme: dark) {
          input[type="checkbox"] {
            box-shadow: -8px -4px 8px 0px rgba(255, 255, 255, 0.05), 8px 4px 12px 0px rgba(0, 0, 0, 0.5), inset -4px -4px 4px 0px rgba(255, 255, 255, 0.05), inset 4px 4px 4px 0px rgba(0, 0, 0, 0.5);
          }
        }*/
        input[type="checkbox"]::before {
          content: "";
          height: 1rem;
          width: 1rem;
          background-color: var(--body);
          position: absolute;
          margin: auto;
          top: 0;
          left: 0.2rem;
          bottom: 0;
          border-radius: 50%;
          /*box-shadow: 7px 7px 15px #AB1730, 9px 9px 16px rgba(189, 189, 189, 0);*/
          transition: 0.15s;
        }
        
        input[type="checkbox"]::after {
          content: "Off";
          position: absolute;
          font-size: 0.8rem;
          top: 0.1rem;
          right: 0.5rem;
          color: #fff;
          font-family: "SF Pro Text", "Helvetica Neue", "Helvetica", "Arial", sans-serif;
          font-weight: 400;
          letter-spacing: 0.004em;
        }
        input[type="checkbox"]:checked {
          background: #0AB507;
        }
        @media (prefers-color-scheme: light) {
          input[type="checkbox"]:checked {
            box-shadow: 9px 9px 16px rgba(189, 189, 189, 0), -9px -9px 16px rgba(255, 255, 255, 0), inset 10px 10px 15px -10px #0AB507, inset -10px -10px 15px -10px #0AB507;
          }
        }
        input[type="checkbox"]:checked::before {
          left: 2rem;
          box-shadow: none;
        }
        input[type="checkbox"]:checked::after {
          content: "On";
          left: 0.5rem;
          color: #f5f5f7;
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
                                <button class="btn btn-success" data-toggle="modal" data-target="#AgregarGrupoModal">Crear <i data-feather="plus" class="feather-icon"></i></button>
                                <button class="btn" data-toggle="modal" data-target="#SubirExcel" style="background-color: #05810B; border-color: #05810B; color: #fff">Subir Excel<i data-feather="upload" class="feather-icon"></i></button>
                                <button class="btn" onclick="CargarTablaGrupos();" style="background-color: #26BCC8; border-color: #26BCC8; color: #fff"><i data-feather="refresh-cw" class="feather-icon"></i></button>

                                <!-- agregar cliente modal content -->
                                <div id="AgregarGrupoModal" class="modal fade" tabindex="-1" role="dialog"
                                    aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myModalLabel">Agregar Grupo de Clientes</h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-hidden="true">×</button>
                                            </div>
                                            <div class="modal-body">

                                                <div class="row">
                                                    <div class="col-12">
                                                        <label class="">Nombre de Grupo</label>
                                                        <input type="" name="" id="nombregrupo" class="form-control">
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light"
                                                    data-dismiss="modal">Cerrar</button>
                                                <button type="button" class="btn btn-success" data-dismiss="modal" onclick="GuardarGrupoCliente();">Guardar</button>
                                            </div>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div><!-- /.modal -->

                                <!-- subir excel modal content -->
                                <div id="SubirExcel" class="modal fade" tabindex="-1" role="dialog"
                                    aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myModalLabel">Subir Excel Asignaciones a Grupos</h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-hidden="true">×</button>
                                            </div>

                                            <form method="post" enctype="multipart/form-data" id="formexcel">
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <label>Selecciona el grupo:</label>
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
                                                    </div><br>
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <input type="file" name="excelclientes" id="excelclientes" class="form-control">
                                                            <p style="margin-top: 10px;">Ojo, solo debes seleccionar el grupo al que se asignará y subiras el mismo modelo de plantilla de excel para clientes 👇🏼, solo debes editarlo en caso quieras seleccionar diferentes clientes.</p>
                                                        </div>
                                                        <div class="col-12" style="text-align: center;">
                                                            <button type="button" onclick="ObtenerExcel();" class="btn" style="background-color: #14479B; border-color: #14479B; color: #fff">Descargar Clientes<i data-feather="download" class="feather-icon"></i></button>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light"
                                                        data-dismiss="modal">Cerrar</button>
                                                    <button type="submit" class="btn btn-success">Procesar</button>
                                                </div>
                                            </form>

                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div><!-- /.modal -->


                                <script>
                                    function GuardarGrupoCliente(){
                                        var nombregrupo = $('#nombregrupo').val();

                                        $.ajax({
                                        url: 'controladores/grupoclientes/AgregarGrupos.php',
                                        type: 'POST',
                                        data: {
                                            "nombregrupo":nombregrupo,
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
                                                alerta('success','Cool!!!')
                                                document.getElementById("nombregrupo").value = "";
                                                CargarTablaGrupos();
                                                CargarSelectGrupos();
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

                                    function CargarSelectGrupos(){
                                        $.ajax({
                                        url: 'controladores/grupoclientes/CargarSelectGrupos.php',
                                        type: 'POST',
                                        data: {},
                                        beforeSend: function(){
                                            // $('#contenido').css("display", "none");
                                            // $('#loader').css("display", "block");
                                        }
                                        })
                                        .done(function(res){
                                            // $('#contenido').css("display", "block");
                                            $('#grpid').html(res)
                                            // $('#loader').css("display", "none")

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
                                                <th>Nombre de Grupo</th>
                                                <th>Id de Grupo</th>
                                                <th>Integrantes</th>
                                                <th>Estado</th>
                                                <th>Aciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $ResultadoGrupoClientes = mysqli_query($conexion,$ConsultaGrupoClientes);
                                                while($dataGrupoClientes = mysqli_fetch_array($ResultadoGrupoClientes)){
                                            ?>
                                            <tr>
                                                <td><?php echo $dataGrupoClientes['GrpNombre']; ?></td>
                                                <td><?php echo $dataGrupoClientes['GrpId']; ?></td>
                                                <td>
                                                    <?php 

                                                        $ConsultaIntegrantes = "
                                                            SELECT * FROM asig_grpcli WHERE GrpId = '".$dataGrupoClientes['GrpId']."'
                                                        ";

                                                        $ResultadoIntegrantes = mysqli_query($conexion,$ConsultaIntegrantes);
                                                        $NumeroIntegrantes = mysqli_num_rows($ResultadoIntegrantes);
                                                        echo $NumeroIntegrantes;

                                                    ?>   
                                                </td>
                                                <td>
                                                    <?php if($dataGrupoClientes['GrpEstado'] == '1'){$checked = 'checked';}elseif($dataGrupoClientes['GrpEstado'] == '2'){$checked = '';} ?>
                                                    <input type="checkbox" id="toggle" onchange="CambiarEstadoGrupo('<?php echo $dataGrupoClientes['GrpId']; ?>');" <?php echo $checked; ?>>
                                                </td>
                                                <td>
                                                    <a href="">
                                                        <i style="color: #7c8798" class="icon-eye"></i>
                                                    </a> 

                                                    <a onclick="EliminarGrupo('<?php echo $dataGrupoClientes['GrpId']; ?>');">
                                                        <i style="color: #7c8798" class="icon-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Nombre de Grupo</th>
                                                <th>Id de Grupo</th>
                                                <th>Integrantes</th>
                                                <th>Estado</th>
                                                <th>Aciones</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

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
    <script type="text/javascript">
        function CambiarEstadoGrupo(idgrupo){
            $.ajax({
                url: 'controladores/grupoclientes/CambiarEstadoGrupo.php',
                type: 'POST',
                data: {
                    "idgrupo":idgrupo
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
                        alerta('success','Cool!!!')
                        CargarSelectGrupos();
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

        function EliminarGrupo(idgrupo){
            $.ajax({
                url: 'controladores/grupoclientes/EliminarGrupo.php',
                type: 'POST',
                data: {
                    "idgrupo":idgrupo
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
                        CargarTablaGrupos()
                        CargarSelectGrupos();
                        alerta('success','Cool!!!')
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

        function CargarTablaGrupos(){
            $.ajax({
                url: 'controladores/grupoclientes/TablaGrupos.php',
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

    <script type="text/javascript">
        $(function(){
            $("#formexcel").on("submit", function(e){
                e.preventDefault();
                var f = $(this);
                var formData = new FormData(document.getElementById("formexcel"));
                formData.append("dato", "valor");
                //formData.append(f.attr("name"), $(this)[0].files[0]);
                $.ajax({
                    url: "controladores/grupoclientes/SubirGrupoMasivo.php",
                    type: "post",
                    dataType: "html",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false
                })
                    .done(function(res){
                        CargarTablaGrupos();
                        $('#SubirExcel').modal('hide')
                    });
            });
        });

        function ObtenerExcel(){
            $.ajax({url: 'controladores/clientes/GuardarReporteExcel.php', 
            type: 'POST', 
            cache: false,
            
            data: {
                variable1: 'HOLA MUNDO'

            }}).done(function(data) {
                const fileName = `Reporte_Clientes.xls`
                if (window.navigator.msSaveOrOpenBlob) {
                     window.navigator.msSaveBlob(res, fileName)
                } else {
                    const downloadLink = window.document.createElement('a')
                    downloadLink.href = window.URL.createObjectURL(new Blob([data]), { type: 'data:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' })
                    downloadLink.download = fileName
                    document.body.appendChild(downloadLink)
                    downloadLink.click()
                    document.body.removeChild(downloadLink)
                }
        });
        }
    </script>

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