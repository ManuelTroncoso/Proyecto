<?php
    $user = $_REQUEST['user']; 
    $con = mysqli_connect('localhost', 'calcu', 'calcu', 'account') or die("La conexion no ha sido posible establecerla");
    //$db = mysqli_select_db($con, 'usuarios') or die("La conexion no se ha podido establecer");
    $con->query("set names utf8");
    $consulta = $con->query( "select user from studentAccount where teacherId in (select id from teacherAccount where user = '$user');");
    $salida = array();
    $salida =  $consulta->fetch_all(MYSQLI_ASSOC);
    
    if ($consulta->num_rows > 0){
        echo json_encode($salida);    }
    else{
        echo  "No hay alunmos creados";
    }
    $con->close();
?>
