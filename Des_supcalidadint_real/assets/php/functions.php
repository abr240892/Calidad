<?php
/*Hecho por Jorge Garcia*/
/*Modificado por Jorge Mondragon*/
/*Modificado por Alexis Félix */
include('config.php');
include 'SabreDAV/lib/sabre/autoload.php';
function informationResult() {
	if(ini_set("max_execution_time", "0"));
	if(ini_set("memory_limit", "2048M"));
	$typeConsult= trim($_POST['typeConsult']);
	$telefono 	= trim($_POST['telefono']);
	$cliente 	= trim($_POST['cliente']);
	$empleado 	= trim($_POST['empleado']);
	$finGestion = trim($_POST['finG']);
	$fechaCon	= trim($_POST['fecha']);
	$fechaMov   = trim($_POST['fechaQuery']);

	$estado = 0;
	$mensaje = "";
	$table = "";
	$filtro = "";
	$tablaMovimientos = "";

	$arrayConsult = array("queryCtcpl","queryBanco","queryCtcplar","queryPromocion","querySB","queryEcommerce","queryVentas","queryAtnCob","queryAtnAr","queryAtnZuum","queryAtnAfore","queryCampaUnica","queryPromoBanco","queryAtnSopTec");
	$countFile = count($arrayConsult);

	if($typeConsult==1) {
		$filtro = "WHERE telefono = '$telefono'  ORDER BY fecha; ";
	}else if($typeConsult==2){
		$filtro = "WHERE cliente::text = '".$cliente."' AND telefono = '".$telefono."' ORDER BY fecha; ";
	}else{
		if($fechaCon =='' and $finGestion!='' and $empleado!='' and $cliente!='' ){$filtro = "where cliente=".$cliente." and numempleado='".$empleado."' and upper(finllamada) like upper('%".utf8_encode(utf8_decode($finGestion))."%') order by fecha asc; " ;}
			elseif ($fechaCon =='' and $finGestion =='' and $empleado!='' and $cliente!='') {$filtro = "where cliente=".$cliente." and numempleado='".$empleado."' order by fecha asc;" ;}
			elseif ($fechaCon =='' and $finGestion =='' and $empleado =='' and $cliente!='') {$filtro = "where cliente=".$cliente." order by fecha asc; ";}
			elseif ($fechaCon =='' and $empleado =='' and $finGestion!='' and $cliente!='') {$filtro= "where cliente=".$cliente." and upper(finllamada) like upper('%".utf8_encode(utf8_decode($finGestion))."%') order by fecha;";}
			elseif ($fechaCon !='' and $empleado =='' and $finGestion=='' and $cliente!='') {$filtro= "where cliente=".$cliente."  order by fecha asc;";}
			elseif ($fechaCon !='' and $empleado =='' and $finGestion!='' and $cliente!='') {$filtro= "where cliente=".$cliente."  and upper(finllamada) like upper('%".utf8_encode(utf8_decode($finGestion))."%') order by fecha;";}
			elseif ($fechaCon !='' and $empleado!='' and $finGestion=='' and $cliente!='') {$filtro= "where cliente=".$cliente."  and numempleado='".$empleado."' order by fecha;";}
		else{
		$filtro = "WHERE cliente = ".$cliente." and numempleado='".$empleado."' and upper(finllamada) like upper('%".utf8_encode(utf8_decode($finGestion))."%')  and fecha='".$fechaCon."' ORDER BY fecha asc; ";
		}
	}
	//$connection4 = conectaBD_142_Ctcpl();
	for ($i=0; $i < $countFile; $i++) {

	    switch ($arrayConsult[$i]) {

			case "queryCtcpl":      
			$connection = conectaBD_142_appweb();
			$titleTable = "COBRANZA";
			$tablaMovimientos = "movimientos_monitoreo_";
			break;
			case "queryBanco": 
			$connection = conectaBD_128_bancoppel();
			$titleTable = "BANCO";
			$tablaMovimientos = "movimientos_monitoreo_";
			break;
			case "queryCtcplar":  
			$connection = conectaBD_142_appweb();
			$titleTable = "ARGENTINA";
			$tablaMovimientos = "movimientos_monitoreo_argentina_";
			break;
			case "queryPromocion":  
			$connection = conectaBD_142_promocion();
			$titleTable = "PROMOCION";
			$tablaMovimientos = "movimientos_monitoreo_";
			break;
			case "querySB":  
			$connection = conectaBD_142_promocion();
			$titleTable = "PROMOCION SB";
			$tablaMovimientos = "movimientos_monitoreo_sb_";
			break;
			case "queryEcommerce":  
			$connection = conectaBD_128_ecommerce();
			$titleTable = "SOLCREDITO";
			$tablaMovimientos = "movimientos_monitoreo_";
			break;
			case "queryVentas":  
			$connection = conectaBD_128_ecommerce();
			$titleTable = "VENTAS";
			$tablaMovimientos = "movimientos_monitoreo_ventas_";
			break;
			case "queryAtnCob":  
			$connection = conectaBD_atenAfore_128();
			$titleTable = "ATENCION COPPEL";
			$tablaMovimientos = "movimientos_monitoreo_atencion_";
			break;
			case "queryAtnAr":  
			$connection = conectaBD_atenArg_128();
			$titleTable = "ARGENTINA";
			$tablaMovimientos = "movimientos_monitoreo_atencion_";
			break;
			case "queryAtnZuum":  
			$connection = conectaBD_atenAfore_128();
			$titleTable = "ATENCION ZUUM";
			$tablaMovimientos = "movimientos_monitoreo_zuum_";
			break;
			case "queryAtnAfore":  
			$connection = conectaBD_atenAfore_128();
			$titleTable = "ATENCION AFORE";
			$tablaMovimientos = "movimientos_monitoreo_afore_";
			break;
			case "queryCampaUnica":  
			$connection = conectaBD_campunica_128();
			$titleTable = "CAMPANA UNICA";
			$tablaMovimientos = "movimientos_monitoreo_campanaunica_";
			break;
			case "queryPromoBanco":  
			$connection = conectaBD_campunica_128();
			$titleTable = "PROMOCION BANCOPPEL";
			$tablaMovimientos = "movimientos_monitoreo_promobanco_";
			case "queryAtnSopTec":  
			$connection = conectaBD_atenAfore_128();
			$titleTable = "ATENCION SOPORTE TECNICO";
			$tablaMovimientos = "movimientos_monitoreo_soportet_";
			break;
			default: break;
		}
		$sQuery  ="SELECT fecha, cliente, telefono, finllamada, id_audio, ip, numempleado, grupo, hora, tipotelefono  ";
		$sQuery .="FROM ".$tablaMovimientos.$fechaMov." ";
		$sQuery .=$filtro;
		$rs = pg_query($connection,$sQuery);
		if($rs) {
			$campos = pg_num_rows($rs);
			if($campos > 0) {
				$estado  = 1;
				$mensaje = "OK";
				$table .='<div id="pruebadecss">';
				$table .='<table class="table table-striped table-bordered">';
	    			$table.='<caption>'.$titleTable.'</caption>';
			    	$table.='<thead>';
		      			$table.='<tr>';
		        			$table.='<th style="text-align: center;">Fecha</th>';
		        			$table.='<th style="text-align: center;">Cliente</th>';
		        			$table.='<th style="text-align: center;">Telefono</th>';
		        			$table.='<th style="text-align: center;">Fin llamada</th>';
		        			//$table.='<th style="text-align: center;">Audio</th>';
		        			$table.='<th style="text-align: center;">Ip</th>';
		        			$table.='<th style="text-align: center;">Numero empleado</th>';
		        			$table.='<th style="text-align: center;">Grupo</th>';
		        			$table.='<th style="text-align: center;">Hora</th>';
		        			$table.='<th style="text-align: center;">Tipo Telefono</th>';
		        			//$table.='<th style="text-align: center;">Audio</th>';
		      			$table.='</tr>';
			    	$table.='</thead>';
			    	$table.='<tbody>';
			    	while($Array=pg_fetch_array($rs)) {
			    	
			    		$table.='<tr class = "Reproducir" dataID="'.$Array['id_audio'].'.mp3">';
			    		/*for($j=0; $j<10; $j++) {
							$table .='<th nowrap style="text-align: center;">';
							$table .=''.utf8_encode($Array[$j]).'';
							$table .='</th>';
						}*/
						$table .='<th nowrap style="text-align: center;">'.utf8_encode($Array['fecha']).'</th>';
						$table .='<th nowrap style="text-align: center;">'.utf8_encode($Array['cliente']).'</th>';
						$table .='<th nowrap style="text-align: center;">'.utf8_encode($Array['telefono']).'</th>';
						$table .='<th nowrap style="text-align: center;">'.utf8_encode($Array['finllamada']).'</th>';
						/*Descarga Audios*/
						/*
						if ($Array['id_audio'] != '0') {
							$table .='<th nowrap style="text-align: center;">';
								$table .='<button class="btnAudio btn btn-danger btn-xs" dataID="'.utf8_encode($Array['id_audio']).'.mp3"><span class="glyphicon glyphicon-play"></span> Reproducir</button>';
							$table .='</th>';
						}else{
							$table .='<th nowrap style="text-align: center;">';
								$table .='Este movimiento no tiene ligado audio';
							$table .='</th>';
						}
						*/
						/*Termina Descarga Audios*/
						$table .='<th nowrap style="text-align: center;">'.utf8_encode($Array['ip']).'</th>';
						$table .='<th nowrap style="text-align: center;">'.utf8_encode($Array['numempleado']).'</th>';
						$table .='<th nowrap style="text-align: center;">'.utf8_encode($Array['grupo']).'</th>';
						$table .='<th nowrap style="text-align: center;">'.utf8_encode($Array['hora']).'</th>';
						$table .='<th nowrap style="text-align: center;">'.utf8_encode($Array['tipotelefono']).'</th>';
						/*Termina Descarga Audios*/
		      		}
		      			$table.='</tr>';
			    	$table.='</tbody>';
				$table.='</table>';
				$table .='</div>';
			}
		}
		else{
			$estado  = -100;
			$mensaje = pg_last_error($connection)." ".$sQuery;
		}
		pg_close($connection);
	}
    $salidaJSON = array('estado'=>$estado, 'table'=>$table, 'mensaje'=>$mensaje, 'query'=>$sQuery);
	print json_encode($salidaJSON);

}//termina la funcion
function tablaCalidad() {
	if(ini_set("max_execution_time", "0"));
	if(ini_set("memory_limit", "2048M"));
	$Idservicio 	= trim($_POST['idServicio']);
	$Idfingestion 	= trim($_POST['idfinGestion']);
	$Fechaini 		= trim($_POST['Fechaini']);
	$fechaMov   	= trim($_POST['fechaSqueryini']);

	$estado = 0;
	$mensaje = "";
	$table = "";
	$filtro = "";
	$tablaMovimientos = "";

	$contador = 0;
	
	$filtro = " WHERE trim(finllamada) = ('".$Idfingestion."')  and fecha = '".$Fechaini."' ORDER BY fecha asc; ";

	    switch ($Idservicio) {

			case '1':      
				$connection = conectaBD_142_appweb();
				$titleTable = "COBRANZA";
				$tablaMovimientos = "movimientos_monitoreo_";
			break;
			case '2':
				$connection = conectaBD_128_bancoppel();
				$titleTable = "COBRANZA BANCOPPEL";
				$tablaMovimientos = 'movimientos_monitoreo_';
			break;
			case '3':
				$connection = conectaBD_142_appweb();
				$titleTable = "COBRANZA ARGENTINA";
				$tablaMovimientos = 'movimientos_monitoreo_argentina_';
			break;
			case '4':
				$connection = conectaBD_142_promocion();
				$titleTable = "PROMOCION COPPEL";
				$tablaMovimientos = 'movimientos_monitoreo_';
			break;
			case '5':
				$connection = conectaBD_142_promocion();
				$titleTable = "SOLICITANTES BANCO";
				$tablaMovimientos = 'movimientos_monitoreo_sb_';
			break;
			case '6':
				$connection = conectaBD_128_ecommerce();
				$titleTable = "SOLICITUD DE CREDITO";
				$tablaMovimientos = 'movimientos_monitoreo_';
			break;
			case '7':
				$connection = conectaBD_128_ecommerce();
				$titleTable = "VENTAS";
				$tablaMovimientos = 'movimientos_monitoreo_ventas_';
			break;
			case '8':
				$connection = conectaBD_atenAfore_128();
				$titleTable = "ATENCION COPPEL";
				$tablaMovimientos = 'movimientos_monitoreo_atencion_';
			break;
			case '9':
				$connection = conectaBD_atenArg_128();
				$titleTable = "AFORE ARGENTINA";
				$tablaMovimientos = 'movimientos_monitoreo_atencion_';
			break;
			case '10':
				$connection = conectaBD_atenAfore_128();
				$titleTable = "ATENCION ZUUM";
				$tablaMovimientos = 'movimientos_monitoreo_zuum_';
			break;
			case '11':
				$connection = conectaBD_atenAfore_128();
				$titleTable = "ATENCION AFORE";
				$tablaMovimientos = 'movimientos_monitoreo_afore_';
			break;
			case '12':
				$connection = conectaBD_atenAfore_128();
				$titleTable = "ATENCION SOPORTE TECNICO";
				$tablaMovimientos = 'movimientos_monitoreo_soportet_';
			break;
			case '13':
				$connection = conectaBD_campunica_128();
				$titleTable = "CAMPANA UNICA";
				$tablaMovimientos = 'movimientos_monitoreo_campanaunica_';
			break;
			case '14':
				$connection = conectaBD_campunica_128();
				$titleTable = "PROMOCION BANCOPPEL";
				$tablaMovimientos = 'movimientos_monitoreo_promobanco_';
			
			default: break;
		}


		$sQuery  ="SELECT fecha, cliente, telefono, finllamada, id_audio, ip, numempleado, grupo, hora, tipotelefono  ";
		$sQuery .="FROM ".$tablaMovimientos.$fechaMov." ";
		$sQuery .=$filtro;
		$rs = pg_query($connection,$sQuery);
		if($rs) {
			$campos = pg_num_rows($rs);
			if($campos > 0) {
				$estado  = 1;
				$mensaje = "OK";
				$table .='<div id="pruebadecss">';
				$table .='<table class="table table-striped table-bordered">';
	    			$table.='<caption>'.$titleTable.'</caption>';
			    	$table.='<thead>';
		      			$table.='<tr>';
		        			$table.='<th>Fecha</th>';
		        			$table.='<th>Cliente</th>';
		        			$table.='<th>Telefono</th>';
		        			$table.='<th>Fin llamada</th>';
		        			//$table.='<th>Audio</th>';
		        			$table.='<th>Ip</th>';
		        			$table.='<th>Numero empleado</th>';
		        			$table.='<th>Grupo</th>';
		        			$table.='<th>Hora</th>';
		        			$table.='<th>Tipo Telefono</th>';
		        			//$table.='<th style="text-align: center;">Audio</th>';
		      			$table.='</tr>';
			    	$table.='</thead>';
			    	$table.='<tbody>';
			    	while($Array=pg_fetch_array($rs)) {
			    		$table.='<tr class = "Reproducir" dataID="'.$Array['id_audio'].'.mp3">';
			    		/*for($j=0; $j<10; $j++) {
							$table .='<th nowrap style="text-align: center;">';
							$table .=''.utf8_encode($Array[$j]).'';
							$table .='</th>';
						}*/
						$table .='<th nowrap>'.$Array['fecha'].'</th>';
						$table .='<th nowrap>'.$Array['cliente'].'</th>';
						$table .='<th nowrap>'.$Array['telefono'].'</th>';
						$table .='<th nowrap>'.$Array['finllamada'].'</th>';
						//$table .='<th nowrap>'.$Array['id_audio'].'</th>';

						/*Descarga Audios*/
						/*
						if ($Array['id_audio'] != '0') {
							$table .='<th nowrap style="text-align: center;">';
								$table .='<button class="btnAudio btn btn-danger btn-xs" dataID="'.utf8_encode($Array['id_audio']).'.mp3"><span class="glyphicon glyphicon-play"></span> Reproducir</button>';
							$table .='</th>';
						}else{
							$table .='<th nowrap style="text-align: center;">';
								$table .='Este movimiento no tiene ligado audio';
							$table .='</th>';
						}
						*/
						/*Termina Descarga Audios*/
						$table .='<th nowrap>'.$Array['ip'].'</th>';
						$table .='<th nowrap>'.$Array['numempleado'].'</th>';
						$table .='<th nowrap>'.$Array['grupo'].'</th>';
						$table .='<th nowrap>'.$Array['hora'].'</th>';
						$table .='<th nowrap>'.$Array['tipotelefono'].'</th>';
		      		}
		      			$table.='</tr>';
			    	$table.='</tbody>';
				$table.='</table>';
				$table .='</div>';
			}
		}
		else{
			$estado  = -100;
			$mensaje = pg_last_error($connection)." ".$sQuery;
		}
		pg_close($connection);
	//}
    $salidaJSON = array('estado'=>$estado, 'table'=>$table, 'mensaje'=>$mensaje, 'query'=>$sQuery);
	print json_encode($salidaJSON);

}
/*function verAudio()
{
	$dataID = trim($_POST['dataID']);
	$estado = 0;
	$mensaje = "";
	$ruta = ruta_audios.$_SERVER['REMOTE_ADDR'].'/';
	$rutaDescarga = 'audios/'.$_SERVER['REMOTE_ADDR'].'/';
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
		if ($response->statusCode==0) {
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
			//$filepath = $ruta.$campanaReal2."_".$numCliente."_".$nomCliente."_".$telefonoCliente."_".$fechallamada."_".$horallamada."_".$agente.".mp3"; 
			$fh = fopen($filepath, 'w'); 
			fwrite($fh, $res['body']); 
			fclose($fh);
			if (filesize($ruta.utf8_encode($dataID))>7614) {
				$modaltable .='<th nowrap style="text-align: center;">';
					$modaltable .='<audio controls>';
					  $modaltable .='<source src="'.$rutaDescarga.utf8_encode($dataID).'" ';
					$modaltable .='</audio> ';
				$modaltable .='</th>';
			}else{
				$modaltable .='<th nowrap style="text-align: center;">';
					$modaltable .='Este movimiento no tiene ligado audio';
				$modaltable .='</th>';
			}
		}else{
			$modaltable .='<th nowrap style="text-align: center;">';
				$modaltable .='ERROR al tratar de descargar audio, favor de reportar a Control Credito o Mesa de Ayuda'.$status_code;
			$modaltable .='</th>';
		}
	}else{
		$modaltable .='<th nowrap style="text-align: center;">';
			$modaltable .='Este movimiento no tiene ligado audio';
		$modaltable .='</th>';
	}

	$estado  = 1;
	$mensaje = "OK";
	

	$salidaJSON = array('estado'=>$estado, 'modaltable'=>$modaltable, 'mensaje'=>$mensaje);
	print json_encode($salidaJSON);
}*/
function verAudio()
{
	$dataID = trim($_POST['dataID']);
	$estado = 0;
	$mensaje = "";
	$ruta = ruta_audios.$_SERVER['REMOTE_ADDR'].'/';
	$rutaDescarga = 'audios/'.$_SERVER['REMOTE_ADDR'].'/';
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
		//$filepath = $ruta.$campanaReal2."_".$numCliente."_".$nomCliente."_".$telefonoCliente."_".$fechallamada."_".$horallamada."_".$agente.".mp3"; 
		$fh = fopen($filepath, 'w'); 
		fwrite($fh, $res['body']); 
		fclose($fh);
		if (filesize($ruta.utf8_encode($dataID))>7614) {
			$dinamic= $rutaDescarga.utf8_encode($dataID);			
			$modaltable .='<th nowrap style="text-align: center;">';
		$modaltable .='<audio id="'.$dataID.'" src="'.$dinamic.'"></audio>';
		$modaltable .='<div> ';
		/*$modaltable .="<button onclick='javascript:console.log(this)'>Play</button> ";
		$modaltable .="<button onclick='document.getElementById(".utf8_encode($dinamic2).").pause()'>Pause</button> ";
		$modaltable .="<button onclick='document.getElementById(".utf8_encode($dinamic2).").volume += 0.1'>Vol+ </button> ";
		$modaltable .="<button onclick='document.getElementById(".utf8_encode($dinamic2).").volume -= 0.1'>Vol- </button> ";*/
		$modaltable .='</div>';

				//$modaltable .='<audio controls >';
				 // $modaltable .='<source src="'.$rutaDescarga.utf8_encode($dataID).'" ';
				//$modaltable .='</audio> ';
			$modaltable .='</th>';
		}else{
			$modaltable .='<th nowrap style="text-align: center;">';
				$modaltable .='Este movimiento no tiene ligado audio';
			$modaltable .='</th>';
		}
	}else{
		$modaltable .='<th nowrap style="text-align: center;">';
			$modaltable .='Este movimiento no tiene ligado audio';
		$modaltable .='</th>';
	}

	$estado  = 1;
	$mensaje = "OK";
	

	$salidaJSON = array('estado'=>$estado, 'modaltable'=>$modaltable, 'ruta'=>$dinamic,'mensaje'=>$mensaje);
	print json_encode($salidaJSON);
}
function GeneraCsv()
{
	$typeConsult= trim($_POST['typeConsult']);
	$telefono 	= trim($_POST['telefono']);
	$cliente 	= trim($_POST['cliente']);
	$empleado 	= trim($_POST['empleado']);
	$finGestion = trim($_POST['finG']);
	$fechaCon	= trim($_POST['fecha']);
	$fechaMov   = trim($_POST['fechaQuery']);

	

    $conexion   = conectaBD_142_appweb(); //Conectamos a la BD

    $respuesta  = false;
  	if(ini_set("max_execution_time", "0"));	

  		if($typeConsult==1) {
		$filtro = "WHERE telefono = ".$telefono." ORDER BY fecha; ";
		}else if($typeConsult==2){
			$filtro = "WHERE cliente = ".$cliente." AND telefono = ".$telefono." ORDER BY fecha; ";
		}else{
			if($fechaCon =='' and $finGestion!='' and $empleado!='' and $cliente!='' ){$filtro = "where cliente=".$cliente." and numempleado='".$empleado."' and upper(finllamada) like upper('%".utf8_encode(utf8_decode($finGestion))."%') order by fecha asc; " ;}
				elseif ($fechaCon =='' and $finGestion =='' and $empleado!='' ) {$filtro = "where cliente=".$cliente." and numempleado='".$empleado."' order by fecha asc;" ;}
				elseif ($fechaCon =='' and $finGestion =='' and $empleado =='' and $cliente!='') {$filtro = "where cliente=".$cliente." order by fecha asc; ";}
				elseif ($fechaCon =='' and $empleado =='' and $finGestion!='') {$filtro= "where cliente=".$cliente." and upper(finllamada) like upper('%".utf8_encode(utf8_decode($finGestion))."%') order by fecha;";}
				elseif ($fechaCon !='' and $empleado =='' and $finGestion=='' and $cliente!='') {$filtro= "where cliente=".$cliente."  order by fecha;";}
				elseif ($fechaCon !='' and $empleado =='' and $finGestion!='' and $cliente!='') {$filtro= "where cliente=".$cliente."  and upper(finllamada) like upper('%".utf8_encode(utf8_decode($finGestion))."%') order by fecha;";}
				elseif ($fechaCon !='' and $empleado!='' and $finGestion=='' and $cliente!='') {$filtro= "where cliente=".$cliente."  and numempleado='".$empleado."' order by fecha;";}

			else{
			$filtro = "WHERE cliente = ".$cliente." and numempleado='".$empleado."' and upper(finllamada) like upper('%".utf8_encode(utf8_decode($finGestion))."%')  ORDER BY fecha asc; ";
			}
		}

		$sQuery ="SELECT fecha, cliente, telefono, tipotelefono, hora,  finllamada ";
		$sQuery .="FROM movimientos_monitoreo_".$fechaMov." ";
		$sQuery .= $filtro;
		$res=pg_query($sQuery);
		$vacio = pg_fetch_array($res);
		
		
		$fecha = date('Ymd');
		$type	= "COBRANZA";
		
		$nombreArchivo = "consultamovimientos_".$type."_".$cliente."_".$fechaCon;

		$txt_temp = "//10.44.15.232/catnomina/consultamovimientoscat/$nombreArchivo.csv";

		$Datos = fopen($txt_temp,"w"); fclose($Datos);
		$Datos = fopen($txt_temp,"a");

		if ($vacio !="")
		{
		    $linea ="";
			$campos = pg_num_fields($res);
			for ($i=0; $i < $campos; $i++)
			{
				$linea .= pg_field_name ($res, $i) . ",";
			}
			$linea = substr($linea, 0, -1);
			fwrite($Datos, $linea . PHP_EOL);
			$contar = 0;

			$conteo = 0;
			$total = pg_num_rows($res);

			while($conteo < $total)
			{
				$fila=pg_fetch_array($res,$conteo,PGSQL_NUM);

				$linea = "";
				for($i=0; $i<$campos; $i++) 
				{
					$linea .= $fila[$i] . ",";
				}
				$linea = substr($linea, 0, -1);
				fwrite($Datos, $linea . PHP_EOL);
				$contar++;
				$conteo++;
			}
			fclose($Datos);

	       $respuesta = true;
		}

	$salidaJSON = array('respuesta' => $respuesta);
	print json_encode($salidaJSON);
}//termina la funcion 


