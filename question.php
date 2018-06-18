<?php
/**
 * Created by PhpStorm.
 * User: elena
 * Date: 3/04/18
 * Time: 13:30
 */

require_once "config.php";
$quizzid = $_GET["quizzid"];

$mysqli = new mysqli($DB_HOST, $DB_USER, $DB_PASSWORD, $DB_NAME);
if ($mysqli->connect_error) {
    echo "{status: 0}"; // error connecting to mysql
    die();
}

if ($stmt = $mysqli->prepare("SELECT questionid, question, correct_answer, false_answer1, false_answer2, false_answer3 FROM questions WHERE quizid = ?")) {
    $stmt->bind_param("i", $quizzid);
    $result = $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($qid, $question, $correct_answer, $false_answer1, $false_answer2, $false_answer3);
    $jsondata = array();
    $jsondata["status"] = 1;
    $jsondata["questions"] = array();
    while($stmt->fetch()){
        $jsondata["questions"][] = array("qid"=>$qid, "question"=>$question, "correctAns"=>$correct_answer,
            "incorrectAns1"=>$false_answer1, "incorrectAns2"=>$false_answer2, "incorrectAns3"=>$false_answer3);
    }
    echo json_encode($jsondata);
}