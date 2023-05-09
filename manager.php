<?php
session_start();
if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin'] || $_SESSION['type'] != 'BranchManager') {
  header('Location: ../login.php');
}
require_once 'php/connection.php';
require_once('php/stats.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>
    <?= $_SESSION['name'] ?>
  </title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">
  <link rel="stylesheet" href="assets/css/manager.css">
  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Inter:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
    rel="stylesheet">

  <!-- Vendor CSS Files -->
  <!-- <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet"> -->
  <!-- <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet"> -->
  <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <!-- <link href="assets/css/main.css" rel="stylesheet"> -->

  <!-- =======================================================
  * Template Name: Logis
  * Updated: Mar 10 2023 with Bootstrap v5.2.3
  * Template URL: https://bootstrapmade.com/logis-bootstrap-logistics-website-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->

</head>

<body class="bg-gray-100">

  <!-- ======= Header ======= -->
  <header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

      <a href="manager.php" class="logo d-flex align-items-center">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="assets/img/logo.png" alt=""> -->
        <h1 style="font-family: 'Libre Baskerville', serif; padding-left: 20px; padding-top:5px">SpeedRun</h1>
      </a>

      <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
      <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>
      <nav id="navbar" class="navbar">
        <ul>
          <!-- <li><a href="client.html" class="active">Home</a></li> -->
          <li><a href="php/history.php">History</a></li>
          <li><a href="php/track.php">Track</a></li>
          <li><a href="contact.html">Contact</a></li>
          <li><a class="get-a-quote" href="php/logout.php">Logout</a></li>
        </ul>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->


  <section id="hero" class="hero d-flex align-items-center" style="padding-top: 20px; height: 100%; ">
    <div class="container mx-auto px-4 py-12">
      <div class="container">
        <!-- <h1 style="color:white">Workers</h1> -->
        <h2 style="color:white">Branch Orders</h2>
      </div>

      <table class="table table-striped">
        <thead>
          <tr>
            <th>Order number </th>
            <th>From</th>
            <th>Phone number</th>
            <th>Address</th>
            <th>To</th>
            <th>Phone number</th>
            <th>Last stop</th>
            <th>Drop off address</th>
            <th>Price for customer</th>
            <th>Cash?</th>
            <th>Status</th>
            <th>Date and time</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $current_location = $_SESSION['branch'];
          $query = "SELECT * FROM orders NATURAL JOIN packages NATURAL JOIN deliveries NATURAL JOIN clients WHERE current_location='$current_location' ORDER BY date";
          $result = mysqli_query($link, $query);
          if ($result) {
            if (mysqli_num_rows($result) > 0) {
              while ($row = mysqli_fetch_assoc($result)) {
                $cash = 'yes';
                if ($row["pay_at_delivery"] == 0) {
                  $cash = 'no';
                }
                echo "<tr>
          <td>#" . $row["o_id"] . "</td>
          <td>" . $row["c_name"] . "</td>
          <td>" . $row["c_phone"] . "</td>
          <td>" . $row["c_address"] . "</td>
          <td>" . $row["to_name"] . "</td>
          <td>" . $row["to_phone"] . "</td>
          <td>" . $row["to_district"] . "</td>
          <td>" . $row["to_address"] . "</td>
          <td>" . $row["f_price"] . "$</td>
          <td>" . $cash . "</td>
          <td>" . $row["status"] . "</td>
          <td>" . $row["timestamp"] . "</td>
        </tr>";
              }
            } else {
              echo "No results found.";
            }
          } else {
            echo "Error: " . mysqli_error($link);
          }

          ?>
        </tbody>
      </table>


    </div>



  </section>

  <!-- <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i
      class="bi bi-arrow-up-short"></i></a>

  <div id="preloader"></div> -->

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <!-- <script src="assets/js/main.js"></script> -->

</body>

</html>