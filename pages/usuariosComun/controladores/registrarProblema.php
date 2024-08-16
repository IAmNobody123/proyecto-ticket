<?php
if (isset($_POST["btnregistrar"])) {
    if (!empty($_POST["label1"])) {
        $problemaV = $_POST["label1"];
        $tipoProblema = $_POST["tipoProblema"];
        $usuarioId = $_SESSION["id"];
        // Preparar la consulta SQL
        $sql = "INSERT INTO problema (descripcionProblema, idTipoProblema, idUsuario) VALUES (?, ?, ?)";
        $stmt = $conexion->prepare($sql);

        // Vincular parámetros
        $stmt->bind_param("sii", $problemaV, $tipoProblema, $usuarioId);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            echo " <script>
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
        $stmt->close();
    }

}