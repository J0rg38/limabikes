<?php 
header('Content-type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=Movimientos.xls");
header("Pragma: no-cache");
header("Expires: 0");

include('../../config/conexion.php');

$sql = "
    SELECT * FROM clientes
";

$resultado = mysqli_query($conexion,$sql);
?> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table>
    <tbody>
        <tr>
            <th>Ide</th>
            <th>Tipo Documento</th>
            <th>Numero Documento</th>
            <th>Primer Nombre</th>
            <th>Segundo Nombre</th>
            <th>Apellido Paterno</th>
            <th>Apellido Materno</th>
            <th>Celular</th>
            <th>Email</th>
        </tr>

        <?php
        while($data = mysqli_fetch_array($resultado)){
        ?>
        <tr>
            <td><?php echo $data['CliId']; ?></td>
            <td><?php echo $data['TdoId']; ?></td>
            <td><?php echo $data['CliNumeroDocumento']; ?></td>
            <td><?php echo $data['CliPrimerNombre']; ?></td>
            <td><?php echo $data['CliSegundoNombre']; ?></td>
            <td><?php echo $data['CliApellidoPaterno']; ?></td>
            <td><?php echo $data['CliApellidoMaterno']; ?></td>
            <td><?php echo $data['CliCelular']; ?></td>
            <td><?php echo $data['CliEmail']; ?></td>
        </tr>
        <?php } ?>
    </tbody>
</table>