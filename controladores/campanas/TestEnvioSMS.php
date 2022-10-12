<?php 
   $celular = $_POST['pruebacelular'];
   $texto = $_POST['pruebatexto'];
   //Ejemplo PHP.  Para verificar libreria CURL use phpinfo()
       
   $apikey = "776946DA9B8E";
   $apicard = "7272456583";
   $fields_string = "";
   $smsnumber = $celular;
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

   echo $array["message"];      
          
          
?>