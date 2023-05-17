<?php
require_once 'connection.php';
require_once 'employee.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']) {
    header('Location: login.php');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    extract($_POST);
    $send_id = $_SESSION['u_id'];
    $receive_id = getEmpByEmail($link, $email);
    if ($receive_id > 0) {

        $query = "INSERT INTO messages(u_id, receive_id, message) VALUES ('$send_id','$receive_id','$message')";

        if (mysqli_query($link, $query)) {
            echo "OK";
        } else {
            echo "Error: " . mysqli_error($link);
        }
    } else {
        echo "Error: Doesn't exist";
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['m_id'])) {
        $m_id = $_GET['m_id'];
        deleteMessage($link, $m_id);
    }
}

function viewMessages($link, $receive_id)
{
    $query = "SELECT * FROM messages NATURAL JOIN workers NATURAL JOIN users WHERE receive_id='$receive_id'";
    $result = mysqli_query($link, $query);
    $messages[0][0] = 0;
    if (($result) && (mysqli_num_rows($result) > 0)) {
        $i = 0;
        while ($row = mysqli_fetch_assoc($result)) {

            $messages[0][$i] = $row['m_id'];
            $messages[1][$i] = $row['w_id']; //sender id
            $messages[2][$i] = $row['name']; //sender name
            $messages[3][$i] = $row['type']; //sender type
            $messages[4][$i] = $row['message'];
            $messages[5][$i] = $row['m_timestamp'];
            ++$i;
        }
    } else {
        return -1; //no messages
    }
    return $messages;
}

function deleteMessage($link, $m_id)
{
    $query = "DELETE FROM messages WHERE messages.m_id = '$m_id'";
    if (mysqli_query($link, $query)) {
        header('Location: ../viewMessages.php');
        exit;
    } else {
        echo "Error: " . mysqli_error($link);
    }
}
