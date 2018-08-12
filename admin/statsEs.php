<?php
require_once "../datuBase.php";
require_once "checkOnline.php";
require_once "footer.php";
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

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="menuEs.php"><img src="logo.png" style="width: 30px; height: 30px;"
                                                 class="d-inline-block align-top mr-2">KEApp</a>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
            <a class="nav-item nav-link" href="statsEs.php">Resultados</a>
        </div>
    </div>
    <div>

        <select class="custom-select custom-select-sm ml-3" style="width: 18em" id="language" onchange="location = this.value;">
            <option selected>Hizkuntza</option>
            <option value="stats.php" >Euskara </option>
            <option value="statsEs.php">Castellano</option>
        </select>
        <a href=https://drive.google.com/open?id=109FE96oEbE8nYcc8Tl9lYN2k3TWKofbX class="d-inline-block align-top mr-2"><i class="material-icons">
                help_outline
            </i></a>

    </div>
</nav>

<div class="container mt-3">

    <h1>KEApp administración</h1>

    <div class="container text-center mt-3 mb-3">
        <div class="dropdown">
            <button class="btn btn-default dropdown-toggle" type="button" id="menu1" data-toggle="dropdown">Resultados por grupos
                <span class="caret"></span></button>
            <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
                <li role="presentation"><a role="menuitem" tabindex="-1" href="statsEs.php?usergroup=g">Resultados castellano</a></li>
                <li role="presentation"><a role="menuitem" tabindex="-1" href="statsEs.php?usergroup=e">Resultados euskara</a></li>
                <li role="presentation" class="divider"></li>
                <li role="presentation"><a role="menuitem" tabindex="-1" href="statsEs.php">Todos</a></li>
            </ul>
        </div>
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
        echo "<h5 class=\"card-header\" style=' background-color: #$color'>$quiz[id] cuestionario</h5>";
        echo "<div class='card-body'>";
        echo "% " . number_format($percentage,2);
        echo "</div>";
        echo "</div>";

    }
    ?>
</div>

<?php printFooterEs()?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

</body>
</html>