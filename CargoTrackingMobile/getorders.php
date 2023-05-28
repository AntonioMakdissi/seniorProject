<?php
require_once 'connection.php';
$w_id = $_GET['w_id'];

$query = "SELECT branch FROM workers WHERE w_id='$w_id';";
$result = mysqli_query($con, $query);
if (($result) && (mysqli_num_rows($result) > 0)) {
    $row = mysqli_fetch_assoc($result);
    $branch = $row["branch"];
    $getallorders = "SELECT *
    FROM orders
    NATURAL JOIN packages NATURAL JOIN clients
    NATURAL JOIN (
        SELECT o_id, MAX(d_id) AS max_d_id
        FROM deliveries
        GROUP BY o_id
    ) AS last_delivery
    NATURAL JOIN deliveries
    WHERE (current_location = '$branch'
    OR (current_location='still at client' AND c_district='$branch'))
    AND status = 'pending'
    AND deliveries.d_id = last_delivery.max_d_id
    ORDER BY urgent DESC, date
    ";

    $result = mysqli_query($con, $getallorders);
    if ($result) {
        $return_array = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $row_array['o_id'] = $row['o_id'];
            $row_array['urgent'] = $row['urgent'];
            $row_array['to_name'] = $row['to_name'];
            $row_array['to_district'] = $row['to_district'];
            $row_array['to_address'] = $row['to_address'];
            array_push($return_array, $row_array);
        }
        echo json_encode($return_array);
    } else {
        echo json_encode(array("error" => "Failed to fetch orders. Please try again later. "));
    }
} else {
    echo json_encode(array("error" => "Invalid worker ID.$w_id"));
}
