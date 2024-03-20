$().ready(function () {
    console.log('ready')

    let getStoredTheme = () => localStorage.getItem('theme');
    let setStoredTheme = (theme) => localStorage.setItem('theme', theme);
    let theme = (theme_selected) => {
    $.ajax({
        url: 'theme.php',
        method: 'POST',
        data: {
            theme: theme_selected
        }
    });};
    
    removeDiv('#fade-out', 5);

    let currentTheme = getStoredTheme();
    console.log('Tema actual: ' + currentTheme);
    currentTheme === 'dark' ? localStorage.setItem('theme', 'dark') : localStorage.setItem('theme', 'light');
    currentTheme === 'dark' ? $('#theme').html('').html('🌜') : $('#theme').html('').html('🌞');
    currentTheme === 'dark' ? $('html').attr('data-bs-theme', 'dark') : $('html').attr('data-bs-theme', 'light');

    $('#theme').click(function () {
        console.log('clicked');
        let newTheme = getStoredTheme();
        getStoredTheme() === 'dark' ? setStoredTheme('light') & theme('light') : setStoredTheme('dark') & theme('dark');

        newTheme === 'dark' ? $('#theme').html('').html('🌞') : $('#theme').html('').html('🌜');
        newTheme === 'dark' ? $('html').removeAttr('data-bs-theme').attr('data-bs-theme', 'light') : $('html').removeAttr('data-bs-theme').attr('data-bs-theme', 'dark');
    });
});

function removeDiv(element, seconds) {
    setTimeout(function () {
        $(element).remove();
    }, seconds * 1000);
}

