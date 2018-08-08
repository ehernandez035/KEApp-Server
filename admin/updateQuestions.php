<?php

require_once "../config.php";
require_once "checkOnline.php";
checkOnline();

$mysqli = new mysqli($DB_HOST, $DB_USER, $DB_PASSWORD, $DB_NAME);
if ($mysqli->connect_error) {
    echo 2;
    die();
}

$questionid = $_POST["questionid"];
$correct_ans = $_POST["erantzunZuzena"];
$correct_ans_esp = $_POST["erantzunZuzenaEs"];
$false1 = $_POST["erantzunOkerra1"];
$false2 = $_POST["erantzunOkerra2"];
$false3 = $_POST["erantzunOkerra3"];
$false1_esp = $_POST["erantzunOkerra1Es"];
$false2_esp = $_POST["erantzunOkerra2Es"];
$false3_esp = $_POST["erantzunOkerra3Es"];
$question = $_POST["enuntziatua"];
$question_esp = $_POST["enuntziatuaEs"];
$note = $_POST["note"];
$noteEs = $_POST["noteEs"];
$img = $_FILES['img'];
if (strlen($_FILES['img']['name']) > 0) {
    $image_link=$_FILES['img']['name'];
    $split_image = pathinfo($image_link);
    if (strcmp($split_image['extension'], "png") == 0) {
        $content = file_get_contents($_FILES['img']['tmp_name']);
        file_put_contents('../qimages/' . $questionid . '.png', $content);
    } else {
        http_response_code(400);
        die();
    }
}
if ($stmt = $mysqli->prepare("UPDATE questions SET correct_answer=?, correct_answer_esp=?, false_answer1=?, false_answer1_esp=?,false_answer2=?, false_answer2_esp=?, false_answer3=?, false_answer3_esp=?, question=?, question_esp=?, note=?, noteEs=? WHERE questionid=?")) {
    $stmt->bind_param("ssssssssssssi", $correct_ans, $correct_ans_esp, $false1, $false1_esp, $false2, $false2_esp, $false3, $false3_esp, $question, $question_esp, $note, $noteEs, $questionid);
    if ($stmt->execute()) {
        die();
    }

}
http_response_code(500);

