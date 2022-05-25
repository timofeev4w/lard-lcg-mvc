$(document).ready(function () {
    $('.single-post').on('click', function() {
        document.location.href = '/posts/show/' + $(this).attr('id');
    });
});