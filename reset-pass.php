<?php
// Start session
session_start();

// Clean redirect buffer
ob_start();

// Includes validate_token.php file to verify if token is valid
// and h-functions.php file to get tag functions
include_once 'helpers/validate_token.php';
include_once 'helpers/h-functions.php';
require_once 'helpers/connection.php';

?>

<?php echo h_head('Reset Password'); ?>

<body>

	<?php
	echo h_header(get_name());
	?>
	<?php

	// Get data from form
	$data = filter_input_array(INPUT_POST, FILTER_DEFAULT);
	write_logs(json_encode($data));
	if (!empty($data['email'])) {

		// Verify if user was in DB
		$query_user = "SELECT id, name, user, email, password 
							FROM users WHERE email = :email LIMIT 1";

		// Prepare query
		$stmt_user = $conn->prepare($query_user);

		// Bind parameters
		$stmt_user->bindParam(':email', $data['email']);

		// Execute query
		$stmt_user->execute();
		write_logs($_SERVER['SERVER_NAME']);
		if (($stmt_user) && ($stmt_user->rowCount() > 0)) {
			$row_user = $stmt_user->fetch(PDO::FETCH_ASSOC);
			$_SESSION['msg'] = h_alert('Check your email.');

			// Generated link sent to email
			$_SESSION['email'] = $row_user['email'];
			unset($data); // Clear the variable for security reasons
			header('Location: reset-link.php');
		} else {
			$_SESSION['msg'] = h_alert('Email not found.');
		}
	}
	?>

	<div class="cover-container d-flex w-100 p-3 mx-auto mt-4 flex-column">
		<h1 class="text-center">Email to reset password</h1>
	</div>
	<!-- Feature section -->
	<section class="col-10 col-md-4 mx-auto">
		<p class="card p-3 border-0 h4 text-center bg-info-subtle">
			If you have forgotten your password, enter your email address and we will send you a link to reset your password.
		</p>
	</section>

	<main class="form-signin m-3 py-2 pb-5 col-10 col-sm-4 col-md-3 col-lg-3 mx-auto">
		<form method="POST" action="">

			<?php
			// Verify if $SESSION['msg'] exists
			if (isset($_SESSION['msg'])) {

				// Print $SESSION['msg']
				echo $_SESSION['msg'];

				// Destroy $SESSION['msg']
				unset($_SESSION['msg']);
			}

			$user = '';
			$password = '';
			if (isset($data)) {
				$email = $data['email'];
			} else { // Delete else, for tests only	
				$email = 'teste@login.com';
			}
			?>


			<div class="form-floating mb-3">
				<input type="email" name="email" class="form-control" id="floatingInput" placeholder value="<?php echo $email ?>" required>
				<label for="floatingInput">Email address</label>
			</div>

			<!-- Submit button -->
			<div class="text-center mt-3">
				<button class="btn btn-primary w-75 py-2" type="submit">Reset</button>
			</div>

		</form>
	</main>

	<?php
	echo footer_theme();
	echo script();
	?>
</body>

</html>