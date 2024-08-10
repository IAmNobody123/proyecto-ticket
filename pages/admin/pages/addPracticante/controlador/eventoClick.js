$('.feat-btn').click(function () {
    $('nav ul .feat-show').toggleClass("show");
});
$('nav ul li').click(function () {
    $(this).addClass("active").siblings().removeClass("active");
});

// JavaScript para mostrar/ocultar el menú al hacer clic en el ícono
var dropdownToggle = document.getElementById('dropdownToggle');
var dropdownMenu = document.getElementById('dropdownMenu');

dropdownToggle.addEventListener('click', function () {
    dropdownMenu.style.display = dropdownMenu.style.display === 'none' ? 'block' : 'none';
});

// Cerrar el menú si se hace clic fuera de él
document.addEventListener('click', function (event) {
    if (!dropdownToggle.contains(event.target) && !dropdownMenu.contains(event.target)) {
        dropdownMenu.style.display = 'none';
    }
});