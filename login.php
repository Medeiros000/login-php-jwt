<?php
session_start();
ob_start();

include_once 'helpers/connection.php';
include_once 'helpers/h-functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$data = filter_input_array(INPUT_POST, FILTER_DEFAULT);
	if (!empty($data['user']) && !empty($data['password'])) {
		$stmt_user = $conn->prepare("SELECT id, name, user, email, password FROM users WHERE user = :user LIMIT 1");
		$stmt_user->bindParam(':user', $data['user']);
		$stmt_user->execute();

		if ($stmt_user->rowCount() > 0) {
			$row_user = $stmt_user->fetch(PDO::FETCH_ASSOC);

			$_SESSION['msg'] = "<div id='fade-out' class='alert alert-success text-center' role='alert'>User found!</div>";
			$_SESSION['name'] = $row_user['name'];

			if (password_verify($data['password'], $row_user['password'])) {
				$_SESSION['msg'] = "<div id='fade-out' class='alert alert-success text-center' role='alert'>Connected!</div>";

				$header = [
					'alg' => 'HS256',
					'typ' => 'JWT'
				];
				$header = base64_encode(json_encode($header));
				echo "<h6 style='font-size:.5rem;'>Header: $header</h6>";

				if (isset($data['remember']) && $data['remember'] == 'remember-me') {
					$expiration = time() + (7 * 24 * 60 * 60);
				} else {
					$expiration = time() + (6);
				}

				$payload = [
					'exp' => $expiration,
					'id' => $row_user['id'],
					'name' => $row_user['name'],
					'user' => $row_user['user']
				];
				$payload = base64_encode(json_encode($payload));
				echo "<h6 style='font-size:.5rem;'>Payload: $payload</h6>";

				$secret_key = 'F6F1F37584D8189';
				$signature = base64_encode(hash_hmac('sha256', "$header.$payload", $secret_key, true));
				echo "<h6 style='font-size:.5rem;'>Signature: $signature</h6>";

				echo "<h6 style='font-size:.5rem;'>Token: $header.$payload.$signature</h6>";

				setcookie('token', "$header.$payload.$signature", (time() + (7 * 24 * 60 * 60)));

				write_logs($row_user['name'] . ' logged in.');

				header('Location: index.php');
			} else {
				$_SESSION['msg'] = h_alert('User or password incorrect.');
			}
		} else {
			$_SESSION['msg'] = h_alert('User or password incorrect.');
		}
	}
}
?>

<?php echo h_head('Sign in', h_css('css/style.css')); ?>

<body>
	<?php
	echo h_header();

	$user = '';
	$password = '';
	if (isset($data)) {
		$user = $data['user'];
		$password = $data['password'];
	} else {
		$user = 'jr@login.com';
		$password = 'BAa1rQAnaDm8tLP';
	}
	?>

	<main class="form-signin mt-4 col-10 col-sm-4 mx-auto">
		<?php
		if (isset($_SESSION['msg'])) {
			echo $_SESSION['msg'];
			unset($_SESSION['msg']);
		}
		?>
		<form method="POST" action="">
			<h1 class="h3 mb-3 fw-normal">Please sign in</h1>
			<div class="form-floating">
				<input type="email" name="user" class="form-control mb-3" id="floatingInput" placeholder value="<?php echo $user ?>" required>
				<label for="floatingInput">Email address</label>
			</div>
			<div class="form-floating">
				<input type="password" name="password" class="form-control" id="floatingPassword" placeholder value="<?php echo $password ?>" autocomplete=off required>
				<i class="bi bi-eye-slash p-3 position-absolute top-50 end-0 translate-middle-y" id="togglePasswordLogin"></i>
				<label for="floatingPassword">Password</label>
			</div>
			<div class="form-check text-start my-3">
				<input class="form-check-input" name="remember" type="checkbox" value="remember-me" id="flexCheckDefault">
				<label class="form-check-label" for="flexCheckDefault">
					Remember me
				</label>
			</div>
			<div class="text-center mt-3">
				<button class="btn btn-primary w-75 py-2" type="submit">Sign in</button>
				<p class="mt-2 mb-0">Don't have an account? <a class="text-decoration-none" href="user-form.php">Register</a></p>
				<p class="mb-2"> <a class="text-decoration-none" href="reset-pass.php">Forgot password?</a></p>
			</div>
		</form>
	</main>

	<?php
	echo footer_theme();
	echo script();
	?>
</body>

</html>