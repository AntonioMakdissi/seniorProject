<?php
require_once 'connection.php';
session_start();
if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']) {
    header('Content-Type: application/json');
    echo json_encode(['error' => 'Not logged in']);
    exit;
}
extract($_POST);

$query = "SELECT * FROM branches WHERE branch='$branch_location'"; //check duplicate
$result = mysqli_query($link, $query);
if (($result) && (mysqli_num_rows($result) < 1)) {

    $query = "INSERT INTO branches VALUES ('$branch_location')";

    if (mysqli_query($link, $query)) {
        include_once('employee.php');
        $output = promoteManager($link, $manager, $branch_location);
        
        // After the branch is added, fetch updated branch list
        $query = "SELECT * FROM branches";
        $result = mysqli_query($link, $query);

        $branches = [];
        while($row = mysqli_fetch_assoc($result)) {
            $branches[] = $row;
        }

        header('Content-Type: application/json');
        echo json_encode(['success' => $output, 'branches' => $branches]);
        exit;
    }
} else {
    header('Content-Type: application/json');
    echo json_encode(['error' => 'Already added!']);
    exit;
}
