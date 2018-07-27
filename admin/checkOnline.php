<?php

require_once __DIR__."/../config.php";

function checkOnline($canLogIn=false)
{
    global $adminpass;
    session_start();
    if ($canLogIn && !isset($_SESSION["admin"])) {
        if (isset($_POST["password"])) {
            if ($_POST["password"] == $adminpass) {
                $_SESSION["admin"] = true;
            }
        }
    }
    if (!isset($_SESSION["admin"])) {
        header("Location: index.php");
        die();
    }
}
