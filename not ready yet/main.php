<?php
session_start();
if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']) {
	header('Location: login.html');
}
?>
<!DOCTYPE html>
<style> 
    .textimg{
        position: absolute;
                top: 5px;
                left: 20px;}
    </style>
<html>

<head>
	<title>Watchlist</title>
	<meta charset="UTF-8" />
</head>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia&effect=fire">
<body>
<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<div class="w3-display-container w3-text-white">
            <img src="main.jfif" alt="anime list" style="width:100%">
			<div class="textimg">
			<p class="w3-sofia font-effect-fire  w3-container" 
        style="font-size: xx-large;" ><a href="main.php">Welcome to your Watchlist <?= $_SESSION['u_name'] ?></a></p>
		<h3>List of series you watched:</h3>
        <table border ="border"> 
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
	$query = "SELECT * FROM series NATURAL JOIN watched WHERE u_id='$uid' ORDER BY name";
	$result = mysqli_query($link, $query);
	if (($result) && (mysqli_num_rows($result) > 0)) {
		// echo 'List of series you watched:';
		// echo '<ul>';
		while ($row = mysqli_fetch_assoc($result)) {
			// echo '<li>' . $row['name'] . '-' . $row['ep_nbr'] . '-' . $row['ep_length'] . '</li>';
			$n = $row["name"];
			$n=str_replace(" ","%20",$n);
			echo "<tr>   
<td>" . $row["name"] . "</td>
<td>" . $row["ep_nbr"] . "</td>
<td>" . $row["ep_length"] . "</td>
<td> <a class='btn btn-primary btn-sm' name='n' value='$n' href=http://localhost/web_project/removeseries.php?name=" . $n . ">Remove</a> </td>
							
</tr>";
		}
    }
    ?>
		</tbody>
</table>
<?php
require_once('connection.php');
$uid = $_SESSION['u_id'];
$query = "SELECT * FROM series NATURAL JOIN watched WHERE u_id='$uid' ORDER BY name";
$result = mysqli_query($link, $query);
if (($result) && (mysqli_num_rows($result) > 0)) {
		echo '<hr />';
		$query = "SELECT SUM(ep_nbr*ep_length) AS total FROM series NATURAL JOIN watched WHERE u_id='$uid'";
		$result = mysqli_query($link, $query);
		$row = mysqli_fetch_assoc($result);
		echo "You have watched for: ";
		$total = $row['total'] / 60;
		if ($total > 24) {
			$total = $total / 24;
			echo $total . "days";
		} else {
			echo $total . " hours ";
		}
	}
	mysqli_close($link);
	?>
	<br/>
	<button name="addSeries" class="w3-container w3-blue">
		<a href="seriesList.php">Add series</a></button>
	<br/>
	</br>
	<button name="logout" class="w3-container w3-blue">
	<a href="logout.php">Logout</a></button>
	
</body>

</html>