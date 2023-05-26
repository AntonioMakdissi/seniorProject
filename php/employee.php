<?php
require_once 'connection.php';
if (session_status() == PHP_SESSION_NONE) {
	session_start();
}


//total deliveries
function getEmpById($link, $w_id)
{
	$query = "SELECT name FROM workers WHERE w_id='$w_id'";
	$result = mysqli_query($link, $query);
	$row = mysqli_fetch_assoc($result);
	$emp = $row['name'];
	return $emp;
}

function getEmpUId($link, $w_id)
{
	$query = "SELECT u_id FROM workers WHERE w_id='$w_id'";
	$result = mysqli_query($link, $query);
	$row = mysqli_fetch_assoc($result);
	$u_id = $row['u_id'];
	return $u_id;
}

function getEmpByEmail($link, $email)
{
	$query = "SELECT u_id FROM users WHERE email='$email'";
	if($result = mysqli_query($link, $query)){
	$row = mysqli_fetch_assoc($result);
	$u_id = $row['u_id'];
	return $u_id;
	}else{
		return -1;
	}
}

function setSalary($link, $w_id, $salary)
{
	$query = "UPDATE workers SET 'salary' = '$salary' WHERE w_id= '$w_id' ";
	if (mysqli_query($link, $query)) {
		echo "done";
	}
}

function promoteManager($link, $w_id, $branch)
{
	$query = "UPDATE workers SET branch='$branch', salary = salary * 1.1 WHERE w_id= '$w_id' ";
	if (mysqli_query($link, $query)) {
		$u_id = getEmpUId($link, $w_id);

		$query = "UPDATE users SET type='BranchManager' WHERE u_id = '$u_id' ";

		if (mysqli_query($link, $query)) {
			return "OK";
		} else {
			return "Error updating record: " . mysqli_error($link);
		}
	} else {
		return "Error updating record: " . mysqli_error($link);
	}
}

function workersavailable($link)
{

	require_once('connection.php');
	$query = "SELECT name,w_id FROM workers NATURAL JOIN users WHERE type = 'worker' ";
	$result = mysqli_query($link, $query);
	if (($result) && (mysqli_num_rows($result) > 0)) {
		$i = 0;
		while ($row = mysqli_fetch_assoc($result)) {
			$messages[0][$i] = $row["w_id"];
			$messages[1][$i] = $row["name"];

			// $messages[2][$i] = $row["dateOfBirth"];
			// $messages[3][$i] = $row["phone"];
			// $messages[4][$i] = $row["branch"];
			// $messages[5][$i] = $row["salary"];
			// $messages[6][$i] = $row["timestamp"];
			++$i;
		}
	} else {
		return -1; //no messages
	}
	return $messages;
}
