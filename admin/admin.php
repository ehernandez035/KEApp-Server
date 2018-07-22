<?php
require_once "../datuBase.php";
require_once "checkOnline.php";
checkOnline(true);

$quizzes = getQuizzes();

?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="main.css">
</head>
<body>
<div class="container">

    <h1 style="margin-bottom: 32px">KEApp kudeaketa</h1>
    <table class="table">
        <tr>
            <th>ID</th>
            <th>Deskribapena</th>
            <th>Descripción</th>
        </tr>
        <?php
        foreach ($quizzes as $quiz) {
            echo "<tr id='quizrow-$quiz[id]'>";
            echo "<td>$quiz[id]</td>";
            echo "<td>$quiz[description]</td>";
            echo "<td>$quiz[description_es]</td>";
            echo "</tr>";
        } ?>
    </table>
</div>

<script language="JavaScript">
    let quizzes = document.querySelectorAll("[id^='quizrow-']");
    for (let quiz of quizzes) {
        quiz.addEventListener("click", function () {
            var quizid = quiz.id.substring(8, quiz.id.length);
            window.location.href = "adminquestions.php?quizid=" + quizid;
        })
    }
</script>
<script language="JavaScript" src="js/bootstrap.js"></script>
</body>
</html>
