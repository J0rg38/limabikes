<?php
    include('../../config/conexion.php');

    $ConsultaGrupoClientes = "
        SELECT * FROM grupoclientes
    ";
?>

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

                <a href="#" onclick="EliminarGrupo('<?php echo $dataGrupoClientes['GrpId']; ?>');">
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

<!--This page plugins -->
<script src="assets/extra-libs/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="dist/js/pages/datatable/datatable-basic.init.js"></script>