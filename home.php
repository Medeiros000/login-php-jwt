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

<?php echo h_head('Home'); ?>

<body>

	<?php
	echo h_header(get_name());
	?>

	<div class="p-3 mx-auto mt-4">
		<main class="p-3 w-75 mx-auto bg-success border rounded ">
			<h1>Welcome, <?php echo get_name(); ?>!</h1>
			<p>email: <?php echo get_user(); ?></p>
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