<?php
require_once 'connection.php';
$name = $_GET['name'];
$ep_nbr= $_GET['ep_nbr'];
$ep_length = $_GET['ep_length'];

// $query = "SELECT s_id FROM series WHERE name='$name';";
// $result = mysqli_query($link, $query);
// if (($result) && (mysqli_num_rows($result) > 0)) {
//     $row = mysqli_fetch_assoc($result);
//         $s_id = $row["s_id"];
        
     $query = "SELECT * FROM series WHERE name='$name' AND ep_nbr='$ep_nbr'";//check duplicate
    $result = mysqli_query($link, $query);
if (($result) && (mysqli_num_rows($result) < 1)) {
    
$query = "INSERT into series(name,ep_nbr,ep_length) values('$name','$ep_nbr','$ep_length')";
if(mysqli_query($link, $query)){
//echo mysqli_insert_id($link);
    // this returns the id that mysql used for the new tuple
header('Location: seriesList.php');
}
else {echo "-1";}}
echo '<script>alert("Already added!")</script>';
header('Location: seriesList.php');
?>