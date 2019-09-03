<?php 
	include("conexiones.php");
	include 'SabreDAV/lib/sabre/autoload.php';
	header('Content-Type: text/html; charset=UTF-8');

	$opc = $_POST['opc'];
	switch ($opc) {
		case 'llamarEmpleado':
			llamarEmpleado();
			break;
		case 'nomCampanas':
			nomCampanas();
			break;
		case 'nomFinGestion':
			nomFinGestion();
			break;
		case 'tablaCalidad':
			tablaCalidad();
			break;
		case 'verAudio':
			verAudio();
			break;	
		default:
			# code...
			break;
	}

	
	function llamarEmpleado(){
		//$jCentro 	= trim($_POST['centro']);
		$jEmpleado 	= trim($_POST['empleado']);

		$conexion = conectaBD_128_catalogoempleados();
		
		$sQuery = " SELECT true as estado, nombre||' '||apellidopaterno||' '||apellidomaterno as nombrecompleto, nombrejefe,centro from vw_catalogoempleados where empleado= '$jEmpleado' ";

		if($conexion){
			$rs = pg_query($sQuery);
			$array = pg_fetch_assoc($rs);
		}
		pg_close($conexion);
	    $salidaJSON = array('estado' => $array['estado'],
	    	'nombrecompleto' => utf8_encode($array['nombrecompleto']),
			'centro' => utf8_encode($array['centro']),
 	    	'nombrejefe' => utf8_encode($array['nombrejefe']));
	    print json_encode($salidaJSON);
	}


	function nomCampanas(){
    	$conn = conectaBD_128_catalogoempleados();
    	$response = false;
    	$dataTable = array();
    	$arrayTable = array();
        $id;
		
		
    	$sQuery="SELECT id_campana, campana FROM cat_campanas_consultamovs WHERE bandera = '1' ORDER BY 1";
    	$result = pg_query($conn,$sQuery);
    	while($array=pg_fetch_array($result)) {  
        	$response=true;
            $dataTable['id_campana'] = trim($array['id_campana']);
        	$dataTable['campana'] = utf8_decode(utf8_encode(trim($array['campana'])));
        	$arrayTable[] = array_map('utf8_encode', $dataTable);
    	}
	
    	pg_close($conn);
    	$salidaJSON = array('response' => $response , 'arrayTable' => $arrayTable  );
    	print json_encode($salidaJSON);
	}

	function nomFinGestion(){
		
		$id_campana=$_POST['id_campana'];

		
		switch ($id_campana) {
		case '1':
		    //cobranza coppel
			opcion1($id_campana);
			break;
		case '2':
		    //cobranza bancoppel
			opcion1($id_campana);
			break;
		case '3':
		    //cobranza argentina
			opcion1($id_campana);
			break;
		case '4':
		    //promocion coppel
			opcion1($id_campana);
			break;
		case '5':
		    //solicitudes banco
			opcion1($id_campana);
			break;
        case '6':
		    //solicitud de credito
			opcion1($id_campana);
			break;
		case '7':
		    //ventas
			opcion1($id_campana);
			break;
        case '8':
		    //atencion coppel
			opcion2($id_campana);
			break;
        case '9':
		    //atencion argentina
			opcion3($id_campana);
			break;
		case '10':
		    //atencion zuum
			opcion5($id_campana);
			break;
        case '11':
		    //atencion afore
			opcion4($id_campana);
			break;
        case '12':
		    //atencion soporte tecnico
			opcion6($id_campana);
			break;
        case '13':
		    //campanas unicas
			opcion4($id_campana);
			break;
        case '14':
		    //promocion bancoppel
			opcion4($id_campana);
			break;
			//promocion coppel argentina
        case '15':
            opcion4($id_campana);
            break;
			//atencion a clientes bancoppel
        case '16':
            opcion4($id_campana);
             break;			
			
			# code...
			break;
	}
		
	
	}
	
	     function opcion1($id_campana)
		{
			
	
	    $conn = conectaBD_128_catalogoempleados();
	    $response = false;
	    $dataTable = array();
	    $arrayTable = array();
	    $sQuery="SELECT descripcion FROM cat_fingestion_campanascat WHERE id_campana = $id_campana order by id_fingestion";
	    $result = pg_query($conn,$sQuery);
	    while($array=pg_fetch_array($result)) {  
	        $response=true;
	        //$dataTable['descripcion'] = utf8_decode(utf8_encode(trim($array['descripcion'])));
			$dataTable['descripcion'] = utf8_decode(utf8_encode(trim($array['descripcion'])));
	        $arrayTable[] = $dataTable;
	        // $arrayTable[] = array_map('utf8_encode', $dataTable);
	    }
	    pg_close($conn);
	    $salidaJSON = array('response' => $response,'arrayTable' => $arrayTable);
	    print json_encode($salidaJSON);
		
		
		}
		
		function opcion2($id_campana){

		$conn = conectaBD_128_atencion();
	    $response = false;
	    $dataTable = array();
	    $arrayTable = array();
	   //$sQuery="SELECT distinct translate (finllamada,'áéíóúÁÉÍÓÚäëïöüÄËÏÖÜ','aeiouAEIOUaeiouAEIOU') as fines FROM movimientos_monitoreo_atencion_201905 ";
	    
		$sQuery = "SELECT id,descripcion  FROM  cat_finesgestion_atencion order by 1";
		
		$result = pg_query($conn,$sQuery);
	    while($array=pg_fetch_array($result)) {  
	        $response=true;
		    $dataTable['value'] = trim($array['id']);
	        $dataTable['descripcion'] =  utf8_encode(trim($array['descripcion']));
			//$dataTable['descripcion'] =  utf8_encode(trim($array['fines']));
	        $arrayTable[] = $dataTable;
	        // $arrayTable[] = array_map('utf8_encode', $dataTable);

	    }
	    pg_close($conn);
	    $salidaJSON = array('atencion_coppel' => $response,'arrayTable' => $arrayTable);
	    print json_encode($salidaJSON);
			
			
			
		}
		
		function opcion3($id_campana){
			
		$conn = conectaBD_128_atencionar();
		$response = false;
	    $dataTable = array();
	    $arrayTable = array();
	    //$sQuery="SELECT distinct translate (finllamada,'áéíóúÁÉÍÓÚäëïöüÄËÏÖÜ','aeiouAEIOUaeiouAEIOU') as fines FROM movimientos_monitoreo_atencion_201905 ";
	    
		$sQuery = "SELECT id,descripcion FROM cat_fingestion_atencionar order by 1";
		
		$result = pg_query($conn,$sQuery);
	    while($array=pg_fetch_array($result)) {  
	        $response=true;
		    $dataTable['value'] = trim($array['id']);
	        $dataTable['descripcion'] =  utf8_encode(trim($array['descripcion']));
	        //$dataTable['descripcion'] =  utf8_encode(trim($array['fines']));
	        $arrayTable[] = $dataTable;
	        // $arrayTable[] = array_map('utf8_encode', $dataTable);

	    }
	    pg_close($conn);
	    $salidaJSON = array('atencion_argentina' => $response,'arrayTable' => $arrayTable);
	    print json_encode($salidaJSON);	
			
			
		}

      function opcion4($id_campana){

         $conn = conectaBD_128_catalogoempleados();
	    $response = false;
	    $dataTable = array();
	    $arrayTable = array();
	    $sQuery="SELECT descripcion FROM cat_fingestion_campanascat WHERE id_campana = $id_campana order by id_fingestion";
	    $result = pg_query($conn,$sQuery);
	    while($array=pg_fetch_array($result)) {  
	        $response=true;
	        $dataTable['descripcion'] = utf8_decode(utf8_encode(trim($array['descripcion'])));
	        $arrayTable[] = $dataTable;
	        // $arrayTable[] = array_map('utf8_encode', $dataTable);
	    }
	    pg_close($conn);
	    $salidaJSON = array('response' => $response,'arrayTable' => $arrayTable);
	    print json_encode($salidaJSON);


	  }
	  
	  function opcion5($id_campana)
	  {
		  
		$conn = conectaBD_128_atencion();
		$response = false;
	    $dataTable = array();
	    $arrayTable = array();
	    //$sQuery="SELECT distinct translate (finllamada,'áéíóúÁÉÍÓÚäëïöüÄËÏÖÜ','aeiouAEIOUaeiouAEIOU') as fines FROM movimientos_monitoreo_zuum_201906 ";
	    
		$sQuery = "SELECT id,descripcion FROM cat_fingestion_atencionzuum order by 1";
		
		$result = pg_query($conn,$sQuery);
		
	    while($array=pg_fetch_array($result)) {  
	        $response=true;
	        $dataTable['value'] = trim($array['id']);
	        $dataTable['descripcion'] =  utf8_encode(trim($array['descripcion']));   
		   
		   
		   //$dataTable['descripcion'] =  utf8_encode(trim($array['fines']));
	        $arrayTable[] = $dataTable;
	        // $arrayTable[] = array_map('utf8_encode', $dataTable);

	    }
	    pg_close($conn);
	    $salidaJSON = array('atencion_zuum' => $response,'arrayTable' => $arrayTable);
	    print json_encode($salidaJSON);	
		  
		  
	  
	  }
	  
	  
	  function opcion6($id_campana){
		  
		  
		  		  $conn = conectaBD_128_atencion();
		$response = false;
	    $dataTable = array();
	    $arrayTable = array();
	   // $sQuery="SELECT distinct translate (finllamada,'áéíóúÁÉÍÓÚäëïöüÄËÏÖÜ','aeiouAEIOUaeiouAEIOU') as fines FROM movimientos_monitoreo_soportet_201906 ";
	
        $sQuery = "SELECT id,descripcion FROM cat_fingestion_soportetecnico order by 1";
		
		$result = pg_query($conn,$sQuery);
	    while($array=pg_fetch_array($result)) {  
	        $response=true;
			
		    $dataTable['value'] = trim($array['id']);
	        $dataTable['descripcion'] =  utf8_encode(trim($array['descripcion'])); 
			
	       // $dataTable['descripcion'] =  utf8_encode(trim($array['fines']));
	        $arrayTable[] = $dataTable;
	        // $arrayTable[] = array_map('utf8_encode', $dataTable);

	    }
	    pg_close($conn);
	    $salidaJSON = array('atencion_soporte' => $response,'arrayTable' => $arrayTable);
	    print json_encode($salidaJSON);	
		  
		  
		  
		  
	  }
	

	function tablaCalidad() {
		
	
		$numEmpleado = $_POST['numEmpleado'];
		$Idservicio 	= $_POST['idServicio'];
	    $Idfingestion 	= $_POST['idfinGestion'];
		$idFecha 		= $_POST['idFecha'];
		$FechaTabla 	= $_POST['FechaTabla'];
		$Bandera        = $_POST['bandera'];
		
		
		//print_r($idfinGestion);
		
	
	if($Idservicio==4){
	  
		if($Idfingestion==='Promocion')
		{
		   $temp='Promocion ';
		   $Idfingestion=$temp;
			
		}
		
	     else if($Idfingestion==='Ya compro')
		 {
			 
			$temp='Ya compro ';
            $Idfingestion=$temp;			
			 
		 }
		 
		 else if($Idfingestion==='No le interesa la promocion')
		 {
             
            $temp='No le interesa la promocion ';
            $Idfingestion=$temp;

		 }	 
		 
		 
	}
		
		$estado = 0;
		$mensaje = "";
		$table = "";
		$filtro = "";
		$tablaMovimientos = "";
		$dataID = "";
			
		switch ($Idservicio) {
			case 1:
				$connection = conectaBD_128_ctcpl();
				$titleTable = "COBRANZA COPPEL";
				$tablaMovimientos = "movimientos_monitoreo_";
				$filtro = " WHERE  numempleado = $numEmpleado and finllamada = '$Idfingestion' and fecha::date = '$idFecha' order by hora; ";
				break;
			case 2:	
	            $connection = conectaBD_128_ctbcpl();
				$titleTable = "COBRANZA BANCOPPEL";
				$tablaMovimientos = "movimientos_monitoreo_";
				$filtro = " WHERE  numempleado = $numEmpleado and finllamada = '$Idfingestion' and fecha::date = '$idFecha' order by hora; ";
				break;
            case 3:
			    $connection = conectaBD_128_ctcpl();
				$titleTable = "COBRANZA ARGENTINA";
				$tablaMovimientos = "movimientos_monitoreo_argentina_";
				$filtro = " WHERE  numempleado = $numEmpleado and finllamada = '$Idfingestion' and fecha::date = '$idFecha' order by hora; ";
				break;
			case 4:
			    $connection = conectaBD_128_promocioncoppel();
				$titleTable = "PROMOCION COPPEL";
				$tablaMovimientos = "movimientos_monitoreo_";
				$filtro = " WHERE  numempleado::integer = $numEmpleado and finllamada = '$Idfingestion' and fecha::date = '$idFecha' order by hora; ";
				break;
			case 5:
			    $connection = conectaBD_128_promocioncoppel();
				$titleTable = "SOLICITANTES BANCO";
				$tablaMovimientos = "movimientos_monitoreo_sb_";
                $filtro = " WHERE  numempleado::integer = $numEmpleado and finllamada = '$Idfingestion' and fecha::date = '$idFecha' order by hora; ";
				break;
            case 6:
			    $connection = conectaBD_128_e_commerce();
				$titleTable = "SOLICITUD DE CREDITO EN LINEA";
				$tablaMovimientos = "movimientos_monitoreo_";
				$filtro = " WHERE  numempleado = $numEmpleado and finllamada = '$Idfingestion' and fecha::date = '$idFecha' order by hora; ";
				break;
            case 7:
			    $connection = conectaBD_128_e_commerce();
				$titleTable = "VENTAS";
				$tablaMovimientos = "movimientos_monitoreo_ventas_";
                $filtro = " WHERE  numempleado = $numEmpleado and finllamada = '$Idfingestion' and fecha::date = '$idFecha' order by hora; ";
				break;
            case 8:
			    $connection = conectaBD_128_atencion();
				$titleTable = "ATENCION COPPEL";
				$tablaMovimientos = "movimientos_monitoreo_atencion_";
                $filtro = " WHERE  numempleado = $numEmpleado and finllamada  IN(select descripcion from cat_finesgestion_atencion WHERE id = $Idfingestion) and fecha::date = '$idFecha' order by hora; ";
				break;	 
            case 9:
			    $connection = conectaBD_128_atencionar();
				$titleTable = "ATENCION ARGENTINA";
				$tablaMovimientos = "movimientos_monitoreo_atencion_";
			    $filtro = " WHERE  numempleado = $numEmpleado and finllamada IN(select descripcion from cat_fingestion_atencionar WHERE id = $Idfingestion) and fecha::date = '$idFecha' order by hora; ";
				break;
            case 10:
			    $connection = conectaBD_128_atencion();
				$titleTable = "ATENCION ZUUM";
				$tablaMovimientos = "movimientos_monitoreo_zuum_";
				$filtro = " WHERE  numempleado = $numEmpleado and finllamada  IN(select descripcion from cat_fingestion_atencionzuum WHERE id = $Idfingestion) and fecha::date = '$idFecha' order by hora; ";
				break;
            case 11:
			    $connection = conectaBD_128_atencion();
				$titleTable = "ATENCION AFORE";
				$tablaMovimientos = "movimientos_monitoreo_afore_";
				$filtro = " WHERE  numempleado = $numEmpleado and finllamada = '$Idfingestion' and fecha::date = '$idFecha' order by hora; ";
				break;
			case 12:
                $connection = conectaBD_128_atencion();
                $titleTable = "SOPORTE TECNICO";
                $tablaMovimientos = "movimientos_monitoreo_soportet_";
                $filtro = " WHERE  numempleado = $numEmpleado and finllamada IN(select descripcion from cat_fingestion_soportetecnico WHERE id = $Idfingestion) and fecha::date = '$idFecha' order by hora; ";
                break;                
				
            case 13:
			    $connection = conectaBD_128_campanaunica();
				$titleTable = "CAMPANA UNICA";
				$tablaMovimientos = "movimientos_monitoreo_campanaunica_";
				$filtro = " WHERE  numempleado = $numEmpleado and finllamada = '$Idfingestion' and fecha::date = '$idFecha' order by hora; ";
				break;
            case 14:
			    $connection = conectaBD_128_campanaunica();
				$titleTable = "PROMOCION BANCOPPEL";
				$tablaMovimientos = "movimientos_monitoreo_promobanco_";
				$filtro = " WHERE  numempleado = $numEmpleado and finllamada = '$Idfingestion' and fecha::date = '$idFecha' order by hora; ";
				break;
            case 15:
                $connection = conectaBD_128_promocioncoppel();
                $titleTable = "PROMOCION ARGENTINA";
                $tablaMovimientos = "movimientos_monitoreo_argentina_";
                $filtro = " WHERE  numempleado::integer = $numEmpleado and finllamada = '$Idfingestion' and fecha::date = '$idFecha' order by hora; ";
                break;
				
            case 16:
                $connection = 	conectaBD_128_atencion();
                $titleTable = "ATENCION A CLIENTES BANCOPPEL";
                $tablaMovimientos = "movatencionclientes_bancoppel";
                $filtro = " WHERE  empleado::integer = $numEmpleado and tipomovimiento = 0 and fecha::date = '$idFecha' order by hora; ";
                break;				
			
			default:
				# code...
				break;
		}
		
		if($titleTable === "COBRANZA COPPEL" or $titleTable === "COBRANZA BANCOPPEL" or $titleTable === "COBRANZA ARGENTINA" or $titleTable === "PROMOCION COPPEL" or $titleTable === "SOLICITANTES BANCO" or $titleTable === "SOLICITUD DE CREDITO EN LINEA" or $titleTable === "VENTAS" or $titleTable === "ATENCION COPPEL" or $titleTable === "ATENCION ARGENTINA" or $titleTable === "ATENCION ZUUM" or $titleTable === "ATENCION AFORE" or $titleTable === "SOPORTE TECNICO" or $titleTable === "CAMPANA UNICA" or $titleTable === "PROMOCION BANCOPPEL" or $titleTable === "PROMOCION ARGENTINA" )
		{
		
 		$sQuery  ="SELECT fecha, cliente, telefono, finllamada, ip, hora, id_audio ";
		$sQuery .="FROM ".$tablaMovimientos.$FechaTabla."";
		$sQuery .=$filtro;
		$count=0;
		
	
		$rs = pg_query($connection,$sQuery);
		}else if($titleTable === "ATENCION A CLIENTES BANCOPPEL")
		{
		$sQuery  ="SELECT fecha, cliente, telefono, tipomovimiento, hora, id_audio ";
		$sQuery .="FROM ".$tablaMovimientos."";
		$sQuery .=$filtro;
		$count=0;
		
	
		$rs = pg_query($connection,$sQuery);
			
			
		}

	
		
		if($rs) {
			$campos = pg_num_rows($rs);
						
			if($campos > 0) {
				
				$count=0;
				$audio;
				
				$estado  = 1;
				$mensaje = "OK";
				$table .='<div id="pruebadecss">';
				$table .='<table  class="table table-striped table-bordered"    style="text-align: center;vertical-align: middle;">';
	    			$table.='<caption><h4>'.$titleTable.'</h4></caption>';
			    	$table.='<thead style="background-color:#ddd" >';
		      			$table.='<tr id="table_consulta">';
		        			$table.='<th>Fecha</th>';
		        			$table.='<th>Cliente</th>';
		        			$table.='<th>Telefono</th>';
		        			$table.='<th>Fin llamada</th>';
		        			$table.='<th>Ip</th>';
		        			//$table.='<th>Centro</th>';
		        			$table.='<th>Hora</th>';
		        			$table.='<th>Audio</th>';
		        			$table.='<th>Calificar Llamada</th>';
	
		      			$table.='</tr>';
			    	$table.='</thead>';
			    	$table.='<tbody>';
					
			    	while($Array=pg_fetch_array($rs)) {
						
						
					    
						$count++;
			    		$table.='<tr id="sup'.$count.'">';
						$table .='<th nowrap>'.$Array['fecha'].'</th>';
						$table .='<th nowrap id="Cliente'.$count.'">'.$Array['cliente'].'</th>';
						$table .='<th nowrap>'.$Array['telefono'].'</th>';
						$table .='<th nowrap>'.utf8_encode($Array['finllamada']).'</th>';
						$table .='<th nowrap>'.$Array['ip'].'</th>';
					    //$table .='<th nowrap>'.$Array['numempleado'].'</th>';
						$table .='<th nowrap>'.$Array['hora'].'</th>';
						$table .='<th id="col-audio'.$count.'" nowrap><button id="btn-audio'.$count.'" type="button"  class = "btn btn-outline-primary glyphicon glyphicon-cloud-download"   dataID="'.utf8_encode($Array['id_audio']).'.mp3" onclick="descarga_audio(this,'.$count.')"  >Descarga</button></th>';
			
						$table .='<th nowrap>
						<button class="btn btn-danger btn-xs"  data-toggle="modal" data-target="#miModal"  id="btn'.$count.'" onclick="btn_plantilla('.$count.','.$Bandera.')"  dataID="'.utf8_encode($Array['id_audio']).'.mp3"  client="'.$Array['cliente'].'" disabled="true"><span class="glyphicon glyphicon-pencil"  ></span></button>
						</th>';
						
						//print_r($Array);
						
						
		      		}
		      			$table.='</tr>';
			    	$table.='</tbody>';
				$table.='</table>';
				$table .='</div>';
			}
			else{
				$estado  = -200;
				$mensaje = "No se encontro información de ejecutivo";
			}
		}
		else{
			$estado  = -100;
			$mensaje = pg_last_error($connection)." ".$sQuery;
		}	
		pg_close($connection);
	    $salidaJSON = array('estado'=>$estado, 'table'=>$table , 'mensaje'=>$mensaje ,'query'=>$sQuery);
				
	    print json_encode($salidaJSON);
		
	
	

		
	}
	
