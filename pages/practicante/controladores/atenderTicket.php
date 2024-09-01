<?php
if (isset($_POST["submitAtenderP"])) {
    if (!empty($_POST["idTicket"])) {
        $usuarioId = $_SESSION['id'];
        $idTicket = $_POST["idTicket"];
        date_default_timezone_set("America/Lima");
        $fecha = date("Y-m-d");
        $hora = date("H:i:s");
        $requerimiento =$_POST['selectorReq'];
        $descripcionSolucion = $_POST['descrip'];

        // Preparar la consulta SQL
        $updateTicket = "UPDATE ticket SET estadoTicket='finalizado', requerimiento = ?, descripcion_solucion = ? WHERE idTicket = ?";

        $actualizarEstadoPracticante = "UPDATE usuario set tareaAsignada= 'libre' where idUsuario=?";

        $actualizarFechaTicket = "UPDATE ticket set fechaAtencion=?, horaAtencion = ?  where idTicket=?";

        $stmtUpdateT= $conexion->prepare($updateTicket);
        $stmtActualizarEP = $conexion->prepare($actualizarEstadoPracticante);
        $stmtActualizarFT = $conexion->prepare($actualizarFechaTicket);

        // Vincular parámetros
        $stmtUpdateT -> bind_param("ssi", $requerimiento, $descripcionSolucion, $idTicket);
        $stmtActualizarEP -> bind_param("i", $usuarioId);
        $stmtActualizarFT -> bind_param("ssi", $fecha,$hora,$idTicket);

        // Ejecutar la consulta
        if ($stmtUpdateT->execute()) {
            $stmtActualizarEP->execute();
            $stmtActualizarFT->execute();
            echo "
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Registro ed solucion compleado',
                text: 'Terminaste la tarea'
            });
        </script>";
        $stmtActualizarEP->close();
        $stmtActualizarFT ->close();

        } else {
            echo "Error al insertar registro: " . $stmtInsertarT->error;
        }

        // Cerrar la declaración
        $stmtUpdateT->close();
    } else {
        echo "<script>
        Swal.fire({
                icon: 'warning',
                title: 'La atención NO fue registrada',
                text: 'comunicate con el desarrollador'
            });
        </script>";
    }
}
?>
