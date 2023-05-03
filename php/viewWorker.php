<?php
session_start();
if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin'] || ($_SESSION['type'] != 'IT' && $_SESSION['type'] != 'CEO')) {
  header('Location: login.html');
}
?>
<!DOCTYPE html>
<html>

<head>
  <title>Workers</title>
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

    .custom-button {
      background-color: #dc3545;
      border-color: #dc3545;
      color: #fff;
      padding: 0.375rem 0.75rem;
      border-radius: 0.25rem;
      font-size: 1rem;
      line-height: 1.5;
      transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
      position: relative;
      z-index: 9999;
    }

    .custom-button:hover {
      background-color: #c82333;
      border-color: #bd2130;
      color: #fff;
    }

    .custom-button:focus {
      outline: 0;
      box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.5);
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
          <li><a href="../CEO.php" class="active">Home</a></li>
          <li><a href="viewWorker.php">Workers</a></li>
          <li><a href="../CEO.php#branches">Branches</a></li>
          <li><a href="profit.php">Statistics</a></li>
          <li><a href="../CEO.php#IT_message">Contact</a></li>
          <li><a class="get-a-quote" href="logout.php">Logout</a></li>
        </ul>
      </nav><!-- .navbar -->
    </div>
  </header><!-- End Header -->
  <div class="container" style="margin-top: 10px">
    <h1 style="color:white">Workers</h1>
    <div class="md:col-span-2 mb-6">
      <label class="block text-sm font-medium text-white-700 mb-2">Search for Worker:</label>
      <div class="flex">
        <form style="z-index: 9999;" id="searchForm" action="search.php" method="post">
          <input style="z-index: 9999;" name="worker" type="text" id="searchWorker" placeholder="worker name, id or branch">
          <button style="z-index: 9999;" name="submit" type="submit" id="searchButton" style="margin-left:1%;">Search</button>
        </form>
        <a href="http://localhost/seniorProject/php/test.php">
        <button name="show" type="submit" id="showButton" style="margin-left:1%;">Show All</button>
        </a>
      </div>
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
            if ($row["type"] == 'CEO' || $row["w_id"]==$_SESSION['w_id']) {
              echo "                <td></td>                
                 </tr>";
            } else {
        ?>
              <td> <button type="submit" class="custom-button" onclick="fireWorker('<?php echo $rmid; ?>')">Fire</button></a> </td>


              </tr><?php
                  }
                }
              }

                    ?>
      </tbody>
    </table>
    <script>
    function fireWorker(rmid) {
        if (confirm('Are you sure you want to fire this worker?')) {
            window.location.href = 'http://localhost/seniorProject/php/fireworker.php?rmid=' + rmid;
        }
    }
</script>
</body>

</html>