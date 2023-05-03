<?php
require_once 'connection.php';
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']) {
  header('Location: login.php');
}

//function search($link)
$query = 0;
if (isset($_POST['submit'])) {
  $selected_worker = $_POST['worker'];
  $selected_worker2 = explode(" ", $_POST['worker']); //make to array
  if (count($selected_worker2) < 2) {
    $f1 = $selected_worker2[0];
    $query = "SELECT * FROM workers NATURAL JOIN users WHERE ('name' LIKE '" . $f1 . "%' OR w_id LIKE'" . $f1 . "%' OR branch LIKE '" . $selected_worker . "%') AND type != 'CEO' ORDER BY w_id ASC";
  } else {
    $f1 = $selected_worker2[0];
    $f2 = $selected_worker2[1];
    $query = "SELECT * FROM workers NATURAL JOIN users WHERE (name LIKE '" . $f1 . "%' OR w_id LIKE '" . $f2 . "%' OR branch LIKE '" . $selected_worker . "%') AND type != 'CEO' ORDER BY w_id ASC";
  }
} else {

  $query = "SELECT * FROM workers NATURAL JOIN users ORDER BY w_id ASC";
}
$result = mysqli_query($link, $query);
$_SESSION['result'] = $result;
//$_POST = array();

//if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  header('Location: test.php');
//}


// if (($result) && (mysqli_num_rows($result) > 0)) {

//   // $i = 0;
//   // while ($row = mysqli_fetch_assoc($result)) {

//   //   $messages[0][$i] = $row["timestamp"];
//   //   $messages[1][$i] = $row['w_id'];
//   //   $messages[2][$i] = $row['name'];
//   //   $messages[3][$i] = $row["salary"];
//   //   $messages[4][$i] = $row["branch"];
//   //   $messages[5][$i] = $row['type'];
//   //   $messages[6][$i] = $row['phone'];
//   //   $messages[7][$i] = $row['dateOfBirth'];
//   //   ++$i;
//   // }
//   // return $messages;

//   $output = mysqli_fetch_assoc($result);
// } else {
//   $output=-1;
// }
