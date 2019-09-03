<?php
// error_reporting(0);

// $empleado = $_POST['empleado'];

// $conection=pg_connect("host=10.44.2.128 dbname=appwebcat user=reportes password=ff7b3106de28225ca601288654f6c57a");

// if(!$conection){
// 	echo "Hay error en la conexion";
// 	exit();
// }
// // $sQuery ="SELECT estado as resultado from fn_validausuarioraul('$empleado')";
// $sQuery ="SELECT 0 AS estado FROM catalogoempleados WHERE centro = 230279 AND empleado = '$empleado';";



// //$sQuery ="SELECT 'OK'::TEXT AS resultado, centro FROM cat_nomina_mx  WHERE empleado = '$empleado'";

// $res = pg_query($conection, $sQuery);

// $data = array();

// while($row = pg_fetch_array($res))
// {
// 	$data = $row;
// }


// if($data['resultado'] == 'OK')
// {
// 	$auth = array('estado' => 0, 'mensaje' => 'Autenticacion Correcta','nombre'=> $data['nombre_completo']);
// 	echo json_encode($auth);
// }
// else
// {
// 	$auth = array('estado' => 1, 'mensaje' => 'Autenticacion Incorrecta');	
// 	echo json_encode($auth);

// }
?>