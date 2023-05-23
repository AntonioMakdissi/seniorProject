<?php
require_once 'connection.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']) {
    header('Location: ../login.php');
}
extract($_POST);
$branch = str_replace("%20", " ", $_POST['district']);

$pass = $_POST['password'];
$password = md5($pass);

$query = "SELECT * FROM users WHERE email='$email'"; //check duplicate
$result = mysqli_query($link, $query);
if (($result) && (mysqli_num_rows($result) < 1)) {

    $query = "INSERT INTO users(email,password,type) VALUES ('$email','$password','$type')";

    if (mysqli_query($link, $query)) {
        // this returns the id that mysql used for the new tuple
        //if successful ->Login
        $u_id = mysqli_insert_id($link);

        $query = "INSERT INTO workers (u_id, name, phone, branch, dateOfBirth, salary) VALUES ('$u_id', '$name', '$phone', '$branch', '$dateOfBirth', '$salary');";
        if (mysqli_query($link, $query)) {
            //echo mysqli_insert_id($link);
            // this returns the id that mysql used for the new tuple
            echo "OK";
        } else {
            echo "Error inserting worker information";
        }
    } else {
        echo "Error inserting user information";
    }
} else
    echo "Already added!";
