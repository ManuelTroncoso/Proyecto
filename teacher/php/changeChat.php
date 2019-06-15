<?php 
$con = mysqli_connect('localhost', 'calcu', 'calcu', 'account') or die("La conexion no ha sido posible establecerla");
$con->query("set names utf8");
$name = $_REQUEST['nameUser'];
$chat = $_REQUEST['chat'];
if($chat != ""){
        
        $consulta = $con->query( "UPDATE teacherAccount SET sala = '$chat' WHERE user = '$name'");
        if($consulta){
                echo 'ready';
        }
        else{
                echo 'null';
        }
}
?>