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
	<link rel="stylesheet" type="text/css" href="estilos.css">
	<link href="https://fonts.googleapis.com/css?family=Mukta+Vaani" rel="stylesheet">

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
	<h1>CHAT</h1>
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
				<input type="text" name="mensaje" id="menssage" placeholder="Ingresa tu mensaje" value=""/>
				<button onclick="ajaxSend()"> Enviar</button>
			</div>

</body>
</html>