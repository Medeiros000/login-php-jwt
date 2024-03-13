<?php

// Function to check if token is valid
function validate_token()
{
    // echo 'Token Validated!';
    $token = $_COOKIE['token'];

    // Split token
    $token = explode('.', $token);

    // Verify if token has 3 parts
    if (count($token) == 3) {
        // Get header
        $header = $token[0];
        // Get payload
        $payload = $token[1];
        // Get signature
        $signature = $token[2];

        // Secret key
        $secret_key = 'F6F1F37584D8189';

        // Use header and payload to code the algorithm sha256
        $validated_signature = hash_hmac('sha256', "$header.$payload", $secret_key, true);

        // Encode to base64
        $validated_signature = base64_encode($validated_signature);

        // Verify if signature is valid
        if ($signature == $validated_signature) {

            // decode payload
            $data_token = base64_decode($payload);
            // Convert to array
            $data_token = json_decode($data_token, true);

            // Verify if token is expired
            if ($data_token['exp'] > time()) {

                // Token is valid and not expired so return true
                return true;
            } else {

                // Message to user
                $_SESSION['msg_token'] = "<div id='fade-out' class='alert alert-danger text-center' role='alert'>Invalid or expired session token...</div>";
                
                // Delet cookie
                setcookie('token');

                return false;
            }

            // Return true
            return true;
        } else {

            // Message to user
            $_SESSION['msg_token'] = "<div id='fade-out' class='alert alert-danger text-center' role='alert'>Invalid or expired session token...</div>";
            return false;
        }
    }
}

// Retreive name from token
function get_name()
{
    $token = $_COOKIE['token'];

    // Split token
    $token = explode('.', $token);

    // Get payload
    $payload = $token[1];

    // decode payload
    $data_token = base64_decode($payload);

    // Convert to array
    $data_token = json_decode($data_token, true);

    return ucfirst($data_token['name']);
}

// Retreive email from token
function get_user()
{
    $token = $_COOKIE['token'];

    // Split token
    $token = explode('.', $token);

    // Get payload
    $payload = $token[1];

    // decode payload
    $data_token = base64_decode($payload);

    // Convert to array
    $data_token = json_decode($data_token, true);

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
            $_SESSION['msg'] = "<div id='fade-out' class='alert alert-danger text-center' role='alert'>
          You must log in to access this page.</div>";
        }
        // Redirect to index
        header('Location: index.php');
        // Kill the script
        var_dump('Token valid!');
        exit();
    }
}
