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
    </head>

    <body>
        <?php
        include "../../../../../conexion/conexion.php";
        $verTicketsAsignados = $conexion->query("SELECT * from ticket t
            inner join usuario u on t.idUsuario = u.idUsuario
            where estadoTicket = 'finalizado' ");
        ?>
        <nav class="sidebar">
            <div class="text">Menu</div>
            <ul>
                <li>
                    <a href="../../../index.php" class="feat-btn">Inicio</a>
                </li>
                <li>
                    <a href="../../addPracticante/addPracticante.php">Nuevo usuario</a>
                </li>
                <li>
                    <div class="mantenimiento">
                        <h1 class="tituloM">mantenimiento</h1>
                        <span class="fas fa-caret-down"></span>
                    </div>
                <li><a href="../indexSoporte.php">Tickets recibidos</a></li>
                <li><a href="tablaTicketsAsignados.php">Tickets Asignados</a> </li>
                <li class="paginaActual"><a href="#">Tickets Resueltos</a></li>
                <li><a href="../../addSede/addSede.php">Sede</a> </li>
                <li><a href="../../addOficina/addOficina.php">Oficina</a></li>
                <li><a href="../../addRoll/addRoll.php">Cargo</a></li>


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

            <table class="transparent-tabl">
                <thead class="table-secondary text-white">
                    <tr>
                        <th scope="col">numero de ticket</th>
                        <th class="col">nombre del practicante</th>
                        <th class="col">fecha de asignacion</th>
                        <th class="col">hora de asignacion</th>
                        <th class="col">fecha de solucion</th>
                        <th class="col">hora de solucion</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    while ($problemaV = $verTicketsAsignados->fetch_object()) {
                        ?>
                        <tr>
                            <th scope="row"><?= $problemaV->idTicket ?></th>
                            <td><?= $problemaV->nombre ?></td>
                            <td><?= $problemaV->fecha ?></td>
                            <td><?= $problemaV->hora ?></td>
                            <td><?= $problemaV->fechaAtencion ?></td>
                            <td><?= $problemaV->horaAtencion ?></td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>

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