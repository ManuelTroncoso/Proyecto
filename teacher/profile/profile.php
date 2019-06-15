<?php
session_start();
$user =  $_SESSION['name'];
$sala = $_SESSION['sala'];
$userProfile =  $_GET['userProfile'];
$id = $_SESSION['id'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="../../css/icon/favicon.ico" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script>
        var userProfile = '<?php echo $user ?>'
    </script>
    <script src="selectProfile<?php echo $userProfile ?>.js"></script>
    <script src="profile.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/global.css">
    <link rel="stylesheet" href="profile.css">

    <title>Profile</title>
</head>
<body>
<div class="row" id="back">
    <div class="col-1"></div>
    <div class="col-2"><a href="/teacher/menu.php"><img src="../../css/icon/anterior.png" class="iconBack" width="30px" alt=""></a></div>
    <div class="col-6">
        <div class="row">
          <div class="col-6 text-right options "><button class="btn btn-link active" id="tuit" onclick="ChangeDateShow('tuit')">Tuits</button></div>
          <div class="col-6 options "><button class="btn btn-primary" id="retuit" onclick="ChangeDateShow('retuit')">Retuits</button></div>
        </div><br>
    </div>
    <div class="col-3"></div>

</div>
    <h1 class="text-center title" id="nameUser">Perfil de <?php echo $userProfile ?></h1>
    <div id="add-Tuit">
    <input type="text" class="form-control" id="id-tuit" placeholder="Escribe aquí su tuit..."> <br>
    <button type="button" class="btn btn-outline-primary" onclick="AddTuit('<?php echo $user; ?>')" id="btn-add-tuit" data-toggle="modal" data-target="#addTuit"> Añadir un tuit </button>
    </div>
    <div id="list-tuit"></div>
        <!-- Modal -->
        <div class="modal fade" id="addTuit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tuit</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="tuitAdd-Text">
        Su tuit ha sido añadido con exitos!!!
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">OK!</button>
      </div>
    </div>
  </div>
</div>
</body>
</html>