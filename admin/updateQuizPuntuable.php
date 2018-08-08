<?php
require_once "../config.php";
require_once "checkOnline.php";
checkOnline();


$mysqli = new mysqli($DB_HOST, $DB_USER, $DB_PASSWORD, $DB_NAME);
if ($mysqli->connect_error) {
    echo 2;
    die();
}

$quid = $_GET["quizid"];
$puntuable = $_GET["puntuable"];

if ($stmt = $mysqli->prepare("UPDATE quizzes SET puntuable=? WHERE quizid=?")) {
    $stmt->bind_param("ii", $puntuable, $quid);
    if ($stmt->execute()) {
        die();
    }
    http_response_code(500);
    die();

}else{
    http_response_code(500);
    die();
}