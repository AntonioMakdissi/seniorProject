<html lang="en">

<head>
	<meta charset="UTF-8">

	<title>Document</title>
</head>

<body>
	<?php

	if (isset($_POST['email']) && isset($_POST['password'])) {
		require('connection.php');
		extract($_POST); //$email and $password
		$email = mysqli_real_escape_string($link, $email); //strip email from escape charcters

		$query = "SELECT * FROM users WHERE email = '$email';"; //get its info

		$result = mysqli_query($link, $query); // this returns the id that mysql used for the tuple

		if (($result) && (mysqli_num_rows($result) == 1)) {
			$u_info = mysqli_fetch_assoc($result);

			if (($u_info['email'] == $email) &&
				($u_info['password'] == md5($password))
			) {
				session_start(); //setup session
				$_SESSION['loggedin'] = true;
				$_SESSION['email'] = $u_info['email'];
				$_SESSION['u_id'] = $u_info['u_id'];
				$u_id = $_SESSION['u_id'];
				$_SESSION['type'] = $u_info['type'];
				//get his other information?

				if ($_SESSION['type'] == 'client') {
					$query = "SELECT * FROM clients WHERE u_id = '$u_id';"; //get its info
					$result = mysqli_query($link, $query);
					$u_info = mysqli_fetch_assoc($result);
					$_SESSION['c_id'] = $u_info['c_id'];
					$_SESSION['c_name'] = $u_info['c_name'];
					$_SESSION['c_address'] = $u_info['c_address'];
					$_SESSION['c_longitude'] = $u_info['c_longitude'];
					$_SESSION['c_latitude'] = $u_info['c_latitude'];
					$_SESSION['c_district'] = $u_info['c_district'];
					$_SESSION['c_timestamp'] = $u_info['c_timestamp'];
					//$_SESSION['guest'] = $u_info['guest'];
					//$_SESSION['rating'] = $u_info['rating'];
					header('Location: ../client.php');
					//$c_id = $_SESSION['c_id'];
					//echo "$c_id";
				} else {
					$query = "SELECT * FROM workers WHERE u_id = '$u_id';"; //get its info
					$result = mysqli_query($link, $query);
					$u_info = mysqli_fetch_assoc($result);
					$_SESSION['w_id'] = $u_info['w_id'];
					if ($_SESSION['type'] == 'CEO') {
						header('Location: ../CEO.php'); //CEO page
						//echo "CEO";
					} else if ($_SESSION['type'] == 'worker') {
						header('Location: ../worker.php'); //worker page
						//echo "worker";
					} else if ($_SESSION['type'] == 'BranchManager') {
						header('Location: ../manager.php'); //BranchManager page
						//echo "manager";
					} else if ($_SESSION['type'] == 'IT') {
						header('Location: ../IT.php'); //BranchManager page
						//echo "manager";
					}
				}
				header('Location: ../login.html'); //to be revised
				//echo "1";
			} else {
				header('Location: ../login.html'); //if wrong password
			}
		} else {
			header('Location: ../login.html'); //no return
		}
		mysqli_close($link); //close if error
	} else {
		header('Location: ../login.html'); //if no email and password

	}

	?>
</body>

</html>