$().ready(function () {

	let getStoredTheme = () => localStorage.getItem('theme');
	let setStoredTheme = (theme) => localStorage.setItem('theme', theme);
	let theme = (theme_selected) => {
		$.ajax({
			url: 'helpers/theme.php',
			method: 'POST',
			data: {
				theme: theme_selected
			},
			success: function (response) {
				console.log('Success! Theme: ' + theme_selected);
			},
			error: function (error) {
				console.log('Error: ' + error);
			}
		});
	};
	let toggleElement = (elem_eye, elem_input) => $(elem_eye).on('click', function () {
		$(elem_eye).toggleClass('bi-eye-slash').toggleClass('bi-eye');
		$(elem_input).attr('type') === 'password' ? $(elem_input).attr('type', 'text') : $(elem_input).attr('type', 'password');
	});
	toggleElement('#togglePassword', '#passwordInput');
	toggleElement('#togglePasswordLogin', '#floatingPassword');
	toggleElement('#togglePasswordReset', '#floatingPassword');
	toggleElement('#toggleConfirmPasswordReset', '#floatingConfirmPassword');

	removeDiv('#fade-out', 5);

	let currentTheme = getStoredTheme();

	currentTheme === 'dark' ? localStorage.setItem('theme', 'dark') : localStorage.setItem('theme', 'light');
	currentTheme === 'dark' ? $('#theme').html('').html('🌜') : $('#theme').html('').html('🌞');
	currentTheme === 'dark' ? $('html').attr('data-bs-theme', 'dark') : $('html').attr('data-bs-theme', 'light');

	$('#theme').click(function () {
		let newTheme = getStoredTheme();
		newTheme === 'dark' ? setStoredTheme('light') & theme('light') : setStoredTheme('dark') & theme('dark');
		newTheme === 'dark' ? $('#theme').html('').html('🌞') : $('#theme').html('').html('🌜');
		newTheme === 'dark' ? $('html').removeAttr('data-bs-theme').attr('data-bs-theme', 'light') : $('html').removeAttr('data-bs-theme').attr('data-bs-theme', 'dark');
	});
});

function removeDiv(element, seconds) {
	setTimeout(function () {
		$(element).remove();
	}, seconds * 1000);
}