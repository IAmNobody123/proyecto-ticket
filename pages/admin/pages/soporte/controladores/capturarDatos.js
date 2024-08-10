
// Capturar el evento de clic en el botón "ver"
$('#myModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); // Botón que activó el modal
    var idProblemas = button.data('id-problema');
    var nombre = button.data('nombre'); // Extraer la información de los atributos data-*
    var nombreProblema = button.data('nombre-problema');
    var desctipcionProblema = button.data('descripcion');
    var nombreOficina = button.data('nombre-oficina');
    var nombreSede = button.data('nombre-sede');

    // Actualizar el contenido del modal
    var modal = $(this);
    modal.find('#modalId').text('numero de problema: ' + idProblemas);
    modal.find('#modalNombre').text('Nombre: ' + nombre);
    modal.find('#modalProblema').text('Problema: ' + nombreProblema);
    modal.find('#modalEspecifico').text('Descripcion : ' + desctipcionProblema);
    modal.find('#modalOficina').text('Oficina: ' + nombreOficina);
    modal.find('#modalSede').text('Sede: ' + nombreSede);
});
