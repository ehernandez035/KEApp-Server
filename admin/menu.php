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

    <link rel="shortcut icon" type="image/png" href="favicon.png">
    <link rel="stylesheet" href="main.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body style="margin-bottom: 100px">
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="menu.php">KEApp</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
</nav>

<div class="container mt-3">

    <h1>KEApp kudeaketa</h1>


    <div class="card text-center mb-3" style="margin: auto; width: 75%">
        <h5 class="card-header">Galdetegiak</h5>
        <div class="card-body">
            <i class="material-icons" style="font-size: 5em">
                assignment
            </i>
        <p class="card-text">Galdetegiak eta hauetan dauden galderen edukia antolatzeko gunea.</p>
        <a class='btn btn-primary' href="admin.php">Galdetegiak</a>
        </div>
    </div>
    <div class="card text-center mb-3" style="margin: auto; width: 75%">
        <h5 class="card-header">Erabiltzaileak</h5>
        <div class="card-body">
            <i class="material-icons" style="font-size: 5em">
                account_circle
            </i>
        <p class="card-text">Erabiltzaileen kontuak antolatzeko gunea.</p>
        <a class='btn btn-primary' href="users.php">Erabiltzaileak</a>
        </div>
    </div>

</div>

<footer class="page-footer font-small bg-primary text-light fixed-bottom">
    <div style="display: flex; vertical-align: middle; justify-content: center">
        <i class="material-icons" >email</i>:<a class="ml-2" href="mailto:keaaplikazioa@gmail.com" style="color: white">keaaplikazioa@gmail.com</a>
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
