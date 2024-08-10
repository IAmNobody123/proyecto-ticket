$('.feat-btn').click(function () {
    $('nav ul .feat-show').toggleClass("show");
});
$('nav ul li').click(function () {
    $(this).addClass("active").siblings().removeClass("active");
});