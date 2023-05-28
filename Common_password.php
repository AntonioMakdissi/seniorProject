<?php
session_start();
if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']) {
    header('Location: login.php');
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Passwords</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
    <title>Password Page</title>
    <link rel="stylesheet" href="assets/css/header.css">
    <link rel="stylesheet" href="assets/css/password.css">

      <!-- Favicons -->
  <link href="assets/img/icon.jfif" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Inter:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <!-- <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet"> -->
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
    <link href="assets/vendor/aos/aos.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <style>

    </style>

</head>

<body class="bg-gray-100" id="change-password-page">
    <header id="header" class="header d-flex align-items-center fixed-top">
        <div class="container-fluid container-xl d-flex align-items-center justify-content-between">
            <?php
            if ($_SESSION['type'] == 'CEO') {
            ?>
                <a href="CEO.php" class="logo d-flex align-items-center">
                    <h1 style="font-family: 'Libre Baskerville', serif; padding-left: 20px;">SpeedRun</h1>
                </a>
                <nav id="navbar" class="navbar">
                    <ul><li><a href="CEO.php" class="active">Home</a></li>
          <li><a href="php/viewWorker.php">Workers</a></li>
          <li><a href="hire.php">Hire</a></li>
          <li><a href="addBranches.php">Branches</a></li>
          <li><a href="php/profit.php">Statistics</a></li>
          <li><a href="viewMessages.php">Messages</a></li>
          <li><a href="common_password.php">Change Password</a></li>
          <li><a class="get-a-quote" href="php/logout.php">Logout</a></li>
                    </ul>

                <?php } else  if ($_SESSION['type'] == 'IT') { ?>
                    <a href="viewMessages.php" class="logo d-flex align-items-center">
                        <!-- Uncomment the line below if you also wish to use an image logo -->
                        <!-- <img src="assets/img/logo.png" alt=""> -->
                        <h1 style="font-family: 'Libre Baskerville', serif; padding-left: 20px;">SpeedRun</h1>
                    </a>

                    <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
                    <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>
                    <nav id="navbar" class="navbar">
                        <ul>
                            <li><a href="php/viewWorker.php">Workers</a></li>
                            <li><a href="hire.php">Hire</a></li>
                            <li><a href="addBranches.php" class="active">Branches</a></li>
                            <li><a href="viewMessages.php">Messages</a></li>
                            <li><a href="common_password.php">Change Password</a></li>
                            <li><a class="get-a-quote" href="php/logout.php">Logout</a></li>
                        </ul>
                    </nav>
                <?php } else if ($_SESSION['type'] == 'BranchManager') { ?>
                    <a href="branchOrders.php" class="logo d-flex align-items-center">
                        <h1 style="font-family: 'Libre Baskerville', serif; padding-left: 20px;">SpeedRun</h1>
                    </a>

                    <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
                    <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>
                    <nav id="navbar" class="navbar">
                    <ul>
            <!-- <li><a href="client.html" class="active">Home</a></li> -->
            <li><a href="branchOrders.php">Home</a></li>
            <li><a href="manager.php">History</a></li>
            <li><a href="outsidetrack.php">Track</a></li>
            <li><a href="viewMessages.php">Messages</a></li>
            <li><a href="common_password.php">Change Password</a></li>
            <li><a class="get-a-quote" href="php/logout.php">Logout</a></li>
          </ul>
                    </nav>
                <?php } else if ($_SESSION['type'] == 'worker') { ?>
                    <a href="branchOrders.php" class="logo d-flex align-items-center">
                        <h1 style="font-family: 'Libre Baskerville', serif; padding-left: 20px;">SpeedRun</h1>
                    </a>

                    <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
                    <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>
                    <nav id="navbar" class="navbar">
                    <ul>
                        <li><a href="branchOrders.php">Home</a></li>
                        <li><a href="viewMessages.php">Messages</a></li>
                        <li><a href="common_password.php">Change Password</a></li>
                        <li><a class="get-a-quote" href="php/logout.php">Logout</a></li>
                    </ul>
                    </nav>
                <?php } else { ?>
                    <a href="client.php" class="logo d-flex align-items-center">
                        <h1>SpeedRun</h1>
                    </a>

                    <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
                    <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>
                    <nav id="navbar" class="navbar">
                    <ul>
          <li><a href="client.php" class="active">Home</a></li>
          <li><a href="services.php">Services</a></li>
          <li><a href="php/history.php">History</a></li>
          <li><a href="php/track.php">Track</a></li>
          <li><a href="viewMessages.php">Messages</a></li>
          <li><a href="common_password.php">Change Password</a></li>
          <li><a class="get-a-quote" href="php/logout.php">Logout</a></li>
        </ul>
                    </nav>
                <?php } ?>
        </div>
    </header><!-- End Header -->
    <section id="hero" class="hero d-flex align-items-center" style="padding-top: 20px; height: 100%; ">
        <div class="container mx-auto px-4 py-12" style="margin-top:5%;">
            <div class="container" style="margin-top: 5%">
                <h1 style="color:white; text-align: center; font-size: 2em; padding-bottom: 5%;">Change Password</h1>
                <form id="changePasswordForm" method="POST" action="php/changePass.php" onsubmit="return changePassword();">
                    <div class="form-group">
                        <label for="newPassword">New Password:</label>
                        <input required name="newPassword" type="password" class="form-control" id="newPassword" placeholder="New Password">
                    </div>
                    <div class="form-group">
                        <label for="confirmPassword">Confirm Password:</label>
                        <input required name="confirmPassword" type="password" class="form-control" id="confirmPassword" placeholder="Confirm Password">
                    </div>
                    <input type="hidden" name="u_id" value="<?php echo $_SESSION['u_id']; ?>">

                    <button type="submit" id="submitChangePassword" class="btn">Change Password</button>

                    <button type="button" id="cancelChangePassword" class="btn btn-secondary">Cancel</button>
                </form>
                <div id="passwordMatchError" class="error-message hidden">Passwords do not match. Please try again.
                </div>
                <div id="passwordChangeError" class="error-message hidden">There was an error changing the password.
                    Please
                    try again.</div>
                <div id="emptyFieldsError" class="error-message hidden">Please fill in all fields.</div>
            </div>

        </div>
    </section>

    <script>
        $(document).ready(function() {
            const changePasswordButton = $('#submitChangePassword');
            const cancelButton = $('#cancelChangePassword');
            const passwordMatchError = $('#passwordMatchError');
            const passwordChangeError = $('#passwordChangeError');
            const emptyFieldsError = $('#emptyFieldsError');
            const newPasswordInput = $('#newPassword');
            const confirmPasswordInput = $('#confirmPassword');

            // Reset password fields and error messages
            function resetForm() {
                newPasswordInput.val('');
                confirmPasswordInput.val('');
                passwordMatchError.addClass('hidden');
                passwordChangeError.addClass('hidden');
                emptyFieldsError.addClass('hidden');
            }

            // Validate and process password change
            function changePassword() {
                const newPassword = $("#newPassword").val();
                const confirmPassword = $("#confirmPassword").val();

                if (newPassword === '' || confirmPassword === '') {
                    // Display error message if any of the fields are empty
                    emptyFieldsError.removeClass('hidden');
                    passwordMatchError.addClass('hidden');
                    passwordChangeError.addClass('hidden');
                    return false;
                } else if (newPassword !== confirmPassword) {
                    // Display error message if passwords do not match
                    passwordMatchError.removeClass('hidden');
                    passwordChangeError.addClass('hidden');
                    emptyFieldsError.addClass('hidden');
                    return false;
                } else {
                    emptyFieldsError.addClass('hidden');
                    passwordMatchError.addClass('hidden');
                    // Simulate AJAX request to server to change password
                    // Replace with your actual AJAX code
                    // success callback
                    resetForm();
                    // <php 
                    // if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    // include_once("php/connection.php");
                    // include_once("php/changePass.php");
                    // setpassword($link,$_SESSION['u_id'],$newPassword);
                    // }
                    return newPassword;
                    // ?>
                }
            }

            //changePasswordButton.on('click', changePassword);
            cancelButton.on('click', resetForm);
        });
    </script>
</body>

</html>