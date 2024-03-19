$().ready(function () {
    console.log('ready')

    let getStoredTheme = () => localStorage.getItem('theme');
    let setStoredTheme = (theme) => localStorage.setItem('theme', theme);
    
    removeDiv('#fade-out', 5);

    if (getStoredTheme() == null && window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
        localStorage.setItem('theme', 'dark');
        setStoredTheme('dark');
    }
    
    let currentTheme = getStoredTheme();
    console.log('Tema actual: ' + currentTheme);
    currentTheme === 'dark' ? localStorage.setItem('theme', 'dark') : localStorage.setItem('theme', 'light');
    currentTheme === 'dark' ? $('#theme').html('').html('🌜') : $('#theme').html('').html('🌞');
    currentTheme === 'dark' ? $('html').attr('data-bs-theme', 'dark') : $('html').attr('data-bs-theme', 'light');

    $('#theme').click(function () {
        console.log('clicked');
        let newTheme = getStoredTheme();
        getStoredTheme() === 'dark' ? setStoredTheme('light') : setStoredTheme('dark');

        newTheme === 'dark' ? $('#theme').html('').html('🌞') : $('#theme').html('').html('🌜');
        newTheme === 'dark' ? $('html').removeAttr('data-bs-theme').attr('data-bs-theme', 'light') : $('html').removeAttr('data-bs-theme').attr('data-bs-theme', 'dark');
    });
});

function removeDiv(element, seconds) {
    setTimeout(function () {
        $(element).remove();
    }, seconds * 1000);
}