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
        <link rel="styleSheet" href="../indexSoporte.css?s">
        <link rel="styleSheet" href="../../stylesGeneral.css?t">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>

    <body>
        <?php
        include "../../../../../conexion/conexion.php";
        include "../controladores/filtrarTabla.php";
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
                <li><a href="tablaTicketsAsignados.php"><i class="fa fa-tasks"></i>Tickets Asignados</a> </li>
                <li class="paginaActual"><a href="ticketsResueltos.php"><i class="fa fa-check-circle"></i>Tickets Resueltos</a></li>
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
                <strong>Tickets resueltos</strong>
            </nav>

            <form method="POST" class="mb-3" action="">
                    <div class="row">
                        <div class="col col-4">
                            <label for="fecha">Fecha de atencion:</label>
                            <input type="date" id="fecha" name ="fecha" class="form-control">
                        </div>
                        <div class="col col-4">
                            <label for="rolS">Practicante:</label> <!-- Cambiado para que coincida con el nuevo ID -->
                            <select name="rolS" id="rolS" class="form-select"> <!-- Cambiado el ID a 'rolS' -->
                                <option value="">Todos</option>
                                <?php
                                // Obtener los roles de la base de datos
                                $rolQuery = "SELECT * FROM usuario where idRol = 2";
                                $roles = $conexion->query($rolQuery);
                                while ($rol = $roles->fetch_object()) {
                                    echo "<option value='{$rol->idUsuario}'>{$rol->nombre}</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col col-3">
                            <input type="submit" value="Filtrar" class="btn btn-primary mt-4" name="btnFiltrar">
                        </div>
                    </div>

                </form>

            <table class="transparent-tabl">
                <thead class="table-secondary text-white">
                    <tr>
                        <th scope="col">Numeracion de ticket</th>
                        <th class="col">nombre del practicante</th>
                        <th class="col">fecha de asignacion</th>
                        <th class="col">fecha de solucion</th>
                        <th class="col">Ver detalles</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    $numeracion = 1;
                    while ($problemaV = $sqlVerTicketsA->fetch_object()) {
                        ?>
                        <tr>
                            <th scope="row"><?=$numeracion ?></th>
                            <td><?= $problemaV->nombre ?></td>
                            <td><?= $problemaV->fecha ?></td>
                            <td><?= $problemaV->fechaAtencion ?></td>
                            <td>
                            <a class="btn btn-info" data-bs-toggle="modal" data-bs-target="#modalAtender"
                                        data-id-problema="<?= $problemaV->idProblema ?>"
                                        data-nombre-practicante="<?= $problemaV->nombreS ?>
                                        "data-nombre-solicitante="<?= $problemaV->nombreU ?>"
                                        data-sede="<?= $problemaV->nombreSede ?>" data-area="<?= $problemaV->nombreOficina ?>"
                                        data-nombre-problema="<?= $problemaV->nombreProblema ?>"
                                        data-descripcion-problema="<?= $problemaV->descripcionProblema ?>"
                                        data-solucion-problema="<?= $problemaV->descripcion_solucion ?>"
                                        data-fecha-solucion="<?= $problemaV->fechaAtencion ?>"
                                        data-hora-solucion="<?= $problemaV->horaAtencion ?>"
                                        data-hora="<?= $problemaV->fecha ?>" data-fecha="<?= $problemaV->hora ?>"
                                        onclick="setIdTicket('<?= $problemaV->idTicket ?>')">Ver</a>
                            </td>
                        </tr>
                        <?php
                        $numeracion++;
                    }
                    ?>
                </tbody>
            </table>
            
            <div class="modal fade" id="modalAtender" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-center" id="myModalLabel">Mostrar informacion del problema resuelto</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body " id="atener-body">

                            <div class="atender-body">

                                <!-- Campo oculto para el idProblema -->
                                <input type="hidden" name="idTicket" id="idTicket">
                                <p id="ModalPracticante"></p>
                                <p id="ModalSolicitante"></p>
                                <p id="ModalFecha"></p>
                                <p id="ModalHora"></p>
                                <p id="ModalSede"></p>
                                <p id="ModalArea"></p>
                                <p id="ModalNombre"></p>
                                <p id="ModalDescripcion"></p>
                                <hr>
                                <p id="ModalSolucion"></p>
                                <p id="ModalFechaSolucion"></p>
                                <p id="ModalHoraSolucion"></p>


                            </div>

                            <div class="modal-footer justify-content-center">

                                <button type="button" class="btn btn-secondary me-3" data-bs-dismiss="modal">Cerrar</button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            
            $('#modalAtender').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget); // Botón que activó el modal

                var idProblemas = button.data('id-problema');
                var nombreSolicitante = button.data('nombre-solicitante');
                var nombrePracticante = button.data('nombre-practicante');
                var fechaProblema = button.data('fecha');
                var horaProblema = button.data('hora');
                var sede = button.data('sede');
                var area = button.data('area');
                var nombreProblema = button.data('nombre-problema');
                var descripcionProblema = button.data('descripcion-problema');
                var solucionProblema = button.data('solucion-problema');
                var fechaSolucion = button.data('fecha-solucion');
                var horaSolucion = button.data('hora-solucion');

                // Actualizar el contenido del modal
                var modal = $(this);
                modal.find('#modalDetalleLabel').html('TICKET NRO:' + idProblemas);
                modal.find('#ModalSolicitante').html('<b>Practicante: </b>' + nombreSolicitante);
                modal.find('#ModalPracticante').html('<b>Solicitante: </b>' + nombrePracticante);
                modal.find('#ModalFecha').html('<b>Fecha de la solicitud: </b>' + fechaProblema);
                modal.find('#ModalHora').html('<b>Hora de la solicitud: </b>' + horaProblema);
                modal.find('#ModalSede').html('<b>Sede:</b> ' + sede);
                modal.find('#ModalArea').html('<b>Area: </b>' + area);
                modal.find('#ModalNombre').html('<b>Nombre del Problema: </b>' + nombreProblema);
                modal.find('#ModalDescripcion').html('<b>Descripcion del problema: </b>' + descripcionProblema);

                modal.find('#ModalSolucion').html('<b>Descripcion de la solucion: </b>' + solucionProblema);
                modal.find('#ModalFechaSolucion').html('<b>Fecha de la solucion: </b>' + fechaSolucion);
                modal.find('#ModalHoraSolucion').html('<b>Hora de la solucion: </b>' + horaSolucion);

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