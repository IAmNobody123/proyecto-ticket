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
        
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="styleSheet" href="../stylesGeneral.css?we">
        <link rel="styleSheet" href="./addSede.css?we">
        <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
                <a href="../../../index.php" class="feat-btn"><i class="fa fa-home"></i>Inicio</a>
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
                <li class="paginaActual"><a href="#"> <i class="fa fa-building"></i> Sede</a> </li>
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