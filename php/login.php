<html lang="en">

<head>
	<meta charset="UTF-8">
</head>

<body>
	<?php
	if (isset($_POST['email']) && isset($_POST['password'])) {
		require('connection.php');
		extract($_POST); //$email and $password

		$recaptcha_response = $_POST['g-recaptcha-response'];
		$recaptcha_secret = '6LcKXUAmAAAAANJrDtZklxuRxjZytaxwxQNB_J3r'; // Replace with your secret key obtained from the reCAPTCHA admin console
		$recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';

		$recaptcha = file_get_contents($recaptcha_url . '?secret=' . $recaptcha_secret . '&response=' . $recaptcha_response);
		$recaptcha_data = json_decode($recaptcha);

		if (!$recaptcha_data->success) {
			?>
			<div style="
				display: flex;
				justify-content: center;
				align-items: center;
				height: 100vh;
				background-color: #0e1d34;
				background-image: url('../assets/img/hero-bg.png');
				background-position: center;
				background-repeat: no-repeat;
				background-size: cover;
			">
				<div style="
					width: 300px;
					padding: 20px;
					border-radius: 5px;
					background-color: rgba(255, 255, 255, 0.8);
					box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
					text-align: center;
				">
					<p style="
						margin-bottom: 20px;
						font-size: 16px;
						color: #333;
					">Failed to verify reCAPTCHA. Please try again.</p>
					<a href="../login.php" style="
						display: inline-block;
						padding: 10px 20px;
						background: #0e1d34;
						color: #fff;
						text-decoration: none;
						border-radius: 3px;
					">Back</a>
				</div>
			</div>
			<?php
			exit;
		}
		
		// Proceed with your signup logic if reCAPTCHA is verified successfully

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
					$_SESSION['c_phone'] = $u_info['c_phone'];
					$_SESSION['c_longitude'] = $u_info['c_longitude'];
					$_SESSION['c_latitude'] = $u_info['c_latitude'];
					$_SESSION['c_district'] = $u_info['c_district'];
					$_SESSION['c_timestamp'] = $u_info['c_timestamp'];
					//$_SESSION['guest'] = $u_info['guest'];
					//$_SESSION['rating'] = $u_info['rating'];
					//echo "OK";
					// ob_end_clean(); // clear output buffer
					echo "<script>window.location.href='../client.php';</script>";
					header('Location: ../client.php');
					exit;
				} else {
					$query = "SELECT * FROM workers WHERE u_id = '$u_id';"; //get its info
					$result = mysqli_query($link, $query);
					$u_info = mysqli_fetch_assoc($result);
					$_SESSION['w_id'] = $u_info['w_id'];
					$_SESSION['name'] = $u_info['name'];
					$_SESSION['phone'] = $u_info['phone'];
					$_SESSION['branch'] = $u_info['branch'];
					$_SESSION['dateOfBirth'] = $u_info['dateOfBirth'];
					$_SESSION['salary'] = $u_info['salary'];
					$_SESSION['timestamp'] = $u_info['timestamp'];
					if ($_SESSION['type'] == 'CEO') {
						//echo "OK";
						header('Location: ../CEO.php'); //CEO page
						//echo "CEO";
					} else if ($_SESSION['type'] == 'worker') {
						header('Location: ../branchOrders.php'); //worker page
						//echo "worker";
					} else if ($_SESSION['type'] == 'BranchManager') {
						header('Location: ../branchOrders.php'); //BranchManager page
						//echo "manager";
					} else if ($_SESSION['type'] == 'IT') {
						header('Location: ../viewMessages.php'); //BranchManager page
						//echo "manager";
					}
				}
			} else {
				?>
			<div style="
				display: flex;
				justify-content: center;
				align-items: center;
				height: 100vh;
				background-color: #0e1d34;
				background-image: url('../assets/img/hero-bg.png');
				background-position: center;
				background-repeat: no-repeat;
				background-size: cover;
			">
				<div style="
					width: 300px;
					padding: 20px;
					border-radius: 5px;
					background-color: rgba(255, 255, 255, 0.8);
					box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
					text-align: center;
				">
					<p style="
						margin-bottom: 20px;
						font-size: 16px;
						color: #333;
					">Check email or password. </p>
					<a href="../login.php" style="
						display: inline-block;
						padding: 10px 20px;
						background: #0e1d34;
						color: #fff;
						text-decoration: none;
						border-radius: 3px;
					">Back</a>
				</div>
			</div>
			<?php
				//header('Location: ../login.html'); //if wrong password
			}
		} else {

			?>
			<div style="
				display: flex;
				justify-content: center;
				align-items: center;
				height: 100vh;
				background-color: #0e1d34;
				background-image: url('../assets/img/hero-bg.png');
				background-position: center;
				background-repeat: no-repeat;
				background-size: cover;
			">
				<div style="
					width: 300px;
					padding: 20px;
					border-radius: 5px;
					background-color: rgba(255, 255, 255, 0.8);
					box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
					text-align: center;
				">
					<p style="
						margin-bottom: 20px;
						font-size: 16px;
						color: #333;
					">Please sign up first!</p>
					<a href="../login.php" style="
						display: inline-block;
						padding: 10px 20px;
						background: #0e1d34;
						color: #fff;
						text-decoration: none;
						border-radius: 3px;
					">Back</a>
				</div>
			</div>
			<?php
		}
		mysqli_close($link); //close if error
	} else {
		?>
			<div style="
				display: flex;
				justify-content: center;
				align-items: center;
				height: 100vh;
				background-color: #0e1d34;
				background-image: url('../assets/img/hero-bg.png');
				background-position: center;
				background-repeat: no-repeat;
				background-size: cover;
			">
				<div style="
					width: 300px;
					padding: 20px;
					border-radius: 5px;
					background-color: rgba(255, 255, 255, 0.8);
					box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
					text-align: center;
				">
					<p style="
						margin-bottom: 20px;
						font-size: 16px;
						color: #333;
					">Error fetching information.</p>
					<a href="../login.php" style="
						display: inline-block;
						padding: 10px 20px;
						background: #0e1d34;
						color: #fff;
						text-decoration: none;
						border-radius: 3px;
					">Back</a>
				</div>
			</div>
			<?php //if no email and password

	}

	?>
</body>

</html>