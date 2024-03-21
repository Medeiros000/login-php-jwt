<?php

session_start();

// Clean redirect buffer
ob_start();

include_once 'h-functions.php';
// Delet cookie
setcookie('token');

// Message to user
if (isset($_COOKIE['token'])) {
	setcookie('token');
	$_SESSION['msg'] = h_alert('You have been logged out...', 'success');
} else {
	$_SESSION['msg'] = h_alert('You are not logged in...');
}

// Redirect to index
header('Location: index.php');
