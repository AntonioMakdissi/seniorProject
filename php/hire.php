<?php
require_once 'connection.php';

extract($_POST);

// $query = "SELECT s_id FROM series WHERE name='$name';";
// $result = mysqli_query($link, $query);
// if (($result) && (mysqli_num_rows($result) > 0)) {
//     $row = mysqli_fetch_assoc($result);
//         $s_id = $row["s_id"];

$query = "SELECT * FROM users WHERE email='$email'"; //check duplicate
$result = mysqli_query($link, $query);
if (($result) && (mysqli_num_rows($result) < 1)) {

    $query = "INSERT INTO users(email,password) VALUES ('$email','$password')";

    if (mysqli_query($link, $query)) {
        // this returns the id that mysql used for the new tuple
        //if successful ->Login
        $u_id = mysqli_insert_id($link);

        $query = "INSERT INTO workers (u_id, name, phone, branch, dateOfBirth, salary) VALUES ('$u_id', '$name', '$phone', '$branch', '$dateOfBirth', '$salary');";
        if (mysqli_query($link, $query)) {
            echo mysqli_insert_id($link);
            // this returns the id that mysql used for the new tuple
            //header('Location: seriesList.php');
        } else {
            echo "-1";
        }
    }
}
echo '<script>alert("Already added!")</script>';
//header('Location: seriesList.php');
