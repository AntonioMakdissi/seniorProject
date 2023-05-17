<?php
require_once('connection.php');
$query = "SELECT * FROM branches NATURAL JOIN workers NATURAL JOIN users WHERE type='BranchManager' AND NOT (branch='still at client' OR branch='delivered') ORDER BY branch";
	$result = mysqli_query($link, $query);
	$branches[0][0] = 0;
	if (($result) && (mysqli_num_rows($result) > 0)) {
		$i = 0;
		while ($row = mysqli_fetch_assoc($result)) {
			$branches[0][$i] = $row['timestamp'];
			$branches[1][$i] = $row['branch'];
			$branches[2][$i] = $row['name'];
			$branches[3][$i] = $row['email'];
			++$i;
		}
    echo $branches;
	} else {
      echo "No result found.";
    }
    
