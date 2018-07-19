<?php
require_once "datuBase.php";
session_start();
if (!isset($_SESSION["admin"])){
    header("Location: index.php");
    die();
}
$quizid=intval($_GET["quizid"]);
$quizzes=getQuizzes();
$questions=getQuestions(intval($quizid));
?>
<html>
<head>
    <link rel="stylesheet" href="main.css">
</head>
<body>
<h1 id="galdetegia"><?= "$quizid" ?></h1>

<h2 id="deskribapena"><?= $quizzes[$quizid]['description'] ?></h2>
<h2 id="descripcion"><?= $quizzes[$quizid]['description_esp'] ?></h2>

<table>
    <tr><th>ID</th><th>Galdera</th><th>Erantzun zuzena</th><th>Erantzun okerra</th><th>Erantzun okerra</th><th>Erantzun okerra</th>
        </th><th>Pregunta</th><th>Respuesta correcta</th><th>Respuesta incorrecta</th><th>Respuesta incorrecta</th><th>Respuesta incorrecta</th></tr>
    <?php
    foreach ($questions as $question){
        echo "<tr id='questionrow-$question[questionid]'>";
        echo "<td>$question[questionid]</td>";
        echo "<td>$question[question]</td>";
        echo "<td>$question[correct_ans]</td>";
        echo "<td>$question[false1]</td>";
        echo "<td>$question[false2]</td>";
        echo "<td>$question[false3]</td>";
        echo "<td>$question[question_esp]</td>";
        echo "<td>$question[correct_ans_esp]</td>";
        echo "<td>$question[false1_esp]</td>";
        echo "<td>$question[false2_esp]</td>";
        echo "<td>$question[false3_esp]</td>";
        echo "</tr>";
    }?>

</table>
<script language="JavaScript">
    let questions = document.querySelectorAll("[id^='questionrow-']");
    for(let question of questions){
        question.addEventListener("click", function () {
            var questionid= question.id.substring(11,questions.id.length);

        })
    }
</script>
</body>
</html>