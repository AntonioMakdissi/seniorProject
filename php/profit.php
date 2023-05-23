<?php
session_start();
if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']) {
  header('Location: ../login.html');
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

      <a href="../CEO.php" class="logo d-flex alignems-center">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="assets/img/logo.png" alt=""> -->
        <h1 style="font-family: 'Libre Baskerville', serif;">SpeedRun</h1>
      </a>

      <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
      <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>
      <nav id="navbar" class="navbar">
        <?php
        if ($_SESSION['type'] == 'CEO') {
        ?>
          <ul>
            <li><a href="../CEO.php" class="active">Home</a></li>
            <li><a href="viewWorker.php">Workers</a></li>
            <li><a href="../hire.php">Hire</a></li>
            <li><a href="../addBranches.php">Branches</a></li>
            <li><a href="profit.php">Statistics</a></li>
            <li><a href="../viewMessages.php">Messages</a></li>
            <li><a class="get-a-quote" href="logout.php">Logout</a></li>
          </ul>

        <?php } else { ?>
          <ul>
            <li><a href="../IT.php" class="active">Home</a></li>
            <li><a href="../viewMessages.php">Messages</a></li>
            <li><a href="viewWorker.php">Workers</a></li>
            <li><a href="../addBranches.php">Branches</a></li>
            <li><a href="hire.php">Hire</a></li>
            <li><a href="../IT.php#IT_message">Contact</a></li>
            <li><a class="get-a-quote" href="logout.php">Logout</a></li>
          </ul>
        <?php } ?>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->

  <section id="hero" class="hero " style="padding-top: 20px; height: 100%; ">
    <div class="container">
      <div class="container mx-auto px-4 py-12">
        <h1 class="text-4xl font-bold mb-6" style="color:white;">Orders history</h1>
        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg mb-8">

          <a href="http://localhost/seniorProject/php/profit.php?status=pending"><button class="show-all-button" name="show" type="submit" id="showButton">Show pending</button> </a>
          <a href="http://localhost/seniorProject/php/profit.php?status=successful"><button class="show-all-button" name="show" type="submit" id="showButton">Show delivered</button> </a>
          <a href="http://localhost/seniorProject/php/profit.php?status=failed"><button class="show-all-button" name="show" type="submit" id="showButton">Show failed</button> </a>
          <a href="http://localhost/seniorProject/php/profit.php"><button class="show-all-button" name="show" type="submit" id="showButton">Show All</button> </a>


          <table class="table table-striped">
            <thead>
              <tr>
                <th>Order number </th>
                <th>Date and time</th>
                <th>Cost</th>
                <th>Profit</th>
                <th>Price for customer</th>
                <th>status</th>
              </tr>
            </thead>
            <tbody>
              <?php
              require_once('connection.php');
              $query = 0;
              if (isset($_GET['status'])) {
                $status = $_GET['status'];

                $query = "SELECT * FROM orders NATURAL JOIN packages WHERE status='$status' ORDER BY date";
              } else {
                $query = "SELECT * FROM orders NATURAL JOIN packages ORDER BY date";
              }
              $result = mysqli_query($link, $query);
              if (($result) && (mysqli_num_rows($result) > 0)) {

                while ($row = mysqli_fetch_assoc($result)) {

                  echo "<tr>   
                  <td>#" . $row["o_id"] . "</td>
                  <td>" . $row["date"] . "</td>
                  <td>" . $row["cost"] . "$</td>
                  <td>" . $row["charge"] . "</td>
                  <td>" . $row["f_price"] . "</td>
                  <td>" . $row["status"] . "</td>
                  </tr>";
                }
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </section>




</body>

</html>