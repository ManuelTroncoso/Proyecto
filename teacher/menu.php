<?php
session_start();
$user =  $_SESSION['name'];
$sala = $_SESSION['sala'];
$url = "";
if($sala != ''){
  CambiaSala($user);
  $url = "../Chat/index.php";
}else{
  CambiaSala($user);
  $url = "../Chat/addChat.php";
}


function CambiaSala($user){
  $con = mysqli_connect('localhost', 'calcu', 'calcu', 'account') or die("La conexion no ha sido posible establecerla");
  $con->query("set names utf8");
  $consulta = $con->query( "select sala from teacherAccount where user = '$user'");
  $salida = array();
  $salida =  $consulta->fetch_all(MYSQLI_ASSOC);
  $sala =json_encode($salida[0]['sala']);
  $_SESSION['sala'] = substr(substr($sala, 1),0, strlen($sala) -2);
  echo  $_SESSION['sala'];
  $con->close();
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LearningChatting</title>
    <link rel="stylesheet" href="menu.css">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script>
      var sala = '<?php echo $sala;?>'
      var user = '<?php echo $user;?>'
    </script>
    <script src="menu.js"></script>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03"
            aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="#">Navbar</a>

        <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item">
                    <a class="nav-link id" href="#" onclick="profileUser('<?php echo $user?>')" id="<?php echo $id?>"> <?php echo $user?> </a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="#" data-toggle="modal" data-target="#addModal">Añadir <span class="sr-only">(current)</span></a>
                </li>
                <!-- <li class="nav-item">
                    <a class="nav-link" href="#">Notificaciones</a>
                </li> -->
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo $url?>">Chat</a>
                </li> 
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo "../cerrarSesion.php" ?>">Cerrar Sesión</a>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
    </nav>

    <!-- Modal -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
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
                  <div id="input-error"></div>
                    <p>Usuario</p><input type="text" name="user" id="<?php echo $id ?>">
                    <p>Contraseña</p><input type="password" name="pass" id=""> 
                    <p>Repetir contraseña</p><input type="password" name="repeatpass" id="">
                    <p>Email</p><input type="email" name="email" id="">
                    <p>Lenguaje</p> <select name="language" id="">
                                <option value="Spain">Español</option>
                                <option value="English">Inglés</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
              <button type="button" class="btn btn-primary" id="ok">Entrar</button>
            </div>
          </div>
        </div>
      </div>
      <div id="list-Teacher"></div>
</body>

</html>