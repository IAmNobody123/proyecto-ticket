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
        <title>SEDES</title>
        <link rel="styleSheet" href="../stylesGeneral.css?x">
        <link rel="styleSheet" href="./addSede.css?p">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </head>

    <body>
        <?php
        require '../../../../conexion/conexion.php';
        require 'controlador/agregar.php';
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
                <li class="paginaActual"><a href="#">Sede</a> </li>
                <li><a href="../addOficina/addOficina.php">Oficina</a></li>
                <li><a href="../addRoll/addRoll.php">Cargo</a></li>
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
                <strong>Ingrese una nueva Sede</strong>
            </nav>

            <div class="container">
                <form action="" method="post" class="d-flex justify-content-between align-items-center">

                    <div class="form-group me-3">
                        <label for="" class="form-label">
                            Ingresar el nombre de la sede:
                        </label>
                        <input type="text" required class="form-control" name="first-label"
                            placeholder="por ejemplo: Central">

                    </div>
                    <div class="form-group me-3">
                        <label for="" class="form-label">
                            Ingresar un lugar de referencia:
                        </label>
                        <input type="text" required class="form-control" name="second-label"
                            placeholder="cerca a la plaza de armas">
                    </div>

                    <button type="submit" class="btn btn btn-success" name="submit">Agregar</button>


                </form>
            </div>
    <br><br>
            <div class="container-table">
                <table class="transparent-table">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Lugar de referencia</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = $conexion->query("select * from sede");
                        while ($problemaV = $sql->fetch_object()) {
                            ?>
                            <tr>
                                <th scope="row"><?= $problemaV->idSede ?></th>
                                <td><?= $problemaV->nombreSede ?></td>
                                <td><?= $problemaV->lugarReferencia ?></td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>

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