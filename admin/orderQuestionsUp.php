<?php
require_once "../config.php";
require_once "checkOnline.php";
checkOnline();

$mysqli = new mysqli($DB_HOST, $DB_USER, $DB_PASSWORD, $DB_NAME);
if ($mysqli->connect_error) {
    echo 2;
    die();
}
$questionid=$_GET["questionid"];
$quizid=$_GET["quizid"];

$position=-1;
if ($stmt = $mysqli->prepare("SELECT position FROM questions WHERE questionid=?")) {
    $stmt->bind_param("i", $questionid);
    if ($stmt->execute()) {
        $stmt->store_result();
        $stmt->bind_result($position);
        $stmt->fetch();
    }
    else{
        http_response_code(500);
        die();
    }
} else {
    http_response_code(500);
    die();
}
if ($stmt = $mysqli->prepare("UPDATE questions SET position=? WHERE questionid=?")) {
    $position=$position-1;
    $stmt->bind_param("ii",  $position, $questionid);
    if ($stmt->execute()) {

    }else{
        http_response_code(500);
        die();
    }
} else {
    http_response_code(500);
    die();
}
if ($stmt = $mysqli->prepare("UPDATE questions SET position=? WHERE position=? AND questionid!=? AND quizid=?")) {
    $newPos = $position+1;
    $stmt->bind_param("iiii",  $newPos, $position, $questionid, $quizid);
    if ($stmt->execute()) {
        die();
    }else{
        http_response_code(500);
        die();
    }
} else {
    http_response_code(500);
    die();
}