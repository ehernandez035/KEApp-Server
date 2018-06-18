<?php
/**
 * Created by PhpStorm.
 * User: elena
 * Date: 28/05/18
 * Time: 15:13
 */
require_once "config.php";
session_start();
if (!isset($_SESSION["uid"])) {
    die("Not logged in");
}
$userid=$_SESSION["uid"];
$mysqli = new mysqli($DB_HOST, $DB_USER, $DB_PASSWORD, $DB_NAME);
if ($mysqli->connect_error) {
    echo 2;
    die();
}
if ($stmt = $mysqli->prepare("DELETE FROM users WHERE userid=?")) {
    $stmt->bind_param("i", $userid);
    if($stmt->execute()){
        echo 0;
        die();
    }
}
echo 1;