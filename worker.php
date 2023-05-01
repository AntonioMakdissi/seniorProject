<?php
session_start();
if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin'] || $_SESSION['type'] != 'worker' ) {
  header('Location: login.php');
} 
?>
Ana worker