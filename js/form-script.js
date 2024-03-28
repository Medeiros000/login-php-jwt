$(document).ready(function () {

	// Prevent form submission
	$('#form').on('submit', function (e) {
		e.preventDefault();
	});

	// Name onclick
	// Name a-z onclick
	$('#nm-lwcs').on('click', function () {
		$(this).html() == 'a-z' ? $(this).html('lowercase') : $(this).html('a-z');
	});
	// A-Z onclick
	$('#nm-upcs').on('click', function () {
		$(this).html() == 'A-Z' ? $(this).html('uppercase') : $(this).html('A-Z');
	});
	// 0-9 onclick
	$('#nm-n').on('click', function () {
		$(this).html() == '0-9' ? $(this).html('number') : $(this).html('0-9');
	});

	// Check if the username is valid
	$('#nameInput').on('input', function () {
		check_username = $(this).val();

		// Final check for username
		!check_username.match(/^[a-zA-Z0-9]{5,}$/) ? $('#u-x').remove() & $('#u-v').remove() & $('#u-check').append('<i id="u-x" class="bi bi-x-circle-fill text-danger"></i>') & releaseButton() : $('#u-x').remove() & $('#u-v').remove() & $('#u-check').append('<i id="u-v" class="bi bi-check-circle-fill text-success"></i>') & releaseButton();
	});

	// Email onclick
	// Email a-z onclick
	$('#email-lwcs').on('click', function () {
		$(this).html() == 'a-z' ? $(this).html('lowercase') : $(this).html('a-z');
	});

	// Check if the email is valid
	$('#emailInput').on('input', function () {
		check_email = $(this).val();

		// Auto lowercase email
		$('#emailInput').val('').val(check_email.toLowerCase());

		// Final check for email
		check_email.match(/[-a-z0-9_]{1,}[@]{1}[-a-z0-9]{1,}[.]{1}[-a-z0-9]/) ?
			$('#e-x').remove() & $('#e-v').remove() & $('#e-check').append('<i id="e-v" class="bi bi-check-circle-fill text-success"></i>') & releaseButton()
			:
			$('#e-x').remove() & $('#e-v').remove() & $('#e-check').append('<i id="e-x" class="bi bi-x-circle-fill text-danger"></i>') & releaseButton();
	});


	// Password onclick
	// Password a-z onclick
	$('#pw-lwcs').on('click', function () {
		$(this).html() == 'a-z' ? $(this).html('lowercase') : $(this).html('a-z');
	});
	// A-Z onclick
	$('#pw-upcs').on('click', function () {
		$(this).html() == 'A-Z' ? $(this).html('uppercase') : $(this).html('A-Z');
	});
	// 0-9 onclick
	$('#pw-n').on('click', function () {
		$(this).html() == '0-9' ? $(this).html('number') : $(this).html('0-9');
	});
	// Symbol onclick
	$('#pw-sym').on('click', function () {
		$(this).html() == 'symbol' ? $(this).html('.@#$!%*?&^+') : $(this).html('symbol');
	});

	// Check if the password is strong enough
	$('#passwordInput').on('input', function () {
		check_password = $(this).val();
		// console.log(check_password);
		check_password.match(/[a-z]/) ? $('#pw-lwcs').addClass('btn-success').removeClass('btn-danger') : $('#pw-lwcs').addClass('btn-danger').removeClass('btn-success');
		check_password.match(/[A-Z]/) ? $('#pw-upcs').addClass('btn-success').removeClass('btn-danger') : $('#pw-upcs').addClass('btn-danger').removeClass('btn-success');
		check_password.match(/[0-9]/) ? $('#pw-n').addClass('btn-success').removeClass('btn-danger') : $('#pw-n').addClass('btn-danger').removeClass('btn-success');
		check_password.match(/(?=.*[@.#$!%*?&^])/) ? $('#pw-sym').addClass('btn-success').removeClass('btn-danger') : $('#pw-sym').addClass('btn-danger').removeClass('btn-success');
		check_password.length >= 8 ? $('#pw-lgth').addClass('btn-success').removeClass('btn-danger') : $('#pw-lgth').addClass('btn-danger').removeClass('btn-success');

		// Final check for password
		check_password.match(/[a-z]/) && check_password.match(/[A-Z]/) && check_password.match(/[0-9]/) && check_password.match(/[@.#$!%*?&^]/) && check_password.length >= 8 ?
			$('#p-x').remove() & $('#p-v').remove() & $('#p-check').append('<i id="p-v" class="bi bi-check-circle-fill text-success"></i>') & releaseButton() :
			$('#p-x').remove() & $('#p-v').remove() & $('#p-check').append('<i id="p-x" class="bi bi-x-circle-fill text-danger"></i>') & releaseButton();
	});
});

// Release the submit button if all fields are valid
function releaseButton() {
	// Check if all fields are valid
	console.log('checking');
	console.log($('#u-v').length, $('#e-v').length, $('#p-v').length);
	if ($('#u-v').length && $('#e-v').length && $('#p-v').length) {
		console.log('release');
		$('#submit').removeClass('disabled');
	} else {
		console.log('lock');
		$('#submit').addClass('disabled');
	}
}