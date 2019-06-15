<?php
$con = mysqli_connect('localhost', 'calcu', 'calcu', 'account') or die("La conexion no ha sido posible establecerla");
$con->query("set names utf8");
$name = $_REQUEST['nameUser'];
$tuit = $_REQUEST['tuit'];
$retuit = $_REQUEST['retuit'];
if($tuit != ""){
        
        $consulta = $con->query( "UPDATE studentAccount SET tuit = '$tuit' WHERE user = '$name'");
        echo "Ready";
}
else{
        if($retuit != ""){
                $consulta = $con->query( "select retuit from studentAccount WHERE user = '$name' and retuit is not null");
                
                if ($consulta->num_rows == 0){
                        $salida = array();
                        $salida =  $consulta->fetch_all(MYSQLI_ASSOC);
                        $salida = $retuit;
                        $consulta = $con->query( "UPDATE studentAccount SET retuit = "."'[". $salida ."]' WHERE user = '$name'");
                        echo "Ready";
                }
                else{
                        $salida = array();
                        $salida =  $consulta->fetch_all(MYSQLI_ASSOC);
                        $salida[0] = substr( substr(implode($salida[0]), 0, -1),1);
                        array_push($salida, $retuit);
                        //echo implode("," ,$salida);
                        //echo json_encode($consulta->num_rows );
                        $consulta = $con->query( "UPDATE studentAccount SET retuit = "."'[".implode(",", $salida)."]' WHERE user = '$name'");
                        echo "Ready";
                }
                
                //
                //echo "Ready";
        }
        else{
                $consulta = $con->query( "select tuit from studentAccount WHERE user = '$name'");
                $salida = array();
                $salida =  $consulta->fetch_all(MYSQLI_ASSOC);
                echo json_encode($salida);
        }
        
}
$con->close();
?>