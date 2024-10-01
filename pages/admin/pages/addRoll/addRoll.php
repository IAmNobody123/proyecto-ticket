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
        <title>Cargo</title>
        <link rel="styleSheet" href="../stylesGeneral.css?x">
        <link rel="stylesheet" href="./addRoll.css?d">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>

    <body>
        <?php
        require '../../../../conexion/conexion.php';
        require 'controlador/registrar.php';
        ?>
        <nav class="sidebar">
            <div class="text">Menu</div>
            <ul>
                <li>
                    <a href="../../index.php" class="feat-btn">  <i class="fa fa-home"></i> Inicio</a>
                </li>
                <li>
                    <a href="../addPracticante/addPracticante.php"> <i class="fa fa-user-plus"></i> Nuevo usuario</a>
                </li>
                <li>
                    <div class="mantenimiento">
                        <h1 class="tituloM"> <i class="fa fa-wrench"></i> Mantenimiento</h1>
                    </div>
                <li><a href="../soporte/indexSoporte.php"> <i class="fa fa-ticket"></i> Tickets recibidos</a></li>
                <li><a href="../soporte/layouts/tablaTicketsAsignados.php"> <i class="fa fa-tasks"></i> Tickets Asignados</a> </li>
                <li><a href="../soporte/layouts/ticketsResueltos.php"> <i class="fa fa-check-circle"></i> Tickets Resueltos</a></li>
                <div class="mantenimiento">
                </div>
                <li><a href="../addSede/addSede.php"> <i class="fa fa-building"></i> Sede</a> </li>
                <li><a href="../addOficina/addOficina.php"> <i class="fa fa-briefcase"></i> Oficina</a></li>
                <li class="paginaActual"><a href="#"> <i class="fa fa-id-badge"></i> Cargo</a></li>
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
        <nav class="navbar navbar-ligth justify-content-center fs-3 mb-5">
                <strong>Ingrese un nuevo Cargo</strong>
            </nav>

            
            <div class="container-table">
                <table class="transparent-table">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nombre</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = $conexion->query("select * from rol");

                        while ($problemaV = $sql->fetch_object()) {
                            ?>
                            <tr>
                                <th scope="row"><?= $problemaV->idRol ?></th>
                                <td><?= $problemaV->nombreRol ?></td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>

        </div>


        <script>
            $('.feat-btn').click(function () {
                $('nav ul .feat-show').toggleClass("show");
            });
            $('nav ul li').click(function () {
                $(this).addClass("active").siblings().removeClass("active");
            });
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous"></script>
    </body>
    <script src="../addPracticante/controlador/eventoClick.js"></script>

    </html>
    <?php
} else {
    header("Location: ../../index.php");
}
?>