<?php
session_start();
if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']) {
    header('Location: login.php');
} ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
    <title>
        History
    </title>
    <!-- <link rel="stylesheet" href="assets/css/header.css"> -->
    <link rel="stylesheet" href="assets/css/navbar.css">
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


    <style>

    </style>
</head>

<body>
    <header id="header" class="header d-flex alignems-center fixed-top ">
        <div class="container-fluid container-xl d-flex alignems-center justify-content-between">

            <a href="branchOrders.php" class="logo d-flex alignems-center" style="text-decoration: none;">
                <!-- Uncomment the line below if you also wish to use an image logo -->
                <!-- <img src="assets/img/logo.png" alt=""> -->
                <h1 style="font-family: 'Libre Baskerville', serif;">SpeedRun</h1>
            </a>

            <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
            <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>
            <nav id="navbar" class="navbar">
                <ul>
                    <ul>
                        <!-- <li><a href="client.html" class="active">Home</a></li> -->
                        <li><a href="branchOrders.php">Home</a></li>
                        <li><a href="manager.php">History</a></li>
                        <li><a href="outsidetrack.php">Track</a></li>
                        <li><a href="viewMessages.php">Messages</a></li>
                        <li><a href="common_password.php">Change Password</a></li>
                        <li><a class="get-a-quote" href="php/logout.php">Logout</a></li>
                    </ul>
            </nav><!-- .navbar -->

        </div>
    </header><!-- End Header -->

    <section id="hero" class="hero " style="padding-top: 20px; height: 100%; ">
        <div class="container">
            <div class="container mx-auto px-4 py-12">
                <h1 class="text-4xl font-bold mb-6" style="color:white; margin-top:10%;">Orders history</h1>
                <!-- <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg mb-8"> -->
                <div class="table-responsive">
                    <table class="table extreme-table">
                        <thead>
                            <tr>
                                <th scope="col">Order number </th>
                                <th scope="col">From</th>
                                <th scope="col">Phone sender</th>
                                <th scope="col">Address</th>
                                <th scope="col">Current location</th>
                                <th scope="col">To</th>
                                <th scope="col">Phone receiver</th>
                                <th scope="col">Last stop</th>
                                <th scope="col">Drop off</th>
                                <th scope="col">Price</th>
                                <th scope="col">Payer</th>
                                <th scope="col">Cash?</th>
                                <th scope="col">Fragile?</th>
                                <th scope="col">Urgent?</th>
                                <th scope="col">Status</th>
                                <th scope="col">Date and time</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            require_once('php/connection.php');

                            $current_location = $_SESSION['branch'];
                            $perPage = 15; // Change this to how many items you would like per page
                            if (isset($_GET['page']) && !empty($_GET['page'])) {
                                $page = $_GET['page'];
                            } else {
                                $page = 1;
                            }

                            $start = ($page - 1) * $perPage;

                            $query = 0;
                            if (isset($_GET['status'])) {
                                $status = $_GET['status'];

                                $query = "SELECT * FROM orders NATURAL JOIN packages NATURAL JOIN clients
                                    NATURAL JOIN (
                                        SELECT o_id, MAX(d_id) AS max_d_id
                                        FROM deliveries
                                        GROUP BY o_id
                                    ) AS last_delivery
                                    NATURAL JOIN deliveries
                                    WHERE (current_location = '$current_location'
                                    OR (current_location='still at client' AND c_district='$current_location'))
                                    AND status = '$status'
                                    AND deliveries.d_id = last_delivery.max_d_id
                                    ORDER BY urgent DESC, date";
                            } else {
                                $query = "SELECT * FROM orders NATURAL JOIN packages NATURAL JOIN clients
                                    NATURAL JOIN (
                                        SELECT o_id, MAX(d_id) AS max_d_id
                                        FROM deliveries
                                        GROUP BY o_id
                                    ) AS last_delivery
                                    NATURAL JOIN deliveries
                                    WHERE (current_location = '$current_location'
                                    OR (current_location='still at client' AND c_district='$current_location'))
                                    AND status != 'pending'
                                    AND deliveries.d_id = last_delivery.max_d_id ORDER BY urgent DESC, date DESC";
                            }

                            $result = mysqli_query($link, $query);
                            $totalCount = mysqli_num_rows($result);
                            $totalPages = ceil($totalCount / $perPage);

                            if ($totalCount > 0) {
                                $query .= " LIMIT $start, $perPage";
                                $result = mysqli_query($link, $query);
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $cash = 'yes';
                                    $fragile = 'yes';
                                    $payer = 'sender';
                                    $urgent = 'yes';
                                    if ($row["pay_at_delivery"] == 0) {
                                        $cash = 'no';
                                    }
                                    if ($row["fragile"] == 0) {
                                        $fragile = 'no';
                                    }
                                    if ($row["urgent"] == 0) {
                                        $urgent = 'no';
                                    }
                                    if ($row["sender_pays"] == 0) {
                                        $payer = 'receiver';
                                    }
                                    echo "<tr>
                                        <td scope=\"row\">#" . $row["o_id"] . "</td>
                                        <td>" . $row["c_name"] . "</td>
                                        <td>" . $row["c_phone"] . "</td>
                                        <td>" . $row["c_address"] . "</td>
                                        <td>" . $row["current_location"] . "</td>
                                        <td>" . $row["to_name"] . "</td>
                                        <td>" . $row["to_phone"] . "</td>
                                        <td>" . $row["to_district"] . "</td>
                                        <td>" . $row["to_address"] . "</td>
                                        <td>" . $row["f_price"] . "$</td>
                                        <td>" . $payer . "</td>
                                        <td>" . $cash . "</td>
                                        <td>" . $fragile . "</td>
                                        <td>" . $urgent . "</td>
                                        <td>" . $row["status"] . "</td>
                                        <td>" . $row["timestamp"] . "</td>";

                                    if ($row['status'] == "failed") {
                                        echo '<td><button type="submit" class="submit-button" onclick="resendOrder(\'' . $row['o_id'] . '\')">Resend order</button></td>';
                                    }

                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td id=\"colspanTD\">No results found.</td></tr>";
                            }
                            ?>

                        </tbody>
                    </table>
                </div>
                <div class="flex justify-center mt-4">
                        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                            <a  style="text-decoration: none;" href="?page=<?= $i; ?>"
                                class="mx-2 px-4 py-2 text-white bg-blue-500 hover:bg-blue-700 rounded-full <?= $i == $page ? 'bg-green-500' : '' ?>"><?= $i; ?></a>
                        <?php endfor; ?>
                    </div>

            </div>
        </div>
    </section>

    <script>
        function resendOrder(o_id) {
            if (confirm('Are you sure you want to resend this order?')) {
                window.location.href = 'http://localhost/seniorProject/php/resendOrder.php?o_id=' + o_id;
            }
        }
    </script>
    <script>
        window.addEventListener('keydown', function (e) {
            // Get the table container
            var tableContainer = document.querySelector('.table-responsive');

            // Set the amount of pixels to scroll
            var scrollAmount = 50;

            // Check which key was pressed
            switch (e.key) {
                case "ArrowRight":
                    // Scroll to the right
                    tableContainer.scrollLeft += scrollAmount;
                    break;
                case "ArrowLeft":
                    // Scroll to the left
                    tableContainer.scrollLeft -= scrollAmount;
                    break;
            }
        });

    </script>
    <script>
        document.addEventListener('keydown', function (e) {
            switch (e.key) {
                case '+':
                    if (<?= $page ?> < <?= $totalPages ?>) {
                        window.location.href = "?page=" + (<?= $page ?> + 1);
                    }
                    break;
                case '-':
                    if (<?= $page ?> > 1) {
                        window.location.href = "?page=" + (<?= $page ?> - 1);
                    }
                    break;
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