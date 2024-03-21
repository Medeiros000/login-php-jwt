<?php

// Function to check if token is valid
function validate_token()
{
	$token = $_COOKIE['token'];

	// Split token
	$token = explode('.', $token);

	// Verify if token has 3 parts
	if (count($token) != 3) {
		return false;
	}

	// Get header, payload, and signature
	[$header, $payload, $signature] = $token;

	// Secret key
	$secret_key = 'F6F1F37584D8189';

	// Use header and payload to compute the signature
	$computed_signature = hash_hmac('sha256', "$header.$payload", $secret_key, true);
	$computed_signature = base64_encode($computed_signature);

	// Verify if signature is valid
	if ($signature !== $computed_signature) {
		$_SESSION['msg_token'] = h_alert('Invalid or expired token...');
		return false;
	}

	// Decode payload
	$data_token = base64_decode($payload);

	// Convert to array
	$data_token = json_decode($data_token, true);

	// Verify if token is expired
	if ($data_token['exp'] <= time()) {
		$_SESSION['msg_token'] = h_alert('Invalid or expired token...');
		setcookie('token');
		return false;
	}

	// Token is valid and not expired
	return true;
}

// Retrieve name from token
function get_name()
{
	if (isset($_COOKIE['token'])) {
		$payload = explode('.', $_COOKIE['token'])[1];
		$data_token = json_decode(base64_decode($payload), true);
		return ucfirst($data_token['name']);
	} else {
		return 'Guest';
	}
}

// Retrieve email from token
function get_user()
{
	$payload = explode('.', $_COOKIE['token'])[1];
	$data_token = json_decode(base64_decode($payload), true);
	return $data_token['user'];
}

// Function to verify if token is valid
function token()
{
	if (!validate_token()) {
		if (isset($_SESSION['msg_token'])) {
			$_SESSION['msg'] = $_SESSION['msg_token'];
			unset($_SESSION['msg_token']);
		} else {
			$_SESSION['msg'] = h_alert('You must log in first.');
		}
		// Redirect to index
		header('Location: index.php');
		exit();
	}
}
