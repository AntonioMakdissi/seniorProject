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
    <?php
    require_once('connection.php');
    $c_id = $_SESSION['c_id'];
    $query = "SELECT o_id FROM orders WHERE c_id='$c_id' ORDER BY o_id";
    $result = mysqli_query($link, $query);
    if (($result) && (mysqli_num_rows($result) > 0)) {
    ?>
      <div style="display: flex; justify-content: center;">
        <form method="post" action="track.php">
          <select name="o_id" style="position: relative; display: inline-block;  margin: 20px;">
            <option value="" disabled selected>Select your order id</option>
            <?php
            while ($row = mysqli_fetch_assoc($result)) { ?>
              <option name="o_id" value=<?php echo $row["o_id"] ?>> #<?php echo $row["o_id"] ?></option>
            <?php } ?>
          </select>
          <input type="submit" value="Track">
        </form>
      </div>
    <?php
    } else {
      echo "You don't have any orders yet!";
    }

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
      Order number: <?php echo $row['o_id']; ?>
      </br>
      Status: <?php echo $row['status']; ?>
      </br>
      Cost: <?php echo $row['f_price']; ?>
      </br>
      Cash on delivery: <?php echo $row['pay_at_delivery'] ? "yes" : "no"; ?>
      </br>
      Sender pays: <?php echo $row['sender_pays'] ? "yes" : "no"; ?>
      
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
      }
        ?>
        </tbody>
      </table>
      <?php
      if ($status == "pending") {
      ?>
        <button type="submit" class="custom-button" onclick="markFailed('<?php echo $o_id; ?>')">
          Mark as failed
        </button>
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
        $(document).ready(function() {
          $('input[type="radio"]').click(function() {
            $.post('rating.php', {
              rating: $(this).val()
            });
          });
        });
      </script>
      <fieldset class="rating">
        <legend>Rate our company:</legend>
        <form method="post" action="rating.php">
          <input type="radio" id="star5" name="rating" value="5" /><label for="star5" title="5 stars">5 stars</label>
          <input type="radio" id="star4" name="rating" value="4" /><label for="star4" title="4 stars">4 stars</label>
          <input type="radio" id="star3" name="rating" value="3" /><label for="star3" title="3 stars">3 stars</label>
          <input type="radio" id="star2" name="rating" value="2" /><label for="star2" title="2 stars">2 stars</label>
          <input type="radio" id="star1" name="rating" value="1" /><label for="star1" title="1 star">1 star</label>
      </fieldset>
      <input type="submit" value="Submit Rating">
      </form>
      </br>
      <?php
      if (isset($_SESSION['message'])) {
        echo $_SESSION['message'];
        unset($_SESSION['message']);
      }
      ?>

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