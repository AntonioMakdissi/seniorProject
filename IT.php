<?php
session_start();
if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin'] || $_SESSION['type'] != 'IT') {
    header('Location: login.php');
}
include_once("php/connection.php");
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
    <title>IT Page</title>
    <link rel="stylesheet" href="assets/css/it.css">
</head>

<body class="bg-gray-100">
    <header id="header" class="header d-flex align-items-center fixed-top">
        <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

            <a href="IT.php" class="logo d-flex align-items-center">
                <!-- Uncomment the line below if you also wish to use an image logo -->
                <!-- <img src="assets/img/logo.png" alt=""> -->
                <h1 style="font-family: 'Libre Baskerville', serif; padding-left: 20px;">SpeedRun</h1>
            </a>

            <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
            <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>
            <nav id="navbar" class="navbar">
                <ul>
                    <li><a href="#hire" class="nav-link">Hire worker</a></li>
                    <li><a href="#fire" class="nav-link">Fire worker</a></li>
                    <li><a href="#branch" class="nav-link">Add branch</a></li>
                    <li><a class="get-a-quote" href="logout.php">Logout</a></li>
                </ul>
            </nav>





        </div>
    </header>
    <section id="hero" class="hero d-flex align-items-center" style="padding-top: 20px; height: 100%; ">
        <div class="container">
            <div class="container mx-auto px-4 py-12">
                <h1 class="text-4xl font-bold mb-6">Workers Management</h1>
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg mb-8">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-800">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                    Date</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                    Time</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                    Name</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                    password</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                    Salary</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                    Sector</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                    Type</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                    Phone Number</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                    DOB</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                    Action</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                </th>
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
                                <td>06/06/2001</td>
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

                <div id="hire" style="display: none;">
                    <form id="hireForm" action="php/hire.php" method="post" class="php-email-form grid grid-cols-1 gap-6 md:grid-cols-2" style="padding-top: 20px;">
                        <h2 class="text-3xl font-bold mb-6">Add/Delete Worker</h2>
                        <br>
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
                        <div>
                            <label for="dateOfBirth" class="block text-sm font-medium text-white-700">Enter date of
                                birth:</label>
                            <input type="date" name="dateOfBirth" id="dateOfBirth" required class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-white-700">Sector</label>
                            <select id="district" name="district" required title="District" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
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
                            <select name="type" id="type" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required title="Type">
                                <option value="" selected disabled hidden>Select the type</option>
                                <option value="worker">Worker</option>
                                <option value="BranchManager">Manager</option>
                            </select>
                        </div>

                        <!-- <div id="branch-location-container" style="display:none;">
                            <label class="block text-sm font-medium text-white-700">Branch location</label>
                            <select name="branch_location" title="Branch location"
                                class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                
                                <option value="" selected disabled hidden>Select the branch location</option>
                            </select>
                        </div> -->

                        <div class="md:col-span-2">
                            <div class="loading">Loading</div>

                            <div class="sent-message">Worker hired successfully!</div>

                            <div class="error-message"></div>

                            <button type="submit" class="w-full py-2 px-4 bg-indigo-600 text-white font-semibold rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Hire</button>
                        </div>
                    </form>
                </div>
                <div id="fire" style="display: none;">
                    <form id="fireForm" action="php/fireworker.php" method="post" class="php-email-form grid grid-cols-1 gap-6 md:grid-cols-2" style="padding-top: 20px;">
                        <h2 class="text-3xl font-bold mb-6">Add Worker</h2>
                        <br>
                        <div class="md:col-span-2 mb-6">
                            <label class="block text-sm font-medium text-white-700 mb-2">Search Worker by Name:</label>
                            <div class="flex">
                                <input type="text" id="searchWorker" placeholder="Enter worker name" class="mt-1 flex-8 py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <button type="button" id="searchButton" style="margin-left:1%;" class=" mt-1 flex-4 py-2 px-4 bg-indigo-600 text-white font-semibold rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Search</button>
                            </div>
                        </div>

                        <div class="shadow-lg border-b border-gray-200 sm:rounded-lg mb-8">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-800">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                            Date</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                            Time</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                            Name</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                            password</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                            Salary</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                            Sector</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                            Type</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                            Phone Number</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                            DOB</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">

                                    <?php
                                    require_once('php/connection.php');
                                    $query = "SELECT * FROM workers ";
                                    $result = mysqli_query($link, $query);
                                    if (($result) && (mysqli_num_rows($result) > 0)) {

                                        while ($row = mysqli_fetch_assoc($result)) {

                                            $rmid = $row["w_id"];
                                            echo "<tr>   
                                                <td>#" . $row["w_id"] . "</td>
                                                <td>" . $row["name"] . "</td>
                                                <td>" . $row["dateOfBirth"] . "</td>
                                                <td>" . $row["phone"] . "</td>
                                                <td>" . $row["branch"] . "</td>
                                                <td>" . $row["salary"] . "$</td>
                                                <td>" . $row["timestamp"] . "</td> 
                                                <td> <a  name='n' value=$rmid href=http://localhost/seniorProject/php/fireworker.php?rmid=" . $rmid . "> <button type=\"submit\" class=\"custom-button\">Fire</button></a> </td>                   
                                                </tr>";
                                        }
                                    }
                                    ?>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex justify-center items-center">
                                            <div class="loading">Loading</div>

                                            <div class="sent-message">Worker fired successfully!</div>

                                            <div class="error-message"></div>
                                            <button class="btn-danger bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">Fire</button>
                                        </div>
                                    </td>
                                    </tr>
                                </tbody>

                            </table>
                        </div>
                    </form>
                </div>

                <div id="branch" style="display: none;">
                    <!-- Add Branch Table -->
                    <h1 class="text-4xl font-bold mb-6" style="padding-left:1%;">Branch Management</h1>
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg mb-8">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-800">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                        Date</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                        Time</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                        Branch Location</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                        Branch Manager Name</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                        Branch Manager Email</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                        Branch Manager Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <td class="px-6 py-4 whitespace-nowrap">3/3/2023</td>
                                <td class="px-6 py-4 whitespace-nowrap">7:52 PM</td>
                                <td class="px-6 py-4 whitespace-nowrap">Bint Jbeil</td>
                                <td class="px-6 py-4 whitespace-nowrap">Georges Issa</td>
                                <td class="px-6 py-4 whitespace-nowrap">grg@hotmail.com</td>
                                <td class="px-6 py-4 whitespace-nowrap">New</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex justify-center items-center">
                                        <button class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">Done</button>
                                    </div>
                                </td>

                            </tbody>
                        </table>
                    </div>

                    <!-- Add Branch Form -->
                    <form class="php-email-form grid grid-cols-1 gap-6 md:grid-cols-2" style="padding-bottom: 100px;">

                        <div>
                            <label class="block text-sm font-medium text-white-700">Branch Location</label>
                            <input type="text" name="branch_location" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required placeholder="Enter branch location">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-white-700">Branch Manager</label>
                            <select id="manager" name="manager" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <option value="" selected disabled hidden>Select Branch Manager</option>
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

    <!-- <script>
  document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('hireLink').addEventListener('click', function (event) {
        event.preventDefault();
        console.log('Click event triggered');
        showDiv('hire');
    });

    document.getElementById('fireLink').addEventListener('click', function (event) {
        event.preventDefault();
        console.log('Click event triggered');
        showDiv('fire');
    });

    document.getElementById('branchLink').addEventListener('click', function (event) {
        event.preventDefault();
        console.log('Click event triggered');
        showDiv('branch');
    });
    function showDiv(divId) {
        const divs = ['hire', 'fire', 'branch'];

        divs.forEach(function (id) {
            const div = document.getElementById(id);

            if (id === divId) {
                div.style.display = 'grid';
            } else {
                div.style.display = 'none';
            }
        });
    }
});


</script> -->

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