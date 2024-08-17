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
        <link rel="styleSheet" href="../indexSoporte.css?a">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    </head>

    <body>
        <nav class="sidebar">
            <div class="text">Menu</div>
            <ul>
                <li>
                    <a href="../../../index.php" class="feat-btn">inicio</a>
                </li>
                <li>
                    <a href="../addPracticante/addPracticante.php">nuevo practicante</a>
                </li>
                <li>
                    <a href="#" class="feat-btn">mantenimiento
                        <span class="fas fa-caret-down"></span>
                    </a>
                    <ul class="feat-show">

                        <li><a href="../../addSede/addSede.php">Sede</a> </li>
                        <li><a href="../../addOficina/addOficina.php">oficina</a></li>
                        <li><a href="../../addPracticante/addPracticante.php">Rol</a> </li>
                        <li><a href="../../addRoll/addRoll.php">cargo</a></li>
                        <li><a href="ticketsResueltos.php">Tickets Resueltos</a></li>
                        <li><a href="../indexSoporte.php">Problemas registrados</a></li>
                    </ul>
                </li>

            </ul>
        </nav>
        <?php
        include "../../../../../conexion/conexion.php";
        $verTicketsAsignados = $conexion->query("select * from ticket t
    inner join usuario u on t.idUsuario = u.idUsuario
    where estadoTicket = 'aceptado' ");
        ?>

        <div class="contenido">
            <h1>Ticket designados a los practicantes</h1>
            <table class="table table-hover table-bordered text-center  align-middle">
                <thead class="table-secondary text-white">
                    <tr>
                        <th scope="col">numero de ticket</th>
                        <th class="col">nombre del practicante</th>
                        <th class="col">fecha de asignacion</th>
                        <th class="col">hora de asignacion</th>
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
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <script src="../controladores/menu.js"></script>
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