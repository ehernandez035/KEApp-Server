<?php
require_once "../config.php";
require_once "checkOnline.php";
checkOnline();

$quid = $_GET["quizid"];

if ($stmt = $mysqli->prepare("DELETE FROM quizzes WHERE quizid=?")) {
    $stmt->bind_param("i", $quid);
    if ($stmt->execute()) {
        return 0;
    }
    return -1;
}