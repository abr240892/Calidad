<?php
include('conexiones.php');

switch($_POST['posibility'])
{
    case 'guardo': insertar();
    	break;
	case 'limpiar': limpiar();
		break;
	case 'mostrar': mostrar();
		break;
    case 'buscar': empleados();
    	break;
	case 'casillas': casillas();
		break;
	case 'Posiciones': Posiciones();
		break;
	case 'altausario': altausario();
		break;
	case 'verificaEmpleado': verificaEmpleado();
		break;
};

// FUNCIÓN GUARDA LOS DATOS INGRESADOS EN LA POSICIÓN
function insertar()
{
	$conexion = conectaBD_128_catalogoempleados();

	$Pos         = $_REQUEST['posicion'];
	$Ip          = $_REQUEST['ip'];
	$NumEmpleado = $_REQUEST['numempleado'];
	$NomEmpleado = $_REQUEST['nombre'];
	$ApePaterno  = $_REQUEST['ape_paterno'];
	$ApeMaterno  = $_REQUEST['ape_materno'];
	$Jefe        = $_REQUEST['jefe'];
	$Gerente     = $_REQUEST['gerente'];
	$Campana     = $_REQUEST['campana'];
	$Servicio    = $_REQUEST['servicio'];
	$Centro      = $_REQUEST['centro'];
	$Edificio    = $_REQUEST['edificio'];
	$Piso        = $_REQUEST['piso'];
	$Turno       = $_REQUEST['turno'];
	$Bandera 	 = $_REQUEST['bandera'];

	$Ejecutivo = $NomEmpleado." ".$ApePaterno." ".$ApeMaterno;

	if (empty($Ip) || empty($NumEmpleado) || empty($NomEmpleado) || empty($ApePaterno) || empty($ApeMaterno) || empty($Gerente) || empty($Campana) || empty($Servicio) || empty($Centro))
	{	
		if (empty($Ip)) {
			$estado  = -1;
			$mensaje = 'Por favor, Ingrese una IP';
		} else if (empty($NumEmpleado)) {
			$estado  = -2;
			$mensaje = 'Por favor, Ingrese el #Empleado';
		} else if (empty($Gerente)) {
			$estado  = -3;
			$mensaje = 'Por favor, Ingrese el nombre del Gerente';
		} else if (empty($Campana)) {
			$estado  = -4;
			$mensaje = 'Por favor, Ingrese la Campaña';
		}
	} else {
		$query = "SELECT * FROM fun_guardacroquiscat('$Pos','$Ip','$NumEmpleado','$Gerente','$Jefe','$Ejecutivo','$Campana','$Servicio','$Centro','$Edificio','$Piso','$Turno')";

		$answer = pg_query($conexion,$query);
		$row = pg_fetch_assoc($answer);

		$estado = $row['estado'];
		$mensaje = $row['mensaje'];
	}
	
	$auth = array('estado' => $estado, 'mensaje' => $mensaje);
	echo json_encode($auth);
}


// FUNCIÓN BUSCA AL EMPLEADO EN EL CATALOGO EMPLEADOS POR SU NÚMERO DE EMPLEADO
function empleados()
{
	$conexion = conectaBD_128_catalogoempleados();

	$NumEmpleado = $_POST['numempleado'];


	$sQuery = "SELECT C.nombre, C.apellidopaterno, C.apellidomaterno, C.puestonominal , C.centro, C.nombrejefe, D.Servicio FROM (SELECT A.nombre,
			   A.apellidopaterno, A.apellidomaterno, A.centro, A.puestonominal , B.nombrejefe ,a.servicio as servi  FROM catalogoempleados AS A
		       JOIN catalogocentros AS B
		       ON A.centro = B.numerodecentro
		       WHERE A.empleado = ".$NumEmpleado.") AS C
		       LEFT JOIN 
		       (SELECT a.idservicio as idserv  , A.servicio as Servicio ,nombre FROM catalogoservicio AS A
		       JOIN catalogoempleados AS B
		       ON a.idservicio::character varying = b.servicio
		       WHERE b.empleado =".$NumEmpleado.") AS D
		       ON c.servi::smallint = d.idserv";

    $response = pg_query($conexion,$sQuery);
   	$datos = array();

	while ($answer=pg_fetch_array($response)) 
	{
		$datos['nombre']          = ($answer);
		$datos['apellidopaterno'] = ($answer);
		$datos['apellidomaterno'] = ($answer);
		$datos['centro'] 		  = ($answer);
		$datos['nombrejefe'] 	  = ($answer);
		$datos['servicio']        = ($answer);

		$valores = array_map('utf8_encode',$answer);
	}	

	$Empleado = $valores['nombre'];
	if (!empty($Empleado)) {
		$estado = 0;
		$mensaje = 'Empleado Encontrado';
	} else {
		$estado = 1;
		$mensaje = 'Numero Incorrecto';
	}

	pg_close($conexion);

	$retonar= array( 'estado' => $estado ,'mensaje' => $mensaje,'valores' => $valores);
	
	echo json_encode($retonar);
	
};

