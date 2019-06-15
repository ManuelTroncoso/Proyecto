<?php
session_start();
clearstatcache ();
$sala = "";
$user =  $_SESSION['name'];
$sala = $_SESSION['sala'];
$id = $_SESSION['id'];
$url = "";
$modal  = "";
CambiaSala($user);


if($_SESSION['sala'] != 'ul'){
  CambiaSala($user);
  // type 1001 = student
  $url = "../Chat/index.php?type=1001";
}else{
  CambiaSala($user);
   $url = "#";
   $modal = 'data-toggle="modal" data-target="#addChat"';
  //$url = "../Chat/index.php";
}
$sala = $_SESSION['sala'];

function CambiaSala($user){
  $con = mysqli_connect('localhost', 'calcu', 'calcu', 'account') or die("La conexion no ha sido posible establecerla");
  $con->query("set names utf8");
  $consulta = $con->query( "select sala from studentAccount where user = '$user'");
  $salida = array();
  $salida =  $consulta->fetch_all(MYSQLI_ASSOC);
  $sala =json_encode($salida[0]['sala']);
  $_SESSION['sala'] = substr(substr($sala, 1),0, strlen($sala) -2);
  $sala = $_SESSION['sala'] ;
  $con->close();
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="../css/icon/favicon.ico" />

    <title>LearningChatting</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">

    <script>
      var sala = '<?php echo $sala;?>'
      var user = '<?php echo $user;?>'
      var id = '<?php echo $id;?>'
    </script>
    <script src="menu.js"></script>
    <link rel="stylesheet" href="/css/global.css">
    <link rel="stylesheet" href="menu.css">

</head>

<body>
<div class="container-fluid">
   
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03"
            aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand"  id="iconPpal" href="#"><img src="../css/icon/icon-ppal.svg" width="48px" alt=""></a>

        <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item">
                    <a class="nav-link id" href="#" onclick="profileUser('<?php echo $user?>', false)" id="<?php echo $id?>"> <?php echo $user?> </a>
                </li>    
                <li class="nav-item">
                    <a class="nav-link" class="btn btn-primary" href=""  data-toggle="modal" data-target="#changePass">Cambiar contraseña</a>
                </li>           
                <li class="nav-item">
                    <a class="nav-link" href="#" class="btn btn-primary" data-toggle="modal" data-target="#addChat">Crear sala</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" class="btn btn-primary" href="<?php echo $url?>" <?php echo $modal;?> > Sala Nº: <?php echo $_SESSION['sala']; ?></a>
                </li> 
                <li class="nav-item">
                    <a class="nav-link"  href="<?php echo "/cerrarSesion.php" ?>">Cerrar Sesión</a>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" id="search" placeholder="Escribe el nombre..." aria-label="Search">
                <a class="btn btn-outline-success my-2 my-sm-0" role="button" onclick="Search()"><img src="../css/icon/lupa.svg" width="24px" alt=""></a>
            </form>
        </div>
    </nav>

           <!-- Modal -->
           <div class="modal fade" id="changePass" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header row">
              <div class="col-sm-5 modal-title" id="sing-up"><h5>Registro</h5></div>     
              <button type="button" class="close col-sm-2" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <div id="frm-show">
                  <div id="input-error-pass"></div>
                    <p>Nueva Contraseña</p><input type="password" name="newpass" id="newpass"> 
                    <p>Repetir contraseña</p><input type="password" name="newrepeatpass" id="newrepeatpass">
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
              <button type="button" class="btn btn-primary" id="change">Entrar</button>
            </div>
          </div>
        </div>
      </div>

<!-- Modal -->
<div class="modal fade" id="addChat" tabindex="-1" role="dialog" aria-labelledby="addChatLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addChatLabel">Nueva sala</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="input-error"></div>
        <p>Indique el nombre de la sala</p><input type="text" name="user" id="name-chat">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" id="createChat">Crear sala</button>
      </div>
    </div>
  </div>
</div>
    <div id="list-Teacher-title">
    <div class="row">
    <div class="col-sm-2"></div>
    <div class="col-sm-8"> <p class="text-center" >Filtros: <span id="filter-name"> No hay ninguna busqueda actualmente</span></p></div> 
    <div class="col-sm-2"></div>   
    </div>
    <div class="row">
      <div class="col-6 text-right options "><button class="btn btn-link active" id="teacher" onclick="ChangeDateShow('teacher')">Profesor</button></div>
      <div class="col-6 options "><button class="btn btn-primary" id="student" onclick="ChangeDateShow('student')">Alumnos</button></div>
    </div><br>
      <div class="row student-data-title">
        <div class="col-1"></div>
        <div class="col-2"><p class="text-center white" id="teacher-profile">Ver perfil</p></div>
        <div class="col-3"><p class="text-center white" id="teacher-name">Nombre de Usuario</p></div>
        <div class="col-3"><p class="text-center white"> Sala</p></div>
        <div class="col-2"></div>
      </div>
    </div>
    <div id="list-Teacher"></div>
    
    </div>
<div class="footer">
  <p class="text-center">&copy; Copyright 20826, TGStudios</p>
  <p class="text-center">learningchatting@gmail.com</p>
</div>
</body>

</html>