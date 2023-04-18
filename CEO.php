<?php
session_start();
if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']) {
  header('Location: ../login.html');
} ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>SpeedRun</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/icon.jfif" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Inter:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville:wght@700&display=swap" rel="stylesheet">


  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Logis
  * Updated: Mar 10 2023 with Bootstrap v5.2.3
  * Template URL: https://bootstrapmade.com/logis-bootstrap-logistics-website-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->

  <style>
    table {
      border-collapse: collapse;
      width: 100%;
    }
    th, td {
      text-align: left;
      padding: 8px;
      border: 1px solid #ddd;
    }
    th {
      background-color: #333;
      color: white;
    }
    tr:nth-child(even) {
      background-color: #f2f2f2;
    }
    .image-container {
height: 75vh;
overflow: hidden;
}
img {
height: 100%;
width: 100%;
object-fit: cover;
}
.card {
border: none;
border-radius: 10px;
box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.1);
margin: 50px auto;
max-width: 600px;
}

.card-body {
padding: 30px;
}

.hire-fire-form {
display: flex;
flex-direction: column;
align-items: center;
}

.form-group {
margin-bottom: 20px;
}

.form-label {
    display: block;
    margin-bottom: 0.5rem;
    font-weight: 600;
  }

  .form-input {
    display: block;
    width: 100%;
    padding: 0.375rem 0.75rem;
    font-size: 1rem;
    line-height: 1.5;
    color: #495057;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #ced4da;
    border-radius: 0.25rem;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
  }
  .form-input:focus {
    border-color: #6c757d;
    outline: 0;
    box-shadow: 0 0 0 0.2rem rgba(108, 117, 125, 0.25);
  }

  .form-button {
    display: inline-block;
    font-weight: 400;
    color: #fff;
    text-align: center;
    vertical-align: middle;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    background-color: #007bff;
    border: 1px solid #007bff;
    padding: 0.375rem 0.75rem;
    font-size: 1rem;
    line-height: 1.5;}
    

.form-button:hover {
background-color: #3e8e41;
}

#error-msg {
color: red;
margin-top: 10px;
}
#message_IT label.form-label {
  display: block;
  margin-bottom: 0.5rem;
  font-weight: 600;
}

#message_IT textarea.form-input {
  display: block;
  width: 100%;
  padding: 0.375rem 0.75rem;
  font-size: 1rem;
  line-height: 1.5;
  color: #495057;
  background-color: #fff;
  background-clip: padding-box;
  border: 1px solid #ced4da;
  border-radius: 0.25rem;
  transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}

#message_IT textarea.form-input:focus {
  border-color: #6c757d;
  outline: 0;
  box-shadow: 0 0 0 0.2rem rgba(108, 117, 125, 0.25);
}

