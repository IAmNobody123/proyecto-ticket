<?php
if (isset($_POST["submit"])) {
    if (!empty($_POST["first-label"])) {
        $nombreSede = $_POST["first-label"];
        $lugarReferencia = $_POST["second-label"];

        // Preparar la consulta SQL
        $sql = "INSERT INTO sede (nombreSede, lugarReferencia) VALUES (?, ?)";
        $stmt = $conexion->prepare($sql);

        // Vincular parámetros
        $stmt->bind_param("ss", $nombreSede, $lugarReferencia);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            echo "<script>Swal.fire({
                icon: 'success',
                title: 'Registro exitoso',
                text: 'Se registro la nueva Sede'
            });</script>";
        } else {
            echo "Error al insertar registro: " . $stmt->error;
        }

        // Cerrar la declaración
        $stmt->close();
    }

}