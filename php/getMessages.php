<?php
require_once 'connection.php';
require_once 'employee.php';

session_start();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin']) {

    $receive_id = $_SESSION['u_id'];

    $messages = viewMessages($link, $receive_id);
    
    if ($messages !== -1) {
        for ($i = 0; $i < count($messages[0]); $i++) {
            echo "<div class='message'>";
            echo "<h3 class='message-author'>" . $messages[3][$i] . " " . $messages[2][$i] . "</h3>";  // Sender type and name
            echo "<p class='message-content'>" . $messages[4][$i] . "</p>";  // Message content
            echo "<p class='message-timestamp'>" . $messages[5][$i] . "</p>";  // Message timestamp
            echo "<button type='submit' class='btn-msg' onclick=\"deleteMessage('" . $messages[0][$i] . "')\">Delete</button>";
            echo "</div>";
        }
    }
}
?>
