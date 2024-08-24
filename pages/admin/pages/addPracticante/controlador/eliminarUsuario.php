<?php
if (isset($_POST["eliminar"])) {
    $idUsuario = $_POST["eliminar"];

    // Preparar la consulta SQL
    $sqlBorrarUser = "UPDATE usuario SET estado = 'inactivo' WHERE idUsuario = ?";
    $stmtBU = $conexion->prepare($sqlBorrarUser);

    // Vincular parámetros
    $stmtBU->bind_param("i", $idUsuario);

    // Ejecutar la consulta
    if ($stmtBU->execute()) {
        echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'El usuario ha sido eliminado',
                    text: 'La atención se ha aceptado correctamente.'
                });
              </script>";
    } else {
        echo "Error al eliminar registro: " . $stmtBU->error;
    }

    // Cerrar la declaración
    $stmtBU->close();
}
?>