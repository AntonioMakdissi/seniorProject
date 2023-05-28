<?php
session_start();
if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']) {
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
    <title>Messages Page</title>
    <link rel="stylesheet" href="assets/css/messages.css">
  <!-- Favicons -->
  <link href="assets/img/icon.jfif" rel="icon">
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


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">

    <style>
    /* .container {
        display: flex; 
    }
    .messages-container,
    .form-container {
        flex: 1;
        padding: 1em; 
    } */
    
  

</style>



</head>

<body class="bg-gray-100">
    <header id="header" class="header d-flex align-items-center fixed-top">
        <div class="container-fluid container-xl d-flex align-items-center justify-content-between">



            <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
            <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>
            <?php if ($_SESSION['type'] == 'CEO') { ?>
                <a href="CEO.php" class="logo d-flex align-items-center">
                    <!-- Uncomment the line below if you also wish to use an image logo -->
                    <!-- <img src="assets/img/logo.png" alt=""> -->
                    <h1 style="font-family: 'Libre Baskerville', serif; padding-left: 20px;">SpeedRun</h1>
                </a>
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
            <?php } else  if ($_SESSION['type'] == 'IT') { ?>
                <a href="ViewMessages.php" class="logo d-flex align-items-center">
                    <!-- Uncomment the line below if you also wish to use an image logo -->
                    <!-- <img src="assets/img/logo.png" alt=""> -->
                    <h1 style="font-family: 'Libre Baskerville', serif; padding-left: 20px;">SpeedRun</h1>
                </a>
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
            <?php } else  if ($_SESSION['type'] == 'BranchManager') { ?>
                <a href="branchOrders.php" class="logo d-flex align-items-center">
                    <!-- Uncomment the line below if you also wish to use an image logo -->
                    <!-- <img src="assets/img/logo.png" alt=""> -->
                    <h1 style="font-family: 'Libre Baskerville', serif; padding-left: 20px;">SpeedRun</h1>
                </a>
                <nav id="navbar" class="navbar">
                <ul>
            <!-- <li><a href="client.html" class="active">Home</a></li> -->
            <li><a href="branchOrders.php">Home</a></li>
            <li><a href="manager.php">History</a></li>
            <li><a href="outsidetrack.php">Track</a></li>
            <li><a href="viewMessages.php">Messages</a></li>
            <li><a href="common_password.php">Change Password</a></li>
            <li><a class="get-a-quote" href="php/logout.php">Logout</a></li>
          </ul>
                </nav>
            <?php } else  if ($_SESSION['type'] == 'worker') { ?>
                <a href="branchOrders.php" class="logo d-flex align-items-center">
                    <!-- Uncomment the line below if you also wish to use an image logo -->
                    <!-- <img src="assets/img/logo.png" alt=""> -->
                    <h1 style="font-family: 'Libre Baskerville', serif; padding-left: 20px;">SpeedRun</h1>
                </a>
                <nav id="navbar" class="navbar">
                    <ul>
                        <li><a href="branchOrders.php">Home</a></li>
                        <li><a href="viewMessages.php">Messages</a></li>
                        <li><a href="common_password.php">Change Password</a></li>
                        <li><a class="get-a-quote" href="php/logout.php">Logout</a></li>
                    </ul>
                </nav>
            <?php } else  if ($_SESSION['type'] == 'client') { ?>
                <a href="client.php" class="logo d-flex align-items-center">
                    <!-- Uncomment the line below if you also wish to use an image logo -->
                    <!-- <img src="assets/img/logo.png" alt=""> -->
                    <h1 style="font-family: 'Libre Baskerville', serif; padding-left: 20px;">SpeedRun</h1>
                </a>
                <nav id="navbar" class="navbar">
                <ul>
          <li><a href="client.php" class="active">Home</a></li>
          <li><a href="services.php">Services</a></li>
          <li><a href="php/history.php">History</a></li>
          <li><a href="php/track.php">Track</a></li>
          <li><a href="viewMessages.php">Messages</a></li>
          <li><a href="common_password.php">Change Password</a></li>
          <li><a class="get-a-quote" href="php/logout.php">Logout</a></li>
        </ul>
                </nav><!-- .navbar -->
            <?php } ?>






        </div>
    </header>
    <section id="hero" class="hero d-flex align-items-center" style="padding-top: 20px; height: 100%; ">
    <div class="container mx-auto px-4 py-12 flex">

            <div class="container mx-auto px-4 py-12">
            <div class="form-container" id="form_container">
  <div class="form-header">
    <div>
      <button class="btn-msg-view" id="showMsg"><i class="fas fa-envelope"></i></button>
      <h1 class="text-4xl font-bold" style="margin-left: 10px;">Send Messages</h1>
    </div>
  </div>
  <form id="messageForm" method="POST" action="php/message.php">
    <label for="author">Email:</label>
    <input type="email" id="author" name="email" class="form-input"><br>
    <label for="content">Message:</label>
    <textarea id="content" name="message" class="form-input"></textarea><br>
    <button type="submit" class="btn-msg" class="btn_submit">Send</button>
  </form>
</div>
                <div class="messages-container" id="message_div">
                
                    <?php
                    include('php/message.php');
                    $all = viewMessages($link, $_SESSION['u_id']);
                    if ($all == -1) {
                        echo "<div class=\"message\">
                        <h3 class=\"message-author\">System</h3>
                        <p class=\"message-content\">Checking messages...</p>
                        <p class=\"message-timestamp\">Now</p>
                        <button class=\"btn-danger\" >No messages</button>
                    </div>";
                    } else {
                        for ($i = 0; $i < count($all[0]); ++$i) {
                            if ($i % 2 == 0) {
                                //echo "</br>";
                            }
                            $m_id = $all[0][$i]; //m_id
                    ?>
                            <div class='message'>
                                <?php
                                echo "<h3 class='message-author'>" . $all[3][$i] . " " . $all[2][$i] . /*send_id+name*/ "</h3> 
                                        <p class='message-content'>" . $all[4][$i] . /*message*/ "</p>
                                    <p class='message-timestamp'>" . $all[5][$i] . /*timestamp*/ "</p>";
                                ?>
                                <button type="submit" class='btn-msg' onclick="deleteMessage('<?php echo $m_id; ?>')">Delete</button></a>
                            </div>
                    <?php
                        }
                    }
                    ?>
                </div>
             </div>
        </div>
    </section>
    <script src="assets/vendor/php-email-form/validate.js"></script>

    <script>
        function deleteMessage(m_id) {
            if (confirm('Are you sure you want to delete this message?')) {
                window.location.href = 'http://localhost/seniorProject/php/message.php?m_id=' + m_id;

            }
        }
    </script>

<!-- js for showMsg button -->
<script>
document.getElementById('showMsg').addEventListener('click', function() {
  var formContainer = document.getElementById('form_container');
  var messageContainer = document.getElementById('message_div');

  if (messageContainer.classList.contains('hidden')) {
    messageContainer.classList.remove('hidden');
    formContainer.classList.remove('form-container-center');
    formContainer.classList.add('form-container-left');
  } else {
    messageContainer.classList.add('hidden');
    formContainer.classList.remove('form-container-left');
    formContainer.classList.add('form-container-center');
  }
});


</script>

</body>

</html>