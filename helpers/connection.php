<?php
// if ($_SERVER['SERVER_NAME'] == 'localhost') {
	$servername = "127.0.0.1";
	$username = "root";
	$port = "3306";
	$password = "";
	$dbname = "login";
// } else {
// 	// Implement the config.php file in the root directory before deploying
// 	require_once 'config.php';
// 	$servername = $config_servername;
// 	$username = $config_username;
// 	$port = $config_port;
// 	$password = $config_password;
// 	$dbname = $config_dbname;
// }

// Create connection
$conn = new PDO("mysql:host=$servername;port=$port;dbname=$dbname", $username, $password);
// Check connection
if (!$conn) {
	die("Connection failed: ");
}
