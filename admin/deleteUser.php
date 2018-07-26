<?php
require_once "../config.php";
require_once "checkOnline.php";
require_once "../datuBase.php";
checkOnline();


$userid = $_GET["userid"];
if ($stmt = $mysqli->prepare("DELETE FROM users WHERE userid=?")) {
    $stmt->bind_param("i", $userid);
    if ($stmt->execute()) {
    }
}
header('Location: users.php');