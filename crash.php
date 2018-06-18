<?php

session_start();

$file_name = "crash_" . uniqid() . ".txt";
//ob_flush();
//ob_start();
$file = fopen($file_name, "w");
if (!$file) {
    echo "Error";
} else {
    fwrite($file, $file_name . "\n");
    fwrite($file, date('m/d/Y H:i:s', $_SERVER['REQUEST_TIME']) . "\n");
    fwrite($file, print_r(get_defined_vars(), true) . "\n");
    fclose($file);
}
