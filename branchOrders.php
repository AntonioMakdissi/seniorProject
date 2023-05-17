<?php
session_start();
// if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin'] || $_SESSION['type'] != 'worker') {
//   header('Location: login.php');
// }
require_once 'php/connection.php';
require_once('php/stats.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
  <title>
    <?= $_SESSION['name'] ?>
  </title>
  <link rel="stylesheet" href="assets/css/header.css">
  <link rel="stylesheet" href="assets/css/manager.css">
  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Inter:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
    rel="stylesheet">

  <!-- Vendor CSS Files -->
  <!-- <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">-->
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">

</head>

<body class="bg-gray-100">

  <!-- ======= Header ======= -->
  <header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">
      <?php
      if ($_SESSION['type'] == 'BranchManager') {
        ?>
        <a href="manager.php" class="logo d-flex align-items-center">
          <!-- Uncomment the line below if you also wish to use an image logo -->
          <!-- <img src="assets/img/logo.png" alt=""> -->
          <h1 style="font-family: 'Libre Baskerville', serif; padding-left: 20px;">SpeedRun</h1>
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
        </nav>#
      <?php } else {
        ?>
        <a href="branchOrders.php" class="logo d-flex align-items-center">
          <!-- Uncomment the line below if you also wish to use an image logo -->
          <!-- <img src="assets/img/logo.png" alt=""> -->
          <h1 style="font-family: 'Libre Baskerville', serif; padding-left: 20px;">SpeedRun</h1>
        </a>

        <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
        <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>
        <nav id="navbar" class="navbar">
          <ul>
            <li><a href="ViewMessages.php">Contact</a></li>
            <li><a class="get-a-quote" href="php/logout.php">Logout</a></li>
          </ul>
        <?php } ?>
    </div>
  </header>


  <section id="hero" class="hero " style="padding-top: 20px; height: 100%; ">
    <div class="container">
      <div class="container mx-auto px-4 py-12">
        <h1 class="text-4xl font-bold mb-6" style="color:white;">Branch Orders</h1>
        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg mb-8">


          <table id="myTable" class="table table-striped">
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
                <?php
                if ($_SESSION['type'] == 'worker') {
                  ?>
                  <th>Branch</th>
                  <th>Action</th>
                <?php
                }
                ?>
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
                  echo "<tr>
                  <td id=\"colspanTD\"> No results found.</td>";
                }
              } else {
                echo "Error: " . mysqli_error($link);
              }

              ?> <!-- <td>
                  <select>
                    <option value="" selected disabled hidden>Branches</option>
                  </select>
                </td>
                <td>
                  <form action="your-action.php" method="post">
                   
                    <input class="submit-button" type="submit" value="Submit">
                  </form>
                </td> -->
            </tbody>




            <!-- <input type="hidden" name="id" value="<php echo $row['id']; ?>"> -->
            <!-- Hidden input to pass the row id or any other needed data -->
          </table>
        </div>
      </div>


    </div>



  </section>

  <script>
    window.onload = function () {
      var table = document.getElementById("myTable");
      var thCount = table.getElementsByTagName("th").length;
      var td = document.getElementById("colspanTD");
      td.setAttribute("colspan", thCount);
    }
  </script>

  <!-- <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i
      class="bi bi-arrow-up-short"></i></a>

  <div id="preloader"></div> -->

  <!-- Vendor JS Files -->
  <!-- <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script> -->
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <!-- <script src="assets/js/main.js"></script> -->

</body>

</html>