<?php
session_start();
if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']) {
	header('Location: login.html');
}
require_once 'connection.php';
$u_id=$_SESSION['u_id'];
$name = $_GET['name'];
$query = "SELECT s_id FROM series WHERE name='$name';";
$result = mysqli_query($link, $query);
if (($result) && (mysqli_num_rows($result) > 0)) {
    while ($row = mysqli_fetch_assoc($result)) {
        $s_id = $row["s_id"];
        $query = "DELETE from watched where u_id='$u_id' AND s_id='$s_id'";
if(mysqli_query($link, $query)){
    header('Location: main.php');
}
else {echo "fail";}
    }}
    ?>
