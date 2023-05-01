<?php
session_start();
if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin'] || $_SESSION['type'] != 'BranchManager' ) {
  header('Location: ../login.php');
} 
?>
Ana manager