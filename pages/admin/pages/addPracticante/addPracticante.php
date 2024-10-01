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
        <title>Agregar Practicante</title>
        <link rel="styleSheet" href="../../styleIndex.css?pss">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
        <link rel="stylesheet" href="./addPracticante.css?skdd">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>

    <body>
        <?php
        require '../../../../conexion/conexion.php';
        ?>

<nav class="sidebar">
    <div class="text">Menu</div>
    <ul>
        <li>
            <a href="../../index.php" class="feat-btn"><i class="fa fa-home"></i> Inicio</a>
        </li>
        <li class="paginaActual">
            <a href="#"><i class="fa fa-user-plus"></i> Nuevo usuario</a>
        </li>
        <li>
            <div class="mantenimiento">
                <h1 class="tituloM"><i class="fa fa-wrench"></i> Mantenimiento</h1>
            </div>
        </li>
        <li><a href="../soporte/indexSoporte.php"><i class="fa fa-ticket"></i> Tickets recibidos</a></li>
        <li><a href="../soporte/layouts/tablaTicketsAsignados.php"><i class="fa fa-tasks"></i> Tickets Asignados</a></li>
        <li><a href="../soporte/layouts/ticketsResueltos.php"><i class="fa fa-check-circle"></i> Tickets Resueltos</a></li>
        <div class="mantenimiento">
                </div>
        <li><a href="../addSede/addSede.php"><i class="fa fa-building"></i> Sede</a></li>
        <li><a href="../addOficina/addOficina.php"><i class="fa fa-briefcase"></i> Oficina</a></li>
        <li><a href="../addRoll/addRoll.php"><i class="fa fa-id-badge"></i> Cargo</a></li>
    </ul>
