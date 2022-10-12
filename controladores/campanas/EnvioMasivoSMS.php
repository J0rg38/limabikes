<?php
   include('../../config/conexion.php');
   $cmpid = $_POST['cmpid'];

   $ConsultaGrupo = "
      SELECT
      campanas.CmpId,
      campanas.GrpId,
      grupoclientes.GrpEstado,
      asig_grpcli.GrpCliId,
      asig_grpcli.CliId,
      clientes.CliNumeroDocumento,
      clientes.CliPrimerNombre,
      clientes.CliSegundoNombre,
      clientes.CliApellidoPaterno,
      clientes.CliApellidoMaterno,
      clientes.CliCelular,
      clientes.CliEmail,
      asig_cmpenc.CmpEncUrl
      FROM
      asig_grpcli
      JOIN clientes
      ON asig_grpcli.CliId = clientes.CliId 
      JOIN asig_cmpenc
      ON asig_grpcli.CliId = asig_cmpenc.CliId,
      campanas,
      grupoclientes
      WHERE
      campanas.CmpId = '".$cmpid."'
   ";
   $ResultadoGrupo = mysqli_query($conexion,$ConsultaGrupo);
   while($dataGrupo = mysqli_fetch_array($ResultadoGrupo)){

      $ConsultaEnvioSMS = "
         SELECT * FROM asig_cmpcli WHERE CliId = '".$dataGrupo['CliId']."'
      ";

      $NumConsultaEnvioSMS = mysqli_num_rows(mysqli_query($conexion,$ConsultaEnvioSMS));

      if($NumConsultaEnvioSMS > 0){

      }elseif($NumConsultaEnvioSMS == 0){

         //Ejemplo PHP.  Para verificar libreria CURL use phpinfo()
         $texto = 'Hola '.$dataGrupo['CliPrimerNombre'].', te enviamos la siguiente encuesta: http://192.168.100.190/admin/viewencuesta.php?tk='.$dataGrupo['CmpEncUrl'];
             
         $apikey = "776946DA9B8E";
         $apicard = "7272456583";
         $fields_string = "";
         $smsnumber = $dataGrupo['CliCelular'];
         $smstext = $texto;
         $smstype = "0"; // 0: remitente largo, 1: remitente corto
         $shorturl = "0"; // acortador URL

         //Preparamos las variables que queremos enviar
         $url = 'http://api2.gamanet.pe/smssend'; // Para HTTPS $url = 'https://api3.gamanet.pe/smssend'; 
         $fields = array(
                                 'apicard'=>urlencode($apicard),
                                 'apikey'=>urlencode($apikey),
                                 'smsnumber'=>urlencode($smsnumber),
                                 'smstext'=>urlencode($smstext),
                                 'smstype'=>urlencode($smstype),
                                 'shorturl'=>urlencode($shorturl)
                         );

         //Preparamos el string para hacer POST (formato querystring)
         foreach($fields as $key=>$value) { 
                $fields_string .= $key.'='.$value.'&'; 
         }
         $fields_string = rtrim($fields_string,'&');


         //abrimos la conexion
         $ch = curl_init();

         //configuramos la URL, numero de variables POST y los datos POST
         curl_setopt($ch,CURLOPT_URL,$url);
         //curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false); //Descomentarlo si usa HTTPS
         curl_setopt($ch,CURLOPT_POST,count($fields));
         curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
         curl_setopt($ch,CURLOPT_POSTFIELDS,$fields_string);

         //ejecutamos POST
         $result = curl_exec($ch);

         if($result===false){
            echo 'Curl error: '.curl_error($ch);
            exit();
         }

         //cerramos la conexion
         curl_close($ch);

         //Resultado
         $array = json_decode($result,true);

         if($array["message"] == '0'){
            $sql_insert = "INSERT INTO asig_cmpcli (CmpId,GrpId,CliId,CmpCliFechaEnvio) VALUES (
                  '".$dataGrupo['CmpId']."',
                  '".$dataGrupo['GrpId']."',
                  '".$dataGrupo['CliId']."',
                  '".$FechaActual."'
               )
            ";
            mysqli_query($conexion,$sql_insert);
         }else{

         }

      }else{}

      // echo $array["message"];

   }
          
?>