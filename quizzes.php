<?php
/**
 * Created by PhpStorm.
 * User: elena
 * Date: 3/04/18
 * Time: 13:03
 */
require_once "config.php";
session_start();

if (!isset($_SESSION["uid"])) {
    die("Not logged in");
}

$userid=$_SESSION["uid"];
$mysqli = new mysqli($DB_HOST, $DB_USER, $DB_PASSWORD, $DB_NAME);
if ($mysqli->connect_error) {
    echo "{status: 0}"; // error connecting to mysql
    die();
}

if ($stmt = $mysqli->prepare("
SELECT quizzes.quizid, description, COALESCE(correctnumber,0), COALESCE(T1.amount, 0)
FROM quizzes
  LEFT JOIN (SELECT quizid, COUNT(questionid) AS amount
             FROM questions
             GROUP BY quizid) as T1 ON quizzes.quizid=T1.quizid
  LEFT JOIN answers ON quizzes.quizid=answers.quizid AND userid=?")) {
    $stmt->bind_param("i", $userid);
    $result = $stmt->execute();
    $stmt->bind_result($quizzid, $description, $correctAnswers, $amount);
    $stmt->store_result();
    $jsondata = array();

    $jsondata["status"] = 1;
    $jsondata["quizzes"] = array();
    while($stmt->fetch()){
        $jsondata["quizzes"][] = array("quizzid"=>$quizzid, "description"=>$description, "correctAnswers"=>$correctAnswers, "amount"=>$amount);
    }
    echo json_encode($jsondata);
}