<?php

require_once "../config.php";
require_once "checkOnline.php";
require_once "../datuBase.php";
checkOnline();








$questionid = $_GET["questionid"];
if ($stmt = $mysqli->prepare("DELETE FROM questions WHERE questionid=?")) {
    $stmt->bind_param("i", $questionid);
    if ($stmt->execute()) {
        die(0);
    }
    die(-1);
}
