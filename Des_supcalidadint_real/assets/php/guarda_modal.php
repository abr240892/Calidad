<?php
$conexion = pg_connect("host=10.44.2.128 dbname=appwebcat user=reportes password=ff7b3106de28225ca601288654f6c57a");

  
$nombre = $_POST['Nombre'];

$numero = $_POST['Empleado'];

$jefe = $_POST['Jefe'];

$cliente = $_POST['Cliente'];

$fingestion = $_POST['FinGestion'];

$servicio = $_POST['Servicio'];

$centro = $_POST['Centro'];

$tecnica = $_POST['Aspectos_Tecnicos'];

$minimo1 = $_POST['Minimo1'];

$certificado1 = $_POST['Certificado1'];

$negociacion = $_POST['Negociacion'];

$minimo2 = $_POST['Minimo2'];

$certificado2 = $_POST['Certificado2'];

$calido = $_POST['Dialogo_Calido'];

$minimo3 = $_POST['Minimo3'];

$certificado3 = $_POST['Certificado3'];

$total = $_POST['Total'];

$fecha = $_POST['Fecha'];

$fecha_actual = $_POST['MyDateString'];

$hora_actual = $_POST['Hora'];

$observaciones = $_POST['Observaciones'];


if(empty($minimo1) and empty($certificado1) and empty($minimo2) and empty($certificado2) and empty($minimo3) and empty($certificado3)){
	
	$estado = 3;
	
	$mensaje = "datos vacios";
	
	$query = "";
	
}else{


$query = "select numeroempleado,fecha,hora_calificacion,fecha_calificacion,cliente,fingestion,servicio from consulta_calificaciones where  numeroempleado='$numero' and cliente='$cliente' and fingestion='$fingestion' and servicio='$servicio' ";

$res = pg_query($conexion,$query);

$campos = pg_num_rows($res);

if($campos>0)
{

$estado = 2;

$mensaje = "la llamada ya a sido calificada favor de verificar";


}else{
		
$query = "insert into consulta_calificaciones (nombrecompleto,numeroempleado,nombrejefe,aspectostecnicos,negociacion,calidad,calificacionllamada,fecha,minimo1,certificado1,minimo2,certificado2,minimo3,certificado3,fecha_calificacion,hora_calificacion,observaciones,centro,cliente,fingestion,servicio)values('$nombre','$numero','$jefe','$tecnica','$negociacion','$calido','$total','$fecha','$minimo1','$certificado1','$minimo2','$certificado2','$minimo3','$certificado3','$fecha_actual','$hora_actual','$observaciones','$centro','$cliente','$fingestion','$servicio')";

$resultado = pg_query($query);

$estado = 1;

$mensaje = "guardado finalizado";
		
  }


}


$salidaJSON = array('estado'=>$estado , 'query'=>$query ,'mensaje'=>$mensaje);
	print json_encode($salidaJSON);

?>