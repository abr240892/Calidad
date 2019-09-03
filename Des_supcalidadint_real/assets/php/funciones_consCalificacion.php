<?php 

   include("conexiones.php");
   include 'SabreDAV/lib/sabre/autoload.php';
   
   $opc = $_POST['opc'];
	switch ($opc) {
		case 'llamarEmpleado':
			llamarEmpleado();
			break;
		
        case'llenarTablaConcentradodiario':
			llenarTablaConcentradodiario();
			break;
			
		case'llenarTablaSemaforoSemanal':
             llenarTablaSemaforoSemanal();	
           break;
		   
		case'llenarTablaSemaforoMensual':
              llenarTablaSemaforoMensual();
            break;			  

        case'modal_replica':
             ModalReplica();
           break;

        case'ReplicaVacia':
             InsertaRespuesta();
            break;

        case'RespuestaVacia':
             InsertaReplica();
            break;
			
        case'Respuesta_Replica':
             Replica_Respuesta();
            break;			 
				
		default:
			# code...
			break;
	}
	
	
	function llamarEmpleado(){
	   
		$jEmpleado 	= trim($_POST['empleado']);
		
		$cnumero = strlen($jEmpleado); 

		$conexion = conectaBD_128_catalogoempleados();
		
		$mensaje = 0;
		
		if($cnumero==8)
		{
		
		$sQuery = " SELECT true as estado, nombre||' '||apellidopaterno||' '||apellidomaterno as nombrecompleto, nombrejefe , nombregerentetitular from vw_catalogoempleados where  empleado= '$jEmpleado' ";
		
				if($conexion){
			$rs = pg_query($sQuery);
			$array = pg_fetch_assoc($rs);
			
			$mensaje = 1;
			
		}
		pg_close($conexion);
		//pg_close($conn);
	    $salidaJSON = array('estado' => $array['estado'],
	    	'nombrecompleto' => utf8_encode($array['nombrecompleto']),
	    	'nombrejefe' => utf8_encode($array['nombrejefe']),
			'nombregerentetitular' => utf8_encode($array['nombregerentetitular']),
			'mensaje' => $mensaje );
			//'centro' => utf8_encode($array['centro']));
			
	    print json_encode($salidaJSON);

		}else if($cnumero==6)
		{
			
		$sQuery = " SELECT true as estado, nombrejefe , nombregerentetitular,centro from vw_catalogoempleados where  centro= '$jEmpleado' ";

        				if($conexion){
			$rs = pg_query($sQuery);
			$array = pg_fetch_assoc($rs);
			
			$mensaje = 2;
			
		}
		pg_close($conexion);
		//pg_close($conn);
	    $salidaJSON = array('estado' => $array['estado'],
	    	//'nombrecompleto' => utf8_encode($array['nombrecompleto']),
	    	'nombrejefe' => utf8_encode($array['nombrejefe']),
			'nombregerentetitular' => utf8_encode($array['nombregerentetitular']),
			'mensaje' => $mensaje );
			//'centro' => utf8_encode($array['centro']));
			
	    print json_encode($salidaJSON);

		
			
		}
		

	
	}
	
	function llenarTablaConcentradodiario(){
		
		$numEmpleado = $_POST['numempleado'];
		$deFecha = $_POST['defecha'];
		$aFecha =  $_POST['afecha'];
		$nomJefe = $_POST['nomjefe'];
		$centro  = $_POST['centro'];
		
			  $TotalAsp = "";
			  $TotalNeg = "";
			  $TotalCal = "";
			  $TotalTot = "";
			  $NombreJefe = "";
		
		$conexion = conectaBD_128_catalogoempleados();
		
		$estado = 0;
		$mensaje = "";
		$table = "";
		$titleTable = "CONCENTRADO";
	    $count = 0;
		$aspectostecnicos = 0;
		$negociacion = 0;
		$calidad = 0;
		$calificacionllamada = 0;
		  
	      //$sQuery = " SELECT nombrecompleto,aspectostecnicos,negociacion,calidad from consulta_calificaciones where centro='$centro' and fecha between $deFecha and $aFecha ";
 
           if(empty($centro))
		   {
 
            $sQuery = " SELECT nombrecompleto,nombrejefe,aspectostecnicos,negociacion,calidad,calificacionllamada,fecha_calificacion,hora_calificacion from consulta_calificaciones where numeroempleado='$numEmpleado'  and fecha_calificacion between '$deFecha' and '$aFecha' ";
		 
		   }else if(empty($numEmpleado))
			   
			   {
				   
				 $sQuery = " SELECT nombrecompleto,nombrejefe,aspectostecnicos,negociacion,calidad,calificacionllamada,fecha_calificacion,hora_calificacion from consulta_calificaciones where centro='$centro' and fecha_calificacion between '$deFecha' and '$aFecha' ";
				   
				   
			   }
		 
	    $rs = pg_query($sQuery);
		
		if($rs)
		{
			
			$campos = pg_num_rows($rs);
			if($campos>0)
			{
              $count = 0;
			  $aspectostecnicos = 0;
		      $negociacion = 0;
		      $calidad = 0;
		      $calificacionllamada = 0;
		      
              $estado = 1;
			  $mensaje = "OK";
			  $table .= '<div id="concentradoxdia">';
			  $table .='<table class="table table-striped table-bordered table-sm">';
			  $table .='<caption><h4>'.$titleTable.'</h4></caption>';
			  $table .='<thead>';
			  $table.='<tr id="table_concentrado">';
			  $table.='<th>Ejecutivo</td>';
			  $table.='<th>Aspectos Tecnicos</th>';
			  $table.='<th>Negociacion</th>';
			  $table.='<th>Dialogo Calido</th>';
			  $table.='<th>Calificacion de la llamada</th>';
			  $table.='<th>Replica</th>';
			  
			  $table.='</tr>';
			  $table.='</thead>';
			  $table.='<tbody>';
			  
			 while($Array=pg_fetch_array($rs)){
			  
			  $count++;
			  $aspectostecnicos++;
			  $negociacion++;
			  $calidad++;
			  $calificacionllamada++;

			  
			   
			  //aspectos tecnicos
			  
			  if($Array['aspectostecnicos']<=100&& $Array['aspectostecnicos']>=95 ){
			  
			   $color1 = 'style="background-color:blue;color:white;"';
			  
			  
			  }else if($Array['aspectostecnicos']<=94.99&& $Array['aspectostecnicos']>=90 ){
				  
				  $color1 = 'style="background-color:green;color:black;"';
				
				  
			  }else if($Array['aspectostecnicos']<=89.99&& $Array['aspectostecnicos']>=80 ){
				  
				   $color1 = 'style="background-color:yellow;color:black"';
			
				  
			  }else if($Array['aspectostecnicos']<=79.99&& $Array['aspectostecnicos']>=70 ){
				  
				   $color1 = 'style="background-color:orange;color:black"';
				
				  
			  }else if($Array['aspectostecnicos']<=69.99&& $Array['aspectostecnicos']>=30 ){
				  
				   $color1 = 'style="background-color:red;color:black;"';
				
				  
			  }else if($Array['aspectostecnicos']<=29.99&& $Array['aspectostecnicos']>=0 ){
				  
				   $color1 = 'style="background-color:purple;color:white;"';
			
				  
			  }
			  
			  //negociacion
			  
			  if($Array['negociacion']<=100&& $Array['negociacion']>=95 ){
			  
			   $color2 = 'style="background-color:blue;color:white;"';
			
			  
			  }else if($Array['negociacion']<=94.99&& $Array['negociacion']>=90 ){
				  
				  $color2 = 'style="background-color:green;color:black;"';
	
				  
			  }else if($Array['negociacion']<=89.99&& $Array['negociacion']>=80 ){
				  
				   $color2 = 'style="background-color:yellow;color:black;"';
		
				  
			  }else if($Array['negociacion']<=79.99&& $Array['negociacion']>=70 ){
				  
				   $color2 = 'style="background-color:orange;color:black;"';

				  
			  }else if($Array['negociacion']<=69.99&& $Array['negociacion']>=30 ){
				  
				   $color2 = 'style="background-color:red;color:black;"';
				
				  
			  }else if($Array['negociacion']<=29.99&& $Array['negociacion']>=0 ){
				  
				   $color2 = 'style="background-color:purple;color:white;"';
				
				  
			  }
			  
			  //calidad
			  
			   if($Array['calidad']<=100&& $Array['calidad']>=95 ){
			  
			   $color3 = 'style="background-color:blue;color:white;"';

			  
			  }else if($Array['calidad']<=94.99&& $Array['calidad']>=90 ){
				  
				  $color3 = 'style="background-color:green;color:black;"';
			
				  
			  }else if($Array['calidad']<=89.99&& $Array['calidad']>=80 ){
				  
				   $color3 = 'style="background-color:yellow;color:black;"';
				   
				  
			  }else if($Array['calidad']<=79.99&& $Array['calidad']>=70 ){
				  
				   $color3 = 'style="background-color:orange;color:black;"';
	
				  
			  }else if($Array['calidad']<=69.99&& $Array['calidad']>=30 ){
				  
				   $color3 = 'style="background-color:red;color:black;"';
			
				  
			  }else if($Array['calidad']<=29.99&& $Array['calidad']>=0 ){
				  
				   $color3 = 'style="background-color:purple;color:white;"';
		
				  
			  }
				  
				  //calificacion llamada
				  
				  
				   if($Array['calificacionllamada']<=100&& $Array['calificacionllamada']>=95 ){
			  
			   $color4 = 'style="background-color:blue;color:white;"';
			
			  
			  }else if($Array['calificacionllamada']<=94.99&& $Array['calificacionllamada']>=90 ){
				  
				  $color4 = 'style="background-color:green;color:black;"';
				
				  
			 }else if($Array['calificacionllamada']<=89.99&& $Array['calificacionllamada']>=80 ){
				  
				   $color4 = 'style="background-color:yellow;color:black;"';
			
				  
			  }else if($Array['calificacionllamada']<=79.99&& $Array['calificacionllamada']>=70 ){
				  
				   $color4 = 'style="background-color:orange;color:black;"';
				
				  
			  }else if($Array['calificacionllamada']<=69.99&& $Array['calificacionllamada']>=30 ){
				  
				   $color4 = 'style="background-color:red;color:black;"';
		
				  
			  }else if($Array['calificacionllamada']<=29.99&& $Array['calificacionllamada']>=0 ){
				  
				   $color4 = 'style="background-color:purple;color:white;"';
			
				  
			  }
				  
			  
			  $table .='<tr id="calif">';
			  $table .='<th nowrap>'.$Array['nombrecompleto'].'</th>';
			  $table .='<th '.$color1.'  nowrap id="aspectostecnicos'.$aspectostecnicos.'">'.$Array['aspectostecnicos'].'</th>';
			  $table .='<th '.$color2.'  nowrap id="negociacion'.$negociacion.'" >'.$Array['negociacion'].'</th>';
			  $table .='<th '.$color3.'  nowrap id="calidad'.$calidad.'" >'.$Array['calidad'].'</th>';
			  $table .='<th '.$color4.'  nowrap id="calificacionllamada'.$calificacionllamada.'" >'.round($Array['calificacionllamada']).'</th>';
			  $table .='<th nowrap ><button id="btn_replica'.$count.'"  dataID="'.utf8_encode($Array['hora_calificacion']).'" onclick="modal_replica('.$count.')"   data-toggle="modal" data-target="#ModalReplica" >R</button></th>';
			  

              			  $TotalAsp += $Array['aspectostecnicos'];
				          $TotalNeg += $Array['negociacion'];
						  $TotalCal += $Array['calidad'];
						  $TotalTot += $Array['calificacionllamada'];
						  $NombreJefe = $Array['nombrejefe'];
			  
			              
			
			  }
			  
			  $A = $TotalAsp/$count;
			  $B = $TotalNeg/$count;
			  $C = $TotalCal/$count;
			  $D = $TotalTot/$count;
			  
	
			  
			  if($A<=100 && $A>=95 ){
			  
			   $color5 = 'style="background-color:blue;color:white;"';
			  
			  
			  }else if($A <=94.99 && $A>=90 ){
				  
				  $color5 = 'style="background-color:green;color:black;"';
				
				  
			  }else if($A <=89.99 && $A>=80 ){
				  
				   $color5 = 'style="background-color:yellow;color:black"';
			
				  
			  }else if($A<=79.99 && $A>=70 ){
				  
				   $color5 = 'style="background-color:orange;color:black"';
				
				  
			  }else if($A<=69.99 && $A>=30 ){
				  
				   $color5 = 'style="background-color:red;color:black;"';
				
				  
			  }else if($A<=29.99 && $A>=0 ){
				  
				   $color5 = 'style="background-color:purple;color:white;"';
			
				  
			  }
			  
			  //negociacion
			  
			  if($B<=100 && $B>=95 ){
			  
			   $color6 = 'style="background-color:blue;color:white;"';
			
			  
			  }else if($B<=94.99 && $B>=90 ){
				  
				  $color6 = 'style="background-color:green;color:black;"';
	
				  
			  }else if($B<=89.99 && $B>=80 ){
				  
				   $color6 = 'style="background-color:yellow;color:black;"';
		
				  
			  }else if($B<=79.99 && $B>=70 ){
				  
				   $color6 = 'style="background-color:orange;color:black;"';

				  
			  }else if($B<=69.99 && $B>=30 ){
				  
				   $color6 = 'style="background-color:red;color:black;"';
				
				  
			  }else if($B<=29.99 && $B>=0 ){
				  
				   $color6 = 'style="background-color:purple;color:white;"';
				
				  
			  }
			  
			  //calidad
			  
			   if($C<=100 && $C>=95 ){
			  
			   $color7 = 'style="background-color:blue;color:white;"';

			  
			  }else if($C<=94.99 && $C>=90 ){
				  
				  $color7 = 'style="background-color:green;color:black;"';
			
				  
			  }else if($C<=89.99 && $C>=80 ){
				  
				   $color7 = 'style="background-color:yellow;color:black;"';
				   
				  
			  }else if($C<=79.99 && $C>=70 ){
				  
				   $color7 = 'style="background-color:orange;color:black;"';
	
				  
			  }else if($C<=69.99 && $C>=30 ){
				  
				   $color7 = 'style="background-color:red;color:black;"';
			
				  
			  }else if($C<=29.99 && $C>=0 ){
				  
				   $color7 = 'style="background-color:purple;color:white;"';
		
				  
			  }
				  
				  //calificacion llamada
				  
				  
		      if($D<=100 && $D>=95 ){
			  
			   $color8 = 'style="background-color:blue;color:white;"';
			
			  
			  }else if($D<=94.99 && $D>=90 ){
				  
				  $color8 = 'style="background-color:green;color:black;"';
				
				  
			 }else if($D<=89.99 && $D>=80 ){
				  
				   $color8 = 'style="background-color:yellow;color:black;"';
			
				  
			  }else if($D<=79.99 && $D>=70 ){
				  
				   $color8 = 'style="background-color:orange;color:black;"';
				
				  
			  }else if($D<=69.99 && $D>=30 ){
				  
				   $color8 = 'style="background-color:red;color:black;"';
		
				  
			  }else if($D<=29.99 && $D>=0 ){
				  
				   $color8 = 'style="background-color:purple;color:white;"';
			
				  
			  }
			  
			  
			  
			  $table.='<br></br>';
              $table.='<tr id="calif_jefe">';
              $table.='<th  nowrap  >JEFE:'.$NombreJefe.'</th>';
			  $table.='<th '.$color5.' nowrap>'.round($A).'</th>';
			  $table.='<th '.$color6.' nowrap>'.round($B).'</th>';
			  $table.='<th '.$color7.' nowrap>'.round($C).'</th>';
			  $table.='<th '.$color8.' nowrap>'.round($D).'</th>';
			  $table.='<tr></tr>';
			  
			  $table.='</tr>';
			  $table.='</tbody>';
		      $table.='</table>';
			  $table .='</div>';
			  

			}else{

                $estado  = -200;
				$mensaje = "No se encontro información de ejecutivo";

			}			
			
			
			
		}else{
			
			$estado  = -100;
			$mensaje = pg_last_error($conexion)." ".$sQuery;
			
			
		}
		pg_close($conexion);
	    $salidaJSON = array('estado'=>$estado, 'table'=>$table , 'mensaje'=>$mensaje ,'query'=>$sQuery);
	    print json_encode($salidaJSON);
		
		
		
		
		
		
	}
	
	function llenarTablaSemaforoSemanal()
	{
		$numEmpleado = $_POST['numempleado'];
		$deFecha = $_POST['defecha'];
		$aFecha =  $_POST['afecha'];
		$nomJefe  = $_POST['nomjefe'];
		$centro = $_POST['centro'];
		
		
		$conexion = conectaBD_128_catalogoempleados();
		
		$estado = 0;
		$mensaje = "";
		$table = "";
		$titleTable = "SEMAFORO";
		
		if(empty($centro))
		{
			
		 $sQuery = " SELECT numeroempleado,nombrecompleto,minimo1,certificado1,minimo2,certificado2,minimo3,certificado3,nombrejefe from consulta_calificaciones where numeroempleado='$numEmpleado' and fecha_calificacion between '$deFecha' and '$aFecha' ";
	
		}else if(empty($numEmpleado))
		{

	     $sQuery = " SELECT numeroempleado,nombrecompleto,minimo1,certificado1,minimo2,certificado2,minimo3,certificado3,nombrejefe from consulta_calificaciones where centro='$centro' and fecha_calificacion between '$deFecha' and '$aFecha' ";
          
        }		 
	
	
	   $rs = pg_query($sQuery);
	   
		if($rs){
			
		    
			$campos = pg_num_rows($rs);
			if($campos>0)
			{
				
			  $count = 0;
			  $aspectostecnicos = 0;
		      $negociacion = 0;
		      $calidad = 0;
		      $calificacionllamada = 0;
			  
			  $color1 = "";
			  $color2 = "";
			  $color3 = "";
			  $color4 = "";
			  $color5 = "";
			  $color6 = "";
			  
			  $total_min1 = "";
			    $total_min2 = "";
				  $total_min3 = "";
				   $total_cer1 = "";
				    $total_cer2 = "";
				      $total_cer3 = "";
					  
					  $M1 = "";
					  $M2 = "";
					  $M3 = "";
					  $C1 = "";
					  $C2 = "";
					  $C3 = "";
					  
			  
			    
              $estado = 1;
			  $mensaje = "OK";
			  $table .= '<div id="concentradoxsemana">';
			  $table .='<table class="table table-striped table-bordered table-sm">';
			  $table .='<caption><h4>'.$titleTable.'</h4></caption>';
			  $table .='<thead>';
			  $table.='<tr id="table_semanal">';
			  $table.='<th rowspan="2"># De Empleado</td>';
			  $table.='<th rowspan="2" >Ejecutivo</th>';
			  $table.='<th colspan="2" >Aspectos Tecnicos</th>';
			  $table.='<th colspan="2">Negociacion</th>';
			  $table.='<th colspan="2">Dialogo Calido</th>';
			 
			  $table.='</tr>';
			  
			  $table.='<tr>';
			  $table.='<th id="min1" >Minimo</th>';
			  $table.='<th id="cert1" >Certificado</th>';
			  $table.='<th id="min2" >Minimo</th>';
			  $table.='<th id="cert2" >Certificado</th>';
			  $table.='<th id="min3" >Minimo</th>';
			  $table.='<th id="cert3" >Certificado</th>';
			  $table.='</tr>';
			  
			  $table.='</thead>';
			  $table.='<tbody>';
			  
			  while($Array=pg_fetch_array($rs))
			  {
				  
				   
				  
				  
				  if($Array['minimo1']<=100 and $Array['minimo1']>=95 ){
			  
			   $color1 = 'style="background-color:blue;color:white;"';
			
			  
			  }else if($Array['minimo1']<=94.99 and $Array['minimo1']>=90 ){
				  
				  $color1 = 'style="background-color:green;color:black;"';
		
				  
			  }else if($Array['minimo1']<=89.99 and $Array['minimo1']>=80 ){
				  
				   $color1 = 'style="background-color:yellow;color:black;"';
			
				  
			  }else if($Array['minimo1']<=79.99 and $Array['minimo1']>=70 ){
				  
				   $color1 = 'style="background-color:orange;color:black;"';
			
				  
			  }else if($Array['minimo1']<=69.99 and $Array['minimo1']>=30 ){
				  
				   $color1 = 'style="background-color:red;color:black;"';
			
				  
			  }else if($Array['minimo1']<=29.99 and $Array['minimo1']>=0 ){
				  
				   $color1 = 'style="background-color:purple;color:white;"';
			
				  
			  }
			  
			  //negociacion
			  
			  if($Array['certificado1']<=100 and $Array['certificado1']>=95 ){
			  
			    $color2 = 'style="background-color:blue;color:white;"';
			
			  
			  }else if($Array['certificado1']<=94.99 and $Array['certificado1']>=90 ){
				  
				  $color2 = 'style="background-color:green;color:black;"';
	
				  
			  }else if($Array['certificado1']<=89.99 and $Array['certificado1']>=80 ){
				  
				    $color = 'style="background-color:yellow;color:black;"';
			
			  }else if($Array['certificado1']<=79.99 and $Array['certificado1']>=70 ){
				  
				   $color2 = 'style="background-color:orange;color:black;"';
				
				  
			  }else if($Array['certificado1']<=69.99 and $Array['certificado1']>=30 ){
				  
				    $color2 = 'style="background-color:red;color:black;"';
			
			  }else if($Array['certificado1']<=29.99 and $Array['certificado1']>=0 ){
				  
				    $color2 = 'style="background-color:purple;color:white;"';
				
				  
			  }
			  
			  //calidad
			  
			   if($Array['minimo2']<=100 and $Array['minimo2']>=95 ){
			  
			   $color3 = 'style="background-color:blue;color:white;"';
		
			  
			  }else if($Array['minimo2']<=94.99 and $Array['minimo2']>=90 ){
				  
				  $color3 = 'style="background-color:green;color:black;"';
			
			  }else if($Array['minimo2']<=89.99 and $Array['minimo2']>=80 ){
				  
				   $color3 = 'style="background-color:yellow;color:black"';
				
			  }else if($Array['minimo2']<=79.99 and $Array['minimo2']>=70 ){
				  
				   $color3 = 'style="background-color:orange;color:black;"';
				
				  
			  }else if($Array['minimo2']<=69.99 and $Array['minimo2']>=30 ){
				  
				   $color3 = 'style="background-color:red;"color:black;';
			
				  
			  }else if($Array['minimo2']<=29.99 and $Array['minimo2']>=0 ){
				  
				   $color3 = 'style="background-color:purple;color:white;"';
		
			  }
				  
				  //calificacion llamada
				  
				  
				   if($Array['certificado2']<=100 and $Array['certificado2']>=95 ){
			  
			   $color4 = 'style="background-color:blue;color:white;"';
		
			  
			  }else if($Array['certificado2']<=94.99 and $Array['certificado2']>=90 ){
				  
				  $color4 = 'style="background-color:green;color:black;"';
			
				  
			 }else if($Array['certificado2']<=89.99 and $Array['certificado2']>=80 ){
				  
				   $color4 = 'style="background-color:yellow;color:black;"';
		
				  
			  }else if($Array['certificado2']<=79.99 and $Array['certificado2']>=70 ){
				  
				   $color4 = 'style="background-color:orange;color:black;"';
		
				  
			  }else if($Array['certificado2']<=69.99 and $Array['certificado2']>=30 ){
				  
				   $color4 = 'style="background-color:red;color:black;"';
			
				  
			  }else if($Array['certificado2']<=29.99 and $Array['certificado2']>=0 ){
				  
				   $color4 = 'style="background-color:purple;color:white;"';
			
			  }
			  
			  	  //calidad
			  
			   if($Array['minimo3']<=100 and $Array['minimo3']>=95 ){
			  
			   $color5 = 'style="background-color:blue;color:white;"';
		
			  
			  }else if($Array['minimo3']<=94.99 and $Array['minimo3']>=90 ){
				  
				  $color5 = 'style="background-color:green;color:black;"';
				
				  
			  }else if($Array['minimo3']<=89.99 and $Array['minimo3']>=80 ){
				  
				   $color5 = 'style="background-color:yellow;color:black;"';
			
				  
			  }else if($Array['minimo3']<=79.99 and $Array['minimo3']>=70 ){
				  
				   $color5 = 'style="background-color:orange;color:black;"';
		
				  
			  }else if($Array['minimo3']<=69.99 and $Array['minimo3']>=30 ){
				  
				   $color5 = 'style="background-color:red;color:black;"';
	
				  
			  }else if($Array['minimo3']<=29.99 and $Array['minimo3']>=0 ){
				  
				   $color5 = 'style="background-color:purple;color:white;"';
				 
				  
			  }
				  
				  //calificacion llamada
				  
				  
				if($Array['certificado3']<=100 and $Array['certificado3']>=95 ){
			  
			   $color6 = 'style="background-color:blue;color:white;"';
			 
			  
			  }else if($Array['certificado3']<=94.99 and $Array['certificado3']>=90 ){
				  
				  $color6 = 'style="background-color:green;color:black;"';
				 
				  
			 }else if($Array['certificado3']<=89.99 and $Array['certificado3']>=80 ){
				  
				   $color6 = 'style="background-color:yellow;color:black;"';
				  
				  
			  }else if($Array['certificado3']<=79.99 and $Array['certificado3']>=70 ){
				  
				   $color6 = 'style="background-color:orange;color:black;"';
				  
				  
			  }else if($Array['certificado3']<=69.99 and $Array['certificado3']>=30 ){
				  
				   $color6 = 'style="background-color:red;color:black;"';
				  
				  
			  }else if($Array['certificado3']<=29.99 and $Array['certificado3']>=0 ){
				  
				   $color6 = 'style="background-color:purple;color:white;"';
				   
				  
			  }
				  
				$count++; 
				  
				   $table .='<tr id="calif">';
			  $table .='<th nowrap  >'.$Array['numeroempleado'].'</th>';
			  $table .='<th nowrap  >'.$Array['nombrecompleto'].'</th>';
			  $table .='<th nowrap '.$color1.'  >'.$Array['minimo1'].'</th>';
			  $table .='<th nowrap '.$color2.'  >'.$Array['certificado1'].'</th>';
			  $table .='<th nowrap '.$color3.'  >'.$Array['minimo2'].'</th>';
			  $table .='<th nowrap '.$color4.'  >'.$Array['certificado2'].'</th>';
			  $table .='<th nowrap '.$color5.'  >'.$Array['minimo3'].'</th>';
			  $table .='<th nowrap '.$color6.'  >'.$Array['certificado3'].'</th>';
			  
		
			  			   $NombreJefe = $Array['nombrejefe'];
		
		                $total_min1 += $Array['minimo1'];
						$total_cer1 += $Array['certificado1'];
						$total_min2 += $Array['minimo2'];
						$total_cer2 += $Array['certificado2'];
						$total_min3 += $Array['minimo3'];
						$total_cer3 += $Array['certificado3'];
				  
				  
			  }
			  
			   if($M1<=100 && $M1>=95 ){
			  
			   $color5 = 'style="background-color:blue;color:white;"';
			  
			  
			  }else if($M1 <=94.99 && $M1>=90 ){
				  
				  $color5 = 'style="background-color:green;color:black;"';
				
				  
			  }else if($M1 <=89.99 && $M1>=80 ){
				  
				   $color5 = 'style="background-color:yellow;color:black"';
			
				  
			  }else if($M1<=79.99 && $M1>=70 ){
				  
				   $color5 = 'style="background-color:orange;color:black"';
				
				  
			  }else if($M1<=69.99 && $M1>=30 ){
				  
				   $color5 = 'style="background-color:red;color:black;"';
				
				  
			  }else if($M1<=29.99 && $M1>=0 ){
				  
				   $color5 = 'style="background-color:purple;color:white;"';
			
				  
			  }
			  
			  //negociacion
			  
			  if($C1<=100 && $C1>=95 ){
			  
			   $color6 = 'style="background-color:blue;color:white;"';
			
			  
			  }else if($C1<=94.99 && $C1>=90 ){
				  
				  $color6 = 'style="background-color:green;color:black;"';
	
				  
			  }else if($C1<=89.99 && $C1>=80 ){
				  
				   $color6 = 'style="background-color:yellow;color:black;"';
		
				  
			  }else if($C1<=79.99 && $C1>=70 ){
				  
				   $color6 = 'style="background-color:orange;color:black;"';

				  
			  }else if($C1<=69.99 && $C1>=30 ){
				  
				   $color6 = 'style="background-color:red;color:black;"';
				
				  
			  }else if($C1<=29.99 && $C1>=0 ){
				  
				   $color6 = 'style="background-color:purple;color:white;"';
				
				  
			  }
			  
			  //calidad
			  
			   if($M2<=100 && $M2>=95 ){
			  
			   $color7 = 'style="background-color:blue;color:white;"';

			  
			  }else if($M2<=94.99 && $M2>=90 ){
				  
				  $color7 = 'style="background-color:green;color:black;"';
			
				  
			  }else if($M2<=89.99 && $M2>=80 ){
				  
				   $color7 = 'style="background-color:yellow;color:black;"';
				   
				  
			  }else if($M2<=79.99 && $M2>=70 ){
				  
				   $color7 = 'style="background-color:orange;color:black;"';
	
				  
			  }else if($M2<=69.99 && $M2>=30 ){
				  
				   $color7 = 'style="background-color:red;color:black;"';
			
				  
			  }else if($M2<=29.99 && $M2>=0 ){
				  
				   $color7 = 'style="background-color:purple;color:white;"';
		
				  
			  }
				  
				  //calificacion llamada
				  
				  
		      if($C2<=100 && $C2>=95 ){
			  
			   $color8 = 'style="background-color:blue;color:white;"';
			
			  
			  }else if($C2<=94.99 && $C2>=90 ){
				  
				  $color8 = 'style="background-color:green;color:black;"';
				
				  
			 }else if($C2<=89.99 && $C2>=80 ){
				  
				   $color8 = 'style="background-color:yellow;color:black;"';
			
				  
			  }else if($C2<=79.99 && $C2>=70 ){
				  
				   $color8 = 'style="background-color:orange;color:black;"';
				
				  
			  }else if($C2<=69.99 && $C2>=30 ){
				  
				   $color8 = 'style="background-color:red;color:black;"';
		
				  
			  }else if($C2<=29.99 && $C2>=0 ){
				  
				   $color8 = 'style="background-color:purple;color:white;"';
			
				  
			  }
			  
			  		      if($M3<=100 && $M3>=95 ){
			  
			   $color9 = 'style="background-color:blue;color:white;"';
			
			  
			  }else if($M3<=94.99 && $M3>=90 ){
				  
				  $color9 = 'style="background-color:green;color:black;"';
				
				  
			 }else if($M3<=89.99 && $M3>=80 ){
				  
				   $color9 = 'style="background-color:yellow;color:black;"';
			
				  
			  }else if($M3<=79.99 && $M3>=70 ){
				  
				   $color9 = 'style="background-color:orange;color:black;"';
				
				  
			  }else if($M3<=69.99 && $M3>=30 ){
				  
				   $color9 = 'style="background-color:red;color:black;"';
		
				  
			  }else if($M3<=29.99 && $M3>=0 ){
				  
				   $color9 = 'style="background-color:purple;color:white;"';
			
				  
			  }
			  
			  if($C3<=100 && $C3>=95 ){
			  
			   $color10 = 'style="background-color:blue;color:white;"';
			
			  
			  }else if($C3<=94.99 && $C3>=90 ){
				  
				  $color10 = 'style="background-color:green;color:black;"';
				
				  
			 }else if($C3<=89.99 && $C3>=80 ){
				  
				   $color10 = 'style="background-color:yellow;color:black;"';
			
				  
			  }else if($C3<=79.99 && $C3>=70 ){
				  
				   $color10 = 'style="background-color:orange;color:black;"';
				
				  
			  }else if($C3<=69.99 && $C3>=30 ){
				  
				   $color10 = 'style="background-color:red;color:black;"';
		
				  
			  }else if($C3<=29.99 && $C3>=0 ){
				  
				   $color10 = 'style="background-color:purple;color:white;"';
			
				  
			  }
			  
			  
			  $M1 = $total_min1 / $count;
			  $C1 = $total_cer1 / $count;
			  $M2 = $total_min2 / $count;
			  $C2 = $total_cer2 / $count;
			  $M3 = $total_min3 / $count;
			  $C3 = $total_cer3 / $count;
			  

			  
			  $table .='<br></br>';
			  $table .='<tr>';
			  $table .='<th  nowrap>JEFE</th>';
			  $table .='<th  nowrap >'.$NombreJefe.'</th>';
			  $table .='<th '.$color5.' nowrap >'.round($M1).'</th>';
			  $table .='<th '.$color6.' nowrap>'.round($C1).'</th>';
			  $table .='<th '.$color7.' nowrap>'.round($M2).'</th>';
			  $table .='<th '.$color8.' nowrap>'.round($C2).'</th>';
			  $table .='<th '.$color9.' nowrap>'.round($M3).'</th>';
			  $table .='<th '.$color10.' nowrap>'.round($C3).'</th>';
			  $table .='<th nowrap>Replica</th>';
			  $table .='</tr>';
			  
			  
			   $table.='</tr>';
			  $table.='</tbody>';
		      $table.='</table>';
			  $table .='</div>';
			  

			}else{

                $estado  = -200;
				$mensaje = "No se encontro información de ejecutivo";

			}			
			
			
			
		}else{
			
			$estado  = -100;
			$mensaje = pg_last_error($conexion)." ".$sQuery;
			
			
		}
		pg_close($conexion);
	    $salidaJSON = array('estado'=>$estado, 'table'=>$table , 'mensaje'=>$mensaje ,'query'=>$sQuery);
	    print json_encode($salidaJSON);
				
				
				
			}
			
	function llenarTablaSemaforoMensual(){
		
		$numEmpleado = $_POST['numempleado'];
		$deFecha = $_POST['defecha'];
		$aFecha =  $_POST['afecha'];
		$nomJefe  = $_POST['nomjefe'];
		$centro = $_POST['centro'];
		
		
		$conexion = conectaBD_128_catalogoempleados();
		
		$estado = 0;
		$mensaje = "";
		$table = "";
		$titleTable = "SEMAFORO";
		
		if(empty($centro))
		{
			
		 $sQuery = " SELECT numeroempleado,nombrecompleto,minimo1,certificado1,minimo2,certificado2,minimo3,certificado3,nombrejefe from consulta_calificaciones where numeroempleado='$numEmpleado' and fecha_calificacion between '$deFecha' and '$aFecha' ";
	
		}else if(empty($numEmpleado))
		{

	     $sQuery = " SELECT numeroempleado,nombrecompleto,minimo1,certificado1,minimo2,certificado2,minimo3,certificado3,nombrejefe from consulta_calificaciones where centro='$centro' and fecha_calificacion between '$deFecha' and '$aFecha' ";
          
        }		 
	
	
	   $rs = pg_query($sQuery);
	   
		if($rs){
			
		    
			$campos = pg_num_rows($rs);
			if($campos>0)
			{
				
			  $count = 0;
			  $aspectostecnicos = 0;
		      $negociacion = 0;
		      $calidad = 0;
		      $calificacionllamada = 0;
			  
			  $color1 = "";
			  $color2 = "";
			  $color3 = "";
			  $color4 = "";
			  $color5 = "";
			  $color6 = "";
			  
			  $total_min1 = "";
			    $total_min2 = "";
				  $total_min3 = "";
				   $total_cer1 = "";
				    $total_cer2 = "";
				      $total_cer3 = "";
					  
					  $M1 = "";
					  $M2 = "";
					  $M3 = "";
					  $C1 = "";
					  $C2 = "";
					  $C3 = "";
					  
			  
			    
              $estado = 1;
			  $mensaje = "OK";
			  $table .= '<div id="concentradoxsemana">';
			  $table .='<table class="table table-striped table-bordered table-sm">';
			  $table .='<caption><h4>'.$titleTable.'</h4></caption>';
			  $table .='<thead>';
			  $table.='<tr id="table_semanal">';
			  $table.='<th rowspan="2"># De Empleado</td>';
			  $table.='<th rowspan="2" >Ejecutivo</th>';
			  $table.='<th colspan="2" >Aspectos Tecnicos</th>';
			  $table.='<th colspan="2">Negociacion</th>';
			  $table.='<th colspan="2">Dialogo Calido</th>';
			 
			  $table.='</tr>';
			  
			  $table.='<tr>';
			  $table.='<th id="min1" >Minimo</th>';
			  $table.='<th id="cert1" >Certificado</th>';
			  $table.='<th id="min2" >Minimo</th>';
			  $table.='<th id="cert2" >Certificado</th>';
			  $table.='<th id="min3" >Minimo</th>';
			  $table.='<th id="cert3" >Certificado</th>';
			  $table.='</tr>';
			  
			  $table.='</thead>';
			  $table.='<tbody>';
			  
			  while($Array=pg_fetch_array($rs))
			  {
				  
				   
				  
				  
				  if($Array['minimo1']<=100 and $Array['minimo1']>=95 ){
			  
			   $color1 = 'style="background-color:blue;color:white;"';
			
			  
			  }else if($Array['minimo1']<=94.99 and $Array['minimo1']>=90 ){
				  
				  $color1 = 'style="background-color:green;color:black;"';
		
				  
			  }else if($Array['minimo1']<=89.99 and $Array['minimo1']>=80 ){
				  
				   $color1 = 'style="background-color:yellow;color:black;"';
			
				  
			  }else if($Array['minimo1']<=79.99 and $Array['minimo1']>=70 ){
				  
				   $color1 = 'style="background-color:orange;color:black;"';
			
				  
			  }else if($Array['minimo1']<=69.99 and $Array['minimo1']>=30 ){
				  
				   $color1 = 'style="background-color:red;color:black;"';
			
				  
			  }else if($Array['minimo1']<=29.99 and $Array['minimo1']>=0 ){
				  
				   $color1 = 'style="background-color:purple;color:white;"';
			
				  
			  }
			  
			  //negociacion
			  
			  if($Array['certificado1']<=100 and $Array['certificado1']>=95 ){
			  
			    $color2 = 'style="background-color:blue;color:white;"';
			
			  
			  }else if($Array['certificado1']<=94.99 and $Array['certificado1']>=90 ){
				  
				  $color2 = 'style="background-color:green;color:black;"';
	
				  
			  }else if($Array['certificado1']<=89.99 and $Array['certificado1']>=80 ){
				  
				    $color = 'style="background-color:yellow;color:black;"';
			
			  }else if($Array['certificado1']<=79.99 and $Array['certificado1']>=70 ){
				  
				   $color2 = 'style="background-color:orange;color:black;"';
				
				  
			  }else if($Array['certificado1']<=69.99 and $Array['certificado1']>=30 ){
				  
				    $color2 = 'style="background-color:red;color:black;"';
			
			  }else if($Array['certificado1']<=29.99 and $Array['certificado1']>=0 ){
				  
				    $color2 = 'style="background-color:purple;color:white;"';
				
				  
			  }
			  
			  //calidad
			  
			   if($Array['minimo2']<=100 and $Array['minimo2']>=95 ){
			  
			   $color3 = 'style="background-color:blue;color:white;"';
		
			  
			  }else if($Array['minimo2']<=94.99 and $Array['minimo2']>=90 ){
				  
				  $color3 = 'style="background-color:green;color:black;"';
			
			  }else if($Array['minimo2']<=89.99 and $Array['minimo2']>=80 ){
				  
				   $color3 = 'style="background-color:yellow;color:black"';
				
			  }else if($Array['minimo2']<=79.99 and $Array['minimo2']>=70 ){
				  
				   $color3 = 'style="background-color:orange;color:black;"';
				
				  
			  }else if($Array['minimo2']<=69.99 and $Array['minimo2']>=30 ){
				  
				   $color3 = 'style="background-color:red;"color:black;';
			
				  
			  }else if($Array['minimo2']<=29.99 and $Array['minimo2']>=0 ){
				  
				   $color3 = 'style="background-color:purple;color:white;"';
		
			  }
				  
				  //calificacion llamada
				  
				  
				   if($Array['certificado2']<=100 and $Array['certificado2']>=95 ){
			  
			   $color4 = 'style="background-color:blue;color:white;"';
		
			  
			  }else if($Array['certificado2']<=94.99 and $Array['certificado2']>=90 ){
				  
				  $color4 = 'style="background-color:green;color:black;"';
			
				  
			 }else if($Array['certificado2']<=89.99 and $Array['certificado2']>=80 ){
				  
				   $color4 = 'style="background-color:yellow;color:black;"';
		
				  
			  }else if($Array['certificado2']<=79.99 and $Array['certificado2']>=70 ){
				  
				   $color4 = 'style="background-color:orange;color:black;"';
		
				  
			  }else if($Array['certificado2']<=69.99 and $Array['certificado2']>=30 ){
				  
				   $color4 = 'style="background-color:red;color:black;"';
			
				  
			  }else if($Array['certificado2']<=29.99 and $Array['certificado2']>=0 ){
				  
				   $color4 = 'style="background-color:purple;color:white;"';
			
			  }
			  
			  	  //calidad
			  
			   if($Array['minimo3']<=100 and $Array['minimo3']>=95 ){
			  
			   $color5 = 'style="background-color:blue;color:white;"';
		
			  
			  }else if($Array['minimo3']<=94.99 and $Array['minimo3']>=90 ){
				  
				  $color5 = 'style="background-color:green;color:black;"';
				
				  
			  }else if($Array['minimo3']<=89.99 and $Array['minimo3']>=80 ){
				  
				   $color5 = 'style="background-color:yellow;color:black;"';
			
				  
			  }else if($Array['minimo3']<=79.99 and $Array['minimo3']>=70 ){
				  
				   $color5 = 'style="background-color:orange;color:black;"';
		
				  
			  }else if($Array['minimo3']<=69.99 and $Array['minimo3']>=30 ){
				  
				   $color5 = 'style="background-color:red;color:black;"';
	
				  
			  }else if($Array['minimo3']<=29.99 and $Array['minimo3']>=0 ){
				  
				   $color5 = 'style="background-color:purple;color:white;"';
				 
				  
			  }
				  
				  //calificacion llamada
				  
				  
				if($Array['certificado3']<=100 and $Array['certificado3']>=95 ){
			  
			   $color6 = 'style="background-color:blue;color:white;"';
			 
			  
			  }else if($Array['certificado3']<=94.99 and $Array['certificado3']>=90 ){
				  
				  $color6 = 'style="background-color:green;color:black;"';
				 
				  
			 }else if($Array['certificado3']<=89.99 and $Array['certificado3']>=80 ){
				  
				   $color6 = 'style="background-color:yellow;color:black;"';
				  
				  
			  }else if($Array['certificado3']<=79.99 and $Array['certificado3']>=70 ){
				  
				   $color6 = 'style="background-color:orange;color:black;"';
				  
				  
			  }else if($Array['certificado3']<=69.99 and $Array['certificado3']>=30 ){
				  
				   $color6 = 'style="background-color:red;color:black;"';
				  
				  
			  }else if($Array['certificado3']<=29.99 and $Array['certificado3']>=0 ){
				  
				   $color6 = 'style="background-color:purple;color:white;"';
				   
				  
			  }
				  
				$count++; 
				  
				   $table .='<tr id="calif">';
			  $table .='<th nowrap  >'.$Array['numeroempleado'].'</th>';
			  $table .='<th nowrap  >'.$Array['nombrecompleto'].'</th>';
			  $table .='<th nowrap '.$color1.'  >'.$Array['minimo1'].'</th>';
			  $table .='<th nowrap '.$color2.'  >'.$Array['certificado1'].'</th>';
			  $table .='<th nowrap '.$color3.'  >'.$Array['minimo2'].'</th>';
			  $table .='<th nowrap '.$color4.'  >'.$Array['certificado2'].'</th>';
			  $table .='<th nowrap '.$color5.'  >'.$Array['minimo3'].'</th>';
			  $table .='<th nowrap '.$color6.'  >'.$Array['certificado3'].'</th>';
			  
		
			  			   $NombreJefe = $Array['nombrejefe'];
		
		                $total_min1 += $Array['minimo1'];
						$total_cer1 += $Array['certificado1'];
						$total_min2 += $Array['minimo2'];
						$total_cer2 += $Array['certificado2'];
						$total_min3 += $Array['minimo3'];
						$total_cer3 += $Array['certificado3'];
				  
				  
			  }
			  
			   if($M1<=100 && $M1>=95 ){
			  
			   $color5 = 'style="background-color:blue;color:white;"';
			  
			  
			  }else if($M1 <=94.99 && $M1>=90 ){
				  
				  $color5 = 'style="background-color:green;color:black;"';
				
				  
			  }else if($M1 <=89.99 && $M1>=80 ){
				  
				   $color5 = 'style="background-color:yellow;color:black"';
			
				  
			  }else if($M1<=79.99 && $M1>=70 ){
				  
				   $color5 = 'style="background-color:orange;color:black"';
				
				  
			  }else if($M1<=69.99 && $M1>=30 ){
				  
				   $color5 = 'style="background-color:red;color:black;"';
				
				  
			  }else if($M1<=29.99 && $M1>=0 ){
				  
				   $color5 = 'style="background-color:purple;color:white;"';
			
				  
			  }
			  
			  //negociacion
			  
			  if($C1<=100 && $C1>=95 ){
			  
			   $color6 = 'style="background-color:blue;color:white;"';
			
			  
			  }else if($C1<=94.99 && $C1>=90 ){
				  
				  $color6 = 'style="background-color:green;color:black;"';
	
				  
			  }else if($C1<=89.99 && $C1>=80 ){
				  
				   $color6 = 'style="background-color:yellow;color:black;"';
		
				  
			  }else if($C1<=79.99 && $C1>=70 ){
				  
				   $color6 = 'style="background-color:orange;color:black;"';

				  
			  }else if($C1<=69.99 && $C1>=30 ){
				  
				   $color6 = 'style="background-color:red;color:black;"';
				
				  
			  }else if($C1<=29.99 && $C1>=0 ){
				  
				   $color6 = 'style="background-color:purple;color:white;"';
				
				  
			  }
			  
			  //calidad
			  
			   if($M2<=100 && $M2>=95 ){
			  
			   $color7 = 'style="background-color:blue;color:white;"';

			  
			  }else if($M2<=94.99 && $M2>=90 ){
				  
				  $color7 = 'style="background-color:green;color:black;"';
			
				  
			  }else if($M2<=89.99 && $M2>=80 ){
				  
				   $color7 = 'style="background-color:yellow;color:black;"';
				   
				  
			  }else if($M2<=79.99 && $M2>=70 ){
				  
				   $color7 = 'style="background-color:orange;color:black;"';
	
				  
			  }else if($M2<=69.99 && $M2>=30 ){
				  
				   $color7 = 'style="background-color:red;color:black;"';
			
				  
			  }else if($M2<=29.99 && $M2>=0 ){
				  
				   $color7 = 'style="background-color:purple;color:white;"';
		
				  
			  }
				  
				  //calificacion llamada
				  
				  
		      if($C2<=100 && $C2>=95 ){
			  
			   $color8 = 'style="background-color:blue;color:white;"';
			
			  
			  }else if($C2<=94.99 && $C2>=90 ){
				  
				  $color8 = 'style="background-color:green;color:black;"';
				
				  
			 }else if($C2<=89.99 && $C2>=80 ){
				  
				   $color8 = 'style="background-color:yellow;color:black;"';
			
				  
			  }else if($C2<=79.99 && $C2>=70 ){
				  
				   $color8 = 'style="background-color:orange;color:black;"';
				
				  
			  }else if($C2<=69.99 && $C2>=30 ){
				  
				   $color8 = 'style="background-color:red;color:black;"';
		
				  
			  }else if($C2<=29.99 && $C2>=0 ){
				  
				   $color8 = 'style="background-color:purple;color:white;"';
			
				  
			  }
			  
			  		      if($M3<=100 && $M3>=95 ){
			  
			   $color9 = 'style="background-color:blue;color:white;"';
			
			  
			  }else if($M3<=94.99 && $M3>=90 ){
				  
				  $color9 = 'style="background-color:green;color:black;"';
				
				  
			 }else if($M3<=89.99 && $M3>=80 ){
				  
				   $color9 = 'style="background-color:yellow;color:black;"';
			
				  
			  }else if($M3<=79.99 && $M3>=70 ){
				  
				   $color9 = 'style="background-color:orange;color:black;"';
				
				  
			  }else if($M3<=69.99 && $M3>=30 ){
				  
				   $color9 = 'style="background-color:red;color:black;"';
		
				  
			  }else if($M3<=29.99 && $M3>=0 ){
				  
				   $color9 = 'style="background-color:purple;color:white;"';
			
				  
			  }
			  
			  if($C3<=100 && $C3>=95 ){
			  
			   $color10 = 'style="background-color:blue;color:white;"';
			
			  
			  }else if($C3<=94.99 && $C3>=90 ){
				  
				  $color10 = 'style="background-color:green;color:black;"';
				
				  
			 }else if($C3<=89.99 && $C3>=80 ){
				  
				   $color10 = 'style="background-color:yellow;color:black;"';
			
				  
			  }else if($C3<=79.99 && $C3>=70 ){
				  
				   $color10 = 'style="background-color:orange;color:black;"';
				
				  
			  }else if($C3<=69.99 && $C3>=30 ){
				  
				   $color10 = 'style="background-color:red;color:black;"';
		
				  
			  }else if($C3<=29.99 && $C3>=0 ){
				  
				   $color10 = 'style="background-color:purple;color:white;"';
			
				  
			  }
			  
			  
			  $M1 = $total_min1 / $count;
			  $C1 = $total_cer1 / $count;
			  $M2 = $total_min2 / $count;
			  $C2 = $total_cer2 / $count;
			  $M3 = $total_min3 / $count;
			  $C3 = $total_cer3 / $count;
			  

			  
			  $table .='<br></br>';
			  $table .='<tr>';
			  $table .='<th  nowrap>JEFE</th>';
			  $table .='<th  nowrap >'.$NombreJefe.'</th>';
			  $table .='<th '.$color5.' nowrap >'.round($M1).'</th>';
			  $table .='<th '.$color6.' nowrap>'.round($C1).'</th>';
			  $table .='<th '.$color7.' nowrap>'.round($M2).'</th>';
			  $table .='<th '.$color8.' nowrap>'.round($C2).'</th>';
			  $table .='<th '.$color9.' nowrap>'.round($M3).'</th>';
			  $table .='<th '.$color10.' nowrap>'.round($C3).'</th>';
			  $table .='<th nowrap>Replica</th>';
			  $table .='</tr>';
			  
			  
			   $table.='</tr>';
			  $table.='</tbody>';
		      $table.='</table>';
			  $table .='</div>';
			  

			}else{

                $estado  = -200;
				$mensaje = "No se encontro información de ejecutivo";

			}			
			
			
			
		}else{
			
			$estado  = -100;
			$mensaje = pg_last_error($conexion)." ".$sQuery;
			
			
		}
		pg_close($conexion);
	    $salidaJSON = array('estado'=>$estado, 'table'=>$table , 'mensaje'=>$mensaje ,'query'=>$sQuery);
	    print json_encode($salidaJSON);
		
		
		
		
	}
   	
			
	function ModalReplica(){

    $data = $_POST['dataID'];
	$empleado = $_POST['numempleado'];
	$select =$_POST['select'];
	$nomjefe = $_POST['nomjefe'];
	$centro  = $_POST['centro'];
	
	$conexion = conectaBD_128_catalogoempleados();
	$estado = 0;
    $mensaje = "";
	$table = "";

    	
	if($select === "ConcentradoDiario")
	{    
         if(empty($centro))

		 {
			 
		 $sQuery = " SELECT fecha_calificacion,hora_calificacion,nombrecompleto,observaciones,centro,replica,respuesta from consulta_calificaciones where  hora_calificacion='$data' and numeroempleado='$empleado' ";
		
		 }else if(empty($empleado))
		 {

         $sQuery = " SELECT fecha_calificacion,hora_calificacion,nombrecompleto,observaciones,centro,replica,respuesta from consulta_calificaciones where  hora_calificacion='$data' and centro='$centro' ";

         }	 
		 
		
	}else if($select === "SemaforoSemanal")
	{
		
		if(empty($centro))
		     
			 {
				 
				 $sQuery = " SELECT fecha_calificacion,hora_calificacion,nombrecompleto,observaciones,centro,replica,respuesta from consulta_calificaciones where  hora_calificacion='$data' and numeroempleado='$empleado' ";
				 
			 }
         else if(empty($empleado))
		 {

              $sQuery = " SELECT fecha_calificacion,hora_calificacion,nombrecompleto,observaciones,centro,replica,respuesta from consulta_calificaciones where  hora_calificacion='$data' and nombrejefe='$nomjefe' ";

		 }	 
		 
		
	}
	
	
   

    $rs = pg_query($sQuery);
	
	if($rs){
		
		
		$Array=pg_fetch_array($rs);
		
 	  $estado = 1;
	  $mensaje = "OK";
      $table .= '<div id="modalReplica" >';
	  $table .='<table class="table table-striped table-bordered table-sm" >';
	  $table .='<thead>';
	  $table.='<tr id="table_rep">';
	  $table.='<th rowspan="2">Fecha</td>';
	  $table.='<th rowspan="2" >Hora</th>';
	  $table.='<th rowspan="2" >Nombre del ejecutivo</th>';
	  $table.='<th rowspan="2">Centro</th>';
	  $table.='<th rowspan="2">Observaciones</th>';
	  $table.='<th rowspan="2">Replica</th>';
      $table.='<th rowspan="2">Respuesta</th>';	  
      $table.='</tr>';
	  $table.='</thead>';
	  $table.='<tbody>';
      
	   $table.='<tr id="datos_replica">';
              $table.='<th  nowrap  id="replica_fecha_cal">'.$Array['fecha_calificacion'].'</th>';
			  $table.='<th  nowrap id="replica_hora_cal">'.$Array['hora_calificacion'].'</th>';
			  $table.='<th  nowrap id="replica_nombrecompleto" >'.$Array['nombrecompleto'].'</th>';
			  $table.='<th  nowrap id="replica_nombrecompleto" >'.$Array['centro'].'</th>';
			  $table.='<th  nowrap><textarea name="textarea" rows="10" cols="30" disabled="true">'.$Array['observaciones'].'</textarea></th>';
			  $table.='<th  nowrap><textarea id="text_replica" name="textarea" rows="10" cols="10" disabled="true">'.$Array['replica'].'</textarea></th>';
			  $table.='<th nowrap><textarea id="text_respuesta" name="textarea" rows="10" cols="10" disabled="true">'.$Array['respuesta'].'</textarea></th>';
			  $table.='<tr></tr>';
			  $table.='</tr>';
			  $table.='</tbody>';
		      $table.='</table>';
			  $table .='</div>';
 
              $table .='<button id="btn_modalreplica" class="btn btn-outline-primary" onclick="guarda_valores_modal_replica()" >Guardar</button>';
 
	
	
	  }else{
			
			$estado  = -100;
			$mensaje = pg_last_error($conexion)." ".$sQuery;
			
	  }
	
	
	    pg_close($conexion);
	    $salidaJSON = array('estado'=>$estado, 'table'=>$table , 'mensaje'=>$mensaje ,'query'=>$sQuery);
	    print json_encode($salidaJSON);
	
	
	}	
	
	
	function InsertaRespuesta(){
		
		$Respuesta = $_POST['respuesta'];
		$Fecha = $_POST['fecha'];
		$Hora = $_POST['hora'];
		$Nombre = $_POST['nombre'];
	
		
		$conexion = conectaBD_128_catalogoempleados();
		$mensaje;
		$estado;
		
		$query = "update consulta_calificaciones set respuesta='$Respuesta' where fecha_calificacion='$Fecha' and hora_calificacion='$Hora' and nombrecompleto='$Nombre'";
		
		$result = pg_query($conexion,$query);
		
		
		if($result)
		{

	
	      $estado = 1;
		  $mensaje = "se actualizo correctamente";
	
		
		}
		

        pg_close($conexion);
			$salidaJSON = array('mensaje'=>$mensaje,'estado'=> $estado,'query'=>$query);
			print json_encode($salidaJSON);

	}
	
	function InsertaReplica(){
		
		$Replica = $_POST['Replica'];
		$Fecha = $_POST['fecha'];
		$Hora = $_POST['hora'];
		$Nombre = $_POST['nombre'];
		
		$conexion = conectaBD_128_catalogoempleados();
		$mensaje;
		$estado;
		
		$query = "update consulta_calificaciones set replica='$Replica' where fecha_calificacion='$Fecha' and hora_calificacion='$Hora' and nombrecompleto='$Nombre'";
	
	
	    $result = pg_query($conexion,$query);
		
		
		if($result)
		{

		  $estado = 1;
		  $mensaje = "se actualizo correctamente";
		
		}
		

        pg_close($conexion);
			$salidaJSON = array('mensaje'=>$mensaje,'estado'=> $estado,'query'=>$query);
			print json_encode($salidaJSON);
	
	}
	
	function Replica_Respuesta(){
		
		$Replica = $_POST['Replica'];
		$Respuesta = $_POST['Respuesta'];
		$Fecha = $_POST['fecha'];
		$Hora = $_POST['hora'];
		$Nombre = $_POST['nombre'];
		
		$conexion = conectaBD_128_catalogoempleados();
		$mensaje;
		$estado;
		
		$query = "update consulta_calificaciones set replica='$Replica' , respuesta='$Respuesta'  where fecha_calificacion='$Fecha' and hora_calificacion='$Hora' and nombrecompleto='$Nombre'";
	
	
	    $result = pg_query($conexion,$query);
		
		
		if($result)
		{

		  $estado = 1;
		  $mensaje = "se actualizo correctamente";
		
		}else{
			
			$estado = 2;
			$mensaje = "error";
			
		}
		

        pg_close($conexion);
			$salidaJSON = array('mensaje'=>$mensaje,'estado'=> $estado,'query'=>$query);
			print json_encode($salidaJSON);
		
		
	}
	
		
?>