$().ready(function () {
    console.log('ready');

    // a-z onclick
    $('#lowercase').on('click', function () {
        $(this).html() == 'a-z' ? $(this).html('lowercase') : $(this).html('a-z'); 
    });

    // A-Z onclick
    $('#uppercase').on('click', function () {
        $(this).html() == 'A-Z' ? $(this).html('uppercase') : $(this).html('A-Z'); 
    });

    // 0-9 onclick
    $('#number').on('click', function () {
        $(this).html() == '0-9' ? $(this).html('number') : $(this).html('0-9'); 
    });

    // Symbol onclick
    $('#symbol').on('click', function () {
        $(this).html() == 'symbol' ? $(this).html('.@#$!%*?&^+') : $(this).html('symbol'); 
    });

    // Check if the username is valid
    $('#usernameInput').on('input', function () {
        check_username = $(this).val();
        // console.log(check_username);
        !check_username.match(/^[a-zA-Z0-9]{5,}$/) ? $('#u-x').remove() & $('#u-v').remove() & $('#u-check').append('<i id="u-x" class="bi bi-x-circle-fill text-danger"></i>') & releaseButton() : $('#u-x').remove() & $('#u-v').remove() & $('#u-check').append('<i id="u-v" class="bi bi-check-circle-fill text-success"></i>') & releaseButton();
    });

    // Check if the email is valid
    $('#emailInput').on('input', function () {
        check_email = $(this).val();
        // console.log(check_email);
        !check_email.match(/\S+@\S+\.\S+/) ? $('#e-x').remove() & $('#e-v').remove() & $('#e-check').append('<i id="e-x" class="bi bi-x-circle-fill text-danger"></i>') & releaseButton() : $('#e-x').remove() & $('#e-v').remove() & $('#e-check').append('<i id="e-v" class="bi bi-check-circle-fill text-success"></i>') & releaseButton();
    });

    // Check if the password is strong enough
    $('#passwordInput').on('input', function () {
        check_password = $(this).val();
        // console.log(check_password);
        check_password.match(/[a-z]/) ? $('#lowercase').addClass('btn-success').removeClass('btn-danger') : $('#lowercase').addClass('btn-danger').removeClass('btn-success');
        check_password.match(/[A-Z]/) ? $('#uppercase').addClass('btn-success').removeClass('btn-danger') : $('#uppercase').addClass('btn-danger').removeClass('btn-success');
        check_password.match(/[0-9]/) ? $('#number').addClass('btn-success').removeClass('btn-danger') : $('#number').addClass('btn-danger').removeClass('btn-success');
        check_password.match(/(?=.*[@.#$!%*?&^])/) ? $('#symbol').addClass('btn-success').removeClass('btn-danger') : $('#symbol').addClass('btn-danger').removeClass('btn-success');
        check_password.length >= 8 ? $('#length').addClass('btn-success').removeClass('btn-danger') : $('#length').addClass('btn-danger').removeClass('btn-success');
        // !check_password.match(/^[a-zA-Z0-9@.#$!%*?&^]{8,}$/) ? $('#submit').addClass('disabled') : $('#submit').removeClass('disabled');
        !check_password.match(/^[a-zA-Z0-9@.#$!%*?&^]{8,}$/) ? $('#p-x').remove() & $('#p-v').remove() & $('#p-check').append('<i id="p-x" class="bi bi-x-circle-fill text-danger"></i>') & releaseButton() : $('#p-x').remove() & $('#p-check').append('<i id="p-v" class="bi bi-check-circle-fill text-success"></i>') & releaseButton();
    });
});

// Release the submit button if all the fields are valid
function releaseButton() {
    // Check if all the fields are valid
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