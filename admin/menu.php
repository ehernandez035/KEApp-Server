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
<body style="margin-bottom: 100px">
<div class="container mt-3">

    <h1>KEApp kudeaketa</h1>

    <div class="text-center">
        <a type="button" class='btn btn-primary' href="admin.php">Galdetegiak</a>
    </div>

    <div class="text-center mt-3">
        <a type="button" class='btn btn-primary' href="users.php">Erabiltzaileak</a>
    </div>
</div>
<footer class="page-footer font-small bg-primary text-light fixed-bottom">

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
