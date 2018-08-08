<?php
require_once "../datuBase.php";
require_once "checkOnline.php";
checkOnline(true);

$quizzes = getQuizzes();
$firstQuiz = firstQuiz();
$lastQuiz = lastQuiz();

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
    <a class="navbar-brand" href="menu.php"><img src="logo.png" style="width: 30px; height: 30px;" class="d-inline-block align-top mr-2">KEApp</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
            aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
            <a class="nav-item nav-link" href="#">Galdetegiak</a>
        </div>
    </div>
</nav>
<div class="container mt-3">

    <h1>KEApp kudeaketa</h1>
    <table class="table mt-3">
        <tr>
            <th>ID</th>
            <th>Deskribapena</th>
            <th>Descripción</th>
            <th>Puntuaziorako da?</th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>

        </tr>
        <?php
        foreach ($quizzes as $quiz) {
            echo "<tr id='quizrow-$quiz[id]'>";
            echo "<td>$quiz[id]</td>";
            echo "<td>$quiz[description]</td>";
            echo "<td>$quiz[description_es]</td>";
            echo "<td class='text-center'><div class=\"custom-control custom-checkbox\" >
              <input type=\"checkbox\" class=\"custom-control-input\" id=\"check-".$quiz['id']. '" ' .
                (isQuizPunctuable($quiz['id'])==1? "checked" : "") . ">
              <label class=\"custom-control-label\" for=\"check-$quiz[id]\"></label>
            </div></td>";
            echo "<td><a class='btn btn-primary' href='adminquestions.php?quizid=$quiz[id]'>Ireki</a></td>";
            echo "<td><button class='btn btn-danger' type='button' data-target='#deleteQuestionModal' data-toggle='modal'
                                            data-quizid='$quiz[id]'>Ezabatu</button></td>";
            if ($quiz["id"] != $firstQuiz) {
                echo "<td><a class='btn btn-primary' id='up-$quiz[id]' href='orderQuizzesUP.php?quizid=$quiz[id]'><i class='material-icons'>arrow_upward</i></a></td>";
            } else {
                echo "<td></td>";
            }
            if ($quiz["id"] != $lastQuiz) {
                echo "<td><a class='btn btn-primary' id='down-$quiz[id]'href='orderQuizzesDown.php?quizid=$quiz[id]'><i class='material-icons'>arrow_downward</i></a></td>";
            } else {
                echo "<td></td>";
            }
            echo "</tr>";


        } ?>
    </table>
</div>
<div class="container">
    <div class="text-center mt-3">
        <a href="addQuiz.php" class='btn btn-primary'>Galdetegi berria gehitu</a>
    </div>
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

<!-- Modal -->
<div class="modal fade" id="deleteQuestionModal" tabindex="-1" role="dialog" aria-labelledby="Delete question"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Galdetegia ezabatu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">Ziur al zaude galdetegia ezabatu nahi duzula?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Itxi</button>
                <a id="delete-quiz-confirm" class="btn btn-danger text-light">Ezabatu</a>
            </div>
        </div>
    </div>
</div>


<script language="JavaScript" src="js/jquery-3.3.1.min.js"></script>
<script language="JavaScript" src="js/bootstrap.js"></script>

<script language="JavaScript">
    $('#deleteQuestionModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var quizid = button.data('quizid'); // Extract info from data-* attributes
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this);
        modal.find('#delete-quiz-confirm').attr('href', "deleteQuiz.php?quizid=" + quizid);
    });
    $('input[id^="check-"]').each(function (index, button) {
        let buttonId = $(button).attr("id");
        let quizid = buttonId.substring(6, buttonId.length);
        let checkBox = document.getElementById("check-"+quizid);
        let puntuable = 0;
        $(button).on('click', function () {
                if (checkBox.checked == true){
                    puntuable=1;
                }else{
                    puntuable=0;
                }

            $.ajax({
                url: "updateQuizPuntuable.php",
                type: "get",
                data: {
                    quizid,
                    puntuable
                },
                success: function (response) {
                },
                error: function (xhr) {
                    alert("Errore bat gertatu da.");
                }
            });
        });
    });

</script>
</body>
</html>
