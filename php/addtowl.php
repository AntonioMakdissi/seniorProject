<?php
session_start();
if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']) {
	header('Location: login.html');
}
require_once 'connection.php';
$u_id=$_SESSION['u_id'];
$name = $_GET['name'];
$name = str_replace("%20"," ",$name);
$query = "SELECT s_id FROM series WHERE name='$name';";
$result = mysqli_query($link, $query);
if (($result) && (mysqli_num_rows($result) > 0)) {
    $row = mysqli_fetch_assoc($result);
        $s_id = $row["s_id"];
        
        $query = "SELECT * FROM watched WHERE u_id='$u_id' AND s_id='$s_id'";//check duplicate
        $result = mysqli_query($link, $query);
if (($result) && (mysqli_num_rows($result) < 1)) {
    

        $query = "INSERT into watched(u_id,s_id) values('$u_id','$s_id')";
        if (mysqli_query($link, $query)) {
            //echo mysqli_insert_id($con);
            // this returns the id that mysql used for the new tuple
            header('Location: seriesList.php');
        } else {
            echo "-1";
        }
        header('Location: seriesList.php');

}
echo '<script>alert("Already added!")</script>';
header('Location: seriesList.php');
}
?>