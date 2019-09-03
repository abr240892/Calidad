<?php
session_start();

//Inicia sesion
if($_GET['opc'] == 2)
{	
	$nombre_completo= $_POST['nombre_completo'];
	$numempleado = $_POST['empleado'];
	$_SESSION['empleado'] = $numempleado;
	$auth = array('estado' => 0, 'mensaje' => 'Autenticacion Correcta','numempleado' => $numempleado,'nombre_completo' => $nombre_completo);	
	echo json_encode($auth);
}

//Cierra sesion
if($_GET['opc'] == 3)
{
	session_destroy();
	header('Location: login.php');
}

	$opcion = $_GET['opc'];
		switch ($opcion) {
			case 'validasesion':
				validarSesion();
				break;								
			default:
				break;		
	}

	function conectaBD_cobranza(){
		$server = '10.44.2.128';
		$user = 'reportes';
		$pass = 'ff7b3106de28225ca601288654f6c57a';
		$bd = 'appwebcat';
		$connection = pg_connect("host=$server dbname=$bd user= $user password=$pass") or die ("Error de conexion servidor 10.44.2.128");
		return $connection;
	}

	function  validarSesion(){
		$numeroemp = $_GET['numeroemp'];
		$password = $_GET['password'];
		$query = "SELECT 'OK' AS resultado FROM catalogoempleados WHERE centro = 230279 AND empleado = '$empleado';";
		$conexion = conectaBD_cobranza();
		
		$res=pg_query($conexion,$query);
		$data = array();

		while($row = pg_fetch_array($res))
		{
			$data = $row;
		}

		if($data['resultado'] == 'OK')
		{	
			$_SESSION['nombre_completo']=$data['nombre_completo']; 
		    $_SESSION['empleado']=$numeroemp;
		    session_start();
			$auth = array('estado' => 0, 'mensaje' => 'El usuario puede ingresar');
		}
			else if($data['resultado'] == 'NEW')
			{
				$auth = array('estado' => 1, 'mensaje' => 'Informacion no coincide');	

			}
				else
				{
					$auth = array('estado' => 2, 'mensaje' => 'Personal no autorizado');	

				}
		echo json_encode($auth);
		print_r($auth);
		exit();

	}


?>