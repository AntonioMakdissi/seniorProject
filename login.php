<?php

require_once('php/connection.php'); ?>
<!DOCTYPE html>
<html>

<head>
  <title>SpeedRun</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css">
  <link rel="stylesheet" href="assets/css/main.css">
  <link rel="stylesheet" href="assets/css/login.css">


  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Inter:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">

  <!-- captcha -->
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
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
          <li><a href="index.html" class="active">Home</a></li>
          <li><a href="about.html">About</a></li>
          <li><a href="services.html">Services</a></li>
          <li><a href="outsidetrack.php">Track</a></li>
          <li><a href="login.php">Login</a></li>
          <li><a class="get-a-quote" href="outsideorder.php">Place order</a></li>
        </ul>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->
  <main id="main">
    <section id="hero" class="hero d-flex align-items-center">
      <div class="col-lg-5 order-1 order-lg-2 hero-img" data-aos="zoom-out">
        <img src="assets/img/hero-img.svg" class="img-fluid mb-3 mb-lg-0" alt="">
      </div>
      <div class="container">
        <!-- <div class="row justify-content-center mt-5"> -->
        <div>
          <div class="col-md-8">
            <div class="form-container">
              <h2 style="color:#0e1d34">SpeedRun</h2>
              <ul class="nav nav-tabs">
                <li class="nav-item">
                  <a class="nav-link active" href="#login" data-toggle="tab">Log In</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#signup" data-toggle="tab">Sign Up</a>
                </li>
              </ul>
              <div class="tab-content mt-3">
                <!-- Login Form -->
                <div class="tab-pane fade show active" id="login">
                  <!-- <form method="POST" action="php/login.php" class="php-email-form" >  -->
                  <form method="POST" action="php/login.php">
                    <div class="form-group">
                      <label for="email"><i class="fa fa-envelope"></i> Email</label>
                      <input type="email" required class="form-control" name="email" id="email" placeholder="Enter email">
                    </div>
                    <div class="form-group">
                      <label for="password"><i class="fa fa-lock"></i> Password</label>
                      <input type="password" required name="password" class="form-control" id="password" placeholder="Enter password">
                    </div>
                    <div class="form-group">
                      <div class="g-recaptcha" data-sitekey="6LcKXUAmAAAAAHoTU54hnMb9KwAu-fDz00wvgfsD"></div>
                    </div>
                    <div class="col-md-12 text-center">

                      <div class="loading">Loading</div>

                      <div class="sent-message"> </div>

                      <div class="error-message"></div>

                      <button type="submit" class="btn  btn-block">Sign In</button>
                    </div>

                  </form>
                  <!--  -->
                  <div class="divider">
                    <hr>
                    <span class="text-muted">OR</span>
                    <hr>
                  </div>
                  <div class="social-buttons">
                    <button class="btn btn-facebook"><i class="fab fa-facebook-f"></i></button>
                    <button class="btn btn-twitter"><i class="fab fa-twitter"></i></button>
                    <button class="btn btn-google"><i class="fab fa-google"></i></button>
                  </div>
                </div>

                <!-- Signup Form -->
                <div class="tab-pane fade" id="signup">
                  <!-- <form method="POST" action="php/signup.php" class="php-email-form"> -->
                  <form method="POST" action="php/signup.php">
                    <div class="form-group">
                      <label for="name"><i class="fa fa-user"></i> Name</label>
                      <input type="text" class="form-control" required id="name" name="name" placeholder="Enter name">
                    </div>
                    <div class="form-group">
                      <label for="email"><i class="fa fa-envelope"></i> Email</label>
                      <input type="email" name="email" required class="form-control" id="email" placeholder="Enter email">
                    </div>
                    <div class="form-group">
                      <label for="password"><i class="fa fa-lock"></i> Password</label>
                      <input type="password" required name="password" class="form-control" id="password" placeholder="Enter password">
                    </div>
                    <div class="form-group">
                      <label for="address"><i class="fa fa-map-marker"></i> Address</label>
                      <input type="text" required name="address" class="form-control" id="address" placeholder="Enter address">
                    </div>
                    <!-- edit this -->
                    <div class="form-group">
                      <label for="district"><i class="fa fa-industry"></i> Sector</label>
                      <br />
                      <select id="district" name="district" required style="width: 100%; padding: 8px 12px; font-size: 16px; line-height: 1.5; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px; box-shadow: inset 0 1px 1px rgba(0,0,0,.075); transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;">
                        <option value="" selected disabled hidden>Select your district</option>
                        <?php
                        require_once('php/branches.php');
                        $all = all_branches($link);
                        foreach ($all as $branch) {
                          $n = trim($branch);
                          $to_district = str_replace(" ", "%20", $n);
                          echo "<option value= " . $to_district . ">" . $branch . " </option>";;
                        }

                        ?>

                      </select>
                    </div>

                    <div class="form-group">
                      <label for="phone_number"><i class="fa fa-phone"></i> Phone Number</label>
                      <input type="tel" class="form-control" name="phone" id="phone" required placeholder="Enter phone number" pattern="[0-9+\\-]*" onkeypress="return event.charCode >= 48 && event.charCode <= 57 || event.keyCode === 43 || event.keyCode === 45">
                    </div>
                    <div class="form-group">
                      <div class="g-recaptcha" data-sitekey="6LcKXUAmAAAAAHoTU54hnMb9KwAu-fDz00wvgfsD"></div>
                    </div>
                    <div class="col-md-12 text-center">
                      <div class="loading">Loading</div>

                      <div class="sent-message"></div>

                      <div class="error-message"></div>

                      <button type="submit" class="btn  btn-block">Sign Up</button>
                  </form>
                  <!--  -->
                  <div class="divider">
                    <hr>
                    <span class="text-muted">OR</span>
                    <hr>
                  </div>
                  <div class="social-buttons">
                    <button class="btn btn-facebook"><i class="fab fa-facebook-f"></i></button>
                    <button class="btn btn-twitter"><i class="fab fa-twitter"></i></button>
                    <button class="btn btn-google"><i class="fab fa-google"></i></button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
  <script>
    window.addEventListener('scroll', function() {
      const navbar = document.getElementById('header');
      if (window.scrollY > 0) {
        navbar.style.backgroundColor = '#0e1d34';
      } else {
        navbar.style.backgroundColor = 'transparent';
      }
    });
  </script>

  <!-- Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>


</body>

</html>