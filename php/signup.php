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


        $recaptcha_response = $_POST['g-recaptcha-response'];
        $recaptcha_secret = '6LcKXUAmAAAAANJrDtZklxuRxjZytaxwxQNB_J3r'; // Replace with your secret key obtained from the reCAPTCHA admin console
        $recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';

        $recaptcha = file_get_contents($recaptcha_url . '?secret=' . $recaptcha_secret . '&response=' . $recaptcha_response);
        $recaptcha_data = json_decode($recaptcha);

        if (!$recaptcha_data->success) {
            echo 'Failed to verify reCAPTCHA. Please try again.';
            exit;
        }
        // Proceed with your signup logic if reCAPTCHA is verified successfully



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
        $c_district = str_replace("%20", " ", $_POST['district']);
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
                                $query = "SELECT * FROM clients WHERE u_id = '$u_id';"; //get its info
                                $result = mysqli_query($link, $query);
                                $u_info = mysqli_fetch_assoc($result);
                                $_SESSION['c_id'] = $u_info['c_id'];
                                $_SESSION['c_name'] = $u_info['c_name'];
                                $_SESSION['c_address'] = $u_info['c_address'];
                                $_SESSION['phone'] = $u_info['phone'];
                                $_SESSION['c_longitude'] = $u_info['c_longitude'];
                                $_SESSION['c_latitude'] = $u_info['c_latitude'];
                                $_SESSION['c_district'] = $u_info['c_district'];
                                $_SESSION['c_timestamp'] = $u_info['c_timestamp'];
                                //$_SESSION['guest'] = $u_info['guest'];
                                //$_SESSION['rating'] = $u_info['rating'];
                                header('Location: ../client.php');
                                //$c_id = $_SESSION['c_id'];
                                //echo "$c_id";
                            } else {
                                $query = "SELECT * FROM workers WHERE u_id = '$u_id';"; //get its info
                                $result = mysqli_query($link, $query);
                                $u_info = mysqli_fetch_assoc($result);
                                $_SESSION['w_id'] = $u_info['w_id'];
                                if ($_SESSION['type'] == 'CEO') {
                                    header('Location: ../CEO.php'); //CEO page
                                    //echo "CEO";
                                } else if ($_SESSION['type'] == 'worker') {
                                    header('Location: ../worker.php'); //worker page
                                    //echo "worker";
                                } else if ($_SESSION['type'] == 'BranchManager') {
                                    header('Location: ../manager.php'); //BranchManager page
                                    //echo "manager";
                                } else if ($_SESSION['type'] == 'IT') {
                                    header('Location: ../IT.php'); //BranchManager page
                                    //echo "manager";
                                }
                            }
                            //header('Location: ../login.html'); //to be revised
                            //echo "1";
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
                    echo "Error inserting user information";
                }
            }
        } else {
            echo "Already have an account!";
        }
    } else {
        //header('Location: login.html');
        echo "Error connecting to database";
    }

    ?>
</body>

</html>