function GeneraCsvPromo()
{
	$typeConsult= trim($_POST['typeConsult']);
	$telefono 	= trim($_POST['telefono']);
	$cliente 	= trim($_POST['cliente']);
	$empleado 	= trim($_POST['empleado']);
	$finGestion = trim($_POST['finG']);
	$fechaCon	= trim($_POST['fecha']);
	$fechaMov   = trim($_POST['fechaQuery']);	


    //$conexion   = conectaBD(); //Conectamos a la BD
    $connvpromo	= conectaBD_142_promocion();
    //$connvali	= conectaBD_142_validacion();

    $respuesta  = false;
  	if(ini_set("max_execution_time", "0"));	

  		if($typeConsult==1) {
			$filtro = "WHERE telefono = ".$telefono." ORDER BY fecha; ";
		}else if($typeConsult==2){
			$filtro = "WHERE cliente = ".$cliente." AND telefono = ".$telefono." ORDER BY fecha; ";
		}else{
			if($fechaCon =='' and $finGestion!='' and $empleado!='' and $cliente!='' ){$filtro = "where cliente=".$cliente." and numempleado='".$empleado."' and upper(finllamada) like upper('%".utf8_encode(utf8_decode($finGestion))."%') order by fecha asc; " ;}
				elseif ($fechaCon =='' and $finGestion =='' and $empleado!='' ) {$filtro = "where cliente=".$cliente." and numempleado='".$empleado."' order by fecha asc;" ;}
				elseif ($fechaCon =='' and $finGestion =='' and $empleado =='' and $cliente!='') {$filtro = "where cliente=".$cliente." order by fecha asc; ";}
				elseif ($fechaCon =='' and $empleado =='' and $finGestion!='') {$filtro= "where cliente=".$cliente." and upper(finllamada) like upper('%".utf8_encode(utf8_decode($finGestion))."%') order by fecha;";}
				elseif ($fechaCon !='' and $empleado =='' and $finGestion=='' and $cliente!='') {$filtro= "where cliente=".$cliente."  order by fecha;";}
				elseif ($fechaCon !='' and $empleado =='' and $finGestion!='' and $cliente!='') {$filtro= "where cliente=".$cliente."  and upper(finllamada) like upper('%".utf8_encode(utf8_decode($finGestion))."%') order by fecha;";}
				elseif ($fechaCon !='' and $empleado!='' and $finGestion=='' and $cliente!='') {$filtro= "where cliente=".$cliente." and numempleado='".$empleado."' order by fecha;";}

			else{
			$filtro = "WHERE cliente = ".$cliente." and numempleado='".$empleado."' and upper(finllamada) like upper('%".utf8_encode(utf8_decode($finGestion))."%')  ORDER BY fecha asc; ";
			}
		}

		$sQuery ="SELECT fecha, cliente, telefono, tipotelefono, hora,  finllamada ";
		$sQuery .="FROM movimientos_monitoreo_".$fechaMov." ";
		$sQuery .=$filtro;
		$res=pg_query($sQuery);
		$vacio = pg_fetch_array($res);
		
		$fecha = date('Ymd');
				
		$type	= "PROMOCION";
		
		$nombreArchivo = "consultamovimientos_".$type."_".$cliente."_".$fechaCon;

		$txt_temp = "//10.44.15.232/catnomina/consultamovimientoscat/$nombreArchivo.csv";


		$Datos = fopen($txt_temp,"w"); fclose($Datos);
		$Datos = fopen($txt_temp,"a");

		if ($vacio !="")
		{
		    $linea ="";
			$campos = pg_num_fields($res);
			for ($i=0; $i < $campos; $i++)
			{
				$linea .= pg_field_name ($res, $i) . ",";
			}
			$linea = substr($linea, 0, -1);
			fwrite($Datos, $linea . PHP_EOL);
			$contar = 0;

			while($fila=pg_fetch_array($res))
			{
				$linea = "";
				for($i=0; $i<$campos; $i++) 
				{
					$linea .= $fila[$i] . ",";
				}
				$linea = substr($linea, 0, -1);
				fwrite($Datos, $linea . PHP_EOL);
				$contar++;
			}
			fclose($Datos);

	       $respuesta = true;
		}

	$salidaJSON = array('respuesta' => $respuesta,'query' => $sQuery,'resultado' => $vacio);
	print json_encode($salidaJSON);
}//termina funcion

