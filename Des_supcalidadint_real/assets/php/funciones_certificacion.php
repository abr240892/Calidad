<?php 
 include('conexiones.php');

 $opc = $_POST['opc'];
	switch ($opc) {
		case 'llamarEmpleado':
			llamarEmpleado();
			break;
			
		case 'AltaServicio':
			cargaAltaServicio();
			break;
			
        case 'GuardaAltaServicio':
			GuardaAltaServicio();
			break;
			
	    case 'BajaServicio':
            BajaServicio();
            break;

        case 'DeleteServicio':
             DeleteServicio();
            break;
        
        case 'TablaIdllamada':
             crearTablaIdllamada();
             break;

        case 'LlamadasCertificacion':
		     crearTablallamadasCertificacion();
			 break;
        case 'deleteCertificacion':
             borrarRegistroCertificacion();
             break;
        case 'AprobarLlamada':
		     aprobarLlamada();
			 break;
		case 'RechazarLlamada':
		     RechazarLlamada();
			 break;	 
			 
			
		default:
			# code...
			break;
	}

// llamarDatosModal();
function llamarEmpleado(){
	$jEmpleado 	= trim($_POST['empleado']);
	$estado = false;

	
	$conexion = conectaBD_128_catalogoempleados();
		
	$sQuery = " SELECT true as estado, centro, nombre||' '||apellidopaterno||' '||apellidomaterno as nombrecompleto, puestonominal
		from catalogoempleados where empleado ='$jEmpleado' ";

		
	if($conexion){
		$rs = pg_query($sQuery);
		if($row = pg_num_rows($rs) > 0){
			$array = pg_fetch_assoc($rs);
			$estado = $array['estado'];
		}
	}
	pg_close($conexion);
		$salidaJSON = array('estado' => $estado,
	   		'nombrecompleto' => utf8_encode($array['nombrecompleto']),
			'centro' => utf8_encode($array['centro']),
			'puestonominal' => utf8_encode($array['puestonominal'])
		);
	print json_encode($salidaJSON);
}


function cargaAltaServicio(){
	
	$conexion = conectaBD_128_catalogoempleados();
	
	$response = false;
    	$dataTable = array();
    	$arrayTable = array();

    	$sQuery="SELECT  distinct servicio FROM catalogoempleados order by 1";
		$sQuery2="select (nombre||' '||apellidopaterno||' '||apellidomaterno) as nombre_completo_cen from catalogoempleados where puestonominal='CENTRALIZADOR'";
		$sQuery3="select (nombre||' '||apellidopaterno||' '||apellidomaterno) as nombre_completo_fun from catalogoempleados where puestonominal='FUNCIONAL'";
		
		
    	$result = pg_query($conexion,$sQuery);
    	while($array=pg_fetch_array($result)) {  
        	$response=true;
        	$dataTable['servicio'] = trim($array['servicio']);
        	//$dataTable['campana'] = utf8_decode(utf8_encode(trim($array['campana'])));
        	$arrayTable[] = array_map('utf8_encode', $dataTable);
    	}
		
        $result2 = pg_query($conexion,$sQuery2);
		while($array2=pg_fetch_array($result2)){
			$response==true;
			$dataTable2['nombre_completo_cen'] = trim($array2['nombre_completo_cen']);
			$arrayTable2[] = array_map('utf8_encode', $dataTable2);
			
			
		}
		
		$result3 = pg_query($conexion,$sQuery3);
		while($array3=pg_fetch_array($result3)){
			
         $response==true;
		 $dataTable3['nombre_completo_fun'] = trim($array3['nombre_completo_fun']);
		 $arrayTable3[] = array_map('utf8_encode',$dataTable3);
		
			
		}
		
    	pg_close($conexion);
    	$salidaJSON = array('response' => $response,'arrayTable' => $arrayTable ,'arrayTable2' => $arrayTable2 , 'arrayTable3' => $arrayTable3);
    	print json_encode($salidaJSON);
	
	
	
}


