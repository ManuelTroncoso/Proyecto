<?php
$con = mysqli_connect('localhost', 'calcu', 'calcu', 'accounts') or die("La conexion no ha sido posible establecerla");
$con->query("set names utf8");
$name = $_REQUEST['nameUser'];
$tuit = $_REQUEST['tuit'];
if($tuit != ""){
        
        $consulta = $con->query( "UPDATE teacherAccount SET tuit = '$tuit' WHERE user = '$name'");
        echo "Ready";
}
else{
        $consulta = $con->query( "select tuit from teacherAccount WHERE user = '$name'");
        $salida = array();
        $salida =  $consulta->fetch_all(MYSQLI_ASSOC);
        echo json_encode($salida);
}
$con->close();
?>