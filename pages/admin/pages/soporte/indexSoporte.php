<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atender tareas</title>
    <link rel="styleSheet" href="indexSoporte.css">
    <link rel="styleSheet" href="estilos/modalVer.css?a">
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
                <a href="../addPracticante/addPracticante.php">nuevo practicante</a>
            </li>
            <li>
                <a href="#" class="feat-btn">mantenimiento
                    <span class="fas fa-caret-down"></span>
                </a>
                <ul class="feat-show">
                    <li><a href="../addSede/addSede.php">Sede</a> </li>
                    <li><a href="../addOficina/addOficina.php">oficina</a></li>
                    <li><a href="../addPracticante/addPracticante.php">Rol</a> </li>
                    <li><a href="../addRoll/addRoll.php">cargo</a></li>
                </ul>
            </li>
        </ul>
    </nav>


    <div class="contenido">
        <?php
            include "../../../../conexion/conexion.php";

        ?>
        <div class ="d-flex justify-content-between ">
            <button id="btnProblemas" class ="btn btn-outline-secondary">Ver Problemas</button>
            <button id="btnProblemasAsignados" class ="btn btn-outline-success">Ver Problemas Asignados</button>
            <button id="btnTicketsResueltos" class ="btn btn-outline-dark">Ver Tickets Resueltos</button>
        </div>
        <div id="contenidoDinamico">

        <h1>Por favor presione un boton</h1>

        </div>
    </div>

    <script src="controladores/menuVer.js"></script>
    <script src="controladores/enviarIdProblema.js"></script>
    <script src="controladores/menu.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>