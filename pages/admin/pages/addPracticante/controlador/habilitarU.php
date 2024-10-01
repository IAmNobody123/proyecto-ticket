<?php
if (isset($_POST["habilitarU"])) {
    $idUsuario = $_POST["eliminar"];

    // Preparar la consulta SQL
    $sqlHabilitar = "UPDATE usuario SET estado = 'activo' WHERE idUsuario = ?";
    $stmtHU = $conexion->prepare($sqlHabilitar);

    // Vincular parámetros
    $stmtHU->bind_param("i", $idUsuario);

    // Ejecutar la consulta
    if ($stmtHU->execute()) {
        echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'El usuario ha sido habilitado',
                    text: 'La restauracion fue correcta.'
                });
              </script>";
        header("location: ./addPracticante.php");

    } else {
        echo "Error al eliminar registro: " . $stmtHU->error;
    }

    // Cerrar la declaración
    $stmtHU->close();
}
?>