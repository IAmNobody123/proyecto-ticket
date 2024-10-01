<?php
session_start();
include("../../../../../conexion/conexion.php");
if (isset($_SESSION["nombre"])) {
    $usuarioName = $_SESSION["nombre"];
    $usuarioId = $_SESSION["id"];
    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="styleSheet" href="../indexSoporte.css?s">
        <link rel="styleSheet" href="../../stylesGeneral.css?t">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
        <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    </head>

    <body>
        <?php
        include "../../../../../conexion/conexion.php";
        $verTicketsAsignados = $conexion->query("SELECT *, u.nombre as nombreP, u2.nombre as nombreU
        from ticket t
        inner join problema p on p.idProblema = t.idProblema
        inner join usuario u2 on u2.idUsuario = p.idUsuario
        inner join usuario u on u.idUsuario=t.idUsuario
        inner join oficina o on u2.idOficina = o.idOficina
        INNER JOIN sede S ON O.idSede = S.idSede
        inner join tipoProblema tp on tp.idTipoProblema = p.idTipoProblema
        where estadoTicket = 'aceptado' ");
        include "../controladores/cancelarTicket.php";
        ?>
        <nav class="sidebar">
            <div class="text">Menu</div>
            <ul>
                <li>
                    <a href="../../../index.php" class="feat-btn"><i class="fa fa-home"></i>Inicio</a>
                </li>
                <li>
                    <a href="../../addPracticante/addPracticante.php"><i class="fa fa-user-plus"></i>Nuevo usuario</a>
                </li>
                <li>
                    <div class="mantenimiento">
                        <h1 class="tituloM"><i class="fa fa-wrench"></i>Mantenimiento</h1>
                    </div>
                <li><a href="../indexSoporte.php"><i class="fa fa-ticket"></i>Tickets recibidos</a></li>
                <li class="paginaActual"><a href="#"><i class="fa fa-tasks"></i>Tickets Asignados</a> </li>
                <li><a href="ticketsResueltos.php"><i class="fa fa-check-circle"></i>Tickets Resueltos</a></li>
                <div class="mantenimiento">
                </div>
                <li><a href="../../addSede/addSede.php"><i class="fa fa-building"></i>Sede</a> </li>
                <li><a href="../../addOficina/addOficina.php"><i class="fa fa-briefcase"></i>Oficina</a></li>
                <li><a href="../../addRoll/addRoll.php"><i class="fa fa-id-badge"></i>Cargo</a></li>
                </li>
            </ul>
        </nav>

        <div class="top-bar" id="welcomeA">
            <h1 id="welcomeAdm">Bienvenido Admin</h1>
            <div class="boxshadow" id="dropdownToggle">
                <img src="../../addPracticante/fotos/<?= $usuarioId ?>.png" alt="">
            </div>
            <div class="dropdown-menu" id="dropdownMenu">
                <a href="../controladores/cerrarSesion.php">Cerrar sesión</a>
            </div>
        </div>

        <div class="crud">
            <nav class="navbar navbar-ligth justify-content-center fs-3 mb-5">
                <strong>Tickets asignados a los practicantes</strong>
            </nav>
            <table class="transparent-table">
                <thead class="table-secondary text-white">
                    <tr>
                    <th class="col">Id del ticket</th>
                    <th class="col">Nombre del usuario</th>
                    <th scope="col">Nombre del practicante</th>
                        <th class="col">Motivo</th>
                        <th class="col">fecha de asignacion</th>
                        <th class="col">
                            ver mas detalles
                        </th>

                    </tr>
                </thead>

                <tbody>
                    <?php
                    $numeracion=1;
                    while ($problemaV = $verTicketsAsignados->fetch_object()) {
                        $fechaProblema = new DateTime($problemaV->fechaProblema);
                        $fecha = $fechaProblema->format('Y-m-d');
                        $hora = $fechaProblema->format('H:i:s');
                        ?>
                        <tr>
                            <td scope="row"><?= $numeracion ?></td>
                            <td scope="row"><?= $problemaV->nombreU ?></td>
                            <th><?= $problemaV->nombreP ?></th>
                            <td><?= $problemaV->nombreProblema ?></td>
                            <td><?= $problemaV->fecha ?></td>
                            <td>
                                <a href="#" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#modalDetalle"
                                    data-id-problema="<?= $problemaV->idProblema ?>"
                                    data-id-ticket="<?= $problemaV->idTicket ?>"
                                    data-nombre-solicitante="<?= $problemaV->nombreU ?>"
                                    data-sede="<?= $problemaV->nombreSede ?>" data-area="<?= $problemaV->nombreOficina ?>"
                                    data-nombre-problema="<?= $problemaV->nombreProblema ?>"
                                    data-descripcion-problema="<?= $problemaV->descripcionProblema ?>" data-hora="<?= $hora ?>"
                                    data-fecha="<?= $fecha ?>" data-hora-asignacion="<?= $problemaV->hora ?>"
                                    data-fecha-asignacion="<?= $problemaV->fecha ?>">
                                    Ver mas detalles
                                </a>
                                <form action="" method="POST">
                                    <input type="hidden" name="ticket" value="<?= $problemaV->idTicket ?>">
                                    <input type="hidden" name="problema" value="<?= $problemaV->idProblema ?>">
                                    <input type="hidden" name="usuario" value="<?= $problemaV->idUsuario ?>">
                                    <input type="submit" value="Cancelar" name="Cancelar" class="btn btn-danger">
                                </form>
                            </td>
                        </tr>
                        <?php
                        $numeracion++;
                    }
                    ?>
                </tbody>
            </table>
            <div class="modal fade" id="modalDetalle" tabindex="-1" aria-labelledby="modalDetalleLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalDetalleLabel">Problema detallado</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p id="ModalSolicitante"></p>
                            <p id="ModalFecha"></p>
                            <p id="ModalHora"></p>
                            <p id="ModalFechaAsignacion"></p>
                            <p id="ModalHoraAsignacion"></p>
                            <p id="ModalSede"></p>
                            <p id="ModalArea"></p>
                            <p id="ModalNombre"></p>
                            <p id="ModalDescripcion"></p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <script>
            function confirmarCancelar(idTicket) {
                Swal.fire({
                    title: '¿Estás seguro de cancelar el ticket?',
                    text: "¡No podrás revertir esto!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, eliminarlo!',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Si el usuario confirma, enviar el formulario
                        console.log(idTicket);
                        document.getElementById('formCancelar' + idTicket).submit();
                        ///no se envia el idTicket
                    }
                });
            };

            function setIdProblema(idProblema) {
                document.getElementById('idProblema').value = idProblema;
            }
            // Cargar datos del problema seleccionado en el modal
            $('#modalDetalle').on('show.bs.modal', function (event) {
                console.log('Modal abierto');
                var button = $(event.relatedTarget); // Botón que activó el modal

                var idProblemas = button.data('id-problema');
                var idTicket = button.data('id-ticket');
                var nombreSolicitante = button.data('nombre-solicitante');
                var fechaProblema = button.data('fecha');
                var horaProblema = button.data('hora');
                var fechaTicket = button.data('fecha-asignacion');
                var horaTicket = button.data('hora-asignacion');
                var sede = button.data('sede');
                var area = button.data('area');
                var nombreProblema = button.data('nombre-problema');
                var descripcionProblema = button.data('descripcion-problema');

                // Actualizar el contenido del modal
                var modal = $(this);
                modal.find('#modalDetalleLabel').html('TICKET NRO:' + idTicket + '\n PROBLEMA NRO:' + idProblemas);
                modal.find('#ModalSolicitante').html('<b>Solicitante: </b>' + nombreSolicitante);
                modal.find('#ModalFecha').html('<b>Fecha de la solicitud: </b>' + fechaProblema);
                modal.find('#ModalHora').html('<b>Hora de la solicitud: </b>' + horaProblema);
                modal.find('#ModalFechaAsignacion').html('<b>Fecha de la asignacion: </b>' + fechaTicket);
                modal.find('#ModalHoraAsignacion').html('<b>Hora de la asignacion: </b>' + horaTicket);
                modal.find('#ModalSede').html('<b>Sede:</b> ' + sede);
                modal.find('#ModalArea').html('<b>Area: </b>' + area);
                modal.find('#ModalNombre').html('<b>Nombre del Problema: </b>' + nombreProblema);
                modal.find('#ModalDescripcion').html('<b>Descripcion del problema: </b>' + descripcionProblema);

            });
        </script>
        <script src="../../addPracticante/controlador/eventoClick.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous"></script>
    </body>

    </html>
    <?php
} else {
    header("Location: ../../../../../index.php");
}
?>