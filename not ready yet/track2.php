<?php
session_start();
if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']) {
  header('Location: ../login.html');
}
require_once 'connection.php';
require_once('employee.php');

if (!isset($page_loaded)) {
  $page_loaded = true;
}
?>

<!DOCTYPE html>
<html>

<head>

</head>

<body>
  <?php
  $c_id = $_SESSION['c_id'];
  $query = "SELECT o_id FROM orders WHERE c_id='$c_id' ORDER BY o_id";
  $result = mysqli_query($link, $query);
  if (($result) && (mysqli_num_rows($result) > 0)) {
    ?>
    <div style="display: flex; justify-content: center;">
      <select id="order-select" style="position: relative; display: inline-block;  margin: 20px;">
        <option value="" disabled selected>Select your order id</option>
        <?php
        while ($row = mysqli_fetch_assoc($result)) { ?>
          <option value=<?php echo $row["o_id"] ?>> #<?php echo $row["o_id"] ?></option>
        <?php } ?>
      </select>
    </div>
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Date and time</th>
          <th>Location</th>
          <th>By</th>
        </tr>
      </thead>
      <tbody id="order-tracking">
      </tbody>
    </table>
    <!-- <script>
        // listen for changes in the select element
        document.getElementById('order-select').addEventListener('change', function() {
          var orderId = this.value;
          if (orderId) {
            // make an AJAX request to the same file with the selected order ID
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'track2.php');
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
              if (xhr.status === 200) {
                // parse the response as a JSON object
                var response = JSON.parse(xhr.responseText);
                // get the table body element
                var tableBody = document.getElementById('order-tracking');
                // clear the table
                tableBody.innerHTML = '';
                // loop through the tracking information and add a row for each entry
                for (var i = 0; i < response.length; i++) {
                  var row = '<tr>' +
                            '<td>' + response[i].timestamp + '</td>' +
                            '<td>' + response[i].location + '</td>' +
                            '<td>' + response[i].employee + '</td>' +
                            '</tr>';
                  tableBody.innerHTML += row;
                }
              }
            };
            xhr.send('order_id=' + orderId);
          }
        });
      </script> -->
    <script>
      // listen for changes in the select element
      document.getElementById('order-select').addEventListener('change', function () {
        var orderId = this.value;
        if (orderId) {
          // make an AJAX request to the same file with the selected order ID
          var xhr = new XMLHttpRequest();
          xhr.open('POST', 'track2.php');
          xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
          xhr.onload = function () {
            if (xhr.status === 200) {
              // parse the response as a JSON object
              var response = JSON.parse(xhr.responseText);
              // get the table body element
              var tableBody = document.getElementById('order-tracking');
              // clear the table
              tableBody.innerHTML = '';
              // loop through the tracking information and add a row for each entry
              for (var i = 0; i < response.length; i++) {
                var row = '<tr>' +
                  '<td>' + response[i].timestamp + '</td>' +
                  '<td>' + response[i].location + '</td>' +
                  '<td>' + response[i].employee + '</td>' +
                  '</tr>';
                tableBody.innerHTML += row;
              }
              // update the modal content
              var modalBody = document.getElementById('order-tracking-modal');
              modalBody.innerHTML = '';
              for (var i = 0; i < response.length; i++) {
                var row = '<tr>' +
                  '<td>' + response[i].timestamp + '</td>' +
                  '<td>' + response[i].location + '</td>' +
                  '<td>' + response[i].employee + '</td>' +
                  '</tr>';
                modalBody.innerHTML += row;
              }
              // show the modal
              $('#tracking-modal').modal('show');
            }
          };
          xhr.send('order_id=' + orderId);
        }
      });
    </script>

    <?php
  } else {
    echo "You don't have any orders yet!";
  }
  ?>
  </div>
</body>

</html>