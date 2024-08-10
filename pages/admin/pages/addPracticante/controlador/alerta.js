
document.getElementById('btnFiltrar').addEventListener('click', function(event) {
    event.preventDefault(); // Evitar que el formulario se envíe inmediatamente

    // Obtener los valores de los filtros
    var oficinaId = document.getElementById('oficinaS').value;
    var rolId = document.getElementById('rolS').value;

    // Construir el mensaje de la alerta
    var message = 'La tabla ha sido actualizada';
    if (oficinaId) {
        message += ' con valores de la oficina ID ' + oficinaId;
    }
    if (rolId ) {
        message += ' con valores del rol ID ' + rolId;
    }

    // Mostrar la alerta de SweetAlert
    Swal.fire({
        icon: 'success',
        title: 'Tabla actualizada',
        text: message
    }).then((result) => {
        if (result.isConfirmed) {
            // Si el usuario confirma, enviar el formulario
            document.querySelector('form').submit();
        }
    });
});

