<?php
require_once "config.php";
$mysqli = new mysqli($DB_HOST, $DB_USER, $DB_PASSWORD, $DB_NAME);
if ($mysqli->connect_error) {
    echo 2;
    die();
}
function getQuizzes()
{
    global $mysqli;
    if ($stmt = $mysqli->prepare("SELECT quizid, description, description_esp, puntuable FROM quizzes ORDER BY position ASC")) {

        if ($stmt->execute()) {
            $stmt->bind_result($id, $description, $description_es, $punctuable);
            $stmt->store_result();
            $quizzes = array();
            while ($stmt->fetch()) {
                $quizzes[] = array("id" => $id, "description" => $description, "description_es" => $description_es, "punctuable" => $punctuable);
            }
            return $quizzes;
        }
    }
    return null;
}

function getQuestions($qid)
{
    global $mysqli;
    if ($stmt = $mysqli->prepare("SELECT questionid, correct_answer, correct_answer_esp, false_answer1, false_answer1_esp, false_answer2, false_answer2_esp, false_answer3, false_answer3_esp, question, question_esp, note, noteEs FROM questions WHERE quizid=? ORDER BY position ASC")) {
        $stmt->bind_param("i", $qid);
        if ($stmt->execute()) {
            $stmt->store_result();
            $stmt->bind_result($questionid, $correct_ans, $correct_ans_esp, $false1, $false1_esp, $false2, $false2_esp, $false3, $false3_esp, $question, $question_esp, $note, $noteEs);
            $questions = array();
            while ($stmt->fetch()) {
                $questions[] = array("questionid" => $questionid, "correct_ans" => $correct_ans, "correct_ans_esp" => $correct_ans_esp, "false1" => $false1, "false1_esp" => $false1_esp, "false2" => $false2, "false2_esp" => $false2_esp, "false3" => $false3, "false3_esp" => $false3_esp, "question" => $question, "question_esp" => $question_esp, "note" => $note, "noteEs" => $noteEs);
            }
            return $questions;
        }
    }
    return null;
}

function getUsers()
{
    global $mysqli;
    if ($stmt = $mysqli->prepare("SELECT userid, username, usergroup, email FROM users")) {

        if ($stmt->execute()) {
            $stmt->bind_result($userid, $username, $usergroup, $email);
            $stmt->store_result();
            $users = array();
            while ($stmt->fetch()) {
                $users[] = array("userid" => $userid, "username" => $username, "usergroup" => $usergroup, "email" => $email);
            }
            return $users;
        }
    }
    return null;
}

function getGazteleraUsers()
{
    global $mysqli;
    $class = $_GET["class"];

    if ($stmt = $mysqli->prepare("SELECT userid, username, usergroup, email FROM users WHERE usergroup='g'")) {
        $stmt->bind_param("s", $class);
        if ($stmt->execute()) {
            $stmt->bind_result($userid, $username, $usergroup, $email);
            $stmt->store_result();
            $users = array();
            while ($stmt->fetch()) {
                $users[] = array("userid" => $userid, "username" => $username, "usergroup" => $usergroup, "email" => $email);
            }
            return $users;
        }
        return null;
    }
}

function getEuskeraUsers()
{
    global $mysqli;
    $class = $_GET["class"];

    if ($stmt = $mysqli->prepare("SELECT userid, username, usergroup, email FROM users WHERE usergroup='e'")) {
        $stmt->bind_param("s", $class);
        if ($stmt->execute()) {
            $stmt->bind_result($userid, $username, $usergroup, $email);
            $stmt->store_result();
            $users = array();
            while ($stmt->fetch()) {
                $users[] = array("userid" => $userid, "username" => $username, "usergroup" => $usergroup, "email" => $email);
            }
            return $users;
        }
        return null;
    }
}

function firstQuiz()
{
    global $mysqli;
    if ($stmt = $mysqli->prepare("SELECT quizid FROM quizzes ORDER BY position ASC LIMIT 1")) {
        if ($stmt->execute()) {
            $stmt->store_result();
            $stmt->bind_result($quizid);
            $stmt->fetch();
            return $quizid;
        }
    }
    return null;
}

function lastQuiz()
{
    global $mysqli;
    if ($stmt = $mysqli->prepare("SELECT quizid FROM quizzes ORDER BY position DESC LIMIT 1")) {
        if ($stmt->execute()) {
            $stmt->store_result();
            $stmt->bind_result($quizid);
            $stmt->fetch();
            return $quizid;
        }
    }
    return null;
}

