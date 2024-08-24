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
        <link rel="stylesheet" href="./addRoll.css?z">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
                    <a href="../../index.php" class="feat-btn">Inicio</a>
                </li>
                <li>
                    <a href="../addPracticante/addPracticante.php">Nuevo usuario</a>
                </li>
                <li>
                    <div class="mantenimiento">
                        <h1 class="tituloM">mantenimiento</h1>
                        <span class="fas fa-caret-down"></span>
                    </div>
                <li><a href="../soporte/indexSoporte.php">Tickets recibidos</a></li>
                <li><a href="../soporte/layouts/tablaTicketsAsignados.php">Tickets Asignados</a> </li>
                <li><a href="../soporte/layouts/ticketsResueltos.php">Tickets Resueltos</a></li>
                <li><a href="../addSede/addSede.php">Sede</a> </li>
                <li><a href="../addOficina/addOficina.php">Oficina</a></li>
                <li class="paginaActual"><a href="#">Cargo</a></li>
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

            <div class="container">
                <form action="" method="post" class="formCargo">
                    <div class="row">
                        <div class="col">
                            <label for="" class="form-label">
                                Ingresar el nombre del nuevo cargo:
                            </label>
                            <br>
                            <input type="text" required class="form-control" name="first-label" placeholder="practicante">

                        </div>

                    </div>
                    <div class="col">
                        <button type="submit" class="btn btn-success mb-2" name="submitRoll">Agregar</button>
                    </div>


                </form>
            </div>

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