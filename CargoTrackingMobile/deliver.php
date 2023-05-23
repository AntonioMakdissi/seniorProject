<?php
require_once 'connection.php';

extract($_GET);

$w_id = $_GET['w_id'];
$o_id = $_GET['o_id'];
//$current_location = $_GET['current_location'];

$current_location = str_replace("%20", " ", $_GET['current_location']);

if ($current_location == 'delivered') {
    $query = "UPDATE orders SET status = 'successful' WHERE orders.o_id = '$o_id';";
    if (mysqli_query($con, $query)) {
    }
}
//insert to deliveries 
$query = "INSERT INTO deliveries (w_id,o_id,current_location) VALUES ('$w_id','$o_id','$current_location');";
if (mysqli_query($con, $query)) {
    http_response_code(200);
    echo "OK";
} else {
    http_response_code(400);
    echo "Failed to insert delivery record";
}
