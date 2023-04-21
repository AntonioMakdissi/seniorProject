<?php
// session_start();
// if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin'] || $_SESSION['type']!='CEO') {
//     header('Location: login.html');
// }
require_once 'connection.php';

		//total deliveries
		$query = "SELECT COUNT(o_id) AS total FROM orders";
		$result = mysqli_query($link, $query);
		$row = mysqli_fetch_assoc($result);
		$total = $row['total'] ;
        echo "$total ";

		//successful deliveries
		$query = "SELECT COUNT(o_id) AS success FROM orders WHERE status='successful'";
		$result = mysqli_query($link, $query);
		$row = mysqli_fetch_assoc($result);
		$success = $row['success'] ;
        echo "$success ";

		//pending deliveries
		$query = "SELECT COUNT(o_id) AS pending FROM orders WHERE status='pending'";
		$result = mysqli_query($link, $query);
		$row = mysqli_fetch_assoc($result);
		$pending = $row['pending'] ;
        echo "$pending ";

		//failed deliveries
		$query = "SELECT COUNT(o_id) AS failed FROM orders WHERE status='failed'";
		$result = mysqli_query($link, $query);
		$row = mysqli_fetch_assoc($result);
		$failed = $row['failed'] ;
        echo "$failed ";

		//rating
		$query = "SELECT FORMAT(AVG(rating), 2) AS rating FROM clients";
		$result = mysqli_query($link, $query);
		$row = mysqli_fetch_assoc($result);
		$rating = $row['rating'] ;
        echo "$rating ";

		//employee with most deliveries made
		$query = "SELECT w_id, COUNT(w_id) AS count
		FROM deliveries
		GROUP BY w_id
		ORDER BY count DESC
		LIMIT 1;";
		$result = mysqli_query($link, $query);
		$row = mysqli_fetch_assoc($result);
		$emp = $row['w_id'] ;
        echo "$emp ";

		//number of workers
		$query = "SELECT COUNT(w_id) AS workers FROM workers";
		$result = mysqli_query($link, $query);
		$row = mysqli_fetch_assoc($result);
		$workers = $row['workers'] ;
        echo "$workers ";

		//number of clients
		$query = "SELECT COUNT(c_id) AS clients FROM clients";
		$result = mysqli_query($link, $query);
		$row = mysqli_fetch_assoc($result);
		$clients = $row['clients'] ;
        echo "$clients ";

		//number of branches
		$query = "SELECT COUNT(branch) AS branches FROM branches";
		$result = mysqli_query($link, $query);
		$row = mysqli_fetch_assoc($result);
		$branches = $row['branches'] ;
        echo "$branches ";


