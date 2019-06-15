
<?php
session_destroy();
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="shortcut icon" href="css/icon/favicon.ico" />
  <title>LearningChatting</title>

  <!-- Bootstrap -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
  <script src="index.js"></script>
  <link rel="stylesheet" href="/css/global.css">
  <link rel="stylesheet" href="css/style.css">


</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
  
  <a class="navbar-brand" href="#"  id="iconPpal"><img src="../css/icon/icon-ppal.svg" width="48px" alt=""></a>
  <h2 class="title">LearningChatting</h2>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
   
    <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
      <span class="navbar-text">
        <a class="nav-link" href="#" data-toggle="modal" data-target="#logModal">Registro/Entrar</a>
      </span>
    </div>
  </nav>
  <?php
  $error =  $_GET['error'];
  if($error == 1){
    echo '<div class="alert alert-danger" id="error" role="alert" style="text-align: center">
      <strong>Usuario o contraseña incorrecta</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span></button></div>';
  }
?>
  <!-- Modal -->
  <div class="modal fade" id="logModal" tabindex="-1" role="dialog" aria-labelledby="logModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header row">
          <div class="col-sm-5 modal-title" id="sing-up">
            <h5>Registro</h5>
          </div>
          <div class="col-sm-5 modal-title" id="sing-in">
            <h5>Entrar</h5>
          </div>

          <button type="button" class="close col-sm-2" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div id="frm-show">
            <div id="input-error"></div>

            <p>Usuario</p><input type="text" name="user" id="">
            <p>Contraseña</p><input type="password" name="pass" id="">
            <p>Repetir contraseña</p><input type="password" name="repeatpass" id="">
            <p>Email</p><input type="email" name="email" id="">
            <p>Fecha de nacimeinto</p><input type="Date" name="born" id="">
            <p>Lenguaje</p> <select name="language" id="languaje">
                                <option value="Spain">Español</option>
                                <option value="English">Inglés</option>
            </select>
            <p>Code</p><input type="text" name="code" id="">
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" id="ok"  onclick="ClickOk()">Entrar</button>
              </div>
        </div>
        </div>
      </div>
    </div>
  </div>


  <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img class="d-block w-100 imgcarusel" src="../css/photo/foto.jpg" alt="First slide">
      <div class="carousel-caption d-none d-md-block">
        <h5>¿Qué somos?</h5>
        <p>Somos una web encargada de dar un soporte de chat a los colegios de manera gratuita, de forma que los alumnos puedan interactuar entre si en diferentes idiomas</p>
      </div>
    </div>
    <div class="carousel-item">
      <img class="d-block w-100 imgcarusel" src="../css/photo/foto2.jpg" alt="Second slide">
      <div class="carousel-caption d-none d-block">
        <h5>¿Cómo consigo una cuenta?</h5>
        <p>La unica forma de conseguir una cuenta es entrando en contacto con nosotros a través de nuestro correo "learningchatting@gmail.com", desde el cual le proporcionaremos un
          código a traves del cual podrá registrarse en nuestra web
        </p>
      </div>
    </div>
    <div class="carousel-item">
      <img class="d-block w-100 imgcarusel" src="../css/photo/foto3.jpg" alt="Third slide">
      <div class="carousel-caption d-none d-block">
        <h5>Creadores</h5>
        <p>&copy; Copyright 20826, TGStudios</p>
      </div>
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>

</body>



</html>