function GuardaAltaServicio(){
	
	$conexion = conectaBD_128_catalogoempleados();
	
	$Servicio = $_POST['servicio'];
	$Funcional = $_POST['funcional'];
	$Centralizador = $_POST['centralizador'];
	
	$sQuery = "insert into alta_servicio(id_servicio,roll_funcional,roll_centralizador) values('$Servicio','$Funcional','$Centralizador')";
	
    $result = pg_query($conexion,$sQuery);
	
	
	
}

function BajaServicio(){
	
	$conexion = conectaBD_128_catalogoempleados();
	$estado = 0;
    $mensaje = "";
	
	$sQuery = "select id_servicio,roll_funcional,roll_centralizador from alta_servicio";
	$result = pg_query($conexion,$sQuery);
	
	if($result)
	{
		
		$campos = pg_num_rows($result);
		
		if($campos > 0)
		{
           
	            $count=0;
				$estado  = 1;
				$mensaje = "OK";
				$table .='<div id="modalbajaservico">';
				$table .='<table  class="table table-striped table-bordered"    style="text-align:center;vertical-align:middle;weight:100%;">';
			    	$table.='<thead style="background-color:#ddd" >';
		      			$table.='<tr id="table_certificacion">';
		        			$table.='<th>Servicio</th>';
		        			$table.='<th>Funcional</th>';
		        			$table.='<th>Centralizador</th>';
		        			$table.='<th>Baja</th>';
		        			
		      			$table.='</tr>';
			    	$table.='</thead>';
			    	$table.='<tbody>';
					while($Array=pg_fetch_array($result)){
						
						
						
						$count++;
			    		$table.='<tr id="fila_servicios'.$count.'">';
			 
						$table .='<th nowrap class="cola'.$count.'">'.$Array['id_servicio'].'</th>';
						$table .='<th nowrap class="colb'.$count.'">' .$Array['roll_funcional'].'</th>';
						$table .='<th nowrap class="colc'.$count.'">'.$Array['roll_centralizador'].'</th>';
						$table .='<th nowrap>
						<button class="btn btn-danger btn-xs"  data-toggle="modal" data-target="#ModalMotivoBajaServicio" onclick="cerrar3('.$count.')"><span class="glyphicon glyphicon-arrow-down" ></span> </button>
						</th>';
			                    
			
					}
					
					$table.='</tr>';
			    	$table.='</tbody>';
				    $table.='</table>';
				    $table .='</div>';
				

		}else{
				$estado  = -200;
				$mensaje = "No se encontro información de los servicios";
			 }	


		
	}else{
			$estado  = -100;
			$mensaje = pg_last_error($conexion)." ".$sQuery;
		 }
        pg_close($conexion);
	    $salidaJSON = array('estado'=>$estado, 'table'=>$table , 'mensaje'=>$mensaje ,'query'=>$sQuery);
	    print json_encode($salidaJSON);		
	

	
}

function DeleteServicio(){
	
	$conexion = conectaBD_128_catalogoempleados();
	$estado = 0;
    $mensaje = "";
	
    $DATA = json_decode($_POST['array']);
	
	echo($servicio);
	echo($Funcional);
	echo($Centralizador);
	

	
	$sQuery="delete from alta_servicio where id_servicio='".$DATA[0]."' and  roll_funcional='".$DATA[1]."' and roll_centralizador='".$DATA[2]."'";
   $result = pg_query($conexion,$sQuery);
	
if($result){

   	$estado = 1;
    $mensaje = "OK";

    $salidaJSON = array('estado'=>$estado,'mensaje'=>$mensaje,'sQuery'=>$sQuery );
	print json_encode($salidaJSON);

   }	
	
	

}

