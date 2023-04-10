<?php
$db_server = '127.0.0.1';
$db_user = 'root';
$db_passwd = '';
$db_DB = 'cargoapp';

$link = mysqli_connect($db_server, $db_user, $db_passwd);

//ALTER TABLE `registered` ADD  FOREIGN KEY (`c_id`) REFERENCES `courses`(`c_id`) ON DELETE CASCADE ON UPDATE CASCADE;

if (!$link) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    die('error connecting'); // exit;
}

mysqli_select_db($link, $db_DB);
?>