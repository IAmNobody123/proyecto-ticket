<?php

if (isset($_POST["btnAtender"])) {
    $idUsuario = $_POST["idUsuario"];
    $idProblema = $_POST["idProblema"];
    date_default_timezone_set("America/Lima");
    $fecha = date("Y-m-d");
    $hora = date("H:i:s");
    $requerimiento = "";
    $descrip = "";

    // Preparar la consulta SQL
    $sql = "INSERT INTO ticket (fecha, hora, requerimiento, descripcion_solucion, idUsuario, idProblema) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conexion->prepare($sql);

    // Vincular parámetros
    $stmt -> bind_param("ssssii", $fecha, $hora, $requerimiento, $descrip, $idUsuario, $idProblema);
    $cambiarEstado = " UPDATE problema SET estadoProblema = 'en proceso' WHERE idProblema = ?";

    $stmt2 = $conexion->prepare($cambiarEstado);
    $stmt2->bind_param("i", $idProblema);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        $stmt2->execute();
        echo "
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Atención aceptada',
                text: 'La atención se ha aceptado correctamente.'
            });
        </script>";
    } else {
        echo "Error al insertar registro: " . $stmt->error;
    }

    // Cerrar la declaración
    $stmt2->close();
    $stmt->close();
}
?>