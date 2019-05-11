<?php

$servidor = "localhost";
$usuario= "calcu";
$password = "calcu";
$base_datos = "accounts";



$conexion = new mysqli($servidor, $usuario, $password, $base_datos);


function formatearFecha($fecha){
	return date('g:i a', strtotime($fecha));
}


?>
