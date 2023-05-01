<?php
require_once 'connection.php';
session_start();
if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']) {
    header('Location: login.html');
}
extract($_POST);

$query = "INSERT INTO messages('send_id', 'receive_id', 'message') VALUES ('$send_id','$receive_id','$message')";

if (mysqli_query($link, $query)) {
    echo "done";
}

function viewMessages($link, $receive_id)
{
    $query = "SELECT * FROM messages WHERE receive_id='$receive_id'";
    $result = mysqli_query($link, $query);
    $messages[0][0] = 0;
    if (($result) && (mysqli_num_rows($result) > 0)) {
        $i = 0;
        while ($row = mysqli_fetch_assoc($result)) {

            $messages[0][$i] = $row['m_id'];
            $messages[1][$i] = $row['send_id'];
            $messages[2][$i] = $row['message'];
            $messages[3][$i] = $row['timestamp'];
            ++$i;
        }
    }
    return $messages;
}
