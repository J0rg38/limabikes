<?php
    include('../../config/conexion.php');

    $ConsultaClientes = "
        SELECT * FROM clientes
    ";
?>

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
                <a>
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

<!--This page plugins -->
<script src="assets/extra-libs/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="dist/js/pages/datatable/datatable-basic.init.js"></script>