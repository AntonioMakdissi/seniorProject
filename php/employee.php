<?php
require_once 'connection.php';

//total deliveries
function getEmpById($link,$w_id)
{
	$query = "SELECT name FROM workers WHERE w_id='$w_id'";
	$result = mysqli_query($link, $query);
	$row = mysqli_fetch_assoc($result);
	$emp = $row['name'];
	return $emp;
}

function getEmpUId($link,$w_id)
{
	$query = "SELECT u_id FROM workers WHERE w_id='$w_id'";
	$result = mysqli_query($link, $query);
	$row = mysqli_fetch_assoc($result);
	$u_id = $row['u_id'];
	return $u_id;
}

function setSalary($link,$w_id,$salary){
	$query = "UPDATE workers SET 'salary' = '$salary' WHERE w_id= '$w_id' ";
	if (mysqli_query($link, $query)) {
        echo "done";
        
    }
}

function promoteManager($link,$w_id,$branch){
	$query = "UPDATE `workers` SET `branch`='$branch','salary' = 'salary' * 1.1 WHERE w_id= '$w_id' ";
	
	if (mysqli_query($link, $query)) {
		$u_id=getEmpUId($link,$w_id);
		$query="UPDATE `users` SET `type`='BranchManager' WHERE u_id = '$u_id' ";

		if (mysqli_query($link, $query)) {
			echo "done";
			
		}
        
    }
}

