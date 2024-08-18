<?php
if (isset($_POST["idUsuario"])) {
    $idUsuario = $_POST["idUsuario"];

    // Preparar la consulta SQL
    $sql = "UPDATE usuario SET estado = 'inactivo' WHERE idUsuario = ?";
    $stmt = $conexion->prepare($sql);

    // Vincular parámetros
    $stmt->bind_param("i", $idUsuario);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'El usuario ha sido eliminado',
                    text: 'La atención se ha aceptado correctamente.'
                });
              </script>";
        $sql = $conexion->query($sqlQuery);
    } else {
        echo "Error al eliminar registro: " . $stmt->error;
    }

    // Cerrar la declaración
    $stmt->close();
}
?>