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
  <link rel="stylesheet" href="../assets/css/navbar.css">
  <!-- <link rel="stylesheet" href="../../assets/css/manager.css"> -->
  <!-- Favicons -->
  <link href="../assets/img/icon.jfif" rel="icon">
  <link href="../assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Inter:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="../assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="../assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link href="../assets/vendor/aos/aos.css" rel="stylesheet">

</head>



<body>
  <header id="header" class="header d-flex alignems-center fixed-top ">
    <div class="container-fluid container-xl d-flex alignems-center justify-content-between">
      <?php if ($_SESSION['type'] == 'CEO') { ?>
        <a style="text-decoration: none;" href="../CEO.php" class="logo d-flex alignems-center">
          <!-- Uncomment the line below if you also wish to use an image logo -->
          <!-- <img src="../assets/img/logo.png" alt=""> -->
          <h1 style="font-family: 'Libre Baskerville', serif;">SpeedRun</h1>
        </a>
      <?php } else { ?>
        <a style="text-decoration: none;" href="../viewMessages.php" class="logo d-flex alignems-center">
          <!-- Uncomment the line below if you also wish to use an image logo -->
          <!-- <img src="../assets/img/logo.png" alt=""> -->
          <h1 style="font-family: 'Libre Baskerville', serif;">SpeedRun</h1>
        </a>
      <?php } ?>
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
            <li><a href="../common_password.php">Change Password</a></li>
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
        <div class="filter-dropdown">
          <button class="filter-icon" onclick="toggleDropdown()"><i class="fas fa-filter"></i></button>
          <div class="dropdown-content">
            <a href="http://localhost/seniorProject/php/profit.php?status=pending">Show pending</a>
            <a href="http://localhost/seniorProject/php/profit.php?status=successful">Show delivered</a>
            <a href="http://localhost/seniorProject/php/profit.php?status=failed">Show failed</a>
            <a href="http://localhost/seniorProject/php/profit.php">Show All</a>
          </div>
        </div>
        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg mb-8">


          <table class="table table-striped">
            <thead style="background-color:white; color:#0e1d34;">
              <tr>
                <th>Order number </th>
                <th>Date and time</th>
                <th>Fragile</th>
                <th>Urgent</th>
                <th>Cost</th>
                <th>Profit</th>
                <th>Price for customer</th>
                <th>status</th>
              </tr>
            </thead>
            <tbody style="color:#0e1d34;">
              <?php
              require_once('connection.php');
              $query = 0;
              $status = -1;
              if (isset($_GET['status']) && $_GET['status'] != -1) {
                $status = $_GET['status'];
                $query = "SELECT * FROM orders NATURAL JOIN packages WHERE status='$status' ORDER BY date DESC";
              } else {
                $query = "SELECT * FROM orders NATURAL JOIN packages ORDER BY date DESC";
              }

              // Pagination configuration
              $perPage = 10; // Change this to how many items you would like per page
              if (isset($_GET['page']) && !empty($_GET['page'])) {
                $page = $_GET['page'];
              } else {
                $page = 1;
              }
              $start = ($page - 1) * $perPage;

              // Retrieve records based on the query and pagination

              $result = mysqli_query($link, $query . " LIMIT $start, $perPage");
              if (($result) && (mysqli_num_rows($result) > 0)) {
                while ($row = mysqli_fetch_assoc($result)) {
                  $cash = 'yes';
                  $fragile = 'yes';
                  $payer = 'sender';
                  $urgent = 'yes';
                  if ($row["pay_at_delivery"] == 0) {
                    $cash = 'no';
                  }
                  if ($row["fragile"] == 0) {
                    $fragile = 'no';
                  }
                  if ($row["urgent"] == 0) {
                    $urgent = 'no';
                  }
                  if ($row["sender_pays"] == 0) {
                    $payer = 'receiver';
                  }
                  echo "<tr>   
        <td>#" . $row["o_id"] . "</td>
        <td>" . $row["date"] . "</td>
        <td>" . $fragile . "</td>
        <td>" . $urgent . "</td>
        <td>" . $row["cost"] . "$</td>
        <td>" . $row["charge"] . "$</td>
        <td>" . $row["f_price"] . "$</td>
        <td>" . $row["status"] . "</td>
        </tr>";
                }
              }

              // Count total records
              $countQuery = "SELECT COUNT(*) as totalCount FROM orders NATURAL JOIN packages";
              if ($status != -1) {
                $countQuery .= " WHERE status='$status'";
              }
              $countResult = mysqli_query($link, $countQuery);
              $totalCount = mysqli_fetch_assoc($countResult)['totalCount'];
              $totalPages = ceil($totalCount / $perPage);
              ?>
            </tbody>
          </table>

        </div>
        <div class="flex justify-center mt-4">
          <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
            <a style="text-decoration: none;" href="?status=<?php echo $status; ?>&page=<?php echo $i; ?>" class="mx-2 px-4 py-2 text-white bg-blue-500 hover:bg-blue-700 rounded-full <?= $i == $page ? 'bg-green-500' : '' ?>"><?= $i; ?></a>
          <?php endfor; ?>
        </div>
      </div>
    </div>
  </section>



  <script>
    document.addEventListener('keydown', function(e) {
      switch (e.key) {
        case '+':
          if (<?= $page ?> < <?= $totalPages ?>) {
            window.location.href = "?page=" + (<?= $page ?> + 1);
          }
          break;
        case '-':
          if (<?= $page ?> > 1) {
            window.location.href = "?page=" + (<?= $page ?> - 1);
          }
          break;
      }
    });
  </script>

  <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="../assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="../assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="../assets/vendor/aos/aos.js"></script>
  <script src="../assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="../assets/js/main.js"></script>
  <script>
    function toggleDropdown() {
      const dropdown = document.querySelector('.filter-dropdown');
      dropdown.classList.toggle('show-dropdown');
    }
  </script>
</body>

</html>