<?php
require_once "../datuBase.php";
require_once "checkOnline.php";
require_once "footer.php";
checkOnline(true);

$quizzes = getQuizzes();

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
<nav class="navbar navbar-expand-lg navbar-light bg-light" style="display: flex; justify-content: space-between">
    <a class="navbar-brand" href="menuEs.php"><img src="logo.png" style="width: 30px; height: 30px;" class="d-inline-block align-top mr-2">KEApp</a>
    <div>

        <select class="custom-select custom-select-sm ml-3" style="width: 18em" id="language" onchange="location = this.value;">
            <option selected>Hizkuntza</option>
            <option value="menu.php" >Euskara </option>
            <option value="menuEs.php">Castellano</option>
        </select>
        <a href=https://drive.google.com/open?id=109FE96oEbE8nYcc8Tl9lYN2k3TWKofbX class="d-inline-block align-top mr-2"><i class="material-icons">
                help_outline
            </i></a>

    </div>
</nav>

<div class="container mt-3">

    <h1>KEApp administración</h1>


    <div class="card text-center mb-3" style="margin: auto; width: 75%">
        <h5 class="card-header">Cuestionarios</h5>
        <div class="card-body">
            <i class="material-icons" style="font-size: 5em">
                assignment
            </i>
            <p class="card-text">Espacio para administrar los cuestionarios y sus preguntas.</p>
            <a class='btn btn-primary' href="adminEs.php">Cuestionarios</a>
        </div>
    </div>
    <div class="card text-center mb-3" style="margin: auto; width: 75%">
        <h5 class="card-header">Usuarios</h5>
        <div class="card-body">
            <i class="material-icons" style="font-size: 5em">
                account_circle
            </i>
            <p class="card-text">Espacio para administrar a los usuarios.</p>
            <a class='btn btn-primary' href="usersEs.php">Usuarios</a>
        </div>
    </div>
    <div class="card text-center mb-3" style="margin: auto; width: 75%">
        <h5 class="card-header">Resultados</h5>
        <div class="card-body">
            <i class="material-icons" style="font-size: 5em">
                assessment
            </i>
            <p class="card-text">Porcentaje de acierto por cada cuestionario.</p>
            <a class='btn btn-primary' href="statsEs.php">Resultados</a>
        </div>
    </div>

</div>

<?php printFooterEs()?>
<script language="JavaScript" src="js/jquery-3.3.1.min.js"></script>
<script language="JavaScript" src="js/bootstrap.js"></script>

</body>
</html>