// FUNCIÓN MUESTRA EL EJECUTIVO YA INGRESADO EN LA POSICIÓN
function mostrar() {
	$conexion = conectaBD_128_catalogoempleados();

	$posicion = $_POST['Posicion'];
	$edificio = $_POST['edificio'];
	$piso     = $_POST['piso'];
	$turno    = $_POST['turno'];

	// echo "Datos: ".$id." ".$edificio." ".$piso." ".$turno;

	$sQuery = "SELECT * FROM empleados_croquis WHERE posicion = '$posicion' AND piso='$piso' AND edificio='$edificio' AND turno = '$turno'";

    $response = pg_query($conexion,$sQuery);
   	$datos = array();

	while ($answer=pg_fetch_array($response)) 
	{
		$datos['posicion']        = ($answer);
		$datos['ip']              = ($answer);
		$datps['numempleado']     = ($answer);
		$datos['gerente']         = ($answer);
		$datos['jefe']     		  = ($answer);
		$datos['ejecutivo']       = ($answer);
		$datos['campana'] 		  = ($answer);
		$datos['servicio'] 	      = ($answer);
		$datos['centro']          = ($answer);
		$datos['edificio']        = ($answer);
		$datos['piso']            = ($answer);
		$datos['turno']           = ($answer);
		
		$valores = array_map('utf8_encode',$answer);
	}

	$bandera = $valores['numempleado'];
	if (!empty($bandera)) {
		$estado = 0;
		$mensaje = 'Posicion Activa/Ocupada';
	} else {
		$estado = 1;
		$mensaje = 'Posicion Libre/Desocupada';
	}

	// print_r($valores['numempleado']);

	$retonar= array( 'estado' => $estado ,'mensaje' => $mensaje,'valores' => $valores);
	echo json_encode($retonar);
	// echo $retonar;
	
};

// FUNCIÓN MODIFICA LOS DATOS INGRESADOS EN UNA POSICIÓN
function limpiar() {
	$conexion = conectaBD_128_catalogoempleados();

	$Pos         = $_REQUEST['posicion'];
	$Ip          = $_REQUEST['ip'];
	$NumEmpleado = $_REQUEST['numempleado'];
	$NomEmpleado = $_REQUEST['nombre'];
	$ApePaterno  = $_REQUEST['ape_paterno'];
	$ApeMaterno  = $_REQUEST['ape_materno'];
	$Jefe        = $_REQUEST['jefe'];
	$Gerente     = $_REQUEST['gerente'];
	$Campana     = $_REQUEST['campana'];
	$Servicio    = $_REQUEST['servicio'];
	$Centro      = $_REQUEST['centro'];
	$Edificio    = $_REQUEST['edificio'];
	$Piso        = $_REQUEST['piso'];
	$Turno       = $_REQUEST['turno'];


	$Ejecutivo = $NomEmpleado." ".$ApePaterno." ".$ApeMaterno;

	if($conexion)
	{
		$query = "SELECT * FROM fun_guardacroquiscat('$Pos','$Ip','$NumEmpleado','$Gerente','$Jefe','$Ejecutivo','$Campana','$Servicio','$Centro','$Edificio','$Piso','$Turno')";

		$resp = pg_query($conexion,$query);
		$auth = array('estado' => 0, 'mensaje' => 'La posicion se ha liberado.','sql'=>$query);
		echo json_encode($auth);
		pg_close($conexion);
	}
	else
	{
		$err=pg_connection_status($conexion);
		echo json_encode($err);
	};
}


function altausario()
{
	$conexion = conectaBD_128_bdd_usarios_croquis();

	$num_emp	 = $_POST['numempleado'];
	$nom_emp	 = $_POST['txtnombre'];	
	$contra 	 = $_POST['txtcontrasena'];
	$conf_contra = $_POST['txtconfirmarcontrasena'];

	if($conexion)
	{
		if (empty($num_emp) || empty($nom_emp) || empty($contra) || empty($conf_contra))
		{
			$valores['estado']      = 2;
			$valores['mensaje']     = 'Por favor, ingrese todos los datos....';
		}
		else
		{
			if ($contra != $conf_contra)
			{
				$valores['estado']      = 3;
				$valores['mensaje']     = 'Por favor, confirme la contraseña correctamente';
			}
			else
			{
				$query = "SELECT * FROM fun_registrocroquis(".$num_emp.",'".$nom_emp."','".$contra."')";
				$resp = pg_query($conexion,$query);
				$answer = array();

				while ( $answer=pg_fetch_array($resp)) 
				{
					$datos['estado']  = ($answer);
					$datos['mensaje'] = ($answer);

					$valores = array_map('utf8_encode',$answer);
				}

			}
		}
		$auth = array('valores' => $valores);
	}
	else
	{
		$err=pg_connection_status($conexion);
		echo json_encode($err);
	}
	echo json_encode($auth);
}//FIN altausuario();

