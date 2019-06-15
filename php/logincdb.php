<?php
    $usuario = $_REQUEST['usuario']; 
    $pass = $_REQUEST['pass'];
    $passHash = password_hash($pass, PASSWORD_BCRYPT);
    $email = $_REQUEST['email'];
    $code = $_REQUEST['code'];
    $born = $_REQUEST['born'];
    $lang = $_REQUEST['lang'];
    $con = mysqli_connect('localhost', 'calcu', 'calcu', 'account') or die("La conexion no ha sido posible establecerla");
    //$db = mysqli_select_db($con, 'usuarios') or die("La conexion no se ha podido establecer");
    $con->query("set names utf8");
    $consulta = $con->query("select * from codes where Id = '$code';");
    if($consulta->num_rows > 0){
        $consulta = $con->query("select * from teacherAccount where user = '$usuario';");
        $consulta2 = $con->query("select * from studentAccount where user = '$usuario';");
        if($consulta->num_rows>0 && $consulta2->num_rows>0){
            echo "UserError";
        }
        else{
            $consulta = $con->query( "insert into teacherAccount (user, password, email, born, private, language) values('$usuario', '$passHash', '$email', '$born', 0, '$lang');");
            if($consulta){
                $con->query("DELETE FROM codes WHERE id = '$code'");
                echo"true";
            }
            else{
                echo "false";
            }
        }
        
    }
    else{
        echo "NoCode";
    }
$con->close();
    
?>
