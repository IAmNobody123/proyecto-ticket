document.getElementById('btnProblemas').addEventListener('click', function () {
    loadContent('layouts/tablaProblemas.php');
});

document.getElementById('btnProblemasAsignados').addEventListener('click', function () {
    loadContent('layouts/tablaTicketsAsignados.php'); // Asegúrate de que este archivo exista
});

document.getElementById('btnTicketsResueltos').addEventListener('click', function () {
    loadContent('layouts/ticketsResueltos.php'); // Asegúrate de que este archivo exista
});

function loadContent(url) {
    const xhr = new XMLHttpRequest();
    xhr.open('GET', url, true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            document.getElementById('contenidoDinamico').innerHTML = xhr.responseText;
        }
    };
    xhr.send();
}