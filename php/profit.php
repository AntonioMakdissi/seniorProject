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

  <h2>Orders history</h2>


  <table border="border">
    <thead>
      <tr>
        <th>Order number </th>
        <th>Date and time</th>
        <th>Cost</th>
        <th>Profit</th>
        <th>Price for customer</th>
        <th>status</th>
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
<td>" . $row["cost"] . "$</td>
<td>" . $row["charge"] . "</td>
<td>" . $row["f_price"] . "</td>
<td>" . $row["status"] . "</td>
							
</tr>";
        }
      }
      ?>
    </tbody>
  </table>

</body>

</html>