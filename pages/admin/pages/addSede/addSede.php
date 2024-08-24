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
        <link rel="styleSheet" href="../stylesGeneral.css?p">
        <link rel="styleSheet" href="./addSede.css?p">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
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
                    <a href="../addPracticante/addPracticante.php">nuevo practicante</a>
                </li>
                <li>
                    <div class="mantenimiento">
                        <h1 class="tituloM">mantenimiento</h1>
                        <span class="fas fa-caret-down"></span>
                    </div>
                <li><a href="../soporte/indexSoporte.php">soporte</a> </li>
                <li><a href="../addPracticante/addPracticante.php">practicante</a> </li>

                <li><a href="../addOficina/addOficina.php">oficina</a></li>
                <li><a href="../addRoll/addRoll.php">cargo</a></li>

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
                Ingrese una nueva Sede
            </nav>

            <div class="container justify-content-center">
                <form action="" method="post">
                    <div class="row">
                        <div class="col">
                            <label for="" class="form-label">
                                Ingresar el nombre de la sede:
                            </label>
                            <input type="text" required class="form-control" name="first-label" placeholder="por ejemplo: Central">

                        </div>
                        <div class="col">
                            <label for="" class="form-label">
                                Ingresar un lugar de referencia:
                            </label>
                            <input type="text" required class="form-control" name="second-label"
                                placeholder="cerca a la plaza de armas">
                        </div>
                        <div class="col">
                            <button type="submit" class="btn btn btn-outline-success" name="submit">Agregar</button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="container-table">
                <table class="transparent-table">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Referencia</th>
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