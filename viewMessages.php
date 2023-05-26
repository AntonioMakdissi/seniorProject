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
                        <li><a href="client.html" class="active">Home</a></li>
                        <li><a href="about.html">About</a></li>
                        <li><a href="services.html">Services</a></li>
                        <li><a href="php/history.php">History</a></li>
                        <li><a href="php/track.php">Track</a></li>
                        <li><a href="contact.html">Contact</a></li>
                        <li><a class="get-a-quote" href="php/logout.php">Logout</a></li>
                    </ul>
                </nav><!-- .navbar -->
            <?php } ?>






        </div>
    </header>
    <section id="hero" class="hero d-flex align-items-center" style="padding-top: 20px; height: 100%; ">
        <div class="container">

            <div class="container mx-auto px-4 py-12">
                <button class="btn-msg-view"><i class="fas fa-envelope"></i></button>

                <div class="messages-container" id="message_div">
                    <!-- <div class="message">
                        <h3 class="message-author">CEO</h3>
                        <p class="message-content">This is the first message from the CEO.</p>
                        <p class="message-timestamp">2023-05-02 10:00</p>
                        <button class="btn-msg">Delete</button>
                    </div>
                    <div class="message">
                        <h3 class="message-author">CEO</h3>
                        <p class="message-content">This is the second message from the CEO.</p>
                        <p class="message-timestamp">2023-05-02 10:05</p>
                        <button class="btn-msg">Delete</button>
                    </div> -->

                    <?php
                    include('php/message.php');
                    $all = viewMessages($link, $_SESSION['u_id']);
                    if ($all == -1) {
                        echo "no messages";
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
                <div class="form-container">
                    <h1 class="text-4xl font-bold mb-6" style="padding-left:1%;">Send Messages</h1>
                    <form id="messageForm" method="POST" action="php/message.php">
                        <label for="author">Email:</label>
                        <input type="email" id="author" name="email" class="form-input"><br>
                        <label for="content">Message:</label>
                        <textarea id="content" name="message" class="form-input"></textarea><br>
                        <button type="submit" class="btn-msg" class="btn_submit">Send</button>
                    </form>
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

    <!-- <script>
        document.getElementById('messageForm').addEventListener('submit', function(event) {
    event.preventDefault(); // to prevent form from submitting and page from reloading

    var author = document.getElementById('author').value;
    var content = document.getElementById('content').value;

    var messageDiv = document.createElement('div');
    messageDiv.classList.add('message');

    var authorH3 = document.createElement('h3');
    authorH3.classList.add('message-author');
    authorH3.textContent = author;

    var contentP = document.createElement('p');
    contentP.classList.add('message-content');
    contentP.textContent = content;

    var timestampP = document.createElement('p');
    timestampP.classList.add('message-timestamp');
    var timestamp = new Date();
    timestampP.textContent = timestamp.getFullYear() + '-' + (timestamp.getMonth() + 1) + '-' + timestamp.getDate() + ' ' + timestamp.getHours() + ':' + timestamp.getMinutes();

    var deleteButton = document.createElement('button');
    deleteButton.classList.add('btn-msg');
    deleteButton.textContent = 'Delete';
    deleteButton.addEventListener('click', function() {
        messageDiv.remove();
    });

    messageDiv.appendChild(authorH3);
    messageDiv.appendChild(contentP);
    messageDiv.appendChild(timestampP);
    messageDiv.appendChild(deleteButton);

    document.getElementById('message_div').appendChild(messageDiv);
});

    </script> -->
</body>

</html>