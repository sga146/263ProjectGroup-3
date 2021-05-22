// This will perform an ajax request to 'view_events.php and print the results to the HTML element with 'preTag' as its ID
$.get('view_events.php', function (data) {
    $('#preTag').text(data);
});

function homePage() {
    window.location.assign("index.html");
}