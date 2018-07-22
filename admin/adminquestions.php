<?php
require_once "../datuBase.php";
require_once "checkOnline.php";
checkOnline();

$quizid = intval($_GET["quizid"]);
$quizzes = getQuizzes();
$questions = getQuestions($quizid);


?>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="main.css">
</head>
<body>
<h1>KEApp kudeaketa</h1>
<div class="container">
    <div class="card">
        <div class="card-header">
            <h2>Galdetegia</h2>
        </div>
        <div class="card-body">
            <form id="galdetegi_form" action="updateQuizzes.php" method="post">
                <div class="form-group">
                    <label for="identifikatzailea">Identifikatzailea:</label>
                    <input name='identifikatzailea' id="identifikatzailea" class="form-control" value='<?php echo $quizid ?>' readonly>
                </div>
                <div class="form-group">
                    <label for="deskribapena">Deskribapena:</label>
                    <input name='deskribapena' id="deskribapena" class="form-control" value='<?php echo $quizzes[$quizid - 1]['description'] ?>'>
                </div>
                <div class="form-group">
                    <label for="descripcion">Descripción:</label>
                    <input name='descripcion' id="descripcion" class="form-control" value='<?php echo $quizzes[$quizid - 1]['description_es'] ?>'>
                </div>
                <input class="btn" type="submit" value="Gorde!">
            </form>
        </div>
    </div>
</div>

<div class="container">
    <table class="table">
        <tr>
            <th>ID</th>
            <th>Galdera</th>
            <th>Erantzun zuzena</th>
            <th>Erantzun okerra</th>
            <th>Erantzun okerra</th>
            <th>Erantzun okerra</th>
            </th>
            <th>Pregunta</th>
            <th>Respuesta correcta</th>
            <th>Respuesta incorrecta</th>
            <th>Respuesta incorrecta</th>
            <th>Respuesta incorrecta</th>
        </tr>
        <form id="galdera_form" action="updateQuestions.php" method="post">
            <?php
            foreach ($questions as $question) {
                echo "<tr id='questionrow-$question[questionid]'>";
                echo "<td>$question[questionid]</td>";
                echo "<td><input name='question' value='$question[question]'></td>";
                echo "<td><input name='correct_ans' value='$question[correct_ans]'></td>";
                echo "<td><input name='false1' value='$question[false1]'></td>";
                echo "<td><input name='false2' value='$question[false2]'></td>";
                echo "<td><input name='false3' value='$question[false3]'></td>";
                echo "<td><input name='question_esp' value='$question[question_esp]'></td>";
                echo "<td><input name='false1_esp' value='$question[correct_ans_esp]'></td>";
                echo "<td><input name='false2_esp' value='$question[false1_esp]'></td>";
                echo "<td><input name='false3_esp' value='$question[false2_esp]'></td>";
                echo "<td><input name='false3_esp' value='$question[false3_esp]'></td>";
                echo "<a href='deleteQuestion.php?questionid=$question[questionid]' id='remove-$question[questionid]' class='btn btn-danger'>Delete</a>";
                echo "</tr>";
            } ?>
            <p>
                <input type="submit" name="galderak_button" value="Gorde!">
            </p>
        </form>


    </table>
</div>

<script>
    let removeButtons = document.querySelectorAll("[id^='remove-']");
    for (let button of removeButtons) {
        button.addEventListener("click", function () {
            var questionid = button.id.substring(7, button.id.length);


        })
    }
</script>

<script language="JavaScript" src="js/bootstrap.js"></script>

</body>
</html>