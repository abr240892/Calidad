<?php
$conexion = pg_connect("host=10.44.2.128 dbname=appwebcat user=reportes password=ff7b3106de28225ca601288654f6c57a");


  $empleado = $_POST['Empleado'];
  
  $nombre   = $_POST['Nombre'];
  
  $centro   = $_POST['Centro'];
  
  $puesto   = $_POST['Puesto'];
  
  $roll     = $_POST['Roll'];
  
  $email    = $_POST['Email'];
  
  $cel      = $_POST['Cel'];
  
  $estado;
 
$sQuery = "select * from alta_usuarios where num_emp='$empleado'";
 
$res = pg_query($conexion,$sQuery);


if(pg_num_rows($res)==0)
{
	
  $query = "insert into alta_usuarios (num_emp,nom_emp,centro,puesto,roll,correo_electronico,celular) values('$empleado','$nombre','$centro','$puesto','$roll','$email','$cel')";
  
  $result = pg_query($conexion,$query);
  

  if($result)
  {
	
    $estado = 1;
	
	    $salidaJSON = array('query'=>$query,'estado'=>$estado);
	    print json_encode($salidaJSON);
	  
  }
	
	
}else{
	 
	$estado = 0;

	$mensaje ="el empleado ya existe verifique";
	
	
	$salidaJSON = array('mensaje'=>$mensaje,'estado'=>$estado);
	    print json_encode($salidaJSON);
	
	
}
 
?>