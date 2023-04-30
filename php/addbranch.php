<?php
require_once 'connection.php';
session_start();
if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']) {
    header('Location: login.html');
}
extract($_POST);

$query = "SELECT * FROM branches WHERE branch='$branch'"; //check duplicate
$result = mysqli_query($link, $query);
if (($result) && (mysqli_num_rows($result) < 1)) {

    $query = "INSERT INTO branches VALUES ('$branch')";

    if (mysqli_query($link, $query)) {
        echo "done";
        
    }
}
else
echo '<script>alert("Already added!")</script>';