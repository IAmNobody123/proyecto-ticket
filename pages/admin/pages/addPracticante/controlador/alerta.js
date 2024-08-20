
document.getElementById('btnFiltrar').addEventListener('click', function(event) {
    event.preventDefault(); 


    var oficinaId = document.getElementById('oficinaS').value;
    var rolId = document.getElementById('rolS').value;


    var message = 'La tabla ha sido actualizada';
    if (oficinaId) {
        message += ' con valores de la oficina ID ' + oficinaId;
    }
    if (rolId ) {
        message += ' con valores del rol ID ' + rolId;
    }

    Swal.fire({
        icon: 'success',
        title: 'Tabla actualizada',
        text: message
    }).then((result) => {
        if (result.isConfirmed) {
            document.querySelector('form').submit();
        }
    });
});

