<?php

require_once "../config.php";
$email = $_POST["email"];
$message = $_POST["message"];


// título
$titulo = 'KEApp aplikazioa';

// mensaje
$mensaje = "
<html>
<head>
  <title>KEApp aplikazioko kontua</title>
</head>
<body>
  <p>$message</p>
</body>
</html>
";
$from = "keaaplikazioa@gmail.com";
$headers = "From:" . $from . "\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/html; charset=utf-8";
mail($email, $titulo, $mensaje, $headers);

header('Location: users.php');