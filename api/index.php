<?php
// Start session
session_start();

// Clean redirect buffer
ob_start();

// Includes validate_token.php file to verify if token is valid
// and h-functions.php file to get tag functions
include_once 'helpers/validate_token.php';
include_once 'helpers/h-functions.php';

?>

<?php echo h_head('Home'); ?>

<body>

	<?php
	echo h_header(get_name());
	?>

	<div class="p-3 mx-auto mt-4">
		<main class="p-3 w-75 mx-auto bg-success border rounded ">
			<?php
			if (isset($_SESSION['msg'])) {
				echo $_SESSION['msg'];
				unset($_SESSION['msg']);
			}
			?>
			<h1>Welcome, <?php echo get_name(); ?>!</h1>

			<p class="lead">Welcome to our website! Explore and make yourself at home. May your journey with us be enriching.</p>
			<p class="lead">
				<a href="#" class="btn btn-lg btn-light fw-bold border-white bg-white">Learn more</a>
			</p>
		</main>
	</div>

	<?php
	echo footer_theme();
	echo script();
	?>
</body>

</html>