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

  <select>

    <?php
    require_once('connection.php');
    $c_id = $_SESSION['c_id'];
    $query = "SELECT o_id FROM orders WHERE c_id='$c_id' ORDER BY o_id";
    $result = mysqli_query($link, $query);
    if (($result) && (mysqli_num_rows($result) > 0)) {

      while ($row = mysqli_fetch_assoc($result)) { ?>
        <option value=<?php echo $row["o_id"] ?>> <?php echo $row["o_id"] ?></option>
    <?php }
    } ?>
  </select>

  <table border="border">
    <thead>
      <tr>
        <th>Date and time</th>
        <th>Location</th>
        <th>By</th>
      </tr>
    </thead>
    <tbody>
      <?php
      require_once('connection.php');
      $c_id = $_SESSION['c_id'];
      //$o_id = $_GET['o_id'];
      $query = "SELECT * FROM orders NATURAL JOIN deliveries WHERE c_id='$c_id' ORDER BY timestamp";
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

</body>

</html>