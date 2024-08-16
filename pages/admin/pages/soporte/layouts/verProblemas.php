<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
</head>
<body>
<?php
include "../../../../../conexion/conexion.php";
include "../controladores/practicantes.php";
?>

<h1>Designar Tarea</h1>
<table class="table table-hover table-bordered text-center align-middle">
    <thead class="table-secondary text-white">
        <tr>
            <th scope="col">Nombre del Solicitante</th>
            <th scope="col">Nombre del Problema</th>
            <th scope="col">Nombre de la Oficina</th>
            <th scope="col">Nombre de la Sede</th>
            <th scope="col">Opciones</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $verProblemasEnviados = $conexion->query("SELECT * FROM tipoProblema TP 
            INNER JOIN problema P ON TP.idTipoProblema = P.idTipoProblema 
            INNER JOIN usuario U ON P.idUsuario = U.idUsuario 
            INNER JOIN oficina O ON U.idOficina = O.idOficina 
            INNER JOIN sede S ON O.idSede = S.idSede 
            WHERE estadoProblema ='entregado' AND U.estado='activo' 
            ORDER BY P.fechaProblema ASC");

        while ($problemaV = $verProblemasEnviados->fetch_object()) {
            ?>
            <tr>
                <th scope="row"><?= $problemaV->nombre ?></th>
                <td><?= $problemaV->nombreProblema ?></td>
                <td><?= $problemaV->nombreOficina ?></td>
                <td><?= $problemaV->nombreSede ?></td>
                <td>
                    <a href="#" class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#modalDetalle"
                        data-id-problema="<?= $problemaV->idProblema ?>" data-nombre="<?= $problemaV->nombreProblema ?>">
                        <!-- Cambié aquí para mostrar el nombre del problema -->
                        Ver
                    </a>
                    <a class="btn btn-outline-success">Designar</a>
                </td>
            </tr>
            <?php
        }
        ?>
    </tbody>
    
</table>

<div class="modal fade" id="modalDetalle" tabindex="-1" aria-labelledby="modalDetalleLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalDetalleLabel">Detalle del Problema</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p id="modalId"></p>
                <p id="modalNombre"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<script>
    // Cargar datos del problema seleccionado en el modal
    $('#modalDetalle').on('show.bs.modal', function (event) {
        console.log('Modal abierto');
        var button = $(event.relatedTarget); // Botón que activó el modal

        var idProblemas = button.data('id-problema');
        var nombreP = button.data('nombre');

        // Actualizar el contenido del modal
        var modal = $(this);
        modal.find('#modalId').text('Número de Problema: ' + idProblemas);
        modal.find('#modalNombre').text('Nombre del Problema: ' + nombreP);
    });
</script>
</body>
</html>