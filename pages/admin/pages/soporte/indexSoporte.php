<?php
session_start();
include("../../../../conexion/conexion.php");
if (isset($_SESSION["nombre"])) {
    $usuarioName = $_SESSION["nombre"];
    $usuarioId = $_SESSION["id"];
    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Atender tareas</title>
        <link rel="styleSheet" href="estilos/modalVer.css?d">
        <link rel="styleSheet" href="../stylesGeneral.css?d">
        <link rel="styleSheet" href="indexSoporte.css?1w1s">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    </head>

    <body>
        <nav class="sidebar">
            <div class="text">Menu</div>
            <ul>
                <li>
                    <a href="../../index.php" class="feat-btn"><i class="fa fa-home"></i>Inicio</a>
                </li>
                <li>
                    <a href="../addPracticante/addPracticante.php"><i class="fa fa-user-plus"></i>Nuevo usuario</a>
                </li>
                <li>
                    <div class="mantenimiento">
                        <h1 class="tituloM"><i class="fa fa-wrench"></i>Mantenimiento</h1>
                    </div>
                <li class="paginaActual"><a href="../soporte/indexSoporte.php"><i class="fa fa-ticket"></i></i>Tickets recibidos</a></li>
                <li><a href="layouts/tablaTicketsAsignados.php"><i class="fa fa-tasks"></i>Tickets Asignados</a> </li>
                <li><a href="layouts/ticketsResueltos.php"><i class="fa fa-check-circle"></i>Tickets Resueltos</a></li>
                <div class="mantenimiento">
                </div>
                <li><a href="../addSede/addSede.php"> <i class="fa fa-building"></i> Sede</a> </li>
                <li><a href="../addOficina/addOficina.php"> <i class="fa fa-briefcase"></i> Oficina</a></li>
                <li><a href="../addRoll/addRoll.php"> <i class="fa fa-id-badge"></i> Cargo</a></li>
                </li>
            </ul>
        </nav>



        <div class="top-bar" id="welcomeA">
            <h1 id="welcomeAdm">Bienvenido Admin</h1>
            <div class="boxshadow" id="dropdownToggle">
                <img src="../addPracticante/fotos/<?= $usuarioId ?>.png" alt="">
            </div>
            <div class="dropdown-menu" id="dropdownMenu">
                <a href="../addPracticante/controlador/cerrarSesion.php">Cerrar sesión</a>
            </div>
        </div>

        <div class="crud">
            <?php
            include "../../../../conexion/conexion.php";
            include "controladores/practicantes.php";
            include "controladores/atenderProblema.php";
            include "controladores/reasignarTicket.php";
            ?>

            <nav class="navbar navbar-ligth justify-content-center fs-3 mb-5">
                <strong>Problemas recibidos</strong>
            </nav>
            <?php
            $consultaProblemasRecibidos = "SELECT * FROM tipoProblema TP 
                    INNER JOIN problema P ON TP.idTipoProblema = P.idTipoProblema 
                    INNER JOIN usuario U ON P.idUsuario = U.idUsuario 
                    INNER JOIN oficina O ON U.idOficina = O.idOficina 
                    INNER JOIN sede S ON O.idSede = S.idSede";

            $verProblemasReasignados = $conexion->query("SELECT count(*) as TOTAL From ticket where estadoTicket = 'Rasignar'");
            $CantidadReasignar = $verProblemasReasignados->fetch_object()->TOTAL;

            if ($CantidadReasignar > 0) {
                $reasignarP = $conexion->query($consultaProblemasRecibidos . " inner join ticket t on p.idProblema = t.idProblema where estadoTicket = 'Rasignar'");
                ?>
                <p class="atenderRA"><span>El siguiente problema debe ser atendido de inmediato!!</span> </p>
                <table class="transparent-table TRA">
                    <thead class="table-secondary text-white THRA">
                        <tr>
                            <th scope="col">Id del problema:</th>
                            <th scope="col">Nombre del Solicitante</th>
                            <th scope="col">Nombre del Problema</th>
                            <th scope="col">Nombre de la Oficina</th>
                            <th scope="col">Nombre de la Sede</th>
                            <th scope="col">Opciones</th>
                        </tr>
                    </thead>
                    <tbody class="TBRA">
                        <?php
                        while ($problemaV = $reasignarP->fetch_object()) {
                            $fechaProblema = new DateTime($problemaV->fechaProblema);
                            $fecha = $fechaProblema->format('Y-m-d');
                            $hora = $fechaProblema->format('H:i:s');
                            ?>
                            <tr>
                                <th scope="row"><?= $problemaV->idProblema ?></th>
                                <th scope="row"><?= $problemaV->nombre ?></th>
                                <td><?= $problemaV->nombreProblema ?></td>
                                <td><?= $problemaV->nombreOficina ?></td>
                                <td><?= $problemaV->nombreSede ?></td>
                                <td class="botonesRA">
                                    <a href="#" class="btn btn-info btnRA" data-bs-toggle="modal" data-bs-target="#modalDetalle"
                                        data-id-problema="<?= $problemaV->idProblema ?>"
                                        data-nombre-solicitante="<?= $problemaV->nombre ?>"
                                        data-sede="<?= $problemaV->nombreSede ?>" data-area="<?= $problemaV->nombreOficina ?>"
                                        data-nombre-problema="<?= $problemaV->nombreProblema ?>"
                                        data-descripcion-problema="<?= $problemaV->descripcionProblema ?>" data-hora="<?= $hora ?>"
                                        data-fecha="<?= $fecha ?>">
                                        Ver mas detalles
                                    </a>
                                    <a class="btn btn-warning btnRA" data-bs-toggle="modal" data-bs-target="#modalRAsignar"
                                        data-id-ticket="<?= $problemaV->idTicket ?>"
                                        onclick="setIdTicket('<?= $problemaV->idTicket ?>')">Reasignar</a>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
                <?php
            }
            ?>

            <table class="transparent-table">
                <thead class="table-secondary text-white">
                    <tr>
                        <th scope="col">Numeracion del problema:</th>
                        <th scope="col">Nombre del Solicitante</th>
                        <th scope="col">Nombre del Problema</th>
                        <th scope="col">Nombre de la Oficina</th>
                        <th scope="col">Nombre de la Sede</th>
                        <th scope="col">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $ProblemasRecibidos = $consultaProblemasRecibidos . ' WHERE estadoProblema ="entregado" AND U.estado="activo" 
                    ORDER BY P.fechaProblema ASC';
                    $verProblemasEnviados = $conexion->query($ProblemasRecibidos);
                    $numeracion = 1;
                    while ($problemaV = $verProblemasEnviados->fetch_object()) {
                        $fechaProblema = new DateTime($problemaV->fechaProblema);
                        $fecha = $fechaProblema->format('Y-m-d');
                        $hora = $fechaProblema->format('H:i:s');
                        ?>
                        <tr>
                            <th scope="row"><?= $numeracion ?></th>
                            <th scope="row"><?= $problemaV->nombre ?></th>
                            <td><?= $problemaV->nombreProblema ?></td>
                            <td><?= $problemaV->nombreOficina ?></td>
                            <td><?= $problemaV->nombreSede ?></td>
                            <td>
                                <a href="#" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#modalDetalle"
                                    data-id-problema="<?= $problemaV->idProblema ?>"
                                    data-nombre-solicitante="<?= $problemaV->nombre ?>"
                                    data-sede="<?= $problemaV->nombreSede ?>" data-area="<?= $problemaV->nombreOficina ?>"
                                    data-nombre-problema="<?= $problemaV->nombreProblema ?>"
                                    data-descripcion-problema="<?= $problemaV->descripcionProblema ?>" data-hora="<?= $hora ?>"
                                    data-fecha="<?= $fecha ?>">
                                    Ver mas detalles
                                </a>
                                <a class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalAtender"
                                    data-id-problema="<?= $problemaV->idProblema ?>"
                                    onclick="setIdProblema('<?= $problemaV->idProblema ?>')">Designar</a>
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
                            <h5 class="modal-title text-center" id="myModalLabel">Designar tarea a un practicante</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body " id="atener-body">
                            <form method="POST" action="">
                                <div class="atender-body">
                                    <input type="hidden" name="idProblema" id="idProblema">
                                    <!-- Campo oculto para el idProblema -->
                                    <label for="selPrac">Selecciona un practicante</label>
                                    <select name="selectorPracticante" id="selPrac">
                                        <option value="">Seleccionar</option>
                                        <?php
                                        // Mostrar las sedes en el menú desplegable
                                        while ($problemaV = $resultPracticantes->fetch_object()) {
                                            echo "<option value='{$problemaV->idUsuario}'>{$problemaV->nombre}</option>";
                                        }

                                        ?>
                                    </select>
                                </div>
                                <div class="modal-footer justify-content-center">
                                    <button type="submit" name="submitAtender"
                                        class="btn btn-secondary me-2">Designar</button>
                                    <button type="button" class="btn btn-secondary me-3"
                                        data-bs-dismiss="modal">Cerrar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="modalRAsignar" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-center" id="myModalLabel">Reasignar la tarea a un practicante:</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body " id="atener-body">
                            <form method="POST" action="">
                                <div class="atender-body">
                                    <input type="hidden" name="idTicket" id="idTicket">
                                    <!-- Campo oculto para el idProblema -->

                                    <label for="selPrac">Selecciona un practicante</label>
                                    <select name="selectorPracticante" id="selPrac">
                                        <option value="">Seleccionar</option>
                                        <?php

                                        $sqlPracticantes = "SELECT idUsuario, nombre, direccionImagen FROM usuario where  idRol = 2 and estado ='activo' and tareaAsignada='libre'";

                                        $resultPracticantes = $conexion->query($sqlPracticantes);

                                        while ($problemaV = $resultPracticantes->fetch_object()) {
                                            echo "<option value='{$problemaV->idUsuario}'>{$problemaV->nombre}</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="modal-footer justify-content-center">
                                    <button type="submit" name="submitRAsignar" class="btn btn-secondary me-2">Reasignar
                                        ticket</button>
                                    <button type="button" class="btn btn-secondary me-3"
                                        data-bs-dismiss="modal">Cerrar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

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

            <!-- ----------------------- -->
            <script>
                function setIdTicket(idTicket) {
                    document.getElementById('idTicket').value = idTicket;
                }
                function setIdProblema(idProblema) {
                    document.getElementById('idProblema').value = idProblema;
                }
                // Cargar datos del problema seleccionado en el modal
                $('#modalDetalle').on('show.bs.modal', function (event) {
                    console.log('Modal abierto');
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
                    modal.find('#modalDetalleLabel').html('PROBLEMA REGISTRADO NRO:' + idProblemas);
                    modal.find('#ModalSolicitante').html('<b>Solicitante: </b>' + nombreSolicitante);
                    modal.find('#ModalFecha').html('<b>Fecha de la solicitud: </b>' + fechaProblema);
                    modal.find('#ModalHora').html('<b>Hora de la solicitud: </b>' + horaProblema);
                    modal.find('#ModalSede').html('<b>Sede:</b> ' + sede);
                    modal.find('#ModalArea').html('<b>Area: </b>' + area);
                    modal.find('#ModalNombre').html('<b>Nombre del Problema: </b>' + nombreProblema);
                    modal.find('#ModalDescripcion').html('<b>Descripcion del problema: </b>' + descripcionProblema);

                });
            </script>
        </div>

        <script src="../addPracticante/controlador/eventoClick.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous"></script>
    </body>

    </html>
    <?php
} else {
    header("Location: ../../index.php");
}
?>