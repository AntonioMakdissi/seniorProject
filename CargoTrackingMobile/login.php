<?php
require_once 'connection.php';
$name = $_GET['name'];
$password = $_GET['password'];
$name = mysqli_real_escape_string($con, $name);
$query = "SELECT * FROM users WHERE email = '$name';";
$result = mysqli_query($con, $query);
if ($result) {
    if (mysqli_num_rows($result) == 1) {
        $u_info = mysqli_fetch_assoc($result);
        if (($u_info['email'] == $name) &&
            ($u_info['password'] == md5($password))
        ) {
            $u_id = $u_info['u_id'];
            $query = "SELECT w_id FROM users NATURAL JOIN workers WHERE u_id = '$u_id';";
            $result = mysqli_query($con, $query);
            if ($result) {
                if (mysqli_num_rows($result) == 1) {
                    $u_info = mysqli_fetch_assoc($result);
                    $w_id = $u_info['w_id'];
                    echo "$w_id";
                } else {
                    echo "Error: Not a Worker.";
                }
            } else {
                echo "Error: Failed to fetch worker data. Please try again later.";
            }
        } else {
            echo "Error: Incorrect username or password.";
        }
    } else {
        echo "Error: Incorrect username or password.";
    }
} else {
    echo "Error: Failed to fetch user data. Please try again later.";
}
