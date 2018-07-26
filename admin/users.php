<?php
require_once "../datuBase.php";
require_once "checkOnline.php";
checkOnline(true);

$users = getUsers();

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
    <table class="table mt-3">
        <tr>
            <th>Erabiltzailea</th>
            <th>Email helbidea</th>
            <th></th>
        </tr>
        <?php
        foreach ($users as $user) {
            echo "<tr id='userrow-$user[userid]'>";
            echo "<td>$user[username]</td>";
            echo "<td>$user[email]</td>";
            echo "<td><button class='btn btn-danger' type='button' data-target='#deleteUserModal' data-toggle='modal'
                                            data-userid='$user[userid]'>Ezabatu</button></td>";
            echo "</tr>";


        } ?>
    </table>
</div>
<footer class="page-footer font-small bg-primary text-light fixed-bottom">

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


<script language="JavaScript" src="js/jquery-3.3.1.min.js"></script>
<script language="JavaScript" src="js/bootstrap.js"></script>

<script language="JavaScript">
    $('#deleteUserModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var userid = button.data('userid'); // Extract info from data-* attributes
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this);
        modal.find('#delete-user-confirm').attr('href', "deleteUser.php?userid="+userid);
    })
</script>
</body>
</html>