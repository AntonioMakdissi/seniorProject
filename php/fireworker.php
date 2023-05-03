<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin'] || ($_SESSION['type'] != 'IT' && $_SESSION['type'] != 'CEO')) {
    header('Location: ../login.php');
}
require_once 'connection.php';
//$u_id=$_SESSION['u_id'];
$rmid = $_GET['rmid'];


$query = "DELETE FROM users WHERE u_id='$rmid'";
if (mysqli_query($link, $query)) {
    header('Location: viewWorker.php');
    exit;
} else {
    echo "Error: " . mysqli_error($link);
}