function GeneraCsvValid()
{
	$typeConsult= trim($_POST['typeConsult']);
	$telefono 	= trim($_POST['telefono']);
	$cliente 	= trim($_POST['cliente']);
	$empleado 	= trim($_POST['empleado']);
	$finGestion = trim($_POST['finG']);
	$fechaCon	= trim($_POST['fecha']);
	$fechaMov   = trim($_POST['fechaQuery']);	

    $connvpromo	= conectaBD_142_validacion();

    $respuesta  = false;
  	if(ini_set("max_execution_time", "0"));	

  		if($typeConsult==1) {
			$filtro = "WHERE telefono = ".$telefono." ORDER BY fecha; ";
		}else if($typeConsult==2){
			$filtro = "WHERE cliente = ".$cliente." AND telefono = ".$telefono." ORDER BY fecha; ";
		}else{
			if($fechaCon =='' and $finGestion!='' and $empleado!='' and $cliente!='' ){$filtro = "where cliente=".$cliente." and numempleado='".$empleado."' and upper(finllamada) like upper('%".utf8_encode(utf8_decode($finGestion))."%') order by fecha asc; " ;}
				elseif ($fechaCon =='' and $finGestion =='' and $empleado!='' ) {$filtro = "where cliente=".$cliente." and numempleado='".$empleado."' order by fecha asc;" ;}
				elseif ($fechaCon =='' and $finGestion =='' and $empleado =='' and $cliente!='') {$filtro = "where cliente=".$cliente." order by fecha asc; ";}
				elseif ($fechaCon =='' and $empleado =='' and $finGestion!='') {$filtro= "where cliente=".$cliente." and upper(finllamada) like upper('%".utf8_encode(utf8_decode($finGestion))."%') order by fecha;";}
				elseif ($fechaCon !='' and $empleado =='' and $finGestion=='' and $cliente!='') {$filtro= "where cliente=".$cliente."  order by fecha;";}
				elseif ($fechaCon !='' and $empleado =='' and $finGestion!='' and $cliente!='') {$filtro= "where cliente=".$cliente."  and upper(finllamada) like upper('%".utf8_encode(utf8_decode($finGestion))."%') order by fecha;";}
				elseif ($fechaCon !='' and $empleado!='' and $finGestion=='' and $cliente!='') {$filtro= "where cliente=".$cliente."  and numempleado='".$empleado."' order by fecha;";}

			else{
			$filtro = "WHERE cliente = ".$cliente." and numempleado='".$empleado."' and upper(finllamada) like upper('%".utf8_encode(utf8_decode($finGestion))."%')  ORDER BY fecha asc; ";
			}
		}

		$sQuery ="SELECT fecha, cliente, telefono, tipotelefono, hora,  finllamada ";
		$sQuery .="FROM movimientos_monitoreo_".$fechaMov." ";
		$sQuery .=$filtro;
		$res=pg_query($sQuery);
		$vacio = pg_fetch_array($res);
		
		$fecha = date('Ymd');
				
		$type	= "VALIDACION";
		
		$nombreArchivo = "consultamovimientos_".$type."_".$cliente."_".$fechaCon;

		$txt_temp = "//10.44.15.232/catnomina/consultamovimientoscat/$nombreArchivo.csv";


		$Datos = fopen($txt_temp,"w"); fclose($Datos);
		$Datos = fopen($txt_temp,"a");

		if ($vacio !="")
		{
		    $linea ="";
			$campos = pg_num_fields($res);
			for ($i=0; $i < $campos; $i++)
			{
				$linea .= pg_field_name ($res, $i) . ",";
			}
			$linea = substr($linea, 0, -1);
			fwrite($Datos, $linea . PHP_EOL);
			$contar = 0;

			while($fila=pg_fetch_array($res))
			{
				$linea = "";
				for($i=0; $i<$campos; $i++) 
				{
					$linea .= $fila[$i] . ",";
				}
				$linea = substr($linea, 0, -1);
				fwrite($Datos, $linea . PHP_EOL);
				$contar++;
			}
			fclose($Datos);

	       $respuesta = true;
		}

	$salidaJSON = array('respuesta' => $respuesta);
	print json_encode($salidaJSON);
}//termina funcion

