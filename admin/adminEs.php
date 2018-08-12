<?php
require_once "../datuBase.php";
require_once "checkOnline.php";
require_once "footer.php";
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

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="menu.php"><img src="logo.png" style="width: 30px; height: 30px;" class="d-inline-block align-top mr-2">KEApp</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
            aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
            <a class="nav-item nav-link" href="#">Cuestionarios</a>
        </div>
    </div>
    <div>

        <select class="custom-select custom-select-sm ml-3" style="width: 18em" id="language" onchange="location = this.value;">
            <option selected>Hizkuntza</option>
            <option value="admin.php" >Euskara </option>
            <option value="adminEs.php">Castellano</option>
        </select>
        <a href=https://drive.google.com/open?id=109FE96oEbE8nYcc8Tl9lYN2k3TWKofbX class="d-inline-block align-top mr-2"><i class="material-icons">
                help_outline
            </i></a>

    </div>
</nav>

<div class="container mt-3">

    <h1>KEApp administración</h1>
    <table class="table mt-3">
        <tr>
            <th>ID</th>
            <th>Deskribapena</th>
            <th>Descripción</th>
            <th>¿Sirve para puntuar?</th>
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
            echo "<td><a class='btn btn-primary' href='adminquestionsEs.php?quizid=$quiz[id]'>Mostrar</a></td>";
            echo "<td><button class='btn btn-danger' type='button' data-target='#deleteQuestionModal' data-toggle='modal'
                                            data-quizid='$quiz[id]'>Eliminar</button></td>";
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
        <a href="addQuiz.php" class='btn btn-primary'>Añadir nuevo cuestionario</a>
    </div>
</div>

<?php printFooterEs()?>

<!-- Modal -->
<div class="modal fade" id="deleteQuestionModal" tabindex="-1" role="dialog" aria-labelledby="Delete question"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Borrar questionario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">¿Está seguro de que desea borrar el cuestionario?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <a id="delete-quiz-confirm" class="btn btn-danger text-light">Eliminar</a>
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
                    alert("Ha ocurrido algún error.");
                }
            });
        });
    });

</script>
</body>
</html>
