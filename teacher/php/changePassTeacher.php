<?php 
$con = mysqli_connect('localhost', 'calcu', 'calcu', 'account') or die("La conexion no ha sido posible establecerla");
$con->query("set names utf8");
$name = $_REQUEST['nameUser'];
$pass = $_REQUEST['pass'];
$passHash = password_hash($pass, PASSWORD_BCRYPT);  
$consulta = $con->query( "UPDATE teacherAccount SET password = '$passHash' WHERE user = '$name'");
if($consulta){
    echo "ready";
}
else{
    echo  "fail";
}

?>