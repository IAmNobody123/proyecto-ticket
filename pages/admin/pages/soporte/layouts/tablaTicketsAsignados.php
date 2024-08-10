<?php
    include "../../../../../conexion/conexion.php";
    $verTicketsAsignados = $conexion -> query("select * from ticket t
    inner join usuario u on t.idUsuario = u.idUsuario
    where estadoTicket = 'aceptado' "); 
?>
<h1>Ticket designados a los practicantes</h1>
<table class="table table-hover table-bordered text-center  align-middle">
    <thead class="table-secondary text-white">
        <tr>
        <th scope="col">numero de ticket</th>
        <th class="col">nombre del practicante</th>
        <th class="col">fecha de asignacion</th>
        <th class="col">hora de asignacion</th>
        </tr>
    </thead>

    <tbody>
        <?php
        
        while ($row = $verTicketsAsignados->fetch_object()) {
            ?>
            <tr>
                <th scope="row"><?= $row->idTicket ?></th>
                <td><?= $row->nombre ?></td>
                <td><?= $row->fecha ?></td>
                <td><?= $row->hora ?></td>
            </tr>
            <?php
        }
        ?>
    </tbody>
</table>