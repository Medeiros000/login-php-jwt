<?php
$servername = "127.0.0.1";
$username = "root";
$port = "3306";
$password = "";
$dbname = "login";

// Create connection
$conn = new PDO("mysql:host=$servername;port=$port;dbname=$dbname", $username, $password);
// Check connection
if (!$conn) {
    die("Connection failed: ");
}
