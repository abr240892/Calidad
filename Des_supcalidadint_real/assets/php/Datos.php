<?php
	include('conexiones.php');
	$conexion = conectaBD_128_catalogoempleados();
	session_start();

	$NumEmpleado = $_POST['numero'];
	$Clave  = $_POST['clave'];


	if (empty($NumEmpleado) || empty($clave)) {
		$query ="SELECT true as estado,puesto,roll,nom_emp 
			FROM alta_usuarios where num_emp = '$NumEmpleado' and centro='$Clave'";
			
			
		$resp = pg_query($conexion,$query);
 
		$data = array();
			
	$query2  ="select * from valida_niveldeacceso_kardexcobranzacoppel('$NumEmpleado')";
	
	$resp2 = pg_query($conexion,$query2);

		
		while($row = pg_fetch_array($resp)) {
			$data = $row;
		}

		if($data['estado'] == true) {	
			$_SESSION['log']= 1;
			
			$puesto = $data['puesto'];
			$roll = $data['roll'];
			$nombre = $data['nom_emp'];
             
			$auth = array('estado' => 1, 'mensaje' => 'OK' ,'puesto' => $puesto, 'roll'=> $roll , 'nom_emp' => $nombre );

		} else {
			$auth = array('estado' => 2, 'mensaje' => 'OK');
			session_destroy();
		}
		echo json_encode($auth);
		
		$_SESSION['puesto']= $roll;
		$_SESSION['nom_emp'] = $nombre;
		exit();
		
	} else {
		echo "Falla en el query (Datos.php)";
	}
?>
