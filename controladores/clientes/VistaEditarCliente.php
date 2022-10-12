<?php
    include('../../config/conexion.php');
    $idcliente = $_POST['idcliente'];

    $ConsultaClientes = "
        SELECT * FROM clientes WHERE CliId = '".$idcliente."'
    ";

    $Resultado = mysqli_query($conexion,$ConsultaClientes);

    while($data = mysqli_fetch_array($Resultado)){
?>

<div class="row">
    <input type="hidden" name="" id="idclienteedit" value="<?php echo $idcliente; ?>">
    <div class="col-6">
        <label class="">Tipo de Doc.</label>
        <select class="form-control" id="tipodocedit">
            <?php 
                $consultaTipoDocumentos = "SELECT * FROM tipodocumento WHERE TdoEstado = '1'";
                $selected = "";
                $resultadoTipoDocumentos = mysqli_query($conexion,$consultaTipoDocumentos);

                while($dataTipoDocumentos = mysqli_fetch_array($resultadoTipoDocumentos)){
                    if($data['TdoId'] == $dataTipoDocumentos['TdoId']){
                        $selected = "selected";
                    }else{
                        $selected = "";
                    }
            ?>
                <option value="<?php echo $dataTipoDocumentos['TdoId']; ?>" <?php echo $selected; ?>><?php echo $dataTipoDocumentos['TdoNombre']; ?></option>
            <?php } ?>
        </select>
    </div>
    <div class="col-6">
        <label class="">Numero de Doc.</label>
        <input type="" name="" id="numerodocedit" class="form-control" value="<?php echo $data['CliNumeroDocumento']; ?>">
    </div>

    <div class="col-6">
        <label class="">Nombres</label>
        <input type="text" name="" id="nombresedit" class="form-control" value="<?php echo $data['CliPrimerNombre']." ".$data['CliSegundoNombre']; ?>">
    </div>
    <div class="col-6">
        <label class="">Apellidos</label>
        <input type="text" name="" id="apellidosedit" class="form-control" value="<?php echo $data['CliApellidoPaterno']." ".$data['CliApellidoMaterno']; ?>">
    </div>
    <div class="col-12">
        <small>Los nombres y apellidos deben ir separados por un espacio obligatoriamente</small>
    </div>
    <div class="col-6">
        <label class="">Celular</label>
        <input type="number" name="" id="celularedit" class="form-control" value="<?php echo $data['CliCelular']; ?>">
    </div>
    <div class="col-6">
        <label class="">Email</label>
        <input type="email" name="" id="emailedit" class="form-control" value="<?php echo $data['CliEmail']; ?>">
    </div>
</div>

<?php } ?>