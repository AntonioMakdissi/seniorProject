<?php
session_start();
if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']) {
	header('Location: ../login.html');
}
?>
<!DOCTYPE html>

<html>

<head>
	<title>Track</title>
	<meta charset="UTF-8" />
</head>
<!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia&effect=fire"> -->

<body>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<div>
		<img src="main.jfif" alt="anime list" style="width:100%">
		<div class="textimg">
			<p class="w3-sofia font-effect-fire  w3-container" style="font-size: xx-large;"><a href="main.php">Delivery# <?= $_SESSION['o_id'] ?></a></p>
			<h3>List of series you watched:</h3>
			<table border="border">
				<thead>
					<tr>
						<th>Date </th>
						<th>Location</th>
						<th>By</th>
					</tr>
				</thead>
				<tbody>
					<?php
					require_once('connection.php');
					$c_id = $_SESSION['c_id'];
					$query = "SELECT * FROM orders NATURAL JOIN deliveries WHERE c_id='$c_id' ORDER BY timestamp";
					$result = mysqli_query($link, $query);
					if (($result) && (mysqli_num_rows($result) > 0)) {
						// echo 'List of series you watched:';

						while ($row = mysqli_fetch_assoc($result)) {
							/*return removed space*/
							$n = $row["current_location"];
							$n = str_replace(" ", "%20", $n);
							echo "<tr>   
							<td>" . $row["timestamp"] . "</td>
							<td>" . $row["current_location"] . "</td>
							<td>" . $row["w_id"] . "</td>
							<td> <a class='btn btn-primary btn-sm' name='n' value='$n' href=http://localhost/web_project/removeseries.php?name=" . $n . ">Remove</a> </td>
							</tr>";
						}
					}
					?>
				</tbody>
			</table>			
			<br />
			

</body>

</html>