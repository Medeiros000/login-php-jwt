$().ready(function() {
    console.log('ready')
    removeDiv('#fade-out', 5);
});
function removeDiv(element, seconds) {
    setTimeout(function() {
        $(element).remove();
    }, seconds * 1000);    
}