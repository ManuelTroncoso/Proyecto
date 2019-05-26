<?php 
$con = mysqli_connect('localhost', 'calcu', 'calcu', 'account') or die("La conexion no ha sido posible establecerla");
$con->query("set names utf8");
$sala =  $_REQUEST['sala'];
$private = $_REQUEST['private'];
$name  = $_REQUEST['userName'];
echo $sala;
if($sala != ""){        
        $consulta = $con->query( "UPDATE teacherAccount SET sala = '$sala' WHERE user = '$name'");
}
?>
