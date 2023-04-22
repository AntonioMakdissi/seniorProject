<?php
// session_start();
// if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin'] || $_SESSION['type']!='CEO') {
//     header('Location: login.html');
// }
require_once 'connection.php';

//total deliveries
function total_deliveries($link)
{
	$query = "SELECT COUNT(o_id) AS total FROM orders";
	$result = mysqli_query($link, $query);
	$row = mysqli_fetch_assoc($result);
	$total = $row['total'];
	return $total;
}

//successful deliveries
function successful_deliveries($link)
{
	$query = "SELECT COUNT(o_id) AS success FROM orders WHERE status='successful'";
	$result = mysqli_query($link, $query);
	$row = mysqli_fetch_assoc($result);
	$success = $row['success'];
	return $success;
}

//pending deliveries
function pending_deliveries($link)
{
	$query = "SELECT COUNT(o_id) AS pending FROM orders WHERE status='pending'";
	$result = mysqli_query($link, $query);
	$row = mysqli_fetch_assoc($result);
	$pending = $row['pending'];
	return $pending;

	//failed deliveries
}
function failed_deliveries($link)
{
	$query = "SELECT COUNT(o_id) AS failed FROM orders WHERE status='failed'";
	$result = mysqli_query($link, $query);
	$row = mysqli_fetch_assoc($result);
	$failed = $row['failed'];
	return $failed;

	//rating
}
function rating($link)
{
	$query = "SELECT FORMAT(AVG(rating), 2) AS rating FROM clients";
	$result = mysqli_query($link, $query);
	$row = mysqli_fetch_assoc($result);
	$rating = $row['rating'];
	return $rating;

	//employee with most deliveries made
}
function mvp($link)
{
	$query = "SELECT w_id, COUNT(w_id) AS count
		FROM deliveries
		GROUP BY w_id
		ORDER BY count DESC
		LIMIT 1;";
	$result = mysqli_query($link, $query);
	$row = mysqli_fetch_assoc($result);
	$emp = $row['w_id'];
	return $emp;

	//number of workers
}
function nbr_workers($link)
{
	$query = "SELECT COUNT(w_id) AS workers FROM workers";
	$result = mysqli_query($link, $query);
	$row = mysqli_fetch_assoc($result);
	$workers = $row['workers'];
	return $workers;

	//number of clients
}
function nbr_clients($link)
{
	$query = "SELECT COUNT(c_id) AS clients FROM clients";
	$result = mysqli_query($link, $query);
	$row = mysqli_fetch_assoc($result);
	$clients = $row['clients'];
	return $clients;
}

//nbr branches
function nbr_branches($link)
{
	$query = "SELECT COUNT(branch) AS branches FROM branches";
	$result = mysqli_query($link, $query);
	$row = mysqli_fetch_assoc($result);
	$branches = $row['branches'];
	return $branches;
}
