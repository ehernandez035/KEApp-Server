<?php
/**
 * Created by PhpStorm.
 * User: elena
 * Date: 30/03/18
 * Time: 12:08
 */

require_once "config.php";
session_start();

if (isset($_SESSION['uid'])) {
    echo "0";
    die();
}

if (!isset($_POST['username']) || !isset($_POST['password'])) {
    echo "3";
    die();
}

$user = $_POST["username"];
$pass = $_POST["password"];

$mysqli = new mysqli($DB_HOST, $DB_USER, $DB_PASSWORD, $DB_NAME);

if ($mysqli->connect_error) {
    echo "2"; // error connecting to mysql
    die();
}

/* crear una sentencia preparada */
if ($stmt = $mysqli->prepare("SELECT password, userid FROM users WHERE username=?")) {
    $stmt->bind_param("s", $user);
    $result = $stmt->execute();
    $stmt->store_result();
    if($stmt->num_rows != 0){
        $stmt->bind_result($pass_encrypt, $uid);
        $stmt->fetch();
        if(password_verify($pass, $pass_encrypt)){
            $_SESSION["uid"] = $uid;
            echo "0";
            die();
        } else {
            echo "4";
            die();
        }
    } else {
        echo "4";
        die();
    }
}

echo "1";