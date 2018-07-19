<?php
require_once "datuBase.php";
session_start();
if (!isset($_SESSION["admin"])){
    if(isset($_POST["password"])){
        if($_POST["password"]==$adminpass){
            $_SESSION["admin"]=true;
        }
    }
}
if (!isset($_SESSION["admin"])){
    header("Location: index.php");
    die();
}

$quizzes=getQuizzes();

?>
<html>
<head>
<link rel="stylesheet" href="main.css">
</head>
<body>
<table>
    <tr><th>ID</th><th>Deskribapena</th><th>Descripción</th></tr>
    <?php
    foreach ($quizzes as $quiz){
        echo "<tr id='quizrow-$quiz[id]'><td>$quiz[id]</td><td>$quiz[description]</td><td>$quiz[description_esp]</td></tr>";
    }?>
</table>

<script language="JavaScript">
    let quizzes = document.querySelectorAll("[id^='quizrow-']");
    for(let quiz of quizzes){
        quiz.addEventListener("click", function () {
            var quizid= quiz.id.substring(8,quiz.id.length);
            window.location.href="adminquestions.php?quizid="+quizid;
        })
    }
</script>
</body>
</html>
