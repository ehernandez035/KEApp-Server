<?php
require_once "../datuBase.php";
require_once "checkOnline.php";
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
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="menu.php"> <img src="logo.png" style="width: 30px; height: 30px;" class="d-inline-block align-top mr-2">KEApp</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
            aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
            <a class="nav-item nav-link" href="users.php">Erabiltzaileak</a>
        </div>
    </div>
</nav>
<div class="text-center mt-3">
    <a class='btn btn-secondary' id="gaztUsers" href='users.php?usergroup=g' >Gaztelerako ikasleak</a>
    <a class='btn btn-secondary' id="euskUsers" href='users.php?usergroup=e' >Euskarako ikasleak</a>

</div>
<div class="container mt-3">

    <h1>KEApp kudeaketa</h1>
    <table class="table mt-3">
        <tr>
            <th>Erabiltzailea</th>
            <th>Email helbidea</th>
            <th></th>
            <th></th>
            <th>Erabiltzaileen taldea</th>
        </tr>
        <?php
        foreach ($users as $user) {
            echo "<tr id='userrow-$user[userid]'>";
            echo "<td>$user[username]</td>";
            echo "<td>$user[email]</td>";
            echo "<td><button class='btn btn-danger' type='button' data-target='#deleteUserModal' data-toggle='modal'
                                            data-userid='$user[userid]'>Ezabatu</button></td>";
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
<div class="modal fade" id="deleteUserModal" tabindex="-1" role="dialog" aria-labelledby="Delete user"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Erabiltzailea ezabatu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">Ziur al zaude erabiltzailea ezabatu nahi duzula?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Itxi</button>
                <a id="delete-user-confirm" class="btn btn-danger text-light">Ezabatu</a>
            </div>
        </div>
    </div>
</div>

<!-- Message modal -->
<div class="modal fade" tabindex="-1" id="messageModal" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Mezua bidali</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="sendMessage.php" id="messageForm">
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Mezua:</label>
                        <textarea class="form-control" id="message-text" name="message"></textarea>
                        <input name="email" type="hidden" id="emailInput">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="sendButtonConfirm" class="btn btn-primary">Bidali</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Itxi</button>
            </div>
        </div>
    </div>
</div>

<script language="JavaScript" src="js/jquery-3.3.1.min.js"></script>
<script language="JavaScript" src="js/bootstrap.js"></script>

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
                    alert("Errore bat gertatu da.");
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
                    alert("Errore bat gertatu da.");
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
                    alert("Errore bat gertatu da.");
                }
            });
        })
    });

</script>
</body>
</html>