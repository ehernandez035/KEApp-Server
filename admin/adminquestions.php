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

    <link rel="shortcut icon" type="image/png" href="favicon.png">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="main.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

</head>
<body style="margin-bottom: 100px">
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="menu.php">KEApp</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
            aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
            <a class="nav-item nav-link" href="admin.php">Galdetegiak</a>
        </div>
    </div>
</nav>
<main>

    <div class="container mt-3">
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

        <div id="cardContainer">
            <?php
            foreach ($questions as $question) {

                ?>
                <div class="card mt-3" id="card-<?php echo $question['questionid'] ?>">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        Galdera <?php echo $question['questionid'] ?>
                        <div>
                            <?php
                            if($question['questionid']==firstQuestion($quizid)){
                                echo "<button class='btn btn-secondary btn-sm' id='up-$question[questionid]' disabled>";
                            }else{
                                echo "<button class='btn btn-secondary btn-sm' id='up-$question[questionid]'>";
                            }
                            ?>
                                <i class='material-icons'>arrow_upward</i>
                            </button>

                            <?php
                            if($question['questionid']==lastQuestion($quizid)){
                                echo "<button class='btn btn-secondary btn-sm' id='down-$question[questionid]' disabled>";
                            }else{
                                echo "<button class='btn btn-secondary btn-sm' id='down-$question[questionid]'>";
                            }
                            ?>
                                <i class='material-icons'>arrow_downward</i>
                            </button>

                            <button class="btn btn-primary btn-sm" id="minimize-<?php echo $question['questionid'] ?>">
                                <i class="material-icons" id="zoomIcon-<?php echo $question['questionid'] ?>">
                                    remove
                                </i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body" id="galderaBody-<?php echo $question['questionid'] ?>">
                        <div class="container">
                            <form id="galderaForm-<?php echo $question['questionid'] ?>">
                                <input type="hidden" name="questionid" value="<?php echo $question['questionid'] ?>">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" name="img"
                                                       onchange="onFileSelected(event,<?php echo $question['questionid']; ?>)"
                                                       id="file-<?php echo $question['questionid']; ?>">
                                                <label class="custom-file-label"
                                                       for="file-<?php echo $question['questionid']; ?>">Argazkia
                                                    aukeratu</label>
                                            </div>
                                            <img id="image-upload-<?php echo $question['questionid']; ?>"
                                                 style="max-width: 100%; display: block; margin: auto">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">

                                    <div class="col-12 col-lg-6">
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

                                    </div>
                                    <div class="col-12 col-lg-6">
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

                                    </div>


                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <input type="button" id='save-<?php echo $question['questionid']; ?>'
                                               class='btn btn-primary' value="Gorde!">
                                    </div>
                                    <div class="col-6">
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

    <!-- Modal -->
    <div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Galdera gorde da</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Aldaketak gorde dira.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Itxi</button>
                </div>
            </div>
        </div>
    </div>
</main>


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
<script src="http://malsup.github.com/jquery.form.js"></script>

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
                    updateArrows();
                },
                error: function (xhr) {
                    alert("Errore bat gertatu da.");
                    $('#deleteQuestionModal').modal('hide');
                }
            });
        });
    });

    function createQuestion(questionid) {
        var questionContent = `
<div class="card mt-3" id="card-${questionid}">
    <div class="card-header d-flex align-items-center justify-content-between">
        Galdera ${questionid}
        <div>
            <button class='btn btn-secondary btn-sm' id='up-${questionid}'>
                <i class='material-icons'>arrow_upward</i>
            </button>
            <button class='btn btn-secondary btn-sm' id='down-${questionid}'>
                <i class='material-icons'>arrow_downward</i>
            </button>
            <button class="btn btn-primary btn-sm" id="minimize-${questionid}">
                <i class="material-icons" id="zoomIcon-${questionid}">
                    remove
                </i>
            </button>
        </div>
    </div>
    <div class="card-body" id="galderaBody-${questionid}">
        <div class="container">
            <form id="galderaForm-${questionid}">
            <input type="hidden" name="questionid" value="${questionid}">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="img"
                                       id="file-${questionid}" onchange="onFileSelected(event,${questionid})">
                                <label class="custom-file-label"
                                       for="file-${questionid}">Argazkia
                                    aukeratu</label>
                            </div>
                            <img id="image-upload-${questionid}" style="max-width: 100%; display: block; margin: auto">
                        </div>
                    </div>
                </div>
                <div class="row">

                    <div class="col-12 col-lg-6">
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
                    </div>
                    <div class="col-12 col-lg-6">
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
                    </div>
                </div>
                 <div class="row">
                                <div class="col-6">
                                    <input type="button" id='save-${questionid}'
                                           class='btn btn-primary' value="Gorde!">
                                </div>
                                <div class="col-6">
                                    <button type="button" class='btn btn-danger' data-toggle="modal"
                                            data-target="#deleteQuestionModal"
                                            data-questionid="${questionid}">Ezabatu
                                    </button>
                                </div>
                            </div>
            </form>
        </div>
    </div>
</div>`;
        $("#cardContainer").append(questionContent);
        buttonClick($("#save-" + questionid));
        minimizeClick($("#minimize-" + questionid));
        updateArrows();
        upQuestion($("#up-" + questionid));
        downQuestion($("#down-" + questionid));

    }
    function updateArrows( ) {
        $('div[id^="card-"]').find("button[id^='up-']").removeAttr("disabled");
        $('div[id^="card-"]').find("button[id^='down-']").removeAttr("disabled");

        $('div[id^="card-"]').first().find("button[id^='up-']").attr("disabled", "");
        $('div[id^="card-"]').last().find("button[id^='down-']").attr("disabled", "");
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
        buttonClick(saveButton);
    });

    function buttonClick(saveButton) {
        let buttonId = $(saveButton).attr("id");
        let questionid = buttonId.substring(5, buttonId.length);

        $(saveButton).on('click', function () {
            console.log("clicked");
            $("#galderaForm-" + questionid).ajaxSubmit({
                url: 'updateQuestions.php',
                type: 'post',
                success: function (response) {
                    $('#successModal').modal('show');
                }
            });

        });
    }

    $('button[id^="minimize-"]').each(function (index, minimizeButton) {
        minimizeClick(minimizeButton);
    });

    function minimizeClick(minimizeButton) {
        let buttonId = $(minimizeButton).attr("id");
        let questionid = buttonId.substring(9, buttonId.length);

        $(minimizeButton).unbind("click").on('click', function () {
            $("#galderaBody-" + questionid).slideUp();
            $("#zoomIcon-" + questionid).html("add");
            maximizeClick(minimizeButton);
        });

    }

    function maximizeClick(maximizeButton) {
        let buttonId = $(maximizeButton).attr("id");
        let questionid = buttonId.substring(9, buttonId.length);

        $(maximizeButton).unbind("click").on('click', function () {
            $("#galderaBody-" + questionid).slideDown();
            $("#zoomIcon-" + questionid).html("remove");
            minimizeClick(maximizeButton);
        });

    }

    function onFileSelected(event, questionid) {
        var selectedFile = event.target.files[0];
        var reader = new FileReader();

        var imgtag = document.getElementById("image-upload-" + questionid);
        imgtag.title = selectedFile.name;

        reader.onload = function (event) {
            imgtag.src = event.target.result;
        };

        reader.readAsDataURL(selectedFile);
    }

    $('button[id^="up-"]').each(function (index, upButton) {
        upQuestion(upButton);
    });

    function upQuestion(button) {
        let buttonId = $(button).attr("id");
        let questionid = buttonId.substring(3, buttonId.length);
        let quizid = $('#quizid').val();

        $(button).on('click', function () {
            $.ajax({
                url: "orderQuestionsUp.php",
                type: "get",
                data: {
                    quizid,
                    questionid
                },
                success: function (response) {
                    $el = $('#card-' + questionid);
                    if ($el.not(':first-child'))
                        $el.prev().before($el);
                },
                error: function (xhr) {
                    alert("Errore bat gertatu da.");
                }
            });
        });

    }

    $('button[id^="down-"]').each(function (index, downButton) {
        downQuestion(downButton);
    });

    function downQuestion(button) {
        let buttonId = $(button).attr("id");
        let questionid = buttonId.substring(5, buttonId.length);
        let quizid = $('#quizid').val();

        $(button).on('click', function () {
            $.ajax({
                url: "orderQuestionsDown.php",
                type: "get",
                data: {
                    quizid,
                    questionid
                },
                success: function (response) {
                    $el = $('#card-' + questionid);
                    if ($el.not(':last-child'))
                        $el.next().after($el);
                },
                error: function (xhr) {
                    alert("Errore bat gertatu da.");
                }
            });
        });

    }


</script>

</body>

</html>