<?php
session_start();
if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin'] || $_SESSION['type'] != 'CEO') {
    header('Location: login.php');
}

require_once 'php/connection.php';
require_once('php/stats.php');
require_once('php/employee.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>CEO</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="assets/img/icon.jfif" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Inter:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville:wght@700&display=swap" rel="stylesheet">


    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
    <link href="assets/vendor/aos/aos.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="assets/css/navbar.css" rel="stylesheet">
    <!-- <link href="assets/css/CEO.css" rel="stylesheet"> -->

    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .chart-container {
            width: 50%;
            height: 50vh;
            margin: auto;
        }
        .row {
    display: flex;
}

.chart-container {
    flex: 1;  /* makes it take up half the width */
    max-width: 50%; /* restrict the maximum width to 50% */
}
.purecounter {
    font-size: 50px;
}


    </style>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="header d-flex alignems-center fixed-top">
        <div class="container-fluid container-xl d-flex alignems-center justify-content-between">

            <a href="CEO.php" class="logo d-flex alignems-center">
                <!-- Uncomment the line below if you also wish to use an image logo -->
                <!-- <img src="assets/img/logo.png" alt=""> -->
                <h1 style="font-family: 'Libre Baskerville', serif;">SpeedRun</h1>
            </a>

            <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
            <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>
            <nav id="navbar" class="navbar">
                <ul>
                    <li><a href="CEO.php" class="active">Home</a></li>
                    <li><a href="php/viewWorker.php">Workers</a></li>
                    <li><a href="hire.php">Hire</a></li>
                    <li><a href="addBranches.php">Branches</a></li>
                    <li><a href="php/profit.php">Statistics</a></li>
                    <li><a href="viewMessages.php">Messages</a></li>
                    <li><a href="common_password.php">Change Password</a></li>
                    <li><a class="get-a-quote" href="php/logout.php">Logout</a></li>
                </ul>
            </nav><!-- .navbar -->

        </div>
    </header><!-- End Header -->
    <!-- End Header -->

    <!-- ======= Hero Section ======= -->
    <section id="hero" class="hero d-flex alignems-center" style="padding-top: 10%; height: 100%; ">
        <div class="container">
            <div class="row gy-4 d-flex justify-content-between">
                <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center">
                    <h2 data-aos="fade-up" style="margin-top: -15%;">Journey of a Leading Delivery Company
                        <?= $_SESSION['name'] ?>!
                    </h2>
                    <p data-aos="fade-up" data-aos-delay="100">"Success is not final, failure is not fatal: It is the
                        courage to continue that counts." - Winston Churchill. Keep pushing forward and striving for
                        excellence in every delivery, and you will find success in your company.</p>



                    <div class="row gy-4" data-aos="fade-up" data-aos-delay="400">

                            <div class="col-lg-3 col-6">
                                <div class="statsem text-center w-100 h-100">
                                    <span data-purecounter-start="0" data-purecounter-end=<?php echo nbr_clients($link); ?>
                                        data-purecounter-duration="1" class="purecounter"></span>
                                    <p>Clients</p>
                                </div>
                            </div><!-- End Stats Item -->

                        <div class="col-lg-3 col-6">
                            <div class="statsem text-center w-100 h-100">
                                <span data-purecounter-start="0" data-purecounter-end=<?php echo total_deliveries($link); ?> data-purecounter-duration="1"
                                    class="purecounter"></span>
                                <p>Deliveries</p>
                            </div>
                        </div><!-- End Stats Item -->

                        <div class="col-lg-3 col-6">
                            <div class="statsem text-center w-100 h-100">
                                <span data-purecounter-start="0" data-purecounter-end=<?php echo nbr_branches($link); ?>
                                    data-purecounter-duration="1" class="purecounter"></span>
                                <p>Branches</p>
                            </div>
                        </div><!-- End Stats Item -->

                        <div class="col-lg-3 col-6">
                            <div class="statsem text-center w-100 h-100">
                                <span data-purecounter-start="0" data-purecounter-end=<?php echo nbr_workers($link); ?>
                                    data-purecounter-duration="1" class="purecounter"></span>
                                <p>Workers</p>
                            </div>
                        </div><!-- End Stats Item -->

                    </div>
                </div>

                <div class="col-lg-5 order-1 order-lg-2 hero-img" data-aos="zoom-out">
                    <div class="image-container">
                        <img src="assets/img/hero-img.svg" class="img-fluid mb-3 mb-lg-0" alt="">
                    </div>
                </div>

            </div>
        </div>
    </section><!-- End Hero Section -->
    <main style="background-color:transparent;">
        <div data-aos="fade-up">

        <div class="row">
    <div class="chart-container">
        <canvas id="myChart1" width="700" height="400"></canvas>
    </div>
    <div class="chart-container" style="margin-top: 5%; margin-bottom:5%;">
        <canvas id="myChart2" width="700" height="400"></canvas>
    </div> 
</div>

            <div class="container" style="margin-top: 100px;">
                <table class="statistics-table">
                    <thead>
                        <tr>
                            <th>Statistics of the month(recent 30 days)</th>
                            <th>Value</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Number of successful Deliveries</td>
                            <td>
                                <?php
                                echo successful_deliveriesm($link);
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Pending Deliveries</td>
                            <td>
                                <?php echo pending_deliveriesm($link); ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Failed Deliveries</td>
                            <td>
                                <?php echo failed_deliveriesm($link); ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Number of deliveries this month</td>
                            <td>
                                <?php
                                $delm = delm($link);
                                echo $delm; ?>
                            </td>
                        </tr>


                        <tr>
                            <td>Employee of the month</td>
                            <td>
                                <?php
                                $emp = mvpm($link);
                                echo getEmpById($link, $emp); ?>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
            <!--  -->
            <div class="container" style="margin-top: 5%; margin-bottom:5%;">
                <table class="statistics-table">
                    <thead>
                        <tr>
                            <th>Statistics(lifetime)</th>
                            <th>Value</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Number of successful Deliveries</td>
                            <td>
                                <?php
                                echo successful_deliveries($link);
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Pending Deliveries</td>
                            <td>
                                <?php echo pending_deliveries($link); ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Failed Deliveries</td>
                            <td>
                                <?php echo failed_deliveries($link); ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Total Deliveries</td>
                            <td>
                                <?php echo total_deliveries($link); ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Customer Satisfaction</td>
                            <td>
                                <?php echo rating($link); ?> /5
                            </td>
                        </tr>
                        <tr>
                            <td>Employee with most deliveries(lifetime)</td>
                            <td>
                                <?php
                                $emp = mvp($link);
                                echo getEmpById($link, $emp); ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
           
        </div>
    </main>
    <?php
    require_once('php/connection.php');
    $query = "SELECT MONTH(orders.date) AS month, COUNT(o_id) AS count FROM orders WHERE orders.date >= DATE_SUB(CURDATE(), INTERVAL 12 MONTH) GROUP BY MONTH(orders.date) ORDER BY MONTH(orders.date) ASC";
    $result = mysqli_query($link, $query);
    if ($result && mysqli_num_rows($result) > 0) {
        $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
        // Process the result rows
        $months = [];
        $orderCounts = [];
        for ($i = 1; $i <= 12; $i++) {
            $months[] = date('F', mktime(0, 0, 0, $i, 1));
            $orderCounts[] = 0;
        }
        foreach ($rows as $row) {
            $monthIndex = intval($row['month']) - 1;
            $orderCounts[$monthIndex] = intval($row['count']);
        }

        // Save the PHP arrays as JSON strings
        $monthsJSON = json_encode($months);
        $orderCountsJSON = json_encode($orderCounts);
        // $deliveriesJSON = json_encode($deliveries);
        // $salesJSON = json_encode($sales);
    } else {
        echo 'No data available.';
    }

    $query2 = "SELECT MONTH(orders.date) AS month, SUM(charge) AS total_profit FROM orders NATURAL JOIN packages WHERE orders.date >= DATE_SUB(CURDATE(), INTERVAL 12 MONTH) GROUP BY MONTH(orders.date) ORDER BY MONTH(orders.date) ASC";
    $result2 = mysqli_query($link, $query2);
    if ($result2 && mysqli_num_rows($result2) > 0) {
        $rows = mysqli_fetch_all($result2, MYSQLI_ASSOC);
        // Process the result rows
        $months = [];
        $profitData = [];
        for ($i = 1; $i <= 12; $i++) {
            $months[] = date('F', mktime(0, 0, 0, $i, 1));
            $profitData[] = 0;
        }
        foreach ($rows as $row) {
            $monthIndex = intval($row['month']) - 1;
            $profitData[$monthIndex] = intval($row['total_profit']);
        }
        // Save the PHP arrays as JSON strings
        $monthsJSON = json_encode($months);
        $profitDataJSON = json_encode($profitData);
    } else {
        echo 'No data available.';
    }
    ?>

    <script>
        // Parse the PHP JSON strings into JavaScript arrays
        var months = JSON.parse('<?= $monthsJSON ?>');
        // var deliveries = JSON.parse('<= $deliveriesJSON ?>');
        var profitData = JSON.parse('<?= $profitDataJSON ?>');
        var orderCounts = JSON.parse('<?= $orderCountsJSON ?>');

        var ctx = document.getElementById('myChart1').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: months,
                datasets: [{
                    label: 'Number of Orders',
                    data: orderCounts,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });


        var ctx2 = document.getElementById('myChart2').getContext('2d');
        var myChart2 = new Chart(ctx2, {
            type: 'bar',
            data: {
                labels: months,
                datasets: [{
                    label: 'Profit',
                    data: profitData,
                    backgroundColor: 'rgba(153, 102, 255, 0.2)',
                    borderColor: 'rgba(153, 102, 255, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
    <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="assets/vendor/aos/aos.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>
</body>

</html>