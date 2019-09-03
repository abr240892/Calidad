<?php	

function conectaBD_128_catalogoempleados(){
      $server = '10.44.2.128';
      $user = 'reportes';
      $pass = 'ff7b3106de28225ca601288654f6c57a';
      $bd = 'appwebcat';
      $connec = pg_connect("host=$server dbname=$bd user=$user password=$pass") or die ("Error de conexion servidor ".$server);
      return $connec;
}

function conectaBD_128_ctcpl(){
	$server = '10.44.2.128';
	$user = 'reportes';
	$pass = 'ff7b3106de28225ca601288654f6c57a';
	$bd = 'ctcpl';
	$connec = pg_connect("host=$server dbname=$bd user=$user password=$pass") or die ("Error de conexion servidor ".$server);
    return $connec;
}

function conectaBD_128_ctbcpl(){
	$server = '10.44.2.128';
	$user = 'reportes';
	$pass = 'ff7b3106de28225ca601288654f6c57a';
	$bd = 'ctbcpl';
	$connec = pg_connect("host=$server dbname=$bd user=$user password=$pass") or die ("Error de conexion servidor ".$server);
    return $connec;
}

function conectaBD_128_promocioncoppel(){
	$server = '10.44.2.128';
	$user = 'reportes';
	$pass = 'ff7b3106de28225ca601288654f6c57a';
	$bd = 'promocioncoppel';
	$connec = pg_connect("host=$server dbname=$bd user=$user password=$pass") or die ("Error de conexion servidor ".$server);
    return $connec;
}

function conectaBD_128_e_commerce(){
	$server = '10.44.2.128';
	$user = 'reportes';
	$pass = 'ff7b3106de28225ca601288654f6c57a';
	$bd = 'e_commerce';
	$connec = pg_connect("host=$server dbname=$bd user=$user password=$pass") or die ("Error de conexion servidor ".$server);
    return $connec;
}

function conectaBD_128_atencion(){
	$server = '10.44.2.128';
	$user = 'reportes';
	$pass = 'ff7b3106de28225ca601288654f6c57a';
	$bd = 'atencionacliente';
	$connec = pg_connect("host=$server dbname=$bd user=$user password=$pass") or die ("Error de conexion servidor ".$server);
    return $connec;
}

function conectaBD_128_atencionar(){
	$server = '10.44.2.128';
	$user = 'reportes';
	$pass = 'ff7b3106de28225ca601288654f6c57a';
	$bd = 'atencionaclientear';
	$connec = pg_connect("host=$server dbname=$bd user=$user password=$pass") or die ("Error de conexion servidor ".$server);
    return $connec;
}

function conectaBD_128_campanaunica(){
	$server = '10.44.2.128';
	$user = 'reportes';
	$pass = 'ff7b3106de28225ca601288654f6c57a';
	$bd = 'campunicaweb';
	$connec = pg_connect("host=$server dbname=$bd user=$user password=$pass") or die ("Error de conexion servidor ".$server);
    return $connec;
}

define('PHP_AUTH_USER', 'dav_user');
define('PHP_AUTH_PW', 'dav_pass');
define('username', 'recording');
define('password', 'recording');
//rutas de audios
define('ruta_audios', 'C:/xampp/htdocs/consultamovimientoscataudio/audios/');
define('http_mcp_rec', 'http://10.44.155.238:8080/api/v2/recordings/');
define('http_webdav', 'http://10.44.155.240/recordings/');
//Ruta Huella
define('URL_PERSONAL', 'http://intranet.cln/webservices/personal/wsEmpleadosPb.php?wsdl');


// function conectaBD_203_bdd_edgar(){
// 	$server = '10.24.212.203';
//       $user = 'carlosanguiano';
//       $pass = 'St4ffObr3g0n';
//       $bd = 'bdd_edgar';
//       $connection = pg_connect("host=$server dbname=$bd user=$user password=$pass") or die ("Error de conexion servidor ".$server);
//       return $connection;
// };

// function conectaBD_203_bdd_DanielR() {
//       $server = '10.24.212.203';
//       $user = 'carlosanguiano';
//       $pass = 'St4ffObr3g0n';
//       $bd = 'bdd_Daniel.R';
//       $connection = pg_connect("host=$server dbname=$bd user=$user password=$pass") or die ("Error de conexion servidor ".$server);
//       return $connection;
// };

// function conectaBD_128_bdd_usarios_croquis() {
//       $server = '10.44.2.128';
//       $user = 'reportes';
//       $pass = 'ff7b3106de28225ca601288654f6c57a';
//       $bd = 'appwebcat';
//       $connection = pg_connect("host=$server dbname=$bd user=$user password=$pass") or die ("Error de conexion servidor ".$server);
//       return $connection;
// };

?>