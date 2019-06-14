<?php
    $con = mysqli_connect('localhost', 'calcu', 'calcu', 'account') or die("La conexion no ha sido posible establecerla");
    //$db = mysqli_select_db($con, 'usuarios') or die("La conexion no se ha podido establecer");
    $con->query("set names utf8");
    $name = $_REQUEST['nameUser'];
    if($name != ""){
    $consulta = $con->query( "select user, id, email, sala, photo, born, tuit, Retuit from stuedntAccount where '$name' = user" /*and private = 0"*/);
        //if($consulta->num_row > 0){
            $salida = array();
            $salida =  $consulta->fetch_all(MYSQLI_ASSOC);
            $fh = fopen("../profile/selectProfile$name.js", 'w');
            fwrite($fh, "user=".json_encode($salida));
            fclose($fh);
            echo "Ready";
        //} 
        //else{
        //    echo 'Private';
        //}
    }
    else{
        $consulta = $con->query( "select user, id, email, sala, language from studentAccount");
    
        if ($consulta->num_rows > 0){
            $salida = array();
            $salida =  $consulta->fetch_all(MYSQLI_ASSOC);
            echo json_encode($salida);
        }
        else{
            echo 'No hay estudiantes';
        }
    }
    $con->close();
?>
