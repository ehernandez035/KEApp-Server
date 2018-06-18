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

if(!preg_match("/[A-Z0-9a-z._%+\\-]+@[A-Za-z0-9.\\-]+\\.[A-Za-z]{2,64}/", $email)){
    echo "1";
    die();
}

if(!preg_match("/[A-Z0-9a-z._%+\-]{6,}/", $pass)){
    echo "2";
    die();
}




$mysqli = new mysqli($DB_HOST, $DB_USER, $DB_PASSWORD, $DB_NAME);

if ($mysqli->connect_error) {
    echo "3"; // error connecting to mysql
    die();
}

/* crear una sentencia preparada */
if ($stmt = $mysqli->prepare("INSERT INTO users(username, email, password) VALUES (?, ?, ?)")) {

    $pass = password_hash($pass, PASSWORD_BCRYPT);
    /* ligar parámetros para marcadores */
    $stmt->bind_param("sss", $user, $email, $pass);

    /* ejecutar la consulta */
    if($stmt->execute()){
        echo "0";
        die();
    } else {

        $stmt = $mysqli->prepare("SELECT username FROM users WHERE username=?");
        $stmt->bind_param("s", $user);
        $result = $stmt->execute();
        $stmt->store_result();
        if($stmt->num_rows == 0){
            echo "5"; //email taken
        }else{
            echo "4"; //username taken
        }
        die();
    }
}
echo "6";