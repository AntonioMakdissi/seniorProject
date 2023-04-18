<?php
session_start();
if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']) {
    header('Location: login.html');
}
require_once 'connection.php';
//$u_id=$_SESSION['u_id'];
$rmid = $_GET['rmid'];


// echo "<script>
// if (confirm('Are you sure you want to delete this item?')) {
//     // User clicked OK, do something
//   } else {
//     // User clicked Cancel, do something else or nothing
//   }
// </script>";

$query = "DELETE from users where u_id='$rmid' ";
if (mysqli_query($link, $query)) {
    header('Location: viewWorker.php');
} else {
    echo "fail";
}
