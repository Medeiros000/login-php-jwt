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
	if (!isset($_SESSION['email'])) {
		$_SESSION['msg'] = h_alert('Bad Request.');
		header('Location: login.php');
		exit();
	}

	$email_user = $_SESSION['email'];
	// Get data from form
	$data = filter_input_array(INPUT_POST, FILTER_DEFAULT);
	write_logs(json_encode($data));
	if (!empty($data['password']) && !empty($data['confirm_password'])) {
		if (preg_match('/^[-0-9a-zA-Z_]{8,}$/', $data['password']) == true) {
			if ($data['password'] == $data['confirm_password']) {

				if (!empty($_SESSION['email'])) {

					// Update query to  set new password in database
					$query = "UPDATE users SET password = :password
                            WHERE email = :email;";

					// Prepare query
					$stmt_user = $conn->prepare($query);

					// Hash password
					$data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

					// Bind parameters
					$stmt_user->bindParam(':email', $_SESSION['email']);
					$stmt_user->bindParam(':password', $data['password']);

					// Execute query
					$stmt_user->execute();

					if (($stmt_user) && ($stmt_user->rowCount() > 0)) {
						$row_user = $stmt_user->fetch(PDO::FETCH_ASSOC);
						$_SESSION['msg'] = h_alert('Password changed.', 'success');

						// Generated link sent to email
						header('Location: login.php');
						exit();
					}
				}
			} else {
				$_SESSION['msg'] = h_alert('Password\'s not equals.');
			}
		} else {
			$_SESSION['msg'] = h_alert('Password invalid.');
		}
	}
	?>

	<div class="cover-container d-flex w-100 p-3 mx-auto mt-4 flex-column">
		<h1 class="text-center">Reset your password</h1>
	</div>
	<!-- Feature section -->
	<section class="col-10 col-md-4 mx-auto">
		<p class="card p-3 border-0 h4 text-center bg-info-subtle">
			<?php echo $email_user; ?>
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

			// For tests only
			// Delete it to use empty
			$password = '';
			$confirm_password = '';
			if (isset($data)) {
				$password = $data['password'];
				$confirm_password = $data['confirm_password'];
			} else { // Delete else, only for tests
				// $password = 123456;
				// $confirm_password = 123456;
			}
			?>

			<!-- Password -->
			<div class="form-floating mb-3">
				<input type="password" name="password" class="form-control" id="floatingPassword" placeholder value="<?php echo $password ?>" required>
				<i class="bi bi-eye-slash p-3 position-absolute top-50 end-0 translate-middle-y" id="togglePasswordReset"></i>
				<label for="floatingInput">Password</label>
			</div>

			<!-- Confirm Password -->
			<div class="form-floating mb-3">
				<input type="password" name="confirm_password" class="form-control" id="floatingConfirmPassword" placeholder value="<?php echo $confirm_password ?>" required>
				<i class="bi bi-eye-slash p-3 position-absolute top-50 end-0 translate-middle-y" id="toggleConfirmPasswordReset"></i>
				<label for="floatingInput">Confirm Password</label>
			</div>

			<!-- Submit button -->
			<div class="text-center mt-3">
				<button class="btn btn-primary w-75 py-2" type="submit">Reset</button>
			</div>

		</form>
	</main>

	<?php
	echo footer_theme();
	?>
	<script src="js/script.js"></script>
</body>

</html>