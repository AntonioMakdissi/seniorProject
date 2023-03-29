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
			/*debugging
			echo $u_info['email'];
			echo $u_info['passwd'];
			echo md5($password);
		*/
			if (($u_info['email'] == $email) &&
				($u_info['password'] == md5($password))
			) {
				session_start(); //setup session
				$_SESSION['loggedin'] = true;
				$_SESSION['email'] = $u_info['email'];
				$_SESSION['u_id'] = $u_info['u_id'];
				$_SESSION['type'] = $u_info['type'];
				//get his other information?
				if ($_SESSION['type'] == 'client') {
					//client page
				} else if ($_SESSION['type'] == 'CEO') {
					//CEO page
				} else if ($_SESSION['type'] == 'worker') {
					//worker page
				} else if ($_SESSION['type'] == 'BranchManager') {
					//BranchManager page
				}
				header('Location: index.html'); //to be revised
			} else {
				header('Location: login.html'); //if wrong password
			}
		} else {
			header('Location: login.html'); //no return
		}
		mysqli_close($link); //close if error
	} else {
		header('Location: login.html'); //if no email and password

	}

	?>
</body>

</html>