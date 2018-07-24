<?php
require_once "../config.php";
require_once "checkOnline.php";
require_once "../datuBase.php";
checkOnline();

$quid = $_GET["quizid"];

if ($stmt = $mysqli->prepare("DELETE FROM quizzes WHERE quizid=?")) {
    $stmt->bind_param("i", $quid);
    if ($stmt->execute()) {
        header('Location: admin.php');
    }

    header('Location: admin.php');
}