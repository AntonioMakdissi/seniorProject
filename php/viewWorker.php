<?php
session_start();
if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']) {
    header('Location: login.html');
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Workers</title>
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

    <h2>Workers</h2>


    <table border="border">
        <thead>
            <tr>
                <th>Worker ID </th>
                <th>name</th>
                <th>dateOfBirth</th>
                <th>branch</th>
                <th>salary</th>
                <th>date joined</th>

            </tr>
        </thead>
        <tbody>
            <?php
            require_once('connection.php');
            $c_id = $_SESSION['c_id'];
            $query = "SELECT * FROM workers ";
            $result = mysqli_query($link, $query);
            if (($result) && (mysqli_num_rows($result) > 0)) {

                while ($row = mysqli_fetch_assoc($result)) {

                    $rmid=$row["w_id"];
                    echo "<tr>   
<td>#" . $row["w_id"] . "</td>
<td>" . $row["name"] . "</td>
<td>" . $row["dateOfBirth"] . "</td>
<td>" . $row["branch"] . "</td>
<td>" . $row["salary"] . "$</td>
<td>" . $row["timestamp"] . "</td>
<td> <a class='btn btn-primary btn-sm' name='n' value=$rmid href=http://localhost/web_project/removeworker.php?rmid=" . $rmid . ">Remove</a> </td>

                          
</tr>";
                }
            }
            ?>
        </tbody>
    </table>

</body>

</html>