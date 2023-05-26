<?php
session_start();
if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin'] || ($_SESSION['type'] != 'IT' && $_SESSION['type'] != 'CEO')) {
    header('Location: login.php');
}
require_once("php/connection.php");
//include_once 'php/search.php';
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
    <title>IT Page</title>
    <link rel="stylesheet" href="assets/css/it.css">
    <link rel="stylesheet" href="assets/css/header.css">
    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Inter:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <!-- <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet"> -->
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
    <link href="assets/vendor/aos/aos.css" rel="stylesheet">

</head>

<body class="bg-gray-100">
    <header id="header" class="header d-flex align-items-center fixed-top">
        <div class="container-fluid container-xl d-flex align-items-center justify-content-between">


            <?php if ($_SESSION['type'] == 'CEO') { ?>
                <a href="CEO.php" class="logo d-flex align-items-center">
                    <!-- Uncomment the line below if you also wish to use an image logo -->
                    <!-- <img src="assets/img/logo.png" alt=""> -->
                    <h1 style="font-family: 'Libre Baskerville', serif; padding-left: 20px;">SpeedRun</h1>
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
            <?php } else { ?>
                <a href="IT.php" class="logo d-flex align-items-center">
                    <!-- Uncomment the line below if you also wish to use an image logo -->
                    <!-- <img src="assets/img/logo.png" alt=""> -->
                    <h1 style="font-family: 'Libre Baskerville', serif; padding-left: 20px;">SpeedRun</h1>
                </a>

                <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
                <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>
                <nav id="navbar" class="navbar">
                    <ul>                    
                    <li><a href="php/viewWorker.php">Workers</a></li>
                        <li><a href="hire.php">Hire</a></li>
                        <li><a href="addBranches.php" class="active">Branches</a></li>
                        <li><a href="viewMessages.php">Messages</a></li>
                        <li><a href="common_password.php">Change Password</a></li>
                        <li><a class="get-a-quote" href="php/logout.php">Logout</a></li>
                    </ul>
                </nav>
            <?php } ?>




        </div>
    </header>
    <section id="hero" class="hero d-flex align-items-center" style="padding-top: 20px; height: 100%; ">
        <div class="container">
            <div class="container mx-auto px-4 py-12">
                <div id="branch">
                    <!-- Add Branch Table -->
                    <h1 class="text-4xl font-bold mb-6" style="padding-left:1%;">Branch Management</h1>
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg mb-8">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-800">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                        Date and Time</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                        Branch Location</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                        Branch Manager Name</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                        Branch Manager Email</th>
                                    <!-- <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                        Branch Manager Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                    </th> -->
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <!-- <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">3/3/2023</td>
                                    <td class="px-6 py-4 whitespace-nowrap">7:52 PM</td>
                                    <td class="px-6 py-4 whitespace-nowrap">Bint Jbeil</td>
                                    <td class="px-6 py-4 whitespace-nowrap">Georges Issa</td>
                                    <td class="px-6 py-4 whitespace-nowrap">grg@hotmail.com</td>
                                    <td class="px-6 py-4 whitespace-nowrap">New</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                         <div class="flex justify-center items-center">
                                        <button class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">Done</button>
                                    </div> -->
                                </td>
                                </tr>
                                <?php
                                include('php/branches.php');
                                $all = branchesinfo($link);
                                if ($all == -1) {
                                    echo "no branches";
                                } else {
                                    for ($i = 0; $i < count($all[0]); ++$i) {
                                        echo "<tr>";
                                        echo "<td class='px-6 py-4 whitespace-nowrap'>" . $all[0][$i] . "</td>";
                                        echo "<td class='px-6 py-4 whitespace-nowrap'>" . $all[1][$i] . "</td>";
                                        echo "<td class='px-6 py-4 whitespace-nowrap'>" . $all[2][$i] . "</td>";
                                        echo "<td class='px-6 py-4 whitespace-nowrap'>" . $all[3][$i] . "</td>";
                                        echo "</tr>";
                                    }
                                }
                                ?>

                            </tbody>
                        </table>
                    </div>

                    <!-- Add Branch Form -->
                    <form action="php/addbranch.php" method="post" class="php-email-form grid grid-cols-1 gap-6 md:grid-cols-2" style="padding-bottom: 100px;">

                        <div>
                            <label class="block text-sm font-medium text-white-700">Branch Location</label>
                            <input type="text" name="branch_location" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required placeholder="Enter branch location">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-white-700">Branch Manager</label>
                            <select id="manager" name="manager" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                                <option value="" selected disabled hidden>Select from workers</option>
                                <?php
                                require_once('php/employee.php');
                                $all = workersavailable($link);
                                if ($all == -1) {
                                    echo "no one available";
                                } else {
                                    for ($col = 0; $col < count($all[0]); ++$col) {
                                        $id = $all[0][$col];
                                        $n = trim($all[1][$col]);

                                        echo "<option value= " . $id . ">" . $n . " </option>";;
                                    }
                                }
                                ?>

                            </select>
                        </div>

                        <div class="md:col-span-2">
                            <div class="loading">Loading</div>

                            <div class="sent-message">Branch created successfully!</div>

                            <div class="error-message"></div>

                            <button type="submit" class="w-full py-2 px-4 bg-indigo-600 text-white font-semibold rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Add
                                Branch</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <script src="assets/vendor/php-email-form/validate.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const typeElement = document.getElementById('type');
            if (typeElement) {
                typeElement.addEventListener('change', function() {
                    const branchLocationContainer = document.getElementById('branch-location-container');
                    if (this.value === 'BranchManager') {
                        branchLocationContainer.style.display = 'block';
                    } else {
                        branchLocationContainer.style.display = 'none';
                    }
                });
            }
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const navLinks = document.querySelectorAll('.nav-link');

            navLinks.forEach(link => {
                link.addEventListener('click', function(event) {
                    event.preventDefault();
                    showDiv(link.getAttribute('href').substring(1));
                });
            });

            function showDiv(divId) {
                const divs = ['hire', 'fire', 'branch'];

                divs.forEach(function(id) {
                    const div = document.getElementById(id);

                    if (id === divId) {
                        div.style.display = 'block';
                    } else {
                        div.style.display = 'none';
                    }
                });
            }
        });
    </script>
</body>

</html>