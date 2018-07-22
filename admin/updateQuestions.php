<?php
require_once "../config.php";
require_once "checkOnline.php";
checkOnline();

$mysqli = new mysqli($DB_HOST, $DB_USER, $DB_PASSWORD, $DB_NAME);
if ($mysqli->connect_error) {
    echo 2;
    die();
}

$questionid=$_POST["questionid"];
$correct_ans=$_POST["correct_ans"];
$correct_ans_esp=$_POST["correct_ans_esp"];
$false1=$_POST["false1"];
$false2=$_POST["false2"];
$false3=$_POST["false3"];
$false1_esp=$_POST["false1_esp"];
$false2_esp=$_POST["false2_esp"];
$false3_esp=$_POST["false3_esp"];
$question=$_POST["question"];
$question_esp=$_POST["question_esp"];



    if($stmt = $mysqli->prepare("UPDATE questions SET correct_answer=?, correct_answer_esp=?, false_answer1=?, false_answer1_esp=?,false_answer2=?, false_answer2_esp=?, false_answer3=?, false_answer3_esp=?, question=?, question_esp=? WHERE questionid=?")){
        $stmt->bind_param("ssssssssssi", $correct_ans, $correct_ans_esp, $false1, $false1_esp, $false2, $false2_esp, $false3, $false3_esp, $question, $question_esp, $questionid );
        if($stmt->execute()){

            header('Location: admin.php');
        }

    }

