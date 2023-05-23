<?php
require_once 'connection.php';
if (session_status() == PHP_SESSION_NONE) {
	session_start();
}
if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']) {
	header('Location: ../login.php');
}

//total deliveries
function all_branches($link)
{
	$query = "SELECT branch FROM branches WHERE NOT (branch='still at client' OR branch='delivered') ORDER BY branch";
	$result = mysqli_query($link, $query);
	$branches = [];
	if (($result) && (mysqli_num_rows($result) > 0)) {
		$i = 0;
		while ($row = mysqli_fetch_assoc($result)) {
			$branches[$i] = $row['branch'];
			++$i;
		}
	}
	return $branches;
}

function all_locations($link)
{
	$query = "SELECT branch FROM branches ORDER BY
	CASE branch
	  WHEN 'still at client' THEN 1
	  WHEN 'delivered' THEN 2
	  ELSE 3
	  END";
	$result = mysqli_query($link, $query);
	$branches = [];
	if (($result) && (mysqli_num_rows($result) > 0)) {
		$i = 0;
		while ($row = mysqli_fetch_assoc($result)) {
			$branches[$i] = $row['branch'];
			++$i;
		}
	}
	return $branches;
}

function branchesinfo($link)
{
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
	} else {
		return -1; //no messages
	}
	return $branches;
}


// <option value="Batroun">Batroun</option>
//                         <option value="Koura">Koura</option>
//                         <option value="Beirut">Beirut</option>
//                         <option value="Tripoli">Tripoli</option>
//                         <option value="Akkar">Akkar</option>
//                         <option value="Mount Lebanon">Mount Lebanon</option>
//                         <option value="Bekaa">Bekaa</option>
//                         <option value="South Lebanon">South Lebanon</option>