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
  <title>Home</title>
</head>

<body>
  <?php echo header_html(get_name()); ?>
  <div class="cover-container d-flex w-100 p-3 mx-auto mt-4 flex-column">
    <main class="px-3 bg-success">
      <h1>Welcome, <?php echo get_name(); ?>!</h1>
      <p>email: <?php echo get_user(); ?></p>
      <p class="lead">Welcome to our website! Explore and make yourself at home. May your journey with us be enriching.</p>
      <p class="lead">
        <a href="#" class="btn btn-lg btn-light fw-bold border-white bg-white">Learn more</a>
      </p>
    </main>

  </div>
  <?php echo '<script>console.log("Token: [' . $_COOKIE['token'] . ']")</script>'; ?>
  <p class="position-absolute bottom-0 end-0 me-3 text-body-secondary">©Jr-2024</p>
  <script src="script.js"></script>
</body>

</html>