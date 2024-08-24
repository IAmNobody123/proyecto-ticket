<?php
session_start();
include ("../../conexion/conexion.php");
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
    <link rel="stylesheet" href="indexComun.css?s">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>

    <section>
        <div class="text-end">
            <button class="btn btn-outline-danger btn-sm logout-btn" type="button" onclick="window.location.href='controladores/cerrarSesion.php'">
                <i class="bi bi-box-arrow-right"></i> Salir
            </button>
        </div>
        <?php require "controladores/registrarProblema.php"; ?>
        <div class="container">
            <div class="d-flex align-items-center ">
                <div class="mx-auto w-auto">
                    <form action="" class="form-control" method="post">
                        <div class="Bsuperior">
                            <div class="nombre">
                                <h2>Bienvenido <br> <?= $usuarioName ?></h2>
                            </div>
                            <div class="imagen">
                                <img src='../admin/pages/addPracticante/fotos/<?php echo $usuarioId; ?>.jpg'
                                    alt="imagen usuario" name="imagenUsuario" width="80">
                            </div>
                        </div>
                        <div class=" ">
                            <div class="row">
                                <label for="" class="form-label">Ingrese el motivo del problema</label>
                                <select id="tipoProblema" name="tipoProblema" class="form-control " required>
                                    <?php
                                    // Mostrar los problemas en el menú desplegable
                                    while ($problemaV = $resultTipoProblema->fetch_object()) {
                                        echo "<option value='{$problemaV->idTipoProblema}'>{$problemaV->nombreProblema}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="row">
                                <label for="" class="form-label">Por favor especifique el problema</label>
                                <input type="text" class="form-control" name="label1" required>
                            </div>
                        </div>
                        <input type="submit" value="Registrar" name="btnregistrar" class="btn btn-success">
                    </form>
                </div>

            </div>
        </div>
    </section>


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