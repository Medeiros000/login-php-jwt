<?php
date_default_timezone_set('America/Sao_Paulo');

include_once 'validate_token.php';

// Function to write in a file txt
function write_logs($log_in)
{
	// pattern to log line
	$log =  '[' . date('Y-m-d H:i:s') . "]-[" . get_name() . ']' . PHP_EOL .
		'[' . $log_in . ']' . PHP_EOL;
	$file = fopen("logs.txt", "a");
	fwrite($file, $log . "\n");
	fclose($file);
}
