<?php
require_once "../config.php";
require_once "checkOnline.php";
require_once "../datuBase.php";
checkOnline();

$questionid = $_GET["questionid"];
if ($stmt = $mysqli->prepare("UPDATE questions SET position=position-1 WHERE position>(SELECT q1.position FROM (SELECT * FROM questions) AS q1 WHERE q1.questionid=?) AND quizid=(SELECT q2.quizid FROM (SELECT * FROM questions) AS q2 WHERE q2.questionid=?)")) {
    $stmt->bind_param("ii", $questionid, $questionid);
    if (!$stmt->execute()) {
        header('Location: admin.php');
    }

}else{
    header('Location: admin.php');
}
if ($stmt = $mysqli->prepare("DELETE FROM questions WHERE questionid=?")) {
    $stmt->bind_param("i", $questionid);
    if ($stmt->execute()) {
        die(0);
    }
}
http_response_code(500);
