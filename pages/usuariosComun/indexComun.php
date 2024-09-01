<?php
session_start();
include("../../conexion/conexion.php");
require "controladores/tipoProblemas.php";


if (isset($_SESSION["nombre"])) {
    $usuarioName = $_SESSION["nombre"];
    $usuarioId = $_SESSION["id"];
    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Registrar problema</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="indexComun.css?q   ">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </head>

    <body>
    <div class="container-fluid d-flex flex-column" style="height: 100vh;">
        <div class="text-end mt-3">
            <button class="btn btn-outline-danger btn-sm logout-btn" type="button"
                onclick="window.location.href='controladores/cerrarSesion.php'">
                <i class="bi bi-box-arrow-right"></i> Salir
            </button>
        </div>
        <section class="flex-grow-1 d-flex justify-content-center align-items-center">
            <?php require "controladores/registrarProblema.php"; ?>
            <div class="container">
                <div class="mx-auto w-auto">
                    <form action="" method="post">
                        <div class="Bsuperior text-center">
                            <div class="nombre">
                                <h2>Bienvenido <br> <?= $usuarioName ?></h2>
                            </div>
                            <div class="imagen">
                                <img src='../admin/pages/addPracticante/fotos/<?php echo $usuarioId; ?>.jpg'
                                    alt="imagen usuario" name="imagenUsuario" width="80">
                            </div>
                        </div>
                        <div class="mt-3">
                            <div class="mb-3">
                                <label for="tipoProblema" class="form-label">Ingrese el motivo del problema</label>
                                <select id="tipoProblema" name="tipoProblema" class="form-control" required>
                                    <?php
                                    // Mostrar los problemas en el menú desplegable
                                    while ($problemaV = $resultTipoProblema->fetch_object()) {
                                        echo "<option value='{$problemaV->idTipoProblema}'>{$problemaV->nombreProblema}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="label1" class="form-label">Por favor especifique el problema</label>
                                <textarea id="label1" class="form-control" name="label1" required rows="4"></textarea>
                            </div>
                        </div>
                        <input type="submit" value="Registrar" name="btnregistrar" class="btn btn-success">
                    </form>
                </div>
            </div>
        </section>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>
    <?php
} else {
    header("Location: ../../index.php");
}
?>

</html>