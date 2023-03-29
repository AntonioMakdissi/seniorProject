<?php
session_start();
if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']) {
	header('Location: login.html');
}
?>
<!DOCTYPE html>
<style>
	.textimg {
		position: absolute;
		top: 5px;
		left: 20px;
	}

	.left {
		position: relative;
		left: 100px;
	}
</style>
<html>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

<head>
	<title>Watchlist</title>
	<meta charset="UTF-8" />
</head>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia&effect=fire">

<body>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<div class="w3-display-container w3-text-white">
		<img src="dead.tiff" alt="anime list" style="width:100%">
		<div class="textimg">
			<p class="w3-sofia font-effect-fire  w3-container" style="font-size: xx-large;"><a href="main.php">Series list</a></p>
			<!-- <h1> </h1> -->
			<h3><strong>Choose one of the below series:</strong></h3>
			<table border="border">
				<thead>
					<tr>
						<th>Series name </th>
						<th>Number of episodes</th>
						<th>Episode length </th>
					</tr>
				</thead>
				<tbody>
					<?php
					require_once('connection.php');
					$uid = $_SESSION['u_id'];
					$query = "SELECT * from series";
					$result = mysqli_query($link, $query);
					if (($result) && (mysqli_num_rows($result) > 0)) {
						echo '<ul>';
						while ($row = mysqli_fetch_assoc($result)) {
							// 	echo '<a href=http://localhost/web_project/main.php><li> ' . $row['name'] . '-' . $row['ep_nbr'] . '-' . $row['ep_length'] . '</li></a>';
							// echo "<tr>

							// </tr>"
							$n = $row["name"];
							$n=str_replace(" ","%20",$n);
							//echo $n;
							echo "<tr>   
							<td>" . $row["name"] . "</td>
							<td>" . $row["ep_nbr"] . "</td>
							<td>" . $row["ep_length"] . "</td>
							<td> <a class='btn btn-primary btn-sm' name='n' value='$n' href=http://localhost/web_project/addtowl.php?name=" . $n . ">Add series</a> </td>
							</tr>";
						}
						// echo '<hr />';
					}
					mysqli_close($link);
					?>
				</tbody>
			</table>
				</br>
			<a class='btn btn-primary btn-sm' name='goback' href=http://localhost/web_project/main.php>Back to Watchlist</a> </td>
							

			<form method="GET" action="addSeries.php">
				<!-- <hr> -->
				<h3><strong>Do not see your series?</Strong></h3>
				<div>Series name:
					<input class="w3-input w3-border w3-animate-input" type="text" style="width:30%" name="name" size="25" maxlength="25" id="usn" style="position: relative; left:88px;" />
				</div>
				<p></p>
				<div> Number of episodes: <input class="w3-input w3-border w3-animate-input" type="number" style="width:30%" name="ep_nbr" size="25" maxlength="25" id="nbr" style="position: relative; left:32px;" /></div>
				<p></p>
				<div> Episode length: <input class="w3-input w3-border w3-animate-input" type="number" style="width:30%" name="ep_length" size="25" maxlength="25" id="len" style="position: relative; left:70px;" /></div>
				<p></p>
				<input type="submit" value="Add series" name="addSeries" class="w3-container w3-blue">
				</br>
				<a href="logout.php">Logout</a>
			</form>
			<br />

		</div>
</body>

</html>