$(document).ready(function () {
    $('#searchRequest').submit(function (e) {
        e.preventDefault();
        var query = {query:  $('#query').val()};
        $.get('search', {query: query.query}, function (data) {
            $('#ajax-response').html(data);
            history.pushState(query, "Search for " + query.query, "?query=" + query.query);
        });
    });
});