<?php
date_default_timezone_set('America/Sao_Paulo');

include_once 'validate_token.php';

// Function to write in a file txt
function write_logs($msg)
{
	// Pattern to date
	$date = date('Y-m-d H:i:s');
	// Get user name
	$user = get_name();
	// Get debug
	$debug = debug_backtrace();
	$d_file = $debug[0]['file'];
	$d_line = $debug[0]['line'];
	// Pattern to log line
	$log = "[$date]-[file: $d_file | line: $d_line]-[$user]-[$msg]" . PHP_EOL;
	// File name
	$log_file = date('Y-m-d') . '_logs.txt';
	// Open file
	$file = fopen("logs/$log_file", 'a');
	// Write in file
	fwrite($file, $log . "\n");
	// Close file
	fclose($file);
}
