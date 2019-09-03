<?php

$conexion = pg_connect("host=10.44.2.128 dbname=appwebcat user=reportes password=ff7b3106de28225ca601288654f6c57a");

$empleado = $_POST['Empleado'];

$textarea = $_POST['Textarea'];


$query = "delete from alta_usuarios where num_emp='$empleado'";

$result = pg_query($query);

if($result)
{
	
   $salidaJSON = array('query'=>$query);
	    print json_encode($salidaJSON);	
	
}


?>