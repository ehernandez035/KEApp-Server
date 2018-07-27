<?php
$to = "ehernandez2206@gmail.com";
$subject = "PHP Test mail";
$message = "
<html>
<head>
  <title>KEApp aplikazioko kontua</title>
</head>
<body>
  <p>KEApp mugikorreko aplikazioan kontua sortu dute email helbide honekin, kontua baieztatzeko ondorengo estekan klikatu.</p>
  <a href='http://elenah.duckdns.org/confirmEmail.php?token=&user='>Baieztatzeko esteka</a> 
</body>
</html>
";
$from = "keaaplikazioa@gmail.com";
$headers = "From:" . $from. "\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .="Content-type: text/html; charset=utf-8";
mail($to,$subject,$message,$headers);
echo "Mail Sent";
?>

