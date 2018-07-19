<?php
require_once "config.php";
$mysqli = new mysqli($DB_HOST, $DB_USER, $DB_PASSWORD, $DB_NAME);
if ($mysqli->connect_error) {
    echo 2;
    die();
}
function getQuizzes(){
    global $mysqli;
    if ($stmt = $mysqli->prepare("SELECT * FROM quizzes")) {

        if($stmt->execute()){
            $stmt->bind_result($id, $description, $description_es);
            $quizzes=array();
            while($stmt->fetch()){
                $quizzes[]=array("id"=>$id, "description"=>$description, "description_es"=>$description_es);
            }
            return $quizzes;
        }
    }return null;
}

function getQuestions($qid){
    global $mysqli;
    if ($stmt = $mysqli->prepare("SELECT * FROM questions WHERE quizid=?")) {
        $stmt->bind_param("i", $qid);
        if($stmt->execute()){
            $stmt->store_result();
            $stmt->bind_result($quizid, $questionid, $correct_ans, $correct_ans_esp, $false1, $false1_esp, $false2, $false2_esp, $false3, $false3_esp, $question, $question_esp);
            $questions=array();
            while($stmt->fetch()){
                $questions[]=array("questionid"=>$questionid, "correct_ans"=>$correct_ans, "correct_ans_esp"=>$correct_ans_esp, "false1"=> $false1, "false1_esp"=>$false1_esp, "false2"=> $false2, "false2_esp"=>$false2_esp, "false3"=> $false3, "false3_esp"=>$false3_esp, "question"=>$question, "question_esp"=>$question_esp);
            }
            return $questions;
        }
    }return null;
}
