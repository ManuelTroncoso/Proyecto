<?php
    $usuario = $_REQUEST['user']; 
    $pass = $_REQUEST['pass'];
    $con = mysqli_connect('localhost', 'calcu', 'calcu', 'accounts') or die("La conexion no ha sido posible establecerla");
    //$db = mysqli_select_db($con, 'usuarios') or die("La conexion no se ha podido establecer");
    $con->query("set names utf8");
    $consulta = $con->query( "select * from teacherAccount where user = '$usuario' and password = '$pass' ;");
    //Si no es una cuenta de alumnos
    if ($consulta->num_rows > 0){
		//$salida = array();
        //$salida = $consulta->fetch_all(MYSQLI_ASSOC);
        session_start();
        $_SESSION[$name] = $usuario;

        header("Location:../teacher/menu.php");       
	}else{
        $consulta = $con->query( "select * from studentAccount where user = '$usuario' and password = '$pass' ;");
        if ($consulta->num_rows > 0){
            //$salida = array();
            //$salida = $consulta->fetch_all(MYSQLI_ASSOC);
            session_start();
            $_SESSION[$name] = $usuario;
            header("Location:../student/menu.php");       
        }else{
            echo "El usuario o la contraseña no son correctos";
        }
	}
    $con->close();
?>
