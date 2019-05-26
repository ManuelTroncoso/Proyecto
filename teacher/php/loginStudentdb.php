<?php
    $usuario = $_REQUEST['usuario']; 
    $pass = $_REQUEST['pass'];
    $email = $_REQUEST['email'];
    $language = $_REQUEST['language'];
    $sala = $_REQUEST['sala'];
    $idTeacher = $_REQUEST['idTeacher'];
    $con = mysqli_connect('localhost', 'calcu', 'calcu', 'account') or die("La conexion no ha sido posible establecerla");
    //$db = mysqli_select_db($con, 'usuarios') or die("La conexion no se ha podido establecer");
    $con->query("set names utf8");
    $consulta = $con->query( "insert into studentAccount (user, teacherId, password, email, language) values('$usuario', '$idTeacher' ,'$pass', '$email', '$language');");
    if($consulta){
        echo "true";
    }
    else{
        echo  "false";
    }
    $con->close();
?>
