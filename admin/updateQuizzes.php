<?php
require_once "../config.php";
require_once "checkOnline.php";
checkOnline();


$mysqli = new mysqli($DB_HOST, $DB_USER, $DB_PASSWORD, $DB_NAME);
if ($mysqli->connect_error) {
    echo 2;
    die();
}

$quid = $_POST["quid"];
$deskribapena = $_POST["deskribapena"];
$descripcion = $_POST["descripcion"];

if ($stmt = $mysqli->prepare("UPDATE quizzes SET description=?, description_esp=? WHERE quizid=?")) {
    $stmt->bind_param("ssi", $deskribapena, $descripcion, $quid);
    if ($stmt->execute()) {
        header('Location: adminquestions.php?quizid=' . $quid);
    }

}
