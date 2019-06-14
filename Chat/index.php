<?php
session_start();
$user =  $_SESSION['name'];
$sala = $_SESSION['sala'];
include "db.php";
?>
<!DOCTYPE html>
<html>
<head>
	<title>CHAT CON PHP, MYSQL Y AJAX</title>
	<link rel="stylesheet" href="../css/global.css">
	<link rel="stylesheet" type="text/css" href="estilos.css">
	<!-- <link href="https://fonts.googleapis.com/css?family=Mukta+Vaani" rel="stylesheet"> -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
	<script type="text/javascript">
	window.onload = function() {
 	ajax();
		};
		function ajax(){
			var req = new XMLHttpRequest();

			req.onreadystatechange = function(){
				if (req.readyState == 4 && req.status == 200) {
					document.getElementById('chat').innerHTML = req.responseText;
				}
			}

			req.open("POST", "chat.php", true);
			req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			req.send("sala=" + '<?php echo $sala?>');
		}
		function ajaxSend(){
			var req = new XMLHttpRequest();

			req.onreadystatechange = function(){
				if (req.readyState == 4 && req.status == 200) {
					document.getElementById('chat').innerHTML = req.responseText;
				}
			}
			req.open("POST", "index.php", true);

			req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			req.send("enviar=Yes&mensaje="+document.getElementById('menssage').value+"&idTeacher="+'<?php echo $sala?>');
			document.getElementById('menssage').value = "";

		}
		//linea que hace que se refreseque la pagina cada segundo
		setInterval(function(){ajax();}, 1000);
	</script>
</head>
<!-- <body onload="ajax();"> -->
<body>
	<div class="row bar-title">
		<div class="col-sm-1"></div>
		<div class="col-sm-2"><a href="../teacher/menu.php"><img src="../css/icon/anterior.png" width="32px" alt=""></a></div>
		<div class="col-sm-6"><h3 class="text-center title">CHAT <?php echo $sala; ?></h3></div>
		<div class="col-sm-3"></div>
	</div>
	
	<div id="contenedor">
		<div id="caja-chat">
			<div id="chat"></div>
		</div>
		<?php
			if (isset($_POST['enviar'])) {
				$nombre = $user;
				$mensaje = $_POST['mensaje'];
				//$idTeacher = $_POST['idTeacher'];
				$consulta = "INSERT INTO chat (nombre, mensaje, sala) VALUES ('$nombre', '$mensaje', '$sala')";
				$ejecutar = $conexion->query($consulta);
				if ($ejecutar){
					echo "<embed loop='false' src='beep.mp3' hidden='true' autoplay='true'>";		
				}
			}
		?>
	</div>
	<div id="caja-send">
				<p id="nombre" ><?php echo $user ?></p>
				<div class="row">
				<div class="col-sm-9">
						<input type="text" name="mensaje" id="menssage" placeholder="Ingresa tu mensaje" value=""/>
					</div>
					<div class="col-sm-3">
						<button onclick="ajaxSend()"> Enviar</button>
					</div>
				</div>			
			</div>

</body>
</html>