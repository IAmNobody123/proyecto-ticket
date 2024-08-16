<?php
session_start();
include ("../../../../conexion/conexion.php");
if (isset($_SESSION["nombre"])) {
    $usuarioName = $_SESSION["nombre"];
    $idUsuario = $_SESSION["id"];
    ?>
    <!DOCTYPE html>
    <html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>tickets en espera</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </head>

    <body>
        <div class="text-end">
            <button class="btn btn-outline-danger btn-sm logout-btn" type="button"
                onclick="window.location.href='controladores/cerrarSesion.php'">
                <i class="bi bi-box-arrow-right"></i> Salir
            </button>
        </div>
        <?php
        require '../../../../conexion/conexion.php';

        $verTickets = $conexion->query("select *
        from ticket t inner join problema p on t.idProblema = p.idProblema inner join tipoproblema tp on tp.idTipoProblema = p.idTipoProblema inner join usuario u on p.idUsuario = u.idUsuario
        where estadoTicket ='aceptado' and t.idUsuario = $idUsuario ");

        ?>
        <table class="table table-hover table-bordered text-center  align-middle">

            <thead class="table-secondary text-white">
                <tr>
                    <th scope="col">ID del ticket</th>
                    <th scope="col">fecha</th>
                    <th scope="col">hora</th>
                    <th scope="col">nombre del problema</th>
                    <th scope="col">opciones</th>
                </tr>
            </thead>

            <tbody>
                <?php
                while ($problemaV = $verTickets->fetch_object()) {
                    ?>
                    <tr>
                        <th scope="row"><?= $problemaV->idTicket ?></th>
                        <td><?= $problemaV->fecha ?></td>
                        <td><?= $problemaV->hora ?></td>
                        <td><?= $problemaV->nombreProblema ?></td>
                        <td>
                            <a href="#" class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#myModal"
                                data-id-problema="<?= $problemaV->idProblema ?>" data-nombre="<?= $problemaV->idTicket ?>"
                                data-nombre-problema="<?= $problemaV->fecha ?>" data-descripcion="<?= $problemaV->hora ?>"
                                data-nombre-oficina="<?= $problemaV->nombreProblema ?>" data-nombre-sede="<?= $problemaV->nombre ?>">
                                registrar atencion
                            </a>

                        </td>
                    </tr>
                    <?php
                }
                ?>

                <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="myModalLabel">
                                    Detalles del ticket

                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p id="modalId"></p>
                                <p id="modalNombre"></p>
                                <p id="modalProblema"></p>
                                <p id="modalEspecifico"></p>
                                <p id="modalOficina"></p>
                                <p id="modalSede"></p>
                                <div class="mb-3">
                                    <label for="modalSede" class="form-label">Sede</label>
                                    <input type="text" class="form-control" id="modalSede" readonly>
                                </div>
                            </div>
                            <div class="modal-footer">

                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">registrar
                                    atencion</button>

                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>

                            </div>
                        </div>
                    </div>
                </div>




                <script>
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
                        modal.find('#modalId').text('numero del problema: ' + idProblemas);
                        modal.find('#modalNombre').text('numero del ticket: ' + nombre);
                        modal.find('#modalProblema').text('fecha en la que acepto el ticket : ' + nombreProblema);
                        modal.find('#modalEspecifico').text('hora en la que acepto el ticket: ' + desctipcionProblema);
                        modal.find('#modalOficina').text('problema que presenta: ' + nombreOficina);
                        modal.find('#modalSede').text('nombre del usuario: ' + nombreSede);
                        modal.find('.mb-3 #modalSede').val(nombreSede);
                    });
                </script>
                
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
                    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
                    crossorigin="anonymous"></script>
                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
                <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.min.js"></script>

    </body>
    <?php
} else {
    header("Location: ../../../../index.php");
}
?>

</html>