function GeneraCsvMonitoreo()
{

	$servicio 	= trim($_POST['servicio']);
	$fingestion = trim($_POST['fingestion']);
	$fecha 		= trim($_POST['fecha']);
	$fechatabla	= trim($_POST['fechtabla']);
	$tablaMovimientos = "movimientos_monitoreo_";
	$respuesta  = false;
	    switch ($servicio) {
			case "COBRANZA":      
				$conexion = conectaBD_142_appweb();
			break;
			case "PROMOCION": 
				$conexion = conectaBD_142_promocion();
			break;
			case "VALIDACION":  
				$conexion = conectaBD_142_validacion();
			break;
			case "BANCOPPEL":  
				$conexion = conectaBD_128_bancoppel();
			break;
			case "ECOMMERCE":  
				$conexion = conectaBD_128_ecommerce();
			break;
			default: break;
		}

  	if(ini_set("max_execution_time", "0"));	

		$sQuery ="SELECT fecha,cliente,telefono,finllamada,ip,numempleado,grupo,hora,tipotelefono FROM movimientos_monitoreo_".$fechatabla." WHERE upper(finllamada) = upper('".$fingestion."') and fecha = '".$fecha."';";
		$res=pg_query($sQuery);
		$vacio = pg_fetch_array($res);
		
		$nombreArchivo = "consultamovimientos_"."MONITOREO_".$servicio."_".$fingestion."_".$fecha;
		$txt_temp = "//10.44.15.232/catnomina/consultamovimientoscat/$nombreArchivo.csv";

		$Datos = fopen($txt_temp,"w"); fclose($Datos);
		$Datos = fopen($txt_temp,"a");

		if ($vacio !="")
		{
		    $linea ="";
			$campos = pg_num_fields($res);
			for ($i=0; $i < $campos; $i++)
			{
				$linea .= pg_field_name ($res, $i) . ",";
			}
			$linea = substr($linea, 0, -1);
			fwrite($Datos, $linea . PHP_EOL);
			$contar = 0;
			$conteo = 0;
			$total = pg_num_rows($res);

			while($conteo < $total)
			{
				$fila=pg_fetch_array($res,$conteo,PGSQL_NUM);
				$linea = "";
				for($i=0; $i<$campos; $i++) 
				{
					$linea .= $fila[$i] . ",";
				}
				$linea = substr($linea, 0, -1);
				fwrite($Datos, $linea . PHP_EOL);
				$contar++;
				$conteo++;
			}
			fclose($Datos);

	       $respuesta = true;
		}

	$salidaJSON = array('respuesta' => $respuesta);
	print json_encode($salidaJSON);
}

