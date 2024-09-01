<?php
session_start();
include("../../../../conexion/conexion.php");
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
        <link rel="styleSheet" href="../../style.css?k">
        <link rel="styleSheet" href="./styleAtendidos.css?e">
        <script src="https://code.jquery.com/jquery-3.4.1.js"></script>

    </head>

    <body>
        <nav class="sidebar">
            <div class="text">Menu</div>
            <ul>
                <li>
                    <a href="../../indexPracticante.php" class="feat-btn">Inicio</a>
                </li>
                <li class="paginaActual">
                    <a href="#">tickets atendidos</a>
                </li>

            </ul>
        </nav>

        <div class="top-bar" id="welcomeA">
            <h1 id="welcomeAdm">Bienvenido <?= $usuarioName ?></h1>
            <div class="boxshadow" id="dropdownToggle">
                <img src='../admin/pages/addPracticante/fotos/<?= $usuarioId; ?>.jpg' alt="">
            </div>
            <div class="dropdown-menu" id="dropdownMenu">
                <a href="controladores/cerrarSesion.php">Cerrar sesión</a>
            </div>
        </div>
        <div class="crud">
            <?php
            require '../../../../conexion/conexion.php';

            $verTickets = $conexion->query("SELECT *,u.nombre as nombreS  FROM tipoProblema TP 
            INNER JOIN problema P ON TP.idTipoProblema = P.idTipoProblema 
            INNER JOIN usuario U ON P.idUsuario = U.idUsuario 
            INNER JOIN oficina O ON U.idOficina = O.idOficina 
            INNER JOIN sede S ON O.idSede = S.idSede 
            INNER JOIN ticket t ON t.idProblema = p.idProblema 
            INNER JOIN usuario U2 ON U2.idUsuario = t.idUsuario
            where t.idUsuario = $idUsuario  and estadoTicket ='finalizado' order by idTicket desc ");

            ?>
            <?php
            while ($problemaV = $verTickets->fetch_object()) {
                
                ?>
                <div class="card">
                    <div class="headCard">
                        <?= $problemaV->idTicket ?>
                        <?= $problemaV->nombreOficina ?>
                    </div>
                    <div class="bodyCard">
                        <p> <b>Persona que solicito:</b> <?= $problemaV->nombreS ?></p>

                        <p><b>Asignado el:</b> <?= $problemaV->fecha ?></p>

                        <p><b>En horas:</b> <?= $problemaV->hora ?></p>
                    </div>
                    <div class="footerCard">
                        <a class="btn btn-info" data-bs-toggle="modal" data-bs-target="#modalAtender"
                            data-id-problema="<?= $problemaV->idProblema ?>" data-nombre-solicitante="<?= $problemaV->nombre ?>"
                            data-sede="<?= $problemaV->nombreSede ?>" data-area="<?= $problemaV->nombreOficina ?>"
                            data-nombre-problema="<?= $problemaV->nombreProblema ?>"
                            data-descripcion-problema="<?= $problemaV->descripcionProblema ?>"
                            data-hora="<?= $problemaV->fecha ?>" data-fecha="<?= $problemaV->hora ?>"
                            onclick="setIdTicket('<?= $problemaV->idTicket ?>')">Ver</a>

                        <a href="controladores/descargarPDF.php?idTicket=<?= $problemaV->idTicket ?>
                        &nombreS=<?= urlencode($problemaV->nombreS) ?>
                        &fecha=<?= urlencode($problemaV->fecha) ?>
                        &oficina=<?= urlencode($problemaV->nombreOficina) ?>
                        &nombre=<?= urlencode($problemaV->nombre) ?>
                        &hora=<?= urlencode($problemaV->hora) ?>
                        &descripcionProblema=<?= urlencode($problemaV->descripcionProblema) ?>"
                            target="_blank" class="btn btn-danger pdfD">Descargar</a>
                    </div>

                </div>
                <?php
            }
            ?>

            <div class="modal fade" id="modalAtender" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-center" id="myModalLabel">Registrar solucion del problema</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body " id="atener-body">

                            <div class="atender-body">

                                <!-- Campo oculto para el idProblema -->
                                <input type="hidden" name="idTicket" id="idTicket">
                                <p id="ModalSolicitante"></p>
                                <p id="ModalFecha"></p>
                                <p id="ModalHora"></p>
                                <p id="ModalSede"></p>
                                <p id="ModalArea"></p>

                                <p id="ModalNombre"></p>
                                <p id="ModalDescripcion"></p>


                            </div>

                            <div class="modal-footer justify-content-center">

                                <button type="button" class="btn btn-secondary me-3" data-bs-dismiss="modal">Cerrar</button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous"></script>


        <script>
            function setIdTicket(idTicket) {
                document.getElementById('idTicket').value = idTicket;
            }

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

            $('#modalAtender').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget); // Botón que activó el modal

                var idProblemas = button.data('id-problema');
                var nombreSolicitante = button.data('nombre-solicitante');
                var fechaProblema = button.data('fecha');
                var horaProblema = button.data('hora');
                var sede = button.data('sede');
                var area = button.data('area');
                var nombreProblema = button.data('nombre-problema');
                var descripcionProblema = button.data('descripcion-problema');

                // Actualizar el contenido del modal
                var modal = $(this);
                modal.find('#modalDetalleLabel').html('Detalle del problema NRO:' + idProblemas);
                modal.find('#ModalSolicitante').html('<b>Solicitante: </b>' + nombreSolicitante);
                modal.find('#ModalFecha').html('<b>Fecha de la solicitud: </b>' + fechaProblema);
                modal.find('#ModalHora').html('<b>Hora de la solicitud: </b>' + horaProblema);
                modal.find('#ModalSede').html('<b>Sede:</b> ' + sede);
                modal.find('#ModalArea').html('<b>Area: </b>' + area);
                modal.find('#ModalNombre').html('<b>Nombre del Problema: </b>' + nombreProblema);
                modal.find('#ModalDescripcion').html('<b>Descripcion del problema: </b>' + descripcionProblema);

            });
        </script>



    </body>
    <?php
} else {
    header("Location: ../../../../index.php");
}
?>

</html>