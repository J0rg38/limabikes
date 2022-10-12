<?php 
    include('../../config/conexion.php');

    $sql_options = "SELECT * FROM grupoclientes WHERE GrpEstado = '1'";
    $resultado_sql = mysqli_query($conexion,$sql_options);
    while($data_options = mysqli_fetch_array($resultado_sql)){
?>
    <option value="<?php echo $data_options['GrpId']; ?>"><?php echo $data_options['GrpNombre']; ?></option>
<?php } ?>