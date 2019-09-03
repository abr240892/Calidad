<?php
$conexion = pg_connect("host=10.44.2.128 dbname=appwebcat user=reportes password=ff7b3106de28225ca601288654f6c57a");
 
   

  $opc = $_POST['opc'];
	switch ($opc) {
		case 'COBRANZA COPPEL':
			cobranzaCoppel();
			break;
		case 'COBRANZA BANCOPPEL':
			cobranzaBancoppel();
			break;
		case 'COBRANZA ARGENTINA':
			cobranzaArgentina();
			break;
		case 'PROMOCION COPPEL':
			promocionCoppel();
			break;
		case 'SOLICITANTES BANCO':
			solicitantesBanco();
			break;
        case 'SOLICITUD DE CREDITO':
		     solicitudCredito();
			break;
		case 'VENTAS':
             ventas();
            break;
        case 'ATENCION COPPEL':
             atencionCoppel();
            break;
        case 'ATENCION ARGENTINA':
             atencionArgentina();
            break;
        case 'ATENCION ZUUM':
		     atencionZuum();
			break;
		case 'ATENCION AFORE':
		     atencionAfore();
			 break;
		case 'ATENCION SOPORTE TECNICO':
		     atencionSoporte();
			 break;	 
		case 'CAMPANAS UNICAS':
		     campanasUnicas();
			 break;
		case 'PROMOCION BANCOPPEL':
             promocionBancoppel();
             break;
        case 'PROMOCION COPPEL ARGENTINA':
             promocionCoppelArgentina();
             break;
		case 'ATENCION A CLIENTES BANCOPPEL':
             atencionClientesBancoppel();
             break;	 
		default:
			# code...
			break;
	}

//funcion para plantilla cobranza coppel
function cobranzaCoppel(){

    $conexion = pg_connect("host=10.44.2.128 dbname=appwebcat user=reportes password=ff7b3106de28225ca601288654f6c57a");

	$DATA = json_decode($_POST['array']);
	var_dump($DATA);
	
	$ALGO = json_decode($_POST['ponderados']);
    var_dump($ALGO);
	
	echo "cobranza coppel";
	
    $estado = 0;

	$query = "delete from  calidad_pregunta where id = '1'"; 
	
	$result = pg_query($conexion,$query);
	
for($i=0;$i<count($DATA);$i++){	

	/*  
	$query = "update calidad_pregunta set id = '1',id_campana = '".$DATA[$i]['combobit']."',id_apartado = '1',pregunta = '".$DATA[$i]['st1_colum2']."',porcentaje_pregunta = '".$DATA[$i]['st1_colum3']."' where id_apartado = '1'";

	$query2 = "update calidad_pregunta set id = '1',id_campana = '".$DATA[$i]['combobit']."',id_apartado = '2',pregunta = '".$DATA[$i]['st2_colum2']."',porcentaje_pregunta = '".$DATA[$i]['st2_colum3']."' where id_apartado = '2'";
		
	$query3 = "update calidad_pregunta set id = '1',id_campana = '".$DATA[$i]['combobit']."',id_apartado = '3',pregunta = '".$DATA[$i]['st3_colum2']."',porcentaje_pregunta = '".$DATA[$i]['st2_colum3']."' where id_apartado = '3'";
*/
      
    $query2 = "insert into calidad_pregunta values(1,".$DATA[$i]->combobit.",1,'".$DATA[$i]->st1_colum2."',".$DATA[$i]->st1_colum3.",'EN REVISION')";
	  
    $query3 = "insert into calidad_pregunta values(1,".$DATA[$i]->combobit.",2,'".$DATA[$i]->st2_colum2."',".$DATA[$i]->st2_colum3.",'EN REVISION')";
  
    $query4 = "insert into calidad_pregunta values(1,".$DATA[$i]->combobit.",3,'".$DATA[$i]->st3_colum2."',".$DATA[$i]->st3_colum3.",'EN REVISION')";

    echo($query2);
	echo($query3);
	echo($query4);
	
  
  $result2 = pg_query($conexion,$query2);
  
  $result3 = pg_query($conexion,$query3);
  
  $result4 = pg_query($conexion,$query4);
  
}

$query5="delete from nombre_ponderado where id = '1'";
		
//$query6 ="update nombre_ponderado set id = '1',id_campana = '".$ALGO[0]->combobit."',id_apartado = '1',pregunta = '".$ALGO[0]->ponderado_1."',porcentaje_pregunta = '".$ALGO[0]->Porcentaje1."' where id_apartado = '1'";

//$query7 ="update nombre_ponderado set id = '1',id_campana = '".$ALGO[1]->combobit."',id_apartado = '2',pregunta = '".$ALGO[1]->ponderado_2."',porcentaje_pregunta = '".$ALGO[1]->Porcentaje2."' where id_apartado = '2'";

//$query8 ="update nombre_ponderado set id = '1',id_campana = '".$ALGO[2]->combobit."',id_apartado = '3',pregunta = '".$ALGO[2]->ponderado_3."',porcentaje_pregunta = '".$ALGO[2]->Porcentaje3."' where id_apartado = '3'";

    $query6 = "insert into nombre_ponderado values(1,'".$ALGO[0]->combobit."',1,'".$ALGO[0]->ponderado_1."','".$ALGO[0]->Porcentaje1."')";
	  
    $query7 = "insert into nombre_ponderado values(1,'".$ALGO[1]->combobit."',2,'".$ALGO[1]->ponderado_2."','".$ALGO[1]->Porcentaje2."')";
  
    $query8 = "insert into nombre_ponderado values(1,'".$ALGO[2]->combobit."',3,'".$ALGO[2]->ponderado_3."','".$ALGO[2]->Porcentaje3."')";


 $result5 = pg_query($conexion,$query5);

 $result6 = pg_query($conexion,$query6);
 
 $result7 = pg_query($conexion,$query7);
 
 $result8 = pg_query($conexion,$query8);
  	 
	 $estado = 1;
 
$salidaJSON = array('query'=>$query, 'query2'=>$query2 , 'query3'=>$query3 ,'query4'=>$query4,'query5'=>$query5,'query6'=>$query6,'query7'=>$query7,'query8'=>$query8, 'query9'=>$DATA);
	    print json_encode($salidaJSON);
}


//funcion para plantilla cobranza bancoppel
function cobranzaBancoppel(){
	
	$DATA = json_decode($_POST['array']);
	var_dump($DATA);
	
	$ALGO = json_decode($_POST['ponderados']);
    var_dump($ALGO);
	
	echo "cobranza bancoppel";

	$query = "delete from  calidad_pregunta where id = '2'"; 
	
	$result = pg_query($query);
	
for($i=0;$i<count($DATA);$i++){	

	/*  
	$query = "update calidad_pregunta set id = '2',id_campana = '".$DATA[$i]['combobit']."',id_apartado = '1',pregunta = '".$DATA[$i]['st1_colum2']."',porcentaje_pregunta = '".$DATA[$i]['st1_colum3']."' where id_apartado = '1'";

	$query2 = "update calidad_pregunta set id = '2',id_campana = '".$DATA[$i]['combobit']."',id_apartado = '2',pregunta = '".$DATA[$i]['st2_colum2']."',porcentaje_pregunta = '".$DATA[$i]['st2_colum3']."' where id_apartado = '2'";
		
	$query3 = "update calidad_pregunta set id = '2',id_campana = '".$DATA[$i]['combobit']."',id_apartado = '3',pregunta = '".$DATA[$i]['st3_colum2']."',porcentaje_pregunta = '".$DATA[$i]['st2_colum3']."' where id_apartado = '3'";
*/
      
    $query2 = "insert into calidad_pregunta values(2,'".$DATA[$i]->combobit."',1,'".$DATA[$i]->st1_colum2."',".$DATA[$i]->st1_colum3.",'EN REVISION')";
	  
    $query3 = "insert into calidad_pregunta values(2,'".$DATA[$i]->combobit."',2,'".$DATA[$i]->st2_colum2."',".$DATA[$i]->st2_colum3.",'EN REVISION')";
  
    $query4 = "insert into calidad_pregunta values(2,'".$DATA[$i]->combobit."',3,'".$DATA[$i]->st3_colum2."',".$DATA[$i]->st3_colum3.",'EN REVISION')";


  
  $result2 = pg_query($query2);
  
  $result3 = pg_query($query3);
  
  $result4 = pg_query($query4);
  
}

$query5="delete from nombre_ponderado where id = '2'";
		
//$query6 ="update nombre_ponderado set id = '2',id_campana = '".$ALGO[0]->combobit."',id_apartado = '1',pregunta = '".$ALGO[0]->ponderado_1."',porcentaje_pregunta = '".$ALGO[0]->Porcentaje1."' where id_apartado = '1'";

//$query7 ="update nombre_ponderado set id = '2',id_campana = '".$ALGO[1]->combobit."',id_apartado = '2',pregunta = '".$ALGO[1]->ponderado_2."',porcentaje_pregunta = '".$ALGO[1]->Porcentaje2."' where id_apartado = '2'";

//$query8 ="update nombre_ponderado set id = '2',id_campana = '".$ALGO[2]->combobit."',id_apartado = '3',pregunta = '".$ALGO[2]->ponderado_3."',porcentaje_pregunta = '".$ALGO[2]->Porcentaje3."' where id_apartado = '3'";

    $query6 = "insert into nombre_ponderado values(2,'".$ALGO[0]->combobit."',1,'".$ALGO[0]->ponderado_1."','".$ALGO[0]->Porcentaje1."')";
	  
    $query7 = "insert into nombre_ponderado values(2,'".$ALGO[1]->combobit."',2,'".$ALGO[1]->ponderado_2."','".$ALGO[1]->Porcentaje2."')";
  
    $query8 = "insert into nombre_ponderado values(2,'".$ALGO[2]->combobit."',3,'".$ALGO[2]->ponderado_3."','".$ALGO[2]->Porcentaje3."')";



 $result5 = pg_query($query5);

 $result6 = pg_query($query6);
 
 $result7 = pg_query($query7);
 
 $result8 = pg_query($query8);

 
  $salidaJSON = array('query'=>$query, 'query2'=>$query2 , 'query3'=>$query3 ,'query4'=>$query4,'query5'=>$query5,'query6'=>$query6,'query7'=>$query7,'query8'=>$query8, 'query9'=>$DATA);
	    print json_encode($salidaJSON);
	
	
}

