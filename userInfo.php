<?php
require_once "config.php";
session_start();

if (!isset($_SESSION['uid'])) {
    echo "0";
    die();
}

$userid = $_SESSION["uid"];
$mysqli = new mysqli($DB_HOST, $DB_USER, $DB_PASSWORD, $DB_NAME);
if ($mysqli->connect_error) {
    echo "{status: 0}"; // error connecting to mysql
    die();
}
$jsondata = array();
if ($stmt = $mysqli->prepare("
SELECT quizzes.quizid, COALESCE(correctnumber,0), COALESCE(T1.amount, 0)
FROM quizzes
  LEFT JOIN (SELECT quizid, COUNT(questionid) AS amount
             FROM questions
             GROUP BY quizid) as T1 ON quizzes.quizid=T1.quizid
  LEFT JOIN answers ON quizzes.quizid=answers.quizid AND userid=?")) {
    $stmt->bind_param("i", $userid);
    $result = $stmt->execute();
    $stmt->bind_result($quizzid, $correctAnswers, $amount);
    $stmt->store_result();
    $points=0;
    while ($stmt->fetch()){
        if($amount!=0){
            $points+=$correctAnswers/$amount*1000;
        }
    }
    $jsondata["level"] = floor($points/1000);
    $jsondata["points"]= $points;
}
if ($stmt = $mysqli->prepare("SELECT username, email FROM users WHERE userid=?")) {
    $stmt->bind_param("i", $userid);
    $result = $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($username, $email);

    $jsondata["status"] = 1;
    $stmt->fetch();
    $jsondata["username"] = $username;
    $jsondata["email"] = $email;

    echo json_encode($jsondata);
} else {
    echo "{status: 0}";
}