<?php

require_once "../config.php";
require_once "checkOnline.php";
require_once "../datuBase.php";
checkOnline();

$quid = $_GET["quizid"];
if ($stmt = $mysqli->prepare("INSERT INTO questions(quizid, position) VALUES(?, (SELECT COALESCE(MAX(q1.position), 0)+1 FROM questions AS q1 WHERE q1.quizid=?))")) {
    $stmt->bind_param("ii", $quid, $quid);
    if ($stmt->execute()) {
        echo($stmt->insert_id);
        die();
    }
}

echo $mysqli->error;
//http_response_code(500);
