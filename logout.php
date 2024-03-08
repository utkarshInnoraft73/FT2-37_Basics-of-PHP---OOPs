<?php
session_start();

if (isset($_GET['logout']) && $_GET['logout'] == true) {
    $_SESSION = array();
    
    // Destroy the session
    session_destroy();

    // Redirect to the login page after logout
    header('Location: index.php');
    exit;
}
?>