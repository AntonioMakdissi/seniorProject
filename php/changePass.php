<?php
require_once 'connection.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']) {
    header('Location: ../login.php');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['newPassword']) && !empty($_POST['newPassword'])) {
        $u_id = $_POST['u_id'];
        $newPassword = $_POST['newPassword'];
        $confirmPassword = $_POST['confirmPassword'];
        if ($newPassword != $confirmPassword) {
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
					">Passwords don't match.</p>
					<button href="" onclick="goBack()" style="
						display: inline-block;
						padding: 10px 20px;
						background: #0e1d34;
						color: #fff;
						text-decoration: none;
						border-radius: 3px;
					">Back</button>
				</div>
			</div>
            <script>
            function goBack() {
                window.history.back();
            }
        </script>
			<?php
        } else
            setpassword($link, $u_id, $newPassword);
    } else {
        // $newPassword = $_POST['newPassword'];
        // echo $newPassword . "new pass";//debugging
        // $confirmPassword = $_POST['confirmPassword'];
        // echo $confirmPassword . "conf pass";
        echo "no password";
    }
}

function setpassword($link, $u_id, $newPassword)
{
    // Retrieve the current password from the database
    $query = "SELECT password FROM users WHERE u_id = '$u_id'";
    $result = mysqli_query($link, $query);
    $row = mysqli_fetch_assoc($result);
    $oldPassword = $row['password'];
    $newPassword = md5($newPassword);

    // Check if the new password is different from the old password
    if ($newPassword === $oldPassword) {
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
                ">Error: The new password must be different from the old password.</p>
                <button  onclick="goBack()" style="
                    display: inline-block;
                    padding: 10px 20px;
                    background: #0e1d34;
                    color: #fff;
                    text-decoration: none;
                    border-radius: 3px;
                ">Back</button>
            </div>
            <script>
            function goBack() {
                window.history.back();
            }
        </script>
            <?php
        return;
    }

    // Update the password if it's different from the old password
    $query = "UPDATE users SET password = '$newPassword' WHERE u_id = '$u_id'";
    if (mysqli_query($link, $query)) {
        //echo "Password updated successfully.";
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
                ">Password changed successfully!</p>
                <button href="" onclick="goBack()" style="
                    display: inline-block;
                    padding: 10px 20px;
                    background: #0e1d34;
                    color: #fff;
                    text-decoration: none;
                    border-radius: 3px;
                ">Back</button>
            </div>
        </div>
        <script>
            function goBack() {
                window.history.back();
            }
        </script>
    <?php //if no email and password

    } else {
        echo "Error updating password: " . mysqli_error($link);
    }
}