function firstQuestion($quid)
{
    global $mysqli;
    if ($stmt = $mysqli->prepare("SELECT questionid FROM questions WHERE quizid=? ORDER BY position ASC LIMIT 1")) {
        $stmt->bind_param("i", $quid);
        if ($stmt->execute()) {
            $stmt->store_result();
            $stmt->bind_result($questionid);
            $stmt->fetch();
            return $questionid;
        }
    }
    return null;
}

function lastQuestion($quid)
{
    global $mysqli;
    if ($stmt = $mysqli->prepare("SELECT questionid FROM questions WHERE quizid=? ORDER BY position DESC LIMIT 1")) {
        $stmt->bind_param("i", $quid);
        if ($stmt->execute()) {
            $stmt->store_result();
            $stmt->bind_result($questionid);
            $stmt->fetch();
            return $questionid;
        }
    }
    return null;
}

function getAnswers()
{
    global $mysqli;
    if ($stmt = $mysqli->prepare("SELECT quizid, userid, correctnumber FROM answers")) {

        if ($stmt->execute()) {
            $stmt->bind_result($quizid, $userid, $correctnumber);
            $stmt->store_result();
            $answers = array();
            while ($stmt->fetch()) {
                $answers[] = array("quizid" => $quizid, "userid" => $userid, "correctnumber" => $correctnumber);
            }
            return $answers;
        }
    }
    return null;
}

function quizPoints($quizid)
{
    global $mysqli;
    if ($stmt = $mysqli->prepare("SELECT SUM(correctnumber) FROM answers WHERE quizid=?")) {
        $stmt->bind_param("i", $quizid);
        if ($stmt->execute()) {
            $stmt->store_result();
            $stmt->bind_result($total);
            $stmt->fetch();
            return $total;
        } else {
            http_response_code(500);
            echo $mysqli->error;
            return null;
        }
    }
}

function answersPerQuiz($quizid)
{
    global $mysqli;
    if ($stmt = $mysqli->prepare("SELECT COUNT(userid) FROM answers WHERE quizid=?")) {
        $stmt->bind_param("i", $quizid);
        if ($stmt->execute()) {
            $stmt->store_result();
            $stmt->bind_result($total);
            $stmt->fetch();
            return $total;
        } else {
            http_response_code(500);
            echo $mysqli->error;
            return null;
        }
    }

}

function questionsPerQuiz($quizid)
{
    global $mysqli;
    if ($stmt = $mysqli->prepare("SELECT COUNT(questionid) FROM questions WHERE quizid=?")) {
        $stmt->bind_param("i", $quizid);
        if ($stmt->execute()) {
            $stmt->store_result();
            $stmt->bind_result($total);
            $stmt->fetch();
            return $total;
        } else {
            http_response_code(500);
            echo $mysqli->error;
            return null;
        }
    }

}
function getGroupPoints($quizid, $usergroup)
{
    global $mysqli;
    if ($stmt = $mysqli->prepare("SELECT SUM(correctnumber) FROM answers WHERE quizid=? AND userid IN (SELECT userid FROM users WHERE usergroup=?)")) {
        $stmt->bind_param("is", $quizid, $usergroup);
        if ($stmt->execute()) {
            $stmt->store_result();
            $stmt->bind_result($total);
            $stmt->fetch();
            return $total;
        } else {
            http_response_code(500);
            echo $mysqli->error;
            return null;
        }
    }
}

function answersPerQuizGroup($quizid, $usergroup)
{
    global $mysqli;
    if ($stmt = $mysqli->prepare("SELECT COUNT(userid) FROM answers WHERE quizid=? AND userid IN (SELECT userid FROM users WHERE usergroup=?)")) {
        $stmt->bind_param("is", $quizid, $usergroup);
        if ($stmt->execute()) {
            $stmt->store_result();
            $stmt->bind_result($total);
            $stmt->fetch();
            return $total;
        } else {
            http_response_code(500);
            echo $mysqli->error;
            return null;
        }
    }

}

function isQuizPunctuable($quizid){
    global $mysqli;
    if ($stmt = $mysqli->prepare("SELECT puntuable FROM quizzes WHERE quizid=?")) {
        $stmt->bind_param("i", $quizid);
        if ($stmt->execute()) {
            $stmt->store_result();
            $stmt->bind_result($puntuable);
            $stmt->fetch();
            return $puntuable;
        } else {
            http_response_code(500);
            echo $mysqli->error;
            return null;
        }
    }
}
