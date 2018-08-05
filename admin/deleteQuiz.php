<?php
require_once "../config.php";
require_once "checkOnline.php";
require_once "../datuBase.php";
checkOnline();

$quid = $_GET["quizid"];
if ($stmt = $mysqli->prepare("UPDATE quizzes SET position=position-1 WHERE position>(SELECT q1.position FROM (SELECT * FROM quizzes) AS q1 WHERE q1.quizid=?)")) {
    $stmt->bind_param("i", $quid);
    if (!$stmt->execute()) {
    header('Location: admin.php');
    }

}else{
    header('Location: admin.php');
}
if ($stmt = $mysqli->prepare("DELETE FROM quizzes WHERE quizid=?")) {
    $stmt->bind_param("i", $quid);
    $stmt->execute();
} header('Location: admin.php');