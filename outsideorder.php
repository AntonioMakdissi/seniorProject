<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Logis Bootstrap Template - Get a Quote</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

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

  <!-- =======================================================
  * Template Name: Logis
  * Updated: Mar 10 2023 with Bootstrap v5.2.3
  * Template URL: https://bootstrapmade.com/logis-bootstrap-logistics-website-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
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
        <h1>Speedrun</h1>
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
  <!-- End Header -->

  <main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs">
      <div class="page-header d-flex align-items-center" style="background-image: url('assets/img/page-header.jpg');">
        <div class="container position-relative">
          <div class="row d-flex justify-content-center">
            <div class="col-lg-6 text-center">
              <h2>Make an order</h2>
              <p>Embrace peace of mind and the freedom of choice with us as your trusted delivery company. We prioritize your safety and satisfaction above all else.</p>
            </div>
          </div>
        </div>
      </div>
      <nav>
        <div class="container">
          <ol>
            <li><a href="index.html">Home</a></li>
            <li>Making Order</li>
          </ol>
        </div>
      </nav>
    </div><!-- End Breadcrumbs -->

    <!-- ======= Get a Quote Section ======= -->
    <section id="get-a-quote" class="get-a-quote">
      <div class="container" data-aos="fade-up">

        <div class="row g-0">

          <div class="col-lg-5 quote-bg" style="background-image: url(assets/img/quote-bg.jpg);"></div>

          <div class="col-lg-7">
            <form action="php/orderguest.php" method="post" class="php-email-form">
              <h3>Make an order</h3>
              <p>To place an order, please fill out the order form and submit it.</p>
              <div class="row gy-4">
                <div class="col-lg-12">
                  <h4>Shipper's Details</h4>
                </div>
                <div class="col-md-6">
                  <input type="text" name="c_name" class="form-control" placeholder="Shipper's name" required>
                </div>

                <div class="col-md-6">
                  <input type="tel" class="form-control" name="c_phone" id="phone" required placeholder="Shipper Phone number" pattern="[0-9+\\-]*" onkeypress="return event.charCode >= 48 && event.charCode <= 57 || event.keyCode === 43 || event.keyCode === 45">
                </div>


                <div class="col-md-6">
                  <input type="text" name="c_address" class="form-control" placeholder="Shipper's Address" required>
                </div>

                <div class="col-md-6">

                  <select id="district" name="c_district" required style="width: 100%; padding: 8px 12px; font-size: 16px; line-height: 1.5; color: #888; background-color: #fff; border: 1px solid #ccc; border-radius: 4px; box-shadow: inset 0 1px 1px rgba(0,0,0,.075); transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;">
                    <option value="" selected disabled hidden>Shipper district</option>
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
                <div class="col-lg-12">
                  <h4>Receiver's Details</h4>
                </div>


                <div class="col-md-6">
                  <input type="text" name="to_name" class="form-control" placeholder="Recipient's name" required>
                </div>

                <div class="col-md-6">
                  <input type="tel" class="form-control" name="to_phone" id="phone" required placeholder="Recipient Phone number" pattern="[0-9+\\-]*" onkeypress="return event.charCode >= 48 && event.charCode <= 57 || event.keyCode === 43 || event.keyCode === 45">
                </div>


                <div class="col-md-6">
                  <input type="text" name="to_address" class="form-control" placeholder="Recipient's Address" required>
                </div>

                <div class="col-md-6">



                  <select id="district" name="to_district" required style="width: 100%; padding: 8px 12px; font-size: 16px; line-height: 1.5; color: #888; background-color: #fff; border: 1px solid #ccc; border-radius: 4px; box-shadow: inset 0 1px 1px rgba(0,0,0,.075); transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;">
                    <option value="" selected disabled hidden>Delivery district</option>
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
                <div class="col-lg-12">
                  <h4>Shippment Details</h4>
                </div>
                <div class="col-md-6">
                  <input type="tel" name="width" class="form-control" placeholder="Total width (cm)" required pattern="[0-9+\\-]*" onkeypress="return event.charCode >= 48 && event.charCode <= 57 || event.keyCode === 43 || event.keyCode === 45">
                </div>

                <div class="col-md-6">
                  <input type="tel" name="height" class="form-control" placeholder="Total height (cm)" required pattern="[0-9+\\-]*" onkeypress="return event.charCode >= 48 && event.charCode <= 57 || event.keyCode === 43 || event.keyCode === 45">
                </div>

                <div class="col-md-6">
                  <input type="tel" name="weight" class="form-control" placeholder="Total Weight (kg)" required pattern="[0-9+\\-]*" onkeypress="return event.charCode >= 48 && event.charCode <= 57 || event.keyCode === 43 || event.keyCode === 45">
                </div>



                <div class="col-md-12 ">
                  <input type="tel" class="form-control" name="o_price" placeholder="Do you want to get paid? Recipient pays us $">
                </div>



                <div class="col-md-12">
                  <textarea class="form-control" name="message" rows="6" placeholder="Message"></textarea>
                </div>

                <div class="col-md-12">
                  <div class="form-group">
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="fragile" name="fragile" value="true">
                      <label class="form-check-label" for="fragile">Is your item fragile?</label>
                    </div>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="urgent" name="urgent" value="true">
                      <label class="form-check-label" for="urgent">Same day delivery</label>
                    </div>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="receiver_pays" name="receiver_pays" value="true">
                      <label class="form-check-label" for="receiver_pays">Receiver pays</label>
                    </div>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="pay_at_delivery" name="pay_at_delivery" value="true">
                      <label class="form-check-label" for="pay_at_delivery">pay at delivery?(cash)</label>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="g-recaptcha" data-sitekey="6LcKXUAmAAAAAHoTU54hnMb9KwAu-fDz00wvgfsD"></div>
                </div>
                <div class="col-md-12 text-center">
                  <div class="loading">Loading</div>

                  <div class="sent-message">Your order request has been sent successfully. Thank you!</div>

                  <div class="error-message"></div>

                  <button type="submit">Place order</button>
                </div>

              </div>
            </form>
          </div><!-- End Quote Form -->
    </section>


  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">

    <div class="container">
      <div class="row gy-4">
        <div class="col-lg-5 col-md-12 footer-info">
          <a href="index.html" class="logo d-flex align-items-center">
            <span>Logis</span>
          </a>
          <p>Cras fermentum odio eu feugiat lide par naso tierra. Justo eget nada terra videa magna derita valies darta donna mare fermentum iaculis eu non diam phasellus.</p>
          <div class="social-links d-flex mt-4">
            <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
            <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
            <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
            <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
          </div>
        </div>

        <div class="col-lg-2 col-6 footer-links">
          <h4>Useful Links</h4>
          <ul>
            <li><a href="#">Home</a></li>
            <li><a href="#">About us</a></li>
            <li><a href="#">Services</a></li>
            <li><a href="#">Terms of service</a></li>
            <li><a href="#">Privacy policy</a></li>
          </ul>
        </div>

        <div class="col-lg-2 col-6 footer-links">
          <h4>Our Services</h4>
          <ul>
            <li><a href="#">Web Design</a></li>
            <li><a href="#">Web Development</a></li>
            <li><a href="#">Product Management</a></li>
            <li><a href="#">Marketing</a></li>
            <li><a href="#">Graphic Design</a></li>
          </ul>
        </div>

        <div class="col-lg-3 col-md-12 footer-contact text-center text-md-start">
          <h4>Contact Us</h4>
          <p>
            A108 Adam Street <br>
            New York, NY 535022<br>
            United States <br><br>
            <strong>Phone:</strong> +1 5589 55488 55<br>
            <strong>Email:</strong> info@example.com<br>
          </p>

        </div>

      </div>
    </div>

    <div class="container mt-4">
      <div class="copyright">
        &copy; Copyright <strong><span>Logis</span></strong>. All Rights Reserved
      </div>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/logis-bootstrap-logistics-website-template/ -->
        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
      </div>
    </div>

  </footer><!-- End Footer -->
  <!-- End Footer -->

  <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

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