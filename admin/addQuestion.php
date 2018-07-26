<?php

require_once "../config.php";
require_once "checkOnline.php";
require_once "../datuBase.php";
checkOnline();

$quid = $_GET["quizid"];
if ($stmt = $mysqli->prepare("INSERT INTO questions(quizid) VALUES(?)")) {
    $stmt->bind_param("i", $quid);
    if ($stmt->execute()) {
        echo($stmt->insert_id);
        die();
    }
}
http_response_code(500);
