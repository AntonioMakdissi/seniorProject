<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <title>Document</title>
</head>

<body>
    <?php
    if (isset($_POST['email']) && isset($_POST['password'])) {
        require('connection.php');
        extract($_POST); //$email and $password

        //insert code for duplicate check

        $email = $_POST['email'];
        $email = mysqli_real_escape_string($link, $email); //strip email from escape charcters

        $pass = $_POST['password'];
        $password = md5($pass);

        $c_name = $_POST['name'];
        $c_phone = $_POST['phone'];
        $c_address = $_POST['address'];
        $c_address = mysqli_real_escape_string($link, $c_address);
        /*GPS
        $c_longitude=$_POST['longitude'];
        $c_latitude=$_POST['latitude'];*/
        $c_district = $_POST['district'];
        $guest = false;


        $query = "SELECT * FROM users WHERE email='$email'"; //check duplicate
        $result = mysqli_query($link, $query);
        if (($result) && (mysqli_num_rows($result) < 1)) {

            $query = "INSERT INTO users(email,password) VALUES ('$email','$password')";

            if (mysqli_query($link, $query)) {
                // this returns the id that mysql used for the new tuple
                //if successful ->Login
                $u_id = mysqli_insert_id($link);

                //u_id,pay_id,c_name,c_phone,c_address,c_longitude,c_latitude,c_district,guest,rating`) 
                //VALUES ('3', NULL, 'test3', 'test3', 'test3', NULL, NULL, 'Batroun','0', NULL);
                $query = "INSERT INTO clients(u_id,c_name,c_phone,c_address,c_district,guest) 
                VALUES ('$u_id','$c_name','$c_phone','$c_address','$c_district','$guest')";

                if (mysqli_query($link, $query)) {
                    //LOGIN CODE
                    $query = "SELECT * FROM users WHERE email = '$email';";

                    $result = mysqli_query($link, $query);
                    if (($result) && (mysqli_num_rows($result) == 1)) {
                        $u_info = mysqli_fetch_assoc($result);

                        if (($u_info['email'] == $email) &&
                            ($u_info['password'] == md5($pass))
                        ) {
                            session_start();
                            $_SESSION['loggedin'] = true;
                            $_SESSION['email'] = $u_info['email'];
                            $_SESSION['u_id'] = $u_info['u_id'];
                            $_SESSION['type'] = $u_info['type'];
                            //get his other information?
                            if ($_SESSION['type'] == 'client') {
                                header('Location: client.php');
                            } else if ($_SESSION['type'] == 'CEO') {
                                header('Location: ceo.php'); //CEO page
                            } else if ($_SESSION['type'] == 'worker') {
                                header('Location: worker.php'); //worker page
                            } else if ($_SESSION['type'] == 'BranchManager') {
                                header('Location: manager.php'); //BranchManager page
                            }
                            header('Location: login.html'); //to be revised
                        } else {
                            //header('Location: login.html');
                            echo "-2";
                        }
                    } else {
                        //header('Location: login.html');
                        echo "-3";
                    }
                    mysqli_close($link);
                } else {
                    echo "-1";
                }
            }
        }
    } else {
        //header('Location: login.html');
        echo "-1";
    }

    ?>
</body>

</html>