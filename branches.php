<?php
    
    require_once('connection.php');
    $query = "SELECT * FROM branches WHERE NOT 'still at client' OR 'delivered' ORDER BY branch;";
    $result = mysqli_query($link, $query);
    // if (($result) && (mysqli_num_rows($result) > 0)) {

        // while ($row = mysqli_fetch_assoc($result)) {
        // /*if (is_null($row["w_id"])) {
        //     $row["w_id"] = $_SESSION['c_name'] . "(you)";
        // }*/

        // echo "<option value= " . $row["branch"] .">". $row["branch"] . " </option>";
        // }
    // }
            return $result;
    ?>