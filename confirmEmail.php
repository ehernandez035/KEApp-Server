<?php

require_once "datuBase.php";
require_once "admin/checkOnline.php";
checkOnline(false);


$temp = $_GET["token"];
$user = $_GET["user"];
if ($stmt = $mysqli->prepare("INSERT INTO users(username, email, password) SELECT username, email, password FROM temp_users WHERE username=? AND temp=?")) {
    $stmt->bind_param("ss", $user, $temp);
    if ($stmt->execute()) {
        if ($stmt->affected_rows != 0) {
            $stmt = $mysqli->prepare("DELETE FROM temp_users WHERE username=?");
            $stmt->bind_param("s", $user);
            $stmt->execute();

            echo "Kontua baieztatu da.<br>La cuenta se ha verificado.";
            die();
        }
    }
}
echo "Errore bat gertatu da.<br>Ha ocurrido un error.";