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
        <title>OFICINAS</title>
        <link rel="styleSheet" href="../stylesGeneral.css?ñ">
        <link rel="styleSheet" href="./addOficina.css?ds">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>

    <body>
        <?php
        require "../../../../conexion/conexion.php";
        require "controlador/sedes.php";
        require "controlador/registrar.php";
        ?>

        <nav class="sidebar">
            <div class="text">Menu</div>
            <ul>
                <li>
                    <a href="../../index.php" class="feat-btn"><i class="fa fa-home"></i> Inicio</a>
                </li>
                <li>
                    <a href="../addPracticante/addPracticante.php"><i class="fa fa-user-plus"></i> Nuevo usuario</a>
                </li>
                <li>
                    <div class="mantenimiento">
                        <h1 class="tituloM"><i class="fa fa-wrench"></i> Mantenimiento</h1>
                    </div>
                </li>
                <li><a href="../soporte/indexSoporte.php"><i class="fa fa-ticket"></i> Tickets recibidos</a></li>
                <li><a href="../soporte/layouts/tablaTicketsAsignados.php"><i class="fa fa-tasks"></i> Tickets Asignados</a>
                </li>
                <li><a href="../soporte/layouts/ticketsResueltos.php"><i class="fa fa-check-circle"></i> Tickets
                        Resueltos</a></li>
                <div class="mantenimiento">
                </div>
                <li><a href="../addSede/addSede.php"><i class="fa fa-building"></i> Sede</a></li>
                <li class="paginaActual"><a href="#"><i class="fa fa-briefcase"></i>Oficina</a></li>
                <li><a href="../addRoll/addRoll.php"><i class="fa fa-id-badge"></i> Cargo</a></li>
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
            <nav class="navbar navbar-light justify-content-center fs-3 mb-5">
                <strong>Ingrese una nueva oficina</strong>
            </nav>

            <div class="container">
                <form action="" method="POST" class="d-flex justify-content-between align-items-center">

                    <div class="form-group me-3">
                        <label for="nombreOficina" class="form-label">Ingresar el nombre de la oficina:</label>
                        <input type="text" required class="form-control" name="second-label" id="nombreOficina"
                            placeholder="por ejemplo: OTI">
                    </div>
                    <div class="form-group me-3">
                        <label for="sede" class="form-label">Ingresar el nombre de la sede:</label>
                        <select id="sede" name="sede" class="form-select" required>
                            <?php
                            // Mostrar las sedes en el menú desplegable
                            while ($problemaV = $resultSedes->fetch_object()) {
                                echo "<option value='{$problemaV->idSede}'>{$problemaV->nombreSede}</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success" name="submit">Agregar</button>
                </form>
            </div>

            <div class="container-table">
                <table>
                    <thead>
                        <tr>
                            <th scope="col">nro</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Sede</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = $conexion->query("select * from oficina o inner join sede s on o.idSede=s.idSede");

                        while ($problemaV = $sql->fetch_object()) {
                            ?>
                            <tr>
                                <th scope="row"><?= $problemaV->idOficina ?></th>
                                <td><?= $problemaV->nombreOficina ?></td>
                                <td><?= $problemaV->nombreSede ?></td>
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
    header("Location: ../../../../index.php");
}
?>