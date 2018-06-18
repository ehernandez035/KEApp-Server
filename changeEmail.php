<?php
/**
 * Created by PhpStorm.
 * User: elena
 * Date: 21/05/18
 * Time: 16:56
 */
require_once "config.php";
session_start();
$email = $_POST["email"];
if (!isset($_SESSION["uid"])) {
    die("Not logged in");
}

$userid=$_SESSION["uid"];
$mysqli = new mysqli($DB_HOST, $DB_USER, $DB_PASSWORD, $DB_NAME);
if ($mysqli->connect_error) {
    echo 2;
    die();
}
if ($stmt = $mysqli->prepare("UPDATE users SET email = ? WHERE userid=?")) {
    $stmt->bind_param("si", $email, $userid);
    if($stmt->execute()){
        echo 0;
        die();
    }
}
echo 1;