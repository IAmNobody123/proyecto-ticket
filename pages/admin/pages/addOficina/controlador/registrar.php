<?php
if (isset($_POST["submit"])) {
    if (!empty($_POST["second-label"])) {
        $nombreOficina = $_POST["second-label"];
        $numeroSede = $_POST["sede"];
        // Preparar la consulta SQL
        $sql = "INSERT INTO oficina (nombreOficina, idSede) VALUES (?, ?)";
        $stmt = $conexion->prepare($sql);

        // Vincular parámetros
        $stmt->bind_param("si", $nombreOficina, $numeroSede);

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