<?php
/**
 * Created by PhpStorm.
 * User: elena
 * Date: 27/03/18
 * Time: 10:23
 */
require_once "config.php";
$user = $_POST["username"];
$email = $_POST["email"];
$pass = $_POST["password"];

if (!preg_match("/[A-Z0-9a-z._%+\\-]+@[A-Za-z0-9.\\-]+\\.[A-Za-z]{2,64}/", $email)) {
    echo "1";
    die();
}

if (!preg_match("/[A-Z0-9a-z._%+\-]{6,}/", $pass)) {
    echo "2";
    die();
}


$mysqli = new mysqli($DB_HOST, $DB_USER, $DB_PASSWORD, $DB_NAME);

if ($mysqli->connect_error) {
    echo "3"; // error connecting to mysql
    die();
}

$temp = uniqid();

$stmt = $mysqli->prepare("(SELECT username, email FROM users WHERE username=? OR email=?) UNION (SELECT username, email FROM temp_users WHERE username=? OR email=?)");
$stmt->bind_param("ssss", $user, $email, $user, $email);
$result = $stmt->execute();
$stmt->store_result();
if ($stmt->num_rows != 0) {
    echo "5"; //email or username taken
    die();
}

/* crear una sentencia preparada */
if ($stmt = $mysqli->prepare("INSERT INTO temp_users(username, email, password, temp) VALUES (?, ?, ?, ?)")) {

    $pass = password_hash($pass, PASSWORD_BCRYPT);
    /* ligar parámetros para marcadores */
    $stmt->bind_param("ssss", $user, $email, $pass, $temp);

    /* ejecutar la consulta */
    if ($stmt->execute()) {
        // título
        $titulo = 'KEApp kontua baieztatu';

// mensaje
        $mensaje = "
<html>
<head>
  <title>KEApp aplikazioko kontua</title>
</head>
<body>
  <p>KEApp mugikorreko aplikazioan kontua sortu dute email helbide honekin, kontua baieztatzeko ondorengo estekan klikatu.</p>
  <a href='http://elenah.duckdns.org/confirmEmail.php?token=$temp&user=$user'>Baieztatzeko esteka</a> 
</body>
</html>
";
        $from = "keaaplikazioa@gmail.com";
        $headers = "From:" . $from. "\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .="Content-type: text/html; charset=utf-8";
        mail($email, $titulo, $mensaje, $headers);
        echo "0";
        die();
    }
}
echo "6";