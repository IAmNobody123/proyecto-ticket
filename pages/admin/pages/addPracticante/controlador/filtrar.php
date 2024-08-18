<?php
$sqlQuery = "SELECT * FROM usuario WHERE estado ='activo' ";

if (isset($_POST["btnFiltrar"])) {
    if ($_POST["oficinaS"] != '') {
        $nroOficina = intval($_POST['oficinaS']);
        $sqlQuery .= ' AND idOficina = ' . $nroOficina;
    }
    if ($_POST["rolS"] != '') {
        $nroRol = intval($_POST['rolS']);
        $sqlQuery .= ' AND idRol = ' . $nroRol;
    }
}

// Ejecutar la consulta
$sql = $conexion->query($sqlQuery);

// Verificar si la consulta se ejecutó correctamente
if (!$sql) {
    echo "Error en la consulta: " . $conexion->error; // Para depurar
    $sql = null; // Asegúrate de que $sql sea null si hay un error
}
?>