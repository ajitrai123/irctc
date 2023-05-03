// SElect 2
$(document).ready(function () {
    $('.js-example-basic-multiple').select2();
});

// side filter
$("#aside-secondary-show-btn").click(function () {
    $(".aside-secondary").addClass("show");
});
$("#filter-close-btn").click(function () {
    $(".aside-secondary").removeClass("show");
});