<?php

session_start();

// Clean redirect buffer
ob_start();

// Delet cookie
setcookie('token');

// Message to user
if (isset($_COOKIE['token'])) {
    setcookie('token');
    $_SESSION['msg'] = "<div id='fade-out' class='alert alert-success text-center' role='alert'>You have been logged out...</div>";
} else {
    $_SESSION['msg'] = "<div id='fade-out' class='alert alert-danger text-center' role='alert'>You are not logged in...</div>";
}

// Redirect to index
header('Location: index.php');