function nomFinGestion(){
	$id_campana=$_POST['id_campana'];
    $conn = conectaBD_appweb_128();
    $response = false;
    $dataTable = array();
    $arrayTable = array();

    $sQuery="SELECT 
                descripcion
        FROM cat_fingestion_campanascat WHERE id_campana = ".$id_campana." order by id_fingestion";
    $result = pg_query($conn,$sQuery);
    while($array=pg_fetch_array($result)) {  
        $response=true;
        $dataTable['descripcion'] = utf8_decode(utf8_encode(trim($array['descripcion'])));
        //$arrayTable[] = $dataTable;
        $arrayTable[] = array_map('utf8_encode', $dataTable);
    }
    pg_close($conn);
    $salidaJSON = array('response' => $response,'arrayTable' => $arrayTable);
    print json_encode($salidaJSON);
}

 function nomCampanas(){
    $conn = conectaBD_appweb_128();
    $response = false;
    $dataTable = array();
    $arrayTable = array();

    $sQuery="SELECT 
                id_campana,
                campana
        FROM cat_campanas_consultamovs WHERE bandera = '1' ORDER BY 1";
    $result = pg_query($conn,$sQuery);
    while($array=pg_fetch_array($result)) {  
        $response=true;
        $dataTable['id_campana'] = trim($array['id_campana']);
        $dataTable['campana'] = utf8_decode(utf8_encode(trim($array['campana'])));
        $arrayTable[] = array_map('utf8_encode', $dataTable);
    }
    pg_close($conn);
    $salidaJSON = array('response' => $response,'arrayTable' => $arrayTable);
    print json_encode($salidaJSON);
}

