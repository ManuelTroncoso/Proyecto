<?php 
    $con = mysqli_connect('localhost', 'calcu', 'calcu', 'account') or die("La conexion no ha sido posible establecerla");
    //$db = mysqli_select_db($con, 'usuarios') or die("La conexion no se ha podido establecer");
    $con->query("set names utf8");
    $name = $_REQUEST['nameUser'];
    $consulta = $con->query( "select user, id, email, sala from teacherAccount where user like '$name%'");
        
    if ($consulta->num_rows > 0){
        $salida = array();
        $salida =  $consulta->fetch_all(MYSQLI_ASSOC);
        echo json_encode($salida);
    }
    else{
        echo  json_encode("");
    }
    $con->close();
?>