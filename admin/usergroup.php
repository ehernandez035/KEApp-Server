<?php
require_once "../config.php";
require_once "checkOnline.php";
require_once "../datuBase.php";
checkOnline();


$userid = $_GET["userid"];
$usergroup = $_GET["usergroup"];

if ($stmt = $mysqli->prepare("UPDATE users SET usergroup=? WHERE userid=?")) {
    $stmt->bind_param("si", $usergroup, $userid);
    if ($stmt->execute()) {
        die();
    }else{
        http_response_code(500);
        echo $mysqli->error;
        die();
    }
}
