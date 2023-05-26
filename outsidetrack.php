<?php
require_once 'php/connection.php';
require_once('php/employee.php'); ?>
<!DOCTYPE html>
<html>

<head>
  <title>Track</title>
  <meta charset="UTF-8" />
  <link href="../assets/css/track.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
    <h1 style="color: Black">Track your order</h1>

    <!-- <div style="display: flex; justify-content: center;">
 
  <select style="position: relative; display: inline-block;  margin: 20px;">
  <option value="" disabled selected>Select your order id</option> -->

    <!-- get orders id -->

    <div style="display: flex; justify-content: center;">
      <form method="post" action="outsidetrack.php">
        <input type="number" name="o_id" id="o_id" required placeholder="Enter order number" pattern="[0-9+\\-]*">
        </select>
        <input type="submit" value="Track">
      </form>
    </div>
    <?php


    $o_id = 0;
    if (isset($_POST['o_id'])) {
      $o_id = $_POST['o_id'];

      $status = "successful";
      $query = "SELECT * FROM orders NATURAL JOIN packages WHERE o_id='$o_id' ";
      $result = mysqli_query($link, $query);
      if (($result) && (mysqli_num_rows($result) > 0)) {
        $row = mysqli_fetch_assoc($result)
    ?>
        Order number: <?php echo $row['o_id']; ?>
        </br>
        Status: <?php echo $row['status']; ?>
        </br>
        Cost: <?php echo $row['f_price']; ?>
        </br>
        Cash on delivery: <?php echo $row['pay_at_delivery'] ? "yes" : "no"; ?>

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
      } else {
        echo "Wrong order number";
      }
    } else {
      echo "Enter order number";
    }
        ?>
          </tbody>
        </table>

</body>

</html>
<!-- code to connect select with table const select=document.getElementById('filter-select'); const table=document.getElementById('table'); select.addEventListener('change', (event)=> {
  const filterValue = event.target.value;

  // Loop through each row of the table body
  for (let i = 0; i < table.tBodies[0].rows.length; i++) { const row=table.tBodies[0].rows[i]; // If the filter value is "all" or matches the data in the first cell of the row, show the row, otherwise hide it if (filterValue==='all' || row.cells[0].textContent===filterValue) { row.style.display='' ; } else { row.style.display='none' ; } } }); -->


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