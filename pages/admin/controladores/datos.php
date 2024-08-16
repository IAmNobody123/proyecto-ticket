<?php
require '../../../conexion/conexion.php'; // Asegúrate de que esta ruta es correcta

// Consulta SQL para obtener los datos
$sql = "SELECT tp.nombreProblema, COUNT(*) AS cantidad
        FROM problema p
        INNER JOIN tipoproblema tp ON p.idTipoProblema = tp.idTipoProblema
        GROUP BY tp.idTipoProblema";

// Ejecutar la consulta
$result = $conexion->query($sql);

// Manejar errores en la consulta
if (!$result) {
    die('Error en la consulta: ' . $conexion->error);
}

// Obtener datos de la consulta
$datos = [];
while ($row = $result->fetch_assoc()) {
    $datos[] = $row;
}

// Construir la respuesta en formato JSON
$respuesta = [
    "datos" => $datos,
];

// Devolver la respuesta en formato JSON
echo json_encode($respuesta);

// Liberar el resultado y cerrar la conexión
$result->free();
$conexion->close();
?>
