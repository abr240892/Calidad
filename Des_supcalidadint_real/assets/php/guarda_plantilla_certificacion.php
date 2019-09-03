<?php

$conexion = pg_connect("host=10.44.2.128 dbname=appwebcat user=reportes password=ff7b3106de28225ca601288654f6c57a");


 $opc = $_POST['opc'];
	switch ($opc) { 
		case 'VACIO':
			vacio();
			break;
		case 'COBRANZA COPPEL':
			cobranzacoppel();
			break;
		case 'COBRANZA BANCOPPEL':
			cobranzabancoppel();
			break;
		case 'COBRANZA ARGENTINA':
			cobranzaargentina();
			break;
		case 'PROMOCION COPPEL':
			promocioncoppel();
			break;
        case 'SOLICITANTES BANCO':
		     solicitantesbanco();
			break;
		case 'SOLICITUD DE CREDITO':
             solicituddecredito();
            break;
        case 'VENTAS':
             ventas();
            break;
        case 'ATENCION COPPEL':
             atencioncoppel();
            break;
        case 'ATENCION ARGENTINA':
		     atencionargentina();
			break;
		case 'ATENCION ZUUM':
		     atencionzuum();
			 break;
		case 'ATENCION AFORE':
		     atencionafore();
			 break;
		case 'ATENCION SOPORTE TECNICO':
             atencionsoportetecnico();
             break;
        case 'CAMPANAS UNICAS':
             campanasunicas();
             break;
		case 'PROMOCION BANCOPPEL':
             promocionbancoppel();
             break;
        case 'PROMOCION COPPEL ARGENTINA':
             promocioncoppelargentina();
             break;
        case 'ATENCION A CLIENTES BANCOPPEL':
		     atencionaclientesbancoppel();
			 break;
			 
		default:
			# code...
			break;
	}


function vacio(){
	
	$DATA = json_decode($_POST['array']);

    count($DATA);


$query = "delete from  check_evaluacion where id_servicio = '0'"; 

$result = pg_query($query);

for($i=0;$i<count($DATA);$i++)
{
	
	$query2 = "insert into check_evaluacion values('0','".$DATA[$i]->aspectos_tecnicos."','".$DATA[$i]->aspectos_especializados."','".$DATA[$i]->dialogo_calido."')";
	  
  
  $result2 = pg_query($query2);
  	
	
}	
	
	
}


function cobranzacoppel(){

	
	$DATA = json_decode($_POST['array']);




$query = "delete from  check_evaluacion where id_servicio = '1'"; 

$result = pg_query($query);

for($i=0;$i<count($DATA);$i++)
{
	
	$query2 = "insert into check_evaluacion values('1','".$DATA[$i]->aspectos_tecnicos."','".$DATA[$i]->aspectos_especializados."','".$DATA[$i]->dialogo_calido."')";
	  


  $result2 = pg_query($query2);
	
	
}	
	
	
}

function cobranzabancoppel(){
	
	$DATA = json_decode($_POST['array']);




$query = "delete from  check_evaluacion where id_servicio = '2'"; 

$result = pg_query($query);

for($i=0;$i<count($DATA);$i++)
{
	
	$query2 = "insert into check_evaluacion values('2','".$DATA[$i]->aspectos_tecnicos."','".$DATA[$i]->aspectos_especializados."','".$DATA[$i]->dialogo_calido."')";
	  

  
  $result2 = pg_query($query2);
  

	
}	
	
	
}

	
function cobranzaargentina(){
	
	$DATA = json_decode($_POST['array']);



$query = "delete from  check_evaluacion where id_servicio = '3'"; 

$result = pg_query($query);

for($i=0;$i<count($DATA);$i++)
{
	
	$query2 = "insert into check_evaluacion values('3','".$DATA[$i]->aspectos_tecnicos."','".$DATA[$i]->aspectos_especializados."','".$DATA[$i]->dialogo_calido."')";
	  


  $result2 = pg_query($query2);
  

		
}	
	
}


function promocioncoppel(){
	
	$DATA = json_decode($_POST['array']);



$query = "delete from  check_evaluacion where id_servicio = '4'"; 

$result = pg_query($query);

for($i=0;$i<count($DATA);$i++)
{
	
	$query2 = "insert into check_evaluacion values('4','".$DATA[$i]->aspectos_tecnicos."','".$DATA[$i]->aspectos_especializados."','".$DATA[$i]->dialogo_calido."')";
	  

  
  $result2 = pg_query($query2);
  

	
}	
	
}

function solicitantesbanco(){
	
	$DATA = json_decode($_POST['array']);



$query = "delete from  check_evaluacion where id_servicio = '5'"; 

$result = pg_query($query);

for($i=0;$i<count($DATA);$i++)
{
	
	$query2 = "insert into check_evaluacion values('5','".$DATA[$i]->aspectos_tecnicos."','".$DATA[$i]->aspectos_especializados."','".$DATA[$i]->dialogo_calido."')";
	  

  
  $result2 = pg_query($query2);
  

	
}	
	
	
}


function solicituddecredito(){
	
	$DATA = json_decode($_POST['array']);



$query = "delete from  check_evaluacion where id_servicio = '6'"; 

$result = pg_query($query);

for($i=0;$i<count($DATA);$i++)
{
	
	$query2 = "insert into check_evaluacion values('6','".$DATA[$i]->aspectos_tecnicos."','".$DATA[$i]->aspectos_especializados."','".$DATA[$i]->dialogo_calido."')";
	  

  
  $result2 = pg_query($query2);
  
	
	
}	
	
	
}


