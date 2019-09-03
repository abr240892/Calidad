<?php


	$opc = $_POST['opc'];
	switch ($opc) {
		case 'plantilla_supervicion':
			supervicion();
			break;
		case 'plantilla_certificacion':
			certificacion();
			break;
		default:
			# code...
			break;
	}


function supervicion(){
	
$table = "";

$conexion = pg_connect("host=10.44.2.128 dbname=appwebcat user=reportes password=ff7b3106de28225ca601288654f6c57a");


 $servicio = $_POST['Servicios'];
 
 $cliente = $_POST['Cliente'];
 
 $query = "select pregunta,porcentaje_pregunta from  calidad_pregunta where id_campana='".$servicio."' and id_apartado='1' and  estatus='ACEPTADA'";
 
 $query2 = "select pregunta,porcentaje_pregunta from  calidad_pregunta where id_campana='".$servicio."' and id_apartado='2' and estatus='ACEPTADA'";
 
 $query3 = "select pregunta,porcentaje_pregunta from  calidad_pregunta where id_campana='".$servicio."' and id_apartado='3' and estatus='ACEPTADA'";
 
 $query4 = "select pregunta,porcentaje_pregunta from  nombre_ponderado where id_campana='".$servicio."' and id_apartado='1'";
 
 $query5 = "select pregunta,porcentaje_pregunta from  nombre_ponderado where id_campana='".$servicio."' and id_apartado='2'";
  
 $query6 = "select pregunta,porcentaje_pregunta from  nombre_ponderado where id_campana='".$servicio."' and id_apartado='3'";
 
 
 $rs = pg_query($conexion,$query);
 
 $rs2 = pg_query($conexion,$query2);
 
 $rs3 = pg_query($conexion,$query3);
 
 $rs4 = pg_query($conexion,$query4);
 
 $rs5 = pg_query($conexion,$query5);
 
 $rs6 = pg_query($conexion,$query6);
 
 if($rs and $rs2 and $rs3 and $rs4 and $rs5 and $rs6)
 {
	 $campos = pg_num_rows($rs);
	 $campos2 = pg_num_rows($rs2);
	 $campos3 = pg_num_rows($rs3);
	 $campos4 = pg_num_rows($rs4);
	 $campos5 = pg_num_rows($rs5);
	 $campos6 = pg_num_rows($rs6);
	 
	 
	 
	 if($campos > 0 and $campos2 > 0 and $campos3 > 0 and $campos4 > 0 and $campos5 > 0 and $campos6 > 0) 
	{
		 
         $count = 0;
         $estado  = 1;
	     $mensaje = "OK";
		 
		 $Encabezados=pg_fetch_array($rs4);
		 
	
	//PRIMER ENCAZADO	 
		 $table .='<div id="pruebademodal">';
				$table .='<table  class="table table-striped table-bordered"  border=2  id="suptable1"  style="text-align:center;vertical-align:middle;width:100%;">';
			    	$table.='<thead style="background-color:#85C1E9" >';
		      			$table.='<tr id="table_consulta_preguntas">';				
		        			$table.='<th style="width:70%;text-align:left;" colspan="2" id="subtitulo">'.$Encabezados['pregunta'].'</th>';
		        			$table.='<th style="width:10%;">Minimo</th>';
							$table.='<th style="width:20%;">Certificado</th>';
						
							


					
						
				
		      			$table.='</tr>';
			    	$table.='</thead>';
     //CONTENIDO DE LA PRIMERA TABLA        		 
                while($Tabla1=pg_fetch_array($rs)){
					$count++;
			    		$table.='<tr id="#'.$count.'" class="num_filas">';
						$table .='<td nowrap style="width:10%;text-align:center;">'.$count.'</td>';
						$table .='<td nowrap style="width:70%;">'.$Tabla1['pregunta'].'</td>';
						$table .='<td nowrap style="width:10%;"><select style="width:100%;" onclick="combobox()" class="select_min"><option value="1">1</option><option value="0">0</option><option value="NA">NA</option></select></td>';
						$table .='<td nowrap style="width:10%;"><select style="width:100%;" onclick="combobox()" class="certificado"><option value="1">1</option><option value="0">0</option><option value="NA">NA</option></select></td>';
						$table.='</tr>';
				}

	// FINAL DE LA PRIMERA TABLA
	                
	                $count = 0;

                        $table.='</table>';
						
                        $table.='<table class="table table-striped table-bordered"  border=2  id="suptable1_2"  style="text-align:center;vertical-align:middle;width:100%;">';						
                        $table.='<tr>';						 
						//$table .='<td nowrap style="width:10%;text-align:center;"><button class="add" id="calif_add"></button></td>';
						//$table .='<td nowrap style="width:70%;"></td>';
						//$table .='<td nowrap style="width:10%;"></td>';
						//$table .='<td nowrap style="width:10%;"></td>';
						$table .='</tr>';
						$table .='<tr>';
						$table .='<td></td>';
						$table .='<td nowrap >Puntos que aplican</td>';
						$table .='<td nowrap id="Puntos_minimo" >'.$campos.'</td>';
						$table .='<td nowrap id="Puntos_certificado" >'.$campos.'</td>';
					    $table .='</tr>';
						$table .='<tr>';
						$table .='<td></td>';
						$table .='<td nowrap>Calificacion tecnica</td>';
						$table .='<td nowrap id="total1"></td>';
						$table .='<td nowrap id="total2"></td>';
						$table .='</tr>';
						$table .='</table>';
                        $table.='<textarea style="position:relative;left:80%;" cols="31" id="text-area1" placeholder="observaciones"></textarea>';						
						$table .='<br></br>';
				        
						
	//SEGUNDO ENCABEZADO 					
			 $Encabezados2 = pg_fetch_array($rs5);
			 
            $table .='<table  class="table table-striped table-bordered"  border=2  id="suptable2"  style="text-align:center;vertical-align:middle;width:100%;">';
			    	$table.='<thead style="background-color:#85C1E9" >';
                    $table.='<tr>';					
		        			$table.='<th style="width:70%;text-align:left;" colspan="2" >'.$Encabezados2['pregunta'].'</th>';
		        			$table.='<th style="width:10%;">Minimo</th>';
							$table.='<th style="width:20%;">Certificado</th>';
		      			$table.='</tr>';
			    	$table.='</thead>';			
    //CONTENIDO DE LA TABLA 2
	
	                while($Tabla2=pg_fetch_array($rs2)){
					
					
					$count++;
			    		$table.='<tr id="#'.$count.'" class="num_filas2">';
						$table .='<td nowrap style="width:10%;text-align:center;">'.$count.'</td>';
						$table .='<td nowrap style="width:70%;">'.$Tabla2['pregunta'].'</td>';
						$table .='<td nowrap style="width:10%;"><select style="width:100%;" onclick="combobox()" class="select_min2"><option value="1">1</option><option value="0">0</option><option value="NA">NA</option></select></td>';
						$table .='<td nowrap style="width:10%;"><select style="width:100%;" onclick="combobox()" class="certificado2"><option value="1">1</option><option value="0">0</option><option value="NA">NA</option></select></td>';
				        $table.='</tr>';
						
						
				}
						
     //FINAL DEL SEGUNDA TABLA
	 
	                $count = 0;
					    $table.='</table>';
                        $table.='<table class="table table-striped table-bordered"  border=2  id="suptable2_2"  style="text-align:center;vertical-align:middle;width:100%;">';
                        //$table.='<tr>';						 
						//$table .='<td nowrap style="width:10%;text-align:center;"><button class="add" id="calif_add2"></button></td>';
						//$table .='<td nowrap style="width:70%;"></td>';
						//$table .='<td nowrap style="width:10%;"></td>';
						//$table .='<td nowrap style="width:10%;"></td>';
						$table .='</tr>';
						$table .='<tr>';
						$table .='<td></td>';
						$table .='<td nowrap >Puntos que aplican</td>';
						$table .='<td nowrap id="Puntos_minimo2" >'.$campos2.'</td>';
						$table .='<td nowrap id="Puntos_certificado2" >'.$campos2.'</td>';
					    $table .='</tr>';
						$table .='<tr>';
						$table .='<td></td>';
						$table .='<td nowrap>Calificacion tecnica</td>';
						$table .='<td nowrap id="total3"></td>';
						$table .='<td nowrap id="total4"></td>';
						
						$table .='</tr>';
						$table .='</table>';
                        $table.='<textarea  style="position:relative;left:80%;" cols="31" id="text-area2" placeholder="observaciones"></textarea>';						
						$table .='<br></br>';
						
						
	 //TERCER ENCABEZADO 		

            $Encabezados3 = pg_fetch_array($rs6);	 
			
            $table .='<table  class="table table-striped table-bordered"  border=2  id="suptable3"  style="text-align:center;vertical-align:middle;width:100%;">';
			    	$table.='<thead style="background-color:#85C1E9 " >';
                    $table.='<tr>';					
		        			$table.='<th style="width:70%;text-align:left;" colspan="2">'.$Encabezados3['pregunta'].'</th>';
		        			$table.='<th style="width:10%;">Minimo</th>';
							$table.='<th style="width:20%;">Certificado</th>';
		      			$table.='</tr>';
			    	$table.='</thead>';		
    //CONTENIDO DE LA TABLA 3
	
	                while($Tabla3=pg_fetch_array($rs3)){
					
					
					$count++;
			    		$table.='<tr id="#'.$count.'" class="num_filas3">';
						$table .='<td nowrap style="width:10%;text-align:center;">'.$count.'</td>';
						$table .='<td nowrap style="width:70%;">'.$Tabla3['pregunta'].'</td>';
						$table .='<td nowrap style="width:10%;"><select style="width:100%;" onclick="combobox()" class="select_min3"><option value="1">1</option><option value="0">0</option><option value="NA">NA</option></select></td>';
						$table .='<td nowrap style="width:10%;"><select style="width:100%;" onclick="combobox()" class="certificado3"><option value="1">1</option><option value="0">0</option><option value="NA">NA</option></select></td>';
				        $table.='</tr>';
						
						
				}
						
     //FINAL DEL LA TERCERA TABLA
	                    
						$table.='</table>';
                        $table.='<table class="table table-striped table-bordered"  border=2  id="suptable3_2"  style="text-align:center;vertical-align:middle;width:100%;">';
                        //$table.='<tr>';						 
						//$table .='<td nowrap style="width:10%;text-align:center;"><button class="add" id="calif_add3"></button></td>';
						//$table .='<td nowrap></td>';
						//$table .='<td nowrap></td>';
						//$table .='<td nowrap></td>';
						$table .='</tr>';
						$table .='<tr>';
						$table .='<td></td>';
						$table .='<td nowrap  >Puntos que aplican</td>';
						$table .='<td nowrap  id="Puntos_minimo3" >'.$campos3.'</td>';
						$table .='<td nowrap  id="Puntos_certificado3" >'.$campos3.'</td>';
					    $table .='</tr>';
						$table .='<tr>';
						$table .='<td></td>';
						$table .='<td nowrap>Calificacion tecnica</td>';
						$table .='<td nowrap id="total5"></td>';
						$table .='<td nowrap id="total6"></td>';
						$table .='</tr>';
						$table .='</table>';
                        $table.='<textarea style="position:relative;left:80%;" cols="31" id="text-area3" placeholder="observaciones"></textarea>';						
						$table .='<br></br>';
						

											
	                $table.='</tr>';
					$table.='<button id="btnguarda" type="button" onclick="guarda()" class="btn btn-outline-primary" client="'.$cliente.'" disabled>GUARDAR</button>';
					$table .='          ';
					
					
				$table .='</div>';
	          
				
		              
    }else{
		
		        $estado  = -200;
				$mensaje = "No se encontro información de ejecutivo";
		
		
	}

 }	else{
	 
	 
	 $estado  = -100;
			$mensaje = pg_last_error($conexion);
 }
 pg_close($conexion);
	    $salidaJSON = array('estados'=>$estado, 'tabla'=>$table , 'mensajes'=>$mensaje , 'query'=>$query , 'query2'=>$query2 ,'query3'=>$query3 , 'query4'=>$query4);
	    print json_encode($salidaJSON);
		
		
}


