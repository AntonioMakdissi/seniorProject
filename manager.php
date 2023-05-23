<?php
session_start();
if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']) {
  header('Location: login.php');
} ?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
  <title>
    Profit
  </title>
  <link rel="stylesheet" href="../assets/css/header.css">
  <link rel="stylesheet" href="../assets/css/manager.css">
  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Inter:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <!-- <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">-->
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">

</head>

<body>
  <header id="header" class="header d-flex alignems-center fixed-top ">
    <div class="container-fluid container-xl d-flex alignems-center justify-content-between">

      <a href="index.html" class="logo d-flex alignems-center">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="assets/img/logo.png" alt=""> -->
        <h1 style="font-family: 'Libre Baskerville', serif;">SpeedRun</h1>
      </a>

      <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
      <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>
      <nav id="navbar" class="navbar">
        <ul>
          <!-- <li><a href="client.html" class="active">Home</a></li> -->
          <li><a href="branchOrders.php">Home</a></li>
          <li><a href="php/manager.php">History</a></li>
          <li><a href="php/track.php">Track</a></li>
          <li><a href="viewMessages.php">Messages</a></li>
          <li><a href="common_password.php">Change Password</a></li>
          <li><a class="get-a-quote" href="php/logout.php">Logout</a></li>
        </ul>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->

  <section id="hero" class="hero " style="padding-top: 20px; height: 100%; ">
    <div class="container">
      <div class="container mx-auto px-4 py-12">
        <h1 class="text-4xl font-bold mb-6" style="color:white;">Orders history</h1>
        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg mb-8">

          <table class="table table-striped">
            <thead>
              <tr>
                <th>Order number </th>
                <th>From</th>
                <th>Phone number</th>
                <th>Address</th>
                <th>Current location</th>
                <th>To</th>
                <th>Phone number</th>
                <th>Last stop</th>
                <th>Drop off address</th>
                <th>Price for customer</th>
                <th>Cash?</th>
                <th>Fragile?</th>
                <th>Status</th>
                <th>Date and time</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
              require_once('php/connection.php');
              $current_location = $_SESSION['branch'];
              $query = 0;
              if (isset($_GET['status'])) {
                $status = $_GET['status'];

                $query = "SELECT * FROM orders NATURAL JOIN packages NATURAL JOIN clients
                NATURAL JOIN (
                    SELECT o_id, MAX(d_id) AS max_d_id
                    FROM deliveries
                    GROUP BY o_id
                ) AS last_delivery
                NATURAL JOIN deliveries
                WHERE (current_location = '$current_location'
                OR (current_location='still at client' AND c_district='$current_location'))
                AND status = '$status'
                AND deliveries.d_id = last_delivery.max_d_id
                ORDER BY date";
              } else {
                $query = "SELECT * FROM orders NATURAL JOIN packages NATURAL JOIN clients
                NATURAL JOIN (
                    SELECT o_id, MAX(d_id) AS max_d_id
                    FROM deliveries
                    GROUP BY o_id
                ) AS last_delivery
                NATURAL JOIN deliveries
                WHERE (current_location = '$current_location'
                OR (current_location='still at client' AND c_district='$current_location'))
                AND status != 'pending'
                AND deliveries.d_id = last_delivery.max_d_id ORDER BY date DESC";
              }
              $result = mysqli_query($link, $query);
              if (($result) && (mysqli_num_rows($result) > 0)) {

                while ($row = mysqli_fetch_assoc($result)) {
                  $fragile = 'yes';
                  if ($row["fragile"] == 0) {
                    $fragile = 'no';
                  }
                  $cash = 'yes';
                  if ($row["pay_at_delivery"] == 0) {
                    $cash = 'no';
                  }
                  echo "<tr>
          <td>#" . $row["o_id"] . "</td>
          <td>" . $row["c_name"] . "</td>
          <td>" . $row["c_phone"] . "</td>
          <td>" . $row["c_address"] . "</td>
          <td>" . $row["current_location"] . "</td>
          <td>" . $row["to_name"] . "</td>
          <td>" . $row["to_phone"] . "</td>
          <td>" . $row["to_district"] . "</td>
          <td>" . $row["to_address"] . "</td>
          <td>" . $row["f_price"] . "$</td>
          <td>" . $cash . "</td>
          <td>" . $fragile . "</td>
          <td>" . $row["status"] . "</td>
          <td>" . $row["timestamp"] . "</td>
        ";
              ?>
                  <td>
                    <!-- The button that will trigger the modal -->
                    <button type="submit" class="custom-button" onclick="resendOrder('<?php echo $row['o_id']; ?>')">
                      Resend order
                    </button>
                  </td>
                  </tr>

              <?php
                }
              } else {
                echo "<tr>
                <td id=\"colspanTD\"> No results found.</td>";
              }

              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </section>

  <script>
    function resendOrder(o_id) {
      if (confirm('Are you sure you want to resend this order?')) {
        window.location.href = 'http://localhost/seniorProject/php/resendOrder.php?o_id=' + o_id;
      }
    }
  </script>

</body>

</html>