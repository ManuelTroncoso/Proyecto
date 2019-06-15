<?php
$to = "manuelsnok@gmail.com";
$subject = "Asunto del email";
$message = "Este es mi primer envío de email con PHP";
$headers = "From: pruebaphp";
 
mail($to, $subject, $message, $headers);
echo "correo enviado";
?>