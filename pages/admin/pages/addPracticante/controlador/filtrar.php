<?php
$sqlQuery = "SELECT * FROM usuario WHERE 1 ='1' ";

if (isset($_POST["btnFiltrar"])) {
    if ($_POST["oficinaS"] != '') {
        $nroOficina = intval($_POST['oficinaS']);
        $sqlQuery .= ' AND idOficina = ' . $nroOficina;
    }
    if ($_POST["rolS"] != '') {
        $nroRol = intval($_POST['rolS']);
        $sqlQuery .= ' AND idRol = ' . $nroRol;
    }
    if ($_POST["estado"] != '') {
        $estadoU = $_POST['estado'];
        $sqlQuery .= ' AND estado = "' . $estadoU.'"';
    }
    echo "<script>Swal.fire({
        icon: 'success',
        title: 'Tabla actualizada',
        text: 'la tabla fue actualizada!!'
    });</script>";
}
// Ejecutar la consulta
$sql = $conexion->query($sqlQuery);

// Verificar si la consulta se ejecutó correctamente
if (!$sql) {
    echo "Error en la consulta: " . $conexion->error; // Para depurar
    $sql = null; // Asegúrate de que $sql sea null si hay un error
}
?>