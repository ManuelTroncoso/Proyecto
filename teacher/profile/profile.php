<?php
session_start();
$user =  $_SESSION['name'];
$sala = $_SESSION['sala'];
$userProfile =  $_GET['userProfile'];

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script>
        var userProfile = '<?php echo $user ?>'
    </script>
    <script src="selectProfile<?php echo $userProfile ?>.js"></script>
    <script src="profile.js"></script>
    <title>Profile</title>
</head>
<body>

    <p id="nameUser"><?php echo $user ?></p>
    <div id="add-Tuit">
    <input type="text" id="id-tuit">
    <button onclick="AddTuit('<?php echo $user; ?>')"> Añadir un tuit </button>
    </div>
    <div id="list-tuit"></div>
</body>
</html>