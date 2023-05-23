<?php
require_once 'connection.php';
$o_id = $_GET['o_id'];


$getallorders = "SELECT * FROM orders NATURAL JOIN packages NATURAL JOIN deliveries NATURAL JOIN clients WHERE o_id='$o_id'";

$result = mysqli_query($con, $getallorders);
if ($result) {
    $return_array = array();
    while ($row = mysqli_fetch_assoc($result)) {

        array_push($return_array, $row);
    }
    echo json_encode($return_array);
} else {
    echo json_encode(array("error" => "Failed to fetch orders. Please try again later. "));
}