</nav>

        <!-- barra superior -->
        <div class="top-bar" id="welcomeA">
            <h1 id="welcomeAdm">Bienvenido Admin</h1>
            <div class="boxshadow" id="dropdownToggle">
                <img src="fotos/<?= $usuarioId ?>.png" alt="">
            </div>
            <div class="dropdown-menu" id="dropdownMenu">
                <a href="controlador/cerrarSesion.php">Cerrar sesión</a>
            </div>
        </div>

        <!-- Todo el contenido-->
        <div class="crud">
            <h1 class="title">Agregar usuarios</h1>

            <div class="p-3 table-responsive">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-secondary mb-2" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Agregar un nuevo usuario
                </button>
                <?php
                include 'controlador/registrar.php';
                require 'controlador/roles.php';
                include 'controlador/eliminarUsuario.php';
                include 'controlador/filtrar.php';
                include 'controlador/habilitarU.php';
                include 'controlador/editarUsuario.php';

                ?>
                <!-- Modal registrar-->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header ">
                                <h1 class=" mx-auto" id="exampleModalLabel"
                                    style="color: black; font-size:20px; padding-left:80px;">agrega un
                                    practicante</h1>
                                <button type="button" class="btn-close text-align-end" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>

                            <div class="modal-body">
                                <form action="" enctype="multipart/form-data" method="POST">

                                    <div class="camposF">
                                        <label class="textoF">Ingresa el nombre del usuario</label>
                                        <input type="text" name="nombreUsuario" class="entradaT nombreU"
                                            placeholder="por ejemplo Juan" minlength="10" required>
                                    </div>
                                    <br>
                                    <div class="camposF">
                                        <label class="textoF">Crea el ID del login del usuario</label>
                                        <input type="text" class="entradaT" name="idUsuario"
                                            placeholder="por ejemplo elmotivo" minlength="6" required>
                                    </div>

                                    <br>
                                    <div class="camposF">
                                        <label class="textoF">Ingresa la contraseña del usuario</label>
                                        <input type="text" class="entradaT" name="contraseñaUsuario"
                                            placeholder="ingresa tu contraseña" minlength="6" required>
                                    </div>
                                    <br>
                                    <div class="camposF">
                                        <label class="textoF" for="">
                                            Seleccione el género:
                                        </label>
                                        <label for="masculino">
                                            Varón:
                                        </label>
                                        <input type="radio" name="sexo" id="masculino" value="masculino">

                                        <label for="femenino">
                                            Mujer:
                                        </label>
                                        <input type="radio" name="sexo" id="femenino" value="femenino">
                                    </div>
                                    <br>
                                    <div class="camposF">
                                        <label class="textoF" class="form-label">Que rol tendra el usuario?</label>

                                        <select id="rol" name="roles" required>
                                            <div class="opciones">
                                                <?php
                                                // Mostrar las sedes en el menú desplegable
                                                while ($problemaV = $resultRol->fetch_object()) {
                                                    echo "<option value='{$problemaV->idRol}'>{$problemaV->nombreRol}</option>";
                                                }
                                                ?>
                                            </div>

                                        </select>
                                    </div>

                                    <br>

                                    <div class="camposF">
                                        <label class="textoF">De que oficina sera?</label>

                                        <select id="oficinaSelected" name="oficina" required>
                                            <?php
                                            // Mostrar las sedes en el menú desplegable
                                            while ($row1 = $resultOficina->fetch_object()) {
                                                echo "<option value='{$row1->idOficina}'>{$row1->nombreOficina}</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <br>

                                    <input type="file" class="form-control mb-2 " name="imagen" id="subirArchivo"
                                        accept="image/*">
                                    <br>
                                    <input type="submit" value="Registrar" name="btnregistrar"
                                        class="form-control btn btn-success">
                                </form>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- formulario para fitrar -->
                <form method="POST" class="mb-3" action="">
                    <div class="row">
                        <div class="col col-3">
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
                        <div class="col col-3">
                            <label for="rolS">Rol:</label> <!-- Cambiado para que coincida con el nuevo ID -->
                            <select name="rolS" id="rolS" class="form-select"> <!-- Cambiado el ID a 'rolS' -->
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
                        <div class="col col-3">
                            <label for="estado">estado del Usuario:</label>
                            <select name="estado" id="estado" class="form-select">
                                <option value="">Todas</option>
                                <option value="activo">activo</option>
                                <option value="inactivo">inactivo</option>
                            </select>
                        </div>
                        <div class="col col-3">
                            <input type="submit" value="Filtrar" class="btn btn-primary mt-4" name="btnFiltrar">
                        </div>
                    </div>

                </form>

                <!-- trabla para ver los usuarios -->
                <table class="transparent-table">
                    <thead id="cabecera">
                        <tr>
                            <th scope="col">NRO</th>
                            <th scope="col">FOTO</th>
                            <th scope="col">NOMBRE</th>
                            <th scope="col">idLogin</th>
                            <th scope="col">CONTRASEÑA</th>
                            <th scope="col">OPCIONES</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($sql && $sql->num_rows > 0) {
                            $numero = 1;
                            while ($problemaV = $sql->fetch_object()) {
                                ?>
                                <tr>
                                    <th scope="row"><?= $numero; ?></th>
                                    <td>
                                        <img height="90" src="<?= htmlspecialchars($problemaV->direccionImagen) ?>" alt="">
                                    </td>
                                    <td><?= htmlspecialchars($problemaV->nombre) ?></td>
                                    <td><?= htmlspecialchars($problemaV->idLogin) ?></td>
                                    <td class="password-cell">
                                        <div class="password-field">
                                            <input type="password" id="password<?= $problemaV->idUsuario ?>"
                                                value='<?= htmlspecialchars($problemaV->password) ?>' readonly>
                                            <span class="toggle-password">
                                                <i class="fas fa-eye"></i>
                                            </span>
                                        </div>
                                    </td>
                                    <td>
                                        <form method="POST" action="" id="formEliminar<?= $problemaV->idUsuario ?>">
                                            <input type="hidden" name="eliminar" value="<?= $problemaV->idUsuario ?>">

                                            <?php

                                            if ($problemaV->estado == "activo") {
                                                ?>
                                                <input type="button" value="Deshabilitar" class="btn btn-danger"
                                                    onclick="confirmarEliminacion(<?= $problemaV->idUsuario ?>)">
                                                <?php
                                            } else {
                                                ?>
                                                <input type="submit" value="Habilitar" class="btn btn-success" name="habilitarU">
                                                <?php
                                            }
                                            ?>
                                        </form>


                                        <a type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editModal<?= $problemaV->idUsuario?>">
                                            Editar
                                        </a>
                                    </td>
                                </tr>


                                <div class="modal fade" id="editModal<?= $problemaV->idUsuario?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header ">
                                                <h1 class=" mx-auto" id="exampleModalLabel"
                                                    style="color: black; font-size:20px; padding-left:80px;">Editar Usuario</h1>
                                                <button type="button" class="btn-close text-align-end" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form action="" enctype="multipart/form-data" method="post">
                                                <div class="modal-body">
                                                    <input type="text" hidden name="idUsuario" value="<?= $problemaV->idUsuario ?>">
                                                    <input type="text" hidden name="ruta" value="<?= $problemaV->direccionImagen ?>">

                                                    <div class="form-group">
                                                        <label for="nombre">Nombre</label>
                                                        <input type="text" class="form-control" value="<?= $problemaV->nombre ?>" name="nombre" >
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="idLogin">ID Login</label>
                                                        <input type="text" class="form-control" value="<?= $problemaV->idLogin ?>" name="idLogin"
                                                            >
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="password">Contraseña</label>
                                                        <input type="text" class="form-control" value="<?= $problemaV->password ?>" name="password"
                                                            >
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="imagen">Dirección de Imagen</label>
                                                        <input type="file" class="form-control" id="direccionImagen"
                                                            name="imagen" >
                                                    </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Cerrar</button>

                                                    <input type="submit" value="Guardar Cambios" class="btn btn-warning"
                                                        name="editarU">
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
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

        <script src="controlador/eventoClick.js"></script>
        <script src="controlador/verContra.js"></script>
        <script>
            function confirmarEliminacion(idUsuario) {
                Swal.fire({
                    title: '¿Estás seguro?',
                    text: "¡No podrás revertir esto!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, eliminarlo!',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Si el usuario confirma, enviar el formulario
                        document.getElementById('formEliminar' + idUsuario).submit();
                    }
                });
            }
        </script>
        <script>
            document.getElementById('exampleModal').addEventListener('btnRegistrar', function (event) {
                const idInput = document.getElementById('idUsuario');
                if (idInput.value.trim() === '') {
                    alert('El campo ID no puede estar vacío.');
                    event.preventDefault(); // Evita el envío del formulario
                }
            });
        </script>
    </body>

    </html>
    <?php
} else {
    header("Location: ../../../../index.php");
}
?>

</html>