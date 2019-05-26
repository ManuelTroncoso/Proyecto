<?php
    $usuario = $_REQUEST['user']; 
    $pass = $_REQUEST['pass'];
    $student = $_REQUEST['student'];
    $con = mysqli_connect('localhost', 'calcu', 'calcu', 'account') or die("La conexion no ha sido posible establecerla");
    //$db = mysqli_select_db($con, 'usuarios') or die("La conexion no se ha podido establecer");
    $con->query("set names utf8");
    if($student == "on"){
        $consulta = $con->query( "select * from studentAccount where user = '$usuario' and password = '$pass' ;");
        if ($consulta->num_rows > 0){
            //$salida = array();
            //$salida = $consulta->fetch_all(MYSQLI_ASSOC);
            session_start();
            $_SESSION['name'] = $usuario;
            header("Location:../student/menu.php");       
        }
        else{
            echo"Usuario o contraseña son incorrectos";
        }
    }
    else{
        $consulta = $con->query( "select * from teacherAccount where user = '$usuario' and password = '$pass' ;");
        if ($consulta->num_rows > 0){
            session_start();
            //Envia el id del usuario que esta entrando(Profesor).
            $_SESSION['id'] = ($con->query( "select id from teacherAccount where user = '$usuario' and password = '$pass' ;"))->fetch_all(MYSQLI_ASSOC)[0]['id'];
            $_SESSION['sala'] = ($con->query( "select sala from teacherAccount where user = '$usuario' and password = '$pass' ;"))->fetch_all(MYSQLI_ASSOC)[0]['sala'];
            $_SESSION['name'] = $usuario;
            
            header("Location:../teacher/menu.php");       
        }
        else{
            echo"Usuario o contraseña son incorrectos";
        }
    }
    //Si no es una cuenta de alumnos
    
    $con->close();
?>
