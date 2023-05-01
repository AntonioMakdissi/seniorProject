<?php
session_start();
if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']) {
    header('Location: ../login.html');
}
require_once('php/connection.php');
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
    <title>IT Page</title>
    <!-- <link rel="stylesheet" href="assets/css/main.css"> -->

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Inter:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
    <link href="assets/vendor/aos/aos.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="assets/css/main.css" rel="stylesheet">
    <style>
        input::placeholder {
            color: rgba(0, 0, 0, 1);
            opacity: 1;
        }

        input {
            color: black;
        }

        .hero {
            width: 100%;
            min-height: 50vh;
            background-color: #0e1d34;
            background-image: url("../img/hero-bg.png");
            background-size: cover;
            background-position: center;
            position: relative;
            color: rgba(255, 255, 255, 0.8);
        }

        select {
            color: black;
        }
    </style>
</head>

<body class="bg-gray-100">
    <section id="hero" class="hero d-flex align-items-center">
        <div class="container">
            <div class="container mx-auto px-4 py-12">
                <h1 class="text-4xl font-bold mb-6">IT Management</h1>
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg mb-8">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-800">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Date</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Time</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Name</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">password</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Salary</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Sector</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Type</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Phone Number</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Action</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider"></th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">3/3/2023</td>
                                <td class="px-6 py-4 whitespace-nowrap">7:52 PM</td>
                                <td class="px-6 py-4 whitespace-nowrap">Milia Habib</td>
                                <td class="px-6 py-4 whitespace-nowrap">Milia@gmail.com</td>
                                <td class="px-6 py-4 whitespace-nowrap">10000</td>
                                <td class="px-6 py-4 whitespace-nowrap">Amioun</td>
                                <td class="px-6 py-4 whitespace-nowrap">Worker</td>
                                <td class="px-6 py-4 whitespace-nowrap">03123456</td>
                                <td class="px-6 py-4 whitespace-nowrap">Hire</td>
                                <td class="px-6 py-4 whitespace-nowrap">

                                    <?php
                                    include('php/message.php');
                                    $all = viewMessages($link, $_SESSION['w_id']);
                                    if ($all == -1) {
                                        echo "no messages";
                                    } else {
                                        for ($i = 0; $i < count($all[0]); ++$i) {
                                            echo "<tr>";
                                            echo "<td>" . $all[0][$i] . "</td>";
                                            echo "<td>" . $all[1][$i] . "</td>";
                                            echo "<td>" . $all[2][$i] . "</td>";
                                            echo "<td>" . $all[3][$i] . "</td>";
                                            echo "</tr>";
                                        }
                                    }
                                    ?>

                                    <div class="flex justify-center items-center">
                                        <button class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">Done</button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>

                    </table>
                </div>
                <h2 class="text-3xl font-bold mb-6">Add/Delete Worker</h2>
                <form action="php/hire.php" method="post" class="php-email-form" class="grid grid-cols-1 gap-6 md:grid-cols-2">
                    <div>
                        <label class="block text-sm font-medium text-white-700">Name</label>
                        <input type="text" name="name" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required placeholder="Enter the name">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-white-700">Email</label>
                        <input type="email" name="email" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required placeholder="Enter the email">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-white-700">Password</label>
                        <input type="password" name="password" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required placeholder="Enter the password">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-white-700">Salary</label>
                        <input type="number" name="salary" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required placeholder="Enter the salary">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-white-700">Phone Number</label>
                        <input type="tel" name="phone" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required placeholder="Enter phone number" pattern="[0-9+\\-]*" onkeypress="return event.charCode >= 48 && event.charCode <= 57 || event.keyCode === 43 || event.keyCode === 45">
                    </div>
                    <label for="dateOfBirth">Enter date of birth:</label>
                    <input type="date" name="dateOfBirth" id="dateOfBirth">
                    <div>
                        <label class="block text-sm font-medium text-white-700">Sector</label>
                        <select id="district" name="district" required class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option value="" selected disabled hidden>Select district</option>
                            <?php
                            require_once('php/branches.php');
                            $all = all_branches($link);
                            foreach ($all as $branch) {
                                $n = trim($branch);
                                $district = str_replace(" ", "%20", $n);
                                echo "<option value= " . $district . ">" . $branch . " </option>";;
                            }

                            ?>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-white-700">Type</label>
                        <select name="type" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                            <option value="" selected disabled hidden>Select the type</option>
                            <option value="worker">Worker</option>
                            <option value="BranchManager">Manager</option>
                        </select>
                    </div>

                    <!-- <div>
                <label class="block text-sm font-medium text-white-700">Action</label>
                <select name="action" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-lg focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                    <option value="hire">Hire</option>
                    <option value="fire">Fire</option>
                </select>
            </div> -->

                    <div class="col-md-12 text-center">
                        <div class="loading">Loading</div>

                        <div class="sent-message">Worker hired successfully!</div>

                        <div class="error-message"></div>

                        <button type="submit" class="w-full py-2 px-4 bg-indigo-600 text-white font-semibold rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Hire</button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <script src="assets/vendor/php-email-form/validate.js"></script>

</body>

</html>