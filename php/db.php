<?php
    $usuario = $_REQUEST['user']; 
    $pass = $_REQUEST['pass']; 
    $student = $_REQUEST['student'];
    $con = mysqli_connect('localhost', 'calcu', 'calcu', 'account') or die("La conexion no ha sido posible establecerla");
    //$db = mysqli_select_db($con, 'usuarios') or die("La conexion no se ha podido establecer");
    $con->query("set names utf8");
    if($student == "on"){
        $consulta = $con->query( "select password from studentAccount where user = '$usuario';");
        if (password_verify($pass, $consulta->fetch_all(MYSQLI_ASSOC)[0]['password'])){
            //$salida = array();
            //$salida = $consulta->fetch_all(MYSQLI_ASSOC);
            session_start();
            $_SESSION['name'] = $usuario;
            header("Location:../student/menu.php");       
        }
        else{
            header("Location:../index.php?error=1");
        }
    }
    else{
        $consulta = $con->query( "select password from teacherAccount where user = '$usuario';");
        if (password_verify($pass, $consulta->fetch_all(MYSQLI_ASSOC)[0]['password'])){
            session_start();
            //Envia el id del usuario que esta entrando(Profesor).
            $_SESSION['id'] = ($con->query( "select id from teacherAccount where user = '$usuario';"))->fetch_all(MYSQLI_ASSOC)[0]['id'];
            $_SESSION['sala'] = ($con->query( "select sala from teacherAccount where user = '$usuario';"))->fetch_all(MYSQLI_ASSOC)[0]['sala'];
            $_SESSION['name'] = $usuario;
            
            header("Location:../teacher/menu.php");       
        }
        else{
            header("Location:../index.php?error=1"); 
        }
    }
    //Si no es una cuenta de alumnos
    
    $con->close();
?>
