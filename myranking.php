<?php
/**
 * Created by PhpStorm.
 * User: elena
 * Date: 31/03/18
 * Time: 11:12
 */

require_once "config.php";
session_start();
if(!isset($_SESSION["uid"])){
    echo "-3";
    die();
}
$uid = $_SESSION["uid"];

$mysqli = new mysqli($DB_HOST, $DB_USER, $DB_PASSWORD, $DB_NAME);
if ($mysqli->connect_error) {
    echo "-1"; // error connecting to mysql
    die();
}


$mysqli->query("SET @pos = 0");

if ($stmt = $mysqli->prepare("
SELECT pos FROM users LEFT JOIN (
SELECT (@pos:=@pos+1) pos, userid FROM (
  SELECT
    users.userid,
    COALESCE(SUM(correctnumber / question_count), 0) * 1000 AS corrects
  FROM users
    LEFT JOIN answers ON users.userid = answers.userid
    LEFT JOIN quizzes ON answers.quizid = quizzes.quizid
    LEFT JOIN (SELECT
                 quizid,
                 COUNT(questionid) AS question_count
               FROM questions AS T1
               GROUP BY quizid) AS T1 ON T1.quizid = quizzes.quizid
  GROUP BY users.userid
  ORDER BY corrects DESC, username ASC
) AS T2) AS T3 ON users.userid=T3.userid
WHERE users.userid=?")) {
    $stmt->bind_param("i", $uid);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($rank);
    if ($stmt->num_rows == 0) {
        echo "0";
        die();
    }
    $stmt->fetch();
    echo $rank;
    die();
}
echo $mysqli->error;
echo "-2";