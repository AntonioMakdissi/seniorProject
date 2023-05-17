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
  <link
    href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Inter:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
    rel="stylesheet">

  <!-- Vendor CSS Files -->
  <!-- <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet"> -->
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">

</head>

<body class="bg-gray-100">
  <header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">
    <?php
        if ($_SESSION['type'] == 'CEO') {
          ?>
      <a href="../CEO.php" class="logo d-flex align-items-center" >
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

  
  <section id="hero" class="hero d-flex align-items-center" style="padding-top: 20px; height: 100%; ">
    <div class="container mx-auto px-4 py-12">
      <div class="container" style="margin-top: 10px">
        <h1 style="color:white ;text-align: center; font-size:2em; ">Workers</h1>

        <form style="z-index: 9999;" id="searchForm" action="viewWorker.php" method="post">
          <div class="search-container">
            <label for="search-input" class="search-label">Search for Worker:</label>
            <input class="search-input" name="worker" type="text" id="search-input"
              placeholder="Enter worker name, ID, or branch">
            <button class="search-button" name="submit" type="submit" id="searchButton">Search</button>
        </form>
        <a href="http://localhost/seniorProject/php/viewWorker.php"><button class="show-all-button" name="show"
            type="submit" id="showButton">Show All</button> </a>
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
              if ($row["type"] == 'CEO' || $row["w_id"] == $_SESSION['w_id']) {
                echo "                <td></td>                
                 </tr>";
              } else {
                ?>
                <td> <button type="submit" class="custom-button"
                    onclick="fireWorker('<?php echo $rmid; ?>')">Fire</button></a> </td>


                </tr>
                <?php
              }
            }
          }

          ?>
        </tbody>
      </table>
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

</body>

</html>