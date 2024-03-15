<?php

// Includes validate_token.php file to verify if token is valid
// and h-functions.php file to get tag functions
include_once 'validate_token.php';
include_once 'h-functions.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php echo head_html(); ?>
  <link rel="stylesheet" href="style.css">
  <title>Sign On</title>
</head>

<body>
  <?php
  echo header_html();

  $data = filter_input_array(INPUT_POST, FILTER_DEFAULT);

  // For tests only
  // Delete it to use empty
  $user = '';
  $email = '';
  $password = '';
  // if (isset($data)) {
  //   var_dump($data);
  //   $user = $data['name'];
  //   $email = $data['email'];
  //   $password = $data['password'];
  // } else {
  //   $user = 'teste';
  //   $email = 'teste@teste.com';
  //   $password = 'Testesenha123#';
  // }

  ?>
  <form class="m-3 pt-2 col-10 col-md-4 col-lg-3 mx-auto" method="post">
    <h1 class="h3 mb-3 fw-normal">Please sign on</h1>

    <!-- Name input with validation -->
    <div class="form-floating mb-3">
      <input type="text" class="form-control" name="name" id="usernameInput" placeholder="name@example.com" value="<?php echo $user // Delete?>">
      <label for="floatingInput">Name</label>

      <!-- Check Name -->
      <span class="position-absolute top-50 end-0 translate-middle ml-3" id="u-check"></span>
    </div>

    <!-- Email input with validation -->
    <div class="form-floating mb-3">
      <input type="email" class="form-control" name="email" id="emailInput" placeholder="name@example.com" value="<?php echo $email // Delete?>">
      <label for="floatingInput">Email address</label>

      <!-- Check Email -->
      <span class="position-absolute top-50 end-0 translate-middle ml-3" id="e-check"></span>
    </div>

    <!-- Password input with validation -->
    <div class="form-floating mb-3">
      <input type="password" class="form-control" name="password" id="passwordInput" placeholder="Password" autocomplete=off>
      <label for="floatingPassword">Password</label>

      <!-- Check Password -->
      <span class="position-absolute top-50 end-0 translate-middle ml-3" id="p-check"></span>
    </div>

    <!-- Checks for password entry -->
    <div class="btn-group btn-group-sm w-100 p-auto" role="group" aria-label="Basic mixed styles example">
      <p id="lowercase" class="btn btn-danger text-white">lowercase</p>
      <p id="uppercase" class="btn btn-danger text-white">uppercase</p>
      <p id="number" class="btn btn-danger text-white">number</p>
      <p id="symbol" class="btn btn-danger text-white">symbol</p>
      <p id="length" class="btn btn-danger text-white">length > 8</p>
    </div>

    <!-- Submit button -->
    <div class="text-center">
      <button id="submit" class="btn btn-primary w-75 mx-auto py-2 disabled" type="submit">Sign on</button>
    </div>
  </form>

  <!-- Footer -->
  <p class="position-absolute bottom-0 end-0 me-3 text-body-secondary">©Jr-2024</p>
  <script src="form-script.js"></script>
</body>

</html>