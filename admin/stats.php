<?php
require_once "../datuBase.php";
require_once "checkOnline.php";
checkOnline(true);

$answers = getAnswers();
$quizzes = getQuizzes();
$class=$_GET["usergroup"];

?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="css/bootstrap.css">

    <link rel="shortcut icon" type="image/png" href="favicon.png">
    <link rel="stylesheet" href="main.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body style="margin-bottom: 100px">
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="menu.php"><img src="logo.png" style="width: 30px; height: 30px;"
                                                 class="d-inline-block align-top mr-2">KEApp</a>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
            <a class="nav-item nav-link" href="stats.php">Emaitzak</a>
        </div>
    </div>
</nav>

<div class="container mt-3">

    <h1>KEApp kudeaketa</h1>

    <div class="text-center mt-3 mb-3">
        <a class='btn btn-secondary' id="gaztUsers" href='stats.php?usergroup=g' >Gaztelerako emaitzak</a>
        <a class='btn btn-secondary' id="euskUsers" href='stats.php?usergroup=e' >Euskarako emaitzak</a>

    </div>
    <?php
    foreach ($quizzes as $quiz) {
        if(isset($class)){
            $totalPoints=getGroupPoints($quiz['id'], $class);
            $answersPerQuiz = answersPerQuizGroup($quiz['id'], $class);
        }else{
            $totalPoints = quizPoints($quiz['id']);
            $answersPerQuiz = answersPerQuiz($quiz['id']);
        }
        $questionNumber=questionsPerQuiz($quiz['id']);
        $percentage = $answersPerQuiz == 0 ? 0 : round($totalPoints / ($answersPerQuiz * $questionNumber) * 100, 2);
        $lerp=$percentage/100;
        $redC = 0xFF0000;         // Only Red
        $greenC = 0x009900 + ((0x00FF00 - 0x009900) * $lerp) & 0x00FF00; // Only Green
        $blueC = 0x000099 + ((0x000066 - 0x000099) * $lerp) & 0x0000FF;     // Only Blue
        $result = dechex($redC | $greenC | $blueC);
        $color = str_pad($result, 6, "0", STR_PAD_LEFT);
        echo "<div class=\"card text-center mb-3\" style=\"margin: auto; width: 75%\" >";
        echo "<h5 class=\"card-header\" style=' background-color: #$color'>$quiz[id] galdetegia</h5>";
        echo "<div class='card-body'>";
        echo "% " . number_format($percentage,2);
        echo "</div>";
        echo "</div>";

    }
    ?>
</div>
<footer class="page-footer font-small bg-primary text-light fixed-bottom">
    <div style="display: flex; vertical-align: middle; justify-content: center">
        <i class="material-icons">email</i>:<a class="ml-2" href="mailto:keaaplikazioa@gmail.com" style="color: white">keaaplikazioa@gmail.com</a>
    </div>
    <!-- Copyright -->
    <div class="footer-copyright text-center py-3">© 2018 Copyright:
        <a href="https://github.com/ehernandez035/" class="text-light"> GPL-3.0 lizentziapean</a>
    </div>
    <!-- Copyright -->
</footer>

<script language="JavaScript" src="js/jquery-3.3.1.min.js"></script>
<script language="JavaScript" src="js/bootstrap.js"></script>

</body>
</html>