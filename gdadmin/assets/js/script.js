$(document).ready(function () {
    $('.addblock').on('click', function () {
        $('.display-popup').addClass('show-popup');
    });

    $('.listing-block').on('click', function (event) {
        event.stopPropagation();
    });

    $('.display-popup').on('click', function () {
        $(this).removeClass('show-popup');
    });
});