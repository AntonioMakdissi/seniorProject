<?php
require_once 'connection.php';
session_start();
if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']) {
    header('Location: ../login.php');
}
extract($_POST);

$query = "SELECT * FROM branches WHERE branch='$branch_location'"; //check duplicate
$result = mysqli_query($link, $query);
if (($result) && (mysqli_num_rows($result) < 1)) {

    $query = "INSERT INTO branches VALUES ('$branch_location')";

    if (mysqli_query($link, $query)) {
        include_once('employee.php');
        $output = promoteManager($link, $manager, $branch_location);
        echo $output;
        header('Location: ../addBranches.php');
        //exit;
    }
} else {
    return "Already added!";
}
