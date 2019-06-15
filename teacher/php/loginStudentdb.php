<?php
    $usuario = $_REQUEST['usuario']; 
    $pass = $_REQUEST['pass'];
    $passHash = password_hash($pass, PASSWORD_BCRYPT);
    $email = $_REQUEST['email'];
    $language = $_REQUEST['language'];
    $sala = $_REQUEST['sala'];
    $idTeacher = $_REQUEST['idTeacher'];
    $con = mysqli_connect('localhost', 'calcu', 'calcu', 'account') or die("La conexion no ha sido posible establecerla");
    //$db = mysqli_select_db($con, 'usuarios') or die("La conexion no se ha podido establecer");
    $con->query("set names utf8");
    $consulta = $con->query("select * from studentAccount where user = '$usuario';");
    $consulta2 = $con->query("select * from teacherAccount where user = '$usuario';");
    if($consulta->num_rows>0 || $consulta2->num_rows>0){
        echo "UserError";
    }
    else{
        $consulta = $con->query( "insert into studentAccount (user, teacherId, password, email, language) values('$usuario', '$idTeacher' ,'$passHash', '$email', '$language');");
        if($consulta){
            echo "true";
        }
        else{
            echo "false";
        }
    }

    $con->close();
?>
