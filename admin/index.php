<?php
require_once "footer.php";
?>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/bootstrap.css">

    <link rel="shortcut icon" type="image/png" href="favicon.png">
    <link rel="stylesheet" href="main.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>
<div class="container mt-3">
    <h1>KEApp kudeaketa / administración</h1>
    <div class="card mt-3">

        <div class="card-header">Saioa hasi/Iniciar sesión</div>
        <div class="card-body mx-auto">
            <div>
                <img src="logo.png" style="max-width: 250px" alt="KEApp logoa">
            </div>
            <form action="menu.php" method="post">
                <div class="form-group">
                    <label for="password">Pasahitza/Contraseña</label>
                    <input class="form-control" type="password" name="password" id="password">
                </div>
                <div class="text-center">
                    <input type="submit" class="btn btn-primary">
                </div>
            </form>
        </div>

    </div>
</div>


<?php printFooter()?>

<script language="JavaScript" src="js/bootstrap.js"></script>
</body>
</html>