<?php
/**
 * Created by PhpStorm.
 * User: elena
 * Date: 30/03/18
 * Time: 12:42
 */
require_once "config.php";
$mysqli = new mysqli($DB_HOST, $DB_USER, $DB_PASSWORD, $DB_NAME);
if ($mysqli->connect_error) {
    echo "{status: 0}"; // error connecting to mysql
    die();
}

if ($stmt = $mysqli->prepare("
SELECT username, COALESCE(SUM(correctnumber/question_count), 0) * 1000
FROM users
  LEFT JOIN answers ON users.userid=answers.userid
LEFT JOIN quizzes ON answers.quizid=quizzes.quizid
LEFT JOIN (SELECT quizid, COUNT(questionid) AS question_count FROM questions AS T1 GROUP BY quizid) as T1 ON T1.quizid=quizzes.quizid
GROUP BY users.userid ORDER BY correctnumber DESC, username ASC LIMIT 10")) {
    $result = $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($username, $points);
    $jsondata = array();
    $jsondata["status"] = 1;
    $jsondata["data"] = array();
    while($stmt->fetch()){
        $jsondata["data"][] = array("user"=>$username, "points"=>floor($points));
    }
    echo json_encode($jsondata);
}