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

<?php echo h_head('Contact') ?>

<body>

  <?php
  echo h_header(get_name());
  echo footer_theme();
  ?>

  <div class="cover-container d-flex w-100 p-3 mx-auto mt-4 flex-column">
    <h1 class="text-center">Contact</h1>
  </div>
  <?php echo script(); ?>
</body>

</html>