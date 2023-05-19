<?php
session_start();
if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin'] || ($_SESSION['type'] != 'IT' && $_SESSION['type'] != 'CEO')) {
  header('Location: ../login.php');
}
?>
<!DOCTYPE html>
<html>

<head>
  <title>Workers</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
  <title>IT Page</title>
  <link rel="stylesheet" href="../assets/css/header.css">
  <link href="../assets/css/viewWorker.css" rel="stylesheet">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
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

<body class="bg-gray-100">
  <header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">
      <?php
      if ($_SESSION['type'] == 'CEO') {
      ?>
        <a href="../CEO.php" class="logo d-flex align-items-center">
          <!-- Uncomment the line below if you also wish to use an image logo -->
          <!-- <img src="assets/img/logo.png" alt=""> -->
          <h1 style="font-family: 'Libre Baskerville', serif; padding-left: 20px;">SpeedRun</h1>
        </a>
      <?php } else { ?>
        <a href="../IT.php" class="logo d-flex align-items-center">
          <!-- Uncomment the line below if you also wish to use an image logo -->
          <!-- <img src="assets/img/logo.png" alt=""> -->
          <h1 style="font-family: 'Libre Baskerville', serif; padding-left: 20px; padding-top: 20px;">SpeedRun</h1>
        </a>
      <?php } ?>
      <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
      <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>
      <nav id="navbar" class="navbar">
        <?php
        if ($_SESSION['type'] == 'CEO') {
        ?>
          <ul>
            <li><a href="../CEO.php">Home</a></li>
            <li><a href="viewWorker.php" class="active">Workers</a></li>
            <li><a href="../hire.php">Hire</a></li>
            <li><a href="../addBranches.php">Branches</a></li>
            <li><a href="profit.php">Statistics</a></li>
            <li><a href="../viewMessages.php">Messages</a></li>
            <li><a class="get-a-quote" href="logout.php">Logout</a></li>
          </ul>

        <?php } else { ?>
          <ul>
            <li><a href="viewWorker.php" class="active">Workers</a></li>
            <li><a href="../hire.php">Hire</a></li>
            <li><a href="../addBranches.php">Branches</a></li>
            <li><a href="../viewMessages.php">Messages</a></li>
            <li><a href="../common_password.php">Change Password</a></li>
            <li><a class="get-a-quote" href="logout.php">Logout</a></li>
          </ul>
        <?php } ?>
      </nav><!-- .navbar -->
    </div>
  </header><!-- End Header -->


  <section id="hero" class="hero d-flex align-items-center" style="padding-top: 20px; height: 100%; ">
    <div class="container mx-auto px-4 py-12">
      <div class="container" style="margin-top: 5%">
        <h1 style="color:white ;text-align: center; font-size:2em; ">Workers</h1>

        <form style="z-index: 9999;" id="searchForm" action="viewWorker.php" method="post">
          <div class="search-container">
            <label for="search-input" class="search-label">Search for Worker:</label>
            <input class="search-input" name="worker" type="text" id="search-input" placeholder="Enter worker name, ID, or branch">
            <button class="search-button" name="submit" type="submit" id="searchButton">Search</button>
        </form>
        <a href="http://localhost/seniorProject/php/viewWorker.php"><button class="show-all-button" name="show" type="submit" id="showButton">Show All</button> </a>
      </div>

      <table class="table table-striped">
        <thead>
          <tr>
            <th>Worker ID</th>
            <th>Name</th>
            <th>BirthDate</th>
            <th>Phone</th>
            <th>Type</th>
            <th>Branch</th>
            <th>Salary</th>
            <th>Date joined</th>
            <?php
            if ($_SESSION['type'] == 'IT') {
            ?>
              <th>Passwords</th>
            <?php } ?>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
          require_once 'connection.php';
          $query = 0;
          if (isset($_POST['submit'])) {
            $selected_worker = $_POST['worker'];

            $query = "SELECT * FROM workers NATURAL JOIN users WHERE ( name LIKE '$selected_worker%' OR w_id LIKE'$selected_worker%' OR branch LIKE '$selected_worker%') AND type != 'CEO' ORDER BY w_id ASC";
          } else {

            $query = "SELECT * FROM workers NATURAL JOIN users ORDER BY w_id ASC";
          }
          $result = mysqli_query($link, $query);
          if (($result) && (mysqli_num_rows($result) > 0)) {


            while ($row = mysqli_fetch_assoc($result)) {

              $rmid = $row["u_id"];
              echo "<tr>   
                <td>#" . $row["w_id"] . "</td>
                <td>" . $row["name"] . "</td>
                <td>" . $row["dateOfBirth"] . "</td>
                <td>" . $row["type"] . "</td>
                <td>" . $row["phone"] . "</td>
                <td>" . $row["branch"] . "</td>
                <td>" . $row["salary"] . "$</td>
                <td>" . $row["timestamp"] . "</td> ";
          ?>

              <!-- Change password button -->
              <?php
              if ($_SESSION['type'] == 'IT') {
              ?>
                <td>
                  <!-- The button that will trigger the modal -->
                  <button type="button" class="btn btn-primary change-password-button" data-toggle="modal" data-target="#changePasswordModal" data-workerid="<?php echo $row["u_id"]; ?>">
                    Change
                  </button>
                </td>

              <?php } ?>


              <?php
              if ($row["type"] == 'CEO' || $row["w_id"] == $_SESSION['w_id']) {
                echo "                <td></td>                
                 </tr>";
              } else {
              ?>
                <td> <button type="submit" class="custom-button" onclick="fireWorker('<?php echo $rmid; ?>')">Fire</button></a> </td>


                </tr>
          <?php
              }
            }
          } else {
            echo "error";
          }

          ?>
        </tbody>
      </table>


      <!-- Popup modal change password-->
      <div class="fixed z-10 inset-0 overflow-y-auto hidden" id="changePasswordModal">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
          <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
          </div>
          <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
          <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
              <div class="sm:flex sm:items-start">
                <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                  <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-headline">
                    Change Password
                  </h3>
                  <div class="mt-2">
                    <form id="changePasswordForm" method="POST" action="changePass.php">
                      <div class="form-group">
                        <label for="newPassword" class="block text-sm font-medium text-gray-700">New Password</label>
                        <input name="newPassword" type="password" class="mt-1 form-control block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" id="newPassword" placeholder="New Password">
                      </div>
                      <div class="form-group">
                        <label for="confirmPassword" class="block text-sm font-medium text-gray-700">Confirm
                          Password</label>
                        <input name="confirmPassword" type="password" class="mt-1 form-control block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" id="confirmPassword" placeholder="Confirm Password">
                      </div>
                      <p id="passwordMatchError" class="hidden text-red-500 mt-1">Passwords do not match. Please try
                        again.</p>
                      <p id="passwordChangeError" class="hidden text-red-500 mt-1">There was an error changing the
                        password. Please try again.</p>
                      <input type="hidden" name="u_id" value="">

                  </div>
                </div>
              </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
              <button type="submit" id="submitChangePassword" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:ml-3 sm:w-auto sm:text-sm">
                Save changes
              </button>
              <button type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm" id="modalCloseButton">
                Cancel
              </button>
              </form>
            </div>
          </div>
        </div>
      </div>

    </div>
    </div>
  </section>

  <script>
    function fireWorker(rmid) {
      if (confirm('Are you sure you want to fire this worker?')) {
        window.location.href = 'http://localhost/seniorProject/php/fireworker.php?rmid=' + rmid;
      }
    }
  </script>

  <!-- script for change password popuup -->
  <script>
    $(document).ready(function() {
      // Event handler for the change password button
      $('.change-password-button').click(function(event) {
        // Retrieve the worker ID from the data attribute
        var workerId = $(this).data('workerid');
        // Set the worker ID value in the hidden input field
        $('#changePasswordForm input[name="u_id"]').val(workerId);

        $('#changePasswordModal').data('workerid', workerId);
        $('#changePasswordModal').removeClass('hidden');
        $('#passwordMatchError').addClass('hidden');
        $('#passwordChangeError').addClass('hidden');
        $('#newPassword').val(''); // Clear newPassword field
        $('#confirmPassword').val(''); // Clear confirmPassword field
      });

      $('#submitChangePassword').click(function(event) {
        var workerId = $('#changePasswordModal').data('workerid');
        var newPassword = $('#newPassword').val();
        var confirmPassword = $('#confirmPassword').val();
        var hasError = false;

        if (newPassword !== confirmPassword) {
          $('#passwordMatchError').removeClass('hidden');
          $('#passwordChangeError').addClass('hidden');
          hasError = true;
        } else {
          $('#passwordMatchError').addClass('hidden');
        }

        if (!hasError) {
          // Make AJAX request to server to change password
          $.ajax({
            type: 'POST',
            url: '/change-password', // Update this to your server's change password URL
            data: {
              workerId: workerId,
              newPassword: newPassword
            },
            success: function(response) {
              alert("Password changed successfully!");
              $('#changePasswordModal').addClass('hidden');
              $('#newPassword').val(''); // Clear newPassword field
              $('#confirmPassword').val(''); // Clear confirmPassword field
            },
            error: function(err) {
              $('#passwordChangeError').removeClass('hidden');
              $('#passwordMatchError').addClass('hidden');
            }
          });
        }
      });

      $('#modalCloseButton').click(function(event) {
        $('#changePasswordModal').addClass('hidden');
        $('#passwordMatchError').addClass('hidden');
        $('#passwordChangeError').addClass('hidden');
        $('#newPassword').val(''); // Clear newPassword field
        $('#confirmPassword').val(''); // Clear confirmPassword field
      });
    });
  </script>


</body>

</html>