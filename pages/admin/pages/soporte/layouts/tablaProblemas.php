
<h1>Designar Tarea</h1>
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
        include "../../../../../conexion/conexion.php";
        include "../controladores/practicantes.php";
        include "../controladores/atenderProblema.php";
        include "../layouts/modalVer.php";
        include "../layouts/modalAtender.php";
        $verProblemasEnviados = $conexion->query("select *
        from tipoProblema TP inner join problema P on TP.idTipoProblema = P.idTipoProblema inner join usuario U on P.idUsuario = U.idUsuario inner join oficina O on U.idOficina = O.idOficina inner join sede S on O.idSede = S.idSede where estadoProblema ='entregado' and U.estado='activo' order by P.fechaProblema ASC ");
        while ($row = $verProblemasEnviados->fetch_object()) {
            ?>
            <tr>
                <th scope="row"><?= $row->nombre ?></th>
                <td><?= $row->nombreProblema ?></td>
                <td><?= $row->nombreOficina ?></td>
                <td><?= $row->nombreSede ?></td>
                <td>
                    <a href="modalVer.php" class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#myModal"
                        data-id-problema="<?= $row->idProblema ?>" data-nombre="<?= $row->nombre ?>"
                        data-nombre-problema="<?= $row->nombreProblema ?>"
                        data-descripcion="<?= $row->descripcionProblema ?>" data-nombre-oficina="<?= $row->nombreOficina ?>"
                        data-nombre-sede="<?= $row->nombreSede ?>">
                        Ver
                    </a>

                    <a class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#modalAtender"
                        data-id-problema="<?= $row->idProblema ?>"
                        onclick="setIdProblema('<?= $row->idProblema ?>')">Designar</a>
                </td>
            </tr>
            <?php
        }
        ?>
    </tbody>
</table>
<script src="../controladores/capturarDatos.js"></script>