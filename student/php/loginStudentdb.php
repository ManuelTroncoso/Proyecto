<?php
    $usuario = $_REQUEST['usuario']; 
    $pass = $_REQUEST['pass'];
    $email = $_REQUEST['email'];
    $con = mysqli_connect('localhost', 'calcu', 'calcu', 'account') or die("La conexion no ha sido posible establecerla");
    //$db = mysqli_select_db($con, 'usuarios') or die("La conexion no se ha podido establecer");
    $con->query("set names utf8");
    $consulta = $con->query( "insert into studentAccount (user, teacherId, password, email) values('$usuario', 1 ,'$pass', '$email') ;");
    if($consulta){
        echo"true";
    }
    else{
        echo"false";
    }
    $con->close();
?>
