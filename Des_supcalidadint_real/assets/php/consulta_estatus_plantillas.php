<?php

$opc = $_POST['opc'];
	switch ($opc) {
		
		case 'consulta_plantillas':
			consulta_plantillas();
			break;
			
		case 'actualiza_estatus':
			actualiza_estatus();
			break;
			
		case 'rechaza_plantilla':
            rechaza_plantilla();
            break;
        
        case 'ver_preguntas':
              ver_preguntas();
          	 break;

        case 'edita_plantilla':
              edita_plantillas();
             break;			  
		                
		default:
			# code...
			break;
	}


function consulta_plantillas(){
	
$conexion = pg_connect("host=10.44.2.128 dbname=appwebcat user=reportes password=ff7b3106de28225ca601288654f6c57a");	

$sQuery = "select distinct id_campana,estatus from calidad_pregunta WHERE  estatus='EN REVISION'";

$result = pg_query($conexion,$sQuery);

$table = "";

if($result)
	
	{
	  $campos = pg_num_rows($result);
      if($campos > 0){	
 
        
		
		 $count=0;
				$estado  = 1;
				$mensaje = "OK";
				$table .='<div id="ModalConsultaPlantilla">';
				$table .='<table  class="table table-striped table-bordered" style="text-align:center;vertical-align:middle;weight:100%;">';
			    	$table.='<thead style="background-color:#ddd" >';
		      			$table.='<tr id="table_plantilla_estatus">';
		        			$table.='<th>Campaña</th>';
		        			$table.='<th>Estatus</th>';
							$table.='<th>Aceptar</th>';
							$table.='<th>Rechazar</th>';
							$table.='<th>Ver</th>';

		        			
		      			$table.='</tr>';
			    	$table.='</thead>';
			    	$table.='<tbody>';
					
		            while($Array=pg_fetch_array($result)){
						
						if($Array['id_campana']==1)
						{
							$campana = '<span>COBRANZA MEXICO</span>';
							
						}
						
						else if($Array['id_campana']==2)
						{
							$campana = '<span>COBRANZA BANCOPPEL</span>';
							
						}else if($Array['id_campana']==3)
						{
							
							$campana = '<span>COBRANZA ARGENTINA</span>';
							
						}else if($Array['id_campana']==4)
						{
							
							$campana = '<span>PROMOCION COPPEL</span>';
							
						}else if($Array['id_campana']==5)
						{
							
							$campana = '<span>SOLICITUDES BANCO</span>';
							
						}else if($Array['id_campana']==6)
						{
							
							$campana = '<span>SOLICITUD DE CREDITO</span>';
							
						}else if($Array['id_campana']==7)
						{
							
							$campana = '<span>VENTAS</span>';
							
						}else if($Array['id_campana']==8)
						{
							
							$campana = '<span>ATENCION COPPEL</span>';
							
						}else if($Array['id_campana']==9)
						{
							
							$campana = '<span>ATENCION ARGENTINA</span>';
							
						}else if($Array['id_campana']==10)
						{
							
							$campana = '<span>ATENCION ZUUM</span>';
							
						}else if($Array['id_campana']==11)
						{
							
							$campana = '<span>ATENCION AFORE</span>';
							
						}else if($Array['id_campana']==12)
						{
							$campana = '<span>ATENCION SOPORTE TECNICO</span>';
							
						}else if($Array['id_campana']==13)
						{	
							$campana = '<span>CAMPANAS UNICAS</span>';
							
						}else if($Array['id_campana']==14)
						{	
							$campana = '<span>PROMOCION BANCOPPEL</span>';
							
						}else if($Array['id_campana']==15)
						{	
							$campana = '<span>PROMOCION COPPEL ARGENTINA</span>';
							
						}else if($Array['id_campana']==16)
						{	
							$campana = '<span>ATENCION A CLIENTES BANCOPPEL</span>';
							
						}
						
						
						$count++;
			    		$table.='<tr id="fila_platilla_estatus'.$count.'">';
			 
						$table .='<th nowrap class="stata'.$count.'">'.$campana.'</th>';
						$table .='<th nowrap class="statb'.$count.'">'.$Array['estatus'].'</th>';

						$table .='<th nowrap>
						<button class="btn btn-danger btn-xs"  data-toggle="modal" data-target="#" onclick="acepta_platilla('.$Array['id_campana'].')"><span class="glyphicon glyphicon-ok" ></span> </button>
						</th>';
						$table .='<th nowrap>
						<button class="btn btn-danger btn-xs"  data-toggle="modal" data-target="#" onclick="rechaza_plantilla('.$Array['id_campana'].')"><span class="glyphicon glyphicon-remove" ></span> </button>
						</th>';
						$table .='<th nowrap>
						<button class="btn btn-danger btn-xs"  data-toggle="modal" data-target="#ModalVerPreguntas" onclick="ver_preguntas('.$Array['id_campana'].')"><span class="glyphicon glyphicon-eye-open" ></span> </button>
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
	   
	   
   }pg_close($conexion);
	    $salidaJSON = array('estado'=>$estado, 'table'=>$table , 'mensaje'=>$mensaje ,'query'=>$sQuery);
	    print json_encode($salidaJSON);		
	



}

function actualiza_estatus(){
	
	 $conexion = pg_connect("host=10.44.2.128 dbname=appwebcat user=reportes password=ff7b3106de28225ca601288654f6c57a");	
	
	 $val = $_POST['id'];
 
	
     $estado=0;
	 $sQuery = "update calidad_pregunta set estatus='ACEPTADA' where id_campana = $val";

     $result = pg_query($conexion,$sQuery);
	
	 if($result)
	 {
	 $estado=1;
     $salidaJSON = array('estado'=>$estado,'query'=>$sQuery);
	 print json_encode($salidaJSON);
	
		
	 }
	 
	
}

function rechaza_plantilla(){
	
	$conexion = pg_connect("host=10.44.2.128 dbname=appwebcat user=reportes password=ff7b3106de28225ca601288654f6c57a");	
	
	$val = $_POST['id'];
	
	$sQuery = "update calidad_pregunta set estatus='RECHAZADA' where id_campana = $val";
	
	$result = pg_query($conexion,$sQuery);
	
	$salidaJSON = array('query'=>$sQuery);
	 print json_encode($salidaJSON);
	
}

function ver_preguntas(){
	
	$conexion = pg_connect("host=10.44.2.128 dbname=appwebcat user=reportes password=ff7b3106de28225ca601288654f6c57a");
	
	$val = $_POST['id'];
	
	$sQuery = "select id_apartado,pregunta,porcentaje_pregunta from calidad_pregunta where id_campana = $val";
	
	$result = pg_query($conexion,$sQuery);
	
	$estado = 0;
	
	$table = "";
	
	if($result)
	{
		
      		$campos = pg_num_rows($result);
      if($campos > 0){	
	  
	   
	      
	       $count=0;
				$estado  = 1;
				$mensaje = "OK";
				$table .='<div id="modalbajaservico">';
				$table .='<table  class="table table-striped table-bordered"    style="text-align:center;vertical-align:middle;weight:100%;">';
			    	$table.='<thead style="background-color:#ddd" >';
		      			$table.='<tr id="table_plantilla_estatus">';
		        			$table.='<th>ID APARTADO</th>';
		        			$table.='<th>PREGUNTA</th>';
							$table.='<th>PORCENTAJE PREGUNTA</th>';
							
						

		        			
		      			$table.='</tr>';
			    	$table.='</thead>';
			    	$table.='<tbody>';
					
		            while($Array=pg_fetch_array($result)){

					$count++;
					
					if($Array['id_apartado']==1)
						{
							$campana = '<span>ASPECTOS TECNICOS</span>';
							
						}
						
					else if($Array['id_apartado']==2)
				     	{
                            $campana = '<span>ASPECTOS ESPECIALIZADOS</span>';

					    }				
						
					else if($Array['id_apartado']==3)
					   {						
						   $campana = '<span>DIALOGO CALIDO</span>';   
						 
					   }
										
					$table.='<tr id="table_questions'.$count.'">';
					$table .='<th nowrap class="question_a_'.$count.'">'.$campana.'</th>';
					$table .='<th nowrap class="question_b_'.$count.'">'.$Array['pregunta'].'</th>';
					$table .='<th nowrap class="question_a_'.$count.'">'.$Array['porcentaje_pregunta'].'</th>';
					
						
						
			
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
		}pg_close($conexion);
	    $salidaJSON = array('estado'=>$estado, 'table'=>$table , 'mensaje'=>$mensaje ,'query'=>$sQuery);
	    print json_encode($salidaJSON);		


	
}


function edita_plantillas(){
	
	$conexion = pg_connect("host=10.44.2.128 dbname=appwebcat user=reportes password=ff7b3106de28225ca601288654f6c57a");
	$select = $_POST['select'];
	$sQuery = "select id_campana,id_apartado,pregunta,porcentaje_pregunta from calidad_pregunta where id_campana = $select and estatus = 'ACEPTADA'";
	
	$res = pg_query($conexion,$sQuery);
	$estado = 0;
	$mensaje = "";
	$table = "";
	
	
	if($res)
	{
		
		$campos = pg_num_rows($res);
		if($campos>0)
		{
			$count=0;
			$count2=0;
			$count3=0;
				$estado  = 1;
				$mensaje = "OK";
				//$table .='<div id="form_preguntas2">';
				$table .='<div style="width:80%;margin-left:auto;margin-right:auto;">';
				$table .='<table border=2 style="width:100%;" id="tabla1">';
				$table .='<tr bgcolor="#AAB7B8">';
				$table .='<th style="width:60%;font-weight:bold;color:black;" colspan="2" id="subtitulo">EJECUCION DE LA LLAMADA</th>';
				$table .='<th style="width:20%;font-weight:bold;color:black;">% por pregunta</th>';
				$table .='<th style="width:20%;font-weight:bold;color:black;">PONDERADOS</th>';
				$table .='</tr>';
				
				$table .='<tr bgcolor="#85C1E9">';
				$table .='<th  colspan="2" scope="col">';
				$table .='<input class="form-control" type="text" name="ponderado_1" style="background-color:#85C1E9" id="ponderado_1" disabled />';
				$table .='</th>';
				$table .='<th></th>';
				$table .='<th style="font-weight:bold;color:black;">';
				$table .='<input type="text" style="background-color:#85C1E9" id="TP1" onkeyup="actualiza_ponderados()"  disabled />';
				$table .='</th>';
				$table .='</tr>';
				$table .='</table>';
				
				$table .='<table border=2 style="width:100%;" id="tabla1_1">';
				
				//***************************************
				
				$sQuery = "select id_campana,id_apartado,pregunta,porcentaje_pregunta from calidad_pregunta where id_campana = $select and id_apartado=1";
				$res=pg_query($conexion,$sQuery);
				
		
				while($Array = pg_fetch_array($res))
				{	
				 
				$count ++;
				$table .='<tr  id="tr'.$count.'"  class="edicion_platilla_filas_a">';
				$table .='<td  style="width:10%;text-align:center;">'.$count.'<button  type="button" onclick="elimina('.$count.')" class="btnborrar" title="ELIMINAR CELDA"></button>';
				$table .='</td>';
				$table .='<td  style="width:50%;">';
				$table .='<input id="t1_col2_input'.$count.'" class="input-text-t1" type="text" name="st1_colum2[]" style="width:100%" autocomplete="off" placeholder="Descripcion 50 caracteres"  value="'.$Array['pregunta'].'"   disabled  />';
				$table .='<span class="highlight"></span>';
				$table .='<span class="bar"></span>';
				$table .='</td>';
				$table .='<td style="width:20%" >';
				$table .='<input id="t1_col3_input'.$count.'"  type="text" name="st1_colum3[]" style="width:100%" autocomplete="off" value="'.$Array['porcentaje_pregunta'].'"  disabled />';
				$table .='<span class="highlight"></span>';
				$table .='<span class="bar2"></span>';
				$table .='</td>';
				$table .='<td style="width:20%" ></td>';
				$table .='</tr>';
				
				}
				
				
				$table .='</table>';
				$table .='<table border=2 style="width:100%;" id="tabla1_2">';
				$table .='<tr>';
				$table .='<td style="width:80%" colspan="3">';
				$table .='<button  id="btnadd" type="button"  class="add" title="AGREGAR NUEVA CELDA"></button>Puntos que aplican';
				$table .='</td>';
				$table .='<td id="PA1" style="width:20%" ="true">'.$count.'</td>';
				$table .='</tr>';
				$table .='<tr>';
				$table .='<td colspan="3" style="text-align:left;font-weight:bold;color:black;" bgcolor="#85C1E9">Calificacion tecnica</td>';
				$table .='<td></td>';
				$table .='</tr>';
				$table .='</table>';
				
				
				//fin tabla 1***************************************************************************************************************
				
				$table .='<table border=2 style="width:100%;" id="tabla2">';
				$table .='<tr bgcolor="#3498DB">';
				$table .='<th style="width:60%;" colspan="2">';
				$table .='<input class="form-control validate[required]" type="text" name="ponderado_2"  style="background-color:#3498DB" id="ponderado_2" disabled />';
				$table .='</th>';
				$table .='<th style="width:20%;font-weight:bold;color:black;">% por pregunta</th>';
				$table .='<th style="width:20%;font-weight:bold;color:black;">';
				$table .='<input id="TP2" style="background-color:#3498DB" onkeyup="actualiza_ponderados()" disabled />';
				$table .='</th>';
				$table .='</tr>';
				$table .='</table>';
				$table .='<table border=2 style="width:100%;" id="tabla2_1">';
				
				//**************************
				
				$sQuery = "select id_campana,id_apartado,pregunta,porcentaje_pregunta from calidad_pregunta where id_campana = $select and id_apartado=2";
				$res=pg_query($conexion,$sQuery);
				
				
				while($Array = pg_fetch_array($res))
				{
			        		
			    $count2 ++;
				$table .='<tr  id="tbl2_tr'.$count2.'"  class="edicion_platilla_filas_b">';
				$table .='<td  style="width:10%;text-align:center;">'.$count2.'<button  type="button" onclick="elimina2('.$count2.')" class="btnborrar" title="ELIMINAR CELDA"></button>';
				$table .='</td>';
				$table .='<td  style="width:50%;">';
				$table .='<input id="t2_col2_input'.$count2.'" class="input-text-t2" type="text" name="st1_colum2[]" style="width:100%" autocomplete="off" placeholder="Descripcion 50 caracteres"  value="'.$Array['pregunta'].'"   disabled  />';
				$table .='<span class="highlight"></span>';
				$table .='<span class="bar"></span>';
				$table .='</td>';
				$table .='<td style="width:20%" >';
				$table .='<input id="t2_col3_input'.$count2.'"  type="text" name="st2_colum3[]" style="width:100%" autocomplete="off" value="'.$Array['porcentaje_pregunta'].'"  disabled />';
				$table .='<span class="highlight"></span>';
				$table .='<span class="bar2"></span>';
				$table .='</td>';
				$table .='<td style="width:20%" ></td>';
				$table .='</tr>';
					
									
				}
				
				$table.='</table>';
				$table.='<table border=2 style="width:100%;" id="tabla2_3">';
				$table.='<tr>';
				$table.='<td style="width_80%" colspan="3" style="text-align:left;">';
				$table.='<button  id="btnadd2" type="button" class="add" title="AGREGAR NUEVA CELDA"></button>Puntos que aplican</td>';
				$table.='<td id="PA2" style="width:20%" >'.$count2.'</td>';
				$table.='</tr>';
				
				$table.='<tr>';
				$table.='<td colspan="3" style="text-align:left;font-weight:bold;color:black;" bgcolor="#3498DB">Calificacion negociacion</td>';
				$table.='<td></td>';
				$table.='</tr>';
				$table.='</table>';
				
				//fin tabla 2 *****************************************************************************************************************
				
				$table.='<table border=2 style="width:100%;" id="tabla3">';
				$table.='<tr bgcolor="#2874A6">';
				$table.='<th style="width:60%;" colspan="2">';
				$table.='<input class="form-control validate[required]" type="text" name="ponderado_3" style="background-color:#2874A6" id="ponderado_3" disabled />';
				$table.='</th>';
				$table.='<th style="width:20%;font-weight:bold;color:black;">% por pregunta</th>';
				$table.='<th style="width:20%;font-weight:bold;color:black;">';
				$table.='<input id="TP3" style="background-color:#2874A6" onkeyup="actualiza_ponderados()" disabled />';
				$table.='</th>';
				$table.='</tr>';
				//$table.='</tr>';
				$table.='</table>';
				$table.='<table border=2 style="width:100%;" id="tabla3_1">';
				
				//consulta para traer preguntas
				
				$sQuery = "select id_campana,id_apartado,pregunta,porcentaje_pregunta from calidad_pregunta where id_campana = $select and id_apartado=3";
				$res=pg_query($conexion,$sQuery);
				
				while($Array = pg_fetch_array($res))
				{
					
					$count3++;
					$table.='<tr  id="tbl3_tr'.$count3.'" class="edicion_platilla_filas_c">';
					$table.='<td  style="width:10%;text-align:center;">'.$count3.'<button type="button" onclick="elimina3('.$count3.')" class="btnborrar" title="ELIMINAR CELDA"></button>';
					$table.='</td>';
					$table.='<td  style="width:50%;">';
					$table.='<input id="t3_col2_input'.$count3.'" class="input-text-t3" type="text" name="st3_colum2[]" style="width:100%"  autocomplete="off" placeholder="Descripcion 50 caracteres" value="'.$Array['pregunta'].'" disabled />';
					$table.='<span class="highlight"></span>';
					$table.='<span class="bar"></span>';
					$table.='</td>';
					$table.='<td style="width:20%">';
					$table.='<input id="t3_col3_input'.$count3.'"  type="text" name="st3_colum3[]" style="width:100%" autocomplete="off" value="'.$Array['porcentaje_pregunta'].'" disabled />';
					$table.='<span class="highlight"></span>';
					$table.='<span class="bar2"></span>';
					$table.='</td>';
					$table.='<td style="width:20%"></td>';
					$table.='</tr>';
					
					
					
				}
				
				    $table.='</table>';
				$table.='<table border=2 style="width:100%;" id="tabla2_3">';
				$table.='<tr>';
				$table.='<td style="width_80%" colspan="3" style="text-align:left;">';
				$table.='<button  id="btnadd3" type="button" class="add" title="AGREGAR NUEVA CELDA"></button>Puntos que aplican</td>';
				$table.='<td  id="PA3" style="width:20%" >'.$count3.'</td>';
				$table.='</tr>';
				
				$table.='<tr>';
				$table.='<td colspan="3" style="text-align:left;font-weight:bold;color:black;" bgcolor="#3498DB">Calificacion negociacion</td>';
				$table.='<td></td>';
				$table.='</tr>';
			
					
					
					$table.='<tr>';
					$table.='<td colspan="3" style="text-align:left;font-weight:bold;color:black;" style="width:80%" bgcolor="#2874A6">Calificacion de dialogo calido</td>';
					$table.='<td ="true" style="width:20%"></td>';
					$table.='</tr>';
					
					$table.='<tr>';
					$table.='<td colspan="3" style="text-align:left;" style="width:80%">Fecha de llamada</td>';
					$table.='<td ="true" style="width:20%"> <input type="text" style="width:100%" autocomplete="off" placeholder="(15 caracteres)"/></td>';
					$table.='</tr>';
					$table.='<tr>';
					$table.='<td colspan="3" style="text-align:left;" style="width:80%">Hora de llamada</td>';
					$table.='<td  style="width:20%"> <input type="text" style="width:100%" autocomplete="off" placeholder="(15 caracteres)" /> </td>';
					$table.='</tr>';
					$table.='<table border=2 style="width:100%;" id="tabla4">';
					$table.='<br></br>';
					$table.='<tr>';
					$table.='<th style="width:80%;font-weight:bold;color:black;" colspan="2" bgcolor="#AAB7B8">CALIFICACION GENERAL</th>';
					$table.='<th  style="width:20%;" ="true" bgcolor="#2874A6"></th>';
					$table.='</tr>';
					$table.='<table border=2 style="width:100%;" id="tabla4">';
					$table.='<br></br>';
					$table.='<tr>';
					$table.='<td style="width:10%;" bgcolor="#AAB7B8">';
					$table.='<button type="button" ></button>';
					$table.='</td>';
					$table.='<td  style="width:70%;" ="true" bgcolor="#AAB7B8"><input input="text" style="width:100%" autocomplete="off" placeholder="(50 caracteres)"/></td>';
					$table.='<td  style="width:20%;" ="true" bgcolor="#AAB7B8"><select style="width:100%;height:100%" ><option value="SI">SI</option><option value="NO">NO</option></select></td>';
					$table.='</tr>';
					$table.='<tr>';
					$table.='<td style="width:10%;" bgcolor="#AAB7B8">';
					$table.='<button type="button" ></button>';
					$table.='</td>';
					$table.='<td  style="width:70%;" ="true" bgcolor="#AAB7B8"><input input="text" style="width:100%" autocomplete="off" placeholder="(50 caracteres)"/></td>';
					$table.='<td  style="width:20%;" ="true" bgcolor="#AAB7B8"><select style="width:100%;height:100%" ><option value="SI">SI</option><option value="NO">NO</option></select></td>';
					$table.='</tr>';
					$table.='<tr>';
					$table.='<td style="width:10%;" bgcolor="#AAB7B8">';
					$table.='<button type="button" ></button>';
					$table.='</td>';
					$table.='<td  style="width:70%;" ="true" bgcolor="#AAB7B8"><input input="text" style="width:100%" autocomplete="off" placeholder="(50 caracteres)"/></td>';
					$table.='<td  style="width:20%;" ="true" bgcolor="#AAB7B8" bgcolor="#AAB7B8"><select style="width:100%;height:100%" ><option value="SI">SI</option><option value="NO">NO</option></select></td>';
					$table.='</tr>';
					$table.='</table>';
					
					$table.='</table>';
					$table.='</div>';
					//$table.='</div>';
					
					
					
						
		}else{
			
			 $estado  =  -200;
		      $mensaje = "No hay datos previamente guardados";
			
			
		}
		
		
		
	}else{
		
		$estado  = -100;
		$mensaje = pg_last_error($conexion)." ".$sQuery;
		}pg_close($conexion);
	    $salidaJSON = array('estado'=>$estado, 'table'=>$table , 'mensaje'=>$mensaje ,'query'=>$sQuery);
	    print json_encode($salidaJSON);	
	
	
	
}

?>