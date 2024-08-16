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
        <link rel="styleSheet" href="./styleIndex.css?e">
        <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>
    </head>

    <body>
        <nav class="sidebar">
            <div class="text">Menu</div>
            <ul>
                <li>
                    <a href="./pages/addPracticante/addPracticante.php">nuevo practicante</a>
                </li>
                <li>
                    <a href="#" class="feat-btn">mantenimiento
                        <span class="fas fa-caret-down"></span>
                    </a>
                    <ul class="feat-show">
                        <li><a href="pages/soporte/indexSoporte.php">soporte</a> </li>
                        <li><a href="pages/addSede/addSede.php">sede</a></li>
                        <li><a href="pages/addOficina/addOficina.php">oficina</a></li>
                        <li><a href="pages/addRoll/addRoll.php">cargo</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
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


        <script src="controladores/script.js"></script>
        <script type="text/javascript" src="controladores/graficas.js"></script>

    </body>

    </html>

    <?php
} else {
    header("Location: ../../index.php");
}
?>