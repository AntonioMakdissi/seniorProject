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

        $email = $_POST['email'];
        $email = mysqli_real_escape_string($link, $email); //strip email from escape charcters

        $pass = $_POST['password'];
        $password = md5($pass);

        $query = "INSERT into users(email,password) values('$email','$password')";
        if (mysqli_query($link, $query)) {
            // this returns the id that mysql used for the new tuple
            //if succeful ->Login
            //require('connection.php');


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
                    header('Location: main.php'); //to be revised
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
    } else {
        //header('Location: login.html');
        echo "-1";
    }

    ?>
</body>

</html>