#message_IT button.form-button {
  display: inline-block;
  font-weight: 400;
  color: #fff;
  text-align: center;
  vertical-align: middle;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
  background-color: #007bff;
  border: 1px solid #007bff;
  padding: 0.375rem 0.75rem;
  font-size: 1rem;
  line-height: 1.5;
}

  </style>
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

      <a href="index.html" class="logo d-flex align-items-center">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="assets/img/logo.png" alt=""> -->
        <h1 style="font-family: 'Libre Baskerville', serif;">SpeedRun</h1>
      </a>

      <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
      <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>
      <nav id="navbar" class="navbar">
        <ul>
          <li><a href="CEO.php" class="active">Home</a></li>
          <li><a href="#workers">Workers</a></li>
          <li><a href="#branches">Branches</a></li>
          <li><a href="#statistics">Statistics</a></li>
          <li><a href="logout.php">Logout</a></li>
          <li><a href="#IT_message">Contact</a></li>
        </ul>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->
  <!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="hero d-flex align-items-center">
    <div class="container">
      <div class="row gy-4 d-flex justify-content-between">
        <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center">
          <h2 data-aos="fade-up" style="margin-top: -15%;">Journey of a Leading Delivery Company</h2>
          <p data-aos="fade-up" data-aos-delay="100">"Success is not final, failure is not fatal: It is the courage to continue that counts." - Winston Churchill. Keep pushing forward and striving for excellence in every delivery, and you will find success in your company.</p>

          

          <div class="row gy-4" data-aos="fade-up" data-aos-delay="400">

            <div class="col-lg-3 col-6">
              <div class="stats-item text-center w-100 h-100">
                <span data-purecounter-start="0" data-purecounter-end="232" data-purecounter-duration="1" class="purecounter"></span>
                <p>Clients</p>
              </div>
            </div><!-- End Stats Item -->

            <div class="col-lg-3 col-6">
              <div class="stats-item text-center w-100 h-100">
                <span data-purecounter-start="0" data-purecounter-end="521" data-purecounter-duration="1" class="purecounter"></span>
                <p>Projects</p>
              </div>
            </div><!-- End Stats Item -->

            <div class="col-lg-3 col-6">
              <div class="stats-item text-center w-100 h-100">
                <span data-purecounter-start="0" data-purecounter-end="1453" data-purecounter-duration="1" class="purecounter"></span>
                <p>Support</p>
              </div>
            </div><!-- End Stats Item -->

            <div class="col-lg-3 col-6">
              <div class="stats-item text-center w-100 h-100">
                <span data-purecounter-start="0" data-purecounter-end="32" data-purecounter-duration="1" class="purecounter"></span>
                <p>Workers</p>
              </div>
            </div><!-- End Stats Item -->

          </div>
        </div>

        <div class="col-lg-5 order-1 order-lg-2 hero-img" data-aos="zoom-out">
          <div class="image-container">
          <img src="assets/img/hero-img.svg" class="img-fluid mb-3 mb-lg-0" alt="" >
        </div>
      </div>

      </div>
    </div>
  </section><!-- End Hero Section -->
  <main>
    <div  data-aos="fade-up">
      
      <div class="container" style="margin-top: 100px;">
        <table>
          <thead>
            <tr>
              <th>Statistic</th>
              <th>Value</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Number of Deliveries</td>
              <td>10,000</td>
            </tr>
            <tr>
              <td>On-time Deliveries</td>
              <td>95%</td>
            </tr>
            <tr>
              <td>Customer Satisfaction</td>
              <td>4.8 out of 5</td>
            </tr>
            <tr>
              <td>Delivery Time Average</td>
              <td>2.5 Days</td>
            </tr>
          </tbody>
        </table>
      </div>
      
      
    </div>
    
   
<div  data-aos="fade-up">
  <div class="card">
    <div class="card-body">
      <form class="hire-fire-form" action="/submit-form" method="post">
        <label class="form-label" for="worker-name">Worker Name:</label>
        <input class="form-input" type="text" id="worker-name" name="worker-name" required>
  
        <label class="form-label" for="worker-email">Worker Email:</label>
        <input class="form-input" type="email" id="worker-email" name="worker-email" required>
  
        <label class="form-label" for="worker-department">Worker Department:</label>
        <select class="form-input" id="worker-department" name="worker-department" required>
          <option value="sales">Sales</option>
          <option value="marketing">Marketing</option>
          <option value="operations">Operations</option>
        </select>
  
        <div class="form-group">
          <label class="form-label" for="action">Action:</label>
          <select class="form-input" id="action" name="action" required>
            <option value="" selected disabled hidden>Select Action</option>
            <option value="hire">Hire</option>
            <option value="fire">Fire</option>
          </select>
        </div>
  
        <div class="form-group" id="salary-field" style="display:none;">
          <label class="form-label" for="worker-salary">Worker Salary:</label>
          <input class="form-input" type="number" id="worker-salary" name="worker-salary" min="0" required>
        </div>
  
        <button class="form-button" type="submit">Submit</button>
      </form>
    </div>
  </div>
  
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#action').change(function() {
        if ($(this).val() === 'hire') {
          $('#salary-field').show();
        } else {
          $('#salary-field').hide();
        }
      });
    });
  </script>
</div>
 <div data-aos="fade-up">
  <label class="form-label" for="message-it">Message IT:</label>
  <textarea class="form-input" id="message-it" name="message-it" rows="4"></textarea>

  <button class="form-button" type="submit">Submit</button>
</div>
  
<div data-aos="fade-up">
  <div class="card">
    <div class="card-body">
      <form class="new-branch-form" action="/submit-form" method="post">
        <label class="form-label" for="branch-name">Branch Name:</label>
        <input class="form-input" type="text" id="branch-name" name="branch-name" required>

        <label class="form-label" for="branch-location">Branch Location:</label>
        <input class="form-input" type="text" id="branch-location" name="branch-location" required>

        <label class="form-label" for="branch-manager">Branch Manager:</label>
        <input class="form-input" type="text" id="branch-manager" name="branch-manager" required>
        <button class="form-button" type="submit">Add branch</button>
      </form>
    </div>
  </div>

 
</div>

  </main>
  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>
  <!--  Modified scripts-->
<script src="index.js"></script>
</body>
</html>

