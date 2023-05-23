<?php
require_once 'connection.php';
if (session_status() == PHP_SESSION_NONE) {
	session_start();
}
if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']) {
	header('Location: login.html');
}

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

function successful_deliveriesm($link)
{
	$month = date('n');
	$query = "SELECT COUNT(o_id) AS success FROM orders WHERE MONTH(orders.date) = $month AND status='successful'";
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

function pending_deliveriesm($link)
{
	$month = date('n');
	$query = "SELECT COUNT(o_id) AS pending FROM orders WHERE MONTH(orders.date) = $month AND status='pending'";
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
function failed_deliveriesm($link)
{
	$month = date('n'); //current month
	$query = "SELECT COUNT(o_id) AS failed FROM orders WHERE MONTH(orders.date) = $month AND status='failed'";
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
	$query = "SELECT workers.w_id, COUNT(deliveries.w_id) AS count
FROM deliveries
JOIN workers ON deliveries.w_id = workers.w_id
JOIN users ON workers.u_id = users.u_id
WHERE users.type='worker'
GROUP BY workers.w_id
ORDER BY count DESC
LIMIT 1;
	";
	$result = mysqli_query($link, $query);
	$row = mysqli_fetch_assoc($result);
	$emp = $row['w_id'];
	return $emp;

	//number of workers
}

function mvpm($link) //employee of the month
{
	$month = date('n'); //current month
	$query = "SELECT workers.w_id, COUNT(deliveries.w_id) AS count
        FROM deliveries
        JOIN workers ON deliveries.w_id = workers.w_id
        JOIN users ON workers.u_id = users.u_id
        WHERE users.type='worker'
        AND MONTH(deliveries.timestamp) = $month
        GROUP BY workers.w_id
        ORDER BY count DESC
        LIMIT 1;
    ";
	$result = mysqli_query($link, $query);
	$row = mysqli_fetch_assoc($result);
	$emp = $row['w_id'];
	return $emp;
}

function delm($link) //deliveries this month
{
	$month = date('n'); //current month
	$query = "SELECT COUNT(o_id) AS count
        FROM orders
        WHERE MONTH(orders.date) = $month
        ;
    ";
	$result = mysqli_query($link, $query);
	$row = mysqli_fetch_assoc($result);
	$delm = $row['count'];
	return $delm;
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
