<?php

require_once "../config.php";
require_once "checkOnline.php";
checkOnline();

$mysqli = new mysqli($DB_HOST, $DB_USER, $DB_PASSWORD, $DB_NAME);
if ($mysqli->connect_error) {
    echo 2;
    die();
}
$quizid=$_GET["quizid"];

$position=-1;
if ($stmt = $mysqli->prepare("SELECT position FROM quizzes WHERE quizid=?")) {
    $stmt->bind_param("i", $quizid);
    if ($stmt->execute()) {
        $stmt->store_result();
        $stmt->bind_result($position);
        $stmt->fetch();
    }
    else{
        die();
    }
} else {
    die();
}
if ($stmt = $mysqli->prepare("UPDATE quizzes SET position=? WHERE quizid=?")) {
    $position=$position+1;
    $stmt->bind_param("ii",  $position, $quizid);
    if ($stmt->execute()) {

    }else{
        http_response_code(500);
        die();
    }
} else {
    http_response_code(500);
    die();
}
if ($stmt = $mysqli->prepare("UPDATE quizzes SET position=? WHERE position=? AND quizid<>?")) {
    $newPos = $position-1;
    $stmt->bind_param("iii",  $newPos, $position, $quizid);
    if ($stmt->execute()) {
        header('Location: admin.php');
    }else{
        die();
    }
} else {
    die();
}