function crearTablaIdllamada(){
	
	$conexion = pg_connect("host=10.44.2.128 dbname=appwebcat user=reportes password=ff7b3106de28225ca601288654f6c57a");
	
	$id_llamada = $_POST['dataID'];

	$query = "select nombreempleado,empleado,centro,nombrejefe,servicio,idllamada from llamadas_certificacion where idllamada = '$id_llamada'";
	
	$result = pg_query($conexion,$query);
	
	$estado = 0;
	
	$mensaje = "";
	
	$campos = pg_num_rows($result);
	
	$Bandera = 2;
	
	$table = "";
	
	$count = "";
	
	$titleTable = "";

	if($campos > 0)
	{
		$estado = 1;
		$mensaje = "OK";
		$table .='<div id="tabla_cerficacionID" ></div>';
		$table .='<table  class="table table-striped table-bordered"    style="text-align: center;vertical-align: middle;">';
	    			$table.='<caption><h4>'.$titleTable.'</h4></caption>';
			    	$table.='<thead style="background-color:#ddd" >';
		      			$table.='<tr id="table_consulta">';
		        			$table.='<th>Nombre</th>';
		        			$table.='<th>Empleado</th>';
		        			$table.='<th>Centro</th>';
							$table.='<th>Servicio</th>';
		        			$table.='<th>Nombre Jefe</th>';

		        			$table.='<th>Audio</th>';
		        			$table.='<th>Calificar Llamada</th>';
							
							$table.='</tr>';
			    	        $table.='</thead>';
			    	        $table.='<tbody>';
							
							while($Array=pg_fetch_array($result)) {
								
								$count++;
			    		$table.='<tr id="">';

						$table .='<th nowrap>'.$Array['nombreempleado'].'</th>';
						$table .='<th nowrap id="">'.$Array['empleado'].'</th>';
						$table .='<th nowrap>'.$Array['centro'].'</th>';
					    $table .='<th nowrap>'.$Array['servicio'].'</th>';
						$table .='<th nowrap>'.$Array['nombrejefe'].'</th>';


						$table .='<th id="col-audio'.$count.'" nowrap><button id="btn-audio'.$count.'" type="button"  class = "btn btn-outline-primary glyphicon glyphicon-cloud-download"   dataID="'.utf8_encode($Array['idllamada']).'.mp3" onclick="descarga_audio(this,'.$count.')"  >Descarga</button></th>';
			
						$table .='<th nowrap>
						<button class="btn btn-danger btn-xs"  data-toggle="modal" data-target="#miModal"  id="btn'.$count.'" onclick="btn_plantilla('.$count.','.$Bandera.')"  dataID="'.utf8_encode($Array['idllamada']).'.mp3"><span class="glyphicon glyphicon-pencil" ></span></button>
						</th>';
								
								
							}
							
							$table.='</tr>';
			    	$table.='</tbody>';
				$table.='</table>';
				$table .='</div>';
							
		
		
	   
	
	}else{
		
		$estado = 2;
		$mensaje = "nose encontro informacion";
		
		
	   }
	
	pg_close($conexion);
	    $salidaJSON = array('estado'=>$estado, 'table'=>$table , 'mensaje'=>$mensaje ,'query'=>$query);
				
	    print json_encode($salidaJSON);

	
	

}

function crearTablallamadasCertificacion(){
	
	$table = "";
	
	$conexion = pg_connect("host=10.44.2.128 dbname=appwebcat user=reportes password=ff7b3106de28225ca601288654f6c57a");
	
	$sQuery = "select empleado,idllamada,servicio,llamadastatus from llamadas_certificacion";
	
    $result = pg_query($conexion,$sQuery);
	
	$campos = pg_num_rows($result);
	
	$estado = 0;
	
	$mensaje = "";
	
    if($campos>0)
	{
		$estado = 1;
		$count = 0;
		$mensaje = "OK";
        $table .='<div id="modalconsultallamadascertificacion">';
				$table .='<table  class="table table-striped table-bordered"    style="text-align:center;vertical-align:middle;weight:100%;">';
			    	$table.='<thead style="background-color:#ddd" >';
		      			$table.='<tr id="table_certificacion">';
		        			$table.='<th>Empleado</th>';
		        			$table.='<th>Id</th>';
							$table.='<th>Servicio</th>';
		        			$table.='<th>Estatus</th>';
							$table.='<th></th>';
		        			$table.='<th></th>';
							$table.='<th></th>';
		        			
		      			$table.='</tr>';
			    	$table.='</thead>';
			    	$table.='<tbody>';
					while($Array=pg_fetch_array($result)){
						
						$count++;
			    		$table.='<tr id="fila_certificada'.$count.'" class="fila_llamadas_certificacion">';
			 
						$table .='<th  class="certa'.$count.'">'.$Array['empleado'].'</th>';
						$table .='<th  class="certb'.$count.'">' .$Array['idllamada'].'</th>';
						$table .='<th  class="certd'.$count.'">' .$Array['servicio'].'</th>';
						$table .='<th  class="certc'.$count.'">'.$Array['llamadastatus'].'</th>';
						$table .='<th>
						<button id="btn-like'.$count.'" class="btn btn-primary"  onclick="ApruebaCalidad('.$count.')" ><span class="glyphicon glyphicon-thumbs-up" ></span> </button>
						</th>';
						$table .='<th>
						<button id="btn-unlike'.$count.'" class="btn btn-warning"  onclick="RechazaCalidad('.$count.')"><span class="glyphicon glyphicon-thumbs-down" ></span> </button>
						</th>';
						$table .='<th>
						<button class="btn btn-danger btn-xs"  onclick="borrar_registro_certicacion('.$count.')"><span class="glyphicon glyphicon-arrow-down" ></span> </button>
						</th>';
						
			                    
			
					}
					
					$table.='</tr>';
			    	$table.='</tbody>';
				    $table.='</table>';
				    $table .='</div>';
        		
		
    }else{
		
		$mensaje = "no se encontraron registros";
		$estado = 2;
		
		
	}
	
	pg_close($conexion);
	    $salidaJSON = array('estado'=>$estado, 'table'=>$table , 'mensaje'=>$mensaje ,'query'=>$sQuery);
	    print json_encode($salidaJSON);	
	
	
}

