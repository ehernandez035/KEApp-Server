<?php
require_once "../config.php";
require_once "checkOnline.php";
require_once "../datuBase.php";
checkOnline();

if ($stmt = $mysqli->prepare("INSERT INTO quizzes() VALUES()")) {
    if ($stmt->execute()) {
        header('Location: adminquestions.php?quizid='.$stmt->insert_id);
        die();
    }
}
header('Location: admin.php');