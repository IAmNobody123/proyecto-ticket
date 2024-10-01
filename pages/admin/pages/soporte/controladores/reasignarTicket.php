<?php
if (isset($_POST["submitRAsignar"])) {

    if (!empty($_POST["selectorPracticante"])) {
        $idTicket = $_POST["idTicket"];
        $idPracticante = $_POST["selectorPracticante"];
        date_default_timezone_set("America/Lima");
        $fecha = date("Y-m-d");
        $hora = date("H:i:s");
        $requerimiento = "";
        $descripcionSolucion = "";

        //modificar Ticket 
        $modificarTicket = "UPDATE ticket set fecha = ? ,hora= ? ,idUsuario= ? ,estadoTicket='aceptado' where idTicket = ?";

        $actualizarEstadoPracticante = "UPDATE usuario set tareaAsignada= 'ocupado' where idUsuario=?";

        $idProblema = "SELECT idProblema from ticket where idTicket = $idTicket";
        $stmtObtenerIdProblema= $conexion->prepare($idProblema);
        $stmtObtenerIdProblema ->execute();
        $resultado = $stmtObtenerIdProblema->get_result();
        if ($resultado->num_rows > 0) {
            $fila = $resultado->fetch_assoc();
            $idProblema = $fila['idProblema'];
        }
        else{
            return "algo salio mal";
        }
        $actualizarFechaProblema = "UPDATE problema set estadoProblema='en proceso', fechaProblemaAceptado = now() where idProblema=?";

        $stmtModificarT = $conexion->prepare($modificarTicket);
        $stmtActualizarEP = $conexion->prepare($actualizarEstadoPracticante);
        $stmtActualizarFP = $conexion->prepare($actualizarFechaProblema);

        // Vincular parámetros
        $stmtModificarT -> bind_param("ssii",$fecha, $hora,$idPracticante,$idTicket );
        $stmtActualizarEP -> bind_param("i", $idPracticante);
        $stmtActualizarFP -> bind_param("i", $idProblema);

        // Ejecutar la consulta
        if ($stmtModificarT->execute()) {
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
        $resultPracticantes = $conexion->query($sqlPracticantes);
        } else {
            echo "Error al insertar registro: " . $stmtModificarT->error;
        }

        // Cerrar la declaración
        $stmtModificarT->close();
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