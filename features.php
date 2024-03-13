<?php
// Start session
session_start();

// Clean redirect buffer
ob_start();

// Includes validate_token.php file to verify if token is valid
// and h-functions.php file to get tag functions
include_once 'validate_token.php';
include_once 'h-functions.php';

// Verify if token is valid
token();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php echo head_html(); ?>
    <title>Features</title>
</head>

<body>
    <?php echo header_html(get_name()); ?>
    <div class="cover-container d-flex w-100 p-3 mx-auto mt-4 flex-column">
        <h1 class="text-center">Features</h1>
    </div>
    <p class="position-absolute bottom-0 end-0 me-3 text-body-secondary">©Jr-2024</p>
</body>

</html>