function ventas(){
	
	$DATA = json_decode($_POST['array']);




$query = "delete from  check_evaluacion where id_servicio = '7'"; 

$result = pg_query($query);

for($i=0;$i<count($DATA);$i++)
{
	
	$query2 = "insert into check_evaluacion values('7','".$DATA[$i]->aspectos_tecnicos."','".$DATA[$i]->aspectos_especializados."','".$DATA[$i]->dialogo_calido."')";
	  
  
  $result2 = pg_query($query2);
  	
	
}	
	
	
}

function atencioncoppel(){
	
	
     $DATA = json_decode($_POST['array']);

     $query = "delete from  check_evaluacion where id_servicio = '8'"; 

     $result = pg_query($query);

for($i=0;$i<count($DATA);$i++)
{
	
	 $query2 = "insert into check_evaluacion values('8','".$DATA[$i]->aspectos_tecnicos."','".$DATA[$i]->aspectos_especializados."','".$DATA[$i]->dialogo_calido."')";
	  
  
     $result2 = pg_query($query2);
	
	
}	
	
	
}


function atencionargentina(){
	
	 $DATA = json_decode($_POST['array']);

     $query = "delete from  check_evaluacion where id_servicio = '9'"; 

     $result = pg_query($query);

for($i=0;$i<count($DATA);$i++)
{
	
	 $query2 = "insert into check_evaluacion values('9','".$DATA[$i]->aspectos_tecnicos."','".$DATA[$i]->aspectos_especializados."','".$DATA[$i]->dialogo_calido."')";
	  

     $result2 = pg_query($query2);
  

}	
	
	
}



function atencionzuum(){
	
	
	 $DATA = json_decode($_POST['array']);

     $query = "delete from  check_evaluacion where id_servicio = '10'"; 

     $result = pg_query($query);

for($i=0;$i<count($DATA);$i++)
{
	
	 $query2 = "insert into check_evaluacion values('10','".$DATA[$i]->aspectos_tecnicos."','".$DATA[$i]->aspectos_especializados."','".$DATA[$i]->dialogo_calido."')";
	  

     $result2 = pg_query($query2);
  
	
	
}	
	
	
}


function atencionafore(){
	
	
	 $DATA = json_decode($_POST['array']);

     $query = "delete from  check_evaluacion where id_servicio = '11'"; 

     $result = pg_query($query);

for($i=0;$i<count($DATA);$i++)
{
	
	 $query2 = "insert into check_evaluacion values('11','".$DATA[$i]->aspectos_tecnicos."','".$DATA[$i]->aspectos_especializados."','".$DATA[$i]->dialogo_calido."')";
	  
 
     $result2 = pg_query($query2);
  
	
	
}	
	
	
}


function atencionsoportetecnico(){
	
	
	
	  $DATA = json_decode($_POST['array']);

      $query = "delete from  check_evaluacion where id_servicio = '12'"; 

      $result = pg_query($query);

for($i=0;$i<count($DATA);$i++)
{
	
     $query2 = "insert into check_evaluacion values('12','".$DATA[$i]->aspectos_tecnicos."','".$DATA[$i]->aspectos_especializados."','".$DATA[$i]->dialogo_calido."')";
	  

     $result2 = pg_query($query2);
  

	
}	
	
	
	
}



function campanasunicas(){
	
	
	 $DATA = json_decode($_POST['array']);

     $query = "delete from  check_evaluacion where id_servicio = '13'"; 

     $result = pg_query($query);

for($i=0;$i<count($DATA);$i++)
{
	
	 $query2 = "insert into check_evaluacion values('13','".$DATA[$i]->aspectos_tecnicos."','".$DATA[$i]->aspectos_especializados."','".$DATA[$i]->dialogo_calido."')";
	  
     $result2 = pg_query($query2);
  

	
}	
	
	
	
}



function promocionbancoppel(){
	
	
	 $DATA = json_decode($_POST['array']);

     $query = "delete from  check_evaluacion where id_servicio = '14'"; 

     $result = pg_query($query);

for($i=0;$i<count($DATA);$i++)
{
	
	 $query2 = "insert into check_evaluacion values('14','".$DATA[$i]->aspectos_tecnicos."','".$DATA[$i]->aspectos_especializados."','".$DATA[$i]->dialogo_calido."')";
	  
     $result2 = pg_query($query2);
  

}	
	
	
	
}


function promocioncoppelargentina(){
	
		
	 $DATA = json_decode($_POST['array']);


     $query = "delete from  check_evaluacion where id_servicio = '15'"; 

     $result = pg_query($query);

for($i=0;$i<count($DATA);$i++)
{
	
	 $query2 = "insert into check_evaluacion values('15','".$DATA[$i]->aspectos_tecnicos."','".$DATA[$i]->aspectos_especializados."','".$DATA[$i]->dialogo_calido."')";
	  
  
     $result2 = pg_query($query2);
  
  
}	
	
	

}



function atencionaclientesbancoppel(){
	
		
	 $DATA = json_decode($_POST['array']);


     $query = "delete from  check_evaluacion where id_servicio = '16'"; 

     $result = pg_query($query);

for($i=0;$i<count($DATA);$i++)
{
	
	 $query2 = "insert into check_evaluacion values('16','".$DATA[$i]->aspectos_tecnicos."','".$DATA[$i]->aspectos_especializados."','".$DATA[$i]->dialogo_calido."')";
	  
  
     $result2 = pg_query($query2);
  
  
}	
	
	

}


?>