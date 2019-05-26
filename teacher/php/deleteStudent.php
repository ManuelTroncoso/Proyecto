<?php
$con = mysqli_connect('localhost', 'calcu', 'calcu', 'account') or die("La conexion no ha sido posible establecerla");
$con->query("set names utf8");
$name = $_REQUEST['name'];       
$consulta = $con->query( "DELETE FROM studentAccount WHERE user = '$name'");
if(!$consulta){
    echo "Error al borrar";
}
$con->close();
?>