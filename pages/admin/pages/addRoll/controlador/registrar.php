<?php
if (isset($_POST["submitRoll"])) {
    if (!empty($_POST["first-label"])) {
        $nombreRoll = $_POST["first-label"];
        // Preparar la consulta SQL
        $sql = "INSERT INTO rol (nombreRol) VALUES (?)";
        $stmt = $conexion->prepare($sql);

        // Vincular parámetros
        $stmt->bind_param("s",$nombreRoll);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            echo "Registro insertado exitosamente.";
        } else {
            echo "Error al insertar registro: " . $stmt->error;
        }

        // Cerrar la declaración
        $stmt->close();
    }

}