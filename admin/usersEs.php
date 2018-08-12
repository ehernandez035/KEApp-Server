<?php
require_once "../datuBase.php";
require_once "checkOnline.php";
require_once "footer.php";
checkOnline(true);

$class=$_GET['usergroup'];
if($class=="g"){
    $users=getGazteleraUsers();
}elseif ($class=="e"){
    $users=getEuskeraUsers();
}else{
    $users = getUsers();
}
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="main.css">
    <link rel="shortcut icon" type="image/png" href="favicon.png">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body style="margin-bottom: 100px">

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="menuEs.php"> <img src="logo.png" style="width: 30px; height: 30px;" class="d-inline-block align-top mr-2">KEApp</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
            aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
            <a class="nav-item nav-link" href="usersEs.php">Usuarios</a>
        </div>
    </div>
    <div>

        <select class="custom-select custom-select-sm ml-3" style="width: 18em" id="language" onchange="location = this.value;">
            <option selected>Hizkuntza</option>
            <option value="users.php" >Euskara </option>
            <option value="usersEs.php">Castellano</option>
        </select>
        <a href=https://drive.google.com/open?id=109FE96oEbE8nYcc8Tl9lYN2k3TWKofbX class="d-inline-block align-top mr-2"><i class="material-icons">
                help_outline
            </i></a>

    </div>
</nav>

<div class="container text-center mt-3">
    <div class="dropdown">
        <button class="btn btn-default dropdown-toggle" type="button" id="menu1" data-toggle="dropdown">Tipo de usuario
            <span class="caret"></span></button>
        <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
            <li role="presentation"><a role="menuitem" tabindex="-1" href="usersEs.php?usergroup=g">Grupo de castellano</a></li>
            <li role="presentation"><a role="menuitem" tabindex="-1" href="usersEs.php?usergroup=e">Grupo de euskara</a></li>
            <li role="presentation" class="divider"></li>
            <li role="presentation"><a role="menuitem" tabindex="-1" href="usersEs.php">Todos</a></li>
        </ul>
    </div>
</div>

<div class="container mt-3">

    <h1>KEApp administración</h1>
    <table class="table mt-3">
        <tr>
            <th>Usuario</th>
            <th>Dirección de correo</th>
            <th></th>
            <th></th>
            <th>Grupo del usuario</th>
        </tr>
        <?php
        foreach ($users as $user) {
            echo "<tr id='userrow-$user[userid]'>";
            echo "<td>$user[username]</td>";
            echo "<td>$user[email]</td>";
            echo "<td><button class='btn btn-danger' type='button' data-target='#deleteUserModal' data-toggle='modal'
                                            data-userid='$user[userid]'>Eliminar</button></td>";
            echo "<td><button class='btn btn-primary' type='button' data-email='$user[email]' data-target='#messageModal' data-toggle='modal'>
<i class='material-icons'>
mail
</i>
</button></td> ";
            ?> <td><div class="btn-group btn-group-toggle" data-toggle="buttons" id='divBut-<?php echo $user['userid'] ?>'>
                    <label class="btn btn-secondary <?php if($user['usergroup']==="b") echo "active";?>" id='b-<?php echo $user['userid'] ?>'>
                        <input type="radio" name="besteak" autocomplete="off" <?php if($user['usergroup']=="b") echo "checked";?>> B
                    </label>
                    <label class="btn btn-secondary <?php if($user['usergroup']==="g") echo "active";?>" id='g-<?php echo $user['userid'] ?>'>
                        <input type="radio" name="gaztelera"   autocomplete="off" <?php if($user['usergroup']=="g") echo "checked";?>> G
                    </label>
                    <label class="btn btn-secondary <?php if($user['usergroup']==="e") echo "active";?>" id='e-<?php echo $user['userid'] ?>'>
                        <input type="radio" name="euskara" autocomplete="off" <?php if($user['usergroup']=="e") echo "checked";?>> E
                    </label>
                </div></td>
            <?php
            echo "</tr>";

        } ?>
    </table>
</div>

<?php printFooterEs()?>


<!-- Modal -->
<div class="modal fade" id="deleteUserModal" tabindex="-1" role="dialog" aria-labelledby="Delete user"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Eliminar usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">¿Está seguro de que desea eliminar al usuario?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <a id="delete-user-confirm" class="btn btn-danger text-light">Eliminar</a>
            </div>
        </div>
    </div>
</div>

<!-- Message modal -->
<div class="modal fade" tabindex="-1" id="messageModal" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Mandar mensaje</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="sendMessage.php" id="messageForm">
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Mensaje::</label>
                        <textarea class="form-control" id="message-text" name="message"></textarea>
                        <input name="email" type="hidden" id="emailInput">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="sendButtonConfirm" class="btn btn-primary">Enviar</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

<script language="JavaScript">
    $('#deleteUserModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var userid = button.data('userid'); // Extract info from data-* attributes
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this);
        modal.find('#delete-user-confirm').attr('href', "deleteUser.php?userid=" + userid);
    });

    $('#messageModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var email = button.data('email');
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this);
        modal.find('#emailInput').val(email);
        modal.find('#sendButtonConfirm').click(function () {
            modal.find('#messageForm').submit();
        })
    });

    $('div[id^="divBut-"]').each(function (index, selectedButton) {
        let buttonId = $(selectedButton).attr("id");
        let userid = buttonId.substring(7, buttonId.length);
        $('#g-' + userid).click(function () {
            $.ajax({
                url: "usergroup.php",
                type: "get",
                data: {
                    userid,
                    usergroup: "g"
                },
                success: function (response) {
                },
                error: function (xhr) {
                    alert("Ha ocurrido algún error.");
                }
            });
        });
        $('#e-' + userid).on("click", function () {
            $.ajax({
                url: "usergroup.php",
                type: "get",
                data: {
                    userid,
                    usergroup: "e"
                },
                success: function (response) {
                },
                error: function (xhr) {
                    alert("Ha ocurrido algún error.");
                }
            });
        });
        $('#b-' + userid).on("click", function () {
            $.ajax({
                url: "usergroup.php",
                type: "get",
                data: {
                    userid,
                    usergroup: "b"
                },
                success: function (response) {
                },
                error: function (xhr) {
                    alert("Ha ocurrido algún error.");
                }
            });
        })
    });

</script>
</body>
