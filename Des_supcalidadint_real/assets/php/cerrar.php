<?php

session_start();
$_SESSION['numempleado'];
session_destroy();

header('location: ../../login.php');
	
?>