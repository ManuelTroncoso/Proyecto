<?php 
$con = mysqli_connect('localhost', 'calcu', 'calcu', 'account') or die("La conexion no ha sido posible establecerla");
$con->query("set names utf8");
$name = $_REQUEST['nameUser'];
$chat = $_REQUEST['chat'];
if($chat != ""){
        
        $consulta = $con->query( "UPDATE studentAccount SET sala = '$chat' WHERE user = '$name'");
        // $consulta = $con->query( "select sala from teacherAccount WHERE user = '$name'");     
        // $salida = array();
        // $salida =  $consulta->fetch_all(MYSQLI_ASSOC);
        // echo $salida[0]['sala'];
        //echo "UPDATE teacherAccount SET sala = '$chat' WHERE user = '$name'";
}
?>