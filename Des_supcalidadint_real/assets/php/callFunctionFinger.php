<?php
include("conexiones.php");
// fingerPrintValidator::funtionValidator(92917631,$_SERVER['REMOTE_ADDR'],"MX","http://10.44.2.25:20711/wsAgentServiceConnect/service/autenticar");
Class fingerPrintValidator {
    public static function funtionValidator($numberEmployee,$iP,$country,$urlService){
        //Arreglo a codificar a JSON
        $fields = array("numeroAutenticar" => "".$numberEmployee."",
                        "ipAddress" => "".$iP."",
                        "pais" => "".$country."");
        //Codificaci�n nativa de PHP de arreglo a JSON
        $data_strings = json_encode($fields);
        //Apertura de la conexi�n al servicio
        $ch = curl_init($urlService);
        //Definici�n del tipo de petici�n, en este caso POST
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        //Definici�n de los campos POST, es decir de los par�metros
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_strings);
        //Indicar que se devuelva el resultado de la transferencia como string de la ejecuci�n
        //en lugar de mostrarlo directamente
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        //Construcci�n de la la cabecera HTTP, el tipo de contenido es application/json
        //y el contenido es el total de bytes dela cadena del JSON
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data_strings))
        );
        //Ejecuci�n de la petici�n al servicio
        $result = curl_exec($ch);
        //Cierre de la conexi�n
        curl_close($ch);
        print $result;
    }
}

// RetornaEmpleado();
function RetornaEmpleado() {
// $numberEmployee = $_POST['empleado'];
  $conexion = conectaBD_128_catalogoempleados();
  session_start();

  $NumEmpleado = $_POST['empleado'];
  // $NumEmpleado = 92917631;
  // if (empty($NumEmpleado)) {
      $query ="SELECT true as estado, puestonominal 
      FROM catalogoempleados where empleado = '$NumEmpleado'" ;

      $resp = pg_query($conexion,$query);
      $data = array();

    while($row = pg_fetch_array($resp)) {
      $data['estado'] = $row['estado'];
      $data['puestonominal'] = $row['puestonominal'];
    }

    if($data['estado'] == true) { 
      $_SESSION['log']= 1;

      $auth = array('estado' => 1, 'mensaje' => 'EXITO', 'puestonominal'=>$data['puestonominal']);

    } else {
      $auth = array('estado' => 2, 'mensaje' => 'FALLO CONSULTA');
      session_destroy();
    }
    echo json_encode($auth);
  // } else {
  //   echo "Ingrese Numero De Empleado";
  // }
}

if ($_GET['opc'] ==1) {
    session_start();
    $_SESSION['numempleado'];
    session_destroy();

    header('location: ../../login.php');
}



$opcion = $_POST['opc'];

switch ($opcion) {
    case 'openFingerPrintHuella':
        fingerPrintValidator::funtionValidator($_POST['numberEmployee'],$_SERVER['REMOTE_ADDR'],"MX","http://10.44.2.25:20711/wsAgentServiceConnect/service/autenticar");
          break;
    case 'RetornaEmpleado':
        RetornaEmpleado();
    break;
    default:
    break;
}
?>