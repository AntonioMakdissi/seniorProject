<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']) {
    header('Location: ../login.html');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the selected rating
    $rating = $_POST['rating'];

    require_once('connection.php');
    $c_id = $_SESSION['c_id'];

    $query = "UPDATE clients SET rating='$rating' WHERE c_id='$c_id';";

    if (mysqli_query($link, $query)) {

        // Send a confirmation message to the client
        $_SESSION['message'] = 'Thank you for rating our company!';
        if ($rating > 3) {
            $_SESSION['message'] = "Thank you for rating our company $rating stars!";
        }

        header("Location: track.php");
        exit;
    }
}
