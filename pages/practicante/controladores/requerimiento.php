<?php

// Obtener las sedes
$sqlRequerimiento = "SELECT requerimiento FROM ticket" ;
$resultRequerimiento = $conexion->query($sqlRequerimiento);

if ($resultRequerimiento === false) {
    die("Error en la consulta de sedes: " . $conexion->error);
}
?>
