<?php
    $con = mysqli_connect('localhost', 'calcu', 'calcu', 'account') or die("La conexion no ha sido posible establecerla");
    //$db = mysqli_select_db($con, 'usuarios') or die("La conexion no se ha podido establecer");
    $con->query("set names utf8");
    $consulta = $con->query( "select user, id, language from studentAccount");
    if ($consulta->num_rows > 0){
        $salida = array();
        $salida =  $consulta->fetch_all(MYSQLI_ASSOC);
        echo json_encode($salida);
    }
    else{
        echo 'No hay estudiantes';
    }
    $con->close();
?>
