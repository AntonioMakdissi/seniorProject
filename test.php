<?php
require_once('php/branches.php');
require_once 'php/connection.php';
$tot= all_branches($link);
foreach ($tot as $item) {
    echo $item . "<br>";
}
// $tot= all_locations($link);
// foreach ($tot as $item) {
//     echo $item . "<br>";
// }