function certificacion(){
	
	$conexion = pg_connect("host=10.44.2.128 dbname=appwebcat user=reportes password=ff7b3106de28225ca601288654f6c57a");
	
	 //$empleado = $_POST['empleado'];
	
	 //$nombre = $_POST['nombre'];
	
	 $servicio = $_POST['Servicios'];
	 
	 $data_ID = $_POST['dataID'];
	 
	$table = "";
	 
	
	$query = "select aspectos_tecnicos from  check_evaluacion where id_servicio='".$servicio."'";
	$query2 = "select aspectos_especializados from check_evaluacion where id_servicio='".$servicio."'";
	$query3 = "select aspectos_calidez from check_evaluacion where id_servicio='".$servicio."'";
	
	 $rs = pg_query($conexion,$query);
	 $rs2 = pg_query($conexion,$query2);
	 $rs3 = pg_query($conexion,$query3);
	 
	 if($rs and $rs2 and $rs3)
	 {
        $campos = pg_num_rows($rs);
		$campos2 = pg_num_rows($rs2);
		$campos3 = pg_num_rows($rs3);

        if($campos>0 and $campos2>0 and $campos3>0)
		{

	     $count = 0;
         $estado  = 1;
	     $mensaje = "OK";
	    
         $table .= '<div id="check_aspectos_tecnicos">';
		 $table .= '<table  class="table table-striped table-bordered"  border=2  id="suptable1"  style="text-align:center;vertical-align:middle;width:100%;">';
		 $table .= '<thead style="background-color:#85C1E9" >';
		 $table .= '<tr id="table_consulta_check">';
		 $table.='<th style="width:70%;text-align:left;" colspan="4" id="subtitle">Aspectos Tecnicos</th>';
		 
         $table.='</tr>';
		 $table.='</thead>';
		 
		 
		 $table.='<tr>';
		 $table.='<td nowrap></td>';
		 $table.='<td nowrap>Puntos a evaluar</td>';
		 $table.='<td nowrap>¿Cumplio o no cumplio?</td>';
		 $table.='<td nowrap rowspan="5">Observaciones
		  <br></br>
		 <textarea rows="10" cols="40" maxlength="200" id="txtarea-certificacion1"></textarea>
		 
		 </td>';
		 $table.='</tr>';
		 
		 while($Tabla1=pg_fetch_array($rs))
		 {
			$count++; 
			 $table.='<tr id="#'.$count.'" class="num_filas2">';
						$table .='<td nowrap style="width:2%;text-align:center;">'.$count.'</td>';
						$table .='<td nowrap style="width:40%;text-align:center;">'.$Tabla1['aspectos_tecnicos'].'</td>';
						$table .='<td nowrap style="width:10%;text-align:center;" class="check_cumplir1"><input type="checkbox" id="checka'.$count.'" ></td>';
				
		 }
		 
		               //$table .='<td  rowspan="3" nowrap></td>';
                       $table.='</table>';	
					   
					   
					   
					   //fin primera tabla
					   
           $count=0;				

				
		 $table .= '<div id="check_aspectos_especializados">';
		 $table .= '<table  class="table table-striped table-bordered"  border=2  id="suptable1"  style="text-align:center;vertical-align:middle;width:100%;">';
		 $table .= '<thead style="background-color:#85C1E9" >';
		 $table .= '<tr id="table_consulta_check">';
		 $table.='<th style="width:70%;text-align:left;" colspan="4" id="subtitle">Aspectos Especializados</th>';
		 
         $table.='</tr>';
		 $table.='</thead>';
		 
		 
		 $table.='<tr>';
		 $table.='<td nowrap></td>';
		 $table.='<td nowrap>Puntos a evaluar</td>';
		 $table.='<td nowrap>¿Cumplio o no cumplio?</td>';
		 $table.='<td nowrap rowspan="5">Observaciones
		  <br></br>
		 <textarea rows="10" cols="40" maxlength="200" id="txtarea-certificacion2"></textarea>
		 
		 </td>';
		 $table.='</tr>';
		 
		 while($Tabla2=pg_fetch_array($rs2))
		 {
			$count++; 
			 $table.='<tr id="#'.$count.'" class="num_filas2">';
						$table .='<td nowrap style="width:2%;text-align:center;">'.$count.'</td>';
						$table .='<td nowrap style="width:40%;text-align:center;" >'.$Tabla2['aspectos_especializados'].'</td>';
						$table .='<td nowrap style="width:10%;text-align:center;" class="check_cumplir2" ><input type="checkbox" id="checkb'.$count.'" ></td>';
				
		 }
		 
		               //$table .='<td  rowspan="3" nowrap ></td>';
                       $table.='</table>';	
					   
					  
					   
					   //fin segunda tabla
					   
         $count=0;				
				
		 $table .= '<div id="check_dialogo_calido">';
		 $table .= '<table  class="table table-striped table-bordered"  border=2  id="suptable1"  style="text-align:center;vertical-align:middle;width:100%;">';
		 $table .= '<thead style="background-color:#85C1E9" >';
		 $table .= '<tr id="table_consulta_check">';
		 $table.='<th style="width:70%;text-align:left;" colspan="4" id="subtitle">Dialogo Calido</th>';
		 
         $table.='</tr>';
		 $table.='</thead>';
		 
		 
		 $table.='<tr>';
		 $table.='<td nowrap></td>';
		 $table.='<td nowrap>Puntos a evaluar</td>';
		 $table.='<td nowrap>¿Cumplio o no cumplio?</td>';
		 $table.='<td nowrap rowspan="5">Observaciones
		 <br></br>
		 <textarea rows="10" cols="40" maxlength="200" id="txtarea-certificacion3" ></textarea>
		 </td>';
		 $table.='</tr>';
		 
		 while($Tabla3=pg_fetch_array($rs3))
		 {
			$count++; 
			 $table.='<tr id="#'.$count.'" class="num_filas2">';
						$table .='<td nowrap style="width:2%;text-align:center;">'.$count.'</td>';
						$table .='<td nowrap style="width:40%;text-align:center;" >'.$Tabla3['aspectos_calidez'].'</td>';
						$table .='<td nowrap style="width:10%;text-align:center;" class="check_cumplir3"><input type="checkbox" id="checkc'.$count.'" ></td>';
				
		 }
		 
		               //$table .='<td  rowspan="3" nowrap ></td>';
                       $table.='</table>';	
					   
					   $table.='<button id="button_master" type="button" class="btn btn-primary" dataID="'.$data_ID.'"  onclick="guarda_plantilla_certificacion()">GUARDAR</button>';
					   

		}else{
			
			 $estado  = -200;
				$mensaje = "No se encontro información";
			
		}

			 
	 }else{
		 
		  $estado  = -100;
			$mensaje = pg_last_error($conexion);
		 
		 
	 }
	 
	 pg_close($conexion);
	    $salidaJSON = array('estados'=>$estado, 'tabla'=>$table , 'mensajes'=>$mensaje , 'query'=>$query , 'query2'=>$query2 ,'query3'=>$query3,'dataID'=>$data_ID);
	    print json_encode($salidaJSON);
		 
	
}
		
?>