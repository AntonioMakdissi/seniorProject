<?php
session_start();
if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']) {
  header('Location: ../login.html');
} ?>
<!DOCTYPE html>
<html>

<head>
  <title>History</title>
  <meta charset="UTF-8" />
  <!-- Template Main CSS File -->
  <link href="../assets/css/main.css" rel="stylesheet">
  <style>
    .container {
      margin-top: 50px;
    }

    h1 {
      text-align: center;
      margin-bottom: 50px;
    }

    .table {
      width: 100%;
      max-width: 1200px;
      margin: 0 auto;
      border-collapse: separate;
      border-spacing: 0 10px;
    }

    .table th,
    .table td {
      padding: 12px;
      vertical-align: middle;
      text-align: center;
    }

    .table th {
      background-color: #f5f5f5;
      font-weight: bold;
      text-transform: uppercase;
    }

    .table tbody tr {
      background-color: #fff;
      border-radius: 4px;
      box-shadow: 0 0 4px rgba(0, 0, 0, 0.2);
    }

    .table-striped tbody tr:nth-of-type(odd) {
      background-color: #f5f5f5;
    }

    body {
      background: url('https://th.bing.com/th/id/R.ea4192babfe60404ef0dafb21484f282?rik=doxyDdbyqpjM2Q&pid=ImgRaw&r=0') center center fixed no-repeat;
      background-size: cover;
      position: relative;
    }

    body::before {
      content: "";
      position: absolute;
      top: 0;
      left: 0;
      bottom: 0;
      right: 0;
      background-color: rgba(255, 255, 255, 0.01);
      /* Change opacity as needed */
    }

    .navbar {
      position: relative;
      z-index: 9999;
    }
    .navbar ul {
  display: flex;
  flex-direction: row;
  list-style: none;
  margin: 0;
  padding: 0;
  justify-content: flex-end;
}

  </style>
</head>

<body>
  <header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

      <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
      <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>
      <nav id="navbar" class="navbar">
        <ul>
          <li><a href="../client.php" class="active">Home</a></li>
          <li><a href="../about.html">About</a></li>
          <li><a href="../services.html">Services</a></li>
          <li><a href="history.php">History</a></li>
          <li><a href="track.php">Track</a></li>
          <li><a href="../contact.html">Contact</a></li>
          <li><a class="get-a-quote" href="logout.php">Logout</a></li>
        </ul>
      </nav><!-- .navbar -->
    </div>
  </header><!-- End Header -->

  <div class="container" style="margin-top: 10px">
    <h1 style="color:white">Order History</h1>
    <table class="table table-striped">
      <thead>
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
        $query = "SELECT * FROM orders NATURAL JOIN packages WHERE c_id='$c_id' ORDER BY date";
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

</body>

</html>