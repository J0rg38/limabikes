<?php
    include('config/conexion.php');

    $ConsultaClientes = "
        SELECT * FROM clientes
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
                                <button class="btn btn-success" data-toggle="modal" data-target="#AgregarClienteModal">Agregar <i data-feather="plus" class="feather-icon"></i></button>
                                <button class="btn" data-toggle="modal" data-target="#SubirExcel" style="background-color: #05810B; border-color: #05810B; color: #fff">Subir Excel<i data-feather="upload" class="feather-icon"></i></button>
                                <button onclick="ObtenerExcel();" class="btn" style="background-color: #14479B; border-color: #14479B; color: #fff">Descargar <i data-feather="download" class="feather-icon"></i></button>
                                <button class="btn" onclick="CargarTablaClientes();" style="background-color: #26BCC8; border-color: #26BCC8; color: #fff"><i data-feather="refresh-cw" class="feather-icon"></i></button>

                                <!-- agregar cliente modal content -->
                                <div id="AgregarClienteModal" class="modal fade" tabindex="-1" role="dialog"
                                    aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myModalLabel">Agregar Cliente</h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-hidden="true">×</button>
                                            </div>
                                            <div class="modal-body">

                                                <div class="row">
                                                    <div class="col-6">
                                                        <label class="">Tipo de Doc.</label>
                                                        <select class="form-control" id="tipodoc">
                                                            <?php 
                                                                $consultaTipoDocumentos = "SELECT * FROM tipodocumento WHERE TdoEstado = '1'";

                                                                $resultadoTipoDocumentos = mysqli_query($conexion,$consultaTipoDocumentos);

                                                                while($dataTipoDocumentos = mysqli_fetch_array($resultadoTipoDocumentos)){
                                                            ?>
                                                                <option value="<?php echo $dataTipoDocumentos['TdoId']; ?>"><?php echo $dataTipoDocumentos['TdoNombre']; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                    <div class="col-6">
                                                        <label class="">Numero de Doc.</label>
                                                        <input type="" name="" id="numerodoc" class="form-control">
                                                    </div>

                                                    <div class="col-6">
                                                        <label class="">Nombres</label>
                                                        <input type="text" name="" id="nombres" class="form-control">
                                                    </div>
                                                    <div class="col-6">
                                                        <label class="">Apellidos</label>
                                                        <input type="text" name="" id="apellidos" class="form-control">
                                                    </div>
                                                    <div class="col-12">
                                                        <small>Los nombres y apellidos deben ir separados por un espacio obligatoriamente</small>
                                                    </div>
                                                    <div class="col-6">
                                                        <label class="">Celular</label>
                                                        <input type="number" name="" id="celular" class="form-control">
                                                    </div>
                                                    <div class="col-6">
                                                        <label class="">Email</label>
                                                        <input type="email" name="" id="email" class="form-control">
                                                    </div>
                                                </div>
                                                

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light"
                                                    data-dismiss="modal">Cerrar</button>
                                                <button type="button" class="btn btn-success" data-dismiss="modal" onclick="GuardarCliente();">Guardar</button>
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
                                                <h4 class="modal-title" id="myModalLabel">Subir Excel de Clientes</h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-hidden="true">×</button>
                                            </div>

                                            <form method="post" enctype="multipart/form-data" id="formexcel">
                                                <div class="modal-body">
                                                    
                                                    <input type="file" name="excelclientes" id="excelclientes" class="form-control">
                                                    <p style="margin-top: 10px;">Descargar archivo de plantilla <a href="Template_Clientes.xlsx" download="Template_Clientes.xlsx">Aquí 👈🏼</a></p>

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
                                    function GuardarCliente(){
                                        var tipodoc = $('#tipodoc').val();
                                        var numerodoc = $('#numerodoc').val();
                                        var nombres = $('#nombres').val();
                                        var apellidos = $('#apellidos').val();
                                        var celular = $('#celular').val();
                                        var email = $('#email').val();

                                        $.ajax({
                                        url: 'controladores/clientes/AgregarCliente.php',
                                        type: 'POST',
                                        data: {
                                            "tipodoc":tipodoc,
                                            "numerodoc":numerodoc,
                                            "nombres":nombres,
                                            "apellidos":apellidos,
                                            "celular":celular,
                                            "email":email
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
                                                CargarTablaClientes()
                                                alerta('success','Cool!!!')
                                                document.getElementById("numerodoc").value = "";
                                                document.getElementById("nombres").value = "";
                                                document.getElementById("apellidos").value = "";
                                                document.getElementById("celular").value = "";
                                                document.getElementById("email").value = "";
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
                                                <th>Nombres</th>
                                                <th>Apellidos</th>
                                                <th>Documento</th>
                                                <th>Contacto</th>
                                                <th>Estado</th>
                                                <th>Aciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $ResultadoClientes = mysqli_query($conexion,$ConsultaClientes);
                                                while($dataClientes = mysqli_fetch_array($ResultadoClientes)){
                                            ?>
                                            <tr>
                                                <td><?php echo $dataClientes['CliPrimerNombre']." ".$dataClientes['CliSegundoNombre']; ?></td>
                                                <td><?php echo $dataClientes['CliApellidoPaterno']." ".$dataClientes['CliApellidoMaterno']; ?></td>
                                                <td><?php echo $dataClientes['CliNumeroDocumento']; ?></td>
                                                <td><?php echo $dataClientes['CliCelular']; ?></td>
                                                <td>
                                                    <?php if($dataClientes['CliEstado'] == '1'){$checked = 'checked';}elseif($dataClientes['CliEstado'] == '2'){$checked = '';} ?>
                                                    <input type="checkbox" id="toggle" onchange="CambiarEstadoCliente('<?php echo $dataClientes['CliId']; ?>');" <?php echo $checked; ?>>
                                                </td>
                                                <td>
                                                    <a >
                                                        <i style="color: #7c8798" class="icon-eye"></i>
                                                    </a> 

                                                    <a data-toggle="modal" data-target="#EditarClienteModal" onclick="EditarCliente('<?php echo $dataClientes['CliId']; ?>');">
                                                        <i style="color: #7c8798" class="icon-pencil"></i>
                                                    </a>

                                                    <a onclick="EliminarCliente('<?php echo $dataClientes['CliId']; ?>');">
                                                        <i style="color: #7c8798" class="icon-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Nombres</th>
                                                <th>Apellidos</th>
                                                <th>Documento</th>
                                                <th>Contacto</th>
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

    <!-- sample modal content -->
    <div id="EditarClienteModal" class="modal fade" tabindex="-1" role="dialog"
        aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Editar Cliente</h4>
                    <button type="button" class="close" data-dismiss="modal"
                        aria-hidden="true">×</button>
                </div>
                <div class="modal-body" id="modaleditar">

                    <!-- AQUI VA EL CONTENIDO DEL EDITAR MODAL -->
                    

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light"
                        data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-success" data-dismiss="modal" onclick="GuardarEdicionCliente();">Guardar</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <script type="text/javascript">
        function CambiarEstadoCliente(idcliente){
            $.ajax({
                url: 'controladores/clientes/CambiarEstadoCliente.php',
                type: 'POST',
                data: {
                    "idcliente":idcliente
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

        function EditarCliente(idcliente){
            $.ajax({
                url: 'controladores/clientes/VistaEditarCliente.php',
                type: 'POST',
                data: {
                    "idcliente":idcliente
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
                    $('#modaleditar').html(res) 
                })
                .fail(function(){
                console.log("error");
                })
                .always(function(){
                console.log("complete");
                
            });
        }

        function GuardarEdicionCliente(){
            var idcliente = $('#idclienteedit').val();
            var tipodoc = $('#tipodocedit').val();
            var numerodoc = $('#numerodocedit').val();
            var nombres = $('#nombresedit').val();
            var apellidos = $('#apellidosedit').val();
            var celular = $('#celularedit').val();
            var email = $('#emailedit').val();

            $.ajax({
            url: 'controladores/clientes/EditarCliente.php',
            type: 'POST',
            data: {
                "idcliente":idcliente,
                "tipodoc":tipodoc,
                "numerodoc":numerodoc,
                "nombres":nombres,
                "apellidos":apellidos,
                "celular":celular,
                "email":email
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
                    CargarTablaClientes()
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

        function EliminarCliente(idcliente){
            $.ajax({
                url: 'controladores/clientes/EliminarCliente.php',
                type: 'POST',
                data: {
                    "idcliente":idcliente
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
                        CargarTablaClientes()
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

        function CargarTablaClientes(){
            $.ajax({
                url: 'controladores/clientes/TablaCliente.php',
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
                    url: "controladores/clientes/SubirClientesMasivo.php",
                    type: "post",
                    dataType: "html",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false
                })
                    .done(function(res){
                        CargarTablaClientes();
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
    <!--This page plugins -->
    <script src="assets/extra-libs/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="dist/js/pages/datatable/datatable-basic.init.js"></script>
    
</body>

</html>