function verAudio(){
	
	$dataID = trim($_POST['dataID']);
	$estado = 0;
	$mensaje = "";
	$ruta = 'audios/'.$_SERVER['REMOTE_ADDR'].'/';
	$rutaDescarga ='audios/'.$_SERVER['REMOTE_ADDR'].'/';
	if (!file_exists($ruta)) {
		
	    mkdir($ruta);
	}else{
		foreach (glob($ruta."*.*") as $filename) 
		{
		      unlink($filename); 
		} 
	}
   
	if ($dataID != '0') {
		$URL='';
		$URL=http_mcp_rec.$dataID;
        //var_dump($URL);
		//inicializamos el stdClass que regresa cassandra Genesys
		$response = new stdClass();
		//ejecutamos curl de la url recording
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,$URL);
		curl_setopt($ch, CURLOPT_TIMEOUT, 30); //timeout after 30 seconds
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch, CURLOPT_USERPWD, username . ":" . password);
		$result=curl_exec ($ch);
		$status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);   //get status code
		curl_close ($ch);
		//metemos al stdClass la respuesta de cassandra
		$response = json_decode($result);
		//print_r($response);exit();
		//desconmponemos el stdClass para obtener el nombre del mp3 en webDAV.
		$remote_url = $response->recording->mediaFiles[0]->mediaId;
		//Variables para la etiqueta del audio
		list($id,$fechawebdab,$horawebdab,$fechallamada,$horallamada,$tipificacion,$telefonoconmd5) = explode('_',$remote_url);
		list($anio,$mes,$dia) = explode('-',$fechawebdab);
		list($hora,$min,$seg) = explode('-',$horawebdab);
		$nomCliente = $response->recording->eventHistory[0]->data->added->nombre_completo_cliente;
		$numCliente =  $response->recording->eventHistory[0]->data->added->cliente;
		$tipoOperacion = $response->recording->eventHistory[0]->data->added->tipo_de_operacion;
		$telefonoCliente = $response->recording->eventHistory[0]->data->added->GSW_PHONE;
		$campana = $response->recording->eventHistory[0]->data->added->GSW_CAMPAIGN_GROUP_NAME;
		$agente = $response->recording->mediaFiles[0]->parameters->agentId;
		list($campanaReal,$campanaReal2) = explode('@',$campana);	
			
		$settings = array( 'baseUri' => http_webdav.$anio.'/'.$mes.'/'.$dia.'/'.$hora.'/', 'userName' => PHP_AUTH_USER, 'password' => PHP_AUTH_PW );
		$dav = new Sabre_DAV_Client($settings);		
		$res = $dav->request('GET', $remote_url);
		$filepath = $ruta.$dataID; 
		$fh = fopen($filepath, 'w'); 
		fwrite($fh, $res['body']); 
		fclose($fh);
		if (filesize($ruta.utf8_encode($dataID))>7614) {
			$dinamic= $rutaDescarga.utf8_encode($dataID);			
				
				
		}
		

		
	}else{
		
		$estado = -200;
		$mensaje = "ERROR NO SE PUEDE OBTENER AUDIO";
		
		
	}

	  		
	$estado  = 1;
	$mensaje = "OK";

	$salidaJSON = array('estado'=>$estado,'ruta'=>$dinamic,'mensaje'=>$mensaje,'ip'=>$dinamic);
	print json_encode($salidaJSON);
}

?>