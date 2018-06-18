<?php
/**
 * Created by PhpStorm.
 * User: elena
 * Date: 9/04/18
 * Time: 22:07
 */

require_once "config.php";
session_start();

if (!isset($_SESSION["uid"])) {
    die("Not logged in");
}

$userid = $_SESSION["uid"];

$quizzid = $_POST["quizzid"];
$answers = $_POST["answers"];
$answers = json_decode($answers, true)["answers"];

$mysqli = new mysqli($DB_HOST, $DB_USER, $DB_PASSWORD, $DB_NAME);

if ($mysqli->connect_error) {
    echo "-2"; // error connecting to mysql
    die();
}

$stmt = $mysqli->prepare("SELECT questionid FROM questions WHERE quizid = ? ORDER BY questionid");
$stmt->bind_param("i", $quizzid);
$result = $stmt->execute();
$stmt->store_result();
if ($stmt->num_rows == 0) {
    echo "-3";
    die();
}

$stmt->bind_result($qid);
$qids = array();
while ($stmt->fetch()) {
    $qids[] = $qid;
}
if (count($qids) != count($answers)) {
    echo "-4";
    die();
}

$pairs = array();
for ($i = 0; $i < count($answers); $i++) {
    $pairs[] = "('$qids[$i]', '{$mysqli->escape_string($answers[$i])}')";
}
$pairs_sql = implode(',', $pairs);
$mysqli->query("CREATE TEMPORARY TABLE TempTable (qid INT, answer CHAR(64))");
$sql = "INSERT INTO TempTable VALUES $pairs_sql";
$mysqli->query($sql);

$res = $mysqli->query('SELECT COUNT(*) AS correct FROM questions JOIN TempTable ON questions.questionid = TempTable.qid AND questions.correct_answer = TempTable.answer');
$row = $res->fetch_row();
$correct = $row[0];

$update = false;
if ($stmt = $mysqli->prepare("SELECT correctnumber FROM answers WHERE userid=? AND quizid=?")) {
    $stmt->bind_param("ii", $userid, $quizzid);
    $result = $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows == 0) {
        $update = true;
    } else {
        $stmt->bind_result($total);
        $stmt->fetch();
        if ($correct > $total) {
            $update = true;
        }
    }
}

if ($update) {
    if ($stmt = $mysqli->prepare("REPLACE INTO answers(quizid, userid, correctnumber) VALUES (?, ?, ?)")) {

        $stmt->bind_param("iii", $quizzid, $userid, $correct);
        $stmt->execute();
    }
}


echo $correct;

die();