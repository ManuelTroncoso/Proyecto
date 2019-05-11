<?php
session_start();
$user =  $_SESSION['name'];
$sala = $_SESSION['sala'];
echo $user;
// $user = $_SESSION['userClick'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="selectProfile.js"></script>
    <script src="profile.js"></script>
    <title>Profile</title>
</head>
<body>
    <input type="text" id="id-tuit">
    <button onclick="AddTuit('<?php echo $user; ?>')"> Añadir un tuit </button>
</body>
</html>