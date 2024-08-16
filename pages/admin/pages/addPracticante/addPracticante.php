<?php
session_start();
include ("../../../../conexion/conexion.php");
if (isset($_SESSION["nombre"])) {
   $usuarioName = $_SESSION["nombre"];
   $usuarioId = $_SESSION["id"];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Practicante</title>
    <link rel="styleSheet" href="../../styleIndex.css?">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
    <link rel="stylesheet" href="./addPracticante.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <?php
    require '../../../../conexion/conexion.php';
    ?>

    <nav class="sidebar">
        <div class="text">Menu</div>
        <ul>
            <li>
                <a href="../../index.php" class="feat-btn">inicio</a>
            </li>
            <li>
                <a href="#">nuevo practicante</a>
            </li>
            <li>
                <a href="#" class="feat-btn">mantenimiento
                    <span class="fas fa-caret-down"></span>
                </a>
                <ul class="feat-show">
                    <li><a href="../soporte/indexSoporte.php">soporte</a> </li>
                    <li><a href="../addSede/addSede.php">sede</a></li>
                    <li><a href="../addOficina/addOficina.php">oficina</a></li>
                    <li><a href="../addRoll/addRoll.php">cargo</a></li>
                </ul>
            </li>
        </ul>
    </nav>
    <!-- barra superior -->
    <div class="top-bar">
        <div class="boxshadow" id="dropdownToggle">
            <img src="<?= $ruta2 ?>" alt="">
        </div>
        <div class="dropdown-menu" id="dropdownMenu">
            <!-- Aquí se pueden añadir opciones adicionales del menú -->
            <a href="#">Opción 1</a>
            <a href="#">Opción 2</a>
            <a href="controlador/cerrarSesion.php">Cerrar sesión</a>
        </div>
    </div>


    <div class="crud">
        <h1 class="text-center text-secondary font-weigt-bold p-4">Agregar practicantes</h1>

        <div class="p-3 table-responsive">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-secondary mb-2" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Agregar nuevo practicante
            </button>
            <?php
            require 'controlador/registrar.php';
            require 'controlador/roles.php';
            include 'controlador/filtrar.php';
            ?>
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title p-2" id="exampleModalLabel" style="color: black">agrega un
                                practicante</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body">
                            <form action="" enctype="multipart/form-data" method="POST">

                                <label for="">Ingresa el nombre del usuario</label>
                                <input type="text" name="nombreUsuario">

                                <label for="">Crea el ID del login del usuario</label>
                                <input type="text" name="idUsuario">

                                <label for="">Ingresa la contraseña del usuario</label>
                                <input type="text" name="contraseñaUsuario">

                                <label for="" class="form-label">Que rol tendra el usuario?</label>

                                <select id="rol" name="roles" required>
                                    <?php
                                    // Mostrar las sedes en el menú desplegable
                                    while ($problemaV = $resultRol->fetch_object()) {
                                        echo "<option value='{$problemaV->idRol}'>{$problemaV->nombreRol}</option>";
                                    }
                                    ?>
                                </select>

                                <br>

                                <label for="" class="form-label">De que oficina sera?</label>

                                <select id="oficinaSelected" name="oficina" required>
                                    <?php
                                    // Mostrar las sedes en el menú desplegable
                                    while ($row1 = $resultOficina->fetch_object()) {
                                        echo "<option value='{$row1->idOficina}'>{$row1->nombreOficina}</option>";
                                    }
                                    ?>
                                </select>

                                <input type="file" class="form-control mb-2" name="imagen" required>

                                <input type="submit" value="Registrar" name="btnregistrar"
                                    class="form-control btn btn-success">
                            </form>
                        </div>

                    </div>
                </div>
            </div>
            <form method="POST" class="mb-3" action="">
                <div class="row">
                    <div class="col">
                        <label for="oficina">Oficina:</label>
                        <select name="oficinaS" id="oficina" class="form-select">
                            <option value="">Todas</option>
                            <?php
                            // Obtener las oficinas de la base de datos
                            $oficinaQuery = "SELECT * FROM oficina";
                            $oficinas = $conexion->query($oficinaQuery);
                            while ($oficina = $oficinas->fetch_object()) {
                                echo "<option value='{$oficina->idOficina}'>{$oficina->nombreOficina}</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col">
                        <label for="rol">Rol:</label>
                        <select name="rolS" id="rol" class="form-select">
                            <option value="">Todos</option>
                            <?php
                            // Obtener los roles de la base de datos
                            $rolQuery = "SELECT * FROM rol";
                            $roles = $conexion->query($rolQuery);
                            while ($rol = $roles->fetch_object()) {
                                echo "<option value='{$rol->idRol}'>{$rol->nombreRol}</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <input type="submit" value="Filtrar" class="btn btn-primary mt-4" name="btnFiltrar">
            </form>

            <table class="table table-hover table-bordered text-center  align-middle">

                <thead class="table-secondary text-white">
                    <tr>
                        <th scope="col">NRO</th>
                        <th scope="col">FOTO</th>
                        <th scope="col">NOMBRE</th>
                        <th scope="col">idLogin</th>
                        <th scope="col">contraseña</th>
                        <th scope="col">opciones</th>
                    </tr>
                </thead>

                <tbody>
                    <?php

                    if ($sql->num_rows > 0) {
                        $numero = 1;
                        while ($problemaV = $sql->fetch_object()) {
                            ?>
                            <tr>
                                <th scope="row"><?= $numero; ?></th>
                                <td>
                                    <img height="90" src="<?= $problemaV->direccionImagen ?>" alt="">
                                </td>
                                <td><?= $problemaV->nombre ?></td>
                                <td><?= $problemaV->idLogin ?></td>
                                <td class="password-cell">
                                    <div class="password-field">
                                        <input type="password" id="password<?= $problemaV->idUsuario ?>" value='<?= $problemaV->password ?>'
                                            readonly>
                                        <span class="toggle-password">
                                            <i class="fas fa-eye"></i>
                                        </span>
                                    </div>
                                </td>
                                <td>
                                    <a href="" class="btn btn-warning">editar</a>
                                    <a href="" class="btn btn-danger">eliminar</a>
                                </td>
                            </tr>
                            <?php
                            $numero++;
                        }
                    } else {
                        echo "<tr><td colspan='6'>No se encontraron resultados.</td></tr>";
                    }
                    ?>

                </tbody>
            </table>
        </div>
    </div>

    <script src='controlador/alerta.js'></script>
    <script src="controlador/eventoClick.js"></script>
    <script src="controlador/verContra.js"></script>
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

</html>