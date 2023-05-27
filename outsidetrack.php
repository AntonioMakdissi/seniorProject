<?php
require_once 'php/connection.php';
require_once('php/employee.php'); ?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
  <title>
    Track
  </title>
  <!-- <link rel="stylesheet" href="assets/css/header.css"> -->
  <link rel="stylesheet" href="assets/css/navbar.css">
  <!-- Favicons -->
  <link href="assets/img/icon.jfif" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Inter:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville:wght@700&display=swap" rel="stylesheet">


  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">


  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>


  <header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">


      <?php
      if (session_status() != PHP_SESSION_NONE) {
        //session_start();
        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] && ($_SESSION['type'] == 'worker' || $_SESSION['type'] == 'BranchManager')) {
          if ($_SESSION['type'] == 'BranchManager') {
      ?>
            <a style="text-decoration:none;" href="branchOrders.php" class="logo d-flex align-items-center">
              <!-- Uncomment the line below if you also wish to use an image logo -->
              <!-- <img src="assets/img/logo.png" alt=""> -->
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
          <?php
          } else { //worker
          ?>
           <a href="branchOrders.php" class="logo d-flex align-items-center" style="text-decoration:none;">
              <!-- Uncomment the line below if you also wish to use an image logo -->
              <!-- <img src="assets/img/logo.png" alt=""> -->
              <h1 style="font-family: 'Libre Baskerville', serif;">SpeedRun</h1>
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
            </nav><!-- .navbar -->
          <?php
          }
        } else {
          // Handle case when user is not logged in or the type is not valid
          //index navbar
          ?>
          <a href="index.html" class="logo d-flex align-items-center" style="text-decoration:none;">
              <!-- Uncomment the line below if you also wish to use an image logo -->
              <!-- <img src="assets/img/logo.png" alt=""> -->
              <h1 style="font-family: 'Libre Baskerville', serif;">SpeedRun</h1>
            </a>
          <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
          <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>
          <nav id="navbar" class="navbar">
          <ul>
          <li><a href="index.html" class="active">Home</a></li>
          <li><a href="about.html">About</a></li>
          <li><a href="services.html">Services</a></li>
          <li><a href="outsidetrack.php">Track</a></li>
          <li><a href="login.php">Login</a></li>
          <li><a class="get-a-quote" href="outsideorder.php">Place order</a></li>
        </ul>
          </nav>
        <?php
        }
      } else {
        // Handle case when session is not started
        //index navbar
        ?>
            <a href="index.html" class="logo d-flex align-items-center">
              <!-- Uncomment the line below if you also wish to use an image logo -->
              <!-- <img src="assets/img/logo.png" alt=""> -->
              <h1 style="font-family: 'Libre Baskerville', serif;">SpeedRun</h1>
            </a>

            <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
            <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>
            <nav id="navbar" class="navbar">
            <ul>
          <li><a href="index.html" class="active">Home</a></li>
          <li><a href="about.html">About</a></li>
          <li><a href="services.html">Services</a></li>
          <li><a href="outsidetrack.php">Track</a></li>
          <li><a href="login.php">Login</a></li>
          <li><a class="get-a-quote" href="outsideorder.php">Place order</a></li>
        </ul>
            </nav>
          <?php
        }
          ?>

          </div>
        </header><!-- End Header -->


        <section id="hero" class="hero " style="padding-top: 20px; height: 100%; ">
          <div class="container">
            <div class="container mx-auto px-4 py-12">
              <h1 class="text-4xl font-bold mb-6 flippyFlop" style="color:white; margin-top:5%;">Track your order!</h1>

              <div class="d-flex justify-content-center wackyWidth">
                <form method="post" action="outsidetrack.php" class="blibberBlop">
                  <div class="input-group mb-3 fizzyFizz">
                    <input type="number" class="form-control zanyZone" name="o_id" id="o_id" required placeholder="Enter order number" pattern="[0-9+\\-]*">
                    <input type="submit" class="btn btn-primary wackyButton" value="Track">
                  </div>
                </form>
              </div>
            </div>

            <?php
            $o_id = 0;
            if (isset($_POST['o_id'])) {
              $o_id = $_POST['o_id'];
              $status = "successful";
              $query = "SELECT * FROM orders NATURAL JOIN packages WHERE o_id='$o_id' ";
              $result = mysqli_query($link, $query);
              if (($result) && (mysqli_num_rows($result) > 0)) {
                $row = mysqli_fetch_assoc($result);
            ?>

                <div class="container mt-3" style="color:#0e1d34;">
                  <div class="card text-center">
                    <div class="card-body">
                      <h5 class="card-title">Order Details</h5>
                      <p class="card-text">
                        Order number: <strong><?php echo $row['o_id']; ?></strong> <br>
                        Status: <strong><?php echo $row['status']; ?></strong> <br>
                        Cost: <strong><?php echo $row['f_price']; ?></strong> <br>
                        Cash on delivery: <strong><?php echo $row['pay_at_delivery'] ? "Yes" : "No"; ?></strong>
                      </p>
                    </div>
                  </div>
                </div>

                <div class="container mt-3">
                  <table class="table table-striped">
                    <thead class="thead-dark" style="background-color:#ffffff; color:#0e1d34;">
                      <tr>
                        <th>Date and time</th>
                        <th>Location</th>
                        <th>By</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $query = "SELECT * FROM orders NATURAL JOIN deliveries NATURAL JOIN clients WHERE o_id='$o_id' ORDER BY timestamp";
                      $result = mysqli_query($link, $query);
                      while ($row = mysqli_fetch_assoc($result)) {
                        $emp = 0;
                        if (is_null($row["w_id"])) {
                          $emp = $row["c_name"];
                        } else {
                          $emp = getEmpById($link, $row["w_id"]);
                        }
                        $status = $row["status"];
                        $o_id = $row["o_id"];
                        echo "<tr>   
                        <td>" . $row["timestamp"] . "</td>
                        <td>" . $row["current_location"] . "</td>
                        <td>" . $emp . "</td>
                    </tr>";
                      }
                      ?>
                    </tbody>
                  </table>
                </div>

            <?php
              } else {
                echo '<div class="alert alert-danger mt-3">Wrong order number</div>';
              }
            } else {
              // echo '<div class="alert alert-warning mt-3">Enter order number</div>';
            }
            ?>

          </div>
    </div>
    </section>

    <script>
      function updateTable() {
        var selectedValue = document.getElementById("mySelect").value;
        // Use the selected value to fetch data from the server and update the table
        // Example code to update the table with different content based on the selected value:
        var table = document.getElementById("trackTable");
        for (var i = 1; i < table.rows.length; i++) {
          var row = table.rows[i];
          var cells = row.cells;
          for (var j = 0; j < cells.length; j++) {
            cells[j].innerHTML = "Option " + selectedValue + " - Value " + i + "-" + (j + 1);
          }
        }
      }
    </script>
</body>

</html>
<!-- code to connect select with table const select=document.getElementById('filter-select'); const table=document.getElementById('table'); select.addEventListener('change', (event)=> {
  const filterValue = event.target.value;

  // Loop through each row of the table body
  for (let i = 0; i < table.tBodies[0].rows.length; i++) { const row=table.tBodies[0].rows[i]; // If the filter value is "all" or matches the data in the first cell of the row, show the row, otherwise hide it if (filterValue==='all' || row.cells[0].textContent===filterValue) { row.style.display='' ; } else { row.style.display='none' ; } } }); -->


<!-- script -->