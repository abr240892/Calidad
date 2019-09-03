<?php


$conexion = pg_connect("host=10.44.2.128 dbname=appwebcat user=reportes password=ff7b3106de28225ca601288654f6c57a");

$id_estatus = $_POST['id_estatus'];

$nombre = $_POST['nombre'];

$empleado = $_POST['empleado'];

$centro = $_POST['centro'];

$jefe = $_POST['jefe'];

$id_llamada = $_POST['id_llamada'];

$estado = $_POST['estado'];

$servicio = $_POST['servicio'];

$observaciones = $_POST['observaciones'];

$mensaje = 0;


$query = "select * from llamadas_certificacion where idllamada = '$id_llamada'";

$res = pg_query($conexion,$query);

$campos = pg_num_rows($res);

if($campos > 0){
	
	$sQuery = "update llamadas_certificacion set llamadastatus = '$estado',idstatus = '$id_estatus',observaciones = '$observaciones' where idllamada = '$id_llamada'";
	
	$res2 = pg_query($conexion,$sQuery);
	
	if($res2)
	{
	
	$mensaje = 2;
	
	
	}else{
		
		
	$mensaje = -2;	
		
	}
	
pg_close($conexion);
	    $salidaJSON = array('mensaje'=>$mensaje,'$query'=>$query,'sQuery'=>$sQuery);
	    print json_encode($salidaJSON);
	
	
}else{

$query = "insert into llamadas_certificacion values('$id_llamada','$estado','$id_estatus','$nombre','$empleado','$centro','$jefe','$servicio','$observaciones')";

$result = pg_query($conexion,$query);

if($result)
{
	
	$mensaje = 1;
	
}else{
	
	$mensaje = -1;
	
}

pg_close($conexion);
	    $salidaJSON = array('mensaje'=>$mensaje,'$query'=>$query);
	    print json_encode($salidaJSON);


}
?>