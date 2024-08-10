<!-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver lista de problemas</title>
    <link rel="stylesheet" href="style/styleTabla.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="@sweetalert2/themes/dark/dark.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>

</body>


</html> -->
<div class="text-end">
    <button class="btn btn-outline-danger btn-sm logout-btn" type="button"
        onclick="window.location.href='controladores/cerrarSesion.php'">
        <i class="bi bi-box-arrow-right"></i> Salir
    </button>
</div>
<?php
require '../../../../conexion/conexion.php';
require 'controladores/crearTicket.php';
$sql = $conexion->query("select *
        from tipoProblema TP inner join problema P on TP.idTipoProblema = P.idTipoProblema inner join usuario U on P.idUsuario = U.idUsuario inner join oficina O on U.idOficina = O.idOficina inner join sede S on O.idSede = S.idSede where estadoProblema ='entregado' ");

?>
<table class="table table-hover table-bordered text-center  align-middle">

    <thead class="table-secondary text-white">
        <tr>
            <th scope="col">nombre del solicitante</th>
            <th scope="col">nombre del problema</th>
            <th scope="col">nombre de la oficina</th>
            <th scope="col">nombre de la sede</th>
            <th scope="col">opciones</th>
        </tr>
    </thead>

    <tbody>
        <?php
        while ($row = $sql->fetch_object()) {
            ?>
            <tr>
                <th scope="row"><?= $row->nombre ?></th>
                <td><?= $row->nombreProblema ?></td>
                <td><?= $row->nombreOficina ?></td>
                <td><?= $row->nombreSede ?></td>
                <td>
                    <a href="#" class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#myModal"
                        data-id-problema="<?= $row->idProblema ?>" data-nombre="<?= $row->nombre ?>"
                        data-nombre-problema="<?= $row->nombreProblema ?>"
                        data-descripcion="<?= $row->descripcionProblema ?>" data-nombre-oficina="<?= $row->nombreOficina ?>"
                        data-nombre-sede="<?= $row->nombreSede ?>">
                        Ver
                    </a>

                    <form action="" method="POST" style="display:inline;">
                        <input type="hidden" name="idProblema" value="<?= $row->idProblema ?>">
                        <input type="hidden" name="idUsuario" value="<?= $idUsuario ?>">
                        <button type="submit" class="btn btn-outline-success" name="btnAtender">Atender</button>
                    </form>
                </td>
            </tr>
            <?php
        }
        ?>

        <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myModalLabel">Detalles</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p id="modalId"></p>
                        <p id="modalNombre"></p>
                        <p id="modalProblema"></p>
                        <p id="modalEspecifico"></p>
                        <p id="modalOficina"></p>
                        <p id="modalSede"></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.min.js"></script>


        <script>
            // Capturar el evento de clic en el botón "ver"
            $('#myModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget); // Botón que activó el modal
                var idProblemas = button.data('id-problema');
                var nombre = button.data('nombre'); // Extraer la información de los atributos data-*
                var nombreProblema = button.data('nombre-problema');
                var desctipcionProblema = button.data('descripcion');
                var nombreOficina = button.data('nombre-oficina');
                var nombreSede = button.data('nombre-sede');

                // Actualizar el contenido del modal
                var modal = $(this);
                modal.find('#modalId').text('numero de problema: ' + idProblemas);
                modal.find('#modalNombre').text('Nombre: ' + nombre);
                modal.find('#modalProblema').text('Problema: ' + nombreProblema);
                modal.find('#modalEspecifico').text('Descripcion : ' + desctipcionProblema);
                modal.find('#modalOficina').text('Oficina: ' + nombreOficina);
                modal.find('#modalSede').text('Sede: ' + nombreSede);
            });
        </script>