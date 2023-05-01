<?php
session_start();
if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']) {
  header('Location: ../login.html');
} 
header('Location: php/viewWorker.php');?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
    <title>IT Page</title>
    <!-- <link rel="stylesheet" href="assets/css/main.css"> -->
    <style>
       input::placeholder {
            color: rgba(0,0,0, 1);
            opacity: 1;
        }
        input{
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
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Email</th>
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
                            <div class="flex justify-center items-center">
                                <button class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">Done</button>
                            </div>
                        </td>
                    </tr>
                </tbody>
           
            </table>
        </div>
        <h2 class="text-3xl font-bold mb-6">Add/Delete Worker</h2>
        <form class="grid grid-cols-1 gap-6 md:grid-cols-2">
            <div>
                <label class="block text-sm font-medium text-white-700">Name</label>
                <input type="text" name="name" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required placeholder="Enter the name">
            </div>
            <div>
                <label class="block text-sm font-medium text-white-700">Email</label>
                <input type="email" name="email" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required placeholder="Enter the email">
            </div>
            <div>
                <label class="block text-sm font-medium text-white-700">Salary</label>
                <input type="number" name="salary" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required placeholder="Enter the salary">
            </div>
            <div>
                <label class="block text-sm font-medium text-white-700">Phone Number</label>
                <input type="tel" name="phone_number" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required placeholder="Enter phone number" pattern="[0-9+\\-]*" onkeypress="return event.charCode >= 48 && event.charCode <= 57 || event.keyCode === 43 || event.keyCode === 45">
            </div>
            <div>
                <label class="block text-sm font-medium text-white-700">Sector</label>
                <select id="district" name="district" required class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <option value="" selected disabled hidden>Select your district</option>
                    <!-- Add your PHP code to generate options here -->
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-white-700">Type</label>
                <select name="type" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                    <option value="" selected disabled hidden>Select the type</option>
                    <option value="worker">Worker</option>
                    <option value="manager">Manager</option>
                </select>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-white-700">Action</label>
                <select name="action" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-lg focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                    <option value="hire">Hire</option>
                    <option value="fire">Fire</option>
                </select>
            </div>
            <div class="md:col-span-2">
                <button type="submit" class="w-full py-2 px-4 bg-indigo-600 text-white font-semibold rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Submit</button>
            </div>
        </form>
    </div>
        </div>
    </section>

</body>
</html>
