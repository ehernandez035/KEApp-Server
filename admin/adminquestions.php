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
<body style="margin-bottom: 100px">
<main>

    <div class="container mt-3" id="cardContainer">
        <h1>KEApp kudeaketa</h1>
        <div class="card mt-3">
            <div class="card-header">
                <h2>Galdetegia</h2>
            </div>
            <div class="card-body">
                <form id="galdetegi_form">
                    <div class="form-group">
                        <label for="quizid">Identifikatzailea:</label>
                        <input name='quizid' id="quizid" class="form-control"
                               value='<?php echo $quizid ?>' readonly>
                    </div>
                    <div class="form-group">
                        <label for="deskribapena">Deskribapena:</label>
                        <input name='deskribapena' id="deskribapena" class="form-control"
                               value='<?php echo $quizzes[$quizid - 1]['description'] ?>'>
                    </div>
                    <div class="form-group">
                        <label for="descripcion">Descripción:</label>
                        <input name='descripcion' id="descripcion" class="form-control"
                               value='<?php echo $quizzes[$quizid - 1]['description_es'] ?>'>
                    </div>
                    <div class="text-center">
                        <input id="gordeQuizButton" class="btn btn-primary" type="button" value="Gorde!">
                    </div>
                </form>
            </div>
        </div>

        <?php
        foreach ($questions as $question) {

            ?>
            <div class="card mt-3" id="card-<?php echo $question['questionid'] ?>">
                <div class="card-header">Galdera <?php echo $question['questionid'] ?></div>
                <div class="card-body">
                    <div class="container">
                        <form id="galderaForm-<?php echo $question['questionid'] ?>">
                            <div class="row">

                                <div class="col-6">
                                    <b>Euskera</b>
                                    <div class="form-group">
                                        <label for="enuntziatua">Enuntziatua</label>
                                        <input name="enuntziatua" class="form-control"
                                               id="enuntziatua-<?php echo $question['questionid']; ?>"
                                               value='<?php echo $question['question'] ?>'>
                                    </div>
                                    <div class="form-group">
                                        <label for="erantzunZuzena">Erantzun zuzena</label>
                                        <input name="erantzunZuzena" class="form-control"
                                               id="erantzunZuzena-<?php echo $question['questionid']; ?>"
                                               value='<?php echo $question['correct_ans'] ?>'>
                                    </div>
                                    <div class="form-group">
                                        <label for="erantzunOkerra1">Erantzun okerra</label>
                                        <input name="erantzunOkerra1" class="form-control"
                                               id="erantzunOkerra1-<?php echo $question['questionid']; ?>"
                                               value='<?php echo $question['false1'] ?>'>
                                    </div>
                                    <div class="form-group">
                                        <label for="erantzunOkerra2">Erantzun okerra</label>
                                        <input name="erantzunOkerra2" class="form-control"
                                               id="erantzunOkerra2-<?php echo $question['questionid']; ?>"
                                               value='<?php echo $question['false2'] ?>'>
                                    </div>
                                    <div class="form-group">
                                        <label for="erantzunOkerra3">Erantzun okerra</label>
                                        <input name="erantzunOkerra3" class="form-control"
                                               id="erantzunOkerra3-<?php echo $question['questionid']; ?>"
                                               value='<?php echo $question['false3'] ?>'>
                                    </div>
                                    <input type="button" id='save-<?php echo $question['questionid']; ?>'
                                           class='btn btn-primary' value="Gorde!">
                                </div>
                                <div class="col-6">
                                    <b>Gaztelera</b>
                                    <div class="form-group">
                                        <label for="enuntziatuaEs">Enunciado</label>
                                        <input name="enuntziatuaEs" class="form-control"
                                               id="enuntziatuaEs-<?php echo $question['questionid']; ?>"
                                               value='<?php echo $question['question_esp'] ?>'>
                                    </div>
                                    <div class="form-group">
                                        <label for="erantzunZuzenaEs">Respuesta correcta</label>
                                        <input name="erantzunZuzenaEs" class="form-control"
                                               id="erantzunZuzenaEs-<?php echo $question['questionid']; ?>"
                                               value='<?php echo $question['correct_ans_esp'] ?>'>
                                    </div>
                                    <div class="form-group">
                                        <label for="erantzunOkerra1Es">Respuesta incorrecta</label>
                                        <input name="erantzunOkerra1Es" class="form-control"
                                               id="erantzunOkerra1Es-<?php echo $question['questionid']; ?>"
                                               value='<?php echo $question['false1_esp'] ?>'>
                                    </div>
                                    <div class="form-group">
                                        <label for="erantzunOkerra2Es">Respuesta incorrecta</label>
                                        <input name="erantzunOkerra2Es" class="form-control"
                                               id="erantzunOkerra2Es-<?php echo $question['questionid']; ?>"
                                               value='<?php echo $question['false2_esp'] ?>'>
                                    </div>
                                    <div class="form-group">
                                        <label for="erantzunOkerra3Es">Respuesta incorrecta</label>
                                        <input name="erantzunOkerra3Es" class="form-control"
                                               id="erantzunOkerra3Es-<?php echo $question['questionid']; ?>"
                                               value='<?php echo $question['false3_esp'] ?>'>
                                    </div>
                                    <button type="button" class='btn btn-danger' data-toggle="modal"
                                            data-target="#deleteQuestionModal"
                                            data-questionid="<?php echo $question['questionid']; ?>">Ezabatu
                                    </button>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>

    </div>
    <div class="container">
        <div class="text-center mt-3">
            <button type="button" id="addQuestionButton" class='btn btn-primary'>Galdera berria gehitu</button>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="deleteQuestionModal" tabindex="-1" role="dialog" aria-labelledby="Delete question"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Galdera ezabatu</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">Ziur al zaude galdera ezabatu nahi duzula?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Itxi</button>
                    <button type="button" id="delete-question-confirm" class="btn btn-danger">Ezabatu</button>
                </div>
            </div>
        </div>
    </div>
</main>

<footer class="page-footer font-small bg-primary text-light fixed-bottom">

    <!-- Copyright -->
    <div class="footer-copyright text-center py-3">© 2018 Copyright:
        <a href="https://github.com/ehernandez035/" class="text-light"> GPL-3.0 lizentziapean</a>
    </div>
    <!-- Copyright -->

</footer>

<script language="JavaScript" src="js/jquery-3.3.1.min.js"></script>
<script language="JavaScript" src="js/bootstrap.js"></script>

<script language="JavaScript">
    $('#deleteQuestionModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var questionid = button.data('questionid'); // Extract info from data-* attributes
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this);
        modal.find('#delete-question-confirm').click(function () {
            $.ajax({
                url: "deleteQuestion.php",
                type: "get", //send it through get method
                data: {
                    questionid: questionid
                },
                success: function (response) {
                    $('#card-' + questionid).slideUp();
                    $('#deleteQuestionModal').modal('hide');
                },
                error: function (xhr) {
                    alert("Errore bat gertatu da.");
                    $('#deleteQuestionModal').modal('hide');
                }
            });
        });
    });

    function createQuestion(questionid) {
        console.log(questionid);
        var questionContent = `
<div class="card mt-3" id="questionid">
    <div class="card-header">Galdera ${questionid}</div>
    <div class="card-body">
        <div class="container">
            <form id="galderaForm-${questionid}">
                <div class="row">

                    <div class="col-6">
                        <b>Euskera</b>
                        <div class="form-group">
                            <label for="enuntziatua">Enuntziatua</label>
                            <input name="enuntziatua" class="form-control" id="enuntziatua-${questionid}"
                                   value=''>
                        </div>
                        <div class="form-group">
                            <label for="erantzunZuzena">Erantzun zuzena</label>
                            <input name="erantzunZuzena" class="form-control" id="erantzunZuzena-${questionid}"
                                   value=''>
                        </div>
                        <div class="form-group">
                            <label for="erantzunOkerra1">Erantzun okerra</label>
                            <input name="erantzunOkerra1" class="form-control" id="erantzunOkerra1-${questionid}"
                                   value=''>
                        </div>
                        <div class="form-group">
                            <label for="erantzunOkerra2">Erantzun okerra</label>
                            <input name="erantzunOkerra2" class="form-control" id="erantzunOkerra2-${questionid}"
                                   value=''>
                        </div>
                        <div class="form-group">
                            <label for="erantzunOkerra3">Erantzun okerra</label>
                            <input name="erantzunOkerra3" class="form-control" id="erantzunOkerra3-${questionid}"
                                   value=''>
                        </div>
                        <input type="button" id='save-${questionid}'
                                class='btn btn-primary' value="Gorde!">
                    </div>
                    <div class="col-6">
                        <b>Gaztelera</b>
                        <div class="form-group">
                            <label for="enuntziatuaEs">Enunciado</label>
                            <input name="enuntziatuaEs" class="form-control" id="enuntziatuaEs-${questionid}"
                                   value=''>
                        </div>
                        <div class="form-group">
                            <label for="erantzunZuzenaEs">Respuesta correcta</label>
                            <input name="erantzunZuzenaEs" class="form-control" id="erantzunZuzenaEs-${questionid}"
                                   value=''>
                        </div>
                        <div class="form-group">
                            <label for="erantzunOkerra1Es">Respuesta incorrecta</label>
                            <input name="erantzunOkerra1Es" class="form-control"
                                   id="erantzunOkerra1Es-${questionid}"
                                   value=''>
                        </div>
                        <div class="form-group">
                            <label for="erantzunOkerra2Es">Respuesta incorrecta</label>
                            <input name="erantzunOkerra2Es" class="form-control"
                                   id="erantzunOkerra2Es-${questionid}"
                                   value=''>
                        </div>
                        <div class="form-group">
                            <label for="erantzunOkerra3Es">Respuesta incorrecta</label>
                            <input name="erantzunOkerra3Es" class="form-control"
                                   id="erantzunOkerra3Es-${questionid}"
                                   value=''>
                        </div>
                        <button type="button" class='btn btn-danger' data-toggle="modal"
                                data-target="#deleteQuestionModal"
                                data-questionid="${questionid} ?>">Ezabatu
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>`;
        $("#cardContainer").append(questionContent);

    }

    $('#addQuestionButton').click(function () {
        var quizid = <?php echo $quizid;?>;
        $.ajax({
            url: "addQuestion.php",
            type: "get",
            data: {
                quizid: quizid
            },
            success: function (response) {
                createQuestion(response);
            },
            error: function (xhr) {
                alert("Errore bat gertatu da.");
            }
        });
    });
    $('#gordeQuizButton').click(function () {
        var quizid = <?php echo $quizid;?>;
        var deskribapena = $('#deskribapena').val();
        var descripcion = $('#descripcion').val();
        $.ajax({
            url: "updateQuizzes.php",
            type: "post",
            data: {
                quizid,
                deskribapena,
                descripcion
            },
            success: function (response) {
                let btn = $('#gordeQuizButton');
                btn.val("Gordeta").removeClass('btn-primary').addClass('btn-success');
                setTimeout(function () {
                    btn.val("Gorde!").removeClass('btn-success').addClass('btn-primary');
                }, 2000);
            },
            error: function (xhr) {
                alert("Errore bat gertatu da.");
            }
        });
    });

    $('input[id^="save-"]').each(function (index, saveButton) {
        let buttonId = $(saveButton).attr("id");
        let questionid = buttonId.substring(5, buttonId.length);
        $(saveButton).on('click', function () {
            let enuntziatua = $('#enuntziatua-' + questionid).val();
            let enuntziatuaEs = $('#enuntziatuaEs-' + questionid).val();
            let erantzunZuzena = $('#erantzunZuzena-' + questionid).val();
            let erantzunZuzenaEs = $('#erantzunZuzenaEs-' + questionid).val();
            let erantzunOkerra1 = $('#erantzunOkerra1-' + questionid).val();
            let erantzunOkerra1Es = $('#erantzunOkerra1Es-' + questionid).val();
            let erantzunOkerra2 = $('#erantzunOkerra2-' + questionid).val();
            let erantzunOkerra2Es = $('#erantzunOkerra2Es-' + questionid).val();
            let erantzunOkerra3 = $('#erantzunOkerra3-' + questionid).val();
            let erantzunOkerra3Es = $('#erantzunOkerra3Es-' + questionid).val();

            $.ajax({
                url: "updateQuestions.php",
                type: "post",
                data: {
                    questionid: questionid,
                    correct_ans: erantzunZuzena,
                    correct_ans_esp: erantzunZuzenaEs,
                    false1: erantzunOkerra1,
                    false1_esp: erantzunOkerra1Es,
                    false2: erantzunOkerra2,
                    false2_esp: erantzunOkerra2Es,
                    false3: erantzunOkerra3,
                    false3_esp: erantzunOkerra3Es,
                    question: enuntziatua,
                    question_esp: enuntziatuaEs
                },
                success: function (response) {
                    let btn = $(saveButton);
                    btn.val("Gordeta").removeClass('btn-primary').addClass('btn-success');
                    setTimeout(function () {
                        btn.val("Gorde!").removeClass('btn-success').addClass('btn-primary');
                    }, 2000);
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