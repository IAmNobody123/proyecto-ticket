<?php
session_start();
include("../../conexion/conexion.php");
if (isset($_SESSION["nombre"])) {
    $usuarioName = $_SESSION["nombre"];
    $usuarioId = $_SESSION["id"];
    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>administrador</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
        <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.8.0/chart.min.js"></script>
        <link rel="styleSheet" href="pages/stylesGeneral.css?6">
        <link rel="styleSheet" href="./styleIndex.css?6">
        <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>
    </head>

    <body>
        <nav class="sidebar">
            <div class="text">Menu</div>
            <ul>
                <li class="paginaActual">
                    <a href="#" class="feat-btn">inicio</a>
                </li>
                <li>
                    <a href="./pages/addPracticante/addPracticante.php">nuevo practicante</a>
                </li>
                <li>
                    <div class="mantenimiento">
                        <h1 class="tituloM">mantenimiento</h1>
                        <span class="fas fa-caret-down"></span>
                    </div>
                <li><a href="pages/soporte/indexSoporte.php">Tickets recibidos</a></li>
                <li><a href="pages/soporte/layouts/tablaTicketsAsignados.php">Tickets Asignados</a> </li>
                <li><a href="pages/soporte/layouts/ticketsResueltos.php">Tickets Resueltos</a></li>
                <li><a href="pages/addSede/addSede.php">Sede</a></li>
                <li><a href="pages/addOficina/addOficina.php">Oficina</a></li>
                <li><a href="pages/addRoll/addRoll.php">Cargo</a></li>

                </li>
            </ul>
        </nav>

        <div class="top-bar" id="welcomeA">
            <h1 id="welcomeAdm">Bienvenido Admin</h1>
            <div class="boxshadow" id="dropdownToggle">
                <img src="pages/addPracticante/fotos/<?= $usuarioId ?>.png" alt="">
            </div>
            <div class="dropdown-menu" id="dropdownMenu">
                <a href="pages/addPracticante/controlador/cerrarSesion.php">Cerrar sesión</a>
            </div>
        </div>

        <div class="pantalla">
            <h1 id="titulo">Graficas de soporte tecnico</h1>

            <div class="contenido">
                <div class="div1">
                    <canvas class="grafica" width="auto" height="auto"></canvas>
                </div>
                <div class="div2">
                    <canvas class="grafica1" width="auto" height="auto"></canvas>
                </div>
                <div class="div3">
                    <canvas class="grafica2" width="auto" height="150"></canvas>

                </div>
            </div>
        </div>

        <script src="pages/addPracticante/controlador/eventoClick.js"></script>

        <script type="text/javascript" src="controladores/graficas.js"></script>
        <script type="text/javascript" src="controladores/grafica2.js"></script>
        <script type="text/javascript" src="controladores/grafica3.js"></script>

    </body>

    </html>

    <?php
} else {
    header("Location: ../../index.php");
}
?>