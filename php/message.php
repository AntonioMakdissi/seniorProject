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

function viewMessages($link,$receive_id){
    $query = "SELECT * FROM messages WHERE receive_id='$receive_id'";
	$result = mysqli_query($link, $query);
	$row = mysqli_fetch_assoc($result);

	$m_id=$row['m_id'];
    $send_id=$row['send_id'];
    $message=$row['message'];
    $timestamp=$row['timestamp'];
}
