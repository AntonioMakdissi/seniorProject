<div class="md:col-span-2 mb-6">
    <label class="block text-sm font-medium text-white-700 mb-2">Search Worker by Name:</label>
    <div class="flex">
        <form id="searchForm" action="test.php" method="post">
            <input name="worker" type="text" id="searchWorker" placeholder="Enter worker name">
            <button name="submit" type="submit" id="searchButton" style="margin-left:1%;">Search</button>
        </form>
        <a href="http://localhost/seniorProject/php/test.php">
        <button name="show" type="submit" id="showButton" style="margin-left:1%;">Show All</button>
        </a>
       
    </div>
</div>
<table class="table table-striped">
    <thead>
        <tr>
            <th>Worker ID</th>
            <th>Name</th>
            <th>BirthDate</th>
            <th>Phone</th>
            <th>Type</th>
            <th>Branch</th>
            <th>Salary</th>
            <th>Date joined</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        require_once 'connection.php';
        $query = 0;
        if (isset($_POST['submit'])) {
            $selected_worker = $_POST['worker'];
            //$selected_worker2 = explode(" ", $_POST['worker']); //make to array

            //$selected_worker = $selected_worker2[0];
            $query = "SELECT * FROM workers NATURAL JOIN users WHERE ( name LIKE '$selected_worker%' OR w_id LIKE'$selected_worker%' OR branch LIKE '$selected_worker%') ORDER BY w_id ASC";
        } else {

            $query = "SELECT * FROM workers NATURAL JOIN users ORDER BY w_id ASC";
        }
        $result = mysqli_query($link, $query);
        if (($result) && (mysqli_num_rows($result) > 0)) {

            while ($row = mysqli_fetch_assoc($result)) {

                $rmid = $row["u_id"];
                echo "<tr>   
<td>#" . $row["w_id"] . "</td>
<td>" . $row["name"] . "</td>
<td>" . $row["dateOfBirth"] . "</td>
<td>" . $row["phone"] . "</td>
<td>" . $row["type"] . "</td>
<td>" . $row["branch"] . "</td>
<td>" . $row["salary"] . "$</td>
<td>" . $row["timestamp"] . "</td> ";
                if ($row["type"] == 'CEO') {
                    echo "<td></td>                
  </tr>";
                } else {
        ?>
                    <td> <a name="rmid" value='<?php $rmid ?>' <?php echo "href=http://localhost/seniorProject/php/fireworker.php?rmid=$rmid" ?>> <button type=\"submit\" class=\"custom-button\">Fire</button></a> </td>


                    </tr><?php
                        }
                    }
                }

                            ?>
    </tbody>
</table>