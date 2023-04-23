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
  <style>
    table {
      border-collapse: collapse;
      width: 100%;
    }

    tr {
      border-bottom: 1px solid #ddd;
    }

    th {
      background-color: rgb(1, 1, 24);
      color: white;
    }
  </style>
</head>

<body>

  <h2>Track your order</h2>

  <!-- get orders id -->
  <?php
  require_once('connection.php');
  $c_id = $_SESSION['c_id'];
  $query = "SELECT o_id FROM orders WHERE c_id='$c_id' ORDER BY o_id";
  $result = mysqli_query($link, $query);
  if (($result) && (mysqli_num_rows($result) > 0)) {
  ?>
    <form method="post" action="track.php">
      <select id="mySelect" name="mySelect">
        <?php
        while ($row = mysqli_fetch_assoc($result)) { ?>
          <option value=<?php echo $row["o_id"] ?>> <?php echo $row["o_id"] ?></option>
        <?php } ?>
      </select>
      <input type="submit" value="Track">
    </form>
  <?php
  } else {
    echo "You don't have any orders yet!";
  } ?>


  <table border="border" id="trackTable">
    <thead>
      <tr>
        <th>Date and time</th>
        <th>Location</th>
        <th>By</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $o_id=0;
      if (isset($_POST['mySelect'])) {
        $o_id=$_POST['mySelect'];
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

  </br>

  <!-- rating -->
  <form action="rating.php" method="post">
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
  <?php
  if (isset($_SESSION['message'])) {
    echo $_SESSION['message'];
    unset($_SESSION['message']);
  }
  ?>

</body>

</html>

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