<?php
require_once 'connection.php';
$o_id = $_GET['o_id'];


$getallorders = "SELECT * FROM orders NATURAL JOIN packages NATURAL JOIN clients NATURAL JOIN (
    SELECT o_id, MAX(d_id) AS max_d_id
    FROM deliveries
    GROUP BY o_id
) AS last_delivery
NATURAL JOIN deliveries WHERE o_id='$o_id' AND deliveries.d_id = last_delivery.max_d_id";

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
