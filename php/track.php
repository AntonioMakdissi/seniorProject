<?php
session_start();
if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']) {
  header('Location: ../login.html');
} ?>
<!DOCTYPE html>
<html>

<head>
  <title>Track</title>
  <meta charset="UTF-8" />
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

    select {
      cursor: pointer;
      appearance: none;
      -webkit-appearance: none;
      color: #555;
      font-size: 16px;
      padding: 10px 30px 10px 10px;
      border: none;
      border-radius: 5px;
      width: 200px;
    }

    select::-ms-expand {
      display: none;
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
    <h1 style="color: white">Track your order</h1>

    <!-- <div style="display: flex; justify-content: center;">
 
  <select style="position: relative; display: inline-block;  margin: 20px;">
  <option value="" disabled selected>Select your order id</option> -->
    <!-- <php
    require_once('connection.php');
    $c_id = $_SESSION['c_id'];
    $query = "SELECT o_id FROM orders WHERE c_id='$c_id' ORDER BY o_id";
    $result = mysqli_query($link, $query);
    if (($result) && (mysqli_num_rows($result) > 0)) {

      while ($row = mysqli_fetch_assoc($result)) { ?>
        <option value=<php echo $row["o_id"] ?>> <php echo $row["o_id"] ?></option>
      <php }
    } ?>
    </select>
  </div>
  <table class="table table-striped">
    <thead>
      <tr> -->

    <!-- get orders id -->
    <!-- <php
        require_once('connection.php');
        $c_id = $_SESSION['c_id'];
        $query = "SELECT o_id FROM orders WHERE c_id='$c_id' ORDER BY o_id";
        $result = mysqli_query($link, $query);
        if (($result) && (mysqli_num_rows($result) > 0)) {
          ?>
          <form method="post" action="track.php">
            <select id="mySelect" name="mySelect">
              <php
              while ($row = mysqli_fetch_assoc($result)) { ?>
                <option value=<php echo $row["o_id"] ?>> <php echo $row["o_id"] ?></option>
              <php } ?>
            </select>
            <!-- <input type="submit" value="Track"> --
          </form>
          <php
        } else {
          echo "You don't have any orders yet!";
        } > -->



    <!-- get orders id -->
    <?php
    require_once('connection.php');
    $c_id = $_SESSION['c_id'];
    $query = "SELECT o_id FROM orders WHERE c_id='$c_id' ORDER BY o_id";
    $result = mysqli_query($link, $query);
    if (($result) && (mysqli_num_rows($result) > 0)) {
      ?>
      <div style="display: flex; justify-content: center;">
        <form method="post" action="track.php">
          

            <select style="position: relative; display: inline-block;  margin: 20px;">
              <option value="" disabled selected>Select your order id</option>
              <?php
              while ($row = mysqli_fetch_assoc($result)) { ?>
                <option value=<?php echo $row["o_id"] ?>> <?php echo $row["o_id"] ?></option>
              <?php } ?>
            </select>
            <!-- <input type="submit" value="Track"> -->
        </form>
              </div>
        <?php
    } else {
      echo "You don't have any orders yet!";
    } ?>



      <table class="table table-striped">
        <thead>
          <tr>

            <th>Date and time</th>
            <th>Location</th>
            <th>By</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $o_id = 0;
          if (isset($_POST['mySelect'])) {
            $o_id = $_POST['mySelect'];
          }
          require_once('connection.php');
          $c_id = $_SESSION['c_id'];
          //$o_id = $_GET['o_id'];
          $query = "SELECT * FROM orders NATURAL JOIN deliveries WHERE c_id='$c_id' AND o_id='$o_id' ORDER BY timestamp";
          $result = mysqli_query($link, $query);
          if (($result) && (mysqli_num_rows($result) > 0)) {

            while ($row = mysqli_fetch_assoc($result)) {
              if (is_null($row["w_id"])) {
                $row["w_id"] = $_SESSION['c_name'] . "(you)";
              }

              echo "<tr>   
							<td>" . $row["timestamp"] . "</td>
							<td>" . $row["current_location"] . "</td>
							<td>" . $row["w_id"] . "</td>
							</tr>";
            }
          }
          ?>
        </tbody>
      </table>
    

    <!-- rating -->
    <!-- <form action="rating.php" method="post">
          <fieldset>
            <legend>Rate our company:</legend>
            <input type="radio" id="star5" name="rating" value="5" />5<label for="star5" title="5 stars">&#9733;</label>
            <input type="radio" id="star4" name="rating" value="4" />4<label for="star4" title="4 stars">&#9733;</label>
            <input type="radio" id="star3" name="rating" value="3" />3<label for="star3" title="3 stars">&#9733;</label>
            <input type="radio" id="star2" name="rating" value="2" />2<label for="star2" title="2 stars">&#9733;</label>
            <input type="radio" id="star1" name="rating" value="1" />1<label for="star1" title="1 star">&#9733;</label>
          </fieldset>
          <input type="submit" value="Submit Rating">
        </form>

        </br>
        <php
        if (isset($_SESSION['message'])) {
          echo $_SESSION['message'];
          unset($_SESSION['message']);
        }
        ?> -->

</body>

</html>
<<<<<<< HEAD <<<<<<< HEAD <!-- code to connect select with table const select=document.getElementById('filter-select');
  const table=document.getElementById('table'); select.addEventListener('change', (event)=> {
  const filterValue = event.target.value;

  // Loop through each row of the table body
  for (let i = 0; i < table.tBodies[0].rows.length; i++) { const row=table.tBodies[0].rows[i]; // If the filter value
    is "all" or matches the data in the first cell of the row, show the row, otherwise hide it if (filterValue==='all'
    || row.cells[0].textContent===filterValue) { row.style.display='' ; } else { row.style.display='none' ; } } }); -->


    <!-- script -->
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


    </script>