//function cobranzaArgentina

function cobranzaArgentina(){
	
   $DATA = json_decode($_POST['array']);
	var_dump($DATA);
	
	$ALGO = json_decode($_POST['ponderados']);
    var_dump($ALGO);
	
	echo "cobranza argentina";

	$query = "delete from  calidad_pregunta where id = '3'"; 
	
	$result = pg_query($query);
	
for($i=0;$i<count($DATA);$i++){	

/*  
	$query = "update calidad_pregunta set id = '3',id_campana = '".$DATA[$i]['combobit']."',id_apartado = '1',pregunta = '".$DATA[$i]['st1_colum2']."',porcentaje_pregunta = '".$DATA[$i]['st1_colum3']."' where id_apartado = '1'";

	$query2 = "update calidad_pregunta set id = '3',id_campana = '".$DATA[$i]['combobit']."',id_apartado = '2',pregunta = '".$DATA[$i]['st2_colum2']."',porcentaje_pregunta = '".$DATA[$i]['st2_colum3']."' where id_apartado = '2'";
		
	$query3 = "update calidad_pregunta set id = '3',id_campana = '".$DATA[$i]['combobit']."',id_apartado = '3',pregunta = '".$DATA[$i]['st3_colum2']."',porcentaje_pregunta = '".$DATA[$i]['st2_colum3']."' where id_apartado = '3'";
*/
      
    $query2 = "insert into calidad_pregunta values(3,'".$DATA[$i]->combobit."',1,'".$DATA[$i]->st1_colum2."',".$DATA[$i]->st1_colum3.",'EN REVISION')";
	  
    $query3 = "insert into calidad_pregunta values(3,'".$DATA[$i]->combobit."',2,'".$DATA[$i]->st2_colum2."',".$DATA[$i]->st2_colum3.",'EN REVISION')";
  
    $query4 = "insert into calidad_pregunta values(3,'".$DATA[$i]->combobit."',3,'".$DATA[$i]->st3_colum2."',".$DATA[$i]->st3_colum3.",'EN REVISION')";


  
  $result2 = pg_query($query2);
  
  $result3 = pg_query($query3);
  
  $result4 = pg_query($query4);
  
}
$query5="delete from nombre_ponderado where id = '3'";
		
//$query6 ="update nombre_ponderado set id = '3',id_campana = '".$ALGO[0]->combobit."',id_apartado = '1',pregunta = '".$ALGO[0]->ponderado_1."',porcentaje_pregunta = '".$ALGO[0]->Porcentaje1."' where id_apartado = '1'";

//$query7 ="update nombre_ponderado set id = '3',id_campana = '".$ALGO[1]->combobit."',id_apartado = '2',pregunta = '".$ALGO[1]->ponderado_2."',porcentaje_pregunta = '".$ALGO[1]->Porcentaje2."' where id_apartado = '2'";

//$query8 ="update nombre_ponderado set id = '3',id_campana = '".$ALGO[2]->combobit."',id_apartado = '3',pregunta = '".$ALGO[2]->ponderado_3."',porcentaje_pregunta = '".$ALGO[2]->Porcentaje3."' where id_apartado = '3'";

    $query6 = "insert into nombre_ponderado values(3,'".$ALGO[0]->combobit."',1,'".$ALGO[0]->ponderado_1."','".$ALGO[0]->Porcentaje1."')";
	  
    $query7 = "insert into nombre_ponderado values(3,'".$ALGO[1]->combobit."',2,'".$ALGO[1]->ponderado_2."','".$ALGO[1]->Porcentaje2."')";
  
    $query8 = "insert into nombre_ponderado values(3,'".$ALGO[2]->combobit."',3,'".$ALGO[2]->ponderado_3."','".$ALGO[2]->Porcentaje3."')";



 $result5 = pg_query($query5);

 $result6 = pg_query($query6);
 
 $result7 = pg_query($query7);
 
 $result8 = pg_query($query8);

 
  $salidaJSON = array('query'=>$query, 'query2'=>$query2 , 'query3'=>$query3 ,'query4'=>$query4,'query5'=>$query5,'query6'=>$query6,'query7'=>$query7,'query8'=>$query8, 'query9'=>$DATA);
	    print json_encode($salidaJSON);
	
	
}

 function promocionCoppel(){
	 
	    $DATA = json_decode($_POST['array']);
	var_dump($DATA);
	
	$ALGO = json_decode($_POST['ponderados']);
    var_dump($ALGO);
	
	echo "promocion coppel";

	$query = "delete from  calidad_pregunta where id = '4'"; 
	
	$result = pg_query($query);
	
for($i=0;$i<count($DATA);$i++){	

/*  
	$query = "update calidad_pregunta set id = '4',id_campana = '".$DATA[$i]['combobit']."',id_apartado = '1',pregunta = '".$DATA[$i]['st1_colum2']."',porcentaje_pregunta = '".$DATA[$i]['st1_colum3']."' where id_apartado = '1'";

	$query2 = "update calidad_pregunta set id = '4',id_campana = '".$DATA[$i]['combobit']."',id_apartado = '2',pregunta = '".$DATA[$i]['st2_colum2']."',porcentaje_pregunta = '".$DATA[$i]['st2_colum3']."' where id_apartado = '2'";
		
	$query3 = "update calidad_pregunta set id = '4',id_campana = '".$DATA[$i]['combobit']."',id_apartado = '3',pregunta = '".$DATA[$i]['st3_colum2']."',porcentaje_pregunta = '".$DATA[$i]['st2_colum3']."' where id_apartado = '3'";
*/
      
    $query2 = "insert into calidad_pregunta values(4,'".$DATA[$i]->combobit."',1,'".$DATA[$i]->st1_colum2."',".$DATA[$i]->st1_colum3.",'EN REVISION')";
	  
    $query3 = "insert into calidad_pregunta values(4,'".$DATA[$i]->combobit."',2,'".$DATA[$i]->st2_colum2."',".$DATA[$i]->st2_colum3.",'EN REVISION')";
  
    $query4 = "insert into calidad_pregunta values(4,'".$DATA[$i]->combobit."',3,'".$DATA[$i]->st3_colum2."',".$DATA[$i]->st3_colum3.",'EN REVISION')";


  
  $result2 = pg_query($query2);
  
  $result3 = pg_query($query3);
  
  $result4 = pg_query($query4);
  
}

$query5="delete from nombre_ponderado where id = '4'";
		
//$query6 ="update nombre_ponderado set id = '4',id_campana = '".$ALGO[0]->combobit."',id_apartado = '1',pregunta = '".$ALGO[0]->ponderado_1."',porcentaje_pregunta = '".$ALGO[0]->Porcentaje1."' where id_apartado = '1'";

//$query7 ="update nombre_ponderado set id = '4',id_campana = '".$ALGO[1]->combobit."',id_apartado = '2',pregunta = '".$ALGO[1]->ponderado_2."',porcentaje_pregunta = '".$ALGO[1]->Porcentaje2."' where id_apartado = '2'";

//$query8 ="update nombre_ponderado set id = '4',id_campana = '".$ALGO[2]->combobit."',id_apartado = '3',pregunta = '".$ALGO[2]->ponderado_3."',porcentaje_pregunta = '".$ALGO[2]->Porcentaje3."' where id_apartado = '3'";

    $query6 = "insert into nombre_ponderado values(4,'".$ALGO[0]->combobit."',1,'".$ALGO[0]->ponderado_1."','".$ALGO[0]->Porcentaje1."')";
	  
    $query7 = "insert into nombre_ponderado values(4,'".$ALGO[1]->combobit."',2,'".$ALGO[1]->ponderado_2."','".$ALGO[1]->Porcentaje2."')";
  
    $query8 = "insert into nombre_ponderado values(4,'".$ALGO[2]->combobit."',3,'".$ALGO[2]->ponderado_3."','".$ALGO[2]->Porcentaje3."')";



 $result5 = pg_query($query5);

 $result6 = pg_query($query6);
 
 $result7 = pg_query($query7);
 
 $result8 = pg_query($query8);

 
  $salidaJSON = array('query'=>$query, 'query2'=>$query2 , 'query3'=>$query3 ,'query4'=>$query4,'query5'=>$query5,'query6'=>$query6,'query7'=>$query7,'query8'=>$query8, 'query9'=>$DATA);
	    print json_encode($salidaJSON);
	 
 }
 
 function solicitantesBanco(){
	 
	 	    $DATA = json_decode($_POST['array']);
	var_dump($DATA);
	
	$ALGO = json_decode($_POST['ponderados']);
    var_dump($ALGO);
	
	echo "solicitantes banco";

	$query = "delete from  calidad_pregunta where id = '5'"; 
	
	$result = pg_query($query);
	
for($i=0;$i<count($DATA);$i++){	

/*  
	$query = "update calidad_pregunta set id = '5',id_campana = '".$DATA[$i]['combobit']."',id_apartado = '1',pregunta = '".$DATA[$i]['st1_colum2']."',porcentaje_pregunta = '".$DATA[$i]['st1_colum3']."' where id_apartado = '1'";

	$query2 = "update calidad_pregunta set id = '5',id_campana = '".$DATA[$i]['combobit']."',id_apartado = '2',pregunta = '".$DATA[$i]['st2_colum2']."',porcentaje_pregunta = '".$DATA[$i]['st2_colum3']."' where id_apartado = '2'";
		
	$query3 = "update calidad_pregunta set id = '5',id_campana = '".$DATA[$i]['combobit']."',id_apartado = '3',pregunta = '".$DATA[$i]['st3_colum2']."',porcentaje_pregunta = '".$DATA[$i]['st2_colum3']."' where id_apartado = '3'";
*/
      
    $query2 = "insert into calidad_pregunta values(5,'".$DATA[$i]->combobit."',1,'".$DATA[$i]->st1_colum2."',".$DATA[$i]->st1_colum3.",'EN REVISION')";
	  
    $query3 = "insert into calidad_pregunta values(5,'".$DATA[$i]->combobit."',2,'".$DATA[$i]->st2_colum2."',".$DATA[$i]->st2_colum3.",'EN REVISION')";
  
    $query4 = "insert into calidad_pregunta values(5,'".$DATA[$i]->combobit."',3,'".$DATA[$i]->st3_colum2."',".$DATA[$i]->st3_colum3.",'EN REVISION')";


  
  $result2 = pg_query($query2);
  
  $result3 = pg_query($query3);
  
  $result4 = pg_query($query4);
  
}

$query5="delete from nombre_ponderado where id = '5'";
		
//$query6 ="update nombre_ponderado set id = '5',id_campana = '".$ALGO[0]->combobit."',id_apartado = '1',pregunta = '".$ALGO[0]->ponderado_1."',porcentaje_pregunta = '".$ALGO[0]->Porcentaje1."' where id_apartado = '1'";

//$query7 ="update nombre_ponderado set id = '5',id_campana = '".$ALGO[1]->combobit."',id_apartado = '2',pregunta = '".$ALGO[1]->ponderado_2."',porcentaje_pregunta = '".$ALGO[1]->Porcentaje2."' where id_apartado = '2'";

//$query8 ="update nombre_ponderado set id = '5',id_campana = '".$ALGO[2]->combobit."',id_apartado = '3',pregunta = '".$ALGO[2]->ponderado_3."',porcentaje_pregunta = '".$ALGO[2]->Porcentaje3."' where id_apartado = '3'";

    $query6 = "insert into nombre_ponderado values(5,'".$ALGO[0]->combobit."',1,'".$ALGO[0]->ponderado_1."','".$ALGO[0]->Porcentaje1."')";
	  
    $query7 = "insert into nombre_ponderado values(5,'".$ALGO[1]->combobit."',2,'".$ALGO[1]->ponderado_2."','".$ALGO[1]->Porcentaje2."')";
  
    $query8 = "insert into nombre_ponderado values(5,'".$ALGO[2]->combobit."',3,'".$ALGO[2]->ponderado_3."','".$ALGO[2]->Porcentaje3."')";



 $result5 = pg_query($query5);

 $result6 = pg_query($query6);
 
 $result7 = pg_query($query7);
 
 $result8 = pg_query($query8);

 
  $salidaJSON = array('query'=>$query, 'query2'=>$query2 , 'query3'=>$query3 ,'query4'=>$query4,'query5'=>$query5,'query6'=>$query6,'query7'=>$query7,'query8'=>$query8, 'query9'=>$DATA);
	    print json_encode($salidaJSON);
	 
 }
 
 function solicitudCredito(){
	 
	 	 	    $DATA = json_decode($_POST['array']);
	var_dump($DATA);
	
	$ALGO = json_decode($_POST['ponderados']);
    var_dump($ALGO);
	
	echo "solicitud credito";

	$query = "delete from  calidad_pregunta where id = '6'"; 
	
	$result = pg_query($query);
	
for($i=0;$i<count($DATA);$i++){	

/*  
	$query = "update calidad_pregunta set id = '6',id_campana = '".$DATA[$i]['combobit']."',id_apartado = '1',pregunta = '".$DATA[$i]['st1_colum2']."',porcentaje_pregunta = '".$DATA[$i]['st1_colum3']."' where id_apartado = '1'";

	$query2 = "update calidad_pregunta set id = '6',id_campana = '".$DATA[$i]['combobit']."',id_apartado = '2',pregunta = '".$DATA[$i]['st2_colum2']."',porcentaje_pregunta = '".$DATA[$i]['st2_colum3']."' where id_apartado = '2'";
		
	$query3 = "update calidad_pregunta set id = '6',id_campana = '".$DATA[$i]['combobit']."',id_apartado = '3',pregunta = '".$DATA[$i]['st3_colum2']."',porcentaje_pregunta = '".$DATA[$i]['st2_colum3']."' where id_apartado = '3'";
*/
      
    $query2 = "insert into calidad_pregunta values(6,'".$DATA[$i]->combobit."',1,'".$DATA[$i]->st1_colum2."',".$DATA[$i]->st1_colum3.",'EN REVISION')";
	  
    $query3 = "insert into calidad_pregunta values(6,'".$DATA[$i]->combobit."',2,'".$DATA[$i]->st2_colum2."',".$DATA[$i]->st2_colum3.",'EN REVISION')";
  
    $query4 = "insert into calidad_pregunta values(6,'".$DATA[$i]->combobit."',3,'".$DATA[$i]->st3_colum2."',".$DATA[$i]->st3_colum3.",'EN REVISION')";


  
  $result2 = pg_query($query2);
  
  $result3 = pg_query($query3);
  
  $result4 = pg_query($query4);
  
}

$query5="delete from nombre_ponderado where id = '6'";
		
//$query6 ="update nombre_ponderado set id = '6',id_campana = '".$ALGO[0]->combobit."',id_apartado = '1',pregunta = '".$ALGO[0]->ponderado_1."',porcentaje_pregunta = '".$ALGO[0]->Porcentaje1."' where id_apartado = '1'";

//$query7 ="update nombre_ponderado set id = '6',id_campana = '".$ALGO[1]->combobit."',id_apartado = '2',pregunta = '".$ALGO[1]->ponderado_2."',porcentaje_pregunta = '".$ALGO[1]->Porcentaje2."' where id_apartado = '2'";

//$query8 ="update nombre_ponderado set id = '6',id_campana = '".$ALGO[2]->combobit."',id_apartado = '3',pregunta = '".$ALGO[2]->ponderado_3."',porcentaje_pregunta = '".$ALGO[2]->Porcentaje3."' where id_apartado = '3'";

    $query6 = "insert into nombre_ponderado values(6,'".$ALGO[0]->combobit."',1,'".$ALGO[0]->ponderado_1."','".$ALGO[0]->Porcentaje1."')";
	  
    $query7 = "insert into nombre_ponderado values(6,'".$ALGO[1]->combobit."',2,'".$ALGO[1]->ponderado_2."','".$ALGO[1]->Porcentaje2."')";
  
    $query8 = "insert into nombre_ponderado values(6,'".$ALGO[2]->combobit."',3,'".$ALGO[2]->ponderado_3."','".$ALGO[2]->Porcentaje3."')";



 $result5 = pg_query($query5);

 $result6 = pg_query($query6);
 
 $result7 = pg_query($query7);
 
 $result8 = pg_query($query8);

 
  $salidaJSON = array('query'=>$query, 'query2'=>$query2 , 'query3'=>$query3 ,'query4'=>$query4,'query5'=>$query5,'query6'=>$query6,'query7'=>$query7,'query8'=>$query8, 'query9'=>$DATA);
	    print json_encode($salidaJSON);
	 
 }
 
 function ventas(){
	 
	$DATA = json_decode($_POST['array']);
	var_dump($DATA);
	
	$ALGO = json_decode($_POST['ponderados']);
    var_dump($ALGO);
	
	echo "ventas";

	$query = "delete from  calidad_pregunta where id = '7'"; 
	
	$result = pg_query($query);
	
for($i=0;$i<count($DATA);$i++){	

/*  
	$query = "update calidad_pregunta set id = '7',id_campana = '".$DATA[$i]['combobit']."',id_apartado = '1',pregunta = '".$DATA[$i]['st1_colum2']."',porcentaje_pregunta = '".$DATA[$i]['st1_colum3']."' where id_apartado = '1'";

	$query2 = "update calidad_pregunta set id = '7',id_campana = '".$DATA[$i]['combobit']."',id_apartado = '2',pregunta = '".$DATA[$i]['st2_colum2']."',porcentaje_pregunta = '".$DATA[$i]['st2_colum3']."' where id_apartado = '2'";
		
	$query3 = "update calidad_pregunta set id = '7',id_campana = '".$DATA[$i]['combobit']."',id_apartado = '3',pregunta = '".$DATA[$i]['st3_colum2']."',porcentaje_pregunta = '".$DATA[$i]['st2_colum3']."' where id_apartado = '3'";
*/
      
    $query2 = "insert into calidad_pregunta values(7,'".$DATA[$i]->combobit."',1,'".$DATA[$i]->st1_colum2."',".$DATA[$i]->st1_colum3.",'EN REVISION')";
	  
    $query3 = "insert into calidad_pregunta values(7,'".$DATA[$i]->combobit."',2,'".$DATA[$i]->st2_colum2."',".$DATA[$i]->st2_colum3.",'EN REVISION')";
  
    $query4 = "insert into calidad_pregunta values(7,'".$DATA[$i]->combobit."',3,'".$DATA[$i]->st3_colum2."',".$DATA[$i]->st3_colum3.",'EN REVISION')";


  
  $result2 = pg_query($query2);
  
  $result3 = pg_query($query3);
  
  $result4 = pg_query($query4);
  
}

$query5="delete from nombre_ponderado where id = '7'";
		
//$query6 ="update nombre_ponderado set id = '7',id_campana = '".$ALGO[0]->combobit."',id_apartado = '1',pregunta = '".$ALGO[0]->ponderado_1."',porcentaje_pregunta = '".$ALGO[0]->Porcentaje1."' where id_apartado = '1'";

//$query7 ="update nombre_ponderado set id = '7',id_campana = '".$ALGO[1]->combobit."',id_apartado = '2',pregunta = '".$ALGO[1]->ponderado_2."',porcentaje_pregunta = '".$ALGO[1]->Porcentaje2."' where id_apartado = '2'";

//$query8 ="update nombre_ponderado set id = '7',id_campana = '".$ALGO[2]->combobit."',id_apartado = '3',pregunta = '".$ALGO[2]->ponderado_3."',porcentaje_pregunta = '".$ALGO[2]->Porcentaje3."' where id_apartado = '3'";

    $query6 = "insert into nombre_ponderado values(7,'".$ALGO[0]->combobit."',1,'".$ALGO[0]->ponderado_1."','".$ALGO[0]->Porcentaje1."')";
	  
    $query7 = "insert into nombre_ponderado values(7,'".$ALGO[1]->combobit."',2,'".$ALGO[1]->ponderado_2."','".$ALGO[1]->Porcentaje2."')";
  
    $query8 = "insert into nombre_ponderado values(7,'".$ALGO[2]->combobit."',3,'".$ALGO[2]->ponderado_3."','".$ALGO[2]->Porcentaje3."')";



 $result5 = pg_query($query5);

 $result6 = pg_query($query6);
 
 $result7 = pg_query($query7);
 
 $result8 = pg_query($query8);

 
  $salidaJSON = array('query'=>$query, 'query2'=>$query2 , 'query3'=>$query3 ,'query4'=>$query4,'query5'=>$query5,'query6'=>$query6,'query7'=>$query7,'query8'=>$query8, 'query9'=>$DATA);
	    print json_encode($salidaJSON);
	 
 }
 
 function  atencionCoppel(){
	 
   $DATA = json_decode($_POST['array']);
	var_dump($DATA);
	
	$ALGO = json_decode($_POST['ponderados']);
    var_dump($ALGO);
	
	echo "atencion coppel";

	$query = "delete from  calidad_pregunta where id = '8'"; 
	
	$result = pg_query($query);
	
for($i=0;$i<count($DATA);$i++){	

/*  
	$query = "update calidad_pregunta set id = '8',id_campana = '".$DATA[$i]['combobit']."',id_apartado = '1',pregunta = '".$DATA[$i]['st1_colum2']."',porcentaje_pregunta = '".$DATA[$i]['st1_colum3']."' where id_apartado = '1'";

	$query2 = "update calidad_pregunta set id = '8',id_campana = '".$DATA[$i]['combobit']."',id_apartado = '2',pregunta = '".$DATA[$i]['st2_colum2']."',porcentaje_pregunta = '".$DATA[$i]['st2_colum3']."' where id_apartado = '2'";
		
	$query3 = "update calidad_pregunta set id = '8',id_campana = '".$DATA[$i]['combobit']."',id_apartado = '3',pregunta = '".$DATA[$i]['st3_colum2']."',porcentaje_pregunta = '".$DATA[$i]['st2_colum3']."' where id_apartado = '3'";
*/
      
    $query2 = "insert into calidad_pregunta values(8,'".$DATA[$i]->combobit."',1,'".$DATA[$i]->st1_colum2."',".$DATA[$i]->st1_colum3.",'EN REVISION')";
	  
    $query3 = "insert into calidad_pregunta values(8,'".$DATA[$i]->combobit."',2,'".$DATA[$i]->st2_colum2."',".$DATA[$i]->st2_colum3.",'EN REVISION')";
  
    $query4 = "insert into calidad_pregunta values(8,'".$DATA[$i]->combobit."',3,'".$DATA[$i]->st3_colum2."',".$DATA[$i]->st3_colum3.",'EN REVISION')";


  
  $result2 = pg_query($query2);
  
  $result3 = pg_query($query3);
  
  $result4 = pg_query($query4);
  
}

$query5="delete from nombre_ponderado where id = '8'";
		
//$query6 ="update nombre_ponderado set id = '8',id_campana = '".$ALGO[0]->combobit."',id_apartado = '1',pregunta = '".$ALGO[0]->ponderado_1."',porcentaje_pregunta = '".$ALGO[0]->Porcentaje1."' where id_apartado = '1'";

//$query7 ="update nombre_ponderado set id = '8',id_campana = '".$ALGO[1]->combobit."',id_apartado = '2',pregunta = '".$ALGO[1]->ponderado_2."',porcentaje_pregunta = '".$ALGO[1]->Porcentaje2."' where id_apartado = '2'";

//$query8 ="update nombre_ponderado set id = '8',id_campana = '".$ALGO[2]->combobit."',id_apartado = '3',pregunta = '".$ALGO[2]->ponderado_3."',porcentaje_pregunta = '".$ALGO[2]->Porcentaje3."' where id_apartado = '3'";

    $query6 = "insert into nombre_ponderado values(8,'".$ALGO[0]->combobit."',1,'".$ALGO[0]->ponderado_1."','".$ALGO[0]->Porcentaje1."')";
	  
    $query7 = "insert into nombre_ponderado values(8,'".$ALGO[1]->combobit."',2,'".$ALGO[1]->ponderado_2."','".$ALGO[1]->Porcentaje2."')";
  
    $query8 = "insert into nombre_ponderado values(8,'".$ALGO[2]->combobit."',3,'".$ALGO[2]->ponderado_3."','".$ALGO[2]->Porcentaje3."')";



 $result5 = pg_query($query5);

 $result6 = pg_query($query6);
 
 $result7 = pg_query($query7);
 
 $result8 = pg_query($query8);

 
  $salidaJSON = array('query'=>$query, 'query2'=>$query2 , 'query3'=>$query3 ,'query4'=>$query4,'query5'=>$query5,'query6'=>$query6,'query7'=>$query7,'query8'=>$query8, 'query9'=>$DATA);
	    print json_encode($salidaJSON);	
	
	 
 }
 
 function atencionArgentina(){
	 
	$DATA = json_decode($_POST['array']);
	var_dump($DATA);
	
	$ALGO = json_decode($_POST['ponderados']);
    var_dump($ALGO);
	
	echo "atencion argentina";

	$query = "delete from  calidad_pregunta where id = '9'"; 
	
	$result = pg_query($query);
	
for($i=0;$i<count($DATA);$i++){	

/*  
	$query = "update calidad_pregunta set id = '9',id_campana = '".$DATA[$i]['combobit']."',id_apartado = '1',pregunta = '".$DATA[$i]['st1_colum2']."',porcentaje_pregunta = '".$DATA[$i]['st1_colum3']."' where id_apartado = '1'";

	$query2 = "update calidad_pregunta set id = '9',id_campana = '".$DATA[$i]['combobit']."',id_apartado = '2',pregunta = '".$DATA[$i]['st2_colum2']."',porcentaje_pregunta = '".$DATA[$i]['st2_colum3']."' where id_apartado = '2'";
		
	$query3 = "update calidad_pregunta set id = '9',id_campana = '".$DATA[$i]['combobit']."',id_apartado = '3',pregunta = '".$DATA[$i]['st3_colum2']."',porcentaje_pregunta = '".$DATA[$i]['st2_colum3']."' where id_apartado = '3'";
*/
      
    $query2 = "insert into calidad_pregunta values(9,'".$DATA[$i]->combobit."',1,'".$DATA[$i]->st1_colum2."',".$DATA[$i]->st1_colum3.",'EN REVISION')";
	  
    $query3 = "insert into calidad_pregunta values(9,'".$DATA[$i]->combobit."',2,'".$DATA[$i]->st2_colum2."',".$DATA[$i]->st2_colum3.",'EN REVISION')";
  
    $query4 = "insert into calidad_pregunta values(9,'".$DATA[$i]->combobit."',3,'".$DATA[$i]->st3_colum2."',".$DATA[$i]->st3_colum3.",'EN REVISION')";


  
  $result2 = pg_query($query2);
  
  $result3 = pg_query($query3);
  
  $result4 = pg_query($query4);
  
}

$query5="delete from nombre_ponderado where id = '9'";
		
//$query6 ="update nombre_ponderado set id = '9',id_campana = '".$ALGO[0]->combobit."',id_apartado = '1',pregunta = '".$ALGO[0]->ponderado_1."',porcentaje_pregunta = '".$ALGO[0]->Porcentaje1."' where id_apartado = '1'";

//$query7 ="update nombre_ponderado set id = '9',id_campana = '".$ALGO[1]->combobit."',id_apartado = '2',pregunta = '".$ALGO[1]->ponderado_2."',porcentaje_pregunta = '".$ALGO[1]->Porcentaje2."' where id_apartado = '2'";

//$query8 ="update nombre_ponderado set id = '9',id_campana = '".$ALGO[2]->combobit."',id_apartado = '3',pregunta = '".$ALGO[2]->ponderado_3."',porcentaje_pregunta = '".$ALGO[2]->Porcentaje3."' where id_apartado = '3'";

    $query6 = "insert into nombre_ponderado values(9,'".$ALGO[0]->combobit."',1,'".$ALGO[0]->ponderado_1."','".$ALGO[0]->Porcentaje1."')";
	  
    $query7 = "insert into nombre_ponderado values(9,'".$ALGO[1]->combobit."',2,'".$ALGO[1]->ponderado_2."','".$ALGO[1]->Porcentaje2."')";
  
    $query8 = "insert into nombre_ponderado values(9,'".$ALGO[2]->combobit."',3,'".$ALGO[2]->ponderado_3."','".$ALGO[2]->Porcentaje3."')";



 $result5 = pg_query($query5);

 $result6 = pg_query($query6);
 
 $result7 = pg_query($query7);
 
 $result8 = pg_query($query8);

 
  $salidaJSON = array('query'=>$query, 'query2'=>$query2 , 'query3'=>$query3 ,'query4'=>$query4,'query5'=>$query5,'query6'=>$query6,'query7'=>$query7,'query8'=>$query8, 'query9'=>$DATA);
	    print json_encode($salidaJSON);	
	 
	 
 }
 
 function atencionZuum(){
	 
	 	     	 	 	    $DATA = json_decode($_POST['array']);
	var_dump($DATA);
	
	$ALGO = json_decode($_POST['ponderados']);
    var_dump($ALGO);
	
	echo "atencion zuum";

	$query = "delete from  calidad_pregunta where id = '10'"; 
	
	$result = pg_query($query);
	
for($i=0;$i<count($DATA);$i++){	

/*  
	$query = "update calidad_pregunta set id = '10',id_campana = '".$DATA[$i]['combobit']."',id_apartado = '1',pregunta = '".$DATA[$i]['st1_colum2']."',porcentaje_pregunta = '".$DATA[$i]['st1_colum3']."' where id_apartado = '1'";

	$query2 = "update calidad_pregunta set id = '10',id_campana = '".$DATA[$i]['combobit']."',id_apartado = '2',pregunta = '".$DATA[$i]['st2_colum2']."',porcentaje_pregunta = '".$DATA[$i]['st2_colum3']."' where id_apartado = '2'";
		
	$query3 = "update calidad_pregunta set id = '10',id_campana = '".$DATA[$i]['combobit']."',id_apartado = '3',pregunta = '".$DATA[$i]['st3_colum2']."',porcentaje_pregunta = '".$DATA[$i]['st2_colum3']."' where id_apartado = '3'";
*/
      
    $query2 = "insert into calidad_pregunta values(10,'".$DATA[$i]->combobit."',1,'".$DATA[$i]->st1_colum2."',".$DATA[$i]->st1_colum3.",'EN REVISION')";
	  
    $query3 = "insert into calidad_pregunta values(10,'".$DATA[$i]->combobit."',2,'".$DATA[$i]->st2_colum2."',".$DATA[$i]->st2_colum3.",'EN REVISION')";
  
    $query4 = "insert into calidad_pregunta values(10,'".$DATA[$i]->combobit."',3,'".$DATA[$i]->st3_colum2."',".$DATA[$i]->st3_colum3.",'EN REVISION')";


  
  $result2 = pg_query($query2);
  
  $result3 = pg_query($query3);
  
  $result4 = pg_query($query4);
  
}

$query5="delete from nombre_ponderado where id = '10'";
		
//$query6 ="update nombre_ponderado set id = '10',id_campana = '".$ALGO[0]->combobit."',id_apartado = '1',pregunta = '".$ALGO[0]->ponderado_1."',porcentaje_pregunta = '".$ALGO[0]->Porcentaje1."' where id_apartado = '1'";

//$query7 ="update nombre_ponderado set id = '10',id_campana = '".$ALGO[1]->combobit."',id_apartado = '2',pregunta = '".$ALGO[1]->ponderado_2."',porcentaje_pregunta = '".$ALGO[1]->Porcentaje2."' where id_apartado = '2'";

//$query8 ="update nombre_ponderado set id = '10',id_campana = '".$ALGO[2]->combobit."',id_apartado = '3',pregunta = '".$ALGO[2]->ponderado_3."',porcentaje_pregunta = '".$ALGO[2]->Porcentaje3."' where id_apartado = '3'";

    $query6 = "insert into nombre_ponderado values(10,'".$ALGO[0]->combobit."',1,'".$ALGO[0]->ponderado_1."','".$ALGO[0]->Porcentaje1."')";
	  
    $query7 = "insert into nombre_ponderado values(10,'".$ALGO[1]->combobit."',2,'".$ALGO[1]->ponderado_2."','".$ALGO[1]->Porcentaje2."')";
  
    $query8 = "insert into nombre_ponderado values(10,'".$ALGO[2]->combobit."',3,'".$ALGO[2]->ponderado_3."','".$ALGO[2]->Porcentaje3."')";



 $result5 = pg_query($query5);

 $result6 = pg_query($query6);
 
 $result7 = pg_query($query7);
 
 $result8 = pg_query($query8);

 
  $salidaJSON = array('query'=>$query, 'query2'=>$query2 , 'query3'=>$query3 ,'query4'=>$query4,'query5'=>$query5,'query6'=>$query6,'query7'=>$query7,'query8'=>$query8, 'query9'=>$DATA);
	    print json_encode($salidaJSON);	
	 
	 
 }
 
 function atencionAfore(){
	 
	 	 	     	 	 	    $DATA = json_decode($_POST['array']);
	var_dump($DATA);
	
	$ALGO = json_decode($_POST['ponderados']);
    var_dump($ALGO);
	
	echo "atencion afore";

	$query = "delete from  calidad_pregunta where id = '11'"; 
	
	$result = pg_query($query);
	
for($i=0;$i<count($DATA);$i++){	

/*  
	$query = "update calidad_pregunta set id = '11',id_campana = '".$DATA[$i]['combobit']."',id_apartado = '1',pregunta = '".$DATA[$i]['st1_colum2']."',porcentaje_pregunta = '".$DATA[$i]['st1_colum3']."' where id_apartado = '1'";

	$query2 = "update calidad_pregunta set id = '11',id_campana = '".$DATA[$i]['combobit']."',id_apartado = '2',pregunta = '".$DATA[$i]['st2_colum2']."',porcentaje_pregunta = '".$DATA[$i]['st2_colum3']."' where id_apartado = '2'";
		
	$query3 = "update calidad_pregunta set id = '11',id_campana = '".$DATA[$i]['combobit']."',id_apartado = '3',pregunta = '".$DATA[$i]['st3_colum2']."',porcentaje_pregunta = '".$DATA[$i]['st2_colum3']."' where id_apartado = '3'";
*/
      
    $query2 = "insert into calidad_pregunta values(11,'".$DATA[$i]->combobit."',1,'".$DATA[$i]->st1_colum2."',".$DATA[$i]->st1_colum3.",'EN REVISION')";
	  
    $query3 = "insert into calidad_pregunta values(11,'".$DATA[$i]->combobit."',2,'".$DATA[$i]->st2_colum2."',".$DATA[$i]->st2_colum3.",'EN REVISION')";
  
    $query4 = "insert into calidad_pregunta values(11,'".$DATA[$i]->combobit."',3,'".$DATA[$i]->st3_colum2."',".$DATA[$i]->st3_colum3.",'EN REVISION')";


  
  $result2 = pg_query($query2);
  
  $result3 = pg_query($query3);
  
  $result4 = pg_query($query4);
  
}

$query5="delete from nombre_ponderado where id = '11'";
		
//$query6 ="update nombre_ponderado set id = '11',id_campana = '".$ALGO[0]->combobit."',id_apartado = '1',pregunta = '".$ALGO[0]->ponderado_1."',porcentaje_pregunta = '".$ALGO[0]->Porcentaje1."' where id_apartado = '1'";

//$query7 ="update nombre_ponderado set id = '11',id_campana = '".$ALGO[1]->combobit."',id_apartado = '2',pregunta = '".$ALGO[1]->ponderado_2."',porcentaje_pregunta = '".$ALGO[1]->Porcentaje2."' where id_apartado = '2'";

//$query8 ="update nombre_ponderado set id = '11',id_campana = '".$ALGO[2]->combobit."',id_apartado = '3',pregunta = '".$ALGO[2]->ponderado_3."',porcentaje_pregunta = '".$ALGO[2]->Porcentaje3."' where id_apartado = '3'";

    $query6 = "insert into nombre_ponderado values(11,'".$ALGO[0]->combobit."',1,'".$ALGO[0]->ponderado_1."','".$ALGO[0]->Porcentaje1."')";
	  
    $query7 = "insert into nombre_ponderado values(11,'".$ALGO[1]->combobit."',2,'".$ALGO[1]->ponderado_2."','".$ALGO[1]->Porcentaje2."')";
  
    $query8 = "insert into nombre_ponderado values(11,'".$ALGO[2]->combobit."',3,'".$ALGO[2]->ponderado_3."','".$ALGO[2]->Porcentaje3."')";



 $result5 = pg_query($query5);

 $result6 = pg_query($query6);
 
 $result7 = pg_query($query7);
 
 $result8 = pg_query($query8);

 
  $salidaJSON = array('query'=>$query, 'query2'=>$query2 , 'query3'=>$query3 ,'query4'=>$query4,'query5'=>$query5,'query6'=>$query6,'query7'=>$query7,'query8'=>$query8, 'query9'=>$DATA);
	    print json_encode($salidaJSON);	
	 
 }
 
 function atencionSoporte(){
	 
	  
	 	     	 	 	    $DATA = json_decode($_POST['array']);
	var_dump($DATA);
	
	$ALGO = json_decode($_POST['ponderados']);
    var_dump($ALGO);
	
	echo "atencion zuum";

	$query = "delete from  calidad_pregunta where id = '12'"; 
	
	$result = pg_query($query);
	
for($i=0;$i<count($DATA);$i++){	

/*  
	$query = "update calidad_pregunta set id = '10',id_campana = '".$DATA[$i]['combobit']."',id_apartado = '1',pregunta = '".$DATA[$i]['st1_colum2']."',porcentaje_pregunta = '".$DATA[$i]['st1_colum3']."' where id_apartado = '1'";

	$query2 = "update calidad_pregunta set id = '10',id_campana = '".$DATA[$i]['combobit']."',id_apartado = '2',pregunta = '".$DATA[$i]['st2_colum2']."',porcentaje_pregunta = '".$DATA[$i]['st2_colum3']."' where id_apartado = '2'";
		
	$query3 = "update calidad_pregunta set id = '10',id_campana = '".$DATA[$i]['combobit']."',id_apartado = '3',pregunta = '".$DATA[$i]['st3_colum2']."',porcentaje_pregunta = '".$DATA[$i]['st2_colum3']."' where id_apartado = '3'";
*/
      
    $query2 = "insert into calidad_pregunta values(12,'".$DATA[$i]->combobit."',1,'".$DATA[$i]->st1_colum2."',".$DATA[$i]->st1_colum3.",'EN REVISION')";
	  
    $query3 = "insert into calidad_pregunta values(12,'".$DATA[$i]->combobit."',2,'".$DATA[$i]->st2_colum2."',".$DATA[$i]->st2_colum3.",'EN REVISION')";
  
    $query4 = "insert into calidad_pregunta values(12,'".$DATA[$i]->combobit."',3,'".$DATA[$i]->st3_colum2."',".$DATA[$i]->st3_colum3.",'EN REVISION')";


  
  $result2 = pg_query($query2);
  
  $result3 = pg_query($query3);
  
  $result4 = pg_query($query4);
  
}

$query5="delete from nombre_ponderado where id = '12'";
		
//$query6 ="update nombre_ponderado set id = '10',id_campana = '".$ALGO[0]->combobit."',id_apartado = '1',pregunta = '".$ALGO[0]->ponderado_1."',porcentaje_pregunta = '".$ALGO[0]->Porcentaje1."' where id_apartado = '1'";

//$query7 ="update nombre_ponderado set id = '10',id_campana = '".$ALGO[1]->combobit."',id_apartado = '2',pregunta = '".$ALGO[1]->ponderado_2."',porcentaje_pregunta = '".$ALGO[1]->Porcentaje2."' where id_apartado = '2'";

//$query8 ="update nombre_ponderado set id = '10',id_campana = '".$ALGO[2]->combobit."',id_apartado = '3',pregunta = '".$ALGO[2]->ponderado_3."',porcentaje_pregunta = '".$ALGO[2]->Porcentaje3."' where id_apartado = '3'";

    $query6 = "insert into nombre_ponderado values(12,'".$ALGO[0]->combobit."',1,'".$ALGO[0]->ponderado_1."','".$ALGO[0]->Porcentaje1."')";
	  
    $query7 = "insert into nombre_ponderado values(12,'".$ALGO[1]->combobit."',2,'".$ALGO[1]->ponderado_2."','".$ALGO[1]->Porcentaje2."')";
  
    $query8 = "insert into nombre_ponderado values(12,'".$ALGO[2]->combobit."',3,'".$ALGO[2]->ponderado_3."','".$ALGO[2]->Porcentaje3."')";



 $result5 = pg_query($query5);

 $result6 = pg_query($query6);
 
 $result7 = pg_query($query7);
 
 $result8 = pg_query($query8);

 
  $salidaJSON = array('query'=>$query, 'query2'=>$query2 , 'query3'=>$query3 ,'query4'=>$query4,'query5'=>$query5,'query6'=>$query6,'query7'=>$query7,'query8'=>$query8, 'query9'=>$DATA);
	    print json_encode($salidaJSON);	
	 
	 
	 
	 
 }
 
 
 function campanasUnicas(){
	 
	  	 	     	 	 	    $DATA = json_decode($_POST['array']);
	var_dump($DATA);
	
	$ALGO = json_decode($_POST['ponderados']);
    var_dump($ALGO);
	
	echo "campanas unicas";

	$query = "delete from  calidad_pregunta where id = '13'"; 
	
	$result = pg_query($query);
	
for($i=0;$i<count($DATA);$i++){	

/*  
	$query = "update calidad_pregunta set id = '12',id_campana = '".$DATA[$i]['combobit']."',id_apartado = '1',pregunta = '".$DATA[$i]['st1_colum2']."',porcentaje_pregunta = '".$DATA[$i]['st1_colum3']."' where id_apartado = '1'";

	$query2 = "update calidad_pregunta set id = '12',id_campana = '".$DATA[$i]['combobit']."',id_apartado = '2',pregunta = '".$DATA[$i]['st2_colum2']."',porcentaje_pregunta = '".$DATA[$i]['st2_colum3']."' where id_apartado = '2'";
		
	$query3 = "update calidad_pregunta set id = '12',id_campana = '".$DATA[$i]['combobit']."',id_apartado = '3',pregunta = '".$DATA[$i]['st3_colum2']."',porcentaje_pregunta = '".$DATA[$i]['st2_colum3']."' where id_apartado = '3'";
*/
      
    $query2 = "insert into calidad_pregunta values(13,'".$DATA[$i]->combobit."',1,'".$DATA[$i]->st1_colum2."',".$DATA[$i]->st1_colum3.",'EN REVISION')";
	  
    $query3 = "insert into calidad_pregunta values(13,'".$DATA[$i]->combobit."',2,'".$DATA[$i]->st2_colum2."',".$DATA[$i]->st2_colum3.",'EN REVISION')";
  
    $query4 = "insert into calidad_pregunta values(13,'".$DATA[$i]->combobit."',3,'".$DATA[$i]->st3_colum2."',".$DATA[$i]->st3_colum3.",'EN REVISION')";


  
  $result2 = pg_query($query2);
  
  $result3 = pg_query($query3);
  
  $result4 = pg_query($query4);
  
}

$query5="delete from nombre_ponderado where id = '13'";
		
//$query6 ="update nombre_ponderado set id = '12',id_campana = '".$ALGO[0]->combobit."',id_apartado = '1',pregunta = '".$ALGO[0]->ponderado_1."',porcentaje_pregunta = '".$ALGO[0]->Porcentaje1."' where id_apartado = '1'";

//$query7 ="update nombre_ponderado set id = '12',id_campana = '".$ALGO[1]->combobit."',id_apartado = '2',pregunta = '".$ALGO[1]->ponderado_2."',porcentaje_pregunta = '".$ALGO[1]->Porcentaje2."' where id_apartado = '2'";

//$query8 ="update nombre_ponderado set id = '12',id_campana = '".$ALGO[2]->combobit."',id_apartado = '3',pregunta = '".$ALGO[2]->ponderado_3."',porcentaje_pregunta = '".$ALGO[2]->Porcentaje3."' where id_apartado = '3'";

    $query6 = "insert into nombre_ponderado values(13,'".$ALGO[0]->combobit."',1,'".$ALGO[0]->ponderado_1."','".$ALGO[0]->Porcentaje1."')";
	  
    $query7 = "insert into nombre_ponderado values(13,'".$ALGO[1]->combobit."',2,'".$ALGO[1]->ponderado_2."','".$ALGO[1]->Porcentaje2."')";
  
    $query8 = "insert into nombre_ponderado values(13,'".$ALGO[2]->combobit."',3,'".$ALGO[2]->ponderado_3."','".$ALGO[2]->Porcentaje3."')";



 $result5 = pg_query($query5);

 $result6 = pg_query($query6);
 
 $result7 = pg_query($query7);
 
 $result8 = pg_query($query8);

 
  $salidaJSON = array('query'=>$query, 'query2'=>$query2 , 'query3'=>$query3 ,'query4'=>$query4,'query5'=>$query5,'query6'=>$query6,'query7'=>$query7,'query8'=>$query8, 'query9'=>$DATA);
	    print json_encode($salidaJSON);	
	 
 }
 
 function promocionBancoppel(){
	 
	 
    $DATA = json_decode($_POST['array']);
	var_dump($DATA);
	
	$ALGO = json_decode($_POST['ponderados']);
    var_dump($ALGO);
	
	echo "promocion coppel";

	$query = "delete from  calidad_pregunta where id = '14'"; 
	
	$result = pg_query($query);
	
for($i=0;$i<count($DATA);$i++){	

/*  
	$query = "update calidad_pregunta set id = '13',id_campana = '".$DATA[$i]['combobit']."',id_apartado = '1',pregunta = '".$DATA[$i]['st1_colum2']."',porcentaje_pregunta = '".$DATA[$i]['st1_colum3']."' where id_apartado = '1'";

	$query2 = "update calidad_pregunta set id = '13',id_campana = '".$DATA[$i]['combobit']."',id_apartado = '2',pregunta = '".$DATA[$i]['st2_colum2']."',porcentaje_pregunta = '".$DATA[$i]['st2_colum3']."' where id_apartado = '2'";
		
	$query3 = "update calidad_pregunta set id = '13',id_campana = '".$DATA[$i]['combobit']."',id_apartado = '3',pregunta = '".$DATA[$i]['st3_colum2']."',porcentaje_pregunta = '".$DATA[$i]['st2_colum3']."' where id_apartado = '3'";
*/
      
    $query2 = "insert into calidad_pregunta values(14,'".$DATA[$i]->combobit."',1,'".$DATA[$i]->st1_colum2."',".$DATA[$i]->st1_colum3.",'EN REVISION')";
	  
    $query3 = "insert into calidad_pregunta values(14,'".$DATA[$i]->combobit."',2,'".$DATA[$i]->st2_colum2."',".$DATA[$i]->st2_colum3.",'EN REVISION')";
  
    $query4 = "insert into calidad_pregunta values(14,'".$DATA[$i]->combobit."',3,'".$DATA[$i]->st3_colum2."',".$DATA[$i]->st3_colum3.",'EN REVISION')";


  
  $result2 = pg_query($query2);
  
  $result3 = pg_query($query3);
  
  $result4 = pg_query($query4);
  
}

$query5="delete from nombre_ponderado where id = '14'";
		
//$query6 ="update nombre_ponderado set id = '13',id_campana = '".$ALGO[0]->combobit."',id_apartado = '1',pregunta = '".$ALGO[0]->ponderado_1."',porcentaje_pregunta = '".$ALGO[0]->Porcentaje1."' where id_apartado = '1'";

//$query7 ="update nombre_ponderado set id = '13',id_campana = '".$ALGO[1]->combobit."',id_apartado = '2',pregunta = '".$ALGO[1]->ponderado_2."',porcentaje_pregunta = '".$ALGO[1]->Porcentaje2."' where id_apartado = '2'";

//$query8 ="update nombre_ponderado set id = '13',id_campana = '".$ALGO[2]->combobit."',id_apartado = '3',pregunta = '".$ALGO[2]->ponderado_3."',porcentaje_pregunta = '".$ALGO[2]->Porcentaje3."' where id_apartado = '3'";

    $query6 = "insert into nombre_ponderado values(14,'".$ALGO[0]->combobit."',1,'".$ALGO[0]->ponderado_1."','".$ALGO[0]->Porcentaje1."')";
	  
    $query7 = "insert into nombre_ponderado values(14,'".$ALGO[1]->combobit."',2,'".$ALGO[1]->ponderado_2."','".$ALGO[1]->Porcentaje2."')";
  
    $query8 = "insert into nombre_ponderado values(14,'".$ALGO[2]->combobit."',3,'".$ALGO[2]->ponderado_3."','".$ALGO[2]->Porcentaje3."')";



 $result5 = pg_query($query5);

 $result6 = pg_query($query6);
 
 $result7 = pg_query($query7);
 
 $result8 = pg_query($query8);

 
  $salidaJSON = array('query'=>$query, 'query2'=>$query2 , 'query3'=>$query3 ,'query4'=>$query4,'query5'=>$query5,'query6'=>$query6,'query7'=>$query7,'query8'=>$query8, 'query9'=>$DATA);
	    print json_encode($salidaJSON);	
	 
 }
 
 function  promocionCoppelArgentina()
 {
	 
	 $DATA = json_decode($_POST['array']);
	var_dump($DATA);
	
	$ALGO = json_decode($_POST['ponderados']);
    var_dump($ALGO);
	
	echo "promocion coppel";

	$query = "delete from  calidad_pregunta where id = '15'"; 
	
	$result = pg_query($query);
	
for($i=0;$i<count($DATA);$i++){	

/*  
	$query = "update calidad_pregunta set id = '13',id_campana = '".$DATA[$i]['combobit']."',id_apartado = '1',pregunta = '".$DATA[$i]['st1_colum2']."',porcentaje_pregunta = '".$DATA[$i]['st1_colum3']."' where id_apartado = '1'";

	$query2 = "update calidad_pregunta set id = '13',id_campana = '".$DATA[$i]['combobit']."',id_apartado = '2',pregunta = '".$DATA[$i]['st2_colum2']."',porcentaje_pregunta = '".$DATA[$i]['st2_colum3']."' where id_apartado = '2'";
		
	$query3 = "update calidad_pregunta set id = '13',id_campana = '".$DATA[$i]['combobit']."',id_apartado = '3',pregunta = '".$DATA[$i]['st3_colum2']."',porcentaje_pregunta = '".$DATA[$i]['st2_colum3']."' where id_apartado = '3'";
*/
      
    $query2 = "insert into calidad_pregunta values(15,'".$DATA[$i]->combobit."',1,'".$DATA[$i]->st1_colum2."',".$DATA[$i]->st1_colum3.",'EN REVISION')";
	  
    $query3 = "insert into calidad_pregunta values(15,'".$DATA[$i]->combobit."',2,'".$DATA[$i]->st2_colum2."',".$DATA[$i]->st2_colum3.",'EN REVISION')";
  
    $query4 = "insert into calidad_pregunta values(15,'".$DATA[$i]->combobit."',3,'".$DATA[$i]->st3_colum2."',".$DATA[$i]->st3_colum3.",'EN REVISION')";


  
  $result2 = pg_query($query2);
  
  $result3 = pg_query($query3);
  
  $result4 = pg_query($query4);
  
}

$query5="delete from nombre_ponderado where id = '15'";
		
//$query6 ="update nombre_ponderado set id = '13',id_campana = '".$ALGO[0]->combobit."',id_apartado = '1',pregunta = '".$ALGO[0]->ponderado_1."',porcentaje_pregunta = '".$ALGO[0]->Porcentaje1."' where id_apartado = '1'";

//$query7 ="update nombre_ponderado set id = '13',id_campana = '".$ALGO[1]->combobit."',id_apartado = '2',pregunta = '".$ALGO[1]->ponderado_2."',porcentaje_pregunta = '".$ALGO[1]->Porcentaje2."' where id_apartado = '2'";

//$query8 ="update nombre_ponderado set id = '13',id_campana = '".$ALGO[2]->combobit."',id_apartado = '3',pregunta = '".$ALGO[2]->ponderado_3."',porcentaje_pregunta = '".$ALGO[2]->Porcentaje3."' where id_apartado = '3'";

    $query6 = "insert into nombre_ponderado values(15,'".$ALGO[0]->combobit."',1,'".$ALGO[0]->ponderado_1."','".$ALGO[0]->Porcentaje1."')";
	  
    $query7 = "insert into nombre_ponderado values(15,'".$ALGO[1]->combobit."',2,'".$ALGO[1]->ponderado_2."','".$ALGO[1]->Porcentaje2."')";
  
    $query8 = "insert into nombre_ponderado values(15,'".$ALGO[2]->combobit."',3,'".$ALGO[2]->ponderado_3."','".$ALGO[2]->Porcentaje3."')";



 $result5 = pg_query($query5);

 $result6 = pg_query($query6);
 
 $result7 = pg_query($query7);
 
 $result8 = pg_query($query8);

 
  $salidaJSON = array('query'=>$query, 'query2'=>$query2 , 'query3'=>$query3 ,'query4'=>$query4,'query5'=>$query5,'query6'=>$query6,'query7'=>$query7,'query8'=>$query8, 'query9'=>$DATA);
	    print json_encode($salidaJSON);	
	 
	 
 }

 function atencionClientesBancoppel(){
	 
	 	 $DATA = json_decode($_POST['array']);
	var_dump($DATA);
	
	$ALGO = json_decode($_POST['ponderados']);
    var_dump($ALGO);
	
	echo "promocion coppel";

	$query = "delete from  calidad_pregunta where id = '16'"; 
	
	$result = pg_query($query);
	
for($i=0;$i<count($DATA);$i++){	

/*  
	$query = "update calidad_pregunta set id = '13',id_campana = '".$DATA[$i]['combobit']."',id_apartado = '1',pregunta = '".$DATA[$i]['st1_colum2']."',porcentaje_pregunta = '".$DATA[$i]['st1_colum3']."' where id_apartado = '1'";

	$query2 = "update calidad_pregunta set id = '13',id_campana = '".$DATA[$i]['combobit']."',id_apartado = '2',pregunta = '".$DATA[$i]['st2_colum2']."',porcentaje_pregunta = '".$DATA[$i]['st2_colum3']."' where id_apartado = '2'";
		
	$query3 = "update calidad_pregunta set id = '13',id_campana = '".$DATA[$i]['combobit']."',id_apartado = '3',pregunta = '".$DATA[$i]['st3_colum2']."',porcentaje_pregunta = '".$DATA[$i]['st2_colum3']."' where id_apartado = '3'";
*/
      
    $query2 = "insert into calidad_pregunta values(16,'".$DATA[$i]->combobit."',1,'".$DATA[$i]->st1_colum2."',".$DATA[$i]->st1_colum3.",'EN REVISION')";
	  
    $query3 = "insert into calidad_pregunta values(16,'".$DATA[$i]->combobit."',2,'".$DATA[$i]->st2_colum2."',".$DATA[$i]->st2_colum3.",'EN REVISION')";
  
    $query4 = "insert into calidad_pregunta values(16,'".$DATA[$i]->combobit."',3,'".$DATA[$i]->st3_colum2."',".$DATA[$i]->st3_colum3.",'EN REVISION')";


  
  $result2 = pg_query($query2);
  
  $result3 = pg_query($query3);
  
  $result4 = pg_query($query4);
  
}

$query5="delete from nombre_ponderado where id = '16'";
		
//$query6 ="update nombre_ponderado set id = '13',id_campana = '".$ALGO[0]->combobit."',id_apartado = '1',pregunta = '".$ALGO[0]->ponderado_1."',porcentaje_pregunta = '".$ALGO[0]->Porcentaje1."' where id_apartado = '1'";

//$query7 ="update nombre_ponderado set id = '13',id_campana = '".$ALGO[1]->combobit."',id_apartado = '2',pregunta = '".$ALGO[1]->ponderado_2."',porcentaje_pregunta = '".$ALGO[1]->Porcentaje2."' where id_apartado = '2'";

//$query8 ="update nombre_ponderado set id = '13',id_campana = '".$ALGO[2]->combobit."',id_apartado = '3',pregunta = '".$ALGO[2]->ponderado_3."',porcentaje_pregunta = '".$ALGO[2]->Porcentaje3."' where id_apartado = '3'";

    $query6 = "insert into nombre_ponderado values(16,'".$ALGO[0]->combobit."',1,'".$ALGO[0]->ponderado_1."','".$ALGO[0]->Porcentaje1."')";
	  
    $query7 = "insert into nombre_ponderado values(16,'".$ALGO[1]->combobit."',2,'".$ALGO[1]->ponderado_2."','".$ALGO[1]->Porcentaje2."')";
  
    $query8 = "insert into nombre_ponderado values(16,'".$ALGO[2]->combobit."',3,'".$ALGO[2]->ponderado_3."','".$ALGO[2]->Porcentaje3."')";



 $result5 = pg_query($query5);

 $result6 = pg_query($query6);
 
 $result7 = pg_query($query7);
 
 $result8 = pg_query($query8);

 
  $salidaJSON = array('query'=>$query, 'query2'=>$query2 , 'query3'=>$query3 ,'query4'=>$query4,'query5'=>$query5,'query6'=>$query6,'query7'=>$query7,'query8'=>$query8, 'query9'=>$DATA);
	    print json_encode($salidaJSON);	
    	
	
	 
 }
 pg_close($conexion);
?>