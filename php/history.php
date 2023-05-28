<?php
session_start();
if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']) {
  header('Location: ../login.php');
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
  <!-- <link rel="stylesheet" href="../assets/css/manager.css"> -->
  <!-- Favicons -->
  <link href="../assets/img/icon.jfif" rel="icon">
  <link href="../assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Inter:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
    rel="stylesheet">

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

      <a style="text-decoration:none;" href="client.php" class="logo d-flex alignems-center">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="assets/img/logo.png" alt=""> -->
        <h1 style="font-family: 'Libre Baskerville', serif;">SpeedRun</h1>
      </a>

      <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
      <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>
      <nav id="navbar" class="navbar">
      <ul>
          <li><a href="../client.php" class="active">Home</a></li>
          <li><a href="../services.php">Services</a></li>
          <li><a href="history.php">History</a></li>
          <li><a href="track.php">Track</a></li>
          <li><a href="../viewMessages.php">Messages</a></li>
          <li><a href="../common_password.php">Change Password</a></li>
          <li><a class="get-a-quote" href="logout.php">Logout</a></li>
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
            <thead style="background-color:white;">
              <tr>
                <th>Order Number</th>
                <th>Date and Time</th>
                <th>Cost</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
              <?php
              require_once('connection.php');
              $c_id = $_SESSION['c_id'];
              $perPage = 10; // Change this to set the number of items per page
              
              // Get the total number of rows
              $countQuery = "SELECT COUNT(*) as totalCount FROM orders NATURAL JOIN packages WHERE c_id='$c_id'";
              $countResult = mysqli_query($link, $countQuery);
              $totalCount = mysqli_fetch_assoc($countResult)['totalCount'];

              // Calculate the total number of pages
              $totalPages = ceil($totalCount / $perPage);

              // Get the current page from the query string
              if (isset($_GET['page']) && !empty($_GET['page'])) {
                $currentPage = $_GET['page'];
              } else {
                $currentPage = 1;
              }

              // Calculate the offset for the current page
              $offset = ($currentPage - 1) * $perPage;

              // Query with pagination
              $query = "SELECT * FROM orders NATURAL JOIN packages WHERE c_id='$c_id' ORDER BY date DESC LIMIT $offset, $perPage";
              $result = mysqli_query($link, $query);

              if (($result) && (mysqli_num_rows($result) > 0)) {
                while ($row = mysqli_fetch_assoc($result)) {
                  echo "<tr>   
                  <td>#" . $row["o_id"] . "</td>
                  <td>" . $row["date"] . "</td>
                  <td>" . $row["f_price"] . "$</td>
                  <td>" . $row["status"] . "</td>              
                </tr>";
                }
              }
              ?>

            </tbody>
          </table>

        </div>
        <div class="flex justify-center mt-4">
                    <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                        <a style="text-decoration: none;" href="?page=<?= $i; ?>" class="mx-2 px-4 py-2 text-white bg-blue-500 hover:bg-blue-700 rounded-full <?= $i == $page ? 'bg-green-500' : '' ?>"><?= $i; ?></a>
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
  <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i
      class="bi bi-arrow-up-short"></i></a>

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

</body>

</html>