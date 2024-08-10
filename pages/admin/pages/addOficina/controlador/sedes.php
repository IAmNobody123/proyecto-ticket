<?php

// Obtener las sedes
$sqlSedes = "SELECT idSede, nombreSede FROM sede";
$resultSedes = $conexion->query($sqlSedes);

if ($resultSedes === false) {
    die("Error en la consulta de sedes: " . $conexion->error);
}
?>