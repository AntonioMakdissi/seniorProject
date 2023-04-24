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