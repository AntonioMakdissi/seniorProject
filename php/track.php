<?php
session_start();
if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']) {
  header('Location: ../login.php');
}
require_once 'connection.php';
require_once('employee.php'); ?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
  <title>
    Track
  </title>
  <!-- <link rel="stylesheet" href="../assets/css/header.css"> -->
  <link rel="stylesheet" href="../assets/css/navbar.css">
  <link href="../assets/css/track.css" rel="stylesheet">
  <!-- Favicons -->
  <link href="../assets/img/icon.jfif" rel="icon">
  <link href="../assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Inter:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
    rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville:wght@700&display=swap" rel="stylesheet">


  <!-- Vendor CSS Files -->
  <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="../assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="../assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link href="../assets/vendor/aos/aos.css" rel="stylesheet">



  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

</head>

<body>


  <header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">
      <a style="text-decoration:none;" href="../client.php" class="logo d-flex align-items-center">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="assets/img/logo.png" alt=""> -->
        <h1 style="font-family: 'Libre Baskerville', serif; padding-left: 20px;">SpeedRun</h1>
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
        <h1 class="text-4xl font-bold mb-6 flippyFlop" style="color:white; margin-top:5%;">Track your order!</h1>
        <div class="d-flex justify-content-center wackyWidth">
          <?php
          require_once('connection.php');
          $c_id = $_SESSION['c_id'];
          $query = "SELECT o_id FROM orders WHERE c_id='$c_id' ORDER BY o_id DESC";
          $result = mysqli_query($link, $query);
          if (($result) && (mysqli_num_rows($result) > 0)) {
            ?>

            <form method="post" action="track.php" class="blibberBlop">
              <div class="input-group mb-3 fizzyFizz">
                <select name="o_id" class="form-control zanyZone">
                  <option value="" disabled selected>Select your order id</option>
                  <?php
                  while ($row = mysqli_fetch_assoc($result)) { ?>
                    <option name="o_id" value=<?php echo $row["o_id"] ?>> #<?php echo $row["o_id"] ?></option>
                  <?php } ?>
                </select>
                <input type="submit" class="btn btn-primary wackyButton" value="Track">
              </div>
            </form>

            <?php
          } else {
            ?>
            <div class="input-group mb-3 fizzyFizz">
              <h1 class="text-4xl font-bold mb-6 flippyFlop" style="color:black;">You don't have any orders yet!</h1>
            </div>
            <?php
          }
          ?>
        </div>
      </div>

      <?php

      $o_id = 0;
      if (isset($_POST['o_id'])) {
        $o_id = $_POST['o_id'];
      }

      $c_id = $_SESSION['c_id'];
      $status = "successful";
      $query = "SELECT * FROM orders NATURAL JOIN packages WHERE c_id='$c_id' AND o_id='$o_id' ";
      $result = mysqli_query($link, $query);
      if (($result) && (mysqli_num_rows($result) > 0)) {
        $row = mysqli_fetch_assoc($result)
          ?>
        <div class="container mt-3" style="color:#0e1d34;">
          <div class="card text-center">
            <div class="card-body">
              <h5 class="card-title">Order Details</h5>
              <p class="card-text">
                Order number:
                <?php echo $row['o_id']; ?>
                </br>
                Status:
                <?php echo $row['status']; ?>
                </br>
                Cost:
                <?php echo $row['f_price']; ?>
                </br>
                Cash on delivery:
                <?php echo $row['pay_at_delivery'] ? "yes" : "no"; ?>
                </br>
                Sender pays:
                <?php echo $row['sender_pays'] ? "yes" : "no"; ?>
                </br>
                Fragile:
                <?php echo $row['fragile'] ? "yes" : "no"; ?>
                </br>
                Same day delivery:
                <?php echo $row['urgent'] ? "yes" : "no"; ?>
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
              $query = "SELECT * FROM orders NATURAL JOIN deliveries WHERE c_id='$c_id' AND o_id='$o_id' ORDER BY timestamp";
              $result = mysqli_query($link, $query);
              while ($row = mysqli_fetch_assoc($result)) {
                $emp = 0;
                if (is_null($row["w_id"])) {
                  $emp = $_SESSION['c_name'] . "(you)";
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
                if ($status == "pending") { ?>
                  <tr>
                    <td colspan="3"><button type="submit" class="custom-button" onclick="markFailed('<?php echo $o_id; ?>')">
                        Mark as failed
                      </button></td>
                  </tr>
                  <?php
              }
              ?>
            </tbody>
          </table>
          




        <?php } ?>
        <?php
        if (isset($_SESSION['mess'])) {
          echo $_SESSION['mess'];
          unset($_SESSION['mess']);
        }
        ?>

        <script>
          function markFailed(o_id) {
            if (confirm('Are you sure you want to mark it as failed?')) {
              window.location.href = 'http://localhost/seniorProject/php/markFailed.php?o_id=' + o_id;
            }
          }
        </script>
        <!-- rating -->
        <script>
          $(document).ready(function () {
            $('input[type="radio"]').click(function () {
              $.post('rating.php', {
                rating: $(this).val()
              });
            });
          });
        </script>
        <form method="post" action="rating.php">
          <h1 style="color:#0e1d34;">Rate our company:</h1>
          <div class="rating" style="width: 100%;">
        <form method="post" action="rating.php">
          <input type="radio" id="star5" name="rating" value="5" /><label for="star5" title="5 stars">5 </label>
          <input type="radio" id="star4" name="rating" value="4" /><label for="star4" title="4 stars">4 </label>
          <input type="radio" id="star3" name="rating" value="3" /><label for="star3" title="3 stars">3 </label>
          <input type="radio" id="star2" name="rating" value="2" /><label for="star2" title="2 stars">2 </label>
          <input type="radio" id="star1" name="rating" value="1" /><label for="star1" title="1 star">1 </label>
        </div>  
          <div class="text-center">
            <input type="submit" class="btn btn-primary" value="Submit Rating">
          </div>
        </form>
        <?php
    if (isset($_SESSION['message'])) {
        echo '<p style="text-align: center; font-size: 30px; color: white;">' . $_SESSION['message'] . '</p>';
        unset($_SESSION['message']);
    }
?>

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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</body>

</html>
