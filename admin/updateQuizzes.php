<?php
require_once "../config.php";
require_once "checkOnline.php";
checkOnline();


$mysqli = new mysqli($DB_HOST, $DB_USER, $DB_PASSWORD, $DB_NAME);
if ($mysqli->connect_error) {
    echo 2;
    die();
}

$quid = $_POST["quizid"];
$deskribapena = $_POST["deskribapena"];
$descripcion = $_POST["descripcion"];
$puntuable = $_POST["puntuable"];

if ($stmt = $mysqli->prepare("UPDATE quizzes SET description=?, description_esp=?, puntuable=? WHERE quizid=?")) {
    $stmt->bind_param("ssii", $deskribapena, $descripcion, $puntuable, $quid);
    if ($stmt->execute()) {
        header('Location: adminquestions.php?quizid=' . $quid);
    }

}
