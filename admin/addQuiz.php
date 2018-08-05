<?php
require_once "../config.php";
require_once "checkOnline.php";
require_once "../datuBase.php";
checkOnline();

if ($stmt = $mysqli->prepare("INSERT INTO quizzes(position) VALUES((SELECT COALESCE(MAX(q1.position),0)+1 FROM quizzes AS q1))")) {
    if ($stmt->execute()) {
        header('Location: adminquestions.php?quizid='.$stmt->insert_id);
        die();
    }
}
header('Location: admin.php');