function borrarRegistroCertificacion(){
	
	$conexion = pg_connect("host=10.44.2.128 dbname=appwebcat user=reportes password=ff7b3106de28225ca601288654f6c57a");
	
	$estado = 0;
    $mensaje = "";
	
	$certa = $_POST['certa'];
	$certb = $_POST['certb'];
	$certc = $_POST['certc'];
	
	$sQuery = "delete from llamadas_certificacion where idllamada = '$certb'";
	
    $result = pg_query($conexion,$sQuery);
	
	if($result){
		
		$estado = 1;
		$mensaje = "OK";
		
	}else{
		
		$estado=2;
		$mensaje="ERROR";
		
	}
		
		pg_close($conexion);
	    $salidaJSON = array('estado'=>$estado, 'mensaje'=>$mensaje ,'query'=>$sQuery);
	    print json_encode($salidaJSON);	
	
	
}

function aprobarLlamada(){
	
	$conexion = pg_connect("host=10.44.2.128 dbname=appwebcat user=reportes password=ff7b3106de28225ca601288654f6c57a");
	
	$estado = 0;
    $mensaje = "";
	
	$certa = $_POST['certa'];
	$certb = $_POST['certb'];
	$certc = $_POST['certc'];
	
	$sQuery = "update llamadas_certificacion set llamadastatus='Aprovada Calidad',idstatus='3' where idllamada = '$certb'";
	$result = pg_query($conexion,$sQuery);
	
	if($result)
	{
	  $estado = 1;
	  $mensaje = "OK";
		
		
	}
	
	
	pg_close($conexion);
	    $salidaJSON = array('estado'=>$estado, 'mensaje'=>$mensaje ,'query'=>$sQuery);
	    print json_encode($salidaJSON);	
	
	
}

function RechazarLlamada(){
	
	$conexion = pg_connect("host=10.44.2.128 dbname=appwebcat user=reportes password=ff7b3106de28225ca601288654f6c57a");
	
	$estado = 0;
    $mensaje = "";
	
	$certa = $_POST['certa'];
	$certb = $_POST['certb'];
	$certc = $_POST['certc'];
	
	$sQuery = "update llamadas_certificacion set llamadastatus='Rechazada Calidad',idstatus='1' where idllamada = '$certb'";
	$result = pg_query($conexion,$sQuery);
	
	if($result)
	{
	  $estado = 1;
	  $mensaje = "OK";
		
		
	}
	
	
	pg_close($conexion);
	    $salidaJSON = array('estado'=>$estado, 'mensaje'=>$mensaje ,'query'=>$sQuery);
	    print json_encode($salidaJSON);	
	
	
}

?>