<?php
/**
 * Created by PhpStorm.
 * User: elena
 * Date: 21/05/18
 * Time: 16:56
 */
require_once "config.php";
session_start();
$password = $_POST["password"];
if (!isset($_SESSION["uid"])) {
    die("Not logged in");
}

$userid=$_SESSION["uid"];
$mysqli = new mysqli($DB_HOST, $DB_USER, $DB_PASSWORD, $DB_NAME);
if ($mysqli->connect_error) {
    echo 2;
    die();
}
if ($stmt = $mysqli->prepare("SELECT password FROM users WHERE userid=?")) {
    $stmt->bind_param("i", $userid);
    if($stmt->execute()){
        $stmt->bind_result($encrypted_pass);
        $stmt->fetch();
        if(password_verify($password, $encrypted_pass)) {
            echo 0;
            die();
        }
    }
}
echo 1;