<?php
session_start();
if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']) {
    header('Location: ../login.html');
}
require_once 'connection.php';
extract($_GET);
$c_id = $_SESSION['c_id'];

/*$name = $_GET['name'];
$name = str_replace("%20"," ",$name);*/

/*code with GPS
$query = "INSERT into packages(width, height, weight, message, to_address, p_longitude, p_latitude, to_district, fragile, o_price, cost, f_price, pay_at_delivery) 
values('$width','$height','$weight', '$message', '$to_address', '$p_longitude', '$p_latitude', '$to_district', '$fragile', '$o_price', '$cost', '$f_price', '$pay_at_delivery')";
*/
$query = "INSERT into packages(width, height, weight, message, to_address,to_district, fragile, o_price, cost, f_price, pay_at_delivery) 
values('$width','$height','$weight', '$message', '$to_address', '$to_district', '$fragile', '$o_price', '$cost', '$f_price', '$pay_at_delivery')";

if (mysqli_query($link, $query)) {
    //echo mysqli_insert_id($link); //debug
    $p_id = mysqli_insert_id($link);

    //insert to orders too if successful
    $query = "INSERT INTO orders (p_id, c_id) VALUES ($p_id, $c_id);";
    if (mysqli_query($link, $query)) {
        //echo mysqli_insert_id($link); //debug
        $o_id = mysqli_insert_id($link);

        //insert to deliveries too if successful
        $query = "INSERT INTO deliveries (o_id) VALUES ('$o_id');";
        if (mysqli_query($link, $query)) {
            echo mysqli_insert_id($link);
        }
    }
} else {
    echo "-1";
    //header('Location: seriesList.php');
}
