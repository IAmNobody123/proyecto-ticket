<?php
if (isset($_POST["submitAtender"])) {
    if (!empty($_POST["selectorPracticante"]) && !empty($_POST["idProblema"])) {
        $idPracticante = $_POST["selectorPracticante"];
        $idProblema = $_POST["idProblema"]; // Obtener el idProblema
        date_default_timezone_set("America/Lima");
        $fecha = date("Y-m-d");
        $hora = date("H:i:s");
        $requerimiento = "";
        $descripcionSolucion = "";

        // Preparar la consulta SQL
        $insertarTicket = "INSERT INTO ticket (fecha, hora,requerimiento, descripcion_solucion, idUsuario, idProblema)
        VALUES (?, ?, ?, ?, ?, ?)";

        $actualizarEstadoPracticante = "update usuario set tareaAsignada= 'ocupado' where idUsuario=?";

        $actualizarFechaProblema = "update problema set estadoProblema='en proceso', fechaProblemaAceptado = now() where idProblema=?";

        $stmtInsertarT = $conexion->prepare($insertarTicket);
        $stmtActualizarEP = $conexion->prepare($actualizarEstadoPracticante);
        $stmtActualizarFP = $conexion->prepare($actualizarFechaProblema);

        // Vincular parámetros
        $stmtInsertarT -> bind_param("ssssii", $fecha, $hora, $requerimiento, $descripcionSolucion, $idPracticante, $idProblema);
        $stmtActualizarEP -> bind_param("i", $idPracticante);
        $stmtActualizarFP -> bind_param("i", $idProblema);

        // Ejecutar la consulta
        if ($stmtInsertarT->execute()) {
            $stmtActualizarEP->execute();
            $stmtActualizarFP->execute();
            echo "
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Atención aceptada',
                text: 'El problema fue designado con exito'
            });
        </script>";
        $stmtActualizarEP->close();
        $stmtActualizarFP ->close();

        } else {
            echo "Error al insertar registro: " . $stmtInsertarT->error;
        }

        // Cerrar la declaración
        $stmtInsertarT->close();
    } else {
        echo "<script>
        Swal.fire({
                icon: 'warning',
                title: 'La atención NO fue aceptada',
                text: 'Seleccione un practicante'
            });
        </script>";
    }
}
?>