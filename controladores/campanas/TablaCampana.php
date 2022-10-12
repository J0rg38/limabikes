<?php
    include('../../config/conexion.php');

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
                ?>
                <p style="color:#0679BB; margin-bottom: 0;">Enviadas: <?php echo $NumEnviados; ?>/<?php echo $NumMiembros; ?></p>
                <p style="color:#17C284; margin-bottom: 0;">Respondidas: 0/<?php echo $NumMiembros; ?></p>
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

<script src="assets/extra-libs/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="dist/js/pages/datatable/datatable-basic.init.js"></script>