function casillas() {
	$turnoSelected  = $_POST['turnoSelected'];
	$edifioSelected = $_POST['edifioSelected'];
	$pisoSelected 	= $_POST['pisoSelected'];

 	$conexion = conectaBD_128_bdd_usarios_croquis();

 	if($conexion)
 	{
 		$sQuery = "SELECT e.posicion,f.turno,f.bandera,f.edificio FROM empleados_croquis  as e
    	join  flagcroquis as f
    	on e.posicion = f.posicion
    	and e.turno = f.turno";
    	if($turnoSelected <> 'undefined' && $turnoSelected <> null)
    	{
       		if(strlen($turnoSelected) > 4)
       		{
       			$sQuery= "SELECT posicion,turno,bandera,edificio FROM flagcroquis WHERE turno = '$turnoSelected' AND edificio = '$edifioSelected'	AND piso = '$pisoSelected'";
       			$sQuery= "SELECT a.posicion,a.turno,a.bandera,a.edificio, b.numempleado,b.ip FROM  flagcroquis as a JOIN empleados_croquis as b ON a.turno = b.turno AND a.edificio = b.edificio AND a.piso = b.piso AND a.posicion = b.posicion WHERE a.turno = '$turnoSelected' AND a.edificio = '$edifioSelected' AND a.piso = '$pisoSelected'";
       		}
    	}

		$resp = pg_query($conexion,$sQuery);
		$answer = array();

		while ($answer = pg_fetch_array($resp))
		{
			$datos['posicion'] = $answer[0];
			$datos['turno']    = $answer[1];
			$datos['bandera']  = $answer[2];
			$datos['edificio'] = $answer[3];
			$datos['numempleado'] = $answer[4];
			$datos['ip'] = $answer[5];
			$estado	= 0;
			$mensaje = 'OK';

			$valores[] = array_map('utf8_encode',$datos);
		}
 	}
 	else
 	{
 		$estado	 = -100;
 		$mensaje = 'No hay conexion.';
 	}

	$salidaJSON = array('estado' => $estado, 'mensaje' => $mensaje, 'valores' => $valores, 'sql' => $sQuery);
	print json_encode($salidaJSON);
}//FIN casillas

function Posiciones() {
	$conexion = conectaBD_128_bdd_usarios_croquis();

	$Turno 		= $_REQUEST['turno'];
	$Edificio 	= $_REQUEST['edificio'];	
	$Piso 		= $_REQUEST['piso'];

	if($conexion)
	{
		$sQueryOcupado = "SELECT count(bandera) FROM flagcroquis WHERE turno = '$Turno' AND edificio = '$Edificio' AND piso = '$Piso' AND bandera = '1';";
		$sQueryLibre = "SELECT count(bandera) FROM flagcroquis WHERE turno = '$Turno' AND edificio = '$Edificio' AND piso = '$Piso' AND bandera = '0';";

		$resp1 =  pg_query ( $conexion,$sQueryOcupado );
		$resp2 =  pg_query ( $conexion,$sQueryLibre );

		$row1 = pg_fetch_assoc($resp1);
		$row2 = pg_fetch_assoc($resp2);

		$estado = 0;
		$mensaje = 'Todo correcto';
	}
	else
	{
		$estado = -100;
		$mensaje = 'No hay conexion.';
	}

	$salidaJSON = array('estado1' => $estado, 'contador1' => $row1['count'], 'contador2' => $row2['count']);
	print json_encode($salidaJSON);
}// FIN Posiciones

// verificaEmpleado();
function verificaEmpleado() {
	$conexion = conectaBD_128_bdd_usarios_croquis();
	$empleado = $_POST['empleado'];
	session_start();

	if($conexion)
	{
		$sQuery = "SELECT 1::integer as estado FROM usuarios_croquis WHERE numempleado = '$empleado'";
		$resp = pg_query($conexion, $sQuery);
		$estado = pg_fetch_array($resp);
		$_SESSION['log']= 1;
		
	}
	else
	{
		$estado = -100;
		$mensaje = 'No hay conexion.';
	}

	$salidaJSON = array('estado' => $estado['estado'] );
	print json_encode($salidaJSON);
}// FIN verificaEmpleado

?>