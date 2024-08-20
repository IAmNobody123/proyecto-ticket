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
        <link rel="styleSheet" href="indexSoporte.css?q">
        <link rel="styleSheet" href="estilos/modalVer.css?g">
        <link rel="styleSheet" href="../stylesGeneral.css?p">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    </head>

    <body>
        <nav class="sidebar">
            <div class="text">Menu</div>
            <ul>
                <li>
                    <a href="../../index.php" class="feat-btn">inicio</a>
                </li>
                <li>
                    <a href="../addPracticante/addPracticante.php">nuevo practicante</a>
                </li>
                <li>
                    <div class="mantenimiento">
                        <h1 class="tituloM">mantenimiento</h1>
                        <span class="fas fa-caret-down"></span>
                    </div>
                <li><a href="layouts/tablaTicketsAsignados.php">Tickets Asignados</a> </li>
                <li><a href="layouts/ticketsResueltos.php">Tickets Resueltos</a></li>
                <li><a href="../addSede/addSede.php">Sede</a> </li>
                <li><a href="../addOficina/addOficina.php">oficina</a></li>
                <li><a href="../addPracticante/addPracticante.php">Rol</a> </li>
                <li><a href="../addRoll/addRoll.php">cargo</a></li>
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

        <div class="contenido">
            <?php
            include "../../../../conexion/conexion.php";
            include "controladores/practicantes.php";
            include "controladores/atenderProblema.php";
            ?>

            <h1>Designar Tarea</h1>
            <table class="table table-hover table-bordered text-center align-middle">
                <thead class="table-secondary text-white">
                    <tr>
                        <th scope="col">Nombre del Solicitante</th>
                        <th scope="col">Nombre del Problema</th>
                        <th scope="col">Nombre de la Oficina</th>
                        <th scope="col">Nombre de la Sede</th>
                        <th scope="col">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $verProblemasEnviados = $conexion->query("SELECT * FROM tipoProblema TP 
                    INNER JOIN problema P ON TP.idTipoProblema = P.idTipoProblema 
                    INNER JOIN usuario U ON P.idUsuario = U.idUsuario 
                    INNER JOIN oficina O ON U.idOficina = O.idOficina 
                    INNER JOIN sede S ON O.idSede = S.idSede 
                    WHERE estadoProblema ='entregado' AND U.estado='activo' 
                    ORDER BY P.fechaProblema ASC");

                    while ($problemaV = $verProblemasEnviados->fetch_object()) {
                        ?>
                        <tr>
                            <th scope="row"><?= $problemaV->nombre ?></th>
                            <td><?= $problemaV->nombreProblema ?></td>
                            <td><?= $problemaV->nombreOficina ?></td>
                            <td><?= $problemaV->nombreSede ?></td>
                            <td>
                                <a href="#" class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#modalDetalle"
                                    data-id-problema="<?= $problemaV->idProblema ?>"
                                    data-nombre="<?= $problemaV->nombreProblema ?>">
                                    <!-- Cambié aquí para mostrar el nombre del problema -->
                                    Ver
                                </a>
                                <a class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#modalAtender"
                                    data-id-problema="<?= $problemaV->idProblema ?>"
                                    onclick="setIdProblema('<?= $problemaV->idProblema ?>')">Designar</a>
                            </td>
                        </tr>
                        <?php
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
                        <div class="modal-body">
                            <form method="POST" action=""> 
                                <input type="hidden" name="idProblema" id="idProblema">
                                <!-- Campo oculto para el idProblema -->
                                <label for="selPrac">Selecciona un practicante</label>
                                <select name="selectorPracticante" id="selPrac">
                                    <option value="">Seleccionar</option>
                                    <?php
                                    // Mostrar las sedes en el menú desplegable
                                    while ($problemaV = $resultPracticantes->fetch_object()) {
                                        echo "<option value='{$problemaV->idUsuario}'>{$problemaV->nombre}</option>";
                                        $valor = $idUsuario;
                                    }
                                    echo $problemaV;
                                    ?>
                                </select>
                                <div class="modal-footer justify-content-center">
                                    <button type="submit" name="submit" class="btn btn-secondary me-2">Designar</button>
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
                            <p id="modalId"></p>
                            <p id="modalNombre"></p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                function setIdProblema(idProblema) {
                    document.getElementById('idProblema').value = idProblema;
                }
                // Cargar datos del problema seleccionado en el modal
                $('#modalDetalle').on('show.bs.modal', function (event) {
                    console.log('Modal abierto');
                    var button = $(event.relatedTarget); // Botón que activó el modal

                    var idProblemas = button.data('id-problema');
                    var nombreP = button.data('nombre');

                    // Actualizar el contenido del modal
                    var modal = $(this);
                    modal.find('#modalId').text('Número de Problema: ' + idProblemas);
                    modal.find('#modalNombre').text('Nombre del Problema: ' + nombreP);
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