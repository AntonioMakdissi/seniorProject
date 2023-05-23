<?php
require_once 'connection.php';

//$w_id = $_GET['w_id'];

// $query = "SELECT branch FROM branches ORDER BY
// 	CASE branch
// 	  WHEN 'still at client' THEN 1
// 	  WHEN 'delivered' THEN 2
// 	  ELSE 3
// 	  END";

$query = "SELECT branch FROM branches WHERE NOT branch='still at client' ORDER BY
	CASE branch
	  WHEN 'delivered' THEN 1
	  ELSE 2
	  END";
$result = mysqli_query($con, $query);
$branches = [];
if (($result) && (mysqli_num_rows($result) > 0)) {
    $i = 0;
    while ($row = mysqli_fetch_assoc($result)) {
        $branches[$i] = $row['branch'];
        ++$i;
    }
    echo json_encode($branches);
} else {
    echo json_encode(array("error" => "Failed to fetch orders. Please try again later. "));
}