function html_incidencia(){
	$id_campana=$_POST['id_campana'];
    $conn = conectaBD_atenAfore_128();
    $response = false;
    $dataTable = array();
    $arrayTable = array();

    $sQuery="SELECT 
    			id_incidencia,
                incidencia
        FROM cat_incidencia WHERE id_campana = ".$id_campana." order by id_incidencia";
    $result = pg_query($conn,$sQuery);
    while($array=pg_fetch_array($result)) {  
        $response=true;
        $dataTable['id_incidencia'] = trim($array['id_incidencia']);
        $dataTable['incidencia'] = trim($array['incidencia']);
        $arrayTable[] = array_map('utf8_encode',array_map('utf8_decode',$dataTable));
    }
    pg_close($conn);
    $salidaJSON = array('response' => $response,'arrayTable' => $arrayTable);
    print json_encode($salidaJSON);
}

function FinGestion_incidencia(){
	$id_campana=$_POST['id_campana'];
	$id_incidencia=$_POST['id_incidencia'];
    $conn = conectaBD_atenAfore_128();
    $response = false;
    $dataTable = array();
    $arrayTable = array();

    $sQuery="SELECT 
                descripcion
        FROM cat_incidencia_fg WHERE id_campana = ".$id_campana." and id_incidencia=".$id_incidencia." order by id_fingestion";
    $result = pg_query($conn,$sQuery);
    while($array=pg_fetch_array($result)) {  
        $response=true;
        $dataTable['descripcion'] =utf8_decode(utf8_encode((trim($array['descripcion']))));
        $arrayTable[] = array_map('utf8_encode', $dataTable);
    }
    pg_close($conn);
    $salidaJSON = array('response' => $response,'arrayTable' => $arrayTable, 'query' => $sQuery);
    print json_encode($salidaJSON);
}

$opcion = $_POST['opc'];
switch ($opcion) {
	case 'informationResult':
		informationResult();
		break;
	case 'genCSV':
		GeneraCsv();
		break;
	case 'genCSVpromo':
		GeneraCsvPromo();
		break;
	case 'genCSVvalid':
		GeneraCsvValid();
		break;
	case 'genCSVMonitoreo':
		GeneraCsvMonitoreo();
		break;
	case 'tablaCalidad':
		tablaCalidad();
		break;
	case 'verAudio':
		verAudio();
		break;
	case 'nomCampanas':
		nomCampanas();
		break;
	case 'nomFinGestion':
		nomFinGestion();
		break;
	case 'html_incidencia':
		html_incidencia();
		break;
	case 'FinGestion_incidencia':
		FinGestion_incidencia();
		break;
	default:
		break;
}

?>