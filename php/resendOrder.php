<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin'] || ($_SESSION['type'] != 'client' && $_SESSION['type'] != 'BranchManager')) {
    header('Location: ../login.php');
}
require_once 'connection.php';
//$u_id=$_SESSION['u_id'];
$o_id = $_GET['o_id'];


$query = "UPDATE orders SET status = 'pending' WHERE orders.o_id = '$o_id';";
if (mysqli_query($link, $query)) {
    //$_SESSION['mess']="Marked order $o_id as failed";
    header('Location: ../manager.php');
    exit;
} else {
    echo "Error: " . mysqli_error($link);
}
