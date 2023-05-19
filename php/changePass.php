<?php
require_once 'connection.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']) {
    header('Location: ../login.php');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $u_id = $_POST['u_id'];
    $newPassword = $_POST['newPassword'];
    setpassword($link, $u_id, $newPassword);
}

function setpassword($link, $u_id, $newPassword)
{
    // Retrieve the current password from the database
    $query = "SELECT password FROM users WHERE u_id = '$u_id'";
    $result = mysqli_query($link, $query);
    $row = mysqli_fetch_assoc($result);
    $oldPassword = $row['password'];
    $newPassword = md5($newPassword);

    // Check if the new password is different from the old password
    if ($newPassword === $oldPassword) {
        echo "Error: The new password must be different from the old password.";
        return;
    }

    // Update the password if it's different from the old password
    $query = "UPDATE users SET password = '$newPassword' WHERE u_id = '$u_id'";
    if (mysqli_query($link, $query)) {
        //echo "Password updated successfully.";
        echo "OK";
    } else {
        echo "Error updating password: " . mysqli